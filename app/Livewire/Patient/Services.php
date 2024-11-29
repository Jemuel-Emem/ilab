<?php

namespace App\Livewire\Patient;

use App\Models\Service;
use Livewire\Component;

class Services extends Component
{
    public function render()
    {
        $services = Service::paginate(5);

       // $services = Service::all();
        return view('livewire.patient.services', compact('services'));
    }
}
