<x-layout>
    <x-slot:title>Create LTFU</x-slot:title>
    <h3 class="text-xl font-bold text-gray-800 py-4 dark:text-gray-200">Add New LTFU</h3>
  
    <form action="{{ route('ltfu.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md dark:bg-gray-800">
        @csrf
        <div class="mb-4">
            <label for="sr" class="block text-sm font-medium text-gray-700 dark:text-gray-200">SR</label>
            <input type="text" name="sr" id="sr" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100" required>
        </div>
        <div class="mb-4">
            <label for="ssr" class="block text-sm font-medium text-gray-700 dark:text-gray-200">SSR</label>
            <input type="text" name="ssr" id="ssr" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100" required>
        </div>
        <div class="mb-4">
            <label for="province" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Province</label>
            <input type="text" name="province" id="province" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100" required>
        </div>
        <div class="mb-4">
            <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-200">City</label>
            <input type="text" name="city" id="city" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100" required>
        </div>
        <div class="mb-4">
            <label for="patient_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Patient Name</label>
            <input type="text" name="patient_name" id="patient_name" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100" required>
        </div>
        <div class="mb-4">
            <label for="nik" class="block text-sm font-medium text-gray-700 dark:text-gray-200">NIK</label>
            <input type="text" name="nik" id="nik" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100" required>
        </div>
        <div class="mb-4">
            <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Gender</label>
            <select name="gender" id="gender" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100" required>
                <option value="L">Male</option>
                <option value="P">Female</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="age" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Age</label>
            <input type="number" name="age" id="age" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100" required>
        </div>
        <div class="mb-4">
            <label for="subdistrict" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Subdistrict</label>
            <input type="text" name="subdistrict" id="subdistrict" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100" required>
        </div>
        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Address</label>
            <input type="text" name="address" id="address" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100" required>
        </div>
        <div class="mb-4">
            <label for="month" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Month</label>
            <input type="text" name="month" id="month" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100" required>
        </div>
        <div class="mb-4">
            <label for="remarks" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Remarks</label>
            <textarea name="remarks" id="remarks" rows="4" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100"></textarea>
        </div>
        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none">Save</button>
    </form>
</x-layout>
