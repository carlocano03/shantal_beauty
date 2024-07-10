<?php
    $dashboard = FALSE;
    $scholarship_request = FALSE;
    $student_record = FALSE;
    $settings = FALSE;
    $account_management = FALSE;
    $church_settings = FALSE;
    $late_rules = FALSE;
    $attendance = FALSE;

    if ($active_page == 'dashboard_page') {
        $dashboard = TRUE;
    } elseif ($active_page == 'scholarship_page') {
        $scholarship_request = TRUE;
    } elseif ($active_page == 'student_record_page') {
        $student_record = TRUE;
    } elseif ($active_page == 'account_page') {
        $settings = TRUE;
        $account_management = TRUE;
    } elseif ($active_page == 'church_settings_page') {
        $settings = TRUE;
        $church_settings = TRUE;
    } elseif ($active_page == 'late_rules_page') {
        $settings = TRUE;
        $late_rules = TRUE;
    } elseif ($active_page == 'attendance_page') {
        $attendance = TRUE;
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
    background: linear-gradient(to bottom right, #434875, #b18647);
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
                <a href="<?= base_url('client/crm-dashboard');?>" class="app-brand-link">
                    <span class="app-brand-logo demo">
                        <img src="<?= base_url('assets/images/home/clc.jpg');?>">
                    </span>
                    <span class="app-brand-text demo menu-text fw-bold ms-2 side-bar-title fs-4">CLCC
                        PORTAL</span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>
            <div class="app-brand-divider"></div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">

                <?php if ($this->session->userdata('adminIn')['user_type_id'] == ADMINISTRATOR) : ?>
                    <li class="menu-item ">
                        <a href="<?= base_url('admin/dashboard');?>"
                            class="<?= ($dashboard) ? 'menu-link-active' : '';?> menu-link">
                            <i class="menu-icon tf-icons bx bxs-dashboard"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>

                    <li class="menu-item ">
                        <a href="<?= base_url('admin/scholarship-approval');?>"
                            class="<?= ($scholarship_request) ? 'menu-link-active' : '';?> menu-link">
                            <i class="menu-icon tf-icons bi bi-person-vcard"></i>
                            <div data-i18n="Analytics">Scholarship Request</div>
                        </a>
                    </li>

                    <li class="menu-item ">
                        <a href="<?= base_url('admin/scholars-record');?>"
                            class="<?= ($student_record) ? 'menu-link-active' : '';?> menu-link">
                            <i class="menu-icon tf-icons bi bi-person-lines-fill"></i>
                            <div data-i18n="Analytics">Scholar List</div>
                        </a>
                    </li>

                    <li class="menu-item ">
                        <a href="<?= base_url('admin/attendance-record');?>"
                            class="<?= ($attendance) ? 'menu-link-active' : '';?> menu-link">
                            <i class="menu-icon tf-icons bi bi-calendar-week-fill"></i>
                            <div data-i18n="Analytics">Attendance Record</div>
                        </a>
                    </li>

                    <!-- Settings -->
                    <li class="menu-header  btn btn-toggle" data-bs-toggle="collapse" data-bs-target="#sample"
                        aria-expanded="<?= ($settings) ? 'true' : '';?>">
                        <div class="d-flex justify-content-between align-items-center ">
                            <div class="d-flex align-items-center">
                                <i class="menu-icon tf-icons bi bi-gear" style="color:#ffffff;"></i>
                                <div class="menu-header-text">Manage Settings</div>
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

                                <li class="menu-item sidebar-menu-item <?= ($church_settings) ? 'active' : '';?>">
                                    <a href="<?= base_url('admin/church-schedule');?>"
                                        class="<?= ($church_settings) ? 'menu-link-active-2' : '';?> menu-link">
                                        <div data-i18n="Account">Church Schedule</div>
                                    </a>
                                </li>

                                <li class="menu-item sidebar-menu-item <?= ($late_rules) ? 'active' : '';?>">
                                    <a href="<?= base_url('admin/late-rules-setup');?>"
                                        class="<?= ($late_rules) ? 'menu-link-active-2' : '';?> menu-link">
                                        <div data-i18n="Account">Total Late Rules</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End -->

                <?php else : ?>

                    <?php if (in_array(DASHBOARD, $role_permissions)): ?>
                        <li class="menu-item ">
                            <a href="<?= base_url('admin/dashboard');?>"
                                class="<?= ($dashboard) ? 'menu-link-active' : '';?> menu-link">
                                <i class="menu-icon tf-icons bx bxs-dashboard"></i>
                                <div data-i18n="Analytics">Dashboard</div>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (in_array(SCHOLAR_APPLICATION, $role_permissions)): ?>
                        <li class="menu-item ">
                            <a href="<?= base_url('admin/scholarship-approval');?>"
                                class="<?= ($scholarship_request) ? 'menu-link-active' : '';?> menu-link">
                                <i class="menu-icon tf-icons bi bi-person-vcard"></i>
                                <div data-i18n="Analytics">Scholarship Request</div>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (in_array(STUDENT_RECORD, $role_permissions)): ?>
                        <li class="menu-item ">
                            <a href="<?= base_url('admin/scholars-record');?>"
                                class="<?= ($student_record) ? 'menu-link-active' : '';?> menu-link">
                                <i class="menu-icon tf-icons bi bi-person-lines-fill"></i>
                                <div data-i18n="Analytics">Scholar List</div>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (in_array(ATTENDANCE, $role_permissions)): ?>
                        <li class="menu-item ">
                            <a href="<?= base_url('admin/attendance-record');?>"
                                class="<?= ($attendance) ? 'menu-link-active' : '';?> menu-link">
                                <i class="menu-icon tf-icons bi bi-calendar-week-fill"></i>
                                <div data-i18n="Analytics">Attendance Record</div>
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- Settings -->
                    <?php if (array_intersect([ACCOUNT_MANAGEMENT, CHURCH_SCHEDULE, LATE_RULES], $role_permissions)): ?>
                        <li class="menu-header  btn btn-toggle" data-bs-toggle="collapse" data-bs-target="#sample"
                            aria-expanded="<?= ($settings) ? 'true' : '';?>">
                            <div class="d-flex justify-content-between align-items-center ">
                                <div class="d-flex align-items-center">
                                    <i class="menu-icon tf-icons bi bi-gear" style="color:#ffffff;"></i>
                                    <div class="menu-header-text">Manage Settings</div>
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
                                    <?php endif; ?>

                                    <?php if (in_array(CHURCH_SCHEDULE, $role_permissions)): ?>
                                        <li class="menu-item sidebar-menu-item <?= ($church_settings) ? 'active' : '';?>">
                                            <a href="<?= base_url('admin/church-schedule');?>"
                                                class="<?= ($church_settings) ? 'menu-link-active-2' : '';?> menu-link">
                                                <div data-i18n="Account">Church Schedule</div>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if (in_array(LATE_RULES, $role_permissions)): ?>
                                        <li class="menu-item sidebar-menu-item <?= ($late_rules) ? 'active' : '';?>">
                                            <a href="<?= base_url('admin/late-rules-setup');?>"
                                                class="<?= ($late_rules) ? 'menu-link-active-2' : '';?> menu-link">
                                                <div data-i18n="Account">Total Late Rules</div>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- End -->

                <?php endif; ?>
                


            </ul>
        </aside>



        <!-- / Menu -->