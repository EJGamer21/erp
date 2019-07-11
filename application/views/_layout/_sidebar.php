<nav class="col-md-2 d-none d-sm-none d-md-inline d-lg-inline bg-dark sidebar">
    <div class="sidebar-sticky"  style="height: 100vh">
        <h6 class="sidebar-heading d-flex justify-content-between">
            <span>MENU</span>
            <i class="fas fa-bars"></i>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-light active" href="<?= base_url('products'); ?>">
                    <span class="fas fa-box-open"></span>
                    <span>Products</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="<?= base_url('clients'); ?>">
                    <span class="fas fa-users"></span>
                    <span>Clients</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="<?= base_url('users'); ?>">
                    <span class="fas fa-id-badge"></span>
                    <span>Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light"href="<?= base_url('bills/create'); ?>">
                    <span class="fas fa-plus"></span>
                    <span>New bill</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="<?= base_url('reports'); ?>">
                    <span class="fas fa-file-excel"></span>
                    <span>Reports</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="<?= base_url('admin'); ?>">
                    <span class="fas fa-cogs"></span>
                    <span>Configuration</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="#">
                    <span class="fas fa-power-off"></span>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>