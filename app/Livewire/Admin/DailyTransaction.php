<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Payments; // Ensure Payments model exists
use Carbon\Carbon;

class DailyTransaction extends Component
{
    public $transactions;

    public function mount()
    {
        // Fetch transactions for today
        $this->transactions = Payments::with('user', 'service')
            ->whereDate('created_at', Carbon::today())
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.daily-transaction', [
            'transactions' => $this->transactions,
        ]);
    }
}
