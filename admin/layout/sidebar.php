<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Menu
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?= ($title === "Dashboard" ? "active" : "") ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                    <li class="nav-item">
                        <a href="pengguna.php" class="nav-link <?= ($title === "Pengguna" ? "active" : "") ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pengguna</p>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="postingan.php" class="nav-link <?= ($title === "Postingan" ? "active" : "") ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Postingan Saya</p>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</nav>