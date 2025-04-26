<div class="p-6">
    <h2 class="text-3xl font-bold text-orange-500 mb-6">My Appointments</h2>

    @if ($appointments->isEmpty())
        <div class="text-center text-gray-500 py-6">
            <i class="ri-calendar-line text-4xl mb-2"></i>
            <p class="text-lg">You have no appointments scheduled.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($appointments as $appointment)
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow border">
                    <!-- Service Name -->
                    <h3 class="text-xl font-bold text-gray-800 mb-2">
                        {{ $appointment->service->name }}
                    </h3>

                    <!-- Appointment Date -->
                    <p class="text-gray-600 mb-2">
                        <i class="ri-calendar-line text-gray-500 mr-2"></i>
                        <strong>Date:</strong>
                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y h:i A') }}
                    </p>

                    <p class="text-gray-600 mb-2">
                        <i class="ri-time-line text-gray-500 mr-2"></i>
                        <strong>Time:</strong>
                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                    </p>

                    <!-- Lab Result -->

                    <!-- Notes -->
                    <p class="text-gray-600 mb-4">
                        <i class="ri-file-text-line text-gray-500 mr-2"></i>
                        <strong>Price:</strong>
                        {{ $appointment->service->price }}
                    </p>
                    @if($appointment->user->lab_result)
                    <div class="mt-4">
                        <a href="{{ asset('storage/' . $appointment->user->lab_result) }}" target="_blank"
                            class="inline-block text-blue-600 hover:underline text-sm">
                            <i class="ri-file-search-line mr-1"></i> View Lab Result
                        </a>
                    </div>
                    @endif
                    <!-- Status -->
                    <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                        {{ $appointment->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $appointment->status === 'declined' ? 'bg-red-100 text-red-800' : '' }}">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </div>
            @endforeach
        </div>
    @endif
</div>
