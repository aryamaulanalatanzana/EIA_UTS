<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Z CLOTH Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary shadow-sm">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Z CLOTH Admin Dashboard</span>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 bg-dark text-white vh-100 pt-4">
                <h5 class="text-center">Menu</h5>
                <ul class="nav flex-column px-2">
                    <li class="nav-item"><a href="/dashboard" class="nav-link text-white">Dashboard</a></li>
                    <li class="nav-item"><a href="/orders" class="nav-link text-white">Orders</a></li>
                    <li class="nav-item"><a href="/payments" class="nav-link text-white">Payments</a></li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-5">
                <h2 class="mb-4">Selamat Datang, Admin</h2>

                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="card text-white bg-info shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Total Users</h5>
                                <h3>{{ $userCount }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Total Products</h5>
                                <h3>{{ $productCount }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-warning shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Total Orders</h5>
                                <h3>{{ $orderCount }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-danger shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Total Payments</h5>
                                <h3>{{ $paymentCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
