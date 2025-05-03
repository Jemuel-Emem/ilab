<div>
    <div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($appointments as $appointment)
                <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 cursor-pointer" wire:click="selectAppointment({{ $appointment->id }})">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Appointment Details</h2>

                    <div class="mb-2">
                        <strong class="text-gray-600">Service:</strong>
                        <span class="text-gray-800">{{ $appointment->service->name ?? 'N/A' }}</span>
                    </div>

                    <div class="mb-2">
                        <strong class="text-gray-600">User:</strong>
                        <span class="text-gray-800">{{ $appointment->user->name ?? 'N/A' }}</span>
                    </div>

                    <div class="mb-2">
                        <strong class="text-gray-600">Appointment Date:</strong>
                        <span class="text-gray-800">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F j, Y') }}</span>
                    </div>

                    <div class="mb-2">
                        <strong class="text-gray-600">Payment Status:</strong>
                        <span class="text-green-600">{{ ucfirst($appointment->payment_status) }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Modal -->
        @if($selectedAppointment)
            <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Appointment Details</h2>

                    @if($selectedAppointment)
                        <div class="mb-2">
                            <strong class="text-gray-600">Service:</strong>
                            <span class="text-gray-800">{{ $selectedAppointment->service->name ?? 'N/A' }}</span>
                        </div>

                        <div class="mb-2">
                            <strong class="text-gray-600">Price:</strong>
                            <span class="text-gray-800">{{ $selectedAppointment->service->price ?? 'N/A' }}</span>
                        </div>

                        <div class="mb-2">
                            <strong class="text-gray-600">User:</strong>
                            <span class="text-gray-800">{{ $selectedAppointment->user->name ?? 'N/A' }}</span>
                        </div>

                        <div class="mb-2">
                            <strong class="text-gray-600">Appointment Date:</strong>
                            <span class="text-gray-800">{{ \Carbon\Carbon::parse($selectedAppointment->appointment_date)->format('F j, Y') }}</span>
                        </div>

                        <div class="mb-2">
                            <strong class="text-gray-600">Payment Status:</strong>
                            <span class="text-green-600">{{ ucfirst($selectedAppointment->payment_status) }}</span>
                        </div>
                    @endif

                    <!-- Buttons -->
                    <div class="flex justify-end mt-4">
                        {{-- <button wire:click="markAsPaid" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                            Paid Now
                        </button> --}}

                        @if($selectedAppointment->payment_status != 'paid')
                        <button
                        onclick="markAsPaidAndPrintReceipt(
                            '{{ $selectedAppointment->user->name ?? 'N/A' }}',
                            '{{ $selectedAppointment->service->name ?? 'N/A' }}',
                            '{{ \Carbon\Carbon::parse($selectedAppointment->appointment_date)->format('F j, Y') }}'
                        )"
                         wire:click="markAsPaid"
                        class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                        Paid Now
                    </button>
                    @else
                        <button disabled class="bg-gray-400 text-white px-4 py-2 rounded-lg cursor-not-allowed">
                            Already Paid
                        </button>
                    @endif
                        <button
                        onclick="printCertificate(
                            '{{ $selectedAppointment->user->name ?? 'N/A' }}',
                            '{{ $selectedAppointment->service->name ?? 'N/A' }}',
                            '{{ $selectedAppointment->appointment_date ? \Carbon\Carbon::parse($selectedAppointment->appointment_date)->format('F j, Y') : 'N/A' }}'

                        )"
                        class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                        Print Certificate
                    </button>
                        <button wire:click="closeModal" class="ml-2 bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <script>
            function printCertificate(userName, serviceName, appointmentDate) {
                const certificateContent = `
                    <div style="font-family: Arial, sans-serif; padding: 50px; max-width: 800px; margin: auto;">
                        <div style="text-align: center;">
                            <img src="{{ asset('images/logo.png') }}" alt="Header" style="width: 20%; margin-bottom: 20px;">
                            <h2 style="font-size: 24px; margin-bottom: 20px;">MEDICAL CERTIFICATE</h2>
                        </div>

                        <p>Date: ${new Date().toLocaleDateString()}</p>
                        <br>
                        <p>To whom it may concern:</p>

                        <p style="text-align: justify; margin-top: 10px;">
                            This is to certify that <strong>${userName}</strong>, presently residing has undergone a thorough medical examination conducted at
                            <strong>iLAB DIAGNOSTIC LABORATORY, ISULAN SULTAN KUDARAT, PHILIPPINES</strong> on <strong>${appointmentDate}</strong>, and is currently suffering from <strong>${serviceName}</strong>.
                        </p>

                        <br>
                        <p><strong>REMARKS:</strong></p>
                        <p style="text-align: justify;">
                            The examiner has advised that, for the sake of the individual's overall health, he/she should be allowed absence from his/her company duties for a period of _ days.
                        </p>

                        <br><br><br>
                        <p style="font-size: 12px; color: gray;">
                            This document is issued upon request above mentioned individual for whatever purposes it may serve. However, this could not be used in any Medico-legal case and/or any court of law in the Philippines.
                        </p>

                        <br><br>
                        <p style="text-align: right;">
                            <strong>ILAB</strong><br>
                            Lic No: _______<br>
                            PTR No: _______
                        </p>
                    </div>
                `;

                const printWindow = window.open('', '_blank');
                printWindow.document.write(certificateContent);
                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
                printWindow.close();
            }




            </script>
<script>
      function markAsPaidAndPrintReceipt(userName, serviceName, appointmentDate) {
        alert('Payment marked as paid successfully.'); // Optional confirmation

        const currentDate = new Date().toLocaleDateString();

const receiptContent = `
    <div style="font-family: Arial, sans-serif; padding: 40px; text-align: center;">
        <img src="{{ asset('images/logo.png') }}" alt="ILAB Logo" style="width: 100px; margin-bottom: 20px;">
        <h2 style="margin-bottom: 5px;">ILAB DIAGNOSTIC LABORATORY</h2>
        <p style="margin: 0; font-size: 14px;">Magbanua St, Kalawag I, Isulan Sultan Kudarat</p>
        <p style="margin: 0 0 20px 0; font-size: 14px;">Official Receipt</p>
        <hr style="margin: 20px 0;">

        <p><strong>Receipt Date:</strong> ${currentDate}</p>
        <p><strong>Name:</strong> ${userName}</p>
        <p><strong>Service:</strong> ${serviceName}</p>
        <p><strong>Appointment Date:</strong> ${appointmentDate}</p>
        <p><strong>Status:</strong> <span style="color: green;">Paid</span></p>

        <hr style="margin: 20px 0;">
        <p style="font-size: 12px; color: gray;">Thank you for your payment!</p>
        <p style="font-size: 11px; color: gray;">This receipt serves as official proof of your transaction with ILAB.</p>
    </div>
`;

const printWindow = window.open('', '_blank');
printWindow.document.write(receiptContent);
printWindow.document.close();
printWindow.focus();
printWindow.print();
printWindow.close();

        // Optional: if you want to close modal or update UI, do it manually here
        // e.g., window.location.reload();
    }
</script>

    </div>


</div>
