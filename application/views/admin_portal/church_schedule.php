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
    width: 4.5rem;
}

.dashboard__img-container {
    padding: .4rem;
    border-radius: 100%;
    background-color: #ffffff;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
}

.custom-card__title {
    font-weight: 900;
    font-size: 1rem;
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
    font-size: 0.80rem;
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
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header mb-3 pb-3 d-flex align-items-center gap-2 ">
                <img src="<?php echo base_url('assets/images/church_schedule.png'); ?>" width="36px" alt="Calendar" />
                <h5 class="table__title"><?= $card_title?></h5>
            </div>
            <div class="card-body mt-4">
                <div class="row gy-4 gy-lg-0">
                    <div class="col-md-7">
                        <div class="row" id="sched_list">
                            <!-- <div class="col-md-6 mb-3">
                                <div class="overview-card">
                                    <div class="d-flex align-items-center gap-3 justify-content-between">
                                        <div class="dashboard__img-container">
                                            <img class="dashboard__img"
                                                src="<?php echo base_url('assets/images/dashboard/timetable.png'); ?>"
                                                alt="Scholars" />
                                        </div>
                                        <div class="flex flex-column text-end">
                                            <div style="margin-top:-20px;">
                                                <label class="switch">
                                                    <input type="checkbox" class="account_activation">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                            <div class="custom-card__title">Schedule Name</div>
                                            <div class="custom-card__sub-text">
                                                <i class="bi bi-calendar-week me-2"></i>Thursday
                                            </div>
                                            <div class="custom-card__sub-text">
                                                <i class="bi bi-clock me-2"></i>9:00 AM - 10:00 PM
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="overview-card">
                                    <div class="d-flex align-items-center gap-3 justify-content-between">
                                        <div class="dashboard__img-container">
                                            <img class="dashboard__img"
                                                src="<?php echo base_url('assets/images/dashboard/timetable.png'); ?>"
                                                alt="Scholars" />
                                        </div>
                                        <div class="flex flex-column text-end">
                                            <div style="margin-top:-20px;">
                                                <label class="switch">
                                                    <input type="checkbox" class="account_activation">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                            <div class="custom-card__title">Schedule Name</div>
                                            <div class="custom-card__sub-text">
                                                <i class="bi bi-calendar-week me-2"></i>Thursday
                                            </div>
                                            <div class="custom-card__sub-text">
                                                <i class="bi bi-clock me-2"></i>9:00 AM - 10:00 PM
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="overview-card__title">
                                            Church Schedule Overview
                                        </div>
                                        <div class="mt-3 d-flex align-items-center justify-content-center">
                                            <canvas id="church_schedule_chart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="table__title"><i class="bi bi-ui-radios me-2"></i>Church Schedule Form</h5>
                            </div>
                            <div class="card-body mt-4">
                                <div class="alert alert-danger mt-3"><i class="bi bi-info-circle-fill me-2"></i>Schedule
                                    Details</div>
                                <form id="addForm" class="needs-validation" novalidate>
                                    <input type="hidden" id="sched_id">
                                    <div class="form-group mb-3">
                                        <label for="sched_name" class="form-label">Schedule Name</label>
                                        <input type="text" class="form-control" id="sched_name" autocomplete="off"
                                            required>
                                        <div class="invalid-feedback">
                                            Please provide a valid schedule name.
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="day_week" class="form-label">Day of the week</label>
                                        <select name="day_week" id="day_week" class="form-select" required>
                                            <option value="">Please choose from the following options</option>
                                            <option value="Monday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thursday">Thursday</option>
                                            <option value="Friday">Friday</option>
                                            <option value="Saturday">Saturday</option>
                                            <option value="Sunday">Sunday</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please provide a valid day of the week.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="sched_time" class="form-label">Schedule Time</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="time_in" class="form-label">Time In</label>
                                                <input type="time" class="form-control" id="time_in" autocomplete="off"
                                                    required>
                                                <div class="invalid-feedback">
                                                    Please provide a valid time.
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="time_out" class="form-label">Time Out</label>
                                                <input type="time" class="form-control" id="time_out" autocomplete="off"
                                                    required>
                                                <div class="invalid-feedback">
                                                    Please provide a valid time.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-md-end d-flex d-md-block flex-column gap-2">
                                        <button type="button" class="btn btn-primary" id="save_schedule"><i
                                                class="bi bi-floppy-fill me-2"></i>Save changes</button>
                                        <a href="" type="button" class="btn btn-secondary"><i
                                                class="bi bi-x-square me-2"></i>Cancel</a>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

<script>
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
            url: "<?= base_url('portal/admin_portal/church_schedule/get_church_schedule');?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                if(data.count > 0) {
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
                $('#sched_list').html(data.sched_list);
            }
        });
    }

    $(document).ready(function() {
        loadSchedule();
    });

    $(document).on('click', '#save_schedule', function() {
        event.preventDefault();
        event.stopPropagation();

        var form = $('#addForm')[0];
        var formData = new FormData(form);

        var sched_id = $('#sched_id').val();
        if (sched_id != '') {
            //Update process
            formData.append('sched_id', $('#sched_id').val());
            formData.append('sched_name', $('#sched_name').val());
            formData.append('day_week', $('#day_week').val());
            formData.append('time_in', $('#time_in').val());
            formData.append('time_out', $('#time_out').val());
            formData.append('action', 'Update');
            formData.append('_token', csrf_token_value);
        } else {
            //Insert process
            formData.append('sched_name', $('#sched_name').val());
            formData.append('day_week', $('#day_week').val());
            formData.append('time_in', $('#time_in').val());
            formData.append('time_out', $('#time_out').val());
            formData.append('action', 'Insert');
            formData.append('_token', csrf_token_value);
        }


        form.classList.add('was-validated');
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        } else {
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
                        url: "<?= base_url('portal/admin_portal/church_schedule/add_new_schedule');?>",
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
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
                                form.reset();
                                form.classList.remove('was-validated');
                                loadSchedule();
                            }
                        },
                        error: function() {
                            console.error("AJAX request failed:", textStatus, errorThrown);
                            Swal.fire({
                                icon: 'error',
                                title: 'Ooops...',
                                text: 'An error occurred while processing the request.',
                            });
                        }
                    });
                }
            });
        }
    });

    $(document).on('click', '.schedule_activation', function(event) {
        event.stopPropagation();
        var sched_id = $(this).data('id');

        if ($(this).is(":checked")) {
            //Activate accouny
            Swal.fire({
                title: 'Are you sure..',
                text: "You want to activate this schedule?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, continue',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('portal/admin_portal/church_schedule/schedule_activation')?>",
                        method: "POST",
                        data: {
                            sched_id: sched_id,
                            action: 'Activate',
                            '_token': csrf_token_value,
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.message == 'Success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thank you!',
                                    text: 'Schedule successfully activated.',
                                });
                                loadSchedule();
                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Oops...',
                                    text: 'Failed to activate the schedule.',
                                });
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
            //Deactivating account
            Swal.fire({
                title: 'Are you sure..',
                text: "You want to deactivate this schedule?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, continue',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('portal/admin_portal/church_schedule/schedule_activation')?>",
                        method: "POST",
                        data: {
                            sched_id: sched_id,
                            action: 'Deactivate',
                            '_token': csrf_token_value,
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.message == 'Success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thank you!',
                                    text: 'Schedule successfully deactivated.',
                                });
                                loadSchedule();
                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Oops...',
                                    text: 'Failed to deactivated the schedule.',
                                });
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
        }
    });

    $(document).on('click', '#open_action', function() {
        var sched_id = $(this).data('id');
        var name = $(this).data('name');
        var day = $(this).data('day');
        var timeIn = $(this).data('in');
        var timeOut = $(this).data('out');
        
        Swal.fire({
            icon: "question",
            title: "Are you sure..",
            text: "Do you want to update this schedule?",
            showCancelButton: true,
            confirmButtonText: "Update",
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                //Update Record
                $('#sched_id').val(sched_id);
                $('#sched_name').val(name);
                $('#day_week').val(day).trigger('change');
                $('#time_in').val(timeIn);
                $('#time_out').val(timeOut);
            }
        });
    });
</script>
