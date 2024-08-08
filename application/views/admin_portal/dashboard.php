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
                                    <div class="custom-card__title" id="total_approval">0</div>
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
                                <?php if ($this->session->userdata('adminIn')['user_type_id'] == ADMINISTRATOR) : ?>
                                <a href="<?= base_url('admin/scholarship-approval')?>">
                                    <div class="scholarship-req__view-all">View All</div>
                                </a>
                                <?php else: ?>
                                <?php if (in_array(SCHOLAR_APPLICATION, $role_permissions)): ?>
                                <a href="<?= base_url('admin/scholarship-approval')?>">
                                    <div class="scholarship-req__view-all">View All</div>
                                </a>
                                <?php endif; ?>
                                <?php endif; ?>
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
                <div class="row mb-4">
                    <div class="col">
                        <div class="overview-card">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <img class="overview-card__icon"
                                        src="<?php echo base_url('assets/images/dashboard/upcoming.png'); ?>" alt="
										Registration">
                                    <h1 class="overview-card__title mb-0">Church Schedules</h1>
                                </div>
                                <?php if ($this->session->userdata('adminIn')['user_type_id'] == ADMINISTRATOR) : ?>
                                <a href="<?= base_url('admin/church-schedule')?>"><button
                                        class="upcoming-sched__create-btn"><i
                                            class="fa-solid fa-plus me-1"></i>Create</button></a>
                                <?php else: ?>
                                <?php if (in_array(CHURCH_SCHEDULE, $role_permissions)): ?>
                                <a href="<?= base_url('admin/church-schedule')?>"><button
                                        class="upcoming-sched__create-btn"><i
                                            class="fa-solid fa-plus me-1"></i>Create</button></a>
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>

                            <div class="mt-4" id="available_sched">
                                <!-- AJAX Request -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col">
                        <div class="overview-card">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <img class="overview-card__icon"
                                        src="<?php echo base_url('assets/images/dashboard/deadline.png'); ?>" alt="
										Registration">
                                    <h1 class="overview-card__title mb-0">Deadline for Filling</h1>
                                </div>

                                <button class="upcoming-sched__create-btn" data-bs-target="#deadlineModal"
                                    data-bs-toggle="modal"><i class="fa-solid fa-plus me-1"></i>Create</button>
                            </div>

                            <div class="mt-4" id="deadline_filling">
                                <!-- AJAX Request -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col">
                        <div class="overview-card">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <img class="overview-card__icon"
                                        src="<?php echo base_url('assets/images/dashboard/event.png'); ?>" alt="
										Registration">
                                    <h1 class="overview-card__title mb-0">Events</h1>
                                </div>

                                <button class="events__create-btn" data-bs-target="#eventModal"
                                    data-bs-toggle="modal"><i class="fa-solid fa-plus me-1"></i>Create</button>
                            </div>

                            <div class="mt-4" id="deadline_filling">
                                <div class="upcoming-sched__date-container-4">
                                    <h1 class="upcoming-sched__weekday">Wednesday</h1>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="upcoming-sched__date"><i
                                                class="fa-solid fa-calendar custom-text-primary me-2"></i>July 31, 2024
                                        </div>
                                        <div class="upcoming-sched__time"><i
                                                class="fa-solid fa-clock custom-text-danger me-2"></i>12:00 PM - 05:00
                                            PM</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col">
                        <div class="overview-card">
                            <div class="d-flex align-items-center gap-2 py-2">
                                <img class="overview-card__icon"
                                    src="<?php echo base_url('assets/images/dashboard/recent.png'); ?>" alt="Recent">
                                <h1 class="overview-card__title mb-0">Recent Activities</h1>
                            </div>
                            <div class="mt-3">
                                <ul class="p-0" id="recent_activities">
                                    <!-- AJAX Request -->
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

<?php $this->load->view('admin_portal/modal/deadline_modal');?>
<?php $this->load->view('admin_portal/modal/event_modal');?>


<script>
var applicationChartInstance;

function getCount() {
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

function getScholarshipRequest() {
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

function getAvailableSched() {
    $.ajax({
        url: "<?= base_url('portal/admin_portal/main/getAvailableSched')?>",
        method: "GET",
        dataType: "json",
        success: function(data) {
            $('#available_sched').html(data.available_sched);
        }
    });
}

function getApplicationChart() {
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
            var labels = Object.keys(data[0]).filter(key => key !== 'application_status' && key !==
                'total_count');

            var formattedLabels = labels.map(date => {
                var options = {
                    month: 'short',
                    day: '2-digit',
                    year: 'numeric'
                };
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
                    borderColor: userType === 'Total Application' ? '#32C7ED' : userType ===
                        'Approved' ? '#7BDF4A' :
                        '#ff3838', // Assign different colors based on user_type
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

function getRecentActivities() {
    $.ajax({
        url: "<?= base_url('main/getRecentActivities')?>",
        method: "GET",
        dataType: "json",
        success: function(data) {
            $('#recent_activities').html(data.recent_activities);
        }
    });
}

function getDeadlineFilling() {
    $.ajax({
        url: "<?= base_url('main/getDeadlineFilling')?>",
        method: "GET",
        dataType: "json",
        success: function(data) {
            $('#deadline_filling').html(data.deadline_filling);
        }
    });
}
$(document).ready(function() {
    getCount();
    getScholarshipRequest();
    getAvailableSched();
    getApplicationChart();
    getRecentActivities();
    getDeadlineFilling();

    setInterval(() => {
        getScholarshipRequest();
        getRecentActivities();
    }, 5000);

    $(document).on('change', '#filter_options', function() {
        getApplicationChart();
    });

    $(document).on('click', '#save_deadline', function() {
        var deadline = $('#deadline').val();

        if (deadline != '') {
            Swal.fire({
                title: 'Are you sure..',
                text: "You want to continue this transaction?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, continue',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('main/save_deadline')?>",
                        method: "POST",
                        data: {
                            deadline: deadline,
                            '_token': csrf_token_value,
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.error != '') {
                                $('.error-message').html(data.error);
                                setTimeout(() => {
                                    $('.error-message').html('');
                                }, 2000);
                            } else {
                                $('.error-message').html(data.success);
                                setTimeout(() => {
                                    $('.error-message').html('');
                                }, 2000);
                                getDeadlineFilling();
                                $('#deadlineModal').modal('hide');
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'An error occurred while processing the request.',
                            });
                        }
                    });
                }
            });
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Please provide a valid deadline schedule.',
            });
        }
    });
});
</script>
