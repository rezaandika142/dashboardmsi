<x-layout>
    <x-slot:title>Edit LTFU</x-slot:title>
    <h3 class="text-xl font-bold text-gray-800 py-4 dark:text-gray-200">Edit LTFU</h3>
  
    <form action="{{ route('ltfu.update', $ltfu->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md dark:bg-gray-800">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
            <input type="text" name="name" id="name" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100" value="{{ $ltfu->name }}" required>
        </div>
        <div class="mb-4">
            <label for="age" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Age</label>
            <input type="number" name="age" id="age" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100" value="{{ $ltfu->age }}" required>
        </div>
        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Address</label>
            <input type="text" name="address" id="address" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100" value="{{ $ltfu->address }}" required>
        </div>
        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none">Update</button>
    </form>
  </x-layout>
  