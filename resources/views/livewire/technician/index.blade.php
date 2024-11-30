<div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">

    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow">
        <div class="flex items-center">
            <i class="ri-user-heart-line text-4xl mr-4"></i>
            <div>
                <h2 class="text-lg font-semibold">Total Patients</h2>
                <p class="text-3xl font-bold">{{ $totalPatients }}</p>
            </div>
        </div>
    </div>


    <div class="bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow">
        <div class="flex items-center">
            <i class="ri-calendar-check-line text-4xl mr-4"></i>
            <div>
                <h2 class="text-lg font-semibold">Total Appointments</h2>
                <p class="text-3xl font-bold">{{ $totalAppointments }}</p>
            </div>
        </div>
    </div>
</div>
