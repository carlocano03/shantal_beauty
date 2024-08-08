<style>
#tbl_rules th:nth-child(2),
#tbl_rules td:nth-child(2),
#tbl_rules th:nth-child(3),
#tbl_rules td:nth-child(3),
#tbl_rules th:nth-child(4),
#tbl_rules td:nth-child(4),
#tbl_rules th:nth-child(5),
#tbl_rules td:nth-child(5),
#tbl_rules th:nth-child(6),
#tbl_rules td:nth-child(6) {
    text-align: center;
}

#tbl_rules td:nth-child(3),
#tbl_rules td:nth-child(5) {
    display: none;

}

@media (min-width: 992px) {

    #tbl_rules td:nth-child(3),
    #tbl_rules td:nth-child(5) {
        display: table-cell;

    }
}


@media (min-width: 768px) {
    #tbl_rules td:nth-child(1) {
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
</style>

<div class="loading-screen text-center" style="display: none;">
    <div class="spinner-border text-dark" role="status">

    </div>
</div>

<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header mb-3 pb-3 d-flex align-items-center gap-2 ">
                <img src="<?php echo base_url('assets/images/late_rules.png'); ?>" width="36px" alt="Rules" />
                <h5 class="table__title"><?= $card_title?></h5>
            </div>
            <div class="card-body mt-4">
                <table class="table" width="100%" id="tbl_rules">
                    <thead>
                        <tr>
                            <th>Rule Name</th>
                            <th>Consecutive Lates</th>
                            <th class="d-none d-lg-table-cell">No. of Days</th>
                            <th>Status</th>
                            <th class="d-none d-lg-table-cell">Date Added</th>
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

    <?php $this->load->view('admin_portal/modal/late_rules_modal');?>
    <?php $this->load->view('/admin_portal/modal/late_rules_tbl_modal.php');?>


    <script>
    $(document).ready(function() {
        var tbl_rules = $('#tbl_rules').DataTable({
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
                "url": "<?= base_url('portal/admin_portal/late_rules/get_rule_list')?>",
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

        $('#tbl_rules_filter').prepend(
            `<button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#addModal"><i class="bi bi-person-fill-add me-2"></i>Add Late Rules</button>`
        );

        $(document).on('click', '#save_rules', function(event) {
            event.preventDefault();
            event.stopPropagation();

            var form = $('#addForm')[0];
            var formData = new FormData(form);
            formData.append('rule_name', $('#rule_name').val());
            formData.append('no_late', $('#no_late').val());
            formData.append('no_days', $('#no_days').val());
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
                            url: "<?= base_url('portal/admin_portal/late_rules/add_new_rules');?>",
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
                                    $('#addModal').modal('hide');
                                    form.reset();
                                    form.classList.remove('was-validated');
                                    tbl_rules.draw();
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

        $(document).on('click', '#update_rules', function(event) {
            event.preventDefault();
            event.stopPropagation();

            var form = $('#updateForm')[0];
            var formData = new FormData(form);
            formData.append('late_rule_id', $('#late_rule_id').val());
            formData.append('rule_name', $('#edit_rule_name').val());
            formData.append('no_late', $('#edit_no_late').val());
            formData.append('no_days', $('#edit_no_days').val());
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
                            url: "<?= base_url('portal/admin_portal/late_rules/update_rules');?>",
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
                                    tbl_rules.draw();
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

        $(document).on('click', '.rule_activation', function() {
            var late_rule_id = $(this).attr('id');

            if ($(this).is(":checked")) {
                //Activate accouny
                Swal.fire({
                    title: 'Are you sure..',
                    text: "You want to activate this late rule?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, continue',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "<?= base_url('portal/admin_portal/late_rules/rule_activation')?>",
                            method: "POST",
                            data: {
                                late_rule_id: late_rule_id,
                                action: 'Activate',
                                '_token': csrf_token_value,
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data.message == 'Success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Thank you!',
                                        text: 'Late rule successfully activated.',
                                    });
                                    tbl_rules.draw();
                                } else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Oops...',
                                        text: 'Failed to activate the late rule.',
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
                    } else {
                        tbl_rules.draw();
                    }
                });
            } else {
                //Deactivating account
                Swal.fire({
                    title: 'Are you sure..',
                    text: "You want to deactivate this late rule?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, continue',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "<?= base_url('portal/admin_portal/late_rules/rule_activation')?>",
                            method: "POST",
                            data: {
                                late_rule_id: late_rule_id,
                                action: 'Deactivate',
                                '_token': csrf_token_value,
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data.message == 'Success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Thank you!',
                                        text: 'Late rule successfully deactivated.',
                                    });
                                    tbl_rules.draw();
                                } else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Oops...',
                                        text: 'Failed to deactivated the late rule.',
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
                    } else {
                        tbl_rules.draw();
                    }
                });
            }
        });

        $(document).on('click', '#delete_rule', function() {
            var late_rule_id = $(this).data('id');

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
                        url: "<?= base_url('portal/admin_portal/late_rules/rule_activation')?>",
                        method: "POST",
                        data: {
                            late_rule_id: late_rule_id,
                            action: 'Delete',
                            '_token': csrf_token_value,
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.message == 'Success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thank you!',
                                    text: 'Late rule successfully deleted.',
                                });
                                tbl_rules.draw();
                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Oops...',
                                    text: 'Failed to delete the late rule.',
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
        });
    });
    </script>