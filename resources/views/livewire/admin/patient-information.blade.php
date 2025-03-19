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
                                <td class="px-4 py-2 text-gray-800">
                                    <i class="ri-user-line text-gray-500 mr-2"></i>{{ $patient->name }}
                                </td>
                                <td class="px-4 py-2 text-gray-600">
                                    <i class="ri-mail-line text-gray-500 mr-2"></i>{{ $patient->email }}
                                </td>
                                <td class="px-4 py-2 text-gray-600">
                                    <i class="ri-phone-line text-gray-500 mr-2"></i>{{ $patient->phone_number ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-2 text-gray-600">
                                    <i class="ri-map-pin-line text-gray-500 mr-2"></i>{{ $patient->address ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-2 text-gray-600">
                                    <i class="ri-calendar-line text-gray-500 mr-2"></i>
                                    {{ \Carbon\Carbon::parse($patient->created_at)->format('F d, Y') }}
                                </td>

                                <td class="px-4 py-2 text-center">
                                    <button wire:click="editPatient({{ $patient->id }})"
                                        class="text-blue-500 hover:underline">
                                        Edit
                                    </button>
                                    <button wire:click="deletePatient({{ $patient->id }})"
                                        class="text-red-500 hover:underline ml-4">
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
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" wire:model="name"
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Enter name">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" wire:model="email"
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Enter email">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" id="phone" wire:model="phone_number"
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Enter phone">
                @error('phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" id="address" wire:model="address"
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Enter address">
                @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end">
                <button type="button" @click="$wire.isEditMode = false"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 mr-2">
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
