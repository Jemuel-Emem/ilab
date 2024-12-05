<?php

namespace App\Livewire\Patient;

use App\Models\Appointment as App;
use Livewire\Component;

class Appointment extends Component
{
    public $userId;

    public function render()
    {

        $appointments = App::where('user_id', $this->userId)
            ->with('service')
            ->get();

        return view('livewire.patient.appointment', [
            'appointments' => $appointments,
        ]);
    }
}
