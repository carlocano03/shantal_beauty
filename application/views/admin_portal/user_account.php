<style>
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

    #tbl_user_account th:nth-child(1),
    #tbl_user_account td:nth-child(1),
    #tbl_user_account th:nth-child(3),
    #tbl_user_account td:nth-child(3),
    #tbl_user_account th:nth-child(4),
    #tbl_user_account td:nth-child(4),
    #tbl_user_account th:nth-child(5),
    #tbl_user_account td:nth-child(5),
    #tbl_user_account th:nth-child(6),
    #tbl_user_account td:nth-child(6),
    #tbl_user_account th:nth-child(7),
    #tbl_user_account td:nth-child(7) {
        text-align: center;
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
            <div class="card-header mb-3 pb-3 d-flex align-items-center gap-2 ">
                <img src="<?php echo base_url('assets/images/home/verified-account.png'); ?>" width="36px"
                    alt="Calendar" />
                <h5 class="table__title"><?= $card_title?></h5>
            </div>
            <div class="card-body mt-4">
                <table class="table" width="100%" id="tbl_user_account">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Date Created</th>
                            <th>Account Status</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var tbl_user_account = $('#tbl_user_account').DataTable({
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
                "url": "<?= base_url('admin_portal/user_account/get_user_account')?>",
                "type": "POST",
                "data": function(d) {
                    d[csrf_token_name] = csrf_token_value;
                    d.status = $('.filter_option').val();
                },
                "complete": function(res) {
                    csrf_token_name = res.responseJSON.csrf_token_name;
                    csrf_token_value = res.responseJSON.csrf_token_value;
                }
            }
        });

        $(document).on('click', '.account_activation', function() {
            var user_id = $(this).attr('id');

            if ($(this).is(":checked")) {
                //Activate accouny
                Swal.fire({
                    title: 'Are you sure..',
                    text: "You want to activate this account?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, continue',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "<?= base_url('admin_portal/user_account/account_activation')?>",
                            method: "POST",
                            data: {
                                user_id: user_id,
                                action: 'Activate',
                                '_token': csrf_token_value,
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data.message == 'Success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Thank you!',
                                        text: 'Account successfully activated.',
                                    });
                                    tbl_user_account.draw();
                                } else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Oops...',
                                        text: 'Failed to activate the account.',
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
                        tbl_user_account.draw();
                    }
                });
            } else {
                //Deactivating account
                Swal.fire({
                    title: 'Are you sure..',
                    text: "You want to deactivate this account?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, continue',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "<?= base_url('admin_portal/user_account/account_activation')?>",
                            method: "POST",
                            data: {
                                user_id: user_id,
                                action: 'Deactivate',
                                '_token': csrf_token_value,
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data.message == 'Success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Thank you!',
                                        text: 'Account successfully deactivated.',
                                    });
                                    tbl_user_account.draw();
                                } else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Oops...',
                                        text: 'Failed to deactivated the account.',
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
                        tbl_user_account.draw();
                    }
                });
            }
        });

        $(document).on('click', '.delete_account', function() {
            var user_id = $(this).data('user_id');

            Swal.fire({
                title: 'Are you sure..',
                text: "You want to delete this account?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, continue',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('admin_portal/user_account/delete_account')?>",
                        method: "POST",
                        data: {
                            user_id: user_id,
                            '_token': csrf_token_value,
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.message == 'Success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thank you!',
                                    text: 'Account successfully deleted.',
                                });
                                tbl_user_account.draw();
                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Oops...',
                                    text: 'Failed to delete the account.',
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