document.addEventListener('DOMContentLoaded', function () {
	const stepper = new Stepper(document.querySelector('.bs-stepper'), {
		linear: false,
		animation: true
	});

	console.log("inasal");

	// Stepper Button


	const firstFormNext = document.getElementById('first-form')
	const secondFormNext = document.getElementById('second-form')
	const thirdFormNext = document.getElementById('third-form')
	const fourthFormNext = document.getElementById('fourth-form')
	const fifthFormNext = document.getElementById('fifth-form')

	const secondFormBack = document.getElementById('second-form-back')
	const thirdFormBack = document.getElementById('third-form-back')
	const fourthFormBack = document.getElementById('fourth-form-back')
	const fifthFormBack = document.getElementById('fifth-form-back')
	const sixthFormBack = document.getElementById('sixth-form-back')


	var universityRequired = false;
	var universityAnswer = false;
	var realProperties = false;
	var enrolledUniversity = false;
	// Next 

	//Scholarhip/Study Grant Information
	firstFormNext.addEventListener('click', () => {
		var input = $('#scholarship-grant-information-input');
		if (input.val().trim() === '') {
			input.addClass('input-error');
		} else {
			input.removeClass('input-error');
			stepper.next();
			$('.step-2').removeClass('disabled');
		}
		//stepper.next();
	})

	$(document).on('input', '.input-first-step', function () {
		var input = $(this);
		if (input.val().trim() === '') {
			input.addClass('input-error');
		} else {
			input.removeClass('input-error');
		}
	});
	//End of Scholarhip/Study Grant Information

	//Personal Information
	secondFormNext.addEventListener('click', () => {
		var allValid = true;
		$('.input-second-step').each(function () {
			var input = $(this);
			if (input.val().trim() === '') {
				input.addClass('input-error');
				allValid = false;
			} else {
				input.removeClass('input-error');
			}
		});
		if (allValid) {
			stepper.next();
			$('.step-3').removeClass('disabled');
		}
		//stepper.next();
	})
	$(document).on('input', '.input-second-step', function () {
		var input = $(this);
		if (input.val().trim() === '') {
			input.addClass('input-error');
		} else {
			input.removeClass('input-error');
		}
	});
	//End of Personal Information

	//Family Information
	thirdFormNext.addEventListener('click', () => {
		var allValid = true;
		$('.input-third-step').each(function () {
			var input = $(this);
			if (input.val().trim() === '') {
				input.addClass('input-error');
				allValid = false;
			} else {
				input.removeClass('input-error');
			}
		});
		if (allValid) {
			stepper.next();
			$('.step-4').removeClass('disabled');
		}
		//stepper.next();
	})
	$(document).on('input', '.input-third-step', function () {
		var input = $(this);
		if (input.val().trim() === '') {
			input.addClass('input-error');
		} else {
			input.removeClass('input-error');
		}
	});
	//End of Family Information

	//Other Information
	fourthFormNext.addEventListener('click', () => {
		var allValid = true;

		if (!$('input[name="scholarshipQuestion"]:checked').val()) {
			$('#scholarshipQuestionError').fadeIn(200);
			allValid = false;
		} else {
			$('#scholarshipQuestionError').hide();
		}

		// Validate the second radio button group
		if (!$('input[name="scholarshipQuestion2"]:checked').val()) {
			$('#scholarshipQuestion2Error').fadeIn(200);
			allValid = false;
		} else {
			$('#scholarshipQuestion2Error').hide();
		}

		if (universityRequired == true) {
			if (!$('input[name="outsideUniversity"]:checked').val()) {
				$('#outsideUniversityError').fadeIn(200);
				allValid = false;
			} else {
				$('#outsideUniversityError').hide();
			}
		}

		if (universityAnswer == true) {
			var input = $('.amount-of-scholarship');
			if (input.val().trim() === '') {
				input.addClass('input-error');
				allValid = false;
			} else {
				input.removeClass('input-error');
			}
		}

		if (realProperties == true) {
			$('.properties').each(function () {
				var input = $(this);
				if (input.val().trim() === '') {
					input.addClass('input-error');
					allValid = false;
				} else {
					input.removeClass('input-error');
				}
			});
		}

		if (allValid) {
			stepper.next();
			$('.step-5').removeClass('disabled');
		}
		//stepper.next();
	})
	$(document).on('click', 'input[name="scholarshipQuestion"]', function () {
		var answer = $('input[name="scholarshipQuestion"]:checked').val();
		$('#scholarshipQuestionError').hide();
		if (answer == 'Yes') {
			$('.hide-university').fadeIn(200);
			universityRequired = true;
		} else {
			$('.hide-university').fadeOut(200);
		}
	});

	$(document).on('click', 'input[name="outsideUniversity"]', function () {
		var answer = $('input[name="outsideUniversity"]:checked').val();
		$('#outsideUniversityError').hide();

		if (answer == 'Yes') {
			$('.hide-university-answer').fadeIn(200);
			universityAnswer = true;
		} else {
			$('.hide-university-answer').fadeOut(200);
		}
	});

	$(document).on('input', '.amount-of-scholarship', function () {
		var input = $(this);
		if (input.val().trim() === '') {
			input.addClass('input-error');
		} else {
			input.removeClass('input-error');
		}
	});

	$(document).on('click', 'input[name="scholarshipQuestion2"]', function () {
		var answer = $('input[name="scholarshipQuestion2"]:checked').val();
		$('#scholarshipQuestion2Error').hide();
		if (answer == 'Yes') {
			$('.real-property').fadeIn(200);
			realProperties = true;
		} else {
			$('.real-property').fadeOut(200);
		}
	});

	$(document).on('input', '.properties', function () {
		var input = $(this);
		if (input.val().trim() === '') {
			input.addClass('input-error');
		} else {
			input.removeClass('input-error');
		}
	});
	//End of Other Information

	//Required Attachments
	fifthFormNext.addEventListener('click', () => {
		var allValid = true;
		$('.input-fifth-step').each(function () {
			var input = $(this);
			if (input.val().trim() === '') {
				input.addClass('input-error');
				allValid = false;
			} else {
				input.removeClass('input-error');
			}
		});

		if (!$('input[name="enrolledUniversity"]:checked').val()) {
			$('#enrolledUniversityError').fadeIn(200);
			allValid = false;
		} else {
			$('#enrolledUniversityError').hide();
		}

		if (enrolledUniversity == true) {
			$('.enrolled-input').each(function () {
				var input = $(this);
				if (input.val().trim() === '') {
					input.addClass('input-error');
					allValid = false;
				} else {
					input.removeClass('input-error');
				}
			});
		}

		if (allValid) {
			stepper.next();
			$('.step-6').removeClass('disabled');
		}
		//stepper.next();
	})

	$(document).on('click', 'input[name="enrolledUniversity"]', function () {
		var answer = $('input[name="enrolledUniversity"]:checked').val();
		$('#enrolledUniversityError').hide();
		if (answer == 'Yes') {
			$('.enroll_university').fadeIn(200);
			enrolledUniversity = true;
		} else {
			$('.enroll_university').fadeOut(200);
		}
	});

	$(document).on('input', '.input-fifth-step', function () {
		var input = $(this);
		if (input.val().trim() === '') {
			input.addClass('input-error');
		} else {
			input.removeClass('input-error');
		}
	});

	$(document).on('input', '.enrolled-input', function () {
		var input = $(this);
		if (input.val().trim() === '') {
			input.addClass('input-error');
		} else {
			input.removeClass('input-error');
		}
	});
	//End of Required Attachments


	// Back
	secondFormBack.addEventListener('click', () => {
		stepper.to(1);
	})
	thirdFormBack.addEventListener('click', () => {
		stepper.to(2);
	})
	fourthFormBack.addEventListener('click', () => {
		stepper.to(3);
	})
	fifthFormBack.addEventListener('click', () => {
		stepper.to(4);
	})
	sixthFormBack.addEventListener('click', () => {
		stepper.to(5);
	})

	$(document).on('keypress', '.number-input', function (e) {
		// Allow only numeric and dot (.) characters
		var charCode = e.which || e.keyCode;
		if (charCode !== 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
			e.preventDefault();
		}
	});

	$(document).on('input', '.amount-input', function () {
		var inputValue = $(this).val();
		// $('#amt').val($(this).val().replace(/,/g, ""));

		// Remove non-numeric characters
		inputValue = inputValue.replace(/[^0-9.]/g, '');

		// Format the number with commas and limit decimal part to 2 digits
		inputValue = inputValue.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		var decimalAdded = inputValue.split(".");

		if (decimalAdded.length > 1) {
			var integerPart = decimalAdded[0];
			var decimalPart = decimalAdded[1].slice(0, 2); // Limit decimal part to 2 digits
			inputValue = integerPart + "." + decimalPart;
		}
		// var numericValue = parseFloat(inputValue.replace(/,/g, ''));
		// if (!isNaN(numericValue) && numericValue > 5000000) {
		//     inputValue = "5,000,000.00";
		// }
		$(this).val(inputValue);
	});

	$(document).on('input', '#scholarship-grant-information-input', function () {
		var school = $(this).val();

		$('#school_name').text(school);
	});


});
