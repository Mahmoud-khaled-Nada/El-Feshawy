<?php

namespace App\Repositories\Meetings;

use App\Models\Meeting;

interface IMeetingRepository
{
    // public function getMeetingsByCustomerId(string $customerId);
    // public function getMeetingsByEmployeeAndCustomerId(string $employeeId, string $customerId);

    public function getMeetings();
    public function getMeetingById(string $meetingId);
    public function createMeeting(array $attributes);
    public function updateMeeting(Meeting $meeting, array $attributes);
    public function deleteMeeting(Meeting $meeting);

    public function meetingsForEmployee(string $employeeId);
    public function meetingsForCustomer(string $customerId);
}
