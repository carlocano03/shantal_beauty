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
                    <a href="<?= base_url('admin/reseller-account')?>" class="btn btn-dark btn-sm"><i class="bi bi-backspace-fill me-2"></i>Back</a>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active position-relative" id="reseller-info-tab" data-bs-toggle="tab"
                            data-bs-target="#reseller-info" type="button" role="tab" aria-controls="reseller-info"
                            aria-selected="true"><i class="bi bi-person-circle me-2"></i>Reseller Information</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link position-relative" id="sales-tab" data-bs-toggle="tab" data-bs-target="#sales"
                            type="button" role="tab" aria-controls="sales" aria-selected="false"><i class="bi bi-bar-chart-line me-2"></i>Sales Report</button>
                    </li>
                </ul>
                <div class="tab-content p-0" id="myTabContent">
                    <div class="tab-pane fade show active" id="reseller-info" role="tabpanel" aria-labelledby="reseller-info">
                        <div class="row mt-3">
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
                                        <td><?= isset($reseller['referred_by']) ? $reseller['referred_by'] : '';?></td>
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
                                    <tr>
                                        <td class="fw-bold">Referral Code</td>
                                        <td><?= isset($reseller['referral_code']) ? $reseller['referral_code'] : '';?></td>
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
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                        ...
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>