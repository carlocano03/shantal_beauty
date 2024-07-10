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
            <div class="card-header mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h5><i class="<?= $icon?> me-2"></i><?= $card_title?></h5>
                    <h5 class="me-3" id="date_sched"></h5>
                </div>
            </div>
            <div class="card-body">
                <?php
                    $lastname = isset($record['student_last_name']) ? $record['student_last_name'] : '';
                    $firstname = isset($record['student_first_name']) ? $record['student_first_name'] : '';
                    $middlename = isset($record['student_middle_name']) ? $record['student_middle_name'] : '';

                    $full_name = $lastname.', '.$firstname.' '.$middlename;
                ?>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <?php if (isset($record_prev)) : ?>
                                <?php
                                    $member_prev = $this->cipher->encrypt($record_prev['member_id']);
                                    $url = $url_action . $member_prev . '&month=' . $month;
                                ?>
                                <a href="<?= $url;?>" class="btn btn-primary me-1"><b class="text-lg"><i class="bi bi-caret-left-fill"></i></b></a>
                            <?php else : ?>
                                <button class="btn btn-primary me-1" disabled="disabled"><b class="text-lg"><i class="bi bi-caret-left-fill"></i></b></button>
                            <?php endif;?>

                            <span class="bg-dark rounded text-sm py-2 px-3 mx-0" style="height: 37px; width:100%;"><span class="text-success">Name :</span> 
                                <b class="text-light px-1"><?= ucwords($full_name);?></b>
                            </span>

                            <?php if (isset($record_next)) : ?>
                                <?php
                                    $member_next = $this->cipher->encrypt($record_next['member_id']);
                                    $url = $url_action . $member_next . '&month=' . $month;
                                ?>
                                <a href="<?= $url;?>" class="btn btn-primary ms-1"><b class="text-lg"><i class="bi bi-caret-right-fill"></i></b></a>
                            <?php else : ?>
                                <button class="btn btn-primary ms-1" disabled="disabled"><b class="text-lg"><i class="bi bi-caret-right-fill"></i></b></button>
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <input type="month" class="form-control" id="month_selected" value="<?= $month;?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="<?= base_url('admin/attendance-record');?>" class="btn btn-outline-dark"><i class="bi bi-backspace-fill me-2"></i>Back</a>
                        <button class="btn btn-danger"><i class="bi bi-printer me-2"></i>Print Record</button>
                        <button class="btn btn-success"><i class="bi bi-file-earmark-excel me-2"></i>Excel</button>
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

<script>
    var member_id = '<?= $member_id;?>';
    var month = '<?= $month;?>';
    var member_id_encrypted = '<?= $member_id_encrypted;?>';
    function getAttendanceRecord()
    {
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

        $(document).on('change', '#month_selected', function() {
            var month_selected = $(this).val();
            var url = "<?= base_url('admin/attendance-record/manage-record?scholar=')?>" + member_id_encrypted + '&month=' + month_selected;

            window.location.href = url;
        });
    });
</script>