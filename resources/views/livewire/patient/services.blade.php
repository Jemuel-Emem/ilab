<div class="p-6">
    <div class="max-w-9xl mx-auto">

        <!-- Search and Category Filters -->
        <div class="mb-6 flex items-center justify-between space-x-4">
            <select wire:model="category" class="px-4 py-3 border border-gray-300 rounded-lg shadow-sm">
                <option value="">Select Category</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat }}">{{ $cat }}</option>
                @endforeach
            </select>

            <div class="flex space-x-2 w-full md:w-3/4 lg:w-2/3">
                <input
                    type="text"
                    wire:model="search"
                    class="px-4 py-3 border border-gray-300 rounded-lg shadow-sm w-full"
                    placeholder="Search services by name..."
                >
                <button
                    wire:click="sasa"
                    class="px-6 py-3 w-full sm:w-32 bg-gradient-to-r from-cyan-600 to-teal-500 text-white rounded-lg">
                    Search
                </button>
            </div>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-8">
            @foreach ($services as $service)
                <div
                    class="bg-white shadow-xl w-80 rounded-lg overflow-hidden hover:shadow-2xl transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer"
                    wire:click="selectService({{ $service->id }})">
                    <div class="relative h-56 bg-cover bg-center" style="background-image: url('{{ asset('images/logo.png') }}');">
                        <div class="absolute inset-0 bg-black opacity-30"></div>
                    </div>
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $service->name }}</h2>
                        <p class="text-lg text-gray-600 mb-4">
                            <span class="font-bold text-green-600">Price:</span> ${{ number_format($service->price, 2) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if ($services->isEmpty())
            <div class="text-center text-gray-600 mt-10">
                <p>No services match your search criteria. Please try a different keyword.</p>
            </div>
        @endif

        <!-- Pagination -->
        <div class="mt-6 text-center">
            {{ $services->links() }}
        </div>
    </div>

    <!-- Appointment Modal -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white w-1/2 p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-800">Book Appointment</h2>
                    <button wire:click="closeModal" class="text-gray-500 hover:text-gray-800">
                        &times;
                    </button>
                </div>
                <form wire:submit.prevent="bookAppointment">
                    @if ($selectedService)
                        <p class="text-gray-700 mb-2"><strong>Service:</strong> {{ $selectedService->name }}</p>
                        <p class="text-gray-700 mb-4"><strong>Price:</strong> ${{ number_format($selectedService->price, 2) }}</p>
                    @endif
                    <!-- Form Fields -->
                    <div class="mb-4">
                        <label for="date" class="block text-gray-700 font-medium">Select Date</label>
                        <input
                            type="date"
                            id="date"
                            wire:model.defer="appointmentDate"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="notes" class="block text-gray-700 font-medium">Additional Notes</label>
                        <textarea
                            id="notes"
                            wire:model.defer="appointmentNotes"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                            rows="4">
                        </textarea>
                    </div>
                    <div class="text-right">
                        <button
                            type="submit"
                            class="px-6 py-3 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700">
                            Confirm Appointment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
