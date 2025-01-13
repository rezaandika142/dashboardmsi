<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="overflow-x-auto rounded-lg shadow-md bg-white dark:bg-gray-800 p-4">
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('ltfu.create') }}"
                class="bg-emerald-500 hover:bg-emerald-700 text-white font-medium py-2 px-4 rounded-lg shadow-sm">Tambah
                Data LTFU</a>
            <input type="text" id="searchInput" placeholder="Cari..."
                class="w-1/3 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-emerald-300 dark:bg-gray-700 dark:text-gray-100">
        </div>
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 table-auto" id="myTable">
            <thead class="bg-emerald-50 dark:bg-emerald-900">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider cursor-pointer hover:underline">
                        Nama</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider cursor-pointer hover:underline">
                        Usia</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                        Alamat</th>
                    <th scope="col"
                        class="px-6 py-3 text-right text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                        Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($ltfu as $data)
                    <tr class="hover:bg-emerald-50 dark:hover:bg-emerald-950">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{ $data->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                            {{ $data->age }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                            {{ $data->address }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <a href="{{ route('ltfu.edit', $data->id) }}"
                                class="inline-block px-4 py-2 text-sm font-medium text-center text-white bg-blue-500 hover:bg-blue-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-300">Edit</a>
                            <!-- Delete Button triggers Modal -->
                            <button type="button"
                                    onclick="openModal({{ $data->id }})"
                                    class="inline-block px-4 py-2 text-sm font-medium text-center text-white bg-red-500 hover:bg-red-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-300">
                                Hapus
                            </button>

                            <div id="confirmationModal{{ $data->id }}" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50 flex justify-center items-center">
                                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-sm w-full">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4 mr-10">Konfirmasi Penghapusan</h3>
                                    <p class="text-gray-600 dark:text-gray-300 mb-6">Apakah Anda yakin ingin menghapus data ini?</p>
                                    <div class="flex justify-between">
                                        <button type="button" 
                                                onclick="closeModal({{ $data->id }})"
                                                class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 rounded-lg">
                                            Batalkan
                                        </button>
                                        <form action="{{ route('ltfu.destroy', $data->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="px-4 py-2 text-sm font-medium text-white bg-red-500 hover:bg-red-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-300">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($ltfu->isEmpty())
            <p class="text-center text-gray-500 mt-4 dark:text-gray-400">Tidak ada data.</p>
        @endif

        <div class="mt-4 flex justify-between items-center">
            <div id="tableInfo" class="text-sm text-gray-600 dark:text-gray-400"></div>
            <div class="flex space-x-2">
                {{ $ltfu->appends(request()->except('page'))->links('pagination::tailwind') }}
            </div>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById('confirmationModal' + id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById('confirmationModal' + id).classList.add('hidden');
        }
    </script>
</x-layout>
