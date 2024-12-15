<div>
    <!-- Display Flash Message if available -->
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-3 mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Table displaying appointments -->
    <div class="overflow-x-auto">
        <table id="printTable" class="min-w-full table-auto text-left border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border">User Name</th>
                    <th class="py-2 px-4 border">Appointment Date</th>
                    <th class="py-2 px-4 border">Service</th>
                    <th class="py-2 px-4 border">Status</th>
                    <th class="py-2 px-4 border">Payment Status</th>
                    <th class="py-2 px-4 border no-print">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <td class="py-2 px-4 border">{{ $appointment->user->name }}</td>
                        <td class="py-2 px-4 border">{{ $appointment->appointment_date }}</td>
                        <td class="py-2 px-4 border">{{ $appointment->service->name }}</td>
                        <td class="py-2 px-4 border">{{ $appointment->status }}</td>
                        <td class="py-2 px-4 border">{{ $appointment->payment_status }}</td>
                        <td class="py-2 px-4 border no-print">
                            @if ($appointment->status !== 'approved' && $appointment->status !== 'declined')
                                <button wire:click="approve({{ $appointment->id }})" class="px-4 py-2 bg-green-500 text-white rounded">
                                    Approve
                                </button>

                                <button wire:click="decline({{ $appointment->id }})" class="px-4 py-2 bg-red-500 text-white rounded">
                                    Decline
                                </button>
                            @else
                                <span class="text-sm text-gray-500">Done</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Print Button -->
    <div class="flex justify-end mt-4">
        <button onclick="printTable()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Print Appointments
        </button>
    </div>

    <!-- Print Styles -->
    <style>
        @media print {
            /* Hide everything except the table */
            body * {
                visibility: hidden;
            }
            #printTable, #printTable * {
                visibility: visible;
            }
            #printTable .no-print {
                display: none !important; /* Hide the "Actions" column */
            }

            /* Optional Print Table Formatting */
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
            }
            th {
                background-color: #f3f3f3;
                font-weight: bold;
                text-align: left;
            }

            /* Page Margins */
            @page {
                margin: 1cm;
            }

            h2 {
                text-align: center;
                font-size: 20px;
                margin-bottom: 10px;
            }
        }
    </style>

    <!-- Print Functionality -->
    <script>
        function printTable() {
            const originalContent = document.body.innerHTML;

            // Capture the table content with a header
            const printContent = document.getElementById('printTable').outerHTML;
            const header = "<h2>Appointments Report</h2>";

            // Replace content for printing
            document.body.innerHTML = header + printContent;
            window.print();

            // Restore original page content
            document.body.innerHTML = originalContent;
            location.reload();
        }
    </script>
</div>
