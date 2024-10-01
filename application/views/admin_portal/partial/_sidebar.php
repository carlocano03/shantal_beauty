<?php
    $dashboard = FALSE;
    $settings = FALSE;
    $account_management = FALSE;
    $request = FALSE;
    $reseller = FALSE;
    $active_user = FALSE;
    $reseller_account = FALSE;
    $user_account = FALSE;
    $inventory = FALSE;
    $product_management = FALSE;
    $voucher = FALSE;
    $order = FALSE;
    $pending = FALSE;
    $list_order = FALSE;

    if ($active_page == 'dashboard_page') {
        $dashboard = TRUE;
    } elseif ($active_page == 'reseller_page') {
        $request = TRUE;
        $reseller = TRUE;
    } elseif ($active_page == 'reseller_account_page') {
        $active_user = TRUE;
        $reseller_account = TRUE;
    } elseif ($active_page == 'user_account_page') {
        $active_user = TRUE;
        $user_account = TRUE;
    } elseif ($active_page == 'product_page') {
        $inventory = TRUE;
        $product_management = TRUE;
    } elseif ($active_page == 'account_management_page') {
        $settings = TRUE;
        $account_management = TRUE;
    } elseif ($active_page == 'voucher_page') {
        $voucher = TRUE;
    } elseif ($active_page == 'pending_order_page') {
        $order = TRUE;
        $pending = TRUE;
    } elseif ($active_page == 'order_page') {
        $order = TRUE;
        $list_order = TRUE;
    }


?>
<style>
.side-bar-title {
    color: #ffffff;
}

.app-brand {
    border-bottom: 1px solid #E4E7EB;
    padding: 2.3rem 0;
    border-right: 1px solid #E4E7EB;

}

.menu-link {
    color: #ffffff;
    transition: opacity 0.3s ease-in-out, color 0.3s ease-in-out, background-color 0.3s ease-in-out !important;
    border-radius: 8px;
}

.menu-link:hover {
    color: #434875;
    opacity: 0.8;
    background-color: #ffffff;
    border-radius: 8px;
}


.menu-item {
    color: #ffffff;
}

.menu-link-active {
    background-color: #ffffff;
    border-radius: 8px;
    color: #434875;
}



.menu {
    background: #000000 !important;
}

.sidebar-menu-header {
    cursor: pointer;
}

.sidebar-menu {
    position: relative;
    padding: 0 0 0 52px;
    width: 15.3rem;

}

.sidebar-menu::before {
    content: "";
    width: 2px;
    background: #F5F7FA;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 48px;

}

.sidebar-menu-item {
    position: relative;
    padding: 0 0 0 6px;
    margin: 6px 0;
}

.sidebar-menu-item::before {
    left: 0;
    top: 20px;
    width: 15px;
    z-index: 1000;
    content: ' ';
    position: absolute;
    display: inline-block;
    border: 1px solid #F5F7FA;
}


.menu-link-active-2 {
    background-color: rgba(255, 255, 255, 0.8);
    border-radius: 8px;
    color: #434875;
}

.bg-menu-theme .menu-item.active>.menu-link:not(.menu-toggle) {
    background: rgba(67, 89, 113, 0.2) !important;

}


.icon-chevron {
    transition: transform .35s ease;
    transform-origin: 0.5em 50%;
}



.icon-chevron::before {
    width: 1.25em;
    line-height: 0;
    content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgb%28255%2c%20255%2c%20255%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
    transition: transform .35s ease;
    transform-origin: 0.5em 50%;
    margin-top: 2px;
}

.btn-toggle[aria-expanded="true"] .icon-chevron {
    transform: rotate(90deg);
}

.btn-toggle[aria-expanded="false"] .icon-chevron {
    transform: rotate(0deg);

}


.menu-header-text {
    color: #ffffff;
    font-size: 15px !important;
}

.menu-vertical .menu-header {
    margin: 0 0 0.1rem 0 !important;
    padding: 0.625rem 1rem 0.625rem 1.7rem !important;
}
</style>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-white">
            <div class="app-brand demo">
                <a href="<?= base_url('admin/dashboard');?>" class="app-brand-link">
                    <span class="app-brand-logo demo">
                        <img src="<?= base_url('assets/images/home/shantal-logo.png');?>">
                    </span>
                    <span class="app-brand-text demo menu-text fw-bold ms-2 side-bar-title fs-5">
                        Shantals Beauty & <br>
                        Wellness
                    </span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>
            <div class="app-brand-divider"></div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">

                <!-- ADMINISTRATOR MENU -->
                <?php if ($this->session->userdata('adminIn')['user_type_id'] == ADMINISTRATOR) : ?>
                    <li class="menu-item ">
                        <a href="<?= base_url('admin/dashboard');?>"
                            class="<?= ($dashboard) ? 'menu-link-active' : '';?> menu-link">
                            <i class="menu-icon tf-icons bx bxs-dashboard"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>

                    <li class="menu-item ">
                        <a href="<?= base_url('admin/voucher');?>"
                            class="<?= ($voucher) ? 'menu-link-active' : '';?> menu-link">
                            <i class="menu-icon tf-icons bi bi-ticket-detailed-fill"></i>
                            <div data-i18n="Analytics">Voucher Request <span class="badge bg-danger voucher_request"></span></div>
                        </a>
                    </li>

                    <!-- Online Orders -->
                    <li class="menu-header  btn btn-toggle" data-bs-toggle="collapse" data-bs-target="#order"
                        aria-expanded="<?= ($order) ? 'true' : '';?>">
                        <div class="d-flex justify-content-between align-items-center ">
                            <div class="d-flex align-items-center">
                                <i class="menu-icon tf-icons bi bi-basket2-fill" style="color:#ffffff;"></i>
                                <div class="menu-header-text">Order Online <span class="badge bg-danger order_online"></span></div>
                            </div>
                            <div class="icon-chevron"></div>
                        </div>
                    </li>

                    <div>
                        <div class="collapse <?= ($order) ? 'show' : '';?>" id="order" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small sidebar-menu">
                                <li class="menu-item sidebar-menu-item <?= ($pending) ? 'active' : '';?>">
                                    <a href="<?= base_url('admin/pending-orders');?>"
                                        class="<?= ($pending) ? 'menu-link-active-2' : '';?> menu-link">
                                        <div data-i18n="Account">Pending Orders <span class="badge bg-danger pending_orders"></span></div>
                                    </a>
                                </li>
                                <li class="menu-item sidebar-menu-item <?= ($list_order) ? 'active' : '';?>">
                                    <a href="<?= base_url('admin/list-orders');?>"
                                        class="<?= ($list_order) ? 'menu-link-active-2' : '';?> menu-link">
                                        <div data-i18n="Account">List of Orders</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End -->

                    <!-- Request -->
                    <li class="menu-header  btn btn-toggle" data-bs-toggle="collapse" data-bs-target="#request"
                        aria-expanded="<?= ($request) ? 'true' : '';?>">
                        <div class="d-flex justify-content-between align-items-center ">
                            <div class="d-flex align-items-center">
                                <i class="menu-icon tf-icons bi bi-window-stack" style="color:#ffffff;"></i>
                                <div class="menu-header-text">Application Request <span class="badge bg-danger application_request"></span></div>
                            </div>
                            <div class="icon-chevron"></div>
                        </div>
                    </li>

                    <div>
                        <div class="collapse <?= ($request) ? 'show' : '';?>" id="request" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small sidebar-menu">
                                <li class="menu-item sidebar-menu-item <?= ($reseller) ? 'active' : '';?>">
                                    <a href="<?= base_url('admin/reseller-application');?>"
                                        class="<?= ($reseller) ? 'menu-link-active-2' : '';?> menu-link">
                                        <div data-i18n="Account">Resellers <span class="badge bg-danger reseller_request"></span></div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End -->

                    <!-- Request -->
                    <li class="menu-header  btn btn-toggle" data-bs-toggle="collapse" data-bs-target="#user"
                        aria-expanded="<?= ($active_user) ? 'true' : '';?>">
                        <div class="d-flex justify-content-between align-items-center ">
                            <div class="d-flex align-items-center">
                                <i class="menu-icon tf-icons bi bi-people" style="color:#ffffff;"></i>
                                <div class="menu-header-text">Active Users</div>
                            </div>
                            <div class="icon-chevron"></div>
                        </div>
                    </li>

                    <div>
                        <div class="collapse <?= ($active_user) ? 'show' : '';?>" id="user" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small sidebar-menu">
                                <li class="menu-item sidebar-menu-item <?= ($reseller_account) ? 'active' : '';?>">
                                    <a href="<?= base_url('admin/reseller-account');?>"
                                        class="<?= ($reseller_account) ? 'menu-link-active-2' : '';?> menu-link">
                                        <div data-i18n="Account">Resellers Account</div>
                                    </a>
                                </li>

                                <li class="menu-item sidebar-menu-item <?= ($user_account) ? 'active' : '';?>">
                                    <a href="<?= base_url('admin/user-account');?>"
                                        class="<?= ($user_account) ? 'menu-link-active-2' : '';?> menu-link">
                                        <div data-i18n="Account">User Account</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End -->

                    <!-- Inventory management -->
                    <li class="menu-header  btn btn-toggle" data-bs-toggle="collapse" data-bs-target="#inventory"
                        aria-expanded="<?= ($inventory) ? 'true' : '';?>">
                        <div class="d-flex justify-content-between align-items-center ">
                            <div class="d-flex align-items-center">
                                <i class="menu-icon tf-icons bi bi-box-seam-fill" style="color:#ffffff;"></i>
                                <div class="menu-header-text">Inventory Management</div>
                            </div>
                            <div class="icon-chevron"></div>
                        </div>
                    </li>

                    <div>
                        <div class="collapse <?= ($inventory) ? 'show' : '';?>" id="inventory" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small sidebar-menu">
                                <li class="menu-item sidebar-menu-item <?= ($product_management) ? 'active' : '';?>">
                                    <a href="<?= base_url('admin/product-management');?>"
                                        class="<?= ($product_management) ? 'menu-link-active-2' : '';?> menu-link">
                                        <div data-i18n="Account">Product Management</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End -->

                    <!-- Settings -->
                    <li class="menu-header  btn btn-toggle" data-bs-toggle="collapse" data-bs-target="#sample"
                        aria-expanded="<?= ($settings) ? 'true' : '';?>">
                        <div class="d-flex justify-content-between align-items-center ">
                            <div class="d-flex align-items-center">
                                <i class="menu-icon tf-icons bi bi-gear" style="color:#ffffff;"></i>
                                <div class="menu-header-text">Manage Settings <span class="badge bg-danger settings_count"></span></div>
                            </div>
                            <div class="icon-chevron"></div>
                        </div>
                    </li>

                    <div>
                        <div class="collapse <?= ($settings) ? 'show' : '';?>" id="sample" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small sidebar-menu">
                                <li class="menu-item sidebar-menu-item <?= ($account_management) ? 'active' : '';?>">
                                    <a href="<?= base_url('admin/account-management');?>"
                                        class="<?= ($account_management) ? 'menu-link-active-2' : '';?> menu-link">
                                        <div data-i18n="Account">Account Management</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End -->
                <!-- END OF ADMINISTRATOR -->


                <!-- ADMIN STAFF MENU -->
                <?php else : ?>

                    <li class="menu-item ">
                        <a href="<?= base_url('admin/dashboard');?>"
                            class="<?= ($dashboard) ? 'menu-link-active' : '';?> menu-link">
                            <i class="menu-icon tf-icons bx bxs-dashboard"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>

                    <?php if (in_array(VOUCHER, $role_permissions)): ?>
                    <li class="menu-item ">
                        <a href="<?= base_url('admin/voucher');?>"
                            class="<?= ($voucher) ? 'menu-link-active' : '';?> menu-link">
                            <i class="menu-icon tf-icons bi bi-ticket-detailed-fill"></i>
                            <div data-i18n="Analytics">Voucher Request <span class="badge bg-danger voucher_request"></span></div>
                        </a>
                    </li>
                    <?php endif;?>

                    <!-- Online Orders -->
                    <?php if (array_intersect([PENDING_ORDER, ORDERS], $role_permissions)): ?>
                    <li class="menu-header  btn btn-toggle" data-bs-toggle="collapse" data-bs-target="#order"
                        aria-expanded="<?= ($order) ? 'true' : '';?>">
                        <div class="d-flex justify-content-between align-items-center ">
                            <div class="d-flex align-items-center">
                                <i class="menu-icon tf-icons bi bi-basket2-fill" style="color:#ffffff;"></i>
                                <div class="menu-header-text">Order Online <span class="badge bg-danger order_online"></span></div>
                            </div>
                            <div class="icon-chevron"></div>
                        </div>
                    </li>

                    <div>
                        <div class="collapse <?= ($order) ? 'show' : '';?>" id="order" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small sidebar-menu">
                                <?php if (in_array(PENDING_ORDER, $role_permissions)): ?>
                                <li class="menu-item sidebar-menu-item <?= ($pending) ? 'active' : '';?>">
                                    <a href="<?= base_url('admin/pending-orders');?>"
                                        class="<?= ($pending) ? 'menu-link-active-2' : '';?> menu-link">
                                        <div data-i18n="Account">Pending Orders <span class="badge bg-danger pending_orders"></span></div>
                                    </a>
                                </li>
                                <?php endif;?>

                                <?php if (in_array(ORDERS, $role_permissions)): ?>
                                <li class="menu-item sidebar-menu-item <?= ($list_order) ? 'active' : '';?>">
                                    <a href="<?= base_url('admin/list-orders');?>"
                                        class="<?= ($list_order) ? 'menu-link-active-2' : '';?> menu-link">
                                        <div data-i18n="Account">List of Orders</div>
                                    </a>
                                </li>
                                <?php endif;?>
                            </ul>
                        </div>
                    </div>
                    <?php endif;?>
                    <!-- End -->

                    <!-- Request -->
                    <?php if (array_intersect([RESELLERS], $role_permissions)): ?>
                    <li class="menu-header  btn btn-toggle" data-bs-toggle="collapse" data-bs-target="#request"
                        aria-expanded="<?= ($request) ? 'true' : '';?>">
                        <div class="d-flex justify-content-between align-items-center ">
                            <div class="d-flex align-items-center">
                                <i class="menu-icon tf-icons bi bi-window-stack" style="color:#ffffff;"></i>
                                <div class="menu-header-text">Application Request <span class="badge bg-danger application_request"></span></div>
                            </div>
                            <div class="icon-chevron"></div>
                        </div>
                    </li>

                    <div>
                        <div class="collapse <?= ($request) ? 'show' : '';?>" id="request" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small sidebar-menu">
                                <?php if (in_array(RESELLERS, $role_permissions)): ?>
                                <li class="menu-item sidebar-menu-item <?= ($reseller) ? 'active' : '';?>">
                                    <a href="<?= base_url('admin/reseller-application');?>"
                                        class="<?= ($reseller) ? 'menu-link-active-2' : '';?> menu-link">
                                        <div data-i18n="Account">Resellers <span class="badge bg-danger reseller_request"></span></div>
                                    </a>
                                </li>
                                <?php endif;?>
                            </ul>
                        </div>
                    </div>
                    <?php endif;?>
                    <!-- End -->

                    <?php if (array_intersect([RESELLER_ACCT, USER_ACCT], $role_permissions)): ?>
                    <!-- Active Users -->
                    <li class="menu-header  btn btn-toggle" data-bs-toggle="collapse" data-bs-target="#user"
                        aria-expanded="<?= ($active_user) ? 'true' : '';?>">
                        <div class="d-flex justify-content-between align-items-center ">
                            <div class="d-flex align-items-center">
                                <i class="menu-icon tf-icons bi bi-people" style="color:#ffffff;"></i>
                                <div class="menu-header-text">Active Users</div>
                            </div>
                            <div class="icon-chevron"></div>
                        </div>
                    </li>

                    <div>
                        <div class="collapse <?= ($active_user) ? 'show' : '';?>" id="user" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small sidebar-menu">
                                <?php if (in_array(RESELLER_ACCT, $role_permissions)): ?>
                                <li class="menu-item sidebar-menu-item <?= ($reseller_account) ? 'active' : '';?>">
                                    <a href="<?= base_url('admin/reseller-account');?>"
                                        class="<?= ($reseller_account) ? 'menu-link-active-2' : '';?> menu-link">
                                        <div data-i18n="Account">Resellers Account</div>
                                    </a>
                                </li>
                                <?php endif;?>

                                <?php if (in_array(USER_ACCT, $role_permissions)): ?>
                                <li class="menu-item sidebar-menu-item <?= ($user_account) ? 'active' : '';?>">
                                    <a href="<?= base_url('admin/user-account');?>"
                                        class="<?= ($user_account) ? 'menu-link-active-2' : '';?> menu-link">
                                        <div data-i18n="Account">User Account</div>
                                    </a>
                                </li>
                                <?php endif;?>
                            </ul>
                        </div>
                    </div>
                    <?php endif;?>
                    <!-- End -->

                    <?php if (array_intersect([PRODUCT], $role_permissions)): ?>
                    <!-- Inventory management -->
                    <li class="menu-header  btn btn-toggle" data-bs-toggle="collapse" data-bs-target="#inventory"
                        aria-expanded="<?= ($inventory) ? 'true' : '';?>">
                        <div class="d-flex justify-content-between align-items-center ">
                            <div class="d-flex align-items-center">
                                <i class="menu-icon tf-icons bi bi-box-seam-fill" style="color:#ffffff;"></i>
                                <div class="menu-header-text">Inventory Management</div>
                            </div>
                            <div class="icon-chevron"></div>
                        </div>
                    </li>

                    <div>
                        <div class="collapse <?= ($inventory) ? 'show' : '';?>" id="inventory" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small sidebar-menu">
                                <?php if (in_array(PRODUCT, $role_permissions)): ?>
                                <li class="menu-item sidebar-menu-item <?= ($product_management) ? 'active' : '';?>">
                                    <a href="<?= base_url('admin/product-management');?>"
                                        class="<?= ($product_management) ? 'menu-link-active-2' : '';?> menu-link">
                                        <div data-i18n="Account">Product Management</div>
                                    </a>
                                </li>
                                <?php endif;?>
                            </ul>
                        </div>
                    </div>
                    <?php endif;?>
                    <!-- End -->

                    <?php if (array_intersect([ACCOUNT_MANAGEMENT], $role_permissions)): ?>
                    <!-- Settings -->
                    <li class="menu-header  btn btn-toggle" data-bs-toggle="collapse" data-bs-target="#sample"
                        aria-expanded="<?= ($settings) ? 'true' : '';?>">
                        <div class="d-flex justify-content-between align-items-center ">
                            <div class="d-flex align-items-center">
                                <i class="menu-icon tf-icons bi bi-gear" style="color:#ffffff;"></i>
                                <div class="menu-header-text">Manage Settings <span class="badge bg-danger settings_count"></span></div>
                            </div>
                            <div class="icon-chevron"></div>
                        </div>
                    </li>

                    <div>
                        <div class="collapse <?= ($settings) ? 'show' : '';?>" id="sample" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small sidebar-menu">
                                <?php if (in_array(ACCOUNT_MANAGEMENT, $role_permissions)): ?>
                                <li class="menu-item sidebar-menu-item <?= ($account_management) ? 'active' : '';?>">
                                    <a href="<?= base_url('admin/account-management');?>"
                                        class="<?= ($account_management) ? 'menu-link-active-2' : '';?> menu-link">
                                        <div data-i18n="Account">Account Management</div>
                                    </a>
                                </li>
                                <?php endif;?>
                            </ul>
                        </div>
                    </div>
                    <?php endif;?>
                    <!-- End -->

                <!-- END OF ADMIN STAFF -->

                <?php endif;?>
                
            </ul>
        </aside>



        <!-- / Menu -->
