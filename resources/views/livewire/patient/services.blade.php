<div class="p-6">
    <div class="max-w-9xl mx-auto">


        <div class="mb-6 flex items-center justify-between space-x-4">
            <select wire:model="category" class="px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 w-64 text-gray-800 font-medium transition duration-300 ease-in-out hover:border-cyan-400">
                <option value="">Select Category</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat }}" class="text-gray-800">{{ $cat }}</option>
                @endforeach
            </select>


            <div class="flex space-x-2 w-full md:w-3/4 lg:w-2/3">
                <input
                    type="text"
                    wire:model="search"
                    class="px-4 py-3 border border-gray-300 rounded-lg shadow-sm w-full focus:outline-none focus:ring-2 focus:ring-cyan-500 transition duration-300 ease-in-out"
                    placeholder="Search services by name...">

                <button
                    wire:click="sasa"
                    class="px-6 py-3 w-full sm:w-32 bg-gradient-to-r from-cyan-600 to-teal-500 text-white rounded-lg hover:bg-teal-600 focus:outline-none transition duration-300 ease-in-out">
                    Search
                </button>
            </div>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-8">
            @foreach ($services as $service)
                <div class="bg-white shadow-xl w-80 rounded-lg overflow-hidden hover:shadow-2xl transform hover:scale-105 transition duration-300 ease-in-out">
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


        <div class="mt-6 text-center">
            {{ $services->links() }}
        </div>

    </div>
</div>
