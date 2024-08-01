<?php

namespace App\View\Components;

use App\Models\Conversation;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarMenu extends Component
{

    public $messageNotification;

    public function __construct()
    {
        $this->messageNotification = Conversation::where('is_admin_read', '0')->count();
    }

    public function render(): View|Closure|string
    {
        return view('AdminPanel.layouts.menu');
    }
}
