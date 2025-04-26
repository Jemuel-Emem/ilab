<div>
    <!-- Display a list of approved patients -->
    <h3 class="text-xl font-semibold mb-4">Approved Appointments</h3>

    <div class="overflow-x-auto">
        <table id="printApprovedAppointments" class="min-w-full table-auto text-left border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border">User Name</th>
                    <th class="py-2 px-4 border">Appointment Date</th>
                    <th class="py-2 px-4 border">Service</th>
                    <th class="py-2 px-4 border">Lab Result</th>
                    <th class="py-2 px-4 border">Status</th>
                    <th class="py-2 px-4 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($approvedAppointments as $appointment)
                    <tr>
                        <td class="py-2 px-4 border">{{ $appointment->user->name }}</td>
                        <td class="py-2 px-4 border">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}</td>
                        <td class="py-2 px-4 border">{{ $appointment->service->name ?? 'N/A' }}</td>
                        <td class="py-2 px-4 border">@if($appointment->user->lab_result)
                            <a href="{{ asset('storage/' . $appointment->user->lab_result) }}" target="_blank" class="text-blue-600 hover:underline">
                                View Lab Result
                            </a>
                        @endif

                        </td>
                        <td class="py-2 px-4 border capitalize">{{ $appointment->status }}</td>
                        <td class="py-2 border flex space-x-2">
                            <button wire:click="editAppointment({{ $appointment->id }})" class="text-blue-600 hover:text-blue-700 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>

                            {{-- <button wire:click="deleteAppointment({{ $appointment->id }})" class=" text-red-600 px-3 py-1 rounded hover:text-red-700" onclick="confirm('Are you sure you want to delete this appointment?') || event.stopImmediatePropagation()">Delete</button> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Print Button -->
    <div class="flex justify-end mt-4">
        <button onclick="printApprovedAppointments()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Print Approved Appointments
        </button>
    </div>

    <!-- Modal for Editing -->
  <!-- Modal for Editing -->
@if($editing)
<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-[600px] overflow-y-auto max-h-screen">


        <!-- Appointment Date -->
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Appointment Date</label>
            <input type="date" wire:model="appointment_date" class="w-full p-2 border rounded">
        </div>

        <hr class="my-4">

        <h3 class="text-lg font-semibold mb-2">Patient Info</h3>

        <!-- 2 columns -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm mb-1">Phone Number</label>
                <input type="text" wire:model="phone_number" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-sm mb-1">Address</label>
                <textarea wire:model="address" class="w-full p-2 border rounded"></textarea>
            </div>

            <div>
                <label class="block text-sm mb-1">Age</label>
                <input type="number" wire:model="age" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-sm mb-1">Gender</label>
                <select wire:model="gender" class="w-full p-2 border rounded">
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div>
                <label class="block text-sm mb-1">Height (cm)</label>
                <input type="number" wire:model="height" class="w-full p-2 border rounded" step="0.1">
            </div>

            <div>
                <label class="block text-sm mb-1">Weight (kg)</label>
                <input type="number" wire:model="weight" class="w-full p-2 border rounded" step="0.1">
            </div>

            <div>
                <label class="block text-sm mb-1">Blood Pressure</label>
                <input type="text" wire:model="blood_pressure" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-sm mb-1">Temperature (°C)</label>
                <input type="number" wire:model="temperature" class="w-full p-2 border rounded" step="0.1">
            </div>

            <div class="col-span-2">
                <label class="block text-sm mb-1">Upload Lab Result (PDF or Image)</label>
                <input type="file" wire:model="lab_result" class="w-full p-2 border rounded" accept="application/pdf,image/*">
                @error('lab_result') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

        </div>

        <!-- Buttons -->
        <div class="flex justify-end space-x-2 mt-6">
            <button wire:click="updateAppointment" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
            <button wire:click="$set('editing', false)" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
        </div>
    </div>
</div>

@endif

    <!-- Print Styles -->
    <style>
        @media print {
            /* Hide everything except the table */
            body * {
                visibility: hidden;
            }
            #printApprovedAppointments, #printApprovedAppointments * {
                visibility: visible;
            }

            /* Table formatting */
            table {
                width: 100%;
                border-collapse: collapse;
            }

            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #f3f3f3;
                font-weight: bold;
            }

            @page {
                margin: 1cm;
            }

            body {
                margin: 0;
            }
        }
    </style>

    <!-- Print Function -->
    <script>
        function printApprovedAppointments() {
            const originalContent = document.body.innerHTML;
            const printContent = document.getElementById('printApprovedAppointments').outerHTML;
            const header = "<h3>Approved Appointments</h3>";

            document.body.innerHTML = header + printContent;
            window.print();
            document.body.innerHTML = originalContent;
            location.reload();
        }
    </script>
</div>
