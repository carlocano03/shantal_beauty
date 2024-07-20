<style>
.tbl_header {
    border-collapse: collapse;
    width: 100%;
}

.bg-header {
    padding: 5px;
    background: linear-gradient(to right, #434875, #b18647);
    color: #fff;
    border: 1px solid #2c3e50;
    font-weight: bold;
}

.tbl_header td {
    padding: 5px;
    border: 1px solid #2c3e50;
    vertical-align: middle;
}

.td-bg {
    background: #95a5a6;
    color: #fff;
}
</style>
<div style="overflow-x:auto;">
    <table class="tbl_header">
        <tr>
            <td colspan="12" class="text-center text-uppercase bg-header">Scholarhip/Study Grant Information</td>
        </tr>
        <tr>
            <td class="fw-bold td-bg" style="width:11%;">School Name:</td>
            <td colspan="12"><?= isset($application['school_name']) ? ucwords($application['school_name']) : '';?></td>
        </tr>
        <tr>
            <td colspan="6" class="text-center text-uppercase bg-header">Personal Information</td>
        </tr>
        <tr>
            <td class="fw-bold td-bg" style="width:10%;">First Name:</td>
            <td style="width:20%;">
                <?= isset($application['student_first_name']) ? ucwords($application['student_first_name']) : '';?></td>
            <td class="fw-bold td-bg" style="width:10%;">Middle Name:</td>
            <td style="width:20%;">
                <?= isset($application['student_middle_name']) ? ucwords($application['student_middle_name']) : '';?>
            </td>
            <td class="fw-bold td-bg" style="width:10%;">Last Name:</td>
            <td style="width:20%;">
                <?= isset($application['student_last_name']) ? ucwords($application['student_last_name']) : '';?></td>
        </tr>
        <tr>
            <td class="fw-bold td-bg" style="width:10%;">Place of Birth:</td>
            <td colspan="3"><?= isset($application['birth_place']) ? ucwords($application['birth_place']) : '';?></td>
            <td class="fw-bold td-bg" style="width:10%;">Birthday:</td>
            <td>
                <?= isset($application['birthday']) ? date('F j, Y', strtotime($application['birthday'])) : ''?> <span
                    class="badge bg-danger">Age: <?= isset($application['age']) ? $application['age'] : '';?></span>
            </td>
        </tr>
        <tr>
            <td class="fw-bold td-bg" style="width:10%;">Citizenship:</td>
            <td colspan="3"><?= isset($application['citizenship']) ? ucwords($application['citizenship']) : '';?></td>
            <td class="fw-bold td-bg" style="width:10%;">Civil Status:</td>
            <td><?= isset($application['civil_status']) ? ucwords($application['civil_status']) : '';?></td>
        </tr>
        <tr>
            <td class="fw-bold td-bg" style="width:10%;">Permanent Address:</td>
            <td colspan="3">
                <?= isset($application['permanent_address']) ? ucwords($application['permanent_address']) : '';?><?= isset($application['pemanent_zipcode']) ? ', '.$application['pemanent_zipcode'] : '';?>
            </td>
            <td class="fw-bold td-bg" style="width:10%;">Telephone No.:</td>
            <td>
                <?= isset($application['permanent_tel_no']) ? $application['permanent_tel_no'] : ''?>
            </td>
        </tr>
        <tr>
            <td class="fw-bold td-bg" style="width:10%;">City Address:</td>
            <td colspan="3">
                <?= isset($application['city_address']) ? ucwords($application['city_address']) : '';?>
                <?= isset($application['city_zipcode']) ? ','.$application['city_zipcode'] : '';?>
            </td>
            <td class="fw-bold td-bg" style="width:10%;">Telephone No.:</td>
            <td>
                <?= isset($application['city_tel_no']) ? $application['city_tel_no'] : ''?>
            </td>
        </tr>
        <tr>
            <td class="fw-bold td-bg" style="width:10%;">Mobile No.:</td>
            <td colspan="2">
                <?= isset($application['mobile_no']) ? $application['mobile_no'] : ''?>
            </td>
            <td class="fw-bold td-bg" style="width:10%;">Email Address:</td>
            <td colspan="2">
                <?= isset($application['email_address']) ? $application['email_address'] : ''?>
            </td>
        </tr>
        <tr>
            <td class="fw-bold td-bg" style="width:10%;">Address on Campus:</td>
            <td colspan="5">
                <?= isset($application['school_address']) ? ucwords($application['school_address']) : '';?>
            </td>
        </tr>
        <tr>
            <td colspan="6" class="text-center text-uppercase bg-header">Family Information</td>
        </tr>
        <tr>
            <td class="fw-bold td-bg" style="width:10%;">Father:</td>
            <td>
                <?= isset($application['father_fullname']) ? ucwords($application['father_fullname']) : '';?>
            </td>
            <td class="fw-bold td-bg" style="width:10%;">Occupation:</td>
            <td>
                <?= isset($application['father_occupation']) ? ucwords($application['father_occupation']) : '';?>
            </td>
            <td class="fw-bold td-bg" style="width:10%;">Salary:</td>
            <td>
                <?= isset($application['father_salary']) ? number_format($application['father_salary'],2) : ''?>
            </td>
        </tr>
        <tr>
            <td class="fw-bold td-bg" style="width:10%;">Mother:</td>
            <td>
                <?= isset($application['mother_fullname']) ? ucwords($application['mother_fullname']) : '';?>
            </td>
            <td class="fw-bold td-bg" style="width:10%;">Occupation:</td>
            <td>
                <?= isset($application['mother_occupation']) ? ucwords($application['mother_occupation']) : '';?>
            </td>
            <td class="fw-bold td-bg" style="width:10%;">Salary:</td>
            <td>
                <?= isset($application['mother_salary']) ? number_format($application['mother_salary'],2) : ''?>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="fw-bold td-bg" style="width:10%;">If both parents are unemployed, state reason/s
                (e.g.
                retired, old age, health, etc. source of livelihood):</td>
            <td>
                <?= isset($application['parents_unemployed']) ? ucwords($application['parents_unemployed']) : ''?>
            </td>
            <td class="fw-bold td-bg" style="width:10%;">Amount:</td>
            <td>
                <?= isset($application['unemployed_income']) ? number_format($application['unemployed_income'],2) : ''?>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="fw-bold td-bg" style="width:10%;">(or contribution from other sources like relatives,
                etc.):</td>
            <td colspan="3">
                <?= isset($application['other_sources']) ? $application['other_sources'] : ''?>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="fw-bold td-bg" style="width:10%;">if self-employed, state type of business:</td>
            <td colspan="2">
                <?= isset($application['self_employed']) ? $application['self_employed'] : ''?>
            </td>
            <td class="fw-bold td-bg" style="width:10%;">Earning Per Year:</td>
            <td>
                <?= isset($application['earning_per_year']) ? number_format($application['earning_per_year'],2) : ''?>
            </td>
        </tr>
        <tr>
            <td class="fw-bold td-bg" style="width:10%;">Guardian:</td>
            <td>
                <?= isset($application['guardian_name']) ? ucwords($application['guardian_name']) : '';?>
            </td>
            <td class="fw-bold td-bg" style="width:10%;">Occupation:</td>
            <td>
                <?= isset($application['guardian_occupation']) ? ucwords($application['guardian_occupation']) : '';?>
            </td>
            <td class="fw-bold td-bg" style="width:10%;">Salary:</td>
            <td>
                <?= isset($application['guardian_salary']) ? number_format($application['guardian_salary'],2) : ''?>
            </td>
        </tr>
        <tr>
            <td class="fw-bold td-bg" style="width:10%;">Relationship:</td>
            <td colspan="5"><?= isset($application['relation']) ? ucwords($application['relation']) : '';?></td>
        </tr>
        <tr>
            <td colspan="6" class="text-center text-uppercase bg-header">Other Information</td>
        </tr>
        <tr>
            <td colspan="3" class="fw-bold td-bg" style="width:10%;">1. Are you enjoying any scholarship, financial
                assistance, or other privileges in the University?</td>
            <td>
                <div class="d-flex align-items-center">
                    <div class="form-check me-4 mt-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled
                            <?= (isset($application['any_previleges_university']) && $application['any_previleges_university'] == 'Yes') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="flexCheckDisabled">
                            YES
                        </label>
                    </div>
                    <div class="form-check me-4 mt-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled
                            <?= (isset($application['any_previleges_university']) && $application['any_previleges_university'] == 'No') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="flexCheckDisabled">
                            NO
                        </label>
                    </div>
                </div>
            </td>
            <td class="fw-bold td-bg" style="width:10%;">Outside the University?</td>
            <td>
                <div class="d-flex align-items-center">
                    <div class="form-check me-4 mt-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled
                            <?= (isset($application['outside_university']) && $application['outside_university'] == 'Yes') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="flexCheckDisabled">
                            YES
                        </label>
                    </div>
                    <div class="form-check me-4 mt-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled
                            <?= (isset($application['outside_university']) && $application['outside_university'] == 'No') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="flexCheckDisabled">
                            NO
                        </label>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="fw-bold td-bg" style="width:10%;">If the answer is “yes” to either or both, specify
                name,
                nature and amount of grant or scholarship:</td>
            <td colspan="2">
                <?= isset($application['name_scholarship_amount']) ? $application['name_scholarship_amount'] : '';?>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="fw-bold td-bg" style="width:10%;">2. Do your parents: (a.) own real properties?</td>
            <td colspan="2">
                <div class="d-flex align-items-center">
                    <div class="form-check me-4 mt-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled
                            <?= (isset($application['own_properties']) && $application['own_properties'] == 'Yes') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="flexCheckDisabled">
                            YES
                        </label>
                    </div>
                    <div class="form-check me-4 mt-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled
                            <?= (isset($application['own_properties']) && $application['own_properties'] == 'No') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="flexCheckDisabled">
                            NO
                        </label>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td class="fw-bold td-bg">If yes, specify:</td>
            <td colspan="3">
                <?= isset($application['property_name']) ? $application['property_name'] : '';?>
            </td>
            <td class="fw-bold td-bg">Market value:</td>
            <td>
                <?= isset($application['market_value']) ? $application['market_value'] : '';?>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="fw-bold td-bg">Others: (ex. Cars, stocks, etc.) Market value</td>
            <td colspan="3">
                <?= isset($application['property_others']) ? $application['property_others'] : '';?>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="fw-bold td-bg" style="width:10%;">3. If applicant’s parents are separated, state
                support
                being given by father/mother:</td>
            <td colspan="3">
                <?= isset($application['parents_separated']) ? $application['parents_separated'] : '';?>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="fw-bold td-bg" style="width:10%;">
                4. If applicant is married but separated: <br>
                State if husband/wife giving support:
            </td>
            <td colspan="2">
                <?= isset($application['married_separated']) ? $application['married_separated'] : '';?>
            </td>
            <td class="fw-bold td-bg">Amount:</td>
            <td>
                <?= isset($application['giving_amount']) ? number_format($application['giving_amount'],2) : ''?>
            </td>
        </tr>
        <tr>
            <td colspan="6" class="text-center text-uppercase bg-header">Attachments</td>
        </tr>
        <tr>
            <td class="fw-bold td-bg">1. 2x2 Photo:</td>
            <td>
                <button class="btn btn-warning btn-sm download"
                    data-file="<?= isset($application['personal_photo']) ? $application['personal_photo'] : '';?>"
                    data-folder="personal_photo"><i class="bi bi-download me-2"></i>Download</button>
            </td>
            <td colspan="3" class="fw-bold td-bg">
                2. For applicants already enrolled in the University, please submit also the following: <br>
                Are you already enrolled in the university?
            </td>
            <td>
                <div class="d-flex align-items-center">
                    <div class="form-check me-4 mt-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled
                            <?= (isset($application['already_enrolled']) && $application['already_enrolled'] == 'Yes') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="flexCheckDisabled">
                            YES
                        </label>
                    </div>
                    <div class="form-check me-4 mt-2">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled
                            <?= (isset($application['already_enrolled']) && $application['already_enrolled'] == 'No') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="flexCheckDisabled">
                            NO
                        </label>
                    </div>
                </div>
            </td>
        </tr>
        <!-- If enrolled show this tr -->
        <?php if(isset($application['already_enrolled']) && $application['already_enrolled'] == 'Yes') : ?>
        <tr>
            <td colspan="2" class="fw-bold td-bg">(a) Form 5 (previous semester/s)</td>
            <td>
                <button class="btn btn-warning btn-sm download"
                    data-file="<?= isset($application['form_five']) ? $application['form_five'] : '';?>"
                    data-folder="form_five"><i class="bi bi-download me-2"></i>Download</button>
            </td>
            <td colspan="2" class="fw-bold td-bg">(b) True copy of grade (previous semester)</td>
            <td>
                <button class="btn btn-warning btn-sm download"
                    data-file="<?= isset($application['copy_of_grade']) ? $application['copy_of_grade'] : '';?>"
                    data-folder="copy_grade"><i class="bi bi-download me-2"></i>Download</button>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="fw-bold td-bg">(c) Certification of year level standing(i.e. 1st year, etc.)</td>
            <td>
                <button class="btn btn-warning btn-sm download"
                    data-file="<?= isset($application['certification_year_level']) ? $application['certification_year_level'] : '';?>"
                    data-folder="certification_year_level"><i class="bi bi-download me-2"></i>Download</button>
            </td>
            <td colspan="2" class="fw-bold td-bg">(d) For Graduate Students: transcript of academic records, program of
                study</td>
            <td>
                <button class="btn btn-warning btn-sm download"
                    data-file="<?= isset($application['transcript_of_record']) ? $application['transcript_of_record'] : '';?>"
                    data-folder="tor"><i class="bi bi-download me-2"></i>Download</button>
            </td>
        </tr>
        <?php endif;?>
        <!-- End of enrolled -->
        <tr>
            <td colspan="3" class="fw-bold td-bg">3. Certification of good moral character. (From former school if
                incoming
                freshman)</td>
            <td>
                <button class="btn btn-warning btn-sm download"
                    data-file="<?= isset($application['good_moral']) ? $application['good_moral'] : '';?>"
                    data-folder="good_moral"><i class="bi bi-download me-2"></i>Download</button>
            </td>
            <td class="fw-bold td-bg">4. Birth Certificate</td>
            <td>
                <button class="btn btn-warning btn-sm download"
                    data-file="<?= isset($application['birth_certificate']) ? $application['birth_certificate'] : '';?>"
                    data-folder="birth_certificate"><i class="bi bi-download me-2"></i>Download</button>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="fw-bold td-bg">5. Letter of recommendation from the PLMAR</td>
            <td colspan="3">
                <button class="btn btn-warning btn-sm download"
                    data-file="<?= isset($application['letter_recommendation']) ? $application['letter_recommendation'] : '';?>"
                    data-folder="letter_recommendation"><i class="bi bi-download me-2"></i>Download</button>
            </td>
        </tr>
    </table>
</div>

<a class="btn btn-dark mt-3" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
    aria-controls="collapseExample">
    <i class="bi bi-shield-shaded me-2"></i>Data Privacy Consent Form
</a>

<div class="collapse" id="collapseExample">
    <div class="mt-2">
        <div style="text-align: justify;">
            <h6>The undersigned, one of the applicants/grantees of the <span id="school_name"
                    style="text-decoration:underline;"><?= isset($application['school_name']) ? ucwords($application['school_name']) : '';?></span>,
                has given permission to the CLCC staff, in charge of the
                scholarship/financial assistance in the collection, lawful use, and
                disclosure of any personal information which may include may student
                number,
                name, contact information, course, academic performance (i.e. number
                of
                units enrolled, subject/s with grade/s obtained) and grant details.
            </h6>
            <h6 class="mt-4">I, further confirm that the CLCC and other appropriate
                offices
                in the University are authorized to provide the above information to
                legitimate officers/institutions requesting specific information in
                relation
                to the awarding/renewal of my scholarship/financial assistance
                within the
                specified academic period
            </h6>
            <h6 class="mt-4">This consent enables the CLCC to comply with R.A.
                10173,
                otherwise known as the Data Privacy Act of 2012.</h6>

            <div class="mt-4" style="font-size:14px">
                <i>I certify that all the information contained in my scholarship
                    application form and documents submitted in connection with the
                    same are
                    true and correct</i>
            </div>

            <div class="mt-4" style="font-size:14px">
                <i>I consent to the processing of my personal and sensitive personal
                    information contained in this form and in documents submitted
                    for my
                    scholarship application for the purpose of enabling the PLMAR
                    including
                    all the relevant System and Constituent University Offices to
                    verify my
                    identify, prevent fraud, process my application, determine
                    whether I am
                    qualified to avail of any scholarship or other similar financial
                    or
                    other assistance, conduct research using non identifiable
                    information in
                    order to study the effectiveness of the University’s
                    scholarships and
                    other financial assistance programs and assess how to improve
                    the
                    systems for the selection and execution of scholarship
                    programs.</i>
            </div>

            <div class="mt-4" style="font-size:14px">
                <i>I further expressly agree that the concerned System and/or CLCC
                    office
                    may directly obtain all my relevant student records whether in
                    electronic or paper based format in order to verify the
                    information
                    contained in my application for the purpose of determining my
                    eligibility for the scholarships and other financial assistance
                    from the
                    relevant PLMAR Registrar, disciplinary board or tribunal and
                    other
                    University offices.</i>
            </div>

            <div class="mt-4" style="font-size:14px">
                <i>I expressly authorize the University to provide information
                    required by
                    the scholarship funders or sponsors for the purpose of enabling
                    the
                    latter to determine whether or not to continue to provide
                    financial and

                    other assistance with the assurance that the University will
                    require
                    such parties to observe strict compliance with the Philippine
                    Data
                    Privacy Act and other related laws and issuances when they
                    process my
                    personal and sensitive personal information.</i>
            </div>

            <div class="my-5" style="font-size:14px">
                <i>I understand that the PAMANTASAN NG LUNGSOD NG MARIKINA including
                    System
                    and CLCC offices are authorized to process my personal and
                    sensitive
                    personal information without need of my consent pursuant to the
                    relevant
                    portions of Sections 4, 12 and 13 of the Philippine Data Privacy
                    Act.</i>
            </div>
            <hr />

        </div>
    </div>
</div>