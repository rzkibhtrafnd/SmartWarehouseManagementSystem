<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #343a40;
            height: 100vh;
            padding-top: 20px;
            position: fixed;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            transition: width 0.3s ease-in-out;
        }

        .sidebar h2 {
            text-align: center;
            color: #ffffff;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .sidebar a {
            color: #ffffff;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            margin-bottom: 12px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-weight: 400;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .sidebar a.active {
            background-color: #007bff;
            color: white;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease-in-out;
        }

        .main-content h2 {
            font-size: 2rem;
            font-weight: 600;
            color: #343a40;
        }

        .badge-danger {
            background-color: #e74a3b; /* Merah untuk Admin */
            color: white;
        }

        .badge-primary {
            background-color: #007bff; /* Biru untuk Manager */
            color: white;
        }

        .badge-secondary {
            background-color: #6c757d; /* Abu-abu untuk Admin Gudang */
            color: white;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                display: none;
            }

            .sidebar.show {
                display: block;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar collapse d-md-block" id="sidebarMenu">
        <h2>Admin Dashboard</h2>
        <a href="{{ route('admin.index') }}" class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <a href="{{ route('admin.user.index') }}" class="nav-link {{ request()->routeIs('admin.user.index') ? 'active' : '' }}">
            <i class="fas fa-users"></i> User
        </a>
        <a href="{{ route('admin.gudang.index') }}" class="nav-link {{ request()->routeIs('admin.gudang.index') ? 'active' : '' }}">
            <i class="fas fa-warehouse"></i> Gudang
        </a>
        <a href="{{ route('admin.kategori.index') }}" class="nav-link {{ request()->routeIs('admin.kategori.index') ? 'active' : '' }}">
            <i class="fas fa-list"></i> Kategori
        </a>
        <a href="{{ route('admin.produk.index') }}" class="nav-link {{ request()->routeIs('admin.produk.index') ? 'active' : '' }}">
            <i class="fas fa-boxes"></i> Produk
        </a>
        <a href="{{ route('logout') }}" class="nav-link">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Toggle sidebar for small screens
        $(document).ready(function(){
            $('.navbar-toggler').click(function(){
                $('#sidebarMenu').toggleClass('show');
            });
        });
    </script>
</body>
</html>
