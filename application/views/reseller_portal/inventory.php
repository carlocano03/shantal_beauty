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

    #tbl_product th:nth-child(1),
    #tbl_product td:nth-child(1),
    #tbl_product th:nth-child(3),
    #tbl_product td:nth-child(3),
    #tbl_product th:nth-child(5),
    #tbl_product td:nth-child(5),
    #tbl_product th:nth-child(6),
    #tbl_product td:nth-child(6),
    #tbl_product th:nth-child(7),
    #tbl_product td:nth-child(7) {
        text-align: center;
    }
    #tbl_product th:nth-child(4),
    #tbl_product td:nth-child(4) {
        text-align: right;
    }
</style>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header mb-3 pb-3 d-flex align-items-center justify-content-between">
                <div class="d-flex d-flex align-items-center gap-2 ">
                    <img src="<?php echo base_url('assets/images/home/inventory-management.png'); ?>" width="36px"
                        alt="Calendar" />
                    <h5 class="table__title"><?= $card_title?></h5>
                </div>
            </div>
            <div class="card-body mt-4">
                <table class="table" width="100%" id="tbl_product">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Product</th>
                            <th>Net WT.</th>
                            <th>Price</th>
                            <th>Stocks</th>
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
        var tbl_product = $('#tbl_product').DataTable({
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
                "url": "<?= base_url('reseller/inventory/product_list')?>",
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

        $('#tbl_product_filter').prepend(
            `<select class="filter_option">
                <option value="">Filter Options</option>
                <option value="With Stocks">With Stocks</option>
                <option value="No Stocks">Out of Stocks</option>
            </select>`
        );

        $(document).on('change', '.filter_option', function() {
            tbl_product.draw();
        });
    });
</script>