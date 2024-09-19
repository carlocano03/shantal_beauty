<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-box-seam-fill me-2"></i>Add New Products</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm" class="needs-validation" novalidate>
                    <div class="form-group mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="product_name" autocomplete="off" required>
                        <div class="invalid-feedback">
                            Please provide a valid product name.
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a description here" id="product_desc" style="height: 100px" required></textarea>
                        <label for="product_desc">Product Description</label>
                        <div class="invalid-feedback">
                            Please provide a valid product description.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="net_weight" class="form-label">Net Weight</label>
                                <input type="text" class="form-control" id="net_weight" autocomplete="off" required>
                                <div class="invalid-feedback">
                                    Please provide a valid net weight.
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="selling_price" class="form-label">Selling Price</label>
                                <input type="text" class="form-control number-input amount-input" id="selling_price" autocomplete="off" required>
                                <div class="invalid-feedback">
                                    Please provide a valid product name.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-primary text-uppercase">
                        <i class="bi bi-upload me-2"></i>Upload the image of product
                    </div>
                    <div class="mb-3">
                        <input class="form-control mb-2" type="file" id="image_input" accept="image/png, image/jpg, image/jpeg" required>
                        <img id="image_preview" style="display: none; max-width: 60%;" alt="Image Preview"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_product">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-box-seam-fill me-2"></i>Update Products</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm" class="needs-validation" novalidate>
                    <input type="hidden" id="productID">
                    <div class="form-group">
                        <label for="update_options" class="form-label">Update Options</label>
                        <select name="update_options" id="update_options" class="form-select" required>
                            <option value="">Please choose on the following options</option>
                            <option value="Info">Update Product Information</option>
                            <option value="Image">Update Product Image</option>
                        </select>
                        <div class="invalid-feedback">
                            Please choose a valid options.
                        </div>
                    </div>
                    <hr>
                    <div class="info" style="display:none;">
                        <div class="form-group mb-3">
                            <label for="edit_product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="edit_product_name" autocomplete="off">
                            <div class="invalid-feedback">
                                Please provide a valid product name.
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Leave a description here" id="edit_product_desc" style="height: 100px"></textarea>
                            <label for="edit_product_desc">Product Description</label>
                            <div class="invalid-feedback">
                                Please provide a valid product description.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="edit_net_weight" class="form-label">Net Weight</label>
                                    <input type="text" class="form-control" id="edit_net_weight" autocomplete="off">
                                    <div class="invalid-feedback">
                                        Please provide a valid net weight.
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="edit_selling_price" class="form-label">Selling Price</label>
                                    <input type="text" class="form-control number-input amount-input" id="edit_selling_price" autocomplete="off">
                                    <div class="invalid-feedback">
                                        Please provide a valid product name.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="image-update" style="display:none;">
                        <div class="alert alert-primary text-uppercase">
                            <i class="bi bi-upload me-2"></i>Upload the image of product
                        </div>
                        <div class="mb-3">
                            <input class="form-control mb-2" type="file" id="edit_image_input" accept="image/png, image/jpg, image/jpeg">
                            <img id="edit_image_preview" style="display: none; max-width: 60%;" alt="Image Preview"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update_product">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addStockModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-box-seam-fill me-2"></i>Add Stocks</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addStockForm" class="needs-validation" novalidate>
                    <input type="hidden" id="edit_stock_id">
                    <input type="hidden" id="edit_product_id">
                    <div class="form-group mb-3">
                        <label for="stock_product_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" readonly id="stock_product_name" autocomplete="off" value="<?= isset($product['product_name']) ? $product['product_name'] : '';?>">
                        <div class="invalid-feedback">
                            Please provide a valid product name.
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="lot_no" class="form-label">Lot Number</label>
                        <input type="text" class="form-control" readonly id="lot_no">
                    </div>
                    <div class="form-group mb-3">
                        <label for="remaining_stock" class="form-label">Remaining Stock</label>
                        <input type="text" class="form-control" readonly id="remaining_stock">
                    </div>
                    <div class="form-group mb-3">
                        <label for="qty_add" class="form-label">Quantity</label>
                        <input type="text" class="form-control number-input" id="qty_add" required>
                        <div class="invalid-feedback">
                            Please provide a valid quantity.
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update_stocks">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="imageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-box-seam-fill me-2"></i>Add New Products</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="imageForm" class="needs-validation" novalidate>
                    <input type="hidden"  id="add_product_id">
                    <div class="form-group mb-3">
                        <label for="upload_file" class="form-label">Upload File</label>
                        <select name="upload_file" id="upload_file" class="form-select" required>
                            <option value="">Please choose on the following options</option>
                            <option value="Image">Upload Image Only</option>
                            <option value="Video">Upload Video Only</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid options.
                        </div>
                    </div>
                    <hr>
                    <div class="upload_image" style="display:none;">
                        <div class="alert alert-primary text-uppercase">
                            <i class="bi bi-upload me-2"></i>Upload the image of product
                        </div>
                        <div class="mb-3">
                            <input class="form-control mb-2" type="file" id="image_input_add" accept="image/png, image/jpg, image/jpeg">
                            <img id="image_preview_add" style="display: none; max-width: 60%;" alt="Image Preview"/>
                        </div>
                    </div>

                    <div class="upload_video" style="display:none;">
                        <div class="alert alert-info text-uppercase">
                            <i class="bi bi-upload me-2"></i>Upload the video of product
                        </div>
                        <div class="mb-3">
                            <input class="form-control mb-2" type="file" id="video_input_add" accept="video/*">
                            <video id="video_preview" width="100%" height="300" controls style="display:none;">
                                <source id="video_source" src="" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_product_image">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let cropperNew;
        const imagePreview = $('#image_preview');
        
        $('#image_input').on('change', function(e) {
            const file = e.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.attr('src', e.target.result).show(); // Set and show the image preview

                    // Destroy the existing cropper instance if there is one
                    if (cropperNew) {
                        cropperNew.destroy();
                    }

                    // Initialize the cropper on the preview image
                    cropperNew = new Cropper(imagePreview[0], {
                        aspectRatio: 1, // Adjust as needed (1 for square, 4/3, etc.)
                        viewMode: 1
                    });
                };
                reader.readAsDataURL(file); // Read the file as a data URL
            } else {
                imagePreview.hide();
            }
        });

        $(document).on('click', '#save_product', function(event) {
            event.preventDefault();
            event.stopPropagation();

            var form = $('#addForm')[0];
            var formData = new FormData(form);
            
            formData.append('product_name', $('#product_name').val());
            formData.append('product_desc', $('#product_desc').val());
            formData.append('net_weight', $('#net_weight').val());
            formData.append('selling_price', $('#selling_price').val());
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
                        cropperNew.getCroppedCanvas().toBlob(function(blob) {
                            formData.append('cropped_image', blob, 'cropped_image.png');

                            $.ajax({
                                url: "<?= base_url('admin_portal/inventory/product_management/save_new_product')?>",
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
                                        $('#addModal').modal('hide');
                                        setTimeout(() => {
                                            window.location.href = data.redirectLink;
                                        }, 2000);
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
                        });
                    }
                });
            }
        });

        $(document).on('click', '.update_modal', function() {
            var product_id = $(this).data('product_id');
            var product = $(this).data('product');
            var desc = $(this).data('desc');
            var net_wt = $(this).data('net_wt');
            var price = $(this).data('price');

            $('#productID').val(product_id);
            $('#edit_product_name').val(product);
            $('#edit_product_desc').val(desc);
            $('#edit_net_weight').val(net_wt);
            $('#edit_selling_price').val(price);
            $('#updateModal').modal('show');
        });

        $(document).on('change', '#update_options', function() {
            var options = $(this).val();

            if (options == 'Info') {
                $('.info').fadeIn(200);
                $('#edit_product_name').attr('required', true);
                $('#edit_product_desc').attr('required', true);
                $('#edit_net_weight').attr('required', true);
                $('#edit_selling_price').attr('required', true);

                $('.image-update').hide();
                $('#edit_image_input').attr('required', false);
            } else {
                $('.image-update').fadeIn(200);
                $('#edit_image_input').attr('required', true);
                
                $('.info').hide();
                $('#edit_product_name').attr('required', false);
                $('#edit_product_desc').attr('required', false);
                $('#edit_net_weight').attr('required', false);
                $('#edit_selling_price').attr('required', false);
            }
        });

        $(document).on('click', '.action_btn', function() {
            var stock_id = $(this).data('stock_id');
            var product_id = $(this).data('product_id');
            var stock = $(this).data('stock');
            var lot_no = $(this).data('lot');
            var action = $(this).data('action');

            if (action == 'Add') {
                $('#edit_stock_id').val(stock_id);
                $('#edit_product_id').val(product_id);
                $('#remaining_stock').val(stock);
                $('#lot_no').val(lot_no);
                $('#addStockModal').modal('show');
            } else {
                Swal.fire({
                    title: 'Are you sure..',
                    text: "You want to delete this stock?",
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
                            data: {
                                stock_id: stock_id,
                                product_id: product_id,
                                stock: stock,
                                action: action,
                                '_token': csrf_token_value,
                            },
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
                                    setTimeout(() => {
                                        location.reload()
                                    }, 1000);
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

        $(document).on('change', '#upload_file', function() {
            var options = $(this).val();

            if (options == 'Image') {
                $('.upload_image').fadeIn(200);
                $('#image_input_add').attr('required', true);

                $('.upload_video').hide();
                $('#video_input_add').attr('required', false);
            } else {
                $('.upload_video').fadeIn();
                $('#video_input_add').attr('required', true);

                $('.upload_image').hide();
                $('#image_input_add').attr('required', false);
            }
        });
    });
    
</script>