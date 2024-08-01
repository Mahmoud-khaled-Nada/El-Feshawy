<?php

namespace App\Repositories\Tasks;

use App\Models\Task;

interface ITaskRepository
{
    public function getTasks();
    public function getAllTasksWithRelations();
    public function getTaskWithRelationsById(string $taskId);

    // new
    public function createTask(array $attributes);
    public function updateTask(Task $meeting, array $attributes);
    public function deleteTask(Task $task);
    // new
    public function storeFile($file);
    public function removeFile($file);
    public function downloadTaskFile($filename);
    // new
    public function retrieveAllEmployeeTaskAssignments(string $employeeId);
    public function retrieveEmployeeTaskById(string $employeeId, string $taskId);
    //new
    public function toggleTaskStatus(string $taskId);
    public function toggleChecklistItemStatus(string $taskId, string $checklistId);
}
