function cartCount() {
	$.ajax({
		url: baseURL + 'shop/products/cart_count',
		method: "GET",
		dataType: "json",
		success: function (data) {
			if (data.cart_count > 0) {
				$('.cart_count').fadeIn(200);
				$('.cart_count').text(data.cart_count);
				$('.cart_count_list').text('(' + data.cart_count + ')');
				$('.cart_check_all').addClass('d-flex');
				$('.cart_check_all').removeClass('d-none');
			} else {
				$('.cart_count').hide();
				$('.cart_count').text('');
				$('.cart_count_list').text('');
				$('.cart_check_all').addClass('d-none');
				$('.cart_check_all').removeClass('d-flex');
			}

		}
	});
}

function getCartItem() {
	$.ajax({
		url: baseURL + 'shop/products/get_cart_item_list',
		method: "GET",
		dataType: "json",
		success: function (data) {
			$('.cart_item_list').html(data.cart_item_list);
		}
	});
}

$(document).ready(function () {
	cartCount();

	$(document).on('click', '.open_cart', function () {
		getCartItem();
		$('#select-all-checkbox').prop('checked', false);

		var offcanvasElement = document.getElementById('offcanvasRight');
		var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
		offcanvas.show();
	});

	//Cart List
	function updateCartQty(action, cart_id) {
		$.ajax({
			url: baseURL + 'shop/products/update_cart_qty',
			method: "POST",
			data: {
				cart_id: cart_id,
				action: action,
				'_token': csrf_token_value,
			},
			dataType: "json",
			success: function (data) {
				if (data.error != '') {
					Toast.fire({
						icon: 'warning',
						title: data.error,
					});
				} else {
					Toast.fire({
						icon: 'success',
						title: data.success,
					});
				}
			},
			error: function () {
				Toast.fire({
					icon: 'error',
					title: 'An error occurred while processing the request.',
				});
			}
		});
	}

	$(document).on('click', '.cart__item__quantity-selector__plus', function () {
		var cart_id = $(this).data('cart_id');
		var $quantityInput = $(this).closest('.cart__item').find('.qty_cart');
		var currentQuantity = parseInt($quantityInput.val());
		var availableStock = $(this).data('stocks');
		var action = 'Plus';

		// Check if adding one more exceeds the available stock
		if (currentQuantity < availableStock) {
			currentQuantity++;
			// Update the input field with the new quantity
			$quantityInput.val(currentQuantity);
			updateCartQty(action, cart_id);
			calculateTotal();
		} else {
			Toast.fire({
				icon: 'warning',
				title: 'You cannot add more than ' + availableStock + ' items.',
			});
		}
	});

	$(document).on('click', '.cart__item__quantity-selector__minus', function () {
		var cart_id = $(this).data('cart_id');
		var $quantityInput = $(this).closest('.cart__item').find('.qty_cart');
		var currentQuantity = parseInt($quantityInput.val());
		var action = 'Minus';

		// Ensure the quantity is at least 1 before decreasing
		if (currentQuantity > 1) {
			currentQuantity--;

			// Update the input field with the new quantity
			$quantityInput.val(currentQuantity);
			updateCartQty(action, cart_id);
			calculateTotal();
		}
	});

	$(document).on('change', '.check_product', function () {
		calculateTotal();
	});

	$(document).on('change', '#select-all-checkbox', function () {
		var isChecked = $(this).prop('checked');

		// Iterate over each .check_product checkbox
		$('.check_product').each(function () {
			var stockStatus = $(this).data('stock'); // Get the stock status from the data attribute

			if (stockStatus !== 'No Stocks') {
				// Only check/uncheck products that are not "No Stocks"
				$(this).prop('checked', isChecked);
			}
		});

		// Update the count of checked checkboxes, excluding those with "No Stocks"
		var checkedCount = $('.check_product:checked').length;
		$('.checkout_count').text('(' + checkedCount + ')');

		calculateTotal();
	});


	$(document).on('click', '.check_product', function () {
		var checkedCheckboxes = $('.check_product:checked');
		var count = checkedCheckboxes.length;
		$('.checkout_count').text('(' + count + ')');
		//$('#check_count').val(count);

		if (count < $('.check_product').length) {
			$('#select-all-checkbox').prop('checked', false);
		}
	});

	function calculateTotal() {
		var total = 0;
		var hasValidValues = false;

		$('.check_product:checked').each(function () {
			var unitPrice = parseFloat($(this).data('price'));
			var quantity = parseInt($(this).closest('.cart__item').find('.qty_cart').val());

			// Check if quantity and unitPrice are valid numbers
			if (!isNaN(quantity) && !isNaN(unitPrice)) {
				total += unitPrice * quantity;
				hasValidValues = true; // Set the flag to true if valid values exist
			}
		});

		if (hasValidValues) {
			var formattedTotal = '₱ ' + total.toLocaleString(undefined, {
				minimumFractionDigits: 2,
				maximumFractionDigits: 2
			});
			$('.cart__subtotal-price').text(formattedTotal); // Display the total
			//$('#total_amount').val(total.toFixed(2));
		} else {
			// Display zero when there are no valid values
			$('.cart__subtotal-price').text('₱ 0.00');
			//$('#total_amount').val(0.00);
		}
	}

	$(document).on('click', '.cart__checkout', function () {
		var checkbox = $('.check_product:checked');
		var cart_ids = new Array();

		if (checkbox.length > 0) {
			$(checkbox).each(function () {
				var cart_id = $(this).closest('.cart__item').find('.check_product').data('cart_id');

				cart_ids.push(cart_id);
			});
			var cart_ids_param = cart_ids.join(',');

			var url = baseURL + 'shop/checkout?product=' + cart_ids_param;
			window.location.href = url;
		} else {
			Toast.fire({
				icon: 'warning',
				title: 'You have not selected any items for checkout.',
			});
		}
	});

	$(document).on('click', '.cart__product__item__delete-btn', function () {
		var cart_id = $(this).data('id');
		var stock_status = $(this).data('stock');

		if (stock_status != 'No Stocks') {
			$.ajax({
				url: baseURL + 'shop/products/delete_cart_item',
				method: "POST",
				data: {
					cart_id: cart_id,
					'_token': csrf_token_value,
				},
				dataType: "json",
				success: function (data) {
					if (data.error != '') {
						Toast.fire({
							icon: 'warning',
							title: data.error,
						});
					} else {
						Toast.fire({
							icon: 'success',
							title: data.success,
						});
						cartCount();
						getCartItem();
						calculateTotal();
						$('#select-all-checkbox').prop('checked', false);
					}
				},
				error: function () {
					Toast.fire({
						icon: 'error',
						title: 'An error occurred while processing the request.',
					});
				}
			});
		}
	});
	//End of Cart
});


// Profile Section
$(document).ready(function () {
	$(document).on('click', '#togglePassword', function () {
		const passwordFieldType = $("#signupPassword").attr("type") === "password" ? "text" : "password";
		$("#signupPassword").attr("type", passwordFieldType);
		$(this).toggleClass("fa-eye fa-eye-slash");
	})

	$(document).on('click', '.profile__sidebar-menu__item', function () {
		$(".profile__sidebar-menu__item").removeClass("active");
		$(this).addClass('active');

		$('.profile__content').hide();
		var targetSection = $(this).data('target');
		$(targetSection).show();
	})
})



// Profile Update
$(document).ready(function () {
	$(document).on('click', '.profile__update-button', function (event) {
		event.preventDefault();
		event.stopPropagation();

		var form = $('#profile__form')[0];

		form.classList.add('was-validated');
		if (form.checkValidity() === false) {
			event.preventDefault();
			event.stopPropagation();
		}
	})
})

// Payment Methods
function showPaymentMethod(paymentId) {
	$('#payment-method__debit-card__details').hide();
	$('#payment-method__gcash__details').hide();
	$('#payment-method__maya__details').hide();
	$('#' + paymentId).show();
}

$('#payment-method__debit-card').on('click', function () {
	showPaymentMethod('payment-method__debit-card__details');
});

$('#payment-method__gcash').on('click', function () {
	showPaymentMethod('payment-method__gcash__details');
});

$('#payment-method__maya').on('click', function () {
	showPaymentMethod('payment-method__maya__details');
});
