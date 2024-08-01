<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Meeting;
use App\Repositories\Meetings\IMeetingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MeetingsController extends Controller
{
    public function __construct(private IMeetingRepository $repository)
    {
    }

    public function index()
    {
        $meetings = $this->repository->getMeetings();
        return view('AdminPanel.meetings.index', compact('meetings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        $customers = Customer::all();
        return view('AdminPanel.meetings.create', compact('employees', 'customers'));
    }


    public function store(Request $request)
    {
        if ($request->input('status') === 'Online') {
            $request->merge(['location' => null]);
        } elseif ($request->input('status') === 'Offline') {
            $request->merge(['link' => null]);
        }

        $validated = $request->validate(Meeting::rules());

        try {
            DB::beginTransaction();
            $this->repository->createMeeting($validated);
            DB::commit();

            flashy()->success(__('lang.created'));
            return redirect()->route('meetings.index');
        } catch (\Exception $e) {
            DB::rollBack();
            flashy()->warning(__('lang.warning'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(string $id)
    {
        $employees = Employee::paginate();
        $customers = Customer::paginate();
        $meeting = Meeting::findOrFail($id);
        return view('AdminPanel.meetings.edit', compact('meeting', 'employees', 'customers'));
    }


    public function update(Request $request, string $id)
    {
        if ($request->input('status') === 'Online') {
            $request->merge(['location' => null]);
        } elseif ($request->input('status') === 'Offline') {
            $request->merge(['link' => null]);
        }

        $validated = $request->validate(Meeting::rules());

        $meeting = Meeting::findOrFail($id);
        try {
            DB::beginTransaction();
            $this->repository->updateMeeting($meeting, $validated);
            DB::commit();
            flashy()->success(__('lang.updated'));  // Changed 'created' to 'updated'
            return redirect()->route('meetings.index');
        } catch (\Exception $e) {
            DB::rollBack();
            flashy()->warning(__('lang.warning'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        $meeting = Meeting::findOrFail($id);

        $this->repository->deleteMeeting($meeting);

        flashy()->success(__('lang.deleted'));
        return redirect()->route('meetings.index');
    }

    //TODO: Apis support
    public function getMeetingsForEmployee()
    {
        try {
            $employeeId = auth('employee')->user()->id;
            $meetings = $this->repository->meetingsForEmployee($employeeId);
            return $this->handleSuccess($meetings, 'Your meetings', 200);
        } catch (\Exception $e) {
            return $this->handleError($e->getMessage(), 500);
        }
    }

    public function employeeMeetingById($meetingId)
    {
        try {
            $meeting = $this->repository->getMeetingById($meetingId);
            return $this->handleSuccess($meeting, 'meeting', 200);
        } catch (\Exception $e) {
            return $this->handleError($e->getMessage(), 500);
        }
    }


    public function getMeetingsForCustomer()
    {
        try {
            $customerId = auth('customer')->user()->id;
            $meetings = $this->repository->meetingsForCustomer($customerId);
            return $this->handleSuccess($meetings, 'meetings', 200);
            return response()->json($meetings);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
            return $this->handleError($e->getMessage(), 500);
        }
    }

    public function customerMeetingById($meetingId)
    {
        try {
            $meeting = $this->repository->getMeetingById($meetingId);
            return $this->handleSuccess($meeting, 'meeting', 200);
        } catch (\Exception $e) {
            return $this->handleError($e->getMessage(), 500);
        }
    }
}
