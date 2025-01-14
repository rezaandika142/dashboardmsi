<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite('resources/css/app.css')
    <title>{{ $title }}</title>
</head>

<body class="h-full bg-gray-100">
    <div class="min-h-screen bg-gradient-to-br from-green-400 via-teal-400 to-blue-400 flex items-center justify-center">
        <div class="bg-gradient-to-br from-white via-gray-100 to-gray-200 shadow-2xl rounded-xl p-8 w-full max-w-md">
            <h1 class="text-3xl font-extrabold text-gray-800 text-center mb-6">Login</h1>
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                <div class="relative">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full px-4 py-3 rounded-md bg-gradient-to-br from-gray-100 via-white to-gray-50 shadow-inner focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-300 ease-in-out"
                        placeholder="Masukkan email Anda" required />
                </div>
                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-3 rounded-md bg-gradient-to-br from-gray-100 via-white to-gray-50 shadow-inner focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-300 ease-in-out"
                        placeholder="Masukkan password Anda" required />
                </div>
                <button type="submit"
                class="w-full bg-gradient-to-r from-green-500 via-teal-500 to-blue-500 text-white font-bold py-3 rounded-lg shadow-lg hover:shadow-2xl transition-transform transform hover:-translate-y-1 duration-300">
                    Login
                </button>
            </form>
            <div class="text-center mt-4 text-sm text-gray-600">
                Belum punya akun? <a href="{{ route('register') }}"
                    class="text-indigo-500 hover:underline">Registrasi</a>
            </div>
        </div>
    </div>

</body>
