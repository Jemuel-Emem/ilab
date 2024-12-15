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
                                    <i class="ri-phone-line text-gray-500 mr-2"></i>{{ $patient->phone ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-2 text-gray-600">
                                    <i class="ri-map-pin-line text-gray-500 mr-2"></i>{{ $patient->address ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-2 text-gray-600">
                                    <i class="ri-calendar-line text-gray-500 mr-2"></i>
                                    {{ \Carbon\Carbon::parse($patient->created_at)->format('F d, Y') }}
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
</div>
