<style>
.table thead {
    background: #E2E8F0 !important;
    color: red !important;
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
                                    <div class="custom-card__title" id="total_scholars">0</div>
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
                                    <div class="custom-card__title" id="total_application">0</div>
                                    <div class="custom-card__sub-text">
                                        Total Scholars Application
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
                                    <div class="custom-card__title"  id="total_approval">0</div>
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
                                    <div class="custom-card__title" id="total_denied">0</div>
                                    <div class="custom-card__sub-text">
                                        Denied Students
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row mt-4" id="request-wrapper">
                    <div class="col">
                        <div class="overview-card__no-bg">
                            <div class="d-flex align-items-center justify-content-between">
                                <h1 class="overview-card__title m-0">Scholarship Request</h1>
                                <a href="<?= base_url('admin/scholarship-approval')?>"><div class="scholarship-req__view-all">View All</div></a>
                            </div>
                            <div class="row row-cols-lg-2 row-cols-1 gy-lg-0 gy-3 mt-lg-4 mt-2" id="request_list">
                                <!-- AJAX REQUEST -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col">
                        <div class="overview-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                    <img class="overview-card__icon"
                                        src="<?php echo base_url('assets/images/dashboard/attendance.png'); ?>" alt="
										Attendance">
                                    <h1 class="overview-card__title mb-0">Attendance Summary</h1>
                                </div>
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
                                <div class="d-flex align-items-center gap-2">
                                    <img class="overview-card__icon"
                                        src="<?php echo base_url('assets/images/dashboard/registration.png'); ?>" alt="
										Registration">
                                    <h1 class="overview-card__title mb-0">Scholarship Registration Metrics</h1>
                                </div>
                                <div class="custom-date-input">
                                    <select name="filter_options" id="filter_options" class="form-select">
                                        <option value="1">Week</option>
                                        <option value="2">Monthly</option>
                                        <option value="3">Yearly</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-3">
                                <canvas id="registration-metrics"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12 order-lg-2 order-1">
                <div class="row">
                    <div class="col">
                        <div class="overview-card">
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                    <img class="overview-card__icon"
                                        src="<?php echo base_url('assets/images/dashboard/upcoming.png'); ?>" alt="
										Registration">
                                    <h1 class="overview-card__title mb-0">Church Schedules</h1>
                                </div>
                            </div>

                            <div class="mt-4" id="available_sched">
                                <!-- AJAX Request -->
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col">
                        <div class="overview-card">
                            <div class="d-flex align-items-center gap-2 py-2">
                                <img class="overview-card__icon"
                                    src="<?php echo base_url('assets/images/dashboard/recent.png'); ?>" alt="Recent">
                                <h1 class="overview-card__title mb-0">Recent Activities</h1>
                            </div>


                            <div class="mt-3">
                                <ul class="p-0" id="recent_activities">
                                    
                                    
                                    <!-- <li class="d-flex li-recent-system-updates">
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
                                    </li> -->


                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

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
    var applicationChartInstance;

    function getCount() 
    {
        $.ajax({
            url: "<?= base_url('portal/admin_portal/main/getCount')?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                const countUpConfigs = [{
                        elementId: 'total_scholars',
                        targetValue: data.total_scholars,

                    },
                    {
                        elementId: 'total_application',
                        targetValue: data.total_application,

                    },
                    {
                        elementId: 'total_approval',
                        targetValue: data.total_approval,

                    },
                    {
                        elementId: 'total_denied',
                        targetValue: data.total_denied,

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

    function getScholarshipRequest()
    {
        $.ajax({
            url: "<?= base_url('portal/admin_portal/main/getScholarshipRequest')?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                if (data.request_count > 0) {
                    $('#request-wrapper').fadeIn(200);
                    $('#request_list').html(data.request_list);
                } else {
                    $('#request-wrapper').hide();
                }
            }
        });
    }

    function getAvailableSched()
    {
        $.ajax({
            url: "<?= base_url('portal/admin_portal/main/getAvailableSched')?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                $('#available_sched').html(data.available_sched);
            }
        });
    }

    function getApplicationChart()
    {
        var range = $('#filter_options').val();
        var applicationData;
        const registration = document.getElementById('registration-metrics');

        if (applicationChartInstance) {
            applicationChartInstance.destroy();
        }

        $.ajax({
            url: "<?= base_url('portal/admin_portal/main/applicationChart')?>",
            method: "GET",
            data: {
                range: range
            },
            success: function(data) {
                var labels = Object.keys(data[0]).filter(key => key !== 'application_status' && key !== 'total_count');

                var formattedLabels = labels.map(date => {
                    var options = { month: 'short', day: '2-digit', year: 'numeric' };
                    var dateObj = new Date(date);
                    return dateObj.toLocaleDateString('en-US', options);
                });

                var datasets = [];
                var aggregatedData = {};

                // Process response to aggregate data
                data.forEach(function(user) {
                    if (!aggregatedData[user.application_status]) {
                        aggregatedData[user.application_status] = new Array(labels.length).fill(0);
                    }
                });

                // Aggregate data
                data.forEach(function(user) {
                    labels.forEach(function(date, index) {
                        aggregatedData[user.application_status][index] += parseInt(user[date]);
                    });
                });

                // Convert aggregated data into datasets array format
                Object.keys(aggregatedData).forEach(function(userType) {
                    datasets.push({
                        label: userType,
                        data: aggregatedData[userType],
                        fill: false,
                        borderColor: userType === 'Total Application' ? '#32C7ED' : userType === 'Approved' ? '#7BDF4A' : '#ff3838', // Assign different colors based on user_type
                        tension: 0.1
                    });
                });

                // Construct applicationData
                var applicationData = {
                    labels: formattedLabels,
                    datasets: datasets
                };

                // Create the chart
                applicationChartInstance = new Chart(registration, {
                    type: 'line',
                    data: applicationData,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top'
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    min: 0
                                }
                            }
                        }
                    }
                });
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }
    
    function getRecentActivities()
    {
        $.ajax({
            url: "<?= base_url('main/getRecentActivities')?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                $('#recent_activities').html(data.recent_activities);
            }
        });
    }

    $(document).ready(function() {
        getCount();
        getScholarshipRequest();
        getAvailableSched();
        getApplicationChart();
        getRecentActivities();

        setInterval(() => {
            getScholarshipRequest();
            getRecentActivities();
        }, 5000);

        $(document).on('change', '#filter_options', function() {
            getApplicationChart();
        });
    });

</script>
