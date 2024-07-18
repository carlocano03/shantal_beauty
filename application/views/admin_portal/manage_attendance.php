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
    color: #fff !important;
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

.download_letter {
    font-size: 9px;
    font-weight: 600;
    color: #0984e3;
    cursor: pointer;
    text-decoration: underline;
}

.download_letter:hover {
    text-decoration: underline;
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


#date_sched {
    background-color: #434875;
    padding: 10px 16px;
    color: #ffffff;
    border-radius: 8px;
}



.scrollable-table::-webkit-scrollbar {
    height: 6px;
}

.scrollable-table::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.scrollable-table::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

.scrollable-table::-webkit-scrollbar-thumb:hover {
    background: #555;
}

.scrollable-table {
    scrollbar-width: thin;
    scrollbar-color: #888 #f1f1f1;
}
</style>
<?php
    $member_id = $this->cipher->decrypt($_GET['scholar']);
    $month = $_GET['month'];
    $member_id_encrypted = $_GET['scholar'];
?>
<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div
                class="card-header mb-3 pb-3 d-flex align-items-center flex-column justify-content-between gap-3 gap-md-0 flex-md-row ">
                <div class="d-flex  gap-2 align-items-center">
                    <img src="<?php echo base_url('assets/images/student_dashboard/attendance-record.png'); ?>"
                        width="36px" alt="Calendar" />
                    <h5 class="table__title"><?= $card_title?></h5>
                </div>
                <h6 class="me-3 mb-0" id="date_sched"></h6>
            </div>


            <div class="card-body mt-2">
                <a href="<?= base_url('admin/attendance-record');?>" class="btn btn-outline-dark"><i
                        class="bi bi-backspace-fill me-2 "></i>Back</a>
                <?php
                    $lastname = isset($record['student_last_name']) ? $record['student_last_name'] : '';
                    $firstname = isset($record['student_first_name']) ? $record['student_first_name'] : '';
                    $middlename = isset($record['student_middle_name']) ? $record['student_middle_name'] : '';

                    $full_name = $lastname.', '.$firstname.' '.$middlename;
                ?>

                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center mt-4 mb-3 ">
                    <div>
                        <div class="d-flex justify-content-between align-items-center">
                            <?php if (isset($record_prev)) : ?>
                            <?php
                                    $member_prev = $this->cipher->encrypt($record_prev['member_id']);
                                    $url = $url_action . $member_prev . '&month=' . $month;
                                ?>
                            <a href="<?= $url;?>" class="btn btn-primary me-1"><b class="text-lg"><i
                                        class="bi bi-caret-left-fill"></i></b></a>
                            <?php else : ?>
                            <button class="btn btn-primary me-1" disabled="disabled"><b class="text-lg"><i
                                        class="bi bi-caret-left-fill"></i></b></button>
                            <?php endif;?>

                            <span class="bg-dark rounded text-sm py-2 px-3 mx-0" style="height: 37px; width:100%;"><span
                                    class="text-success">Name :</span>
                                <b class="text-light px-1"><?= ucwords($full_name);?></b>
                            </span>

                            <?php if (isset($record_next)) : ?>
                            <?php
                                    $member_next = $this->cipher->encrypt($record_next['member_id']);
                                    $url = $url_action . $member_next . '&month=' . $month;
                                ?>
                            <a href="<?= $url;?>" class="btn btn-primary ms-1"><b class="text-lg"><i
                                        class="bi bi-caret-right-fill"></i></b></a>
                            <?php else : ?>
                            <button class="btn btn-primary ms-1" disabled="disabled"><b class="text-lg"><i
                                        class="bi bi-caret-right-fill"></i></b></button>
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-lg-row align-item-center gap-0 gap-lg-3 mt-3 mt-lg-0">
                        <div>
                            <input type="month" class="form-control" id="month_selected" value="<?= $month;?>">
                        </div>
                        <div>
                            <button class="btn btn-outline-info print_attendance"><i
                                    class="bi bi-printer me-2"></i>Print
                                Record</button>
                            <a href="<?= base_url('admin/attendance-record/excel?scholar='.$member_id_encrypted.'&month='.$month)?>"
                                class="btn btn-outline-success"><i class="bi bi-file-earmark-excel me-2"></i>Excel</a>
                        </div>
                    </div>
                </div>
                <hr class="mt-0 mb-2">
                <div class="attendance-info">
                    <!-- AJAX REQUEST -->
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    <?php $this->load->view('admin_portal/modal/letter_approval_modal');?>
    <script>
    var member_id = '<?= $member_id;?>';
    var month = '<?= $month;?>';
    var member_id_encrypted = '<?= $member_id_encrypted;?>';

    function getAttendanceRecord() {
        $.ajax({
            url: "<?= base_url('portal/admin_portal/attendance_record/getAttendanceRecord')?>",
            method: "POST",
            data: {
                member_id: member_id,
                month: month,
                '_token': csrf_token_value,
            },
            dataType: "json",
            success: function(data) {
                $('.attendance-info').html(data.attendance);
                $('#date_sched').text(data.date_sched);
            }
        });
    }

    $(document).ready(function() {
        getAttendanceRecord();

        var remarks = '';
        var memberId = 0;
        var scheduleDate = '';

        $(document).on('change', '#month_selected', function() {
            var month_selected = $(this).val();
            var url = "<?= base_url('admin/attendance-record/manage-record?scholar=')?>" +
                member_id_encrypted + '&month=' + month_selected;

            window.location.href = url;
        });

        $(document).on('click', '.validate_letter', function() {
            remarks = $(this).data('action');
            memberId = $(this).data('id');
            scheduleDate = $(this).data('date');

            $('#updateModal').modal('show');
        });

        $(document).on('click', '.download_letter', function() {
            var action = $(this).data('action');
            var member_id = $(this).data('id');
            var attendance_date = $(this).data('date');

            $.ajax({
                url: "<?= base_url('portal/admin_portal/attendance_record/download_excuse_letter')?>",
                method: "POST",
                data: {
                    action: action,
                    member_id: member_id,
                    attendance_date: attendance_date,
                    '_token': csrf_token_value,
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(data, status, xhr) {
                    if (xhr.status === 200) {
                        var filename = xhr.getResponseHeader('Content-Disposition').split(
                            'filename=')[1].replace(/"/g, '');
                        var blob = new Blob([data], {
                            type: 'application/pdf'
                        });
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = filename;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No file found.'
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No file found.'
                    });
                }
            });
        });

        $(document).on('click', '#save_validation', function(event) {
            event.preventDefault();
            event.stopPropagation();

            var form = $('#updateForm')[0];
            var formData = new FormData(form);
            formData.append('remarks', remarks);
            formData.append('member_id', memberId);
            formData.append('schedule_date', scheduleDate);
            formData.append('validation', $('#validation').val());
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
                            url: "<?= base_url('portal/admin_portal/attendance_record/save_validation');?>",
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
                                    $('#updateModal').modal('hide');
                                    form.reset();
                                    form.classList.remove('was-validated');
                                    getAttendanceRecord();
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

        $(document).on('click', '.print_attendance', function() {
            var url = "<?= base_url('admin/attendance-record/print?scholar=')?>" + member_id_encrypted +
                '&month=' + month;
            window.open(url, 'targetWindow', 'resizable=yes,width=1000,height=1000');
        });
    });
    </script>