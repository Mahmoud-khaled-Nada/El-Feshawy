<?php

namespace App\Http\Controllers\AdminPanel;

use App\Helpers\Formater;
use App\Helpers\Services;
use App\Http\Controllers\Controller;
use App\Http\Traits\HandleApiResponse;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    use HandleApiResponse;

    protected $conversations;

    public function __construct()
    {
        $this->conversations = collect([]);
    }

    protected function getAllConversations()
    {
        if ($this->conversations->isEmpty())
            $this->conversations = Conversation::with(['employee'])->orderBy('last_message_send_at', 'desc')->get();
        return $this->conversations;
    }

    public function index()
    {
        $conversations = $this->getAllConversations();
        return view('AdminPanel.supporter.index', compact('conversations'));
    }

    public function show($id)
    {
        $formater = new Formater;
        $services = new Services;
        $conversation = $this->getAllConversations()->firstWhere('id', $id);
        $services->updateIsReadMessage($conversation);

        $messages = Message::where('conversation_id', $id)->with('sender:id,name')->paginate(20);
        $result = $formater->formatConversation($conversation, $messages);

        $result = [
            'conversation' => $conversation,
            'messages' => $messages->items()
        ];
        return $this->handleSuccess($result);
    }

    //TODO: start Apis
    // public function apiIndex()
    // {
    //     return Conversation::with(['employee', 'messages.sender'])->get();
    // }

    public function apiStore(Request $request)
    {
        $employee = auth('employee')->user();
        if (!$employee) {
            return $this->handleError('You are not authorized to create a conversation', 401);
        }

        $employeeId = $employee->id;

        // Validate request data
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Check if a conversation already exists for this employee
        $conversation = Conversation::where('employee_id', $employeeId)->first();

        if ($conversation) {
            return $this->handleSuccess($conversation, 'You cannot create more than one conversation', 200);
        }

        // Create a new conversation
        $conversation = Conversation::create([
            'employee_id' => $employeeId,
            'title' => $request->title,
        ]);

        return $this->handleSuccess($conversation, 'Conversation created successfully', 201);
    }

    public function apiShow($id)
    {
        try {
            $employee = auth('employee')->user();
            $conversation = Conversation::with(['employee', 'messages.sender'])->findOrFail($id);
            if($conversation->employee_id === $employee->id) {
                return $this->handleSuccess($conversation, 'Conversation retrieved successfully', 200);
            }
            return $this->handleError('can not access this conversation', 400);;
            
        } catch (ModelNotFoundException $e) {
            return $this->handleError('Conversation not found', 404);
        } catch (\Exception $e) {
            return $this->handleError($e->getMessage(), 500);
        }
    }
}
