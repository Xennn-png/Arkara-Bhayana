<?php
echo '
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./" class="brand-link">
            <!--begin::Brand Image-->
            <img
                src="../public/images/logo/logo.png"
                alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Arkara Bhayana</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
        <!--begin::Sidebar Menu-->
        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu">
                <a href="./" class="nav-link">
                    <i class="nav-icon bi bi-speedometer"></i>
                    <p>Dasboard</p>
                </a>
            </li>
            <li class="nav-item menu">
                <a href="./data-users.php" class="nav-link">
                    <i class="nav-icon bi bi-speedometer"></i>
                    <p>Data Users</p>
                </a>
            </li>
            <li class="nav-item menu">
                <a href="./data-games.php" class="nav-link">
                    <i class="nav-icon bi bi-speedometer"></i>
                    <p>Data Games</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-box-seam-fill"></i>
                    <p>
                        Daftar Games
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">';

                // Check if there are any games
                if ($list_games->num_rows > 0) {
                    // Loop through each game and display it
                    while ($row = $list_games->fetch_assoc()) {
                        echo '
                        <li class="nav-item">
                            <a href="./games-detail.php?id=' . urlencode($row['nama']) . '" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>' . htmlspecialchars($row['nama']) . '</p>
                            </a>
                        </li>';
                    }
                } else {
                    echo '<li class="nav-item"><p>No games found</p></li>';
                }

                echo '
                </ul>
            </li>
        </ul>
        <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>';
?>