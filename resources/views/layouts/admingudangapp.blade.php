<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Gudang</title>
  <!-- Google Fonts: Inter -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Tailwind CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <!-- Font Awesome CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <style>
    [x-cloak] { display: none !important; }
    .sidebar-hover:hover {
      background: rgba(59, 130, 246, 0.1);
      border-left: 4px solid #3B82F6;
    }
  </style>
</head>
<body class="bg-gray-50 font-sans">
  <!-- Mobile Navbar -->
  <nav class="sticky top-0 bg-white border-b border-gray-200 p-4 md:hidden flex justify-between items-center z-30">
    <button class="text-gray-600 hover:text-gray-800" onclick="toggleSidebar()">
      <i class="fas fa-bars text-xl"></i>
    </button>
    <div class="flex items-center space-x-4">
      <div class="relative">
        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
             class="w-8 h-8 rounded-full cursor-pointer"
             id="profileMenuButton">
      </div>
    </div>
  </nav>

  <!-- Sidebar -->
  <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-white shadow-xl transform -translate-x-full md:translate-x-0 transition-transform duration-300">
    <div class="flex flex-col h-full">
      <div class="p-6 mb-4">
        <h1 class="text-xl font-bold text-gray-800">SmartWarehouse</h1>
        <p class="text-sm text-gray-500 mt-1">Gudang Management</p>
      </div>

      <nav class="flex-1 px-3 space-y-1">
        @foreach([
          ['route' => 'admingudang.index', 'icon' => 'table-columns', 'label' => 'Dashboard'],
          ['route' => 'admingudang.produk.index', 'icon' => 'box', 'label' => 'Produk'],
          ['route' => 'admingudang.transaksi.index', 'icon' => 'money-bill-wave', 'label' => 'Transaksi']
        ] as $item)
          <a href="{{ route($item['route']) }}"
             class="flex items-center p-3 text-gray-600 rounded-lg transition-all
                    {{ request()->routeIs($item['route']) ? 'bg-blue-50 text-blue-600 font-medium' : 'hover:bg-gray-50' }}">
            <i class="fas fa-{{ $item['icon'] }} w-5 mr-3 text-center"></i>
            {{ $item['label'] }}
          </a>
        @endforeach
      </nav>

      <div class="p-4 border-t border-gray-100">
        <a href="{{ route('logout') }}"
           class="flex items-center p-3 text-red-600 hover:bg-red-50 rounded-lg transition-all">
          <i class="fas fa-sign-out-alt mr-3"></i>
          Logout
        </a>
        <div class="text-center text-xs text-gray-400 mt-2">
          &copy; {{ date('Y') }} SmartWarehouse v2.0
        </div>
      </div>
    </div>
  </aside>

  <!-- Main Content -->
  <main id="main-content" class="md:ml-64 min-h-screen p-6 bg-gray-50">
    <div class="max-w-screen-2xl mx-auto">
      @yield('content')
    </div>
  </main>

  <!-- Scripts -->
  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('-translate-x-full');
    }
  </script>
</body>
</html>
