<!-- Modal -->
<div class="modal fade" id="addressModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addressForm" class="needs-validation" novalidate>
                    <div class="container">
                        <fieldset class="border rounded-3 p-3 pt-2 mb-3">
                            <legend class="float-none w-auto px-2">Contact Information</legend>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" placeholder="Full Name" id="fullname" required>
                                <div class="invalid-feedback">
                                    Please provide a valid name.
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control number-input" placeholder="Phone Number"
                                    id="contact_no" required>
                                <div class="invalid-feedback">
                                    Please provide a valid contact number.
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="border rounded-3 p-3 pt-2 mb-3">
                            <legend class="float-none w-auto px-2">Address</legend>
                            <div class="form-group mb-3">
                                <select name="province" id="province" class="form-select" required>
                                    <option value="">Select Province</option>
                                    <?php foreach($province as $row) : ?>
                                    <option value="<?= $row->code?>"><?= ucwords($row->name); ?></option>
                                    <?php endforeach;?>
                                </select>
                                <div class="invalid-feedback">
                                    Please provide your province.
                                </div>
                                <input type="hidden" id="province_name">
                            </div>
                            <div class="form-group mb-3">
                                <select name="municipality" id="municipality" class="form-select" required>
                                    <option value="">Select Municipality</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please provide your municipality.
                                </div>
                                <input type="hidden" id="municipality_name">
                            </div>
                            <div class="form-group mb-3">
                                <select name="barangay" id="barangay" class="form-select" required>
                                    <option value="">Select Barangay</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please provide your barangay.
                                </div>
                                <input type="hidden" id="brgy_name">
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" placeholder="Postal Code" id="postal_code"
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid postal code.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" placeholder="Street Name, Building, House No."
                                    id="street_name" required>
                                <div class="invalid-feedback">
                                    Please provide a valid street name, building, house no.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" placeholder="Landmark" id="landmark" required>
                                <div class="invalid-feedback">
                                    Please provide a valid landmark.
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="border rounded-3 p-3 pt-2 mb-3">
                            <legend class="float-none w-auto px-2">Settings</legend>
                            <div class="form-group mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <label for="" class="form-label">Label As:</label>
                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                        <input type="radio" class="btn-check" name="labelAs" id="labelAs1">
                                        <label class="btn btn-outline-primary" for="labelAs1">Work</label>

                                        <input type="radio" class="btn-check" name="labelAs" id="labelAs2">
                                        <label class="btn btn-outline-primary" for="labelAs2">Home</label>
                                    </div>
                                </div>
                                <input type="text" id="label_as" class="form-control" required style="display:none;">
                                <div class="invalid-feedback">
                                    Please provide a valid label.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <label for="" class="form-label">Set as Default Address</label>
                                    <div>
                                        <label class="switch">
                                            <input type="checkbox" class="set_default">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_address">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="trackOrder"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header border-bottom p-5">
        <h5 id="offcanvasRightLabel" class="cart__title">Track Order</h5>
        <button type="button" class="btn-close cart__close-btn text-reset" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body cart__container">
        <div class="cart__items p-4 py-0 tracking_order">
            <!-- AJAX REQUEST -->
            
        </div>
    </div>
</div>


<script>
    $(document).on('click', '#labelAs1', function() {
        if ($(this).is(':checked')) {
            $('#label_as').val('Work');
        } else {
            $('#label_as').val('');
        }
    });

    $(document).on('click', '#labelAs2', function() {
        if ($(this).is(':checked')) {
            $('#label_as').val('Home');
        } else {
            $('#label_as').val('');
        }
    });

    $(document).on('change', '#province', function() {
        var elem = $(this);
        var code = elem.val();
        var text = elem.find('option:selected').text();
        $.post("<?= base_url('shop/products/get_municipal/')?>", {
            code: code,
            '_token': csrf_token_value
        }, function(data) {
            $('#municipality').html(data);
            $('#province_name').val(text);
        }, "JSON");
    });

    $(document).on('change', '#municipality', function() {
        var elem = $(this);
        var code = elem.val();
        var text = elem.find('option:selected').text();
        $.post("<?= base_url('shop/products/get_barangay/')?>", {
            code: code,
            '_token': csrf_token_value
        }, function(data) {
            $('#barangay').html(data);
            $('#municipality_name').val(text);
        }, "JSON");
    });

    $(document).on('change', '#barangay', function() {
        var elem = $(this);
        var code = elem.val();
        var text = elem.find('option:selected').text();
        $('#brgy_name').val(text);
    });
</script>