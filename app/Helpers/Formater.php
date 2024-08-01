<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Validator;

class Formater
{

    public function formatValidateRequest($request, $rules)
    {
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->getMessages();

            return response()->json([
                'message' => $validator->errors()->first() . ' (and ' . (count($errors) - 1) . ' more errors)',
                'validation' => $errors,
            ], 422);
        }
        return null;
    }

    public function formatConversation($conversation, $messages)
    {
        return [
            'id' => $conversation->id,
            'title' => $conversation->title,
            'employee_id' => $conversation->employee_id,
            'last_message' => $conversation->last_message,
            'is_read' => $conversation->is_read,
            'last_message_send_at' => $conversation->last_message_send_at,
            'messages' => $messages->map(function ($message) {
                return $this->formatMessage($message);
            })
        ];
    }

    protected function formatMessage($message)
    {
        return [
            'id' => $message->id,
            'conversation_id' => $message->conversation_id,
            'sender_id' => $message->sender_id,
            'sender_type' => $message->sender_type,
            'sender_name' => $message->sender->name,
            'message' => $message->message,
            'created_at' => $message->created_at,
        ];
    }

    public function formatEmployeeTasks($task)
    {
        return [
            'id' => $task->id,
            'title' => $task->title,
            'status' => $task->status,
            'description' => $task->description,
            'start_date' => $task->start_date,
            'end_date' => $task->end_date,
            'duration' => $task->duration,
            'participants' => $task->participants,
            'received_file_path' => $task->received_file_path,
            'uploaded_file_path' => $task->uploaded_file_path,
            'created_at' => $task->created_at,
            'employees' => $task->employees->map(function ($employee) {
                return [
                    'id' => $employee->id,
                    'name' => $employee->name,
                ];
            }),
            'taskChecklistItems' => $task->taskChecklistItems->map(function ($item) {
                return [
                    'id' => $item->id,
                    'task_id' => $item->task_id,
                    'item' => $item->item,
                    'checked' => $item->checked,
                    'created_at' => $item->created_at,
                ];
            }),
        ];
    }


    // public function formatByJobTitles($groupedPeopleByTitle)
    // {
    //     $titleOrder = [
    //         'FOUNDING & MANAGING PARTNER', 'FOUNDING PARTNER', 'OF COUNSEL', 'PARTNER',
    //         'SENIOR ASSOCIATE', 'ASSOCIATE', 'JUNIOR ASSOCIATE'
    //     ];

    //     $sortedEmployees = [];

    //     $groupedPeopleUpper = $groupedPeopleByTitle->mapWithKeys(function ($item, $key) {
    //         return [strtoupper($key) => $item];
    //     });

    //     // Iterate over each title in the title order array
    //     foreach ($titleOrder as $title) {
    //         $titleUpper = strtoupper($title);
    //         if ($groupedPeopleUpper->has($titleUpper)) {
    //             $sortedEmployees[] = $groupedPeopleUpper->get($titleUpper)->values()->toArray();
    //         }
    //     }

    //     return $sortedEmployees;
    // }


    public function formatByJobTitles($groupedPeopleByTitle)
    {
        $titleGroups = [
            'Founding Partners and ,Managing' => [
                'FOUNDING & MANAGING PARTNER',
            ],
            'Founding Partners' => [
                'FOUNDING PARTNER'
            ],
            'Of Counsel and Partners' => [
                'OF COUNSEL',
                'PARTNER'
            ],
            'Senior Associates' => [
                'SENIOR ASSOCIATE',
            ],
            'Junior Associates' => [
                'JUNIOR ASSOCIATE'
            ],
            'Associates' => [
                'ASSOCIATE'
            ]
        ];

        $sortedEmployees = [];

        $groupedPeopleUpper = $groupedPeopleByTitle->mapWithKeys(function ($item, $key) {
            return [strtoupper($key) => $item];
        });

        foreach ($titleGroups as $groupName => $titles) {
            $grouped = [];

            foreach ($titles as $title) {
                $titleUpper = strtoupper($title);
                if ($groupedPeopleUpper->has($titleUpper)) {
                    $grouped = array_merge($grouped, $groupedPeopleUpper->get($titleUpper)->values()->toArray());
                }
            }

            if (!empty($grouped)) {
                $sortedEmployees[] = $grouped;
            }
        }

        return $sortedEmployees;
    }
}
