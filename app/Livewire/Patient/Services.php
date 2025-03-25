<?php

namespace App\Livewire\Patient;

use App\Models\Service;
use App\Models\Appointment; // Import the Appointment model
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use Livewire\Component;

class Services extends Component
{
    use Actions;
    use WithPagination;

    public $search = ''; // Search term
    public $category = ''; // Selected category
    public $showModal = false; // Modal visibility
    public $selectedService = null; // Holds the selected service details
    public $appointmentDate = ''; // Appointment date field
    public $appointmentTime = '';
    public $notes = ''; // Additional notes for the appointment

    public function sasa()
    {
        $this->resetPage();
    }

    public function selectService($serviceId)
    {
        $this->selectedService = Service::find($serviceId); // Fetch selected service
        $this->showModal = true; // Show the modal
    }

    public function closeModal()
    {
        $this->showModal = false; // Hide the modal
        $this->selectedService = null; // Reset selected service
        $this->appointmentDate = ''; // Reset appointment date
        $this->notes = ''; // Reset notes field
        $this->appointmentTime = '';
    }

    public function bookAppointment()
    {
        // Validate input fields
        $this->validate([
            'appointmentDate' => 'required|date',
            'appointmentTime' => 'required',
            'notes' => 'nullable|string|max:500',
        ]);

        // Create an appointment
        Appointment::create([
            'user_id' => auth()->id(), // Ensure the user is logged in
            'service_id' => $this->selectedService->id,
            'appointment_date' => $this->appointmentDate,
            'appointment_time' => $this->appointmentTime,
            'notes' => $this->notes,
        ]);

        // Close the modal and reset the fields
        $this->closeModal();

        $this->dialog([
            'title'       => 'Appointment Booked',
            'description' => 'Your appointment has been successfully booked.',
            'icon'        => 'success',
        ]);

    }

    public function render()
    {
        $search = '%' . $this->search . '%';

        // Fetch services based on search term and category filter
        $services = Service::query()
            ->when($this->category, function ($query) {
                return $query->where('category', $this->category);
            })
            ->where('name', 'like', $search)
            ->paginate(9);

        // Fetch available categories for the filter
        $categories = Service::distinct()->pluck('category');

        return view('livewire.patient.services', [
            'services' => $services,
            'categories' => $categories,
        ]);
    }
}
