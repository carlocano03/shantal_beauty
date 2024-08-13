<style>
.table thead {
    background: #E2E8F0 !important;
    color: red !important;
}

#church_schedule_chart {
    width: 450px !important;
    height: 450px !important;

}

@media (max-width: 768px) {
    #church_schedule_chart {
        width: 350px !important;
        height: 350px !important;

    }
}

@media (max-width: 420px) {
    #church_schedule_chart {
        width: 250px !important;
        height: 250px !important;

    }
}
</style>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y" style="max-width:100%; ">

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
                                        src="<?php echo base_url('assets/images/dashboard/schedule.png'); ?>" alt="
										Registration">
                                    <h1 class="overview-card__title mb-0">Scholars Schedule - For the Month of
                                        <?= date('F Y');?></h1>
                                </div>
                            </div>
                            <div class="mt-3">
                                <ul class="nav nav-pills mb-3 d-flex flex-column flex-lg-row" id="pills-tab"
                                    role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-overview-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-overview" type="button" role="tab"
                                            aria-controls="pills-overview" aria-selected="false">
                                            Schedule Overview
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-home" type="button" role="tab"
                                            aria-controls="pills-home" aria-selected="true">
                                            Scholars With Schedule <span class="badge bg-warning with_schedule"></span>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-profile" type="button" role="tab"
                                            aria-controls="pills-profile" aria-selected="false">
                                            Scholars Without Schedule <span
                                                class="badge bg-warning without_schedule"></span>
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content p-0" id="pills-tabContent">
                                    <div class=" tab-pane fade fade show active" id="pills-overview" role="tabpanel"
                                        aria-labelledby="pills-overview-tab">
                                        <div class="mt-3 d-flex align-items-center justify-content-center">
                                            <canvas id="church_schedule_chart"></canvas>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab">
                                        <?php $this->load->view('admin_portal/scholar_tab/with_schedule')?>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                        aria-labelledby="pills-profile-tab">
                                        <?php $this->load->view('admin_portal/scholar_tab/without_schedule')?>
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
                <?php if ($this->session->userdata('adminIn')['user_type_id'] == ADMINISTRATOR) : ?>
                <div class="row mb-4">
                    <div class="col">
                        <div class="overview-card">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <img class="overview-card__icon"
                                        src="<?php echo base_url('assets/images/dashboard/biometric.png'); ?>" alt="
                                            Registration">
                                    <h1 class="overview-card__title mb-0">Biometric Logs</h1>
                                </div>
                                <a href="<?= base_url('admin/biometric-logs')?>"><button
                                        class="upcoming-sched__create-btn"><i class="bi bi-folder2-open me-2"></i>View
                                        All</button></a>
                            </div>

                            <div class="mt-4" id="biometric_logs">
                                <!-- AJAX Request -->
                            </div>
                            <div id="error"></div>
                            <div id="pagination_links" style="overflow-x:auto;">
                                <!-- Pagination links will be loaded here via AJAX -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php else : ?>
                <?php if (in_array(BIOMETRIC_LOGS, $role_permissions)): ?>
                <div class="row mb-4">
                    <div class="col">
                        <div class="overview-card">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <img class="overview-card__icon"
                                        src="<?php echo base_url('assets/images/dashboard/biometric.png'); ?>" alt="
                                                Registration">
                                    <h1 class="overview-card__title mb-0">Biometric Logs</h1>
                                </div>
                                <a href="<?= base_url('admin/biometric-logs')?>"><button
                                        class="upcoming-sched__create-btn"><i class="bi bi-folder2-open me-2"></i>View
                                        All</button></a>
                            </div>

                            <div class="mt-4" id="biometric_logs">
                                <!-- AJAX Request -->
                            </div>
                            <div id="error"></div>
                            <div id="pagination_links">
                                <!-- Pagination links will be loaded here via AJAX -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif;?>
                <?php endif;?>


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

const scheduleChart = new Chart(document.getElementById('church_schedule_chart'), {
    type: 'pie',
    data: {}, // Initialize with empty data
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Scholar Schedules'
            }
        }
    }
});

function loadSchedule() {
    $.ajax({
        url: "<?= base_url('portal/admin_portal/main/get_church_schedule');?>",
        method: "GET",
        dataType: "json",
        success: function(data) {
            if (data.count > 0) {
                scheduleChart.data = data.chart;
                scheduleChart.update();
            } else {
                scheduleChart.data = {
                    datasets: [{
                        data: [1], // Dummy data
                        backgroundColor: ['rgba(0, 0, 0, 0)'], // Transparent color
                        borderColor: ['rgba(0, 0, 0, 0)'] // Transparent color
                    }],
                    labels: ['No data found']
                };
                scheduleChart.update();
            }
        }
    });
}

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

function getCountSchedule() {
    $.ajax({
        url: "<?= base_url('portal/admin_portal/scholar_schedule/getCountSchedule')?>",
        method: "GET",
        dataType: "json",
        success: function(data) {
            if (data.with_schedule > 0) {
                $('.with_schedule').text(data.with_schedule);
            } else {
                $('.with_schedule').text('');
            }

            if (data.without_schedule > 0) {
                $('.without_schedule').text(data.without_schedule);
            } else {
                $('.without_schedule').text('');
            }
        }
    });
}

function getBiometricLogs(page) {
    $.ajax({
        url: "<?= base_url('portal/admin_portal/scholar_schedule/getBiometricLogs/'); ?>" + page,
        type: "GET",
        dataType: "json",
        success: function(data) {
            $('#biometric_logs').html(data.biometric_logs);
            $('#pagination_links').html(data.links);
            if (data.error != '') {
                $('#error').html(data.error);
                $('#error').fadeIn(200);
                $('#pagination_links').hide();
            } else {
                $('#error').hide();
                $('#pagination_links').fadeIn(200);
            }
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
    getCountSchedule();
    getBiometricLogs(0);
    loadSchedule();

    setInterval(() => {
        getScholarshipRequest();
        getRecentActivities();
        getCountSchedule();
    }, 5000);

    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('/').pop();
        getBiometricLogs(page);
    });

    $(document).on('click', '#pills-overview-tab', function() {
        loadSchedule();
    });

    var tbl_with_schedule = $('#tbl_with_schedule').DataTable({
        language: {
            search: '',
            searchPlaceholder: "Search Here...",
            paginate: {
                next: '<i class="bi bi-chevron-double-right"></i>',
                previous: '<i class="bi bi-chevron-double-left"></i>'
            }
        },
        "ordering": false,
        "serverSide": true,
        "processing": true,
        "deferRender": true,
        "ajax": {
            "url": "<?= base_url('portal/admin_portal/scholar_schedule/get_student_with_schedule')?>",
            "type": "POST",
            "data": function(d) {
                d[csrf_token_name] = csrf_token_value;
            },
            "complete": function(res) {
                csrf_token_name = res.responseJSON.csrf_token_name;
                csrf_token_value = res.responseJSON.csrf_token_value;
            }
        },
    });

    var tbl_without_schedule = $('#tbl_without_schedule').DataTable({
        language: {
            search: '',
            searchPlaceholder: "Search Here...",
            paginate: {
                next: '<i class="bi bi-chevron-double-right"></i>',
                previous: '<i class="bi bi-chevron-double-left"></i>'
            }
        },
        "ordering": false,
        "serverSide": true,
        "processing": true,
        "deferRender": true,
        "ajax": {
            "url": "<?= base_url('portal/admin_portal/scholar_schedule/get_student_without_schedule')?>",
            "type": "POST",
            "data": function(d) {
                d[csrf_token_name] = csrf_token_value;
            },
            "complete": function(res) {
                csrf_token_name = res.responseJSON.csrf_token_name;
                csrf_token_value = res.responseJSON.csrf_token_value;
            }
        },
    });

    // Adjust column sizing when a tab is shown
    $('button[data-bs-toggle="pill"]').on('shown.bs.tab', function(e) {
        $.fn.dataTable.tables({
            visible: true,
            api: true
        }).columns.adjust();
    });

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

    $(document).on('click', '.manage_attendance', function() {
        var member_id = $(this).data('id');

        $('#attendance_member_id').val(member_id);
        $('#cutOffModal').modal('show');
    });

    $(document).on('click', '.proceed_attendance', function() {
        var member_id = $('#attendance_member_id').val();
        var month = $('#month').val();
        var url = "<?= base_url('admin/attendance-record/manage-record?scholar=')?>" + member_id +
            '&month=' + month;

        if (month != '') {
            $.ajax({
                url: "<?= base_url('portal/admin_portal/attendance_record/check_month_attendance')?>",
                method: "POST",
                data: {
                    member_id: member_id,
                    month: month,
                    '_token': csrf_token_value,
                },
                dataType: "json",
                success: function(data) {
                    if (data.error != '') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Ooops.',
                            text: data.error,
                        });
                    } else {
                        window.location.href = url;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX request failed:", textStatus, errorThrown);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred while processing the request.',
                    });
                }
            });
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Ooops.',
                text: 'Please provide a valid month.',
            });
        }
    });
});
</script>