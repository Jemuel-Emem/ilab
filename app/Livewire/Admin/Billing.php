<?php

namespace App\Livewire\Admin;
use App\Models\Appointment;
use App\Models\Payments;
use Livewire\Component;

class Billing extends Component
{
    public $appointments;
    public $selectedAppointment;

    public function mount()
    {

        $this->appointments = Appointment::with(['user', 'service']) // Eager load related models
            ->where('status', 'approved')
            ->get();
    }
    public function closeModal()
    {
        $this->selectedAppointment = null;
    }
    public function selectAppointment($appointmentId)
    {

        $this->selectedAppointment = Appointment::with(['user', 'service'])
            ->where('id', $appointmentId)
            ->first();
    }

    public function markAsPaid()
    {

        if ($this->selectedAppointment) {
            $this->selectedAppointment->payment_status = 'paid';
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
        return view('livewire.admin.billing', [
            'appointments' => $this->appointments
        ]);

    }
}
