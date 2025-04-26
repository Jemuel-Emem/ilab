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
                    <button wire:click="markAsPaid" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
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
        function printCertificate(userName, serviceName, appointmentDate, paymentStatus) {
            const certificateContent = `
                <div id="certificate" style="text-align: center; font-family: Arial, sans-serif; padding: 20px;">
                    <h1 style="font-size: 30px; font-weight: bold;">Certificate of Appointment</h1>
                    <p style="margin-top: 20px;">This is to certify that <strong>${userName || 'N/A'}</strong> has an appointment for the service <strong>${serviceName || 'N/A'}</strong> on <strong>${appointmentDate || 'N/A'}</strong>.</p>

                    <p style="margin-top: 60px;">Authorized Signature</p>
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

</div>

