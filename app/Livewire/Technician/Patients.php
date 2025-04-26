<?php

namespace App\Livewire\Technician;
use Livewire\WithFileUploads;
use App\Models\Appointment;
use App\Models\User;
use Livewire\Component;

class Patients extends Component
{
    public $lab_result;
    public $approvedAppointments;
    public $editing = false;
    use WithFileUploads;
    public $appointmentId;
    public $appointment_date;

    public $userId;
    public $phone_number, $address, $age, $gender, $height, $weight, $blood_pressure, $temperature;

    public function render()
    {
        $this->approvedAppointments = Appointment::with('user', 'service')
            ->where('status', 'approved')
            ->get();

        return view('livewire.technician.patients');
    }

    public function editAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $this->appointmentId = $appointment->id;
        $this->appointment_date = $appointment->appointment_date;

        $this->userId = $appointment->user_id;
        $this->phone_number = $appointment->user->phone_number;
        $this->address = $appointment->user->address;
        $this->age = $appointment->user->age;
        $this->gender = $appointment->user->gender;
        $this->height = $appointment->user->height;
        $this->weight = $appointment->user->weight;
        $this->blood_pressure = $appointment->user->blood_pressure;
        $this->temperature = $appointment->user->temperature;

        $this->editing = true;
    }

    public function updateAppointment()
    {
        $this->validate([
            'lab_result' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
        ]);

        $appointment = Appointment::findOrFail($this->appointmentId);


        $appointment->appointment_date = $this->appointment_date;
        $appointment->save();

        $user = User::findOrFail($this->userId);
        $user->phone_number = $this->phone_number;
        $user->address = $this->address;
        $user->age = $this->age;
        $user->gender = $this->gender;
        $user->height = $this->height;
        $user->weight = $this->weight;
        $user->blood_pressure = $this->blood_pressure;
        $user->temperature = $this->temperature;

        if ($this->lab_result) {
            $path = $this->lab_result->store('lab_results', 'public');
            $user->lab_result = $path;
        }

        $user->save();

        session()->flash('message', 'Appointment and patient info updated successfully.');
        $this->editing = false;
        $this->reset('lab_result');
    }

    public function deleteAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        session()->flash('message', 'Appointment deleted successfully.');
    }
}
