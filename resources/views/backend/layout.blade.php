<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>E-Com Admin Panel</title>

    <!-- Favicon & Icons -->
    <link rel="apple-touch-icon" sizes="76x76" href="/../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/../assets/img/favicon.png">

    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900">
    <link rel="stylesheet" href="/../assets/css/nucleo-icons.css">
    <link rel="stylesheet" href="/../assets/css/nucleo-svg.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0">

    <!-- CSS Files -->
    <link rel="stylesheet" href="/../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <link id="pagestyle" href="/../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet">

    <!-- Add Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
</head>

<body class="d-flex flex-column min-vh-100 g-sidenav-show bg-gray-100">
    <!-- Sidebar -->
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand px-4 py-3 m-0" href="/admin/dashboard" target="_blank">
                <img src="https://dummyimage.com/120x120/007bff/fff&text={{ Auth::user()->name }}" class="navbar-brand-img" width="26" height="26" alt="main_logo">
                <span class="ms-1 text-sm text-dark">{{ Auth::user()->name }}</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0 mb-2">
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link {{ request()->is('admin/dashboard') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="/admin/dashboard"><i class="material-symbols-rounded opacity-5">dashboard</i><span class="nav-link-text ms-1">Dashboard</span></a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('admin/users*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="/admin/users"><i class="material-symbols-rounded opacity-5">group</i><span class="nav-link-text ms-1">Users</span></a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('admin/categories*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="/admin/categories"><i class="material-symbols-rounded opacity-5">style</i><span class="nav-link-text ms-1">Categories</span></a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('admin/brands*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="/admin/brands"><i class="material-symbols-rounded opacity-5">computer</i><span class="nav-link-text ms-1">Brands</span></a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('admin/attributes*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="/admin/attributes"><i class="material-symbols-rounded opacity-5">box</i><span class="nav-link-text ms-1">Attributes</span></a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('admin/products*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="/admin/products"><i class="material-symbols-rounded opacity-5">inventory</i><span class="nav-link-text ms-1">Products</span></a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('admin/stocks*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="/admin/stocks"><i class="material-symbols-rounded opacity-5">inventory_2</i><span class="nav-link-text ms-1">Stocks</span></a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('admin/orders*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="/admin/orders"><i class="material-symbols-rounded opacity-5">package</i><span class="nav-link-text ms-1">Orders</span></a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('admin/reviews*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="/admin/reviews"><i class="material-symbols-rounded opacity-5">reviews</i><span class="nav-link-text ms-1">Reviews</span></a></li>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>

                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <!-- Search -->
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Type here...</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <!-- User Dropdown -->
                    <ul class="navbar-nav d-flex align-items-center justify-content-end">
                        <li class="nav-item dropdown d-flex align-items-center">
                            <a class="nav-link dropdown-toggle text-body font-weight-bold px-0" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="material-symbols-rounded">account_circle</i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="/admin/profile">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/admin/logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container-fluid py-2 flex-grow-1">
            @include($view)

            <!-- Footer -->
            <footer class="footer py-4 mt-auto">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4 text-center text-sm text-muted text-lg-start">
                            © <script>document.write(new Date().getFullYear())</script>,
                            Made with <i class="fa fa-heart"></i> by
                            <a href="https://www.linkedin.com/in/dilnuwan-weerasuriya" class="font-weight-bold" target="_blank">Dilnuwan Weerasuriya</a>.
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>

    @if (Session::has('toastr'))
        <script>{!! Session::get('toastr') !!}</script>
    @endif

    <!-- Core JS -->
    <script src="/../assets/js/core/popper.min.js"></script>
    <script src="/../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="/../assets/js/plugins/chartjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), { damping: '0.5' });
        }
    </script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="/../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>
</html>
