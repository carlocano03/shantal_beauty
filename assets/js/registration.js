document.addEventListener('DOMContentLoaded', function () {
	var timeout;
	clearTimeout(timeout);

	const stepper = new Stepper(document.querySelector('.bs-stepper'), {
		linear: false,
		animation: true
	});

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
	var checkOTP = false;
	var verifyOTP = false;

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

	$('#mobile_no').on('input', function () {
		var phonePattern = /^(\+639|09)\d{9}$/;
		var mobileNoValue = $(this).val();
		var isValidMobileNo = phonePattern.test(mobileNoValue);
		var errorMessage = $(this).next('.error-message');
		var successMessage = $(this).next().next('.success-message');


		if (!isValidMobileNo) {
			$(this).addClass('input-error');
			errorMessage.text('Please input a valid phone number in the format +639XXXXXXXXX or 09XXXXXXXXX.');
			successMessage.text("");

		} else {
			$(this).removeClass('input-error');
			errorMessage.text('');
			successMessage.text("✔ Valid number");
		}
	});

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

		if (verifyOTP == false) {
			var errorMessage = $('#email_address').next('.error-message');
			errorMessage.text('Please verify your email address.');
			allValid = false;
		}

		var phonePattern = /^(\+639|09)\d{9}$/;
		var mobileNoValue = $("#mobile_no").val();
		var isValidMobileNo = phonePattern.test(mobileNoValue);

		if (!isValidMobileNo) {
			allValid = false;
		}

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
			universityRequired = false;
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
			universityAnswer = false;
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
			realProperties = false;
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
			enrolledUniversity = false;
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

	$(document).on('input', '#email_address', function () {
		clearTimeout(timeout);
		const email_address = $(this).val().trim();
		const isValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email_address);
		var errorMessage = $(this).next('.error-message');
		var student_email = $('#email_address').val();

		if (isValidEmail) {
			timeout = setTimeout(function () {
				$.ajax({
					url: baseURL + 'website/registration_form/check_existing_email',
					method: 'POST',
					data: {
						email_address: student_email,
						'_token': csrf_token_value,
					},
					dataType: 'json',
					success: function (data) {
						if (data.email_address > 0) {
							Swal.fire({
								icon: 'warning',
								title: 'Ooops...',
								text: 'Student email address already exists.',
							});
							errorMessage.text('Student email address already exists.');
							checkOTP = false;
						} else {
							errorMessage.text('Please send OTP to verify your email.');
							checkOTP = true;
						}
					}
				});
			}, 500);
		} else {
			errorMessage.text('Invalid email address.');
			checkOTP = false;
		}
	});

	$(document).on('click', '#consent', function () {
		if ($(this).is(":checked")) {
			$('#submit-form').attr('disabled', false);
		} else {
			$('#submit-form').attr('disabled', true);
		}
	});

	$(document).on('click', '#verify-email', function () {
		var errorMessage = $('#email_address').next('.error-message');
		var email_address = $('#email_address').val();
		var firstname = $('#first_name').val();
		if (checkOTP == true) {
			errorMessage.text('');
			$.ajax({
				url: baseURL + `website/registration_form/send_email_otp`,
				method: "POST",
				data: {
					email_address: email_address,
					firstname: firstname,
					'_token': csrf_token_value,
				},
				dataType: "json",
				beforeSend: function () {
					$('.loading-screen').show();
				},
				success: function (data) {
					if (data.message == 'Success') {
						$('#verifyModal').modal('show');
					} else {
						Swal.fire({
							icon: 'warning',
							title: 'Ooops...',
							text: 'Failed to send OTP.',
						});
					}
				},
				complete: function () {
					$('.loading-screen').hide();
				},
				error: function () {
					$('.loading-screen').hide();
					console.error("AJAX request failed:", textStatus, errorThrown);
					Swal.fire({
						icon: 'error',
						title: 'Ooops...',
						text: 'An error occurred while processing the request.',
					});
				}
			});
		} else {
			Swal.fire({
				icon: 'warning',
				title: 'Ooops...',
				text: 'Invalid/empty email address.',
			});
		}
	});

	$(document).on('click', '.send_otp', function () {
		var errorMessage = $('#email_address').next('.error-message');
		var email_address = $('#email_address').val();
		var firstname = $('#first_name').val();
		if (checkOTP == true) {
			errorMessage.text('');
			$.ajax({
				url: baseURL + `website/registration_form/send_email_otp`,
				method: "POST",
				data: {
					email_address: email_address,
					firstname: firstname,
					'_token': csrf_token_value,
				},
				dataType: "json",
				beforeSend: function () {
					$('.loading-screen').show();
				},
				success: function (data) {
					if (data.message == 'Success') {
						$('#verifyModal').modal('show');
					} else {
						Swal.fire({
							icon: 'warning',
							title: 'Ooops...',
							text: 'Failed to send OTP.',
						});
					}
				},
				complete: function () {
					$('.loading-screen').hide();
				},
				error: function () {
					$('.loading-screen').hide();
					console.error("AJAX request failed:", textStatus, errorThrown);
					Swal.fire({
						icon: 'error',
						title: 'Ooops...',
						text: 'An error occurred while processing the request.',
					});
				}
			});
		} else {
			Swal.fire({
				icon: 'warning',
				title: 'Ooops...',
				text: 'Invalid/empty email address.',
			});
		}
	});

	$(document).on('click', '#verify_otp', function () {
		var otp_no = $('#otp_no').val();
		var email_address = $('#email_address').val();
		var errorMessage = $('#email_address').next('.error-message');
		var successMessage = $('#email_address').next().next('.success-message');


		if (otp_no != '') {
			$.ajax({
				url: baseURL + `website/registration_form/verify_email_otp`,
				method: "POST",
				data: {
					otp_no: otp_no,
					email_address: email_address,
					'_token': csrf_token_value,
				},
				dataType: "json",
				success: function (data) {
					if (data.message == 'Success') {
						Swal.fire({
							icon: 'success',
							title: 'Thank You!',
							text: 'Email address successfully verified.',
						});
						$('#verifyModal').modal('hide');
						successMessage.text('✔ Email address successfully verified.');
						verifyOTP = true;
						$('#otp_no').val('');
					} else if (data.message == 'No Data') {
						Swal.fire({
							icon: 'warning',
							title: 'Ooops...',
							text: 'Invalid OTP number.',
						});
						verifyOTP = false;
						$('#otp_no').val('');
						errorMessage.text('');
					} else if (data.message == 'Expired') {
						Swal.fire({
							icon: 'warning',
							title: 'Ooops...',
							text: 'OTP number already expired.',
						});
						$('#verifyModal').modal('hide');
						$('#otp_no').val('');
						errorMessage.text('OTP number already expired. Please resend OTP.');
						verifyOTP = false;
					} else {
						Swal.fire({
							icon: 'warning',
							title: 'Ooops...',
							text: 'Failed to verify the email address.',
						});
						verifyOTP = false;
					}
				},
				error: function () {
					console.error("AJAX request failed:", textStatus, errorThrown);
					Swal.fire({
						icon: 'error',
						title: 'Ooops...',
						text: 'An error occurred while processing the request.',
					});
				}
			});
		} else {
			Swal.fire({
				icon: 'warning',
				title: 'Ooops...',
				text: 'Please provide a valid OTP.',
			});
		}
	});

	$(document).on('click', '#submit-form', function (event) {
		event.preventDefault();
		event.stopPropagation();

		var form = $('#registration_form')[0];
		var formData = new FormData(form);
		formData.append('school_name', $('#scholarship-grant-information-input').val());
		formData.append('student_first_name', $('#first_name').val());
		formData.append('student_middle_name', $('#middle_name').val());
		formData.append('student_last_name', $('#last_name').val());
		formData.append('student_no', $('#student_no').val());
		formData.append('course', $('#course').val());
		formData.append('year_level', $('#year_level').val());
		formData.append('birth_place', $('#place_of_birth').val());
		formData.append('birthday', $('#date_of_birth').val());
		formData.append('citizenship', $('#citizenship').val());
		formData.append('civil_status', $('#civil_status').val());
		formData.append('permanent_address', $('#permanent_address').val());
		formData.append('pemanent_zipcode', $('#perm_zip_code').val());
		formData.append('permanent_tel_no', $('#perm_tel_no').val());
		formData.append('city_address', $('#city_address').val());
		formData.append('city_zipcode', $('#city_zip_code').val());
		formData.append('city_tel_no', $('#city_tel_no').val());
		formData.append('school_address', $('#address_campus').val());
		formData.append('mobile_no', $('#mobile_no').val());
		formData.append('email_address', $('#email_address').val());
		formData.append('father_fullname', $('#father').val());
		formData.append('father_occupation', $('#father_occupation').val());
		formData.append('father_salary', $('#father_salary').val());
		formData.append('mother_fullname', $('#mother').val());
		formData.append('mother_occupation', $('#mother_occupation').val());
		formData.append('mother_salary', $('#mother_salary').val());
		formData.append('parents_unemployed', $('#state_reason').val());
		formData.append('unemployed_income', $('#state_reason_amount').val());
		formData.append('other_sources', $('#contribution_from_other_sources').val());
		formData.append('self_employed', $('#self_employed').val());
		formData.append('earning_per_year', $('#earning_per_year').val());
		formData.append('guardian_name', $('#guardian').val());
		formData.append('guardian_occupation', $('#guardian_occupation').val());
		formData.append('guardian_salary', $('#guardian_salary').val());
		formData.append('relation', $('#guardian_relation').val());
		formData.append('any_previleges_university', $('input[name="scholarshipQuestion"]:checked').val());
		formData.append('outside_university', $('input[name="outsideUniversity"]:checked').val());
		formData.append('name_scholarship_amount', $('#amount-of-scholarship').val());
		formData.append('own_properties', $('input[name="scholarshipQuestion2"]:checked').val());
		formData.append('property_name', $('#propertiesName').val());
		formData.append('market_value', $('#propertiesNameMarketValue').val());
		formData.append('property_others', $('#OtherMarketValue').val());
		formData.append('parents_separated', $('#parents_separated').val());
		formData.append('married_separated', $('#support-status').val());
		formData.append('giving_amount', $('#support-amount').val());
		formData.append('personal_photo', $('#photo2x2')[0].files[0]);
		formData.append('already_enrolled', $('input[name="enrolledUniversity"]:checked').val());
		formData.append('form_five', $('#form-5')[0].files[0]);
		formData.append('copy_of_grade', $('#copy-of-grade')[0].files[0]);
		formData.append('certification_year_level', $('#certification-of-year-level')[0].files[0]);
		formData.append('transcript_of_record', $('#transcript-of-academic-records')[0].files[0]);
		formData.append('good_moral', $('#certification-of-good-moral')[0].files[0]);
		formData.append('birth_certificate', $('#birth-certificate')[0].files[0]);
		formData.append('letter_recommendation', $('#letter-of-recommedation-from-plmr')[0].files[0]);
		formData.append('_token', csrf_token_value);

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
					url: baseURL + `website/registration_form/scholarship_registration`,
					method: "POST",
					data: formData,
					contentType: false,
					processData: false,
					dataType: "json",
					beforeSend: function () {
						$('.loading-screen').show();
					},
					success: function (data) {
						if (data.error != '') {
							Swal.fire({
								icon: 'warning',
								title: 'Ooops...',
								text: data.error,
							});
						} else {
							Swal.fire({
								icon: 'success',
								title: 'Thank You!',
								text: data.success,
							});
							setTimeout(() => {
								window.location.href = baseURL + `scholarship/registration-form/success-registration`;
							}, 2000);
						}
					},
					complete: function () {
						$('.loading-screen').hide();
					},
					error: function () {
						$('.loading-screen').hide();
						console.error("AJAX request failed:", textStatus, errorThrown);
						Swal.fire({
							icon: 'error',
							title: 'Ooops...',
							text: 'An error occurred while processing the request.',
						});
					}
				});
			}
		});
	});


});
