<?php

namespace App\Livewire\Technician;

use App\Models\User;
use App\Models\Appointment;
use Livewire\Component;

class Index extends Component
{
    public $totalPatients;
    public $totalAppointments;

    public function mount()
    {

        $this->totalPatients = User::where('is_admin', 0)
        ->whereHas('appointments', function ($query) {
            $query->where('status', 'approved');
        })
        ->count();


        $this->totalAppointments = Appointment::count();
    }

    public function render()
    {
        return view('livewire.technician.index');
    }
}
