'use strict';

function isInputNotEmpty(inputField) {
	return inputField.value.trim() !== '';
}

// Validation

// Sequence Number Form 1
const checkButton = document.querySelector('.checkButton');
const checkbox = document.querySelector('.form-check-input');
const sequence = document.getElementById('sequence');

checkButton.addEventListener('click', function () {
	checkbox.checked = true;
	sequence.removeAttribute('disabled');
	//validateCheckbox();
});

checkbox.addEventListener('change', function () {
	const btnNext1 = document.querySelector('.btn-sequence-number');
	if (checkbox.checked) {
		sequence.removeAttribute('disabled');
		btnNext1.disabled = true;
	} else {
		sequence.setAttribute('disabled', 'disabled');
		sequence.value = '';
	}
});

function validateCheckbox() {
	const btnNext1 = document.querySelector('.btn-sequence-number');
	btnNext1.disabled = !checkbox.checked;
}

// SCHOOL INFORMATION FORM 2
function validateInputs() {
	const schoolInfoName = document.querySelector('.school-name-2');
	const schoolInfoAcronymn = document.querySelector('.school-acronymn-2');
	const schoolInfoID = document.querySelector('.school-id-2');
	const schoolInfoAddress = document.querySelector('.school-address-2');
	// const schoolInfoRFIDSystem = document.querySelector(".school-rfidSystem-2");
	// const schoolInfoQuantity = document.querySelector(".school-quantity-2");


	const errorMessage = document.querySelector('.error-message');
	const emailMessage = document.querySelector('.email-message');
	// const requiredFields = document.querySelector('.qty_rfid');


	const schoolInfoMobileNumber = document
		.querySelector('.mobile-number-2')
		.value.trim();
	const schoolInfoEmail = document.querySelector('.email-2').value.trim();

	const btnNext2 = document.querySelector('.btn-school-information');

	const isValidNumber = /^09[0-9]{9}$/.test(schoolInfoMobileNumber);
	const isValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(schoolInfoEmail);
  	// let isValidQTY = true;

	// School Info RFID System
	// School Info Quantity
	// const selectSchoolInfoRFIDSystemIsValid =
	// 	schoolInfoRFIDSystem.options[schoolInfoRFIDSystem.selectedIndex].index !== 0;

	// if (schoolInfoRFIDSystem.options[schoolInfoRFIDSystem.selectedIndex].index === 1) {
    // requiredFields.textContent = "*";
	// 	schoolInfoQuantity.disabled = false;
    // isValidQTY = false;
	// } else {
    // requiredFields.textContent = "";
	// 	schoolInfoQuantity.disabled = true;
    // isValidQTY = true;
	// }


	if (
		// selectSchoolInfoRFIDSystemIsValid && (schoolInfoQuantity.value !== "0" || schoolInfoQuantity.disabled) &&
		isInputNotEmpty(schoolInfoName) &&
		isInputNotEmpty(schoolInfoAcronymn) &&
		isInputNotEmpty(schoolInfoID) &&
		isInputNotEmpty(schoolInfoAddress)
	) {
		let isNumberValid = isValidNumber;
		let isEmailValid = isValidEmail;

		if (isValidNumber) {
			btnNext2.disabled = false;
			errorMessage.textContent = '';
		} else {
			btnNext2.disabled = true;
			errorMessage.textContent = 'Invalid mobile number. (09xx)';
		}

		if (isValidEmail) {
			btnNext2.disabled = false;
			emailMessage.textContent = '';
		} else {
			btnNext2.disabled = true;
			emailMessage.textContent = 'Invalid email address.';
		}

		if (isNumberValid && isEmailValid) {
			btnNext2.disabled = false;
		} else {
			btnNext2.disabled = true;
		}

		// if(isValidQTY == false) {
		// if(isInputNotEmpty(schoolInfoQuantity)) {
		// 	btnNext2.disabled = false;
		// 	} else {
		// 		btnNext2.disabled = true;
		// 	}
		// } else {
		// 	if (schoolInfoRFIDSystem.options[schoolInfoRFIDSystem.selectedIndex].index !== 1) {
		// 		btnNext2.disabled = false;
		// 	} else {
		// 		btnNext2.disabled = true;
		// 	}
		// }
		// btnNext2.disabled = false;
	} else {
		btnNext2.disabled = true;
	}
}

// Owner Details Form3
function validateInputsOwnerDetails() {
	const btnNext3 = document.querySelector('.btn-owner-details');

	const ownerOtherPosition = document.querySelector('.ownerOtherPosition');
	const ownersFName = document.querySelector('.ownersFName');
	const ownersLName = document.querySelector('.ownersLName');
	const ownersMobileNumber = document
		.querySelector('.ownersMobileNumber')
		.value.trim();
	const ownersEmail = document.querySelector('.ownersEmail').value.trim();
	const ownersPosition = document.querySelector('.ownersPosition');
	const ownersYearOfEstablishment = document
		.querySelector('.ownersYearOfEstablishment')
		.value.trim();
	const ownersTypeOfSchool = document.querySelector('.ownersTypeOfSchool');
	const ownersTotalStudents = document.querySelector('.ownersTotalStudents');
	const ownersTotalTeachers = document.querySelector('.ownersTotalTeachers');
	const ownersTotalNonTeachingStaff = document.querySelector(
		'.ownersTotalNonTeachingStaff'
	);

	const errorMessage = document.querySelector('.owners-mobile');
	const emailMessage = document.querySelector('.owners-email');

	const isValidYear = /^\d{4}$/.test(ownersYearOfEstablishment);
	// const isValidNumber = /^\d{11}$/.test(ownersMobileNumber);
	const isValidNumber = /^09[0-9]{9}$/.test(ownersMobileNumber);
	const isValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(ownersEmail);

	// Check if the selected option is not the first option
	const selectPositionIsValid =
		ownersPosition.options[ownersPosition.selectedIndex].index !== 0;

	const selectTypeOfSchoolIsValid =
		ownersTypeOfSchool.options[ownersTypeOfSchool.selectedIndex].index !== 0;

	if (ownersPosition.options[ownersPosition.selectedIndex].index === 7) {
		ownerOtherPosition.disabled = false;
	} else {
		ownerOtherPosition.disabled = true;
	}

	if (
		(isInputNotEmpty(ownerOtherPosition) || ownerOtherPosition.disabled) &&
		isInputNotEmpty(ownersFName) &&
		isInputNotEmpty(ownersLName) &&
		isInputNotEmpty(ownersTotalStudents) &&
		isInputNotEmpty(ownersTotalTeachers) &&
		isInputNotEmpty(ownersTotalNonTeachingStaff) &&
		selectPositionIsValid &&
		selectTypeOfSchoolIsValid &&
		isValidYear
	) {
		let isNumberValid = isValidNumber;
		let isEmailValid = isValidEmail;

		if (isValidNumber) {
			btnNext3.disabled = false;
			errorMessage.textContent = '';
		} else {
			btnNext3.disabled = true;
			errorMessage.textContent = 'Invalid mobile number. (09xx)';
		}

		if (isValidEmail) {
			btnNext3.disabled = false;
			emailMessage.textContent = '';
		} else {
			btnNext3.disabled = true;
			emailMessage.textContent = 'Invalid email address.';
		}

		if (isNumberValid && isEmailValid) {
			btnNext3.disabled = false;
		} else {
			btnNext3.disabled = true;
		}

		//btnNext3.disabled = false;
	} else {
		btnNext3.disabled = true;
	}
}

// Management Details Form 4
function validateInputsManagementDetails() {
	const btnNext4 = document.querySelector('.btn-management-details');

	// const principalOtherPosition = document.querySelector(
	//   '.principalOtherPosition'
	// );
	const principalFName = document.querySelector('.principalFName');
	const principalMName = document.querySelector('.principalMName');
	const principalLName = document.querySelector('.principalLName');
	const principalEmail = document.querySelector('.principalEmail').value.trim();
	// const principalPosition = document.querySelector('.principalPosition');

	const principalMobileNumber = document
		.querySelector('.principalMobileNumber')
		.value.trim();

	// if (principalPosition.options[principalPosition.selectedIndex].index === 7) {
	//   principalOtherPosition.disabled = false;
	// } else {
	//   principalOtherPosition.disabled = true;
	// }

	// const isValidNumber = /^\d{11}$/.test(principalMobileNumber);
	const isValidNumber = /^09[0-9]{9}$/.test(principalMobileNumber);
	const isValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(principalEmail);

	const errorMessage = document.querySelector('.principal-mobile');
	const emailMessage = document.querySelector('.principal-email');

	// Check if the selected option is not the first option
	// const selectPositionIsValid =
	// principalPosition.options[principalPosition.selectedIndex].index !== 0;

	if (
		isInputNotEmpty(principalFName) &&
		isInputNotEmpty(principalLName)
		// (isInputNotEmpty(principalOtherPosition) ||
		//   principalOtherPosition.disabled) &&
		// isInputNotEmpty(principalFName) &&
		// isInputNotEmpty(principalMName) &&
		// isInputNotEmpty(principalLName)
		// selectPositionIsValid &&

	) {

		let isNumberValid = isValidNumber;
		let isEmailValid = isValidEmail;

		if (isValidNumber) {
			btnNext4.disabled = false;
			errorMessage.textContent = '';
		} else {
			btnNext4.disabled = true;
			errorMessage.textContent = 'Invalid mobile number. (09xx)';
		}

		if (isValidEmail) {
			btnNext4.disabled = false;
			emailMessage.textContent = '';
		} else {
			btnNext4.disabled = true;
			emailMessage.textContent = 'Invalid email address.';
		}

		if (isNumberValid && isEmailValid) {
			btnNext4.disabled = false;
		} else {
			btnNext4.disabled = true;
		}

		// btnNext4.disabled = false;
	} else {
		btnNext4.disabled = true;
	}
}

// $('#schoolAcronym').on('input', function() {
//   validateAndShowError('#schoolAcronym', 'This field is required.');
// });

// // Add an input event listener to the school ID field
// $('.school-id-2').on('input', function() {
//   validateAndShowError('.school-id-2', 'This field is required.');
// });

// $(document).on('click', '.btn-school-information', function(event) {
//   event.preventDefault();

//   validateAndShowError('#schoolAcronym', 'This field is required.');
//   validateAndShowError('.school-id-2', 'This field is required.');

//   if ($('.require-message:empty').length === $('.require-message').length) {
//       $("#collapseThree").collapse('toggle');
//   }
// });

// function validateAndShowError(fieldClass, message) {
//   var value = $(fieldClass).val();
//   var errorMessage = $(fieldClass).siblings('.require-message');

//   if (value === '') {
//       errorMessage.text(message);
//   } else {
//       errorMessage.text('');
//   }
// }


$(document).on('input', '.mobile-number-2, .ownersMobileNumber, .principalMobileNumber', function () {
	if (this.value.length > 11) {
		this.value = this.value.slice(0, 11);
	}
});

$(document).on('input', '.ownersYearOfEstablishment', function () {
	if (this.value.length > 4) {
		this.value = this.value.slice(0, 4);
	}
});

$(document).on('keypress', '.input-number', function (e) {
	var charCode = e.which || e.keyCode;
	if (charCode !== 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
		e.preventDefault();
	}
});

$(document).on('input', '#sequence', function () {
	var sequence_no = $(this).val();

	$.ajax({
		url: baseURL + 'subscription/check_sequence_no',
		method: "POST",
		data: {
			sequence_no: sequence_no,
			'_token': csrf_token_value
		},
		dataType: "json",
		success: function (data) {
			if (data.error != '') {
				$('.message').html(data.error);
				$('.btn-sequence-number').attr('disabled', true);
			} else {
				$('#schoolName').val(data.school_name);
				$('.message').html('');
				validateCheckbox();
			}
		}
	});

});

function handleFileInputChange(inputId, nameClass, containerClass) {
	$(document).on('change', inputId, function (e) {
		var fileName = e.target.files[0].name;
		$(nameClass).fadeIn();
		$(containerClass).html(fileName);
	});
}
handleFileInputChange('#business_permit', '.business-name', '.business_permit');
handleFileInputChange('#sec', '.sec-name', '.sec');
handleFileInputChange('#recog_certificate', '.cert-name', '.recog_certificate');
handleFileInputChange('#official_logo', '.logo-name', '.official_logo');
handleFileInputChange('#sec_corporation', '.corp-name', '.sec_corporation');

$(document).on('click', '#save_subscribers', function (event) {
	event.preventDefault();
	event.stopPropagation();

	var form = $('#myForm')[0];
	var formData = new FormData(form);
	//School Information
	formData.append('sequence_no', $('#sequence').val());
	formData.append('schoolName', $('#schoolName').val());
	formData.append('schoolAcronym', $('#schoolAcronym').val());
	formData.append('schoolID', $('#schoolID').val());
	formData.append('schoolAddress', $('#schoolAddress').val());
	formData.append('telephoneNumber', $('#telephoneNumber').val());
	formData.append('mobileNumber', $('#mobileNumber').val());
	formData.append('email', $('#email').val());
	// formData.append('rfid_system', $('#rfidSchool').val());
	// formData.append('rfid_qty', $('#quantity').val());
	//End School Information

	//Owner Details
	formData.append('firstName', $('#firstName').val());
	formData.append('middleName', $('#middleName').val());
	formData.append('lastName', $('#lastName').val());
	formData.append('suffix', $('#suffix').val());
	formData.append('ownersTelNumber', $('#ownersTelNumber').val());
	formData.append('ownersMobileNumber', $('#ownersMobileNumber').val());
	formData.append('ownersEmail', $('#ownersEmail').val());
	formData.append('ownersPosition', $('#ownersPosition').val());
	formData.append('ownerOtherPosition', $('#ownerOtherPosition').val());
	formData.append('yearOfEstablishment', $('#yearOfEstablishment').val());
	formData.append('typeOfSchool', $('#typeOfSchool').val());
	formData.append('totalStudents', $('#totalStudents').val());
	formData.append('totalTeachers', $('#totalTeachers').val());
	formData.append('totalNonTeachingStaff', $('#totalNonTeachingStaff').val());
	//End Owner Details

	//Principal's Information
	formData.append('principalFName', $('#principalFName').val());
	formData.append('principalMName', $('#principalMName').val());
	formData.append('principalLName', $('#principalLName').val());
	formData.append('suffixPrincipal', $('#suffixPrincipal').val());
	formData.append('principaltelephoneNumber', $('#principaltelephoneNumber').val());
	formData.append('principalMobileNumber', $('#principalMobileNumber').val());
	formData.append('principalEmail', $('#principalEmail').val());
	// formData.append('principalPosition', $('#principalPosition').val());
	// formData.append('principalOtherPosition', $('#principalOtherPosition').val());
	//End Principal's Information

	//Attachments
	formData.append('business_permit', $('#business_permit')[0].files[0]);
	formData.append('sec', $('#sec')[0].files[0]);
	formData.append('recog_certificate', $('#recog_certificate')[0].files[0]);
	formData.append('official_logo', $('#official_logo')[0].files[0]);
	formData.append('sec_corporation', $('#sec_corporation')[0].files[0]);
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
				url: baseURL + 'subscription/save_subscribers',
				method: "POST",
				data: formData,
				contentType: false,
				processData: false,
				dataType: "json",
				beforeSend: function () {
					$('.loading-screen').fadeIn();
				},
				success: function (data) {
					if (data.error != '') {
						$('.reg-message').html(data.error);
						setTimeout(() => {
							$('.reg-message').html('');
						}, 2000);
					} else {
						$('.reg-message').html(data.success);
						setTimeout(() => {
							$('.reg-message').html('');
							window.location.href = baseURL;
						}, 3000);
					}
				},
				complete: function () {
					$('.loading-screen').fadeOut();
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.error("AJAX request failed:", textStatus, errorThrown);
					$('.message').html('<div class="alert alert-danger p-2 text-white text-sm">An error occurred while processing the request. Try again later.</div>');
				}
			});
		}
	});


});
