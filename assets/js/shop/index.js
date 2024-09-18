
// product item
const minusButtons = document.querySelectorAll('.product__item__quantity-selector__minus');
const plusButtons = document.querySelectorAll('.product__item__quantity-selector__plus');

minusButtons.forEach(button => {
	button.addEventListener("click", (event) => {
		const input = event.target.closest(".product__item__quantity-selector").querySelector('.product__item__quantity-selector__input');
		let quantity = parseInt(input.value);
		if (quantity > 1) {
			quantity -= 1;
			input.value = quantity;
		}
	})
})

plusButtons.forEach(button => {
	button.addEventListener("click", (event) => {
		const input = event.target.closest(".product__item__quantity-selector").querySelector('.product__item__quantity-selector__input');
		let quantity = parseInt(input.value);
		quantity += 1;
		input.value = quantity;

	})
})

// cart item
const cartMinusButton = document.querySelectorAll('.cart__item__quantity-selector__minus');
const cartPlusButton = document.querySelectorAll('.cart__item__quantity-selector__plus');

cartMinusButton.forEach(button => {
	button.addEventListener("click", (event) => {
		const input = event.target.closest(".cart__item__quantity-selector").querySelector('.cart__item__quantity-selector__input');
		let quantity = parseInt(input.value);
		if (quantity > 1) {
			quantity -= 1;
			input.value = quantity;
			calculateSubtotal();

		}
	})
})

cartPlusButton.forEach(button => {
	button.addEventListener("click", (event) => {
		const input = event.target.closest(".cart__item__quantity-selector").querySelector('.cart__item__quantity-selector__input');
		let quantity = parseInt(input.value);
		quantity += 1;
		input.value = quantity;
		calculateSubtotal();
	})
})

// Calculate Subtotal
function calculateSubtotal() {
	let subTotal = 0;
	const cartItems = document.querySelectorAll('.cart__item');
	cartItems.forEach(item => {
		const price = parseFloat(item.querySelector('.cart__product-price').getAttribute('data-price'));

		const quantity = parseInt(item.querySelector(".cart__item__quantity-selector__input").value);
		subTotal += price * quantity;

	})
	document.querySelector('.cart__subtotal-price').innerText = '₱' + subTotal.toFixed(2);
}



