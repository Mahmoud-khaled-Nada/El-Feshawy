<?php

namespace App\Repositories\Tasks;

use App\Helpers\Constants;
use App\Helpers\Formater;
use App\Helpers\Services;
use App\Http\Traits\FileUpload;
use App\Models\Task;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class TaskRepository implements ITaskRepository
{

    use FileUpload;
    protected $tasks;

    public function __construct()
    {
        $this->tasks = collect([]);
    }

    public function getTasks()
    {
        if ($this->tasks->isEmpty()) {
            $this->tasks = Task::with(['employees', 'taskChecklistItems'])->get();
        }
        return $this->tasks;
    }

    public function getAllTasksWithRelations()
    {
        return $this->getTasks();
    }

    public function getTaskWithRelationsById(string $taskId)
    {
        return $this->getTasks()->firstWhere('id', '=', $taskId);
    }

    public function createTask(array $attributes)
    {
        $task = Task::create($attributes);
        if (!empty($attributes['employee_ids'])) {
            $task->employees()->attach($attributes['employee_ids']);
        }
        if (!empty($attributes['checklist_items'])) {
            $this->createChecklistItems($task, $attributes['checklist_items']);
        }
        return $task;
    }

    public function updateTask(Task $task, array $attributes)
    {
        $task->update($attributes);

        if (!empty($attributes['employee_ids'])) {
            $task->employees()->sync($attributes['employee_ids']);
        } else {
            $task->employees()->detach();
        }

        if (!empty($attributes['checklist_items'])) {
            $this->createOrUpdateChecklistItems($task, $attributes['checklist_items']);
        } else {
            $task->taskChecklistItems()->delete();
        }
    }

    public function deleteTask(Task $task)
    {
        $task->employees()->detach();
        $task->taskChecklistItems()->delete();
        return $task->delete();
    }

    public function retrieveAllEmployeeTaskAssignments(string $employeeId)
    {
        $formater = new Formater();

        $tasks = Task::whereHas('employees', function ($query) use ($employeeId) {
            $query->where('employee_id', $employeeId);
        })
            ->with(['employees:id,name', 'taskChecklistItems'])
            ->get()
            ->map(function ($task) use ($formater) {
                return $formater->formatEmployeeTasks($task);
            });

        return $tasks;
    }

    public function retrieveEmployeeTaskById(string $employeeId, string $taskId)
    {
        $formater = new Formater();

        $task = Task::where('id', $taskId)
            ->whereHas('employees', function ($query) use ($employeeId) {
                $query->where('employee_id', $employeeId);
            })
            ->with(['employees:id,name', 'taskChecklistItems'])
            ->firstOrFail();

        return $formater->formatEmployeeTasks($task);
    }


    public function toggleTaskStatus(string $taskId)
    {
        $task = Task::findOrFail($taskId);
        // Toggle status between 'pending' and 'done'
        $newStatus = $task->status === 'pending' ? 'done' : 'pending';
        $task->status = $newStatus;
        $task->save();
        return $newStatus;
    }


    public function toggleChecklistItemStatus(string $taskId, string $checklistId)
    {
        $task = Task::findOrFail($taskId);
        $item = $task->taskChecklistItems()->where('id', $checklistId)->firstOrFail();

        // Toggle the checked status
        $item->checked = !$item->checked;
        $item->save();

        return $item;
    }


    public function removeFile($file)
    {
        if ($file) {
            $services = new Services();
            $path = Constants::TASKS_FILES_PATH->value;
            $services->removeFileFromUpload($file, $path);
        }
        return;
    }

    public function storeFile($value)
    {
        $path = Constants::TASKS_FILES_PATH->value;
        $fileName = time() . Str::random(10) . '.' . $value->getClientOriginalExtension();
        $this->uploadImage($value, $fileName, $path);
        return $fileName;
    }

    public function downloadTaskFile($filename)
    {
        $path = public_path(Constants::TASKS_FILES_PATH->value . '/' . $filename);

        if (!File::exists($path))
            return false;
        
        return $path;
    }


    //TODO: Helper functions
    protected function createChecklistItems(Task $task, array $items)
    {
        $checklistItems = array_map(function ($item) {
            return ['item' => $item, 'checked' => false];
        }, $items);
        $task->taskChecklistItems()->createMany($checklistItems);
    }

    protected function createOrUpdateChecklistItems(Task $task, array $items)
    {
        $checklistItems = array_map(function ($item) {
            return ['item' => $item, 'checked' => false];
        }, $items);

        $task->taskChecklistItems()->delete();
        $task->taskChecklistItems()->createMany($checklistItems);
    }
}
