<?php

namespace App\Livewire\Technician;
use WireUi\Traits\Actions;
use App\Models\Appointment as ap;
use Livewire\Component;

class Appointment extends Component
{
    use Actions;

    public $appointments;


    public function mount()
    {
        $this->appointments = ap::with('user', 'service')->get();
    }


    public function approve($appointmentId)
    {
        $appointment = ap::find($appointmentId);
        if ($appointment) {
            $appointment->update(['status' => 'approved']);
            $this->appointments =ap::with('user', 'service')->get();


            $this->dialog()->success(
                'Appointment Approved',
                'The appointment has been successfully approved.'
            );
        } else {

            $this->dialog()->error(
                'Appointment Not Found',
                'This appointment could not be found.'
            );
        }
    }


    public function decline($appointmentId)
    {
        $appointment = ap::find($appointmentId);
        if ($appointment) {
            $appointment->update(['status' => 'declined']);
            $this->appointments = ap::with('user', 'service')->get();


            $this->dialog()->success(
                'Appointment Declined',
                'The appointment has been successfully declined.'
            );
        } else {

            $this->dialog()->error(
                'Appointment Not Found',
                'This appointment could not be found.'
            );
        }
    }

    public function render()
    {
        return view('livewire.technician.appointment');
    }
}
