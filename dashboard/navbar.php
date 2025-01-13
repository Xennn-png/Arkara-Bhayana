<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    // Jika belum login, alihkan ke halaman login
    header("Location: ../views/login.php");
    exit;
}

$user_name = $_SESSION['user']['username'];

echo '<!--begin::Header-->
<nav class="app-header navbar navbar-expand bg-body">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
            <i class="bi bi-list"></i>
            </a>
        </ul>
        <!--end::Start Navbar Links-->
        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
        <!--end::Navbar Search-->
        <!--begin::Messages Dropdown Menu-->
        <li class="nav-item dropdown">
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
            <a href="#" class="dropdown-item">
                <!--begin::Message-->
                <div class="d-flex">
                <div class="flex-shrink-0">
                    <img
                    src="./assets/img/user1-128x128.jpg"
                    alt="User Avatar"
                    class="img-size-50 rounded-circle me-3"
                    />
                </div>
                <div class="flex-grow-1">
                    <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-end fs-7 text-danger"
                        ><i class="bi bi-star-fill"></i
                    ></span>
                    </h3>
                    <p class="fs-7">Call me whenever you can...</p>
                    <p class="fs-7 text-secondary">
                    <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                    </p>
                </div>
                </div>
                <!--end::Message-->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <!--begin::Message-->
                <div class="d-flex">
                <div class="flex-shrink-0">
                    <img
                    src="./assets/img/user8-128x128.jpg"
                    alt="User Avatar"
                    class="img-size-50 rounded-circle me-3"
                    />
                </div>
                <div class="flex-grow-1">
                    <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-end fs-7 text-secondary">
                        <i class="bi bi-star-fill"></i>
                    </span>
                    </h3>
                    <p class="fs-7">I got your message bro</p>
                    <p class="fs-7 text-secondary">
                    <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                    </p>
                </div>
                </div>
                <!--end::Message-->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <!--begin::Message-->
                <div class="d-flex">
                <div class="flex-shrink-0">
                    <img
                    src="./assets/img/user3-128x128.jpg"
                    alt="User Avatar"
                    class="img-size-50 rounded-circle me-3"
                    />
                </div>
                <div class="flex-grow-1">
                    <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-end fs-7 text-warning">
                        <i class="bi bi-star-fill"></i>
                    </span>
                    </h3>
                    <p class="fs-7">The subject goes here</p>
                    <p class="fs-7 text-secondary">
                    <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                    </p>
                </div>
                </div>
                <!--end::Message-->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <!--end::Messages Dropdown Menu-->
        <!--begin::Notifications Dropdown Menu-->
        <li class="nav-item dropdown">
            <a class="nav-link" data-bs-toggle="dropdown" href="#">
            <i class="bi bi-bell-fill"></i>
            <span class="navbar-badge badge text-bg-warning">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
            <span class="dropdown-item dropdown-header">15 Notifikasi</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <i class="bi bi-envelope me-2"></i> 4 new messages
                <span class="float-end text-secondary fs-7">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <i class="bi bi-people-fill me-2"></i> 8 friend requests
                <span class="float-end text-secondary fs-7">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                <span class="float-end text-secondary fs-7">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
            </div>
        </li>
        <!--end::Notifications Dropdown Menu-->
        <!--begin::Fullscreen Toggle-->
        <li class="nav-item">
            <a class="nav-link" href="#" data-lte-toggle="fullscreen">
            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
            </a>
        </li>
        <!--end::Fullscreen Toggle-->
        <!--begin::User Menu Dropdown-->
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <img
                src="./assets/img/user2-160x160.jpg"
                class="user-image rounded-circle shadow"
                alt="User Image"
            />
            <span class="d-none d-md-inline">' . htmlspecialchars($user_name) . '</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
            <!--begin::User Image-->
            <li class="user-header text-bg-primary">
                <img
                src="./assets/img/user2-160x160.jpg"
                class="rounded-circle shadow"
                alt="User Image"
                />
                <p>
                ' . htmlspecialchars($user_name) . ' - Web Developer
                <small>Member since Nov. 2023</small>
                </p>
            </li>
            <!--end::User Image-->
            <!--begin::Menu Body-->
            <li class="user-body">
                <!--begin::Row-->
                <div class="row">
                <div class="col-4 text-center"><a href="#">Followers</a></div>
                <div class="col-4 text-center"><a href="#">Sales</a></div>
                <div class="col-4 text-center"><a href="#">Friends</a></div>
                </div>
                <!--end::Row-->
            </li>
            <!--end::Menu Body-->
            <!--begin::Menu Footer-->
            <li class="user-footer">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
                <a href="../views/logout.php" class="btn btn-default btn-flat float-end">Sign out</a>
            </li>
            <!--end::Menu Footer-->
            </ul>
        </li>
        <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>';
?>