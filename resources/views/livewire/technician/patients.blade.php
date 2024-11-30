<div>
    <!-- Display a list of approved patients -->
    <h3 class="text-xl font-semibold mb-4">Approved Appointments</h3>

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto text-left border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border">User Name</th>
                    <th class="py-2 px-4 border">Appointment Date</th>
                    <th class="py-2 px-4 border">Service</th>
                    <th class="py-2 px-4 border">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($approvedAppointments as $appointment)
                    <tr>
                        <td class="py-2 px-4 border">{{ $appointment->user->name }}</td>
                        <td class="py-2 px-4 border">{{ $appointment->appointment_date }}</td>
                        <td class="py-2 px-4 border">{{ $appointment->service->name }}</td>
                        <td class="py-2 px-4 border">{{ $appointment->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
