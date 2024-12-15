<div>
    <div>
        <div>
            <div>
                <div>
                    <h2 class="text-3xl font-bold text-blue-600 mb-6">Services</h2>
                    <table id="printPage" class="min-w-full table-auto border-collapse border border-gray-200">
                        <thead class="bg-blue-600">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2 text-left text-white font-medium">Service Name</th>
                                <th class="border border-gray-300 px-4 py-2 text-left text-white font-medium">Price</th>
                                <th class="border border-gray-300 px-4 py-2 text-left text-white font-medium">Category</th>
                                <th class="border border-gray-300 px-4 py-2 text-center text-white font-medium no-print">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr class="hover:bg-gray-100">
                                    <td class="border border-gray-300 px-4 py-2">{{ $service->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">Php {{ number_format($service->price, 2) }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $service->category }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center no-print">
                                        <button
                                            @click="openModal = true; @this.editService({{ $service->id }})"
                                            class="text-blue-500 hover:underline">
                                            Edit
                                        </button>
                                        <button
                                            wire:click="deleteService({{ $service->id }})"
                                            class="text-red-500 hover:underline ml-4">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="flex justify-end mb-4 mt-4">
                        <button
                            onclick="printOnlyTable()"
                            class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                            Print Services
                        </button>
                    </div>
                </div>
            </div>

            <!-- Print-specific CSS -->
            <style>
                @media print {
                    body * {
                        visibility: hidden;
                    }
                    #printPage, #printPage * {
                        visibility: visible;
                    }
                    #printPage .no-print {
                        display: none;
                    }

                    /* Ensure the label "Services" appears in the printout */
                    h2 {
                        visibility: visible;
                        font-size: 24px;
                        font-weight: bold;
                        margin-bottom: 10px;
                    }

                    @page {
                        margin: 0;
                        size: auto;

                    }
                    body {
                        margin: 0;
                    }
                    #printPage {
                        position: relative;
                        right: 200px;
                        top: 0;
                        width: 600px;


                    }
                }
            </style>


            <script>
                function printOnlyTable() {
                    document.body.style.visibility = 'hidden';
                    document.getElementById('printPage').style.visibility = 'visible';

                    window.print();

                    document.body.style.visibility = 'visible';
                    document.getElementById('printPage').style.visibility = 'visible';
                }
            </script>

        </div>
    </div>

</div>
