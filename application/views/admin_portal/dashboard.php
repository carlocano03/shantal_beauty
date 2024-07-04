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

.overview-card__no-bg {
    padding: 1.25rem 0 1.25rem 0;
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

.dashboard__img-container--border1 {
    border: 2px solid #b18647;
}

.dashboard__img-container--border2 {
    border: 2px solid #4caf50;

}

.dashboard__img-container--border3 {
    border: 2px solid #3A96DD;
}

.dashboard__img-container--border4 {
    border: 2px solid #f44336;

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
    font-size: 14px;
}

.scholarship-req__avatar {
    width: 2.4rem;
    height: 2.4rem;
    object-fit: cover;
}

.scholarship-req__date {
    font-size: 16px;
    margin-top: 18px;
    color: rgba(82, 82, 108, .8);

}

.scholarship-req__name {
    font-size: 16px;
    font-weight: bold;

}

.scholarship-req__time {
    font-size: 20px;
    font-weight: bold;
}

.scholarship-req__view {
    background: rgba(82, 82, 108, .8);
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 100px;
    cursor: pointer;
}

.scholarship-req__icon {
    font-size: 12px;
}

.scholarship-req__approve {
    background: rgba(82, 82, 108, .8);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 100px;
    width: 24px;
    height: 24px;
    padding: 14px;
    cursor: pointer;
    background: rgba(76, 175, 80, .2);
    color: #4caf50;
    font-weight: bold;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
}

.scholarship-req__denied {
    background: rgba(82, 82, 108, .8);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 100px;
    width: 24px;
    height: 24px;
    padding: 14px;
    cursor: pointer;
    background: rgba(244, 67, 54, .2);
    color: #f44336;
    font-weight: bold;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
}

.scholarship-req__view-all {
    color: #434875;
    font-weight: bold;
    text-decoration: underline;
    cursor: pointer;
    transition: all .3s ease-in-out;
}

.scholarship-req__view-all:hover {
    opacity: 0.6;
}

.table thead {
    background: #E2E8F0 !important;
    color: red !important;
}

.upcoming-sched__create-btn {
    border-radius: 8px;
    padding: 8px 16px;
    background: rgba(82, 82, 108, .1);
    color: #434875;
    font-weight: bold;
    border: none;
    font-size: 12px;

}

/* Sched */
.upcoming-sched__date-container-1 {
    box-shadow: rgba(0, 0, 0, 0.1) 0px 3px 8px;
    border-radius: .5rem;
    padding: 14px;
    border-left: 4px solid #434875;

}

.upcoming-sched__date-container-2 {
    box-shadow: rgba(0, 0, 0, 0.1) 0px 3px 8px;
    border-radius: .5rem;
    padding: 14px;
    border-left: 4px solid #b18647;

}

.upcoming-sched__weekday {
    font-size: 16px;
    margin-bottom: 10px;
    font-weight: bold;

}

.upcoming-sched__date {
    font-size: 14px;
}

.upcoming-sched__time {
    font-size: 14px;
}

.custom-text-success {
    color: #4caf50;
}

.custom-test-primary {
    color: #434875;
}

.custom-text-danger {
    color: #f44336;
}

.custom-date-input {
    position: relative;
}

.custom-date-input input[type="date"] {
    appearance: none;
    -webkit-appearance: none;
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    padding: 6px 15px;
    border-radius: 5px;
    outline: none;
}

.bg-polygon {
    position: relative;
    width: 52px;
    height: 52px;
    clip-path: polygon(40% 7.67949%, 43.1596% 6.20615%, 46.52704% 5.30384%, 50% 5%, 53.47296% 5.30384%, 56.8404% 6.20615%, 60% 7.67949%, 81.65064% 20.17949%, 84.50639% 22.17911%, 86.97152% 24.64425%, 88.97114% 27.5%, 90.44449% 30.6596%, 91.34679% 34.02704%, 91.65064% 37.5%, 91.65064% 62.5%, 91.34679% 65.97296%, 90.44449% 69.3404%, 88.97114% 72.5%, 86.97152% 75.35575%, 84.50639% 77.82089%, 81.65064% 79.82051%, 60% 92.32051%, 56.8404% 93.79385%, 53.47296% 94.69616%, 50% 95%, 46.52704% 94.69616%, 43.1596% 93.79385%, 40% 92.32051%, 18.34936% 79.82051%, 15.49361% 77.82089%, 13.02848% 75.35575%, 11.02886% 72.5%, 9.55551% 69.3404%, 8.65321% 65.97296%, 8.34936% 62.5%, 8.34936% 37.5%, 8.65321% 34.02704%, 9.55551% 30.6596%, 11.02886% 27.5%, 13.02848% 24.64425%, 15.49361% 22.17911%, 18.34936% 20.17949%);
    display: flex;
    align-items: center;
    justify-content: center;

}

.card {
    border-radius: 15px;
    height: 100%;
}

.li-recent-system-updates {
    position: relative;
    padding-bottom: 20px;
}

.li-recent-system-updates::before {
    position: absolute;
    content: "";
    border: 1px dashed #52526c;
    opacity: 0.3;
    top: 12px;
    left: 2px;
    height: calc(100% - 12px);

}

.activity-dot {
    min-width: 6px;
    height: 6px;
    border-radius: 100%;
    position: relative;
    z-index: 2;
    margin-top: 8px;
    animation: round 1.3s ease-in-out infinite;

}

.recent-activity__date {
    background: rgba(82, 82, 108, .1);
    border-radius: 8px;
    padding: 6px 16px;
    display: inline-block;
}

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

.recent-activity__badge--success {
    font-size: 12px;
    padding: 4px 10px;
    font-weight: bold;
    background: rgba(76, 175, 80, .2);
    color: #4caf50;
    border-radius: 6px;
}

.recent-activity__badge--danger {
    font-size: 12px;
    padding: 4px 10px;
    font-weight: bold;
    background: rgba(244, 67, 54, .2);
    color: #f44336;
    border-radius: 6px;
}

.recent-activity__badge--warning {
    font-size: 12px;
    padding: 4px 10px;
    font-weight: bold;
    background: rgba(255, 235, 59, .2);
    color: #fbc02d;
    border-radius: 6px;
}
</style>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y" style="max-width:100%">

        <div class="row gy-3 ">
            <div class="col-lg-8 col-12 order-lg-1 order-2">
                <div class="row row-cols-lg-2 row-cols-1 g-3">
                    <div class="col">
                        <div class="overview-card">
                            <div class="d-flex align-items-center gap-4">
                                <div class="dashboard__img-container dashboard__img-container--border1">
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
                            <div class="d-flex align-items-center gap-4 ">
                                <div class="dashboard__img-container dashboard__img-container--border2">
                                    <img class="dashboard__img"
                                        src="<?php echo base_url('assets/images/dashboard/approve.png'); ?>"
                                        alt="Approved" />
                                </div>
                                <div class="flex flex-column">
                                    <div class="custom-card__title ">209</div>
                                    <div class="custom-card__sub-text">
                                        Approved Students
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="overview-card">
                            <div class="d-flex align-items-center gap-4">
                                <div class="dashboard__img-container dashboard__img-container--border3">
                                    <img class="dashboard__img"
                                        src="<?php echo base_url('assets/images/dashboard/pending.png'); ?>"
                                        alt="Scholars" />
                                </div>
                                <div class="flex flex-column">
                                    <div class="custom-card__title ">2</div>
                                    <div class="custom-card__sub-text">
                                        Pending Approvals
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="overview-card">
                            <div class="d-flex align-items-center gap-4">
                                <div class="dashboard__img-container dashboard__img-container--border4 ">
                                    <img class="dashboard__img"
                                        src="<?php echo base_url('assets/images/dashboard/denied.png'); ?>"
                                        alt="Scholars" />
                                </div>
                                <div class="flex flex-column">
                                    <div class="custom-card__title ">20</div>
                                    <div class="custom-card__sub-text">
                                        Denied Students
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="row mt-4">
                    <div class="col">
                        <div class="overview-card__no-bg">
                            <div class="d-flex align-items-center justify-content-between">
                                <h1 class="overview-card__title m-0">Scholarship Request</h1>
                                <div class="scholarship-req__view-all">View All</div>
                            </div>
                            <div class="row row-cols-lg-2 row-cols-1 gy-lg-0 gy-3 mt-lg-4 mt-2">
                                <div class="col">
                                    <div class="overview-card">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <img class="scholarship-req__avatar"
                                                    src="<?php echo base_url('assets/images/dashboard/boy.png'); ?>"
                                                    alt="applicant">
                                                <div class="scholarship-req__name">Jake Castor</div>
                                            </div>
                                            <div class="scholarship-req__view">
                                                <i
                                                    class="scholarship-req__icon fa-solid fa-arrow-up-right-from-square text-white"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h1 class="scholarship-req__date mb-2">Today, March 8, 2024</h1>
                                                <div class="scholarship-req__time">12:08 PM</div>
                                            </div>
                                            <div class="d-flex align-items-center gap-2 pb-1 align-self-end">
                                                <div class="scholarship-req__approve">
                                                    <i class="fa-solid fa-check"></i>
                                                </div>
                                                <div class="scholarship-req__denied">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="overview-card">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <img class="scholarship-req__avatar"
                                                    src="<?php echo base_url('assets/images/dashboard/boy.png'); ?>"
                                                    alt="applicant">
                                                <div class="scholarship-req__name">Jake Castor</div>
                                            </div>
                                            <div class="scholarship-req__view">
                                                <i
                                                    class="scholarship-req__icon fa-solid fa-arrow-up-right-from-square text-white"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h1 class="scholarship-req__date mb-2">Today, March 8, 2024</h1>
                                                <div class="scholarship-req__time">12:08 PM</div>
                                            </div>
                                            <div class="d-flex align-items-center gap-2 pb-1 align-self-end">
                                                <div class="scholarship-req__approve">
                                                    <i class="fa-solid fa-check"></i>
                                                </div>
                                                <div class="scholarship-req__denied">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col">
                        <div class="overview-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <h1 class="overview-card__title mb-0">Attendance Summary</h1>
                                <div class="custom-date-input">
                                    <input type="date" id="dateInput" class="form-control">
                                </div>
                            </div>
                            <div class="mt-3">
                                <div>
                                    <canvas id="attendanceSummary"></canvas>

                                </div>
                                <div>
                                    <div class="row">
                                        <div class="col"></div>
                                        <div class="col"></div>
                                        <div class="col"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col">
                        <div class="overview-card">
                            <div class="d-flex align-items-center justify-content-between">
                                <h1 class="overview-card__title mb-0">Scholarship Registration Metrics</h1>
                                <div class="custom-date-input">
                                    <input type="date" id="dateInput" class="form-control">
                                </div>
                            </div>
                            <div class="mt-3">
                                <canvas id="registration-metrics"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="row mt-4">
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
                </div> -->
            </div>
            <div class="col-lg-4 col-12 order-lg-2 order-1">
                <div class="row">
                    <div class="col">
                        <div class="overview-card">
                            <div class="d-flex align-items-center justify-content-between">
                                <h1 class="overview-card__title mb-0">Upcoming Schedule</h1>
                                <button class="upcoming-sched__create-btn"><i class="fa-solid fa-plus"></i>
                                    Create</button>
                            </div>

                            <div class="mt-4">
                                <div class="upcoming-sched__date-container-1">
                                    <h1 class="upcoming-sched__weekday">Thursday</h1>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="upcoming-sched__date"><i
                                                class="fa-solid fa-calendar custom-text-primary me-1"></i> July 2,
                                            2024</div>
                                        <div class="upcoming-sched__time"><i
                                                class="fa-solid fa-clock custom-text-danger me-1"></i> 09:00 AM -
                                            12:00 AM</div>
                                    </div>
                                </div>

                                <div class="upcoming-sched__date-container-2 mt-3">
                                    <h1 class="upcoming-sched__weekday">Sunday</h1>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="upcoming-sched__date"><i
                                                class="fa-solid fa-calendar custom-text-primary me-1"></i> July 2,
                                            2024</div>
                                        <div class="upcoming-sched__time"><i
                                                class="fa-solid fa-clock custom-text-danger me-1"></i> 09:00 AM -
                                            12:00 AM</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col">
                        <div class="overview-card">
                            <h1 class="overview-card__title py-2">Recent Activities</h1>


                            <div>
                                <ul class="p-0">
                                    <li class="d-flex li-recent-system-updates">
                                        <div class="activity-dot"
                                            style="background-color: #7366FF;outline: 5px solid rgba(115, 102, 255, 0.25);">
                                        </div>
                                        <div class="ms-3">
                                            <div class=" mb-2 recent-activity__date"><span>July 5, 2024, 2:45
                                                    PM</span></div>
                                            <div class="mt-1">
                                                <h6 class="mb-0 fw-bold" style="color:#434875">Jake Castor submitted an
                                                    excuse letter.
                                                </h6>
                                                <p class="mt-2" style="font-size:14px;color:#9AA5B1">
                                                    jakecastor1010@gmail.com</p>
                                                <p style="font-size:14px;color:#9AA5B1">
                                                    BSIT - 2nd Year</p>
                                                <div class="d-flex align-items-center gap-2 mt-3">
                                                    <p class="m-0" style="font-size:14px;color:#9AA5B1">Status:
                                                    </p>
                                                    <div class="recent-activity__badge--warning">Pending</div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex li-recent-system-updates">
                                        <div class="activity-dot"
                                            style="background-color: #54BA4A;outline: 5px solid rgba(84, 186, 74, 0.25);">
                                        </div>
                                        <div class="ms-3">
                                            <div class=" mb-2 recent-activity__date"><span>July 5, 2024, 2:45
                                                    PM</span></div>
                                            <div class="mt-1">
                                                <h6 class="mb-0 fw-bold" style="color:#434875">Admin B approved the
                                                    registration of Scholar C.
                                                </h6>

                                                <p class="mt-2" style="font-size:14px;color:#9AA5B1">
                                                    jakecastor1010@gmail.com</p>
                                                <p style="font-size:14px;color:#9AA5B1">
                                                    BSIT - 2nd Year</p>

                                                <div class="d-flex align-items-center gap-2 mt-3">
                                                    <p class="m-0" style="font-size:14px;color:#9AA5B1">Approval Status:
                                                    </p>
                                                    <div class="recent-activity__badge--success">Approved</div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex li-recent-system-updates">
                                        <div class="activity-dot"
                                            style="background-color: #FF3364;outline: 5px solid rgba(255, 51, 100, 0.25)">
                                        </div>
                                        <div class="ms-3">
                                            <div class=" mb-2 recent-activity__date"><span>July 5, 2024, 2:45
                                                    PM</span></div>
                                            <div class="mt-1">
                                                <h6 class="mb-0 fw-bold" style="color:#434875">Schedule for Sunday
                                                    service updated.
                                                </h6>
                                                <p class="mt-1" style="font-size:14px;color:#9AA5B1">Admin B / 5 min
                                                    ago
                                                </p>
                                            </div>
                                        </div>
                                    </li>


                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/1.7.1/countUp.min.js"></script>

<script>
const ctx = document.getElementById('attendanceSummary');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            'Tues, Jan 08',
            'Wed, Jan 09',
            'Tues, Jan 08',
            'Wed, Jan 09',
            'Tues, Jan 08',
            'Wed, Jan 09',
            'Wed, Jan 09',
            'Wed, Jan 09'
        ],
        datasets: [{
                label: "Present",
                data: [65, 59, 80, 81, 56, 55, 40, 32],
                backgroundColor: [
                    '#A8E6CF',
                ],
            },
            {
                label: "Absent",
                data: [8, 3, 1, 7, 2, 6, 9, 2],
                backgroundColor: [
                    '#FF8B94',
                ],

            }, {
                label: "Late",
                data: [5, 2, 3, 5, 8, 1, 2, 5],
                backgroundColor: [
                    '#FFECB3',
                ],
            }
        ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }


});
</script>


<script>
const registration = document.getElementById('registration-metrics');

const registrationData = {
    labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"],
    datasets: [{
            label: 'Total Scholarship Applications',
            data: [0, 79, 300, 112, 166, 235, 320, 166, 35, 20],
            fill: false,
            borderColor: '#32C7ED',
            tension: 0.1
        },

    ]
};

new Chart(registration, {
    type: 'line',
    data: registrationData,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },

        }
    },


})
</script>