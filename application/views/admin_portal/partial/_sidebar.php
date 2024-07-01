<?php
    $dashboard = FALSE;

    if ($active_page == 'dashboard_page') {
        $dashboard = TRUE;
    }

?>
<style>
.side-bar-title {
    color: #3E4C59;
}

.app-brand {
    border-bottom: 1px solid #E4E7EB;
    padding: 2.3rem 0;
    border-right: 1px solid #E4E7EB;

}

.menu-link {
    color: #2BB0ED;
    transition: color 0.3s ease-in-out, opacity 0.3s ease-in-out;
}

.menu-link:hover {
    color: #2BB0ED;
    opacity: 0.8;
    background-color: #E3F8FF;
    border-radius: 8px;
}

.menu-link-active {
    background-color: #1992D4;
    border-radius: 8px;
    color: #ffffff;
}
</style>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-white">
            <div class="app-brand demo">
                <a href="<?= base_url('client/crm-dashboard');?>" class="app-brand-link">
                    <span class="app-brand-logo demo">
                        <img src="<?= base_url('assets/images/logo-sm.png');?>">
                    </span>
                    <span class="app-brand-text demo menu-text fw-bold ms-2 side-bar-title fs-5">ADMIN CONSOLE</span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>
            <div class="app-brand-divider"></div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">


                <li class="menu-item ">
                    <a href="<?= base_url('client/crm-dashboard');?>"
                        class="<?= ($dashboard) ? 'menu-link-active' : '';?> menu-link">
                        <i class="menu-icon tf-icons bx bxs-dashboard"></i>
                        <div data-i18n="Analytics">Dashboard</div>
                    </a>
                </li>


            </ul>
        </aside>



        <!-- / Menu -->
