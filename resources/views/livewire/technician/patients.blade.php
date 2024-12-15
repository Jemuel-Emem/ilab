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

    <!-- Print Button -->
    <div class="flex justify-end mt-4">
        <button onclick="printApprovedAppointments()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Print Approved Appointments
        </button>
    </div>

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

            /* Add Header */
            h3 {
                visibility: visible;
                font-size: 20px;
                font-weight: bold;
                text-align: center;
                margin-bottom: 10px;
            }

            /* Table formatting for print */
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

            /* Page margins */
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

            // Get the table content and add a header
            const printContent = document.getElementById('printApprovedAppointments').outerHTML;
            const header = "<h3>Approved Appointments</h3>";

            // Replace body content for printing
            document.body.innerHTML = header + printContent;
            window.print();

            // Restore original content
            document.body.innerHTML = originalContent;
            location.reload();
        }
    </script>
</div>
