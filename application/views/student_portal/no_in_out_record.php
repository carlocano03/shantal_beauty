<style>
#tbl_in_out th:nth-child(2),
#tbl_in_out td:nth-child(2),
#tbl_in_out th:nth-child(3),
#tbl_in_out td:nth-child(3),
#tbl_in_out th:nth-child(4),
#tbl_in_out td:nth-child(4),
#tbl_in_out th:nth-child(5),
#tbl_in_out td:nth-child(5),
#tbl_in_out th:nth-child(6),
#tbl_in_out td:nth-child(6) {
    text-align: center;
}

#tbl_in_out td:nth-child(2),
#tbl_in_out td:nth-child(3),
#tbl_in_out td:nth-child(5) {
    display: none;
}

@media (min-width: 992px) {

    #tbl_in_out td:nth-child(2),
    #tbl_in_out td:nth-child(3),
    #tbl_in_out td:nth-child(5) {
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

.no-wrap {
    white-space: nowrap;
}
</style>
<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div
                class="card-header mb-3 pb-3 d-flex align-items-center flex-column justify-content-between gap-3 gap-md-0 flex-md-row ">
                <div class="d-flex gap-2 align-items-center">
                    <img src="<?php echo base_url('assets/images/student_dashboard/in_out.png'); ?>" width="36px"
                        alt="Calendar" />
                    <h5 class="table__title"><?= $card_title?></h5>
                </div>

            </div>
            <div class="card-body">

                <table class="table" width="100%" id="tbl_in_out">
                    <thead>
                        <tr>
                            <th class="no-wrap">Attendance Date</th>
                            <th class="d-none d-lg-table-cell">Remarks</th>
                            <th class="d-none d-lg-table-cell">Date Submitted</th>
                            <th>Status</th>
                            <th class="d-none d-lg-table-cell">Time In/Out</th>
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

    <?php $this->load->view('student_portal/modal/in_out_modal');?>
    <?php $this->load->view('student_portal/modal/in_out_tbl_modal');?>

    <script>
    $(document).ready(function() {
        var tbl_in_out = $('#tbl_in_out').DataTable({
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
                "url": "<?= base_url('portal/student_portal/student_attendance/get_explanation_letter')?>",
                "type": "POST",
                "data": function(d) {
                    d[csrf_token_name] = csrf_token_value;
                },
                "complete": function(res) {
                    csrf_token_name = res.responseJSON.csrf_token_name;
                    csrf_token_value = res.responseJSON.csrf_token_value;
                }
            }
        });

        $('#tbl_in_out_filter').prepend(
            `<button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#letterModal"><i
                class="bi bi-ui-radios me-1"></i>Submit Explanation Letter</button>`
        );

        $(document).on('click', '#save_explanation_letter', function(event) {
            event.preventDefault();
            event.stopPropagation();

            var form = $('#attachmentForm')[0];
            var formData = new FormData(form);

            formData.append('attendance_date', $('#attendance_date').val());
            formData.append('options', $('#options').val());
            formData.append('est_in_out', $('#est_in_out').val());
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
                            url: "<?= base_url('portal/student_portal/student_attendance/save_explanation_letter')?>",
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
                                    $('#letterModal').modal('hide');
                                    form.reset();
                                    form.classList.remove('was-validated');
                                    tbl_in_out.draw();
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

        $(document).on('click', '.delete_request', function() {
            var letter_id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure..',
                text: "You want to delete this request?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, continue',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('portal/student_portal/student_attendance/delete_explanation_letter')?>",
                        method: "POST",
                        data: {
                            letter_id: letter_id,
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
                                tbl_in_out.draw();
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
