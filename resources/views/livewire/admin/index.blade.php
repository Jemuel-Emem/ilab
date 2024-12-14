<div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">

    <div
        class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow">
        <div class="flex items-center">
            <i class="ri-calendar-check-line text-4xl mr-4"></i>
            <div>
                <h2 class="text-lg font-semibold">Daily Patients</h2>
                <p class="text-3xl font-bold">{{ $dailyPatientCount }}</p>
            </div>
        </div>
    </div>

    <!-- Top Services Availed -->
    <div
        class="bg-gradient-to-r from-green-500 to-teal-500 text-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow">
        <div>
            <h2 class="text-lg font-semibold mb-4 flex items-center">
                <i class="ri-bar-chart-box-line text-4xl mr-4"></i>
                Top Services Availed
            </h2>
            <ul class="list-disc pl-6">
                @foreach ($serviceRanking as $service)
                    <li class="flex justify-between">
                        <span>{{ $service->service->name ?? 'N/A' }}</span>
                        <span class="font-bold">{{ $service->count }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Total Clients -->
    <div
        class="bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow">
        <div class="flex items-center">
            <i class="ri-user-heart-line text-4xl mr-4"></i>
            <div>
                <h2 class="text-lg font-semibold">Total Clients</h2>
                <p class="text-3xl font-bold">{{ $totalClients }}</p>
            </div>
        </div>
    </div>

    <div class="col-span-1 md:col-span-3">
        <canvas id="patientsPerDayChart" class="rounded-lg shadow-md"></canvas>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('patientsPerDayChart').getContext('2d');
            var dailyData = @json($dailyPaymentsData); // Get data passed from Livewire

            // Prepare data for the chart
            var labels = dailyData.map(function (item) {
                return item.date;
            });

            var data = dailyData.map(function (item) {
                return item.total;
            });

            // Create the chart
            new Chart(ctx, {
                type: 'line', // Choose the chart type
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Patients per Day',
                        data: data,
                        borderColor: '#3490dc',
                        backgroundColor: 'rgba(52, 144, 220, 0.2)',
                        borderWidth: 2,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Number of Patients'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</div>
