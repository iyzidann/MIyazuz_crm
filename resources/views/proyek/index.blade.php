<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project') }}
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
                <div class="p-6 text-gray-900 flex justify-between items-center">
                    <div>
                        {{ __("Tabel Data Project") }}
                    </div>
                    <div>
                        @if(auth()->user()->role === 'sales')
                            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700">
                                Tambah Project
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Main modal -->
            <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Tambah Project Baru
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form class="p-4 md:p-5" method="POST" action="{{ route('proyek.store') }}">
                            @csrf
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <!-- Dropdown Lead -->
                                <div class="col-span-2">
                                    <label for="lead_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Lead</label>
                                    <select name="lead_id" id="lead_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                        <option value="">-- Pilih Lead --</option>
                                        @foreach($leads as $lead)
                                            <option value="{{ $lead->id }}">{{ $lead->nama }} ({{ $lead->email }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Dropdown Product -->
                                <div class="col-span-2">
                                    <label for="produk_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Produk</label>
                                    <select name="produk_id" id="produk_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                        <option value="">-- Pilih Produk --</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->nama }} (Rp {{ number_format($product->harga, 0, ',', '.') }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Status (hidden dengan nilai default) -->
                                <input type="hidden" name="status" value="pending">
                                
                                <!-- Tampilkan status (readonly) -->
                                <div class="col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                    <div class="px-3 py-2 text-sm bg-gray-100 rounded-lg">
                                        <span class="px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded">Pending</span>
                                        <span class="text-xs text-gray-500 ml-2">(Status default)</span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">
                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                                </svg>
                                Tambah Project
                            </button>
                        </form>                        
                    </div>
                </div>
            </div>

            <div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                    <table id="projectTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-600">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 light:bg-gray-700 dark:text-gray-900">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Nama Lead</th>
                                <th scope="col" class="px-6 py-3">Produk</th>
                                <th scope="col" class="px-6 py-3">Status Project</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $index => $project)
                                <tr class="bg-white border-b dark:bg-white-800 dark:border-white-700 border-white-200">
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $project->lead->nama ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $project->produk->nama ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-blue-100 text-blue-800',
                                                'accepted' => 'bg-green-100 text-green-800',
                                                'rejected' => 'bg-red-100 text-red-800',
                                            ];
                                        @endphp
                                        <span class="px-2 py-1 text-xs font-semibold rounded {{ $statusColors[$project->status] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ ucfirst($project->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            @if(auth()->user()->role === 'manager')
                                            <!-- Detail button for approval -->
                                            <button
                                                type="button"
                                                class="px-3 py-1.5 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800"
                                                onclick="openDetailModal({{ $project->id }}, '{{ $project->lead->nama ?? 'N/A' }}', '{{ $project->lead->email ?? 'N/A' }}', '{{ $project->lead->alamat ?? 'N/A' }}', '{{ $project->produk->nama ?? 'N/A' }}', '{{ $project->produk->harga ?? 0 }}', '{{ $project->status }}')"
                                                data-modal-target="detail-project-modal" data-modal-toggle="detail-project-modal">
                                                Detail
                                            </button>
                                            @endif
                                            
                                            @if(auth()->user()->role === 'sales')
                                                <button
                                                    type="button"
                                                    class="px-3 py-1.5 text-xs font-medium text-center text-gray-800 bg-yellow-300 rounded-lg hover:bg-yellow-400"
                                                    onclick="openEditModal({{ $project->id }}, '{{ $project->lead_id }}', '{{ $project->produk_id }}', '{{ $project->status }}')"
                                                    data-modal-target="edit-project-modal" data-modal-toggle="edit-project-modal">
                                                    Edit
                                                </button>
                                                
                                                <button type="button"
                                                    onclick="confirmDelete('{{ route('proyek.destroy', $project->id) }}')"
                                                    data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                                    class="px-2 py-1.5 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800">
                                                    Hapus
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>                    
                    </table>                
                </div>
                <div class="mt-4">
                    {{ $projects->links() }}
                </div>                
            </div>
        </div>
    </div>

    <!-- Detail & Approval Modal -->
    <div id="detail-project-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-lg max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Detail Project
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="detail-project-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <div class="mb-6">
                        <h4 class="text-md font-semibold text-gray-900 mb-2 border-b pb-1">Informasi Lead</h4>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div class="font-medium">Nama</div>
                            <div id="lead_nama_detail">-</div>
                            
                            <div class="font-medium">Email</div>
                            <div id="lead_email_detail">-</div>
                            
                            <div class="font-medium">Alamat</div>
                            <div id="lead_alamat_detail">-</div>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <h4 class="text-md font-semibold text-gray-900 mb-2 border-b pb-1">Informasi Produk</h4>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div class="font-medium">Nama Produk</div>
                            <div id="produk_nama_detail">-</div>
                            
                            <div class="font-medium">Harga</div>
                            <div id="produk_harga_detail">-</div>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <h4 class="text-md font-semibold text-gray-900 mb-2 border-b pb-1">Status Project</h4>
                        <div class="flex items-center">
                            <span id="status_project_detail" class="px-2 py-1 text-xs font-semibold rounded">Pending</span>
                        </div>
                    </div>
                    
                    <!-- Approval buttons (only shown for pending projects) -->
                    <div id="approval_buttons" class="flex justify-end space-x-2 mt-4">
                        <form id="approve-form" method="POST" action="">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="accepted">
                            <button type="submit" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                Approve
                            </button>
                        </form>
                        
                        <form id="reject-form" method="POST" action="">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                Reject
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit modal -->
    <div id="edit-project-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit Project
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-project-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form id="edit-project-form" class="p-4 md:p-5" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <!-- Dropdown Lead -->
                        <div class="col-span-2">
                            <label for="edit_lead_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Lead</label>
                            <select name="lead_id" id="edit_lead_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                <option value="">-- Pilih Lead --</option>
                                @foreach($leads as $lead)
                                    <option value="{{ $lead->id }}">{{ $lead->nama }} ({{ $lead->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Dropdown Product -->
                        <div class="col-span-2">
                            <label for="edit_produk_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Produk</label>
                            <select name="produk_id" id="edit_produk_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                <option value="">-- Pilih Produk --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->nama }} (Rp {{ number_format($product->harga, 0, ',', '.') }})</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="status" id="edit_status_hidden">
                        
                        <div class="col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <div class="px-3 py-2 text-sm bg-gray-100 rounded-lg">
                                <span id="status_display" class="px-2 py-1 text-xs font-semibold rounded"></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Update Project
                    </button>
                </form>                        
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
    <script>
        function openEditModal(projectId, leadId, produkId, status) {
            // Set form action
            document.getElementById('edit-project-form').action = "{{ route('proyek.update', '') }}/" + projectId;
            
            // Set form values
            document.getElementById('edit_lead_id').value = leadId;
            document.getElementById('edit_produk_id').value = produkId;
            
            const statusColors = {
                'pending': 'bg-blue-100 text-blue-800',
                'accepted': 'bg-green-100 text-green-800',
                'rejected': 'bg-red-100 text-red-800',
            };
        
            document.getElementById('edit_status_hidden').value = status;
            const statusDisplay = document.getElementById('status_display');
            statusDisplay.className = 'px-2 py-1 text-xs font-semibold rounded ' + (statusColors[status] || 'bg-gray-100 text-gray-800');
            statusDisplay.textContent = status.charAt(0).toUpperCase() + status.slice(1);
        }

        function openDetailModal(projectId, leadNama, leadEmail, leadAlamat, produkNama, produkHarga, status) {
            // Set form actions for approve and reject
            const approveForm = document.getElementById('approve-form');
            const rejectForm = document.getElementById('reject-form');
            
            const baseUrl = "{{ url('/') }}";
            approveForm.action = baseUrl + "/proyek/" + projectId + "/approval";
            rejectForm.action = baseUrl + "/proyek/" + projectId + "/approval";
            document.getElementById('lead_nama_detail').textContent = leadNama;
            document.getElementById('lead_email_detail').textContent = leadEmail;
            document.getElementById('lead_alamat_detail').textContent = leadAlamat;
            
            document.getElementById('produk_nama_detail').textContent = produkNama;
            document.getElementById('produk_harga_detail').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(produkHarga);
            
            const statusColors = {
                'pending': 'bg-blue-100 text-blue-800',
                'accepted': 'bg-green-100 text-green-800',
                'rejected': 'bg-red-100 text-red-800',
            };
            
            const statusDisplay = document.getElementById('status_project_detail');
            statusDisplay.className = 'px-2 py-1 text-xs font-semibold rounded ' + (statusColors[status] || 'bg-gray-100 text-gray-800');
            statusDisplay.textContent = status.charAt(0).toUpperCase() + status.slice(1);
            
            const approvalButtons = document.getElementById('approval_buttons');
            if (status === 'pending') {
                approvalButtons.style.display = 'flex';
            } else {
                approvalButtons.style.display = 'none';
            }
        }

        function confirmDelete(routeUrl) {
            document.getElementById('delete-form').action = routeUrl;
        }
    </script>
</x-app-layout>