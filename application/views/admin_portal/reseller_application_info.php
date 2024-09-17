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

    .img-wrapper {
        width: 100%;
    }
    .tbl-info {
        width: 100%;
        border-collapse: collapse;
        color: #636e72;
    }
    .tbl-info td {
        border: 1.5px solid #b2bec3;
        padding: 5px !important;
    }
</style>

<div class="modal fade" id="declineModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-person-lines-fill me-2"></i>Declined Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="applicationID" value="<?= $this->cipher->decrypt($this->input->get('application', true))?>">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="comments" style="height: 100px" required></textarea>
                    <label for="comments">Comments</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="decline_request">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header mb-3 pb-3 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <img src="<?php echo base_url('assets/images/home/trade-show.png'); ?>" width="36px"
                        alt="Calendar" />
                    <h5 class="table__title"><?= $card_title?></h5>
                </div>
                <div class="me-3">
                    <h5 class="table__title">Application No.: <?= isset($reseller['application_no']) ? $reseller['application_no'] : '';?></h5>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <?php
                            $img = base_url()."assets/images/home/valid-id.png";
                            if(!empty($reseller['id_attachment'])){
                                if(file_exists('./assets/uploaded_file/reseller_application/'.$reseller['id_attachment'])){
                                    $img = base_url()."assets/uploaded_file/reseller_application/".$reseller['id_attachment'];
                                }
                            }
                        ?>
                        <div class="img-wrapper">
                            <img src="<?= $img;?>" alt="">
                        </div>
                        <hr>
                        <table class="tbl-info">
                            <tr>
                                <td colspan="2" style="background: #b2bec3; color:#fff;" class="fw-bold">REFERRED BY</td>
                            </tr>
                            <tr>
                                <td class="fw-bold" style="width:30%;">Name</td>
                                <td><?= isset($referred_by['referred_name']) ? $referred_by['referred_name'] : '';?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Referred Code</td>
                                <td><?= isset($referred_by['referral_code']) ? $referred_by['referral_code'] : '';?></td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-8">
                        <table class="tbl-info">
                            <tr>
                                <td colspan="2" style="background: #b2bec3; color:#fff;" class="fw-bold">PERSONAL INFORMATION</td>
                            </tr>
                            <tr>
                                <td class="fw-bold" style="width:20%;">Type of ID</td>
                                <td><?= isset($reseller['type_id']) ? $reseller['type_id'] : '';?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Reseller Name</td>
                                <?php
                                    $last_name = isset($reseller['last_name']) ? $reseller['last_name'] : '';
                                    $first_name = isset($reseller['first_name']) ? $reseller['first_name'] : '';
                                ?>
                                <td>
                                    <?= ucwords($first_name).' '.ucwords($last_name);?>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Email Address</td>
                                <td><?= isset($reseller['email_address']) ? $reseller['email_address'] : '';?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Contact Number</td>
                                <td><?= isset($reseller['phone_number']) ? $reseller['phone_number'] : '';?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">TIN Number</td>
                                <td><?= isset($reseller['tin_no']) ? $reseller['tin_no'] : '';?></td>
                            </tr>
                        </table>
                        <table class="tbl-info">
                            <tr>
                                <td style="background: #b2bec3; color:#fff;" class="fw-bold">COMPLETE ADDRESS</td>
                            </tr>
                            <tr>
                                <?php
                                    $address = $reseller['street'].' '.$reseller['barangay'].', '.$reseller['municipality'].', '.$reseller['province'];
                                ?>
                                <td><?= ucwords($address);?></td>
                            </tr>
                        </table>
                        <table class="tbl-info">
                            <tr>
                                <td colspan="2" style="background: #b2bec3; color:#fff;" class="fw-bold">BANK INFORMATION</td>
                            </tr>
                            <tr>
                                <td class="fw-bold" style="width:20%;">Bank Type</td>
                                <td><?= isset($reseller['bank_type']) ? $reseller['bank_type'] : '';?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Bank Name</td>
                                <td><?= isset($reseller['bank_name']) ? $reseller['bank_name'] : '';?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Account Number</td>
                                <td><?= isset($reseller['account_number']) ? $reseller['account_number'] : '';?></td>
                            </tr>
                        </table>
                        <hr>
                        <div class="text-end">
                            <button class="btn btn-success approved_request" id="<?= $this->cipher->decrypt($this->input->get('application', true))?>">Approve Request</button>
                            <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#declineModal">Decline Request</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="loading-screen text-center" style="display: none;">
    <div class="spinner-border text-dark" role="status">

    </div>
</div>

<script>
    $(document).ready(function() {

        $('.approved_request').on('click', function() {
            var application_id = $(this).attr('id');

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
                        url: "<?= base_url('admin_portal/reseller_application/approval_reseller_application')?>",
                        method: "POST",
                        data: {
                            application_id: application_id,
                            action: 'Approve',
                            '_token': csrf_token_value,
                        },
                        dataType: "json",
                        beforeSend: function () {
                            $('.loading-screen').show();
                        },
                        success: function(data) {
                            if (data.error != '') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Oops...',
                                    text: data.error,
                                }); 
                                $('.loading-screen').hide();
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thank you!',
                                    text: data.success,
                                });
                                setTimeout(() => {
                                    window.location.href = "<?= base_url('admin/reseller-application')?>";
                                }, 3000);
                            }
                        },
                        complete: function () {
                            $('.loading-screen').hide();
                        },
                        error: function () {
                            $('.loading-screen').hide();
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

        $('#decline_request').on('click', function() {
            var application_id = $('#applicationID').val();
            var comment = $('#comments').val();

            if (comment != '') {
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
                            url: "<?= base_url('admin_portal/reseller_application/approval_reseller_application')?>",
                            method: "POST",
                            data: {
                                application_id: application_id,
                                comment: comment,
                                action: 'Decline',
                                '_token': csrf_token_value,
                            },
                            dataType: "json",
                            beforeSend: function () {
                                $('.loading-screen').show();
                            },
                            success: function(data) {
                                if (data.error != '') {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Oops...',
                                        text: data.error,
                                    }); 
                                    $('.loading-screen').hide();
                                } else {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Thank you!',
                                        text: data.success,
                                    });
                                    setTimeout(() => {
                                        window.location.href = "<?= base_url('admin/reseller-application')?>";
                                    }, 3000);
                                }
                            },
                            complete: function () {
                                $('.loading-screen').hide();
                            },
                            error: function () {
                                $('.loading-screen').hide();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ooops...',
                                    text: 'An error occurred while processing the request.',
                                });
                            }
                        });
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Please provide a valid comment.',
                }); 
            }
            
        });
    });
</script>