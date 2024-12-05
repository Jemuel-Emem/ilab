<?php

namespace App\Livewire\Technician;

use App\Models\Appointment;
use App\Models\Payments;
use Livewire\Component;

class Payment extends Component
{
    public $appointments;
    public $selectedAppointment;

    public function mount()
    {
        // Fetch the appointments where the status is 'approved'
        $this->appointments = Appointment::with(['user', 'service']) // Eager load related models
            ->where('status', 'approved')
            ->get();
    }

    public function selectAppointment($appointmentId)
    {
        // Find the selected appointment by ID
        $this->selectedAppointment = Appointment::with(['user', 'service'])
            ->where('id', $appointmentId)
            ->first();
    }

    public function markAsPaid()
    {

        if ($this->selectedAppointment) {
            $this->selectedAppointment->status = 'paid';
            $this->selectedAppointment->save();


            Payments::create([
                'appointment_id' => $this->selectedAppointment->id,
                'user_id' => $this->selectedAppointment->user_id,
                'service_id' => $this->selectedAppointment->service_id,
                'amount' => $this->selectedAppointment->service->price,
                'status' => 'paid',
            ]);
        }
    }


    public function render()
    {
        return view('livewire.technician.payment', [
            'appointments' => $this->appointments
        ]);
    }
}
