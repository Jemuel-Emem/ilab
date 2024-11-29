<div class="p-6 ">
    <div class="max-w-7xl mx-auto">



        <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-3 gap-8 w-full">
            @foreach ($services as $service)
                <div style="background-image:url('{{ asset('images/logo.png') }}');  " class=" w-80 bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition transform hover:scale-105">
                    <div class="p-12 w-7/12 h-80">

                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ $service->name }}</h2>


                        <p class="text-lg text-gray-600 mb-6">
                            <span class="font-bold text-green-600">Price:</span> {{ number_format($service->price, 2) }}
                        </p>



                    </div>
                </div>
            @endforeach
        </div>


        @if ($services->isEmpty())
            <div class="text-center text-gray-600 mt-10">
                <p>No services are currently offered. Please check back later.</p>
            </div>
        @endif

        <div class="mt-6 text-center">
            {{ $services->links() }}
        </div>
    </div>
</div>
