<?php

namespace App\Livewire;

use App\Models\Restaurant;
use App\Models\Withdrawal;
use Livewire\Component;

class RestaurantWallet extends Component
{
    public $restaurant;
    public $bank_name;
    public $bank_account_number;
    public $bank_account_name;
    public $withdrawal_amount;
    public $notes;

    protected $rules = [
        'bank_name' => 'required|string',
        'bank_account_number' => 'required|string',
        'bank_account_name' => 'required|string',
        'withdrawal_amount' => 'required|numeric|min:10000',
    ];

    public function mount()
    {
        $this->restaurant = Restaurant::where('user_id', auth()->id())->first();
        
        if ($this->restaurant) {
            $this->bank_name = $this->restaurant->bank_name;
            $this->bank_account_number = $this->restaurant->bank_account_number;
            $this->bank_account_name = $this->restaurant->bank_account_name;
        }
    }

    public function updateBankInfo()
    {
        $this->validate([
            'bank_name' => 'required|string',
            'bank_account_number' => 'required|string',
            'bank_account_name' => 'required|string',
        ]);

        $this->restaurant->update([
            'bank_name' => $this->bank_name,
            'bank_account_number' => $this->bank_account_number,
            'bank_account_name' => $this->bank_account_name,
        ]);

        $this->dispatch('notify', ['message' => 'Bank info updated successfully!', 'type' => 'success']);
    }

    public function requestWithdrawal()
    {
        $this->validate();

        if ($this->withdrawal_amount > $this->restaurant->balance) {
            $this->addError('withdrawal_amount', 'Insufficient balance.');
            return;
        }

        Withdrawal::create([
            'restaurant_id' => $this->restaurant->id,
            'amount' => $this->withdrawal_amount,
            'status' => 'pending',
            'notes' => $this->notes,
        ]);

        $this->restaurant->decrement('balance', $this->withdrawal_amount);
        
        $this->withdrawal_amount = null;
        $this->notes = null;

        $this->dispatch('notify', ['message' => 'Withdrawal request submitted!', 'type' => 'success']);
    }

    public function simulatePayoutSuccess()
    {
        $latestPending = Withdrawal::where('restaurant_id', $this->restaurant->id)
            ->where('status', 'pending')
            ->latest()
            ->first();

        if ($latestPending) {
            $latestPending->update([
                'status' => 'paid',
                'reference_number' => 'SIM-PAY-' . strtoupper(bin2hex(random_bytes(4))),
                'notes' => 'Simulated successful payout.',
            ]);

            $this->dispatch('notify', ['message' => 'Payout simulation successful!', 'type' => 'success']);
        } else {
            $this->dispatch('notify', ['message' => 'No pending withdrawals to simulate.', 'type' => 'info']);
        }
    }

    public function render()
    {
        $withdrawals = $this->restaurant ? $this->restaurant->withdrawals()->latest()->get() : collect();
        
        return view('livewire.restaurant-wallet', [
            'withdrawals' => $withdrawals
        ]);
    }
}
