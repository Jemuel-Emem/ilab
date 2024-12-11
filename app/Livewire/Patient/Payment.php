<?php

namespace App\Livewire\Patient;

use App\Models\Payments as Pay;
use Livewire\Component;

class Payment extends Component
{
    public $payments;

    public function mount()
    {

        $this->payments = Pay::with('service')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function render()
    {
        return view('livewire.patient.payment', [
            'payments' => $this->payments,
        ]);
    }
}
