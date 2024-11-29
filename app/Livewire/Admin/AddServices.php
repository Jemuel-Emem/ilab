<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class AddServices extends Component
{
    use WithPagination;

    public $serviceName;
    public $price;
    public $serviceId;
    public $isEditMode = false;

    protected $rules = [
        'serviceName' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
    ];

    public function resetFields()
    {
        $this->serviceName = '';
        $this->price = '';
        $this->serviceId = null;
        $this->isEditMode = false;
    }

    public function addService()
    {
        $this->validate();

        Service::create([
            'name' => $this->serviceName,
            'price' => $this->price,
        ]);

        session()->flash('message', 'Service added successfully!');
        $this->resetFields();
    }

    public function editService($id)
    {
        $service = Service::findOrFail($id);
        $this->serviceId = $service->id;
        $this->serviceName = $service->name;
        $this->price = $service->price;
        $this->isEditMode = true;
    }

    public function updateService()
    {
        $this->validate();

        $service = Service::findOrFail($this->serviceId);
        $service->update([
            'name' => $this->serviceName,
            'price' => $this->price,
        ]);

        session()->flash('message', 'Service updated successfully!');
        $this->resetFields();
    }

    public function deleteService($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        session()->flash('message', 'Service deleted successfully!');
    }

    public function render()
    {
        $services = Service::paginate(10);
        return view('livewire.admin.add-services', compact('services'));
    }
}
