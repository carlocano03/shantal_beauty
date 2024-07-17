<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y" style="max-width:100%">

        <div class="overview-card d-flex flex-column gap-2">
            <div class="p-4">
                <h1 class="my_profile__page-title mb-0">My Profile</h1>
            </div>
            <div class="border-card  p-4 m-0 m-lg-3">
                <h1 class="my_profile__card-title">Personal Information</h1>
                <div class=" mt-4">
                    <div class="row row-cols-lg-3 row-cols-md-3 row-cols-1 gy-4">
                        <div class="col">
                            <div class="my_profile__label">First Name</div>
                            <div class="my_profile__value"><?= isset($student_info['student_first_name']) ? ucfirst($student_info['student_first_name']) : '';?></div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Middle Name</div>
                            <div class="my_profile__value"><?= isset($student_info['student_middle_name']) ? ucfirst($student_info['student_middle_name']) : '';?></div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Last Name</div>
                            <div class="my_profile__value"><?= isset($student_info['student_last_name']) ? ucfirst($student_info['student_last_name']) : '';?></div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Student No.</div>
                            <div class="my_profile__value"><?= isset($student_info['student_no']) ? $student_info['student_no'] : '';?></div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Course</div>
                            <div class="my_profile__value"><?= isset($student_info['course']) ? $student_info['course'] : '';?></div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Year Level</div>
                            <div class="my_profile__value"><?= isset($student_info['year_level']) ? $student_info['year_level'] : '';?></div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Place of Birth</div>
                            <div class="my_profile__value"><?= isset($student_info['birth_place']) ? $student_info['birth_place'] : '';?></div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Date of Birth</div>
                            <div class="my_profile__value"><?= isset($student_info['birthday']) ? date('F j, Y', strtotime($student_info['birthday'])) : '';?></div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Citizenship</div>
                            <div class="my_profile__value"><?= isset($student_info['citizenship']) ? $student_info['citizenship'] : '';?></div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Civil Status</div>
                            <div class="my_profile__value"><?= isset($student_info['civil_status']) ? $student_info['civil_status'] : '';?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-card  p-4 m-0 m-lg-3 mt-lg-0">
                <h1 class="my_profile__card-title">Contact Information</h1>
                <div class="mt-4">
                    <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 gy-4">
                        <div class="col">
                            <div class="my_profile__label">Permanent Address</div>
                            <div class="my_profile__value"><?= isset($student_info['permanent_address']) ? ucwords($student_info['permanent_address']) : '';?></div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Zip Code</div>
                            <div class="my_profile__value"><?= isset($student_info['pemanent_zipcode']) ? $student_info['pemanent_zipcode'] : '';?></div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Tel No.</div>
                            <div class="my_profile__value"><?= isset($student_info['permanent_tel_no']) ? $student_info['permanent_tel_no'] : '';?></div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">City Address</div>
                            <div class="my_profile__value"><?= isset($student_info['city_address']) ? ucwords($student_info['city_address']) : '';?></div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Zip Code</div>
                            <div class="my_profile__value"><?= isset($student_info['city_zipcode']) ? $student_info['city_zipcode'] : '';?></div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Tel No.</div>
                            <div class="my_profile__value"><?= isset($student_info['city_tel_no']) ? $student_info['city_tel_no'] : '';?></div>
                        </div>

                        <div class="col">
                            <div class="my_profile__label">Address on Campus</div>
                            <div class="my_profile__value"><?= isset($student_info['school_address']) ? ucwords($student_info['school_address']) : '';?></div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Mobile No.</div>
                            <div class="my_profile__value"><?= isset($student_info['mobile_no']) ? $student_info['mobile_no'] : '';?></div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Email Address</div>
                            <div class="my_profile__value"><?= isset($student_info['email_address']) ? $student_info['email_address'] : '';?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </ div>
    </div>
