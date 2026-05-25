<?php
$user = $_SESSION['user']['nama'];
?>
<div id="wrapper">

    <div id="sidebar" class="bg-primary text-white p-3">
        <div class="text-center">
            <div class="d-flex align-items-center justify-content-center gap-2">
                <img src="public/icon/Final.png" class="logo-final">
                <h4 class="m-0 fw-bold">Final</h4>
            </div>
            <p>Financial Analysis</p>
        </div>
        <hr>

        <ul class="nav flex-column">

            <li class="nav-item">
                <label class="nav-link text-white active" id="dashboard">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </label>
            </li>

            <li class="nav-item">
                <label class="nav-link text-white" id="data">
                    <i class="bi bi-folder"></i> Data
                </label>
            </li>

            <li class="nav-item">
                <label class="nav-link text-white" id="laporan">
                    <i class="bi bi-graph-up"></i> Laporan
                </label>
            </li>

            <li class="nav-item">
                <label class="nav-link text-white" id="pengaturan">
                    <i class="bi bi-gear"></i> Pengaturan
                </label>
            </li>

        </ul>
    </div>

    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom sticky-top">
            <div class="container-fluid">
                <button class="btn btn-primary" id="toggleSidebar"><i class="bi bi-x-lg"></i>
                </button>

                <label class="navbar-brand ms-2"><img src="" alt=""><i class="bi bi-person-fill"></i> <?= $user ?></label>

            </div>
        </nav>
        <div class="container-fluid p-4" id="main-content">

        </div>

    </div>

</div>