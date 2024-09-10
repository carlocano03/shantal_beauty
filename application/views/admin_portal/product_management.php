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

    #tbl_product th:nth-child(2),
    #tbl_product td:nth-child(2),
    #tbl_product th:nth-child(4),
    #tbl_product td:nth-child(4),
    #tbl_product th:nth-child(5),
    #tbl_product td:nth-child(5),
    #tbl_product th:nth-child(6),
    #tbl_product td:nth-child(6) {
        text-align: center;
    }
    #tbl_product th:nth-child(3),
    #tbl_product td:nth-child(3) {
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
                <button class="btn btn-dark btn-sm px-3 me-3" data-bs-toggle="modal" data-bs-target="#addModal"><i class="bi bi-plus-lg me-1"></i>ADD NEW PRODUCTS</button>
            </div>
            <div class="card-body mt-4">
                <table class="table" width="100%" id="tbl_product">
                    <thead>
                        <tr>
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
        let cropper;
        const editImagePreview = $('#edit_image_preview');
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
                "url": "<?= base_url('admin_portal/inventory/product_management/product_list')?>",
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
                        cropper.getCroppedCanvas().toBlob(function(blob) {
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

        $('#edit_image_input').on('change', function(e) {
            const file = e.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    editImagePreview.attr('src', e.target.result).show(); // Set and show the image preview

                    // Destroy the existing cropper instance if there is one
                    if (cropper) {
                        cropper.destroy();
                    }

                    // Initialize the cropper on the preview image
                    cropper = new Cropper(editImagePreview[0], {
                        aspectRatio: 1, // Adjust as needed (1 for square, 4/3, etc.)
                        viewMode: 1
                    });
                };
                reader.readAsDataURL(file); // Read the file as a data URL
            } else {
                editImagePreview.hide();
            }
        });

        $(document).on('click', '#update_product', function(event) {
            event.preventDefault();
            event.stopPropagation();

            var form = $('#updateForm')[0];
            var formData = new FormData(form);

            var options = $('#update_options').val();
            formData.append('product_id', $('#productID').val());
            formData.append('options', $('#update_options').val());
            formData.append('product_name', $('#edit_product_name').val());
            formData.append('product_desc', $('#edit_product_desc').val());
            formData.append('net_weight', $('#edit_net_weight').val());
            formData.append('selling_price', $('#edit_selling_price').val());
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
                        if (options == 'Info') {
                            sendAjaxRequest(formData);
                        } else {
                            cropper.getCroppedCanvas().toBlob(function(blob) {
                                formData.append('cropped_image', blob, 'cropped_image.png');
                                sendAjaxRequest(formData);
                            });
                        }
                    }
                });
            }
        });

        function sendAjaxRequest(formData) 
        {
            $.ajax({
                url: "<?= base_url('admin_portal/inventory/product_management/update_product')?>",
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
                        $('#updateModal').modal('hide');
                        tbl_product.draw();
                        $('#updateForm')[0].reset();
                        $('#updateForm')[0].classList.remove('was-validated');
                        $('.info').hide();
                        $('.image-update').hide();
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
</script>

<?php $this->load->view('admin_portal/modal/product_modal');?>