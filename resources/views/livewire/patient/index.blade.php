<div class="bg-gradient-to-r from-blue-50 to-blue-100 min-h-screen flex flex-col">
    <!-- Hero Section -->
    <div class="flex flex-col md:flex-row items-center justify-between max-w-7xl mx-auto px-6 py-12">
        <!-- Left Content -->
        <div class="w-full md:w-1/2 text-center md:text-left">
            <h1 class="text-4xl lg:text-6xl font-bold text-cyan-700 leading-tight">
                Welcome to <span class="text-orange-500">ILAB</span>
            </h1>
            <p class="mt-6 text-lg text-gray-600">
                Experience seamless medical diagnostics and health services. Your health, our priority.
            </p>
            <div class="mt-8 flex justify-center md:justify-start gap-4">
                <a href="#services" class="bg-orange-500 text-white px-6 py-3 rounded-md shadow-lg hover:bg-orange-600 transition">
                    Explore Services
                </a>
                <a href="#appointment" class="bg-cyan-700 text-white px-6 py-3 rounded-md shadow-lg hover:bg-cyan-800 transition">
                    Book Appointment
                </a>
            </div>
        </div>

        <!-- Right Image -->
        <div class="w-full md:w-1/2 mt-12 md:mt-0">
            <img
                src="
                {{ asset('images/logo.png') }}"
                alt="ILAB Healthcare"
                class="rounded-lg shadow-lg w-full"
            >
        </div>
    </div>

    <!-- Highlights Section -->
    <div class="bg-white py-12">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <!-- Highlight Item -->
            <div class="flex flex-col items-center">
                <i class="ri-heart-pulse-fill text-5xl text-cyan-700"></i>
                <h3 class="text-xl font-semibold text-gray-800 mt-4">Comprehensive Diagnostics</h3>
                <p class="text-gray-600 mt-2">
                    Offering cutting-edge lab tests for accurate results.
                </p>
            </div>

            <!-- Highlight Item -->
            <div class="flex flex-col items-center">
                <i class="ri-stethoscope-fill text-5xl text-cyan-700"></i>
                <h3 class="text-xl font-semibold text-gray-800 mt-4">Expert Consultation</h3>
                <p class="text-gray-600 mt-2">
                    Connect with top healthcare professionals anytime.
                </p>
            </div>


            <div class="flex flex-col items-center">
                <i class="ri-money-dollar-circle-fill text-5xl text-cyan-700"></i>
                <h3 class="text-xl font-semibold text-gray-800 mt-4">Affordable Services</h3>
                <p class="text-gray-600 mt-2">
                    Quality healthcare solutions at pocket-friendly prices.
                </p>
            </div>
        </div>
    </div>


</div>
