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

    #tbl_stock th:nth-child(1),
    #tbl_stock td:nth-child(1),
    #tbl_stock th:nth-child(2),
    #tbl_stock td:nth-child(2),
    #tbl_stock th:nth-child(3),
    #tbl_stock td:nth-child(3),
    #tbl_stock th:nth-child(4),
    #tbl_stock td:nth-child(4),
    #tbl_stock th:nth-child(5),
    #tbl_stock td:nth-child(5) {
        text-align: center;
    }
</style>
<!-- Content wrapper -->
<?php
    $product_id = $this->cipher->decrypt($this->input->get('id', true));
?>
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header mb-3 pb-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex d-flex align-items-center gap-2">
                            <img src="<?php echo base_url('assets/images/home/inventory-management.png'); ?>" width="36px"
                                alt="Calendar" />
                            <h5 class="table__title"><?= $card_title?></h5>
                        </div>
                        <div class="d-flex d-flex align-items-center gap-2 me-3">
                            <a href="<?= base_url('reseller/inventory');?>" class="btn btn-dark btn-sm px-3"><i class="bi bi-backspace me-2"></i>BACK</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-dark"><i class="bi bi-box-seam-fill me-2"></i>Product Name: <?= isset($product['product_name']) ? $product['product_name'] : '';?></div>
                        <table class="table" width="100%" id="tbl_stock">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Lot Number</th>
                                    <th>Expiration Date</th>
                                    <th>Stocks</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <hr>
                        <div class="row">
                            <div class="col-md-5">
                                <?php
                                    $img = base_url()."assets/images/logo.png";
                                    if(!empty($product['main_product_img'])){
                                        if(file_exists('./assets/uploaded_file/uploaded_product/'.$product['main_product_img'])){
                                            $img = base_url()."assets/uploaded_file/uploaded_product/".$product['main_product_img'];
                                        }
                                    }
                                ?>
                                <img src="<?= $img;?>" style="width:100%;">
                            </div>
                            <div class="col-md-7">
                                <p style="font-size:14px; text-align:justify;">
                                    <?= isset($product['description']) ? nl2br(htmlspecialchars($product['description'])) : ''; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var tbl_stock = $('#tbl_stock').DataTable({
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
                "url": "<?= base_url('reseller/inventory/get_lot_number')?>",
                "type": "POST",
                "data": function(d) {
                    d[csrf_token_name] = csrf_token_value;
                    d.product = "<?= $product_id;?>";
                },
                "complete": function(res) {
                    csrf_token_name = res.responseJSON.csrf_token_name;
                    csrf_token_value = res.responseJSON.csrf_token_value;
                }
            }
        });
    });
</script>