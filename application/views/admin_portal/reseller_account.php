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

    #tbl_active_reseller th:nth-child(1),
    #tbl_active_reseller td:nth-child(1),
    #tbl_active_reseller th:nth-child(4),
    #tbl_active_reseller td:nth-child(4),
    #tbl_active_reseller th:nth-child(5),
    #tbl_active_reseller td:nth-child(5),
    #tbl_active_reseller th:nth-child(6),
    #tbl_active_reseller td:nth-child(6),
    #tbl_active_reseller th:nth-child(7),
    #tbl_active_reseller td:nth-child(7) {
        text-align:center;
    }

    #tbl_inactive_reseller th:nth-child(1),
    #tbl_inactive_reseller td:nth-child(1),
    #tbl_inactive_reseller th:nth-child(4),
    #tbl_inactive_reseller td:nth-child(4),
    #tbl_inactive_reseller th:nth-child(5),
    #tbl_inactive_reseller td:nth-child(5),
    #tbl_inactive_reseller th:nth-child(6),
    #tbl_inactive_reseller td:nth-child(6),
    #tbl_inactive_reseller th:nth-child(7),
    #tbl_inactive_reseller td:nth-child(7) {
        text-align:center;
    }
</style>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <ul class="nav nav-tabs  mt-4" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active position-relative" id="active-reseller-tab" data-bs-toggle="tab"
                    data-bs-target="#active-reseller" type="button" role="tab" aria-controls="active-reseller"
                    aria-selected="true">Active Reseller<span
                        class="position-absolute fw-bold top-0 end-0  translate-middle-y badge border border-light rounded-circle bg-danger d-flex align-items-center justify-content-center"
                        style="font-size:12px; width:24px;height:24px; visibility:hidden;" id="active_reseller"></span></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link position-relative" id="inactive-tab" data-bs-toggle="tab" data-bs-target="#inactive"
                    type="button" role="tab" aria-controls="inactive" aria-selected="false">Inactive Reseller<span
                        class="position-absolute fw-bold top-0 end-0  translate-middle-y badge border border-light rounded-circle bg-danger d-flex align-items-center justify-content-center"
                        style="font-size:12px; width:24px;height:24px; visibility:hidden;" id="inactive-reseller"></span></button>
            </li>
        </ul>
        <div class="tab-content p-0" id="myTabContent">
            <div class="tab-pane fade show active" id="active-reseller" role="tabpanel" aria-labelledby="active-reseller-tab">
                <div class="card">
                    <div class="card-body">
                        <table class="table" width="100%" id="tbl_active_reseller">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Reseller No</th>
                                    <th>Name</th>
                                    <th>Email Address</th>
                                    <th>Date Created</th>
                                    <th>Referral Code</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="inactive" role="tabpanel" aria-labelledby="inactive-tab">
                <div class="card">
                    <div class="card-body">
                        <table class="table" width="100%" id="tbl_inactive_reseller">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Reseller No</th>
                                    <th>Name</th>
                                    <th>Email Address</th>
                                    <th>Date Created</th>
                                    <th>Referral Code</th>
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
    </div>
</div>

<div class="modal fade" id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-person-lines-fill me-2"></i>Update Reseller Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm" class="needs-validation" novalidate>
                    <input type="hidden" id="reseller_id">
                    <div class="form-group mb-3">
                        <label for="reseller_status" class="form-label">Reseller Status</label>
                        <select name="reseller_status" id="reseller_status" class="form-select">
                            <option value="">Please choose on the following options</option>
                            <option value="0">Active</option>
                            <option value="1">Inactive</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid status.
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update_status">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    function getResellerCount() {
        $.ajax({
            url: "<?= base_url('admin_portal/reseller_application/get_reseller_count');?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                if (data.active_reseller > 0) {
                    $('#active_reseller').text(data.active_reseller);
                    $('#active_reseller').css('visibility', 'visible');
                } else {
                    $('#active_reseller').text('');
                    $('#active_reseller').css('visibility', 'hidden');
                }

                if (data.inactive_reseller > 0) {
                    $('#inactive-reseller').text(data.inactive_reseller);
                    $('#inactive-reseller').css('visibility', 'visible');
                } else {
                    $('#inactive-reseller').text('');
                    $('#inactive-reseller').css('visibility', 'hidden');
                }
            }
        });
    }
    $(document).ready(function() {
        getResellerCount();

        var tbl_active_reseller = $('#tbl_active_reseller').DataTable({
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
                "url": "<?= base_url('admin_portal/reseller_application/get_reseller_account')?>",
                "type": "POST",
                "data": function(d) {
                    d[csrf_token_name] = csrf_token_value;
                    d.status = 'Active';
                },
                "complete": function(res) {
                    csrf_token_name = res.responseJSON.csrf_token_name;
                    csrf_token_value = res.responseJSON.csrf_token_value;
                }
            }
        });

        var tbl_inactive_reseller = $('#tbl_inactive_reseller').DataTable({
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
                "url": "<?= base_url('admin_portal/reseller_application/get_reseller_account')?>",
                "type": "POST",
                "data": function(d) {
                    d[csrf_token_name] = csrf_token_value;
                    d.status = 'Inactive';
                },
                "complete": function(res) {
                    csrf_token_name = res.responseJSON.csrf_token_name;
                    csrf_token_value = res.responseJSON.csrf_token_value;
                }
            }
        });

        // Adjust column sizing when a tab is shown
        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
        });

        $(document).on('click', '.update_modal', function() {
            var reseller_id = $(this).data('id');
            
            $('#reseller_id').val(reseller_id);
            $('#updateModal').modal('show');
        });

        $(document).on('click', '#update_status', function(event) {
            event.preventDefault();
            event.stopPropagation();

            var form = $('#updateForm')[0];
            var formData = new FormData(form);

            formData.append('reseller_id', $('#reseller_id').val());
            formData.append('reseller_status', $('#reseller_status').val());
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
                            url: "<?= base_url('admin_portal/reseller_application/update_reseller_status')?>",
                            method: "POST",
                            data: formData,
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function(data) {
                                if (data.error != '') {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Oops...',
                                        text: data.error,
                                    }); 
                                } else {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Thank you!',
                                        text: data.success,
                                    });
                                    $('#updateModal').modal('hide');
                                    tbl_active_reseller.draw();
                                    tbl_inactive_reseller.draw();
                                    getResellerCount();
                                    form.reset();
                                    form.classList.remove('was-validated');
                                }
                            },
                            error :function() {
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
    });
</script>