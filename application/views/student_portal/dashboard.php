<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y" style="max-width:100%">
        <div class="row gy-3 ">
            <div class="col-lg-8 col-12 ">
                <div class="overview-card">
                    <div class="d-flex flex-column flex-lg-row align-items-center gap-4">
                        <?php
                            $img = base_url()."assets/images/student_dashboard/student-profile.png";
                            if(!empty($student_info['personal_photo'])){
                                if(file_exists('./assets/uploaded_attachment/personal_photo/'.$student_info['personal_photo'])){
                                    $img = base_url()."assets/uploaded_attachment/personal_photo/".$student_info['personal_photo'];
                                }
                            }
                        ?>
                        <img class="student__avatar" src="<?= $img;?>"
                            alt="applicant">
                        <div class="w-100 d-flex flex-column  pt-2 ">
                            <div class="student__name text-lg-start text-center"><?= $this->session->userdata('scholarIn')['fullname']?><?= isset($student_info['scholarship_no']) ? ' - '.$student_info['scholarship_no'] : '';?></div>
                            <div
                                class="d-flex gap-lg-5 gap-4 align-items-center justify-content-lg-start justify-content-center mt-3 py-3 py-lg-0">
                                <div>
                                    <div class="student__info--title">Year Level</div>
                                    <div class="student__info"><?= isset($student_info['year_level']) ? $student_info['year_level'] : '';?></div>
                                </div>
                                <div>
                                    <div class="student__info--title">Email Address</div>
                                    <div class="student__info"><?= isset($student_info['email_address']) ? $student_info['email_address'] : '';?></div>
                                </div>
                                <div>
                                    <div class="student__info--title">Phone Number</div>
                                    <div class="student__info"><?= isset($student_info['mobile_no']) ? $student_info['mobile_no'] : '';?></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row row-cols-lg-3 row-cols-1 gy-3 gx-3 mt-lg-3 mt-2">
                        <div class="col">
                            <div class="overview-card student__info--card-1">
                                <div class="d-flex align-items-center gap-4">
                                    <div class="student__info--card-img__container-1">
                                        <img class="student__info--card-img"
                                            src="<?php echo base_url('assets/images/student_dashboard/attendance.png'); ?>"
                                            alt="applicant">
                                    </div>
                                    <div>
                                        <div class="student__info--card--no" id="total_attendance"></div>
                                        <div class="student__info--card--text">Total Attendance</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="overview-card student__info--card-3">
                                <div class="d-flex align-items-center gap-4">
                                    <div class="student__info--card-img__container-3">
                                        <img class="student__info--card-img"
                                            src="<?php echo base_url('assets/images/student_dashboard/late.png'); ?>"
                                            alt="applicant">
                                    </div>

                                    <div>
                                        <div class="student__info--card--no" id="total_late"></div>
                                        <div class="student__info--card--text">Total Late</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="overview-card student__info--card-2">
                                <div class="d-flex align-items-center gap-4">
                                    <div class="student__info--card-img__container-2">
                                        <img class="student__info--card-img"
                                            src="<?php echo base_url('assets/images/student_dashboard/absent.png'); ?>"
                                            alt="applicant">
                                    </div>
                                    <div>
                                        <div class="student__info--card--no" id="total_absent"></div>
                                        <div class="student__info--card--text">Total Absent</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="overview-card mt-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <img class="overview-card__icon"
                                src="<?php echo base_url('assets/images/student_dashboard/attendance-logs.png'); ?>"
                                alt="
										Registration">
                        </div>
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <h1 class="overview-card__title mb-0">Recent Attendance Logs</h1>
                        </div>

                    </div>
                    <div class="mt-4">
                        <div class="row row-cols-lg-3 row-cols-1 gx-lg-2 gy-lg-2 gy-3 mb-3" id="attendance_logs">
                            <!-- AJAX REQUEST -->
                        </div>
                        <div id="error"></div>
                        <div id="pagination_links">
                            <!-- Pagination links will be loaded here via AJAX -->
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="overview-card">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <img class="overview-card__icon"
                                src="<?php echo base_url('assets/images/dashboard/upcoming.png'); ?>" alt="
										Registration">
                        </div>
                        <h1 class="overview-card__title mb-0">Select Church Schedules</h1>
                    </div>
                    
                    <div class="error-message"></div>
                    <div id="available_sched">
                        <!-- AJAX REQUEST -->
                    </div>
                </div>

                <div class="overview-card mt-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <img class="overview-card__icon"
                                src="<?php echo base_url('assets/images/dashboard/late_rules.png'); ?>" alt="
										Registration">
                        </div>
                        <h1 class="overview-card__title mb-0">Active Late Rules</h1>
                    </div>
            
                    <div id="active_rules">
                        <?php if($late_rules->num_rows() > 0) : ?>
                            <?php foreach($late_rules->result_array() as $list) : ?>
                                <?php
                                    if ($list['no_late'] > 1) {
                                        $consecutive_late = $list['no_late'].' Consecutive Lates';
                                    } else {
                                        $consecutive_late = $list['no_late'].' Consecutive Late';
                                    }
                    
                                    if ($list['no_days'] > 1) {
                                        $day_range = $list['no_days'].' Days Range';
                                    } else {
                                        $day_range = $list['no_days'].' Day Range';
                                    }
                                ?>
                                <input type="hidden" id="no_late" value="<?= $list['no_late'];?>">
                                <input type="hidden" id="days_range" value="<?= $list['no_days'];?>">
                                <div class="upcoming-sched__date-container-1 mb-3" style="cursor:pointer;">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h1 class="upcoming-sched__weekday mb-0"><?= ucwords($list['rule_name'])?></h1>
                                        <div style="font-size:10px; color:red; font-weight:700;">Total Late: <span class="remaining_late"></span></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="upcoming-sched__date"><i
                                                class="fa-solid fa-calendar custom-text-primary me-2"></i><?= $consecutive_late;?></div>
                                        <div class="upcoming-sched__time"><i
                                                class="fa-solid fa-clock custom-text-danger me-2"></i><?= $day_range;?></div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        <?php else: ?>
                            <div class="alert alert-danger"><i class="bi bi-info-circle-fill me-2"></i>No late rules found.</div>
                        <?php endif; ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    function getAvailableSched()
    {
        $.ajax({
            url: "<?= base_url('portal/student_portal/main/getAvailableSched')?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                $('#available_sched').html(data.available_sched);
                if (data.error != '') {
                    $('.error-message').html(data.error);
                } else {
                    $('.error-message').html('');
                }
            }
        });
    }

    function getTotalAttendance()
    {
        $.ajax({
            url: "<?= base_url('portal/student_portal/main/getTotalAttendance')?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                computeRemainingLate(data.total_late)
                const countUpConfigs = [{
                        elementId: 'total_attendance',
                        targetValue: data.total_attendance,

                    },
                    {
                        elementId: 'total_late',
                        targetValue: data.total_late,

                    },
                    {
                        elementId: 'total_absent',
                        targetValue: data.total_absent,

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

    function getAttendanceLogs(page)
    {
        $.ajax({
            url: "<?= base_url('portal/student_portal/main/getAttendanceLogs/'); ?>" + page,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#attendance_logs').html(data.attendance_logs);
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

    function computeRemainingLate(total_late)
    {
        var no_late = $('#no_late').val();
        var days_range = $('#days_range').val();


        var remaining = total_late +'/'+ no_late;
        $('.remaining_late').text(remaining);
    }

    $(document).ready(function() {
        getAvailableSched();
        getTotalAttendance();
        getAttendanceLogs(0);
        computeRemainingLate();

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('/').pop();
            getAttendanceLogs(page);
        });

        $(document).on('click', '#save_schedule', function() {
            var sched_id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure..',
                text: "You want to select this schedule for this month?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, continue',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('portal/student_portal/main/save_schedule')?>",
                        method: "POST",
                        data: {
                            sched_id: sched_id,
                            '_token': csrf_token_value,
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.error != '') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Ooops...',
                                    text: data.error,
                                });
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thank You!',
                                    text: data.success,
                                });
                                getAvailableSched();
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Ooops...',
                                text: 'An error occurred while processing the request.',
                            });
                        }
                    });
                }
            });
        });
    });
</script>