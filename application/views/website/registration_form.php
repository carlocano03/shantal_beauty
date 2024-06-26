<header class="border border-b shadow-sm">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg" style="
        position: relative;
        z-index: 10000;
        background: linear-gradient(to right, #434875, #b18647);
        /* background: #ffffff; */
      ">
        <div class="container-xxl">
            <!-- Logo -->
            <div class="d-flex gap-3 align-items-center">
                <img class="navbar__logo rounded-circle" src="<?= base_url('assets/images/clc.jpg')?>" alt="" />
                <div>
                    <h5 class="mb-0 fw-bold text-white">
                        Change Life Christian Church
                    </h5>
                </div>
            </div>
            <!-- <div class="fw-bold fs-5 text-white">APPLICATION FOR SCHOLARSHIP/STUDY GRANT</div> -->

    </nav>
</header>
<main>
    <div class="container mt-5 py-5">
        <!-- Form -->
        <div class=" shadow-sm p-4 rounded-4 bg-white" style="overflow: hidden;">
            <div class="fw-bold fs-5  text-white text-center py-3 rounded-2"
                style="background: linear-gradient(to right, #434875, #b18647)">APPLICATION FOR SCHOLARSHIP/STUDY GRANT
            </div>

            <div class="bs-stepper mt-3">
                <div class="bs-stepper-header" role="tablist">

                    <div class="step" data-target="#scholarship-grant-information">
                        <button type="button" class="step-trigger" role="tab"
                            aria-controls="scholarship-grant-information" id="scholarship-grant-information-trigger">
                            <span class="bs-stepper-circle">1</span>
                            <span class="bs-stepper-label">Scholarship Grant Information</span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#personal-information">
                        <button type="button" class="step-trigger" role="tab" aria-controls="personal-information"
                            id="personal-information-trigger">
                            <span class="bs-stepper-circle">2</span>
                            <span class="bs-stepper-label">Personal Information</span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#family-information">
                        <button type="button" class="step-trigger" role="tab" aria-controls="family-information"
                            id="family-information-trigger">
                            <span class="bs-stepper-circle">3</span>
                            <span class="bs-stepper-label">Family Information</span>
                        </button>
                    </div>
                    <div class="line"></div>

                    <div class="step" data-target="#others">
                        <button type="button" class="step-trigger" role="tab" aria-controls="others"
                            id="others-trigger">
                            <span class="bs-stepper-circle">4</span>
                            <span class="bs-stepper-label">Others</span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#attachments">
                        <button type="button" class="step-trigger" role="tab" aria-controls="attachments"
                            id="attachments-trigger">
                            <span class="bs-stepper-circle">5</span>
                            <span class="bs-stepper-label">Attachments</span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#data-privacy">
                        <button type="button" class="step-trigger" role="tab" aria-controls="data-privacy"
                            id="data-privacy-trigger">
                            <span class="bs-stepper-circle">6</span>
                            <span class="bs-stepper-label">Data Privacy Consent Form</span>
                        </button>
                    </div>

                </div>
                <form class="form">
                    <div class="bs-stepper-content  py-3 px-lg-4 mx-lg-4">
                        <div id="scholarship-grant-information" class="content" role="tabpanel"
                            aria-labelledby="scholarship-grant-information-trigger">
                            <h1 class="form-title">Scholarhip/Study Grant Information</h1>
                            <div class="py-3 ">
                                <div class="mb-4">
                                    <div class="form-group">
                                        <input type="text" id="scholarship-grant-information-input" class="input"
                                            required>
                                        <label for="scholarship-grant-information-input" class="label">Scholarship/Study
                                            Grant being applied for</label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button id="first-form" type="button" class="button-next">Next <span class="ms-1"><i
                                                class="fa-solid fa-arrow-right"></i></span></button>
                                </div>
                            </div>
                        </div>
                        <div id="personal-information" class="content" role="tabpanel"
                            aria-labelledby="personal-information-trigger">
                            <h1 class="form-title">Personal Information</h1>
                            <div class="py-3 ">
                                <div class="mb-4">
                                    <div class="row row-cols-lg-3 gy-4 row-cols-1 mb-4">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="name_of_applicant" class="input" required>
                                                <label for="name_of_applicant" class="label">Name of applicant</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="course" class="input" required>
                                                <label for="course" class="label">Course</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="year_level" class="input" required>
                                                <label for="year_level" class="label">Year Level</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="number" id="student_no" class="input" required>
                                                <label for="student_no" class="label">Student No.</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Birth and Citizenship Details -->
                                    <h1 class="form-title mb-4 mt-5">Birth and Citizenship Details </h1>
                                    <div class="row row-cols-lg-4 row-cols-1 gy-4 mb-4">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="place_of_birth" class="input" required>
                                                <label for="place_of_birth" class="label">Place of Birth</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="date" id="date_of_birth" class="input" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="citizenship" class="input" required>
                                                <label for="citizenship" class="label">Citizenship</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="civil_status" class="input" required>
                                                <label for="civil_status" class="label">Civil Status</label>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Contact Information -->
                                    <h1 class="form-title mb-4 mt-5">Contact Information </h1>
                                    <div class="row row-cols-lg-3 row-cols-1 gy-4 mb-4">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="permanent_address" class="input" required>
                                                <label for="permanent_address" class="label">Permanent Address</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="zip_code" class="input" required>
                                                <label for="zip_code" class="label">Zip Code</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="tel_no" class="input" required>
                                                <label for="tel_no" class="label">Tel. No.</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row row-cols-lg-3 row-cols-1 gy-4 mb-4">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="city_address" class="input" required>
                                                <label for="city_address" class="label">City Address</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="zip_code_2" class="input" required>
                                                <label for="zip_code_2" class="label">Zip Code</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="tel_no_2" class="input" required>
                                                <label for="tel_no_2" class="label">Tel. No.</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row row-cols-lg-3 row-cols-1 gy-4 mb-4">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="address_campus" class="input" required>
                                                <label for="address_campus" class="label">Address on Campus</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="number" id="mobile_no" class="input" required>
                                                <label for="mobile_no" class="label">Mobile No.</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="email" id="email_address" class="input" required>
                                                <label for="email_address" class="label">Email Address</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-end gap-3 mt-5">
                                    <button id="second-form-back" type="button" class="button-back"><span
                                            class="me-1"><i class="fa-solid fa-arrow-left"></i></span> Back
                                    </button>

                                    <button id="second-form" type="button" class="button-next">Next <span
                                            class="ms-1"><i class="fa-solid fa-arrow-right"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="family-information" class="content" role="tabpanel"
                            aria-labelledby="family-information-trigger">
                            <h1 class="form-title">Family Information</h1>
                            <div class="py-3 ">
                                <div class="mb-4">
                                    <div class="row row-cols-lg-3 row-cols-1 gy-4 mb-4">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="father" class="input" required>
                                                <label for="father" class="label">Father</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="father_occupation" class="input" required>
                                                <label for="father_occupation" class="label">Occupation</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="father_salary" class="input" required>
                                                <label for="father_salary" class="label">Salary</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row row-cols-lg-3 row-cols-1 gy-4 mb-4">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="mother" class="input" required>
                                                <label for="mother" class="label">Mother</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="mother_occupation" class="input" required>
                                                <label for="mother_occupation" class="label">Occupation</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="father_salary" class="input" required>
                                                <label for="father_salary" class="label">Salary</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row mb-4 gy-4">
                                        <div class="col-12 col-lg-8 ">
                                            <div class="form-group">
                                                <input type="text" id="state_reason" class="input" required>
                                                <label for="state_reason" style="font-size:12px;" class="label">If both
                                                    parents are unemployed, state reason/s (e.g. retired, old age,
                                                    health, etc. source of livelihood)</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <input type="number" id="state_reason_amount" class="input" required>
                                                <label for="state_reason_amount" class="label">Amount</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="contribution_from_other_sources" class="input"
                                                    required>
                                                <label for="contribution_from_other_sources" class="label">(or
                                                    contribution from other sources like relatives, etc.)</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row  row-cols-lg-2 row-cols-1 gy-4 mb-4">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="self_employed" class="input" required>
                                                <label for="self_employed" class="label">If self-employed, state type of
                                                    business</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="number" id="earning_per_year" class="input" required>
                                                <label for="earning_per_year" class="label">Earning Per Year</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row row-cols-lg-4 row-cols-1 gy-4 mb-4">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="guardian" class="input" required>
                                                <label for="guardian" class="label">Guardian</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="guardian_occupation" class="input" required>
                                                <label for="guardian_occupation" class="label">Occupation</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="guardian_salary" class="input" required>
                                                <label for="guardian_salary" class="label">Salary</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" id="guardian_relation" class="input" required>
                                                <label for="guardian_relation" class="label">Relation</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-end gap-3 mt-5">
                                    <button id="third-form-back" type="button" class="button-back"><span class="me-1"><i
                                                class="fa-solid fa-arrow-left"></i></span> Back
                                    </button>

                                    <button id="third-form" type="button" class="button-next">Next <span class="ms-1"><i
                                                class="fa-solid fa-arrow-right"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="others" class="content" role="tabpanel" aria-labelledby="others-trigger">
                            <h1 class="form-title">Others</h1>
                            <div class="py-3 ">
                                <div class="mb-4">
                                    <div class="form-group">
                                        <h6>Please answer:</h6>
                                        <div class=" gap-2  mt-2">

                                            <!-- Question #1 -->

                                            <div>1. Are you enjoying any scholarship, financial assistance, or other
                                                privileges in the University?</div>
                                            <div class="d-flex align-items-center gap-2 ms-3 ">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="scholarshipQuestion" id="scholarshipYes">
                                                    <label class="form-check-label" for="scholarshipYes">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="scholarshipQuestion" id="scholarshipNo" checked>
                                                    <label class="form-check-label" for="scholarshipNo">
                                                        No.
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="ms-3">Outside the University?</div>
                                            <div class="d-flex align-items-center gap-2 ms-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="outsideUniversity" id="outside-university-yes">
                                                    <label class="form-check-label" for="outside-university-yes">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="outsideUniversity" id="outside-university-no" checked>
                                                    <label class="form-check-label" for="outside-university-no">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gap-2 ms-3">
                                            <div>If the answer is “yes” to either or both, specify name, nature and
                                                amount of grant or scholarship:</div>
                                            <input type="number" class="amount-of-scholarship">
                                        </div>

                                        <!-- Question #2 -->
                                        <div>
                                            <div class="mt-3  gap-2">
                                                <div>2. Do your parents: (a.) own real properties?</div>
                                                <div class="d-flex gap-2 ms-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="scholarshipQuestion2" id="scholarshipYes">
                                                        <label class="form-check-label" for="scholarshipYes">
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="scholarshipQuestion2" id="scholarshipNo" checked>
                                                        <label class="form-check-label" for="scholarshipNo">
                                                            No.
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-1">
                                                <div class=" gap-2 ms-3">
                                                    <div>If yes, specify:</div>
                                                    <input type="text" id="propertiesName">
                                                </div>
                                                <div class=" gap-2 ms-3 mt-2">
                                                    <div>Market value:</div>
                                                    <input type="number" id="propertiesNameMarketValue">
                                                </div>
                                            </div>

                                            <div class="gap-2 ms-3 mt-1">
                                                <div>Others: (ex. Cars, stocks, etc.) Market value</div>
                                                <input type="number" id="OtherMarketValue ">
                                            </div>
                                        </div>

                                        <!-- Question #3 -->
                                        <div class="mt-3  gap-2">
                                            <div>3. If applicant’s parents are separated, state support being given by
                                                father/mother:</div>
                                            <input class="ms-3" type="text" id="parents-own-real-properties">
                                        </div>

                                        <!-- Question #4 -->
                                        <div class="mt-3">
                                            <div>4. If applicant is married but separated:</div>
                                            <div class=" align-items-center mt-1">
                                                <div class=" gap-2 ms-3">
                                                    <div>State if husband/wife giving support:</div>
                                                    <input type="text" id="support-status">
                                                </div>
                                                <div class=" gap-2 ms-3">
                                                    <div>Amount:</div>
                                                    <input type="number" id="support-amount">
                                                </div>
                                            </div>
                                        </div>

                                        <hr />

                                        <div class="my-4">I hereby certify that all the statements above are true and
                                            correct.</div>

                                        <hr />

                                        <div class="d-flex flex-column flex-lg-row gap-4">
                                            <div class="d-flex flex-column gap-2">
                                                <label for="signature-of-applicant"
                                                    class="file-input-label text-primary">Signature of Applicant</label>
                                                <input type="file" id="signature-of-applicant" class="file-input-img">
                                            </div>
                                            <div class="d-flex flex-column gap-2">
                                                <label for="name-in-print" class="file-input-label text-primary">Name in
                                                    Print</label>
                                                <input type="file" id="name-in-print" class="file-input-img">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="d-flex justify-content-end gap-3 mt-5">
                                    <button id="fourth-form-back" type="button" class="button-back"><span
                                            class="me-1"><i class="fa-solid fa-arrow-left"></i></span> Back
                                    </button>

                                    <button id="fourth-form" type="button" class="button-next">Next <span
                                            class="ms-1"><i class="fa-solid fa-arrow-right"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Attachments -->
                        <div id="attachments" class="content" role="tabpanel" aria-labelledby="attachments-trigger">
                            <h1 class="form-title">Required Attachments</h1>
                            <div class="py-3 ">
                                <div class="mb-4">
                                    <div class="d-flex flex-column gap-1">
                                        <div class="d-flex gap-2">
                                            <div>Deadline for filling:</div>
                                            <div class="fw-bold text-primary">June 30, 2024</div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <div>Date of Application:</div>
                                            <div class="fw-bold text-primary">June 30, 2024</div>
                                        </div>
                                    </div>

                                    <div class="py-4 fw-bold">Please attach the following</div>
                                    <div class="d-flex flex-column gap-4">
                                        <div>
                                            <label for="photo2x2" class="file-input-label text-primary">1. Upload 2x2"
                                                Photo</label>
                                            <input type="file" id="photo2x2" name="photo2x2" accept="image/*"
                                                class="file-input-img" required>
                                        </div>

                                        <div>
                                            <div class="file-input-label text-primary">2. For applicants already
                                                enrolled in the University, please submit also the following:</div>
                                            <div class="row gap-2">
                                                <div class="col">
                                                    <div class="d-flex flex-column gap-2">
                                                        <label for="form-5" class="text-primary">(a) Form 5 (previous
                                                            semester/s)</label>
                                                        <input type="file" id="form-5" name="form-5" accept="image/*"
                                                            class="file-input-img" required>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="d-flex flex-column gap-2">
                                                        <label for="copy-of-grade" class="text-primary">(b) True copy of
                                                            grade (previous semester)</label>
                                                        <input type="file" id="copy-of-grade" name="copy-of-grade"
                                                            accept="image/*" class="file-input-img" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3 gap-2">
                                                <div class="col">
                                                    <div class="d-flex flex-column gap-2">
                                                        <label for="certification-of-year-level"
                                                            class="text-primary">(c) Certification of year level
                                                            standing(i.e. 1st year, etc.)</label>
                                                        <input type="file" id="certification-of-year-level"
                                                            name="certification-of-year-level" accept="image/*"
                                                            class="file-input-img" required>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="d-flex flex-column gap-2">
                                                        <label for="transcript-of-academic-records"
                                                            class="text-primary">(d) For Graduate Students: transcript
                                                            of academic records, program of study</label>
                                                        <input type="file" id="transcript-of-academic-records"
                                                            name="transcript-of-academic-records" accept="image/*"
                                                            class="file-input-img" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div>
                                            <label for="certification-of-good-moral"
                                                class="file-input-label text-primary">3. Certification of good moral
                                                character. (From former school if incoming freshman)</label>
                                            <input type="file" id="certification-of-good-moral"
                                                name="certification-of-good-moral" accept="image/*"
                                                class="file-input-img" required>
                                        </div>

                                        <div>
                                            <label for="birth-certificate" class="file-input-label text-primary">4.
                                                Birth Certificate.
                                            </label>
                                            <input type="file" id="birth-certificate" name="birth-certificate"
                                                accept="image/*" class="file-input-img" required>
                                        </div>

                                        <div>
                                            <label for="letter-of-recommedation-from-plmr"
                                                class="file-input-label text-primary">5. Letter of recommendation from
                                                the PLMAR.
                                            </label>
                                            <input type="file" id="letter-of-recommedation-from-plmr"
                                                name="letter-of-recommedation-from-plmr" accept="image/*"
                                                class="file-input-img" required>
                                        </div>


                                    </div>
                                    <div>

                                    </div>

                                </div>
                                <div class="d-flex justify-content-end gap-3 mt-5">
                                    <button id="fifth-form-back" type="button" class="button-back"><span class="me-1"><i
                                                class="fa-solid fa-arrow-left"></i></span> Back
                                    </button>

                                    <button id="fifth-form" type="button" class="button-next">Next <span class="ms-1"><i
                                                class="fa-solid fa-arrow-right"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>


                        <!-- Data Privacy Consent Form -->
                        <div id="data-privacy" class="content" role="tabpanel" aria-labelledby="data-privacy-trigger">
                            <h1 class="form-title">Data Privacy Consent Form</h1>
                            <div class="py-3 ">
                                <div class="mb-4">
                                    <div>
                                        <h6>The undersigned, one of the applicants/grantees of the ,---------
                                            has given permission to the CLCC staff, in charge of the
                                            scholarship/financial assistance in the collection, lawful use, and
                                            disclosure of any personal information which may include may student number,
                                            name, contact information, course, academic performance (i.e. number of
                                            units enrolled, subject/s with grade/s obtained) and grant details.</h6>

                                        <h6 class="mt-4">I, further confirm that the CLCC and other appropriate offices
                                            in the University are authorized to provide the above information to
                                            legitimate officers/institutions requesting specific information in relation
                                            to the awarding/renewal of my scholarship/financial assistance within the
                                            specified academic period</h6>

                                        <h6 class="mt-4">This consent enables the CLCC to comply with R.A. 10173,
                                            otherwise known as the Data Privacy Act of 2012.</h6>

                                        <div class="mt-4" style="font-size:14px">
                                            <i>I certify that all the information contained in my scholarship
                                                application form and documents submitted in connection with the same are
                                                true and correct</i>
                                        </div>

                                        <div class="mt-4" style="font-size:14px">
                                            <i>I consent to the processing of my personal and sensitive personal
                                                information contained in this form and in documents submitted for my
                                                scholarship application for the purpose of enabling the PLMAR including
                                                all the relevant System and Constituent University Offices to verify my
                                                identify, prevent fraud, process my application, determine whether I am
                                                qualified to avail of any scholarship or other similar financial or
                                                other assistance, conduct research using non identifiable information in
                                                order to study the effectiveness of the University’s scholarships and
                                                other financial assistance programs and assess how to improve the
                                                systems for the selection and execution of scholarship programs.</i>
                                        </div>

                                        <div class="mt-4" style="font-size:14px">
                                            <i>I further expressly agree that the concerned System and/or CLCC office
                                                may directly obtain all my relevant student records whether in
                                                electronic or paper based format in order to verify the information
                                                contained in my application for the purpose of determining my
                                                eligibility for the scholarships and other financial assistance from the
                                                relevant PLMAR Registrar, disciplinary board or tribunal and other
                                                University offices.</i>
                                        </div>

                                        <div class="mt-4" style="font-size:14px">
                                            <i>I expressly authorize the University to provide information required by
                                                the scholarship funders or sponsors for the purpose of enabling the
                                                latter to determine whether or not to continue to provide financial and
                                                other assistance with the assurance that the University will require
                                                such parties to observe strict compliance with the Philippine Data
                                                Privacy Act and other related laws and issuances when they process my
                                                personal and sensitive personal information.</i>
                                        </div>

                                        <div class="my-5" style="font-size:14px">
                                            <i>I understand that the PAMANTASAN NG LUNGSOD NG MARIKINA including System
                                                and CLCC offices are authorized to process my personal and sensitive
                                                personal information without need of my consent pursuant to the relevant
                                                portions of Sections 4, 12 and 13 of the Philippine Data Privacy
                                                Act.</i>
                                        </div>

                                        <hr />
                                        <div class="d-flex flex-column flex-lg-row gap-4 mt-5">
                                            <div>
                                                <label for="signature-over-printed-name-student"
                                                    class="file-input-label text-primary">Signature over printed name of
                                                    student
                                                </label>
                                                <input type="file" id="signature-over-printed-name-student"
                                                    name="signature-over-printed-name-student" class="file-input-img"
                                                    required>
                                            </div>

                                            <div class="">
                                                <label for="signature-over-printed-name-parent"
                                                    class="file-input-label text-primary">Signature over printed name of
                                                    parent/guardian
                                                </label>
                                                <input type="file" id="signature-over-printed-name-parent"
                                                    name="signature-over-printed-name-parent" class="file-input-img"
                                                    required>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="d-flex justify-content-end gap-3 mt-5">
                                    <button id="sixth-form-back" type="button" class="button-back"><span class="me-1"><i
                                                class="fa-solid fa-arrow-left"></i></span> Back
                                    </button>

                                    <button id="submit-form" type="submit" class="button-next">Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            </form>


        </div>
    </div>
    </div>
</main>