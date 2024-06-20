<?php
    $dashboard = FALSE;
    $subscriptions = FALSE;
    $inventory_management = FALSE;
    $support_center = FALSE;
	$purchase_request = FALSE;


    if ($active_page == 'dashboard_page') {
        $dashboard = TRUE;
    }elseif($active_page == 'subscriptions_page') {
        $subscriptions = TRUE;
    }elseif ($active_page == 'inventory_management_page') {
        $inventory_management = TRUE;
    }elseif ($active_page == 'support_center_page') {
        $support_center = TRUE;
    }elseif($active_page == "purchase_request_page"){
		$purchase_request = TRUE;
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



                <li class="menu-item ">
                    <a href="<?= base_url('client/subscription');?>"
                        class="menu-link <?= ($subscriptions) ? 'menu-link-active' : '';?>">
                        <i class="menu-icon tf-icons bi bi-credit-card-2-front-fill"></i>
                        <div data-i18n="Analytics">Subscriptions</div>
                    </a>
                </li>

                <li class="menu-item ">
                    <a href="<?= base_url('client/purchase-request');?>"
                        class="menu-link <?= ($purchase_request) ? 'menu-link-active' : '';?>">
                        <i class="menu-icon tf-icons bi bi-clipboard-check-fill"></i>
                        <div data-i18n="Analytics">Purchase Request <span class="badge bg-danger purchaseRequest"></span></div>
                    </a>
                </li>

                <li class="menu-item ">
                    <a href="<?= base_url('client/crm-inventory_management');?>"
                        class="menu-link <?= ($inventory_management) ? 'menu-link-active' : '';?>">
                        <i class="menu-icon tf-icons bi bi-box-fill"></i>
                        <div data-i18n="Analytics">Inventory Management</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?= base_url('client/crm-support_center');?>"
                        class="menu-link <?= ($support_center) ? 'menu-link-active' : '';?>">
                        <i class="menu-icon tf-icons bi bi-question-circle-fill"></i>
                        <div data-i18n="Analytics">Support Center</div>
                    </a>
                </li>


            </ul>
        </aside>



        <!-- / Menu -->
