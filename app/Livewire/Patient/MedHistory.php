<?php

namespace App\Livewire\Patient;

use App\Models\Appointment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class MedHistory extends Component
{
    public $appointments;

    public function mount()
    {
        // Fetch the user's medical history (appointments)
        $this->appointments = Appointment::with('service')
            ->where('user_id', Auth::id())
            ->orderBy('appointment_date', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.patient.med-history');
    }
}
