<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 space-y-4 md:space-y-0">
        <!-- Tombol Tambah Data LTFU -->
        <a href="{{ route('ltfu.create') }}"
           class="bg-emerald-500 hover:bg-emerald-700 text-white font-medium py-2 px-4 rounded-lg shadow-sm">
            Tambah Data LTFU
        </a>

        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('ltfu.index') }}" class="w-full md:w-1/3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari data..."
                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-emerald-300 dark:bg-gray-700 dark:text-gray-100">
        </form>

        <!-- Tombol Import Excel -->
        <button id="importFileButton"
           class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow-sm">
            Import Excel
        </button>
    </div>

    <!-- Modal Konfirmasi Import -->
    <div id="confirmationModal" class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-96">
            <h3 class="text-lg font-semibold mb-4 dark:text-gray-100">Konfirmasi Import Data</h3>
            <p id="fileNameDisplay" class="text-sm text-gray-600 dark:text-gray-400 mb-4">Apakah Anda yakin ingin mengimpor file ini?</p>
            <div class="flex justify-end space-x-4">
                <button id="cancelButton" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">Batal</button>
                <button id="confirmButton" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Konfirmasi</button>
            </div>
        </div>
    </div>

    <!-- Form Import Excel -->
    <form id="importForm" action="{{ route('ltfu.import.store') }}" method="POST" enctype="multipart/form-data" class="hidden">
        @csrf
        <input type="file" name="file" id="fileInput" accept=".xlsx, .xls" required hidden>
    </form>

    <!-- Tabel -->
    <div class="overflow-x-auto rounded-lg shadow-md bg-white dark:bg-gray-800 p-4">

        @if ($ltfu->isNotEmpty())
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 table-auto" id="ltfuTable">

                <thead class="bg-emerald-50 dark:bg-emerald-900">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">SR</th>
                        <th class="px-4 py-2">SSR</th>
                        <th class="px-4 py-2">Provinsi</th>
                        <th class="px-4 py-2">Kota/Kabupaten</th>
                        <th class="px-4 py-2">Nama Pasien</th>
                        <th class="px-4 py-2">Bulan Pelaporan</th>
                        <th class="px-4 py-2">NIK</th>
                        <th class="px-4 py-2">Jenis Kelamin</th>
                        <th class="px-4 py-2">Umur</th>
                        <th class="px-4 py-2">Kecamatan</th>
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">Keterangan</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ltfu as $index => $data)
                        <tr>
                            <td class="px-4 py-2">{{ $loop->iteration + ($ltfu->currentPage() - 1) * $ltfu->perPage() }}</td>
                            <td class="px-4 py-2">{{ $data->sr }}</td>
                            <td class="px-4 py-2">{{ $data->ssr }}</td>
                            <td class="px-4 py-2">{{ $data->province }}</td>
                            <td class="px-4 py-2">{{ $data->city }}</td>
                            <td class="px-4 py-2">{{ $data->patient_name }}</td>
                            <td class="px-4 py-2">{{ $data->month }}</td>
                            <td class="px-4 py-2">{{ $data->nik }}</td>
                            <td class="px-4 py-2">{{ $data->gender }}</td>
                            <td class="px-4 py-2">{{ $data->age }}</td>
                            <td class="px-4 py-2">{{ $data->subdistrict }}</td>
                            <td class="px-4 py-2">{{ $data->address }}</td>
                            <td class="px-4 py-2">{{ $data->remarks }}</td>
                            <td class="px-4 py-2 flex space-x-2">
                                <!-- Tombol Edit -->
                                <a href="{{ route('ltfu.edit', $data->id) }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded shadow">
                                    Edit
                                </a>
                            
                                <!-- Tombol Hapus -->
                                <button type="button"
                                    class="bg-red-500 hover:bg-red-700 text-white font-medium px-4 py-2 rounded shadow"
                                    onclick="openDeleteModal({{ $data->id }})">
                                    Hapus
                                </button>
                            
                                <!-- Formulir Hapus (Disembunyikan, hanya akan dikirim via modal) -->
                                <form id="deleteForm-{{ $data->id }}" action="{{ route('ltfu.destroy', $data->id) }}" method="POST" hidden>
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                            
                            <!-- Modal Konfirmasi Hapus -->
                            <div id="deleteModal" class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50 flex items-center justify-center">
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-96">
                                    <h3 class="text-lg font-semibold mb-4 dark:text-gray-100">Konfirmasi Penghapusan</h3>
                                    <p id="modalMessage" class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                        Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.
                                    </p>
                                    <div class="flex justify-end space-x-4">
                                        <button id="cancelDeleteButton" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">
                                            Batal
                                        </button>
                                        <button id="confirmDeleteButton" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center">Tidak ada data LTFU yang tersedia.</p>
        @endif

        <!-- Pagination -->
        <div class="mt-4 flex justify-between items-center">
            {{ $ltfu->links('pagination::tailwind') }}
        </div>
    </div>
    <script>
        const deleteModal = document.getElementById('deleteModal');
        const cancelDeleteButton = document.getElementById('cancelDeleteButton');
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');
        let deleteFormId = null;
    
        // Fungsi untuk membuka modal konfirmasi
        function openDeleteModal(id) {
            deleteFormId = `deleteForm-${id}`;
            deleteModal.classList.remove('hidden');
        }
    
        // Fungsi untuk menutup modal
        function closeDeleteModal() {
            deleteModal.classList.add('hidden');
            deleteFormId = null;
        }
    
        // Klik tombol "Batal" untuk menutup modal
        cancelDeleteButton.addEventListener('click', closeDeleteModal);
    
        // Klik tombol "Hapus" untuk mengirimkan formulir
        confirmDeleteButton.addEventListener('click', () => {
            if (deleteFormId) {
                document.getElementById(deleteFormId).submit();
            }
        });
    </script>
    <script>
        const importFileButton = document.getElementById('importFileButton');
        const fileInput = document.getElementById('fileInput');
        const confirmationModal = document.getElementById('confirmationModal');
        const cancelButton = document.getElementById('cancelButton');
        const confirmButton = document.getElementById('confirmButton');
        const fileNameDisplay = document.getElementById('fileNameDisplay');
        const importForm = document.getElementById('importForm');

        // Show file input when button clicked
        importFileButton.addEventListener('click', () => fileInput.click());

        // Show confirmation modal after file selection
        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                const fileName = fileInput.files[0].name;
                fileNameDisplay.textContent = `Anda telah memilih file: ${fileName}. Apakah Anda yakin ingin melanjutkan?`;
                confirmationModal.classList.remove('hidden');
            }
        });

        // Cancel button hides the modal
        cancelButton.addEventListener('click', () => {
            confirmationModal.classList.add('hidden');
            fileInput.value = ''; // Clear the file input
        });

        // Confirm button submits the form
        confirmButton.addEventListener('click', () => {
            importForm.submit();
        });
    </script>
</x-layout>
