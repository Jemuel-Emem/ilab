<?php

namespace App\Livewire\Technician;

use App\Models\Appointment; // Make sure to import the Appointment model
use Livewire\Component;

class Patients extends Component
{
    public function render()
    {

        $approvedAppointments = Appointment::with('user')
            ->where('status', 'approved')
            ->get();

        return view('livewire.technician.patients', [
            'approvedAppointments' => $approvedAppointments,
        ]);
    }
}
