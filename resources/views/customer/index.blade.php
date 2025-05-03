<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Flash message --}}
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Tabel Data Customer") }}
                </div>
            </div>

            <div class="flex justify-end mb-4">
            </div>

            <div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table id="produkTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-600">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 light:bg-gray-700 dark:text-gray-900">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Nama</th>
                                <th scope="col" class="px-6 py-3">Produk yang dipilih</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $index => $customer)
                                <tr class="bg-white border-b dark:bg-white-800 dark:border-white-700 border-white-200">
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-grey">{{ $customer->nama }}</th>
                                    <td class="px-6 py-4">{{ $customer->produk->nama }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <button type="button" 
                                                onclick="showCustomerDetail(
                                                    '{{ $customer->nama }}',
                                                    '{{ $customer->email }}',
                                                    '{{ $customer->alamat }}',
                                                    '{{ $customer->produk->nama ?? 'N/A' }}',
                                                    '{{ $customer->produk->deskripsi ?? 'N/A' }}',
                                                    '{{ isset($customer->produk->harga) ? 'Rp ' . number_format($customer->produk->harga, 0, ',', '.') : 'N/A' }}'
                                                )"
                                                class="px-3 py-1.5 text-xs font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300"
                                                data-modal-target="customer-detail-modal" 
                                                data-modal-toggle="customer-detail-modal">
                                                Detail
                                            </button>
                                            <form method="POST" action="{{ route('customer.destroy', $customer->id) }}" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    onclick="confirmDelete('{{ route('customer.destroy', $customer->id) }}')"
                                                    data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                                    class="px-2 py-1.5 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>                
                </div>
                <div class="mt-4">
                    {{ $customers->links() }}
                </div>                
            </div>

            <!-- Modal Detail Customer -->
            <div id="customer-detail-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Detail Customer
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="customer-detail-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="col-span-2 sm:col-span-1">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                    <div id="detail-nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"></div>
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                    <div id="detail-email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"></div>
                                </div>
                                <div class="col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                                    <div id="detail-alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"></div>
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Produk</label>
                                    <div id="detail-produk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"></div>
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                                    <div id="detail-harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"></div>
                                </div>
                                <div class="col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Produk</label>
                                    <div id="detail-deskripsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 h-20 overflow-y-auto"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button data-modal-toggle="customer-detail-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Konfirmasi Hapus -->
            <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                        <button type="button" class="absolute top-3 end-2.5 text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-600 dark:text-gray-400">Apakah anda yakin ingin menghapus produk ini?</h3>
                            <form id="delete-form" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-3 py-1.5 text-center">
                                    Ya, Hapus
                                </button>
                                <button data-modal-hide="popup-modal" type="button" class="py-1.5 px-3 ms-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                    Batal
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showCustomerDetail(nama, email, alamat, produk, deskripsi, harga) {
            document.getElementById('detail-nama').textContent = nama;
            document.getElementById('detail-email').textContent = email;
            document.getElementById('detail-alamat').textContent = alamat;
            document.getElementById('detail-produk').textContent = produk;
            document.getElementById('detail-deskripsi').textContent = deskripsi;
            document.getElementById('detail-harga').textContent = harga;
        }

        // Fungsi confirmDelete yang sudah ada
        function confirmDelete(routeUrl) {
            document.getElementById('delete-form').action = routeUrl;
        }
        
        function confirmDelete(routeUrl) {
            document.getElementById('delete-form').action = routeUrl;
        }
    </script>
</x-app-layout>
