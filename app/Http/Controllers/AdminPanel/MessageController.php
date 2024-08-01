<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Http\Traits\HandleApiResponse;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function apiStore(Request $request)
    {

        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'message' => 'required|string',
        ]);


        $employeeId = auth('employee')->user();

        if ($employeeId instanceof \App\Models\Employee) {
            $senderType = 'App\Models\Employee';
            $senderId = $employeeId->id;
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $message = Message::create([
            'conversation_id' => $request->conversation_id,
            'sender_type' => $senderType,
            'sender_id' => $senderId,
            'message' => $request->message,
        ]);

        $conversation = $message->conversation;
        $conversation->last_message = $message->message;
        $conversation->is_admin_read = '0';
        $conversation->is_employee_read = '1';
        $conversation->last_message_send_at = now();
        $conversation->save();

        return response()->json($message, 201);
    }


    public function store(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'message' => 'required|string',
        ]);

        $admin = auth()->user();

        if ($admin instanceof \App\Models\User) {
            $senderType = 'App\Models\User';
            $senderId = $admin->id;
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $message = Message::create([
            'conversation_id' => $request->conversation_id,
            'sender_type' => $senderType,
            'sender_id' => $senderId,
            'message' => $request->message,
        ]);

        $conversation = $message->conversation;
        $conversation->is_admin_read = '1';
        $conversation->is_employee_read = '0';
        $conversation->last_message = $message->message;
        $conversation->last_message_send_at = now();
        $conversation->save();

        return $this->handleSuccess($this->formatMessage($message));
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
            'created_at' => $message->created_at->toDateTimeString(),
        ];
    }
}
