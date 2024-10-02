<!-- Order Item -->
<div class="my-order__section__order-item mb-4 p-4 border rounded">
    <div class="my-order__section__order-header mb-3 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="my-order__orderNo">Order #67890</h1>
            <small class="text-muted">Shipped on: 16th September 2024</small>
        </div>
        <span class="badge bg-info my-order__badge">To Receive</span>
    </div>
    <div class="my-order__section__order-products">
        <!-- Product -->
        <div class="my-order__section__product d-flex justify-content-between align-items-center">
            <div class="d-flex">
                <img src="<?php echo base_url('assets/images/shop/product-cart-1.webp'); ?>"
                    class="my-order__section__product-img me-4" alt="Product 1">
                <div class="d-flex flex-column justify-content-between">
                    <div>
                        <p class="my-order__product__name">Temptation Coffee</p>
                        <p class="my-order__product__quantity">Quantity: 1</p>
                    </div>
                    <p class="my-order__product__price">₱150</p>
                </div>
            </div>
            <button type="button" class="my-order__product__track-order">Track
                Order</button>
        </div>

        <div class="my-order__section__product d-flex justify-content-between align-items-center">
            <div class="d-flex">
                <img src="<?php echo base_url('assets/images/shop/product-cart-1.webp'); ?>"
                    class="my-order__section__product-img me-4" alt="Product 1">
                <div class="d-flex flex-column justify-content-between">
                    <div>
                        <p class="my-order__product__name">Temptation Coffee</p>
                        <p class="my-order__product__quantity">Quantity: 1</p>
                    </div>
                    <p class="my-order__product__price">₱150</p>
                </div>
            </div>
            <button type="button" class="my-order__product__track-order">Track
                Order</button>
        </div>
    </div>
</div>