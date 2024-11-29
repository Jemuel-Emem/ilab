<?php

namespace App\Livewire\Patient;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceOffer extends Component
{
    use WithPagination;

    public $search = ''; // The search query

    // To reset pagination when the search term changes
    protected $paginationTheme = 'tailwind';

    public function render()
    {
        // Query services based on search input
        $services = Service::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->paginate(5);

        return view('livewire.patient.service-offer', compact('services'));
    }

    // Method to reset the search input (optional, if you want to add a reset button)
    // public function resetSearch()
    // {
    //     $this->search = '';
    //     $this->resetPage(); // Reset pagination when search is cleared
    // }

    public function search(){
        dd("asasa");
    }
}
