<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WoodViz</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </link>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    </link>
    <link rel="stylesheet" href="style.css">
</head>

<body class="bodycolor">
    <div>
        <div class="bgcolor py-2">
            <nav class="navbar navbar-expand-lg p-0">
                <div class="container-fluid">
                    <a href="#" class="navbar-brand mx-4">
                        <span class="woodViz-style">WoodViz</span>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <span class="head-style" style="margin-left: 55px;">DASHBOARD</span>
                            </li>
                        </ul>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <div class="search-style">
                                    <div class="input-group" style="padding: 1px;">
                                        <i class="bi bi-search p-2" style="color: orange; -webkit-text-stroke: 1px;"></i>
                                        <input type="search" class="form-control border-0" placeholder="Search here..">
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item text-center m-2">
                                <i class="bi bi-bell p-3" style="color: orange; -webkit-text-stroke: 1px;"></i>
                            </li>
                            <li class="nav-item">
                                <div class="input-group">
                                    <img style="width: 40px;" src="https://cdn.pixabay.com/photo/2024/06/03/13/36/ai-generated-8806433_1280.jpg" class="rounded-circle">
                                    <div class="row">
                                        <div class="col-12">
                                            <span style="font-weight: bold;" class="mx-2">User name</span>
                                        </div>
                                        <div class="col-12 mr-3">
                                            <span style="font-weight:lighter;" class="mx-2"><small>Role</small></span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="wrapper">
            <aside id="sidebar">
                <div class="div-height">
                    <ul class="sidebar-nav p-0">
                        <li class="sidebar-item py-1">
                            <button class="sidebar-link" id="dashboard" type="button">
                                <i class="bi bi-columns-gap p-3"></i>
                                <span class="sidebar-span-style">Dashboard</span>
                            </button>
                        </li>
                        <li class="sidebar-item py-1">
                            <button class="sidebar-link dropdown-toggle" id="admin" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle p-3 icon-b"></i>
                                <span class="sidebar-span-style extra-style">Admin</span>
                            </button>
                            <ul class="sidebar-sub-item dropdown-menu p-0" aria-labelledby="admin">
                                <li class=" py-1">
                                    <button class="sidebar-sub-link dropdown-item text-wrap p-1  <?= ($current_page == 'manageUsers.php') ? 'active' : '' ?>" id="user" type="button">
                                        <i class="bi bi-dash icon-b1"></i>
                                        <span class="sidebar-sub-span-style">Manage Users</span>
                                    </button>
                                </li>
                                <li class=" py-1">
                                    <button class="sidebar-sub-link dropdown-item text-wrap p-1 <?= ($current_page == '#') ? 'active' : '' ?>" id="user" type="button">
                                        <i class="bi bi-dash icon-b1"></i>
                                        <span class="sidebar-sub-span-style">Permission Management</span>
                                    </button>
                                </li>
                                <li class=" py-1">
                                    <button class="sidebar-sub-link dropdown-item text-wrap p-1 <?= ($current_page == '#') ? 'active' : '' ?>" id="user" type="button">
                                        <i class="bi bi-dash icon-b1"></i>
                                        <span class="sidebar-sub-span-style">User Activity Monitor</span>
                                    </button>
                                </li>
                                <li class=" py-1">
                                    <button class="sidebar-sub-link dropdown-item text-wrap p-1 <?= ($current_page == '#') ? 'active' : '' ?>" id="user" type="button">
                                        <i class="bi bi-dash icon-b1"></i>
                                        <span class="sidebar-sub-span-style">Production Monitoring</span>
                                    </button>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item py-1">
                            <button class="sidebar-link <?= ($current_page == '#') ? 'active' : '' ?>" id="product" type="button">
                                <i class="bi bi-box-seam p-3"></i>
                                <span class="sidebar-span-style">Product</span>
                            </button>
                        </li>
                        <li class="sidebar-item py-1">
                            <button class="sidebar-link <?= ($current_page == '#') ? 'active' : '' ?>" id="import" type="button">
                                <i class="bi bi-arrow-left p-3"></i>
                                <span class="sidebar-span-style">Import</span>
                            </button>
                        </li>
                        <li class="sidebar-item py-1">
                            <button class="sidebar-link <?= ($current_page == '#') ? 'active' : '' ?>" id="production" type="button">
                                <i class="bi bi-database-fill p-3"></i>
                                <span class="sidebar-span-style">Production</span>
                            </button>
                        </li>
                        <li class="sidebar-item py-1">
                            <button class="sidebar-link <?= ($current_page == '#') ? 'active' : '' ?>" id="billing" type="button">
                                <i class="bi bi-receipt p-3"></i>
                                <span class="sidebar-span-style">Billing</span>
                            </button>
                        </li>
                        <li class="sidebar-item py-1">
                            <button class="sidebar-link <?= ($current_page == '#') ? 'active' : '' ?>" id="customer" type="button">
                                <i class="bi bi-people-fill p-3"></i>
                                <span class="sidebar-span-style">Customer</span>
                            </button>
                        </li>
                        <li class="sidebar-item py-1">
                            <button class="sidebar-link <?= ($current_page == '#') ? 'active' : '' ?>" id="report" type="button">
                                <i class="bi bi-file-text-fill p-3"></i>
                                <span class="sidebar-span-style">Report</span>
                            </button>
                        </li>
                        <li class="sidebar-item py-1">
                            <button class="sidebar-link <?= ($current_page == '#') ? 'active' : '' ?>" id="setting" type="button">
                                <i class="bi bi-gear p-3"></i>
                                <span class="sidebar-span-style">Setting</span>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="text-center">
                    <img class="img1" src="logo.png">
                </div>
            </aside>

            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <script type="text/javascript" src="assets/js/tabulator.min.js"></script>