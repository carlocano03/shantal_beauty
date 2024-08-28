<style>
    #tbl_in_out th:nth-child(1),
    #tbl_in_out td:nth-child(1),
    #tbl_in_out th:nth-child(3),
    #tbl_in_out td:nth-child(3),
    #tbl_in_out th:nth-child(4),
    #tbl_in_out td:nth-child(4),
    #tbl_in_out th:nth-child(5),
    #tbl_in_out td:nth-child(5),
    #tbl_in_out th:nth-child(6),
    #tbl_in_out td:nth-child(6),
    #tbl_in_out th:nth-child(7),
    #tbl_in_out td:nth-child(7) {
        text-align: center;
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

    .filter_option {
        width: 130px;
        height: 35px;
        border-radius: 5px;
        border: 1.5px solid #b2bec3;
        color: #2d3436;
        font-size: 14px;
        outline: none !important;
        padding-left: 6px;
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
                    <img src="<?php echo base_url('assets/images/student_dashboard/in_out.png'); ?>"
                        width="36px" alt="Calendar" />
                    <h5 class="table__title"><?= $card_title?></h5>
                </div>

            </div>
            <div class="card-body">
                <table class="table" width="100%" id="tbl_in_out">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Scholar</th>
                            <th>Remarks</th>
                            <th>Date Submitted</th>
                            <th>Status</th>
                            <th>Time In/Out</th>
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

    <?php $this->load->view('admin_portal/modal/approval_modal');?>

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
                "url": "<?= base_url('portal/admin_portal/attendance_record/get_explanation_letter')?>",
                "type": "POST",
                "data": function(d) {
                    d[csrf_token_name] = csrf_token_value;
                    d.filter = $('.filter_option').val();
                },
                "complete": function(res) {
                    csrf_token_name = res.responseJSON.csrf_token_name;
                    csrf_token_value = res.responseJSON.csrf_token_value;
                }
            }
        });

        $('#tbl_in_out_filter').prepend(
            `<select class="filter_option">
                <option value="">Filter Options</option>
                <option value="For Approval">For Approval</option>
                <option value="Valid Letter">Valid Letter</option>
                <option value="Invalid Letter">Invalid Letter</option>
            </select>`
        );

        $(document).on('change', '.filter_option', function() {
            tbl_in_out.draw();
        });

        $(document).on('click', '#download_explanation', function() {
            var letter_id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('portal/admin_portal/attendance_record/download_explanation_letter')?>",
                method: "POST",
                data: {
                    letter_id: letter_id,
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

        $(document).on('click', '.approval_modal', function() {
            var letter_id = $(this).data('id');
            var attendance_date = $(this).data('attendance_date');
            var remarks = $(this).data('remarks');
            var time_in_out = $(this).data('time_in_out');
            var member_id = $(this).data('member_id');

            $('#letter_id').val(letter_id);
            $('#attendance_date').val(attendance_date);
            $('#remarks').val(remarks);
            $('#time_in_out').val(time_in_out);
            $('#member_id').val(member_id);
            $('#letterModal').modal('show');
        });

        $(document).on('click', '#approval_explanation_letter', function(event) {
            event.preventDefault();
            event.stopPropagation();

            var form = $('#approvalForm')[0];
            var formData = new FormData(form);
            formData.append('letter_id', $('#letter_id').val());
            formData.append('attendance_date', $('#attendance_date').val());
            formData.append('remarks', $('#remarks').val());
            formData.append('time_in_out', $('#time_in_out').val());
            formData.append('member_id', $('#member_id').val());
            formData.append('request_validation', $('#request_validation').val());
            formData.append('comment', $('#comment').val());
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
                            url: "<?= base_url('portal/admin_portal/attendance_record/approval_explanation_letter');?>",
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
    });
</script>