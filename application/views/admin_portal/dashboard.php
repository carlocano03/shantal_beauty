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
    width: 3rem;
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
    color: #212529;
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
</style>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y" style="max-width:100%">

        <div class="row">
            <div class="col-lg-8">
                <div class="row row-cols-lg-4">
                    <div class="col">
                        <div class="overview-card">
                            <div class="d-flex align-items-center gap-3">
                                <div class="dashboard__img-container">
                                    <img class="dashboard__img"
                                        src="<?php echo base_url('assets/images/dashboard/scholars.png'); ?>"
                                        alt="Scholars" />
                                </div>
                                <div class="flex flex-column">
                                    <div class="custom-card__title ">209</div>
                                    <div class="custom-card__sub-text">
                                        Total Scholars
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="overview-card">
                            <div class="d-flex align-items-center gap-3">
                                <div class="dashboard__img-container">
                                    <img class="dashboard__img"
                                        src="<?php echo base_url('assets/images/dashboard/scholars.png'); ?>"
                                        alt="Scholars" />
                                </div>
                                <div class="flex flex-column">
                                    <div class="custom-card__title ">209</div>
                                    <div class="custom-card__sub-text">
                                        Total Scholars
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="overview-card">
                            <div class="d-flex align-items-center gap-3">
                                <div class="dashboard__img-container">
                                    <img class="dashboard__img"
                                        src="<?php echo base_url('assets/images/dashboard/scholars.png'); ?>"
                                        alt="Scholars" />
                                </div>
                                <div class="flex flex-column">
                                    <div class="custom-card__title ">209</div>
                                    <div class="custom-card__sub-text">
                                        Total Scholars
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="overview-card">
                            <div class="d-flex align-items-center gap-3">
                                <div class="dashboard__img-container">
                                    <img class="dashboard__img"
                                        src="<?php echo base_url('assets/images/dashboard/scholars.png'); ?>"
                                        alt="Scholars" />
                                </div>
                                <div class="flex flex-column">
                                    <div class="custom-card__title ">209</div>
                                    <div class="custom-card__sub-text">
                                        Total Scholars
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col">
                        <div class="overview-card">
                            <h1 class="overview-card__title">Scholars Overview</h1>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col">
                        <div class="overview-card">
                            <h1 class="overview-card__title">Application Status Overview</h1>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col">
                        <div class="overview-card">
                            <h1 class="overview-card__title">Account Overview</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col">
                        <div class="overview-card">
                            <h1 class="overview-card__title">Church Schedule</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/1.7.1/countUp.min.js"></script>