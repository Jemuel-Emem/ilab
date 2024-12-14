<div class="p-6">
    <h2 class="text-3xl font-bold text-blue-600 mb-6">Daily Transactions</h2>

    @if ($transactions->isEmpty())
        <div class="text-center text-gray-500 py-6">
            <i class="ri-file-list-line text-4xl mb-2"></i>
            <p class="text-lg">No transactions available for today.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <!-- Table Header -->
                <thead class="bg-blue-600 text-white">
                    <tr>
                        {{-- <th class="px-4 py-2 text-left">Transaction ID</th> --}}
                        <th class="px-4 py-2 text-left">Patient</th>
                        <th class="px-4 py-2 text-left">Service</th>
                        <th class="px-4 py-2 text-left">Amount</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Transaction Date</th>
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr class="hover:bg-gray-100 transition-colors border-b">
                            <!-- Transaction ID -->
                            {{-- <td class="px-4 py-2 text-gray-800">
                                #{{ $transaction->id }}
                            </td> --}}

                            <!-- User Name -->
                            <td class="px-4 py-2 text-gray-600">
                                {{ $transaction->user->name ?? 'N/A' }}
                            </td>

                            <!-- Service Name -->
                            <td class="px-4 py-2 text-gray-600">
                                {{ $transaction->service->name ?? 'N/A' }}
                            </td>

                            <!-- Amount -->
                            <td class="px-4 py-2 text-gray-800">
                                Php{{ number_format($transaction->amount, 2) }}
                            </td>

                            <!-- Status -->
                            <td class="px-4 py-2">
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                                    {{ $transaction->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>

                            <!-- Transaction Date -->
                            <td class="px-4 py-2 text-gray-600">
                                {{ \Carbon\Carbon::parse($transaction->created_at)->format('F d, Y h:i A') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
