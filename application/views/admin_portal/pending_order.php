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

    #tbl_orders th:nth-child(1),
    #tbl_orders td:nth-child(1),
    #tbl_orders th:nth-child(3),
    #tbl_orders td:nth-child(3),
    #tbl_orders th:nth-child(4),
    #tbl_orders td:nth-child(4),
    #tbl_orders th:nth-child(5),
    #tbl_orders td:nth-child(5) {
        text-align: center;
    }

    #tbl_orders th:nth-child(6),
    #tbl_orders td:nth-child(6) {
        text-align: right;
    }

</style>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header mb-3 pb-3 d-flex align-items-center gap-2 ">
                <img src="<?php echo base_url('assets/images/home/pending-order.png'); ?>" width="36px"
                    alt="Calendar" />
                <h5 class="table__title"><?= $card_title?></h5>
            </div>
            <div class="card-body">
                <table class="table" width="100%" id="tbl_orders">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Order No.</th>
                            <th>No. Items</th>
                            <th>Referred By</th>
                            <th>Order Date</th>
                            <th>Total Amount</th>
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
        var tbl_orders = $('#tbl_orders').DataTable({
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
                "url": "<?= base_url('admin_portal/online_orders/get_orders')?>",
                "type": "POST",
                "data": function(d) {
                    d[csrf_token_name] = csrf_token_value;
                    d.status = 'Pending';
                },
                "complete": function(res) {
                    csrf_token_name = res.responseJSON.csrf_token_name;
                    csrf_token_value = res.responseJSON.csrf_token_value;
                }
            }
        });
    });
</script>