<?php

namespace App\Livewire\Admin;

use App\Models\User; // Assuming patients are stored in the User model
use Livewire\Component;

class PatientInformation extends Component
{
    public $patients;

    public function mount()
    {
        // Fetch all patients (you can add conditions like 'role' if applicable)
        $this->patients = User::where('is_admin', '0')->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.admin.patient-information');
    }
}
