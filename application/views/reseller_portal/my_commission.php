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
    text-align: center;
}

#tbl_sales th:nth-child(1),
#tbl_sales td:nth-child(1),
#tbl_sales th:nth-child(5),
#tbl_sales td:nth-child(5) {
    text-align: center;
}

#tbl_sales th:nth-child(3),
#tbl_sales td:nth-child(3),
#tbl_sales th:nth-child(4),
#tbl_sales td:nth-child(4) {
    text-align: right;
}

.commission-wallet__container {
    background: #ffffff;
    border-radius: 10px;
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    padding-bottom: 20px;

}

.commission-wallet__header {
    background: linear-gradient(135deg, #1A2A6C, #4E6EAF, #70C1B3);
    padding: 32px 24px 18px 24px;
    text-align: center;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;

}

.commission-wallet__header__title {
    font-size: 16px;
    font-weight: bold;
    color: #ffffff;
    margin-bottom: 10px;
    text-transform: uppercase;
}

.commission-wallet__header__price {
    font-size: 32px;
    font-weight: 700;
    color: #ffffff;

}

.commission-wallet__header__icon-container {
    background-color: #ffffff;
    width: 44px;
    height: 44px;
    padding: 12px;
    border-radius: 100%;
}

.commission-wallet__header__items {
    margin-top: 24px;
    display: flex;
    justify-content: space-evenly;
}

.commission-wallet__header__item {
    display: inline-block;
    cursor: pointer;
}

.commission-wallet__header__name {
    color: #ffffff;
    font-size: 12px;
    margin-top: 8px;
}

.commission-wallet__content__title {
    font-size: 16px;
    padding-bottom: 8px;
    font-weight: bold;
    padding-top: 20px;
}

.commission-wallet__table__header,
.commission-wallet__table__item {
    display: flex;
    justify-content: space-between;
}

.commission-wallet__table__header div,
.commission-wallet__table__item div {
    flex: 1;
    padding: 10px;
    text-align: center;

}

.commission-wallet__table__header {
    font-weight: bold;
    background-color: #f5f5f5;
}

.commission-wallet__table__item {
    background-color: #fff;
    border-bottom: 1px solid #ddd;
    align-items: center;
}

.commission-wallet__table__item:last-child {
    border-bottom: none;
}

.table__status {
    font-size: 14px;
}

.commission-wallet__table {
    max-height: 200px;
    overflow-y: auto;
}

.commission-wallet__table::-webkit-scrollbar {
    width: 5px;
}

.commission-wallet__table::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.commission-wallet__table::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}

.commission-wallet__table::-webkit-scrollbar-thumb:hover {
    background: #555;
}

.commission-wallet__table {
    scrollbar-width: thin;
    scrollbar-color: #888 #f1f1f1;
}

.filter-pending,
.filter-history {
    max-width: 220px;
    font-size: 14px;
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
                                style="font-size:12px; width:24px;height:24px; visibility:hidden;"
                                id="active_reseller"></span></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link position-relative" id="recruited-tab" data-bs-toggle="tab"
                            data-bs-target="#recruited" type="button" role="tab" aria-controls="recruited"
                            aria-selected="false"><i class="bi bi-people-fill me-2"></i>Recruited Reseller<span
                                class="position-absolute fw-bold top-0 end-0  translate-middle-y badge border border-light rounded-circle bg-danger d-flex align-items-center justify-content-center"
                                style="font-size:12px; width:24px;height:24px; visibility:hidden;"
                                id="recruited_reseller"></span></button>
                    </li>
                </ul>

                <div class="tab-content p-0" id="myTabContent">
                    <div class="tab-pane fade show active" id="commission" role="tabpanel"
                        aria-labelledby="commission-tab">
                        <div class="row mt-2">
                            <div class="col-md-7">
                                <div class="alert alert-info"><i class="bi bi-bar-chart-line-fill me-2"></i>My Product
                                    Sales</div>
                                <table class="table" width="100%" id="tbl_sales">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Order No</th>
                                            <th>Amount</th>
                                            <th>Commission</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-5 mt-5 mt-md-0">
                                <div class="commission-wallet__container">
                                    <div class="commission-wallet__header">
                                        <h1 class="commission-wallet__header__title">Total Commision</h1>
                                        <div class="commission-wallet__header__price" id="commission_amt"></div>
                                        <div class="commission-wallet__header__items">
                                            <div class="commission-wallet__header__item">
                                                <div class="commission-wallet__header__icon-container">
                                                    <img class="commission-wallet__header__icon"
                                                        src="<?php echo base_url('assets/images/reseller/withdrawal.png'); ?>"
                                                        alt="history" />
                                                </div>
                                                <div class="commission-wallet__header__name">Withdraw</div>
                                            </div>
                                            <div class="commission-wallet__header__item"
                                                onclick="toggleSections('collapsePending', 'collapseHistory')">
                                                <div class="commission-wallet__header__icon-container">
                                                    <img class="commission-wallet__header__icon"
                                                        src="<?php echo base_url('assets/images/reseller/history.png'); ?>"
                                                        alt="history" />
                                                </div>
                                                <div class="commission-wallet__header__name">Pending</div>
                                            </div>
                                            <div class="commission-wallet__header__item"
                                                onclick="toggleSections( 'collapseHistory','collapsePending')">
                                                <div class="commission-wallet__header__icon-container">
                                                    <img class="commission-wallet__header__icon"
                                                        src="<?php echo base_url('assets/images/reseller/receipt.png'); ?>"
                                                        alt="history" />
                                                </div>
                                                <div class="commission-wallet__header__name">History</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="commission-wallet__content px-4">
                                        <div class="collapse show" id="collapseHistory">

                                            <div class="d-flex align-items-center justify-content-between">
                                                <h1 class="commission-wallet__content__title">History</h1>
                                                <select class="form-select filter-pending">
                                                    <option value="date-newest">Date: Newest to Oldest</option>
                                                    <option value="date-oldest">Date: Oldest to Newest</option>
                                                    <option value="amount-high">Amount: Highest to Lowest</option>
                                                    <option value="amount-low">Amount: Lowest to Highest</option>
                                                </select>
                                            </div>
                                            <div>
                                                <div class="commission-wallet__table__header">
                                                    <div>Date</div>
                                                    <div>Amount</div>
                                                    <div>Status</div>
                                                </div>
                                                <div class="commission-wallet__table">
                                                    <!-- <div class="commission-wallet__table__item">
                                                        <div>Jan 09, 2024</div>
                                                        <div>₱2,000</div>
                                                        <div class="table__status text-success">Completed</div>
                                                    </div>
                                                    <div class="commission-wallet__table__item">
                                                        <div>Jan 09, 2024</div>
                                                        <div>₱2,000</div>
                                                        <div class="table__status text-success">Completed</div>
                                                    </div>
                                                    <div class="commission-wallet__table__item">
                                                        <div>Jan 09, 2024</div>
                                                        <div>₱2,000</div>
                                                        <div class="table__status text-success">Completed</div>
                                                    </div>
                                                    <div class="commission-wallet__table__item">
                                                        <div>Jan 09, 2024</div>
                                                        <div>₱2,000</div>
                                                        <div class="table__status text-success">Completed</div>
                                                    </div>
                                                    <div class="commission-wallet__table__item">
                                                        <div>Jan 09, 2024</div>
                                                        <div>₱2,000</div>
                                                        <div class="table__status text-success">Completed</div>
                                                    </div>
                                                    <div class="commission-wallet__table__item">
                                                        <div>Jan 09, 2024</div>
                                                        <div>₱2,000</div>
                                                        <div class="table__status text-success">Completed</div>
                                                    </div>
                                                    <div class="commission-wallet__table__item">
                                                        <div>Jan 09, 2024</div>
                                                        <div>₱2,000</div>
                                                        <div class="table__status text-success">Completed</div>
                                                    </div>
                                                    <div class="commission-wallet__table__item">
                                                        <div>Jan 09, 2024</div>
                                                        <div>₱2,000</div>
                                                        <div class="table__status text-success">Completed</div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="commission-wallet__content px-4">
                                        <div class="collapse" id="collapsePending">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h1 class="commission-wallet__content__title">Pending</h1>
                                                <select class="form-select filter-pending">
                                                    <option value="date-newest">Date: Newest to Oldest</option>
                                                    <option value="date-oldest">Date: Oldest to Newest</option>
                                                    <option value="amount-high">Amount: Highest to Lowest</option>
                                                    <option value="amount-low">Amount: Lowest to Highest</option>
                                                </select>
                                            </div>

                                            <div>
                                                <div class="commission-wallet__table__header">
                                                    <div>Date</div>
                                                    <div>Amount</div>
                                                    <div>Reason</div>
                                                </div>
                                                <div class="commission-wallet__table">
                                                    <div class="commission-wallet__table__item">
                                                        <div>Jan 02, 2024</div>
                                                        <div>₱2,000</div>
                                                        <div class="table__status text-warning">Awaiting Approval
                                                        </div>
                                                    </div>
                                                    <div class="commission-wallet__table__item">
                                                        <div>Jan 09, 2024</div>
                                                        <div>₱2,000</div>
                                                        <div class="table__status text-warning">Under Review</div>
                                                    </div>
                                                    <div class="commission-wallet__table__item">
                                                        <div>Jan 09, 2024</div>
                                                        <div>₱2,000</div>
                                                        <div class="text-warning table__status">Verifying
                                                            Transaction</div>
                                                    </div>
                                                    <div class="commission-wallet__table__item">
                                                        <div>Jan 09, 2024</div>
                                                        <div>₱2,000</div>
                                                        <div class="text-warning table__status">Verifying
                                                            Transaction</div>
                                                    </div>
                                                    <div class="commission-wallet__table__item">
                                                        <div>Jan 09, 2024</div>
                                                        <div>₱2,000</div>
                                                        <div class="text-warning table__status">Verifying
                                                            Transaction</div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
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

    function getCommission() {
        $.ajax({
            url: "<?= base_url('reseller/my_commission/get_commission_amt');?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                const countUpConfigs = [{
                        elementId: 'commission_amt',
                        targetValue: data.commission_amt,

                    }
                ];

                countUpConfigs.forEach((config) => {
                    var countUp = new CountUp(config.elementId, 0, config
                        .targetValue,
                        2, 4, {
                            duration: 5,
                            useEasing: true,
                            separator: ',',
                            prefix: '₱',
                        });

                    if (!countUp.error) {
                        countUp.start();
                    } else {
                        console.error("CountUp Error:", countUp.error);
                    }
                });
            }
        });
    }

    $(document).ready(function() {
        getResellerCount();
        getCommission();

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
            "serverSide": true,
            "processing": true,
            "deferRender": true,
            "ajax": {
                "url": "<?= base_url('reseller/my_commission/get_my_sales')?>",
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

        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            $.fn.dataTable.tables({
                visible: true,

                api: true
            }).columns.adjust();
        });

    });

    // toggle Collapse
    function toggleSections(showId, hideId) {
        const showElement = document.getElementById(showId);
        const hideElement = document.getElementById(hideId);

        if (showElement.classList.contains('show')) {
            r
            eturn;
        } else {
            showElement.classList.add('show');
            hideElement.classList.remove('show');
        }

    }
    </script>