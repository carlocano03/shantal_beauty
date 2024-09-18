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

    #tbl_voucher th:nth-child(1),
    #tbl_voucher td:nth-child(1),
    #tbl_voucher th:nth-child(4),
    #tbl_voucher td:nth-child(4),
    #tbl_voucher th:nth-child(5),
    #tbl_voucher td:nth-child(5),
    #tbl_voucher th:nth-child(6),
    #tbl_voucher td:nth-child(6),
    #tbl_voucher th:nth-child(7),
    #tbl_voucher td:nth-child(7) {
        text-align: center;
    }
</style>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header mb-3 pb-3 d-flex align-items-center justify-content-between">
                <div class="d-flex d-flex align-items-center gap-2 ">
                    <img src="<?php echo base_url('assets/images/home/voucher.png'); ?>" width="36px"
                        alt="Calendar" />
                    <h5 class="table__title"><?= $card_title?></h5>
                </div>
            </div>
            <div class="card-body mt-4">
                <table class="table" width="100%" id="tbl_voucher">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Voucher Code</th>
                            <th>Descriptions</th>
                            <th>Date Created</th>
                            <th>End Date</th>
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

<?php $this->load->view('reseller_portal/modal/voucher_modal');?>
<script>
    $(document).ready(function() {
        var tbl_voucher = $('#tbl_voucher').DataTable({
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
                "url": "<?= base_url('reseller/voucher/voucher_list')?>",
                "type": "POST",
                "data": function(d) {
                    d[csrf_token_name] = csrf_token_value;
                    d.stock = $('.filter_option').val();
                },
                "complete": function(res) {
                    csrf_token_name = res.responseJSON.csrf_token_name;
                    csrf_token_value = res.responseJSON.csrf_token_value;
                }
            }
        });

        $('#tbl_voucher_filter').prepend(
            `<button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#voucherModal"><i class="bi bi-ticket-detailed me-1"></i>Create Voucher</button>`
        );

        $(document).on('click', '#save_voucher', function(event) {
            event.preventDefault();
            event.stopPropagation();

            var form = $('#addForm')[0];
            var formData = new FormData(form);
            formData.append('product_id', $('#product').val());
            formData.append('voucher_code', $('#voucher').val());
            formData.append('vocher_desc', $('#vocher_desc').val());
            formData.append('voucher_amt', $('#voucher_amt').val());
            formData.append('end_date', $('#end_date').val());
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
                            url: "<?= base_url('reseller/voucher/add_new_voucher')?>",
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
                                    $('#voucherModal').modal('hide');
                                    form.reset();
                                    form.classList.remove('was-validated');
                                    tbl_voucher.draw();
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

        $(document).on('click', '#update_voucher', function(event) {
            event.preventDefault();
            event.stopPropagation();

            var form = $('#updateForm')[0];
            var formData = new FormData(form);
            formData.append('voucher_id', $('#voucher_id').val());
            formData.append('product_id', $('#edit_product').val());
            formData.append('voucher_code', $('#edit_voucher').val());
            formData.append('vocher_desc', $('#edit_vocher_desc').val());
            formData.append('voucher_amt', $('#edit_voucher_amt').val());
            formData.append('end_date', $('#edit_end_date').val());
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
                            url: "<?= base_url('reseller/voucher/update_voucher')?>",
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
                                    tbl_voucher.draw();
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

        $(document).on('click', '.delete_voucher', function() {
            var voucher_id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure..',
                text: "You want to delete this voucher?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, continue',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('reseller/voucher/delete_voucher')?>",
                        method: "POST",
                        data: {
                            voucher_id: voucher_id,
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
                                tbl_voucher.draw();
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