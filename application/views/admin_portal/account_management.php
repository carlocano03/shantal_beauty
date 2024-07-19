<style>
@keyframes round {

    0% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.2);
    }

    100% {
        transform: scale(1.4);
    }
}

.overview-card {
    background: #ffffff;
    border-radius: 15px;
    padding: 1.25rem;
    color: #434875;
    box-shadow: 0 9px 20px rgba(46, 35, 94, .07);
    border: 2px solid #434875;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.overview-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 25px rgba(46, 35, 94, .15);
}

.overview-card__title {
    color: #434875;
    letter-spacing: .025em;
    font-weight: 600;
    font-size: 16px;
}

.custom-card {
    background: #f1f5f9;
    padding: 1rem;
    border-radius: .5rem;
    height: 100%;
}

.dashboard__img {
    width: 6rem;
}

.dashboard__img-container {
    padding: .4rem;
    border-radius: 100%;
    background-color: #ffffff;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
}

.custom-card__title {
    font-weight: 900;
    font-size: 1.6rem;
    background: linear-gradient(to right, #434875, #b18647);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-fill-color: transparent;
}

.error-text {
    color: #f44336
}

.success-text {
    color: #4caf50;

}

.custom-card__sub-text {
    color: rgba(82, 82, 108, .8);
    line-height: 1.125rem;
    font-weight: bold;
}

.table__title {
    font-size: 20px;
    font-weight: 500;
    color: #434875 !important;
    padding: 8px 0;
    margin-bottom: 0;

}

.card {
    background: #ffffff;
    border-radius: 8px;
    color: #434875;
    box-shadow: 0 9px 20px rgba(46, 35, 94, .07);
}
</style>
<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header mb-3 pb-3 d-flex align-items-center gap-2 ">
                <img src="<?php echo base_url('assets/images/account_management.png'); ?>" width="36px"
                    alt="Calendar" />
                <h5 class="table__title"><?= $card_title?></h5>
            </div>
            <div class="card-body mt-4">
                <div class="row gy-3 gy-lg-0">
                    <div class="col-md-4">
                        <a
                            href="<?= base_url('admin/account-management/account-list?info='.$this->cipher->encrypt(ADMINISTRATOR))?>">
                            <div class="overview-card">
                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                    <div class="dashboard__img-container">
                                        <img width="72px"
                                            src="<?php echo base_url('assets/images/dashboard/administration.png'); ?>"
                                            alt="administration" />
                                    </div>
                                    <div class="flex flex-column text-end">
                                        <div class="custom-card__title" id="total_admin"></div>
                                        <div class="custom-card__sub-text">
                                            Administrator Account
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a
                            href="<?= base_url('admin/account-management/account-list?info='.$this->cipher->encrypt(ADMIN_STAFF))?>">
                            <div class="overview-card">
                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                    <div class="dashboard__img-container">
                                        <img width="72px"
                                            src="<?php echo base_url('assets/images/dashboard/verified-account.png'); ?>"
                                            alt="Scholars" />
                                    </div>
                                    <div class="flex flex-column text-end">
                                        <div class="custom-card__title" id="total_user"></div>
                                        <div class="custom-card__sub-text">
                                            Admin Staff Account
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a
                            href="<?= base_url('admin/account-management/account-list?info='.$this->cipher->encrypt(STUDENT))?>">
                            <div class="overview-card">
                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                    <div class="dashboard__img-container">
                                        <img width="72px"
                                            src="<?php echo base_url('assets/images/dashboard/scholars.png'); ?>"
                                            alt="Scholars" />
                                    </div>
                                    <div class="flex flex-column text-end">
                                        <div class="custom-card__title" id="total_student"></div>
                                        <div class="custom-card__sub-text">
                                            Student Account
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->


    <script>
    function getUserTotal() {
        $.ajax({
            url: "<?= base_url('portal/admin_portal/account_management/getUserTotal')?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                const countUpConfigs = [{
                        elementId: 'total_admin',
                        targetValue: data.total_admin,

                    },
                    {
                        elementId: 'total_user',
                        targetValue: data.total_user,

                    },
                    {
                        elementId: 'total_student',
                        targetValue: data.total_student,

                    }
                ];

                countUpConfigs.forEach((config) => {
                    var countUp = new CountUp(config.elementId, 0, config.targetValue, 0,
                        4, {
                            duration: 2,
                            useEasing: true,
                            separator: ',',
                        });

                    if (!countUp.error) {
                        countUp.start();
                    } else {
                        console.error("CountUp Error:", countUp.error);
                    }
                });
            }
        });
    }

    $(document).ready(function() {
        getUserTotal();
    });
    </script>