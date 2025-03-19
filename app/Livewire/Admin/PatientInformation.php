<?php

namespace App\Livewire\Admin;

use App\Models\User; // Assuming patients are stored in the User model
use Livewire\Component;

class PatientInformation extends Component
{
    public $patients;
    public $patientId;
    public $name;
    public $email;
    public $phone_number;
    public $address;
    public $isEditMode = false;

    public function mount()
    {

        $this->patients = User::where('is_admin', '0')->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.admin.patient-information');
    }

    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->phone_number = '';
        $this->address = '';
        $this->patientId = null;
        $this->isEditMode = false;
    }

    public function editPatient($id)
    {
        $patient = User::findOrFail($id);
        $this->patientId = $patient->id;
        $this->name = $patient->name;
        $this->email = $patient->email;
        $this->phone_number = $patient->phone_number;
        $this->address = $patient->address;
        $this->isEditMode = true;
    }

    public function updatePatient()
    {


        $patient = User::findOrFail($this->patientId);
        $patient->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
        ]);

        session()->flash('message', 'Patient updated successfully!');
        $this->resetFields();
    }

    public function deletePatient($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('message', 'Patient deleted successfully!');
    }
}
