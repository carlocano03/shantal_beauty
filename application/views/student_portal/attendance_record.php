<style>
    .tbl_schedule {
        width: 100%;
        border-collapse: collapse;
    }

    .bg-style {
        font-weight: bold;
        background: #222f3e;
        color: #fff;
    }
    .fw-bold {
        font-weight: bold;
    }

    .tbl_schedule th {
        font-size: 10px;
        border: 1px solid #c8d6e5;
        padding: 3px !important;
        text-align: center;
        border-radius: 0px !important;
        line-height: 10px;
    }

    .tbl_schedule td {
        font-size: 10px;
        border: 1px solid #c8d6e5;
        padding: 4px !important;
        text-align: center;
        border-radius: 0px !important;
    }

    .time_attendance {
        background: #27ae60;
        color: #fff;
        padding: 2px 15px 2px 15px;
        border-radius: 3px;
        font-weight: bold;
    }
</style>
<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h5><i class="<?= $icon?> me-2"></i><?= $card_title?></h5>
                    <h5 class="me-3" id="date_sched"></h5>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="col-3">
                        <input type="month" class="form-control" id="month" value="<?= date('Y-m');?>">
                    </div>
                    <div class="text-end">
                        <button class="btn btn-danger"><i class="bi bi-printer me-2"></i>Print Record</button>
                        <button class="btn btn-success"><i class="bi bi-file-earmark-excel me-2"></i>Excel</button>
                    </div>
                </div>
                <hr>
                <div class="attendance-info">
                    <!-- AJAX REQUEST -->
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    <?php $this->load->view('student_portal/modal/attendance_modal');?>


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

    // function getAttendanceRecord()
    // {
    //     $.ajax({
    //         url: "<?= base_url('portal/student_portal/student_attendance/getAttendanceRecord')?>",
    //         method: "GET",
    //         dataType: "json",
    //         success: function(data) {
    //             $('.attendance-info').html(data.attendance);
    //             $('#date_sched').text(data.date_sched);
    //         }
    //     })
    // }
    function getAttendanceRecord(month)
    {
        $.ajax({
            url: "<?= base_url('portal/student_portal/student_attendance/getAttendanceRecord')?>",
            method: "POST",
            data: {
                month: month,
                '_token': csrf_token_value,
            },
            dataType: "json",
            success: function(data) {
                $('.attendance-info').html(data.attendance);
                $('#date_sched').text(data.date_sched);
            }
        })
    }

    $(document).ready(function() {
        
        var selected_sched_id = 0;
        var schedule_id = 0;
        var action = '';
        var date = '';
        var member_id = 0;

        // getAttendanceRecord();
        getAvailableSched();

        $(document).on('change', '#month', function() {
            var month = $(this).val();
            getAttendanceRecord(month);
        });

        $('#month').trigger('change');

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
                                $('#scheduleModal').modal('hide');
                                $('#month').trigger('change');
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

        $(document).on('click', '.change_schedule', function() {
            selected_sched_id = $(this).data('id');
            schedule_id = $(this).data('sched_id');
            var sched_date = $(this).data('sched_date');

            $('.message').html('<div class="alert alert-danger"><i class="bi bi-info-circle-fill me-2"></i>Change the schedule date for ' + sched_date + '.</div>');

            $.ajax({
                url: "<?= base_url('portal/student_portal/student_attendance/get_schedule_list')?>",
                method: "POST",
                data: {
                    schedule_id: schedule_id,
                    '_token': csrf_token_value,
                },
                dataType: "json",
                success: function(data) {
                    $('#schedule_list').html(data.schedule_list);
                    $('#changeModal').modal('show');
                }
            });
        });

        $(document).on('click', '#update_schedule', function() {
            var available_sched_id = $(this).data('id');

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
                        url: "<?= base_url('portal/student_portal/student_attendance/update_schedule')?>",
                        method: "POST",
                        data: {
                            available_sched_id: available_sched_id,
                            selected_sched_id: selected_sched_id,
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
                                $('#changeModal').modal('hide');
                                $('#month').trigger('change');
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
        
        $(document).on('click', '.upload_excuse', function() {
            action = $(this).data('action');
            date = $(this).data('date');
            member_id = $(this).data('id');

            $('#attachmentModal').modal('show');
        });

        $(document).on('click', '#save_excuse_letter', function(event) {
            event.preventDefault();
            event.stopPropagation();

            var form = $('#attachmentForm')[0];
            var formData = new FormData(form);

            formData.append('action', action);
            formData.append('attendance_date', date);
            formData.append('member_id', member_id);
            formData.append('attachment', $('#attachment')[0].files[0]);
		    formData.append('_token', csrf_token_value);

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
                            url: "<?= base_url('portal/student_portal/student_attendance/save_excuse_letter')?>",
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
                                    $('#attachmentModal').modal('hide');
                                    form.reset();
                                    form.classList.remove('was-validated');
                                    $('#month').trigger('change');
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
            }
        });
    });
</script>