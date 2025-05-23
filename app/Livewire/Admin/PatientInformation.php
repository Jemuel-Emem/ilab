<?php

namespace App\Livewire\Admin;
use Illuminate\Support\Facades\Hash;
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
    public $age;
    public $gender;
    public $height;
    public $weight;
    public $blood_pressure;
    public $temperature;

    public $password;
    public $password_confirmation;
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
        $this->age = null;
        $this->gender = '';
        $this->height = null;
        $this->weight = null;
        $this->blood_pressure = '';
        $this->temperature = null;
        $this->patientId = null;
        $this->isEditMode = false;

        $this->password = '';
        $this->password_confirmation = '';
    }

    public function editPatient($id)
    {
        $patient = User::findOrFail($id);
        $this->patientId = $patient->id;
        $this->name = $patient->name;
        $this->email = $patient->email;
        $this->phone_number = $patient->phone_number;
        $this->address = $patient->address;
        $this->age = $patient->age;
        $this->gender = $patient->gender;
        $this->height = $patient->height;
        $this->weight = $patient->weight;
        $this->blood_pressure = $patient->blood_pressure;
        $this->temperature = $patient->temperature;
        $this->isEditMode = true;
    }
    public function updatePatient()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$this->patientId,
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:0',
            'gender' => 'nullable|string|in:Male,Female,Other',
            'height' => 'nullable|numeric|min:0',
            'weight' => 'nullable|numeric|min:0',
            'blood_pressure' => 'nullable|string|max:20',
            'temperature' => 'nullable|numeric',
        ];

        // Only validate password if it's provided
        if ($this->password) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $this->validate($rules);

        $updateData = [
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'age' => $this->age,
            'gender' => $this->gender,
            'height' => $this->height,
            'weight' => $this->weight,
            'blood_pressure' => $this->blood_pressure,
            'temperature' => $this->temperature,
        ];

        // Only update password if it's provided
        if ($this->password) {
            $updateData['password'] = Hash::make($this->password);
        }

        $patient = User::findOrFail($this->patientId);
        $patient->update($updateData);

        session()->flash('message', 'Patient updated successfully!');
        $this->resetFields();
        $this->mount();
    }
    // public function updatePatient()
    // {
    //     $patient = User::findOrFail($this->patientId);
    //     $patient->update([
    //         'name' => $this->name,
    //         'email' => $this->email,
    //         'phone_number' => $this->phone_number,
    //         'address' => $this->address,
    //         'age' => $this->age,
    //         'gender' => $this->gender,
    //         'height' => $this->height,
    //         'weight' => $this->weight,
    //         'blood_pressure' => $this->blood_pressure,
    //         'temperature' => $this->temperature,
    //     ]);

    //     session()->flash('message', 'Patient updated successfully!');
    //     $this->resetFields();
    //     $this->mount(); // Reload the patients list
    // }

    public function deletePatient($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('message', 'Patient deleted successfully!');
        $this->mount();
    }
}
