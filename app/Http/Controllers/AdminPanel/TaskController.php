<?php

namespace App\Http\Controllers\AdminPanel;

use App\Helpers\Constants;
use App\Helpers\Services;
use App\Http\Controllers\Controller;
use App\Http\Traits\FileUpload;
use App\Models\Employee;
use App\Models\Task;
use App\Repositories\Tasks\ITaskRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Readline\Hoa\FileException;


class TaskController extends Controller
{
    use FileUpload;

    public function __construct(private ITaskRepository $repository)
    {
    }

    public function index()
    {
        $tasks = $this->repository->getAllTasksWithRelations();
        return view('AdminPanel.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('AdminPanel.tasks.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(Task::rules());

        try {
            DB::beginTransaction();

            if ($request->hasFile('received_file_path')) {
                $validated['received_file_path'] = $request->file('received_file_path');
            }

            $this->repository->createTask($validated);

            DB::commit();

            flashy()->success(__('lang.created'));
            return redirect()->route('task.index');
        } catch (\Exception $e) {
            DB::rollBack();
            flashy()->warning(__('lang.warning'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(string $id)
    {
        $employees = Employee::all();
        $task = $this->repository->getTaskWithRelationsById($id);
        return view('AdminPanel.tasks.edit', compact('task', 'employees'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate(Task::rules());
        $task = Task::findOrFail($id);
        try {
            DB::beginTransaction();
            if ($request->hasFile('received_file_path')) {
                $this->repository->removeFile($task->received_file_path);
                $validated['received_file_path'] = $request->file('received_file_path');
            }

            $this->repository->updateTask($task, $validated);

            DB::commit();
            flashy()->success(__('lang.updated'));
            return redirect()->route('task.index');
        } catch (\Exception $e) {
            DB::rollBack();
            flashy()->warning(__('lang.warning'));
            return redirect()->back();
        }
    }

    public function downloadFile(string $filename)
    {
        $path = $this->repository->downloadTaskFile($filename);
        if (!$path) {
            return redirect()->back()->with('error', 'File not found.');
        }
        $headers = ['Content-Type' => 'application/octet-stream'];
        return response()->download($path, basename($path), $headers);
    }

    public function destroy(string $id)
    {
        try {
            $task = Task::findOrFail($id);
            if ($task->received_file_path) {
                $services = new Services();
                $path = Constants::TASKS_FILES_PATH->value;
                $services->removeFileFromUpload($task->received_file_path, $path);
            }

            $this->repository->deleteTask($task);
            flashy()->success(__('lang.deleted'));
            return redirect()->route('task.index');
        } catch (\Exception $e) {
            flashy()->warning(__('lang.warning'));
            return redirect()->back();
        }
    }

    //TODO: Apis support

    public function getAuthEmployeeTasks()
    {
        $employeeId = auth('employee')->id();

        $tasks = $this->repository->retrieveAllEmployeeTaskAssignments($employeeId);

        if ($tasks->isEmpty()) {
            return $this->handleError('Tasks not found', 400);
        }

        return $this->handleSuccess($tasks, 'tasks', 200);
    }

    public function getTaskId(string $taskId)
    {
        try {
            $employeeId = auth('employee')->id();
            $task = $this->repository->retrieveEmployeeTaskById($employeeId, $taskId);
            return $this->handleSuccess($task, 'task', 200);
        } catch (ModelNotFoundException $e) {
            return $this->handleError('Task not found or not related to the employee', 404);
        } catch (\Exception $e) {
            return $this->handleError($e->getMessage(), 500);
        }
    }

    // uploadFile--->
    public function uploadFile(Request $request, $id)
    {
        $request->validate(['uploaded_file_path' => 'required|file|max:2048']);
        $task = Task::findOrFail($id);

        try {
            if ($request->hasFile('uploaded_file_path')) {
                $this->repository->removeFile($task->uploaded_file_path);
                // uploadFile
                $filePath =  $this->repository->storeFile($request->file('uploaded_file_path'));
                $task->uploaded_file_path = $filePath;
                $task->save();
                return $this->handleSuccess('upload', 'File uploaded successfully', 200);
            }
        } catch (ModelNotFoundException $e) {
            return $this->handleError('Task not found', 404);
        } catch (FileException $e) {
            return $this->handleError('File upload error: ' . $e->getMessage(), 500);
        } catch (\Exception $e) {
            return $this->handleError('Server error: ' . $e->getMessage(), 500);
        }
    }

    public function changeTaskStatus(string $taskId)
    {
        // Toggle task status
        $taskStatus = $this->repository->toggleTaskStatus($taskId);

        if ($taskStatus === null) {
            return $this->handleError('Task not found', 404);
        }

        $statusMessage = $taskStatus === 'pending'
            ? 'Task marked as pending successfully'
            : 'Task marked as done successfully';

        return $this->handleSuccess($statusMessage, $statusMessage, 200);
    }

    public function changeChecklistItemStatus(string $taskId, string $checklistId)
    {
        try {
            $item = $this->repository->toggleChecklistItemStatus($taskId, $checklistId);

            $statusMessage = $item->checked
                ? 'Item marked as done successfully'
                : 'Item marked as pending successfully';

            return $this->handleSuccess($statusMessage, $statusMessage, 200);
        } catch (ModelNotFoundException $e) {
            return $this->handleError('Item or Task not found', 404);
        } catch (\Exception $e) {
            return $this->handleError('An unexpected error occurred', 500);
        }
    }
}
