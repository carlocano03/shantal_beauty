<style>
#tbl_student th:nth-child(1),
#tbl_student td:nth-child(1),
#tbl_student th:nth-child(4),
#tbl_student td:nth-child(4),
#tbl_student th:nth-child(5),
#tbl_student td:nth-child(5),
#tbl_student th:nth-child(6),
#tbl_student td:nth-child(6),
#tbl_student th:nth-child(7),
#tbl_student td:nth-child(7) {
    text-align: center;
}

#tbl_student td:nth-child(1),
#tbl_student td:nth-child(4),
#tbl_student td:nth-child(5),
#tbl_student td:nth-child(6) {
    display: none;

}

@media (min-width: 992px) {

    #tbl_student td:nth-child(1),
    #tbl_student td:nth-child(4),
    #tbl_student td:nth-child(5),
    #tbl_student td:nth-child(6) {
        display: table-cell;
    }
}


@media (min-width: 768px) {
    #tbl_student td:nth-child(1) {
        display: table-cell;
    }
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


.tbl_sched {
    width: 100%;
    border-collapse: collapse;
}
.tbl_sched th {
    border: 1px solid black;
    font-size: 10px;
    font-weight: 600;
    background: #434875;
    border-top-left-radius: 0px !important;
    border-top-right-radius: 0px !important;
    color: #fff !important;
}

.tbl_sched td {
    border: 1px solid black;
    font-size: 10px;
}

</style>
<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header mb-3 pb-3 d-flex align-items-center gap-2 ">
                <img src="<?php echo base_url('assets/images/attendance.png'); ?>" width="36px" alt="Calendar" />
                <h5 class="table__title"><?= $card_title?></h5>
            </div>
            <div class="card-body mt-4">
                <table class="table" width="100%" id="tbl_student">
                    <thead>
                        <tr>
                            <th class="d-none d-md-table-cell"></th>
                            <th>Scholarship No</th>
                            <th style="white-space:nowrap">Student Name</th>
                            <th class="d-none d-lg-table-cell">Schedule</th>
                            <th class="d-none d-lg-table-cell">Year Level</th>
                            <th class="d-none d-lg-table-cell">Course</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- / Content -->

    <div class="modal fade" id="cutOffModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-calendar-week-fill me-2"></i>Manage
                        Attendance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="attendance_member_id">
                    <div class="form-group">
                        <label for="month" class="form-label">Month of</label>
                        <input type="month" class="form-control" id="month" value="<?= date('Y-m');?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="bi bi-x-square me-2"></i>Close</button>
                    <button type="button" class="btn btn-primary proceed_attendance"><i
                            class="bi bi-arrow-right-square me-2"></i>Proceed</button>
                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" id="viewSchedule" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel" style="color:#fff !important;"><i class="bi bi-calendar2-check-fill me-2"></i>Schedule of Scholars</h5>
        </div>
        <div class="offcanvas-body" id="scholar_schedule">
            <!-- AJAX REQUEST -->
        </div>
    </div>
    <?php $this->load->view('/admin_portal/modal/attendance_record_tbl_modal.php');?>

<script>
    $(document).ready(function() {
        var tbl_student = $('#tbl_student').DataTable({
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
                "url": "<?= base_url('portal/admin_portal/attendance_record/get_student_list')?>",
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

        $(document).on('click', '.view_schedule', function() {
            var member_id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('portal/admin_portal/attendance_record/view_schedule')?>",
                method: "POST",
                data: {
                    member_id: member_id,
                    '_token': csrf_token_value,
                },
                dataType: "json",
                success: function(data) {
                    $('#scholar_schedule').html(data.scholar_schedule);
                    $('#viewSchedule').offcanvas('show')
                }
            });
        });

    });
</script>