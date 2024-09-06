<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-hdd-rack me-2"></i>Add New Products</h5>
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
                                <label for="product_name" class="form-label">Selling Price</label>
                                <input type="text" class="form-control number-input amount-input" id="product_name" autocomplete="off" required>
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
                        <input class="form-control mb-2" type="file" id="image_input" accept="image/png, image/jpg, image/jpeg">
                        <img id="image_preview" style="display: none; max-width: 60%;" alt="Image Preview"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_stocks">Save Changes</button>
            </div>
        </div>
    </div>
</div>


<!-- <input type="file" id="image_input" accept="image/*">
<img id="image_preview" src="#" style="max-width:100%;"/>
<button id="crop_button">Crop and Upload</button>
<input type="hidden" id="cropped_image_data" name="cropped_image_data"/> -->
<script>
    $(document).ready(function() {
        let cropper;
        const imagePreview = $('#image_preview');
        const cropButton = $('#crop_button');
        $('#image_input').on('change', function(e) {
            const file = e.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.attr('src', e.target.result).show(); // Set and show the image preview

                    // Destroy the existing cropper instance if there is one
                    if (cropper) {
                        cropper.destroy();
                    }

                    // Initialize the cropper on the preview image
                    cropper = new Cropper(imagePreview[0], {
                        aspectRatio: 1, // Adjust as needed (1 for square, 4/3, etc.)
                        viewMode: 1
                    });

                    // Show the crop button
                    cropButton.show();
                };
                reader.readAsDataURL(file); // Read the file as a data URL
            } else {
                imagePreview.hide();
            }
        });
    });
    
</script>