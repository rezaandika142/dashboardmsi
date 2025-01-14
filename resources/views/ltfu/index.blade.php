<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 space-y-4 md:space-y-0">
        <a href="{{ route('ltfu.create') }}"
            class="bg-emerald-500 hover:bg-emerald-700 text-white font-medium py-2 px-4 rounded-lg shadow-sm">
            Tambah Data LTFU
        </a>
        <input type="text" id="searchInput" placeholder="Cari data..."
            class="w-full md:w-1/3 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-emerald-300 dark:bg-gray-700 dark:text-gray-100">
    </div>

    <!-- Tabel -->
    <div class="overflow-x-auto rounded-lg shadow-md bg-white dark:bg-gray-800 p-4">
        @if (!$ltfu->isEmpty())
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 table-auto" id="ltfuTable">
                <thead class="bg-emerald-50 dark:bg-emerald-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                            Nama
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                            Usia
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                            Alamat
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($ltfu as $data)
                        <tr class="hover:bg-emerald-50 dark:hover:bg-emerald-950">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{ $data->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                {{ $data->age }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                {{ $data->address }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                <a href="{{ route('ltfu.edit', $data->id) }}"
                                    class="inline-block px-4 py-2 text-sm font-medium text-center text-white bg-blue-500 hover:bg-blue-700 rounded-lg shadow-sm">
                                    Edit
                                </a>
                                <button type="button" onclick="openModal({{ $data->id }})"
                                    class="inline-block px-4 py-2 text-sm font-medium text-center text-white bg-red-500 hover:bg-red-700 rounded-lg shadow-sm">
                                    Hapus
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Konfirmasi -->
                        <div id="confirmationModal{{ $data->id }}"
                            class="fixed z-10 inset-0 overflow-y-auto hidden">
                            <div class="flex items-center justify-center min-h-screen">
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 max-w-sm mx-auto">
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                        Konfirmasi Hapus
                                    </h2>
                                    <p class="text-gray-700 dark:text-gray-300 mb-6">
                                        Apakah Anda yakin ingin menghapus data <strong>{{ $data->name }}</strong>?
                                    </p>
                                    <div class="flex justify-end space-x-4">
                                        <button onclick="closeModal({{ $data->id }})"
                                            class="bg-gray-300 hover:bg-gray-400 text-gray-700 dark:text-gray-900 font-medium py-2 px-4 rounded-lg">
                                            Batal
                                        </button>
                                        <form action="{{ route('ltfu.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center text-gray-500 mt-4 dark:text-gray-400">Tidak ada data LTFU yang tersedia.</p>
        @endif

        <!-- Pagination -->
        <div class="mt-4 flex justify-between items-center">
            {{ $ltfu->appends(request()->except('page'))->links('pagination::tailwind') }}
        </div>
    </div>

    <script>
        // Modal Logic
        function openModal(id) {
            document.getElementById('confirmationModal' + id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById('confirmationModal' + id).classList.add('hidden');
        }

        // Pencarian Dinamis
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#ltfuTable tbody tr');
            rows.forEach(row => {
                const rowText = row.innerText.toLowerCase();
                row.style.display = rowText.includes(searchValue) ? '' : 'none';
            });
        });
    </script>
</x-layout>
