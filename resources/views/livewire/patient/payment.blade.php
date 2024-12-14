<div class="p-6">
    <h2 class="text-3xl font-bold text-orange-500 mb-6">My Payments</h2>

    @if ($payments->isEmpty())
        <div class="text-center text-gray-500 py-6">
            <i class="ri-money-dollar-circle-line text-4xl mb-2"></i>
            <p class="text-lg">You have no payments recorded.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($payments as $payment)
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow border">

                    <h3 class="text-xl font-bold text-gray-800 mb-2">
                        {{ $payment->service->name ?? 'N/A' }}
                    </h3>


                    <p class="text-gray-600 mb-2">
                        <i class="ri-money-dollar-circle-line text-gray-500 mr-2"></i>
                        <strong>Amount Paid:</strong>
                        Php {{ number_format($payment->amount, 2) }}
                    </p>


                    <p class="text-gray-600 mb-2">
                        <i class="ri-check-line text-gray-500 mr-2"></i>
                        <strong>Payment Status:</strong>
                        <span class="{{ $payment->status === 'paid' ? 'text-green-600' : 'text-red-600' }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </p>


                    <p class="text-gray-600">
                        <i class="ri-calendar-line text-gray-500 mr-2"></i>
                        <strong>Payment Date:</strong>
                        {{ $payment->created_at->format('F j, Y') }}
                    </p>
                </div>
            @endforeach
        </div>
    @endif
</div>
