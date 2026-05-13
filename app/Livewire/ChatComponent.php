<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

use Livewire\Attributes\On;

class ChatComponent extends Component
{
    public $orderId;
    public $message = '';
    public $showChat = false;
    public $userType = 'user'; // 'user' or 'restaurant'

    #[On('open-chat')]
    public function open($orderId, $userType = 'user')
    {
        $this->orderId = $orderId;
        $this->userType = $userType;
        $this->showChat = true;
        $this->dispatch('chatOpened');
    }

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|string|max:1000',
        ]);

        Message::create([
            'order_id' => $this->orderId,
            'user_id' => Auth::id(),
            'message' => $this->message,
            'type' => $this->userType === 'user' ? 'user_to_restaurant' : 'restaurant_to_user',
        ]);

        $this->message = '';
        $this->dispatch('messageSent');
    }

    public function getMessagesProperty()
    {
        if (!$this->orderId) return collect();

        return Message::where('order_id', $this->orderId)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.chat-component', [
            'messages' => $this->messages,
            'order' => $this->orderId ? Order::with(['restaurant', 'user'])->find($this->orderId) : null,
        ]);
    }
}
