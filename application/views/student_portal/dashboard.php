<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y" style="max-width:100%">
        <div class="alert alert-danger" role="alert">
            <strong>Attention:</strong> Please submit an excuse letter for your absence on July 12, 2024.
        </div>

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
                                        <div class="student__info--card--no">24</div>
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
                                        <div class="student__info--card--no">2</div>
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
                                        <div class="student__info--card--no">2</div>
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
                            <select class="form-select w-25" aria-label="sort-and-filter">
                                <option selected disabled>Sort by</option>
                                <option value="date-asc">Oldest to Newest</option>
                                <option value="date-desc">Newest to Oldest</option>
                                <option value="status-late">Late</option>
                                <option value="status-on-time">On Time</option>
                                <option value="status-absent">Absent</option>
                            </select>

                        </div>

                    </div>
                    <div class="mt-4">
                        <div class="row row-cols-lg-3 row-cols-1 gx-lg-2 gy-lg-2 gy-3">
                            <div class="col">
                                <div class="overview-card recent-attendance__card-container">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="recent-attendance__date">July 11, 2024</div>
                                        <div class="recent-attendance__badge--success">On Time</div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 ">
                                        <div class="d-flex flex-column gap-1">
                                            <div class="recent-attendance__time-title">Check In Time</div>
                                            <div class="recent-attendance__time">2:00 PM</div>
                                        </div>
                                        <div class="d-flex flex-column gap-1">
                                            <div class="recent-attendance__time-title">Check Out Time</div>
                                            <div class="recent-attendance__time">6:00 PM</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="overview-card recent-attendance__card-container">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="recent-attendance__date">July 12, 2024</div>
                                        <div class="recent-attendance__badge--danger">Absent</div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between mt-4 ">
                                        <div class="d-flex flex-column gap-1">
                                            <div class="recent-attendance__time-title">Check In Time</div>
                                            <div class="recent-attendance__time">---------------</div>
                                        </div>
                                        <div class="d-flex flex-column gap-1">
                                            <div class="recent-attendance__time-title">Check Out Time</div>
                                            <div class="recent-attendance__time">---------------</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">

                                <div class="overview-card recent-attendance__card-container">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="recent-attendance__date">July 13, 2024</div>
                                        <div class="recent-attendance__badge--warning">Late</div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between mt-4 ">
                                        <div class="d-flex flex-column gap-1">
                                            <div class="recent-attendance__time-title">Check In Time</div>
                                            <div class="recent-attendance__time">2:01 PM</div>
                                        </div>
                                        <div class="d-flex flex-column gap-1">
                                            <div class="recent-attendance__time-title">Check Out Time</div>
                                            <div class="recent-attendance__time">6:00 PM</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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

    $(document).ready(function() {
        getAvailableSched();

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