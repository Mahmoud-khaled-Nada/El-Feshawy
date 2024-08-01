<?php

namespace App\Repositories\Meetings;

use App\Helpers\Formater;
use App\Models\Meeting;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class MeetingRepository implements IMeetingRepository
{

    public function get()
    {
        return Meeting::with([
            'participatingCustomers' => function ($query) {
                $query->select('customers.id', 'customers.name', 'customers.email');
            },
            'participatingEmployees' => function ($query) {
                $query->select('employees.id', 'employees.name', 'employees.email');
            },
        ]);
    }

    public function getMeetings()
    {
        $meetings = $this->get()->paginate(10);
        $this->filtters($meetings);
        return $meetings;
    }

    public function getMeetingById(string $meetingId)
    {
        $meeting = $this->get()->findOrFail($meetingId);
        $this->filtter($meeting);
        return $meeting;
    }

    public function createMeeting(array $attributes)
    {
        $meeting = Meeting::create($attributes);

        $employeeData = array_map(function ($employeeId) use ($meeting) {
            return [
                'meeting_id' => $meeting->id,
                'employee_id' => $employeeId,
            ];
        }, $attributes['employee_ids']);

        $customerData = array_map(function ($customerId) use ($meeting) {
            return [
                'meeting_id' => $meeting->id,
                'customer_id' => $customerId,
            ];
        }, $attributes['customer_ids']);

        DB::table('employee_meeting_participations')->insert($employeeData);
        DB::table('customer_meeting_participations')->insert($customerData);
    }

    public function updateMeeting(Meeting $meeting, array $attributes)
    {

        $meeting->update($attributes);
        // First, delete existing records for this meeting
        DB::table('employee_meeting_participations')->where('meeting_id', $meeting->id)->delete();
        DB::table('customer_meeting_participations')->where('meeting_id', $meeting->id)->delete();

        // Prepare data for batch insert
        $employeeData = array_map(function ($employeeId) use ($meeting) {
            return [
                'meeting_id' => $meeting->id,
                'employee_id' => $employeeId,
            ];
        }, $attributes['employee_ids']);

        $customerData = array_map(function ($customerId) use ($meeting) {
            return [
                'meeting_id' => $meeting->id,
                'customer_id' => $customerId,
            ];
        }, $attributes['customer_ids']);

        // Batch insert new records
        DB::table('employee_meeting_participations')->insert($employeeData);
        DB::table('customer_meeting_participations')->insert($customerData);
    }

    public function deleteMeeting(Meeting $meeting)
    {
        return $meeting->delete();
    }


    public function meetingsForEmployee(string $employeeId)
    {
        $meetings = Meeting::whereHas('participatingEmployees', function ($query) use ($employeeId) {
            $query->where('employees.id', '=', $employeeId);
        })->with([
            'participatingCustomers' => function ($query) {
                $query->select('customers.id', 'customers.name', 'customers.email');
            },
            'participatingEmployees' => function ($query) use ($employeeId) {
                $query->select('employees.id', 'employees.name', 'employees.email');
            },
        ])->paginate(10);
        $meetings->getCollection()->transform(function ($meeting) {
            $this->filtter($meeting);
            return $meeting;
        });
        return $meetings;
    }


    public function meetingsForCustomer(string $customerId)
    {
        $meetings = Meeting::whereHas('participatingCustomers', function ($query) use ($customerId) {
            $query->where('customers.id', '=', $customerId);
        })->with([
            'participatingCustomers' => function ($query) {
                $query->select('customers.id', 'customers.name', 'customers.email');
            },
            'participatingEmployees' => function ($query) {
                $query->select('employees.id', 'employees.name', 'employees.email');
            },
        ])->paginate(10);

        $meetings->getCollection()->transform(function ($meeting) {
            $this->filtter($meeting);
            return $meeting;
        });

        return $meetings;
    }

    private function filtters($meetings)
    {
        foreach ($meetings as $meeting) {
            $meeting->participatingCustomers->makeHidden('pivot');
            $meeting->participatingEmployees->makeHidden(['pivot', 'status_string']);
        }
    }

    private function filtter($meeting)
    {
        $meeting->participatingCustomers->makeHidden('pivot');
        $meeting->participatingEmployees->makeHidden(['pivot', 'status_string']);
    }
}
