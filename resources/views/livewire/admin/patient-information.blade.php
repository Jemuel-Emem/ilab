<div class="p-6">
    <h2 class="text-3xl font-bold text-blue-600 mb-6">Patient Information</h2>

    @if ($patients->isEmpty())
        <div class="text-center text-gray-500 py-6">
            <i class="ri-user-line text-4xl mb-2"></i>
            <p class="text-lg">No patient information available.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
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
                            <!-- Name -->
                            <td class="px-4 py-2 text-gray-800">
                                <i class="ri-user-line text-gray-500 mr-2"></i>
                                {{ $patient->name }}
                            </td>

                            <!-- Email -->
                            <td class="px-4 py-2 text-gray-600">
                                <i class="ri-mail-line text-gray-500 mr-2"></i>
                                {{ $patient->email }}
                            </td>

                            <!-- Phone -->
                            <td class="px-4 py-2 text-gray-600">
                                <i class="ri-phone-line text-gray-500 mr-2"></i>
                                {{ $patient->phone ?? 'N/A' }}
                            </td>

                            <!-- Address -->
                            <td class="px-4 py-2 text-gray-600">
                                <i class="ri-map-pin-line text-gray-500 mr-2"></i>
                                {{ $patient->address ?? 'N/A' }}
                            </td>

                            <!-- Registered On -->
                            <td class="px-4 py-2 text-gray-600">
                                <i class="ri-calendar-line text-gray-500 mr-2"></i>
                                {{ \Carbon\Carbon::parse($patient->created_at)->format('F d, Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
