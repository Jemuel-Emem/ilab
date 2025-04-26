<div>
    <div class="p-6">
        <h2 class="text-3xl font-bold text-blue-600 mb-6">Patient Information</h2>

        @if ($patients->isEmpty())
            <!-- No Data Section -->
            <div class="text-center text-gray-500 py-6">
                <i class="ri-user-line text-4xl mb-2"></i>
                <p class="text-lg">No patient information available.</p>
            </div>
        @else
            <!-- Patient Table -->
            <div class="overflow-x-auto">
                <table id="printPage" class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">Age</th>
                            <th class="px-4 py-2 text-left">Gender</th>
                            <th class="px-4 py-2 text-left">Height (cm)</th>
                            <th class="px-4 py-2 text-left">Weight (kg)</th>
                            <th class="px-4 py-2 text-left">Blood Pressure</th>
                            <th class="px-4 py-2 text-left">Temperature (°C)</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Phone</th>
                            <th class="px-4 py-2 text-left">Address</th>
                            <th class="px-4 py-2 text-left">Registered On</th>
                            <th class="px-4 py-2 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patients as $patient)
                            <tr class="hover:bg-gray-100 transition-colors border-b">
                                <td class="px-4 py-2">{{ $patient->name }}</td>
                                <td class="px-4 py-2">{{ $patient->age ?? 'N/A' }}</td>
                                <td class="px-4 py-2">{{ $patient->gender ?? 'N/A' }}</td>
                                <td class="px-4 py-2">{{ $patient->height ?? 'N/A' }}</td>
                                <td class="px-4 py-2">{{ $patient->weight ?? 'N/A' }}</td>
                                <td class="px-4 py-2">{{ $patient->blood_pressure ?? 'N/A' }}</td>
                                <td class="px-4 py-2">{{ $patient->temperature ?? 'N/A' }}</td>
                                <td class="px-4 py-2">{{ $patient->email }}</td>
                                <td class="px-4 py-2">{{ $patient->phone_number ?? 'N/A' }}</td>
                                <td class="px-4 py-2">{{ $patient->address ?? 'N/A' }}</td>
                                <td class="px-4 py-2">
                                    {{ \Carbon\Carbon::parse($patient->created_at)->format('F d, Y') }}
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <button wire:click="editPatient({{ $patient->id }})" class="text-blue-500 hover:underline">
                                        Edit
                                    </button>
                                    <button wire:click="deletePatient({{ $patient->id }})" class="text-red-500 hover:underline ml-4">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Print Button -->
                <div class="flex justify-end mb-4 mt-4">
                    <button
                        onclick="printOnlyTable()"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                        Print Patient Information
                    </button>
                </div>
            </div>
        @endif
    </div>

    <!-- Print Styles -->
    <style>
        @media print {
            /* Hide all content outside the table */
            body * {
                visibility: hidden;
            }

            /* Make only the table and header visible */
            #printPage, #printPage * {
                visibility: visible;
            }

            /* Adjust the table layout for print */
            #printPage {
                width: 100%;
                margin: 0 auto;
                border-collapse: collapse;
            }

            /* Add a clear page header */
            h2 {
                text-align: center;
                font-size: 20px;
                font-weight: bold;
                margin-bottom: 20px;
                visibility: visible;
            }

            /* Optional: Adjust page margins */
            @page {
                margin: 1cm;
            }

            /* Ensure no padding issues */
            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>

    <!-- Print Script -->
    <script>
        function printOnlyTable() {
            // Store original body content
            const originalContent = document.body.innerHTML;

            // Get table content to print
            const printContent = document.getElementById('printPage').outerHTML;

            // Add header to print content
            const header = "<h2>Patient Information</h2>";

            // Replace body content with table and header
            document.body.innerHTML = header + printContent;

            // Trigger the print function
            window.print();

            // Restore original content
            document.body.innerHTML = originalContent;

            // Reload scripts and styles
            location.reload();
        }
    </script>

<div x-show="$wire.isEditMode" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Edit Patient</h2>
        <form wire:submit.prevent="updatePatient">
            <div class="grid grid-cols-2 gap-4">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" wire:model="name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400" placeholder="Enter name">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Age -->
                <div>
                    <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                    <input type="number" id="age" wire:model="age" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400" placeholder="Enter age">
                    @error('age') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Gender -->
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select id="gender" wire:model="gender" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400">
                        <option value="">Select gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    @error('gender') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Height -->
                <div>
                    <label for="height" class="block text-sm font-medium text-gray-700">Height (cm)</label>
                    <input type="number" step="0.01" id="height" wire:model="height" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400" placeholder="Enter height">
                    @error('height') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Weight -->
                <div>
                    <label for="weight" class="block text-sm font-medium text-gray-700">Weight (kg)</label>
                    <input type="number" step="0.01" id="weight" wire:model="weight" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400" placeholder="Enter weight">
                    @error('weight') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Blood Pressure -->
                <div>
                    <label for="blood_pressure" class="block text-sm font-medium text-gray-700">Blood Pressure</label>
                    <input type="text" id="blood_pressure" wire:model="blood_pressure" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400" placeholder="Enter blood pressure">
                    @error('blood_pressure') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Temperature -->
                <div>
                    <label for="temperature" class="block text-sm font-medium text-gray-700">Temperature (°C)</label>
                    <input type="number" step="0.1" id="temperature" wire:model="temperature" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400" placeholder="Enter temperature">
                    @error('temperature') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" wire:model="email" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400" placeholder="Enter email">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="text" id="phone" wire:model="phone_number" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400" placeholder="Enter phone number">
                    @error('phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Address -->
                <div class="col-span-2">
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" id="address" wire:model="address" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400" placeholder="Enter address">
                    @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end mt-6">
                <button type="button" @click="$wire.isEditMode = false" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 mr-2">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

</div>
