<div class="p-6">
    <h2 class="text-3xl font-bold text-orange-500 mb-6">My Medical History</h2>

    @if ($appointments->isEmpty())
        <div class="text-center text-gray-500 py-6">
            <i class="ri-file-list-line text-4xl mb-2"></i>
            <p class="text-lg">You have no medical history recorded.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($appointments as $appointment)
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow border">
                    <!-- Service Name -->
                    <h3 class="text-xl font-bold text-gray-800 mb-2">
                        <i class="ri-stethoscope-line text-gray-500 mr-2"></i>
                        {{ $appointment->service->name ?? 'Service Not Specified' }}
                    </h3>

                    <!-- Appointment Date -->
                    <p class="text-gray-600 mb-2">
                        <i class="ri-calendar-line text-gray-500 mr-2"></i>
                        <strong>Date:</strong>
                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y h:i A') }}
                    </p>

                    {{-- <!-- Price -->
                    <p class="text-gray-600 mb-2">
                        <i class="ri-money-dollar-circle-line text-gray-500 mr-2"></i>
                        <strong>Price:</strong>
                        ${{ number_format($appointment->service->price ?? 0, 2) }}
                    </p> --}}

                    {{-- <!-- Status -->
                    <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                        {{ $appointment->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $appointment->status === 'declined' ? 'bg-red-100 text-red-800' : '' }}">
                        {{ ucfirst($appointment->status) }}
                    </span> --}}
                </div>
            @endforeach
        </div>
    @endif
</div>
