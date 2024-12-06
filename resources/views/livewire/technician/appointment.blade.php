<div>
    <!-- Display Flash Message if available -->
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-3 mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Table displaying appointments -->
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto text-left border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border">User Name</th>
                    <th class="py-2 px-4 border">Appointment Date</th>
                    <th class="py-2 px-4 border">Service</th>
                    <th class="py-2 px-4 border">Status</th>
                    <th class="py-2 px-4 border">Payment Status</th>
                    <th class="py-2 px-4 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <td class="py-2 px-4 border">{{ $appointment->user->name }}</td> <!-- Display User Name -->
                        <td class="py-2 px-4 border">{{ $appointment->appointment_date }}</td>
                        <td class="py-2 px-4 border">{{ $appointment->service->name }}</td> <!-- Display Service Name -->
                        <td class="py-2 px-4 border">{{ $appointment->status }}</td>
                        <td class="py-2 px-4 border">{{ $appointment->payment_status }}</td>
                        <td class="py-2 px-4 border">

                            @if ($appointment->status !== 'approved' && $appointment->status !== 'declined')
                                <button wire:click="approve({{ $appointment->id }})" class="px-4 py-2 bg-green-500 text-white rounded">
                                    Approve
                                </button>

                                <button wire:click="decline({{ $appointment->id }})" class="px-4 py-2 bg-red-500 text-white rounded">
                                    Decline
                                </button>
                            @else
                                <!-- Display "Done" status after action -->
                                <span class="text-sm text-gray-500">Done</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
