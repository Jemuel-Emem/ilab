<div x-data="{ openModal: false }" class="p-6 bg-gray-50 min-h-screen">
    <!-- Container -->
    <div class="max-w-6xl mx-auto bg-white shadow rounded-lg p-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Services</h1>
            <button
                @click="openModal = true; @this.resetFields()"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                Add Service
            </button>
        </div>

        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('message') }}
            </div>
        @endif

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse border border-gray-200">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 font-medium">Service Name</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 font-medium">Price</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 font-medium">Category</th>
                        <th class="border border-gray-300 px-4 py-2 text-center text-gray-600 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2">{{ $service->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">${{ number_format($service->price, 2) }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $service->category }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <button
                                    @click="openModal = true; @this.editService({{ $service->id }})"
                                    class="text-blue-500 hover:underline">
                                    Edit
                                </button>
                                <button
                                    wire:click="deleteService({{ $service->id }})"
                                    class="text-red-500 hover:underline ml-4">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $services->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div
        x-show="openModal"
        x-cloak
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">
                {{ $isEditMode ? 'Edit Service' : 'Add Service' }}
            </h2>
            <form wire:submit.prevent="{{ $isEditMode ? 'updateService' : 'addService' }}">
                <!-- Service Name -->
                <div class="mb-4">
                    <label for="serviceName" class="block text-sm font-medium text-gray-700">Service Name</label>
                    <input
                        type="text"
                        id="serviceName"
                        wire:model="serviceName"
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Enter service name" />
                    @error('serviceName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <!-- Price -->
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input
                        type="number"
                        id="price"
                        wire:model="price"
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Enter price" />
                    @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <select
                        id="category"
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        wire:model="category">
                        <option value="">Select Category</option>
                        <option value="Hematology">Hematology</option>
                        <option value="Serology">Serology</option>
                        <option value="Clinical Microscopy">Clinical Microscopy</option>
                        <option value="Immunology">Immunology</option>
                        <option value="Clinical Chemistry">Clinical Chemistry</option>
                    </select>
                </div>
                <!-- Buttons -->
                <div class="flex justify-end">
                    <button
                        type="button"
                        @click="openModal = false"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 mr-2">
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        {{ $isEditMode ? 'Update' : 'Add' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
