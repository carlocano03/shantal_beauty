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

    #tbl_reseller th:nth-child(1),
    #tbl_reseller td:nth-child(1),
    #tbl_reseller th:nth-child(4),
    #tbl_reseller td:nth-child(4),
    #tbl_reseller th:nth-child(5),
    #tbl_reseller td:nth-child(5),
    #tbl_reseller th:nth-child(6),
    #tbl_reseller td:nth-child(6) {
        text-align:center;
    }

    #tbl_sales th:nth-child(1),
    #tbl_sales td:nth-child(1),
    #tbl_sales th:nth-child(4),
    #tbl_sales td:nth-child(4) {
        text-align:center;
    }

    #tbl_sales th:nth-child(3),
    #tbl_sales td:nth-child(3),
    #tbl_sales th:nth-child(5),
    #tbl_sales td:nth-child(5) {
        text-align:right;
    }
    
</style>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header mb-3 pb-3 d-flex align-items-center justify-content-between">
                <div class="d-flex d-flex align-items-center gap-2 ">
                    <img src="<?php echo base_url('assets/images/home/commission.png'); ?>" width="36px"
                        alt="Calendar" />
                    <h5 class="table__title"><?= $card_title?></h5>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active position-relative" id="commission-tab" data-bs-toggle="tab"
                            data-bs-target="#commission" type="button" role="tab" aria-controls="commission"
                            aria-selected="true"><i class="bi bi-wallet me-2"></i>My Commission<span
                                class="position-absolute fw-bold top-0 end-0  translate-middle-y badge border border-light rounded-circle bg-danger d-flex align-items-center justify-content-center"
                                style="font-size:12px; width:24px;height:24px; visibility:hidden;" id="active_reseller"></span></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link position-relative" id="recruited-tab" data-bs-toggle="tab" data-bs-target="#recruited"
                            type="button" role="tab" aria-controls="recruited" aria-selected="false"><i class="bi bi-people-fill me-2"></i>Recruited Reseller<span
                                class="position-absolute fw-bold top-0 end-0  translate-middle-y badge border border-light rounded-circle bg-danger d-flex align-items-center justify-content-center"
                                style="font-size:12px; width:24px;height:24px; visibility:hidden;" id="recruited_reseller"></span></button>
                    </li>
                </ul>

                <div class="tab-content p-0" id="myTabContent">
                    <div class="tab-pane fade show active" id="commission" role="tabpanel" aria-labelledby="commission-tab">
                        <div class="row mt-2">
                            <div class="col-md-7">
                                <div class="alert alert-info"><i class="bi bi-bar-chart-line-fill me-2"></i>My Product Sales</div>
                                <table class="table" width="100%" id="tbl_sales">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>QTY</th>
                                            <th>Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-5">

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="recruited" role="tabpanel" aria-labelledby="recruited-tab">
                        <table class="table" width="100%" id="tbl_reseller">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Reseller No</th>
                                    <th>Name</th>
                                    <th>Email Address</th>
                                    <th>Date Joined</th>
                                    <th>Referral Code</th>
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

<script>
    function getResellerCount() {
        $.ajax({
            url: "<?= base_url('reseller/my_commission/get_reseller_count');?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                if (data.recruited_reseller > 0) {
                    $('#recruited_reseller').text(data.recruited_reseller);
                    $('#recruited_reseller').css('visibility', 'visible');
                } else {
                    $('#recruited_reseller').text('');
                    $('#recruited_reseller').css('visibility', 'hidden');
                }
            }
        });
    }
    $(document).ready(function() {
        getResellerCount();

        var tbl_reseller = $('#tbl_reseller').DataTable({
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
                "url": "<?= base_url('reseller/my_commission/get_recruited_reseller')?>",
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

        var tbl_sales = $('#tbl_sales').DataTable({
            language: {
                search: '',
                searchPlaceholder: "Search Here...",
                paginate: {
                    next: '<i class="bi bi-chevron-double-right"></i>',
                    previous: '<i class="bi bi-chevron-double-left"></i>'
                }
            },
            "ordering": false,
            // "serverSide": true,
            // "processing": true,
            // "deferRender": true,
            // "ajax": {
            //     "url": "<?= base_url('reseller/my_commission/get_recruited_reseller')?>",
            //     "type": "POST",
            //     "data": function(d) {
            //         d[csrf_token_name] = csrf_token_value;
            //     },
            //     "complete": function(res) {
            //         csrf_token_name = res.responseJSON.csrf_token_name;
            //         csrf_token_value = res.responseJSON.csrf_token_value;
            //     }
            // }
        });

        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
        });
    });
</script>