<?php

namespace App\Livewire\Patient;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class Services extends Component
{
    use WithPagination;
    public $category = '';
    public $search = '';

    protected $paginationTheme = 'tailwind';


    public function sasa()
    {


    }


    public function resetSearch()
    {
        $this->search = '';
        $this->resetPage();
    }

    public function render()
    {

        $services = Service::where('name', 'like', '%' . $this->search . '%')
            ->where('category', 'like', '%' . $this->category . '%')
            ->paginate(5);


        $categories = Service::distinct()->pluck('category');

        return view('livewire.patient.services', compact('services', 'categories'));
    }

}
