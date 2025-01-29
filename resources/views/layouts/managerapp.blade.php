<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager</title>
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-gray-800 p-4 md:hidden">
        <button class="text-white focus:outline-none" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    <!-- Sidebar -->
    <div id="sidebar" class="bg-gray-900 text-white w-72 space-y-8 py-7 px-4 fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out">
        <h2 class="text-3xl font-semibold text-center text-white mb-8">Manager Dashboard</h2>
        <nav class="space-y-6">
            <a href="{{ route('manager.index') }}" class="flex items-center space-x-4 px-6 py-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('manager.index') ? 'bg-blue-600' : '' }}">
                <i class="fas fa-tachometer-alt text-2xl"></i>
                <span class="text-xl">Dashboard</span>
            </a>
            <a href="{{ route('manager.transaksi.index') }}" class="flex items-center space-x-4 px-6 py-3 rounded-lg hover:bg-gray-700 {{ request()->routeIs('manager.transaksi.index') ? 'bg-blue-600' : '' }}">
                <i class="fas fa-money-bill-wave text-2xl"></i>
                <span class="text-xl">Transaksi</span>
            </a>
            <a href="{{ route('logout') }}" class="flex items-center space-x-4 px-6 py-3 rounded-lg hover:bg-gray-700 w-full">
                <i class="fas fa-sign-out-alt text-2xl"></i>
                <span class="text-xl">Logout</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div id="main-content" class="md:ml-64 p-6">
        @yield('content')
    </div>

    <!-- Script to toggle sidebar -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }
    </script>
</body>
</html>
