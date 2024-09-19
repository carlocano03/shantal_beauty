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
    $product_id = $this->cipher->decrypt($this->input->get('product', true));
?>
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header mb-3 pb-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex d-flex align-items-center gap-2">
                            <img src="<?php echo base_url('assets/images/home/inventory-management.png'); ?>" width="36px"
                                alt="Calendar" />
                            <h5 class="table__title"><?= $card_title?></h5>
                        </div>
                        <div class="d-flex d-flex align-items-center gap-2">
                            <a href="<?= base_url('admin/product-management');?>" class="btn btn-dark btn-sm px-3"><i class="bi bi-backspace me-1"></i>BACK</a>
                            <button class="btn btn-primary btn-sm px-3 me-3" id="new_lot_no"><i class="bi bi-plus-lg me-1"></i>NEW LOT NUMBER</button>
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
                                    <th></th>
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
                                <p style="font-size:12px; text-align:justify;">
                                    <?= isset($product['description']) ? nl2br(htmlspecialchars($product['description'])) : ''; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header mb-3 pb-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex d-flex align-items-center gap-2 ">
                            <img src="<?php echo base_url('assets/images/home/lot_number.png'); ?>" width="36px"
                                alt="Calendar" />
                            <h5 class="table__title">New Lot Number</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="addFormNewLot" class="needs-validation" novalidate>
                            <input type="hidden" id="product_id" value="<?= isset($product['product_id']) ? $product['product_id'] : '';?>">
                            <div class="form-group mb-3">
                                <label for="new_product_name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="new_product_name" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="net_wt" class="form-label">Net Wt.</label>
                                <input type="text" class="form-control" id="net_wt" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="lot_number" class="form-label">Lot Number</label>
                                <input type="text" class="form-control" id="lot_number" readonly>
                                <div class="invalid-feedback">
                                    Please provide a valid lot number.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="expiration_date" class="form-label">Expiration Date</label>
                                <input type="date" class="form-control" id="expiration_date" readonly>
                                <div class="invalid-feedback">
                                    Please provide a valid expiration date.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="qty_in" class="form-label">Quantity</label>
                                <input type="text" class="form-control number-input" id="qty_in" readonly>
                                <div class="invalid-feedback">
                                    Please provide a valid quantity.
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-secondary" id="cancel" disabled>Cancel</button>
                                <button type="button" class="btn btn-primary px-5" id="add_stocks" disabled>Add Stocks</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var product_name = "<?= isset($product['product_name']) ? $product['product_name'] : '';?>";
    var net_wt = "<?= isset($product['net_weight']) ? $product['net_weight'] : '';?>";

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
                "url": "<?= base_url('admin_portal/inventory/product_management/get_lot_number')?>",
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
        
        $(document).on('click', '#new_lot_no', function() {
            $('#lot_number').attr('readonly', false);
            $('#expiration_date').attr('readonly', false);
            $('#qty_in').attr('readonly', false);

            $('#lot_umber').focus();
            $('#cancel').attr('disabled', false);
            $('#add_stocks').attr('disabled', false);

            $('#new_product_name').val(product_name);
            $('#net_wt').val(net_wt);
        });

        $(document).on('click', '#cancel', function() {
            $('#addFormNewLot')[0].reset();
            $('#lot_number').attr('readonly', true);
            $('#expiration_date').attr('readonly', true);
            $('#qty_in').attr('readonly', true);
            $('#cancel').attr('disabled', true);
            $('#add_stocks').attr('disabled', true);
        });

        $(document).on('click', '#add_stocks', function() {
            event.preventDefault();
            event.stopPropagation();

            var form = $('#addFormNewLot')[0];
            var formData = new FormData(form);

            formData.append('product_id', $('#product_id').val());
            formData.append('lot_number', $('#lot_number').val());
            formData.append('expiration_date', $('#expiration_date').val());
            formData.append('qty_in', $('#qty_in').val());
            formData.append('action', 'Add');
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
                            url: "<?= base_url('admin_portal/inventory/product_management/stock_management')?>",
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
                                    tbl_stock.draw();
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

        $(document).on('click', '#update_stocks', function(event) {
            event.preventDefault();
            event.stopPropagation();

            var form = $('#addStockForm')[0];
            var formData = new FormData(form);

            formData.append('stock_id', $('#edit_stock_id').val());
            formData.append('product_id', $('#edit_product_id').val());
            formData.append('qty_in', $('#qty_add').val());
            formData.append('stock', $('#remaining_stock').val());
            formData.append('action', 'Add');
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
                            url: "<?= base_url('admin_portal/inventory/product_management/update_stocks')?>",
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
                                    tbl_stock.draw();
                                    $('#addStockModal').modal('hide');
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

<?php $this->load->view('admin_portal/modal/product_modal');?>