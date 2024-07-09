<style>
.my_profile__page-title {
    font-size: 24px;
    font-weight: bold;
}

.border-card {
    border: 1px solid #e0e0e0;
    border-radius: 15px;

}

.my_profile__card-title {
    font-size: 18px;
    font-weight: bold;
    padding-left: 12px;
    background: linear-gradient(to right, #434875, #b18647);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-fill-color: transparent;
    position: relative;
    display: inline-block;

}

.my_profile__card-title::before {
    content: '';
    width: 2px;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    background-color: #b18647;
    height: 90%;
    transform: translateY(1px);
    border-radius: 8px;
}

.my_profile__label {
    color: rgba(67, 72, 117, .6);
    font-size: 14px;
}

.my_profile__value {
    color: rgba(67, 72, 117, 0.8);
    font-weight: 600;
    padding: 6px 0;
    font-size: 16px;

}
</style>
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
                            <div class="my_profile__value">Jake</div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Middle Name</div>
                            <div class="my_profile__value">Embile</div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Last Name</div>
                            <div class="my_profile__value">Castor</div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Student No.</div>
                            <div class="my_profile__value">12312321</div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Course</div>
                            <div class="my_profile__value">BSIT</div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Year Level</div>
                            <div class="my_profile__value">12</div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Place of Birth</div>
                            <div class="my_profile__value">Cabiao</div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Date of Birth</div>
                            <div class="my_profile__value">November 09, 2000</div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Citizenship</div>
                            <div class="my_profile__value">Filipino</div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Civil Status</div>
                            <div class="my_profile__value">Single</div>
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
                            <div class="my_profile__value">Sinipit, Cabiao, Nueva Ecija</div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Zip Code</div>
                            <div class="my_profile__value">3107</div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Tel No.</div>
                            <div class="my_profile__value">0912312321</div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">City Address</div>
                            <div class="my_profile__value">Sinipit, Cabiao, Nueva Ecija</div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Zip Code</div>
                            <div class="my_profile__value">3107</div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Tel No.</div>
                            <div class="my_profile__value">0912312321</div>
                        </div>

                        <div class="col">
                            <div class="my_profile__label">Address on Campus</div>
                            <div class="my_profile__value">Sinipit, Cabiao, Nueva Ecija</div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Mobile No.</div>
                            <div class="my_profile__value">0912312321</div>
                        </div>
                        <div class="col">
                            <div class="my_profile__label">Email Address</div>
                            <div class="my_profile__value">jakecastor@gmail.com</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </ div>
    </div>
