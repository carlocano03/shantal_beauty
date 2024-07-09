<style>
.overview-card {
    background: #ffffff;
    border-radius: 15px;
    padding: 1.25rem;
    color: #434875;
    box-shadow: 0 9px 20px rgba(46, 35, 94, .07);
}

.overview-card__no-bg {
    padding: 1.25rem 0 1.25rem 0;
}

.overview-card__title {
    color: #434875;
    letter-spacing: .025em;
    font-weight: 600;
    font-size: 16px;
}


.overview-card__title {
    color: #434875;
    letter-spacing: .025em;
    font-weight: 600;
    font-size: 16px;
}

.overview-card__icon {
    width: 2rem;
    height: 2rem;
    object-fit: cover;
}

.custom-card {
    background: #f1f5f9;
    padding: 1rem;
    border-radius: .5rem;
    height: 100%;

}

.dashboard__img {
    width: 3rem;
}

.dashboard__img-container {
    padding: .4rem;
    border-radius: 100%;
    background-color: #ffffff;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
}

.dashboard__img-container--border1 {
    border: 2px solid #b18647;
}

.dashboard__img-container--border2 {
    border: 2px solid #4caf50;

}

.dashboard__img-container--border3 {
    border: 2px solid #3A96DD;
}

.dashboard__img-container--border4 {
    border: 2px solid #f44336;

}

.custom-card__title {
    font-weight: 900;
    font-size: 1.6rem;
    color: #212529;
}

.error-text {
    color: #f44336
}

.success-text {
    color: #4caf50;

}

.text-primary {
    color: #434875;
}

.card {
    border-radius: 15px;
    height: 100%;
}

.student__avatar {
    width: 6rem;
    height: 6rem;
    object-fit: cover;
}

.student__name {
    font-size: 24px;
    font-weight: bold;
}

.student__info {
    font-weight: bold;
    font-size: 16px;
    margin-top: 4px;
}

/* Sched */
.upcoming-sched__date-container-1 {
    box-shadow: rgba(0, 0, 0, 0.1) 0px 3px 8px;
    border-radius: .5rem;
    padding: 14px;
    border-left: 4px solid #434875;

}

.upcoming-sched__date-container-2 {
    box-shadow: rgba(0, 0, 0, 0.1) 0px 3px 8px;
    border-radius: .5rem;
    padding: 14px;
    border-left: 4px solid #b18647;

}

.upcoming-sched__weekday {
    font-size: 16px;
    margin-bottom: 10px;
    font-weight: bold;

}

.upcoming-sched__date {
    font-size: 14px;
}

.upcoming-sched__time {
    font-size: 14px;
}

.custom-text-success {
    color: #4caf50;
}

.custom-test-primary {
    color: #434875;
}

.custom-text-danger {
    color: #f44336;
}

.upcoming-sched__selected {
    background: #388e3c;
    color: #ffffff;
    font-weight: bold;
    padding: 4px 14px;
    border-radius: 24px;
    font-size: 12px;
}

.selected-date {
    background: rgba(129, 199, 132, .25);

}

.student__info--card-1 {
    background-color: #d9edf7;
    color: #333333;
    border: 1px solid #e0e0e0;
}

.student__info--card-2 {
    background-color: #f2dede;
    color: #333333;
    border: 1px solid #e0e0e0;
}


.student__info--card-3 {
    background-color: #fcf8e3;
    color: #333333;
    border: 1px solid #e0e0e0;

}



.student__info--card-img {
    width: 32px;
}

.student__info--card--no {
    font-size: 24px;
    font-weight: bold;
}

.student__info--card--text {
    font-size: 14px;
}

.student__info--card-img__container-1 {
    padding: 10px;
    border-radius: 100px;
    background: rgba(52, 73, 94, 0.15);

}

.student__info--card-img__container-2 {
    padding: 10px;
    border-radius: 100px;
    background: rgba(192, 57, 43, 0.2);

}

.student__info--card-img__container-3 {
    padding: 10px;
    border-radius: 100px;
    background: rgba(255, 191, 0, 0.2);

}

.recent-attendance__card-container {
    border: 1px solid #e0e0e0;

}

.recent-attendance__date {
    font-weight: bold;
    font-size: 14px;
}

.recent-attendance__badge--success {
    font-size: 10px;
    padding: 4px 14px;
    font-weight: bold;
    background: rgba(129, 199, 132, .2);
    color: #388e3c;
    border-radius: 100px;
}

.recent-attendance__badge--danger {
    font-size: 10px;
    padding: 4px 14px;
    font-weight: bold;
    background: rgba(239, 83, 80, .2);
    color: #d32f2f;
    border-radius: 100px;
}

.recent-attendance__badge--warning {
    font-size: 10px;
    padding: 4px 14px;
    font-weight: bold;
    background: rgba(255, 235, 59, .2);
    color: #fbc02d;
    border-radius: 100px;
}

.recent-attendance__time-title {
    font-size: 12px;
}

.recent-attendance__time {
    font-weight: bold;
    font-size: 14px;
}
</style>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y" style="max-width:100%">
        <div class="alert alert-danger" role="alert">
            <strong>Attention:</strong> Please submit an excuse letter for your absence on July 12, 2024.
        </div>

        <div class="row gy-3 ">
            <div class="col-lg-8 col-12 ">
                <div class="overview-card">
                    <div class="d-flex flex-column flex-lg-row align-items-center gap-4">
                        <img class="student__avatar" src="<?php echo base_url('assets/images/dashboard/boy.png'); ?>"
                            alt="applicant">
                        <div class="w-100 d-flex flex-column  pt-2 ">
                            <div class="student__name text-lg-start text-center">Jake Castor</div>
                            <div
                                class="d-flex gap-lg-5 gap-4 align-items-center justify-content-lg-start justify-content-center mt-3 py-3 py-lg-0">
                                <div>
                                    <div class="student__info--title">Grade</div>
                                    <div class="student__info">12</div>
                                </div>
                                <div>
                                    <div class="student__info--title">Email Address</div>
                                    <div class="student__info">jakecastor09@gmail.com</div>
                                </div>
                                <div>
                                    <div class="student__info--title">Phone Number</div>
                                    <div class="student__info">+6391785673</div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row row-cols-lg-3 row-cols-1 gy-3 gx-3 mt-lg-3 mt-2">
                        <div class="col">
                            <div class="overview-card student__info--card-1">
                                <div class="d-flex align-items-center gap-4">
                                    <div class="student__info--card-img__container-1">
                                        <img class="student__info--card-img"
                                            src="<?php echo base_url('assets/images/student_dashboard/attendance.png'); ?>"
                                            alt="applicant">
                                    </div>
                                    <div>
                                        <div class="student__info--card--no">24</div>
                                        <div class="student__info--card--text">Total Attendance</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="overview-card student__info--card-3">
                                <div class="d-flex align-items-center gap-4">
                                    <div class="student__info--card-img__container-3">
                                        <img class="student__info--card-img"
                                            src="<?php echo base_url('assets/images/student_dashboard/late.png'); ?>"
                                            alt="applicant">
                                    </div>

                                    <div>
                                        <div class="student__info--card--no">2</div>
                                        <div class="student__info--card--text">Total Late</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="overview-card student__info--card-2">
                                <div class="d-flex align-items-center gap-4">
                                    <div class="student__info--card-img__container-2">
                                        <img class="student__info--card-img"
                                            src="<?php echo base_url('assets/images/student_dashboard/absent.png'); ?>"
                                            alt="applicant">
                                    </div>
                                    <div>
                                        <div class="student__info--card--no">2</div>
                                        <div class="student__info--card--text">Total Absent</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="overview-card mt-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <img class="overview-card__icon"
                                src="<?php echo base_url('assets/images/student_dashboard/attendance-logs.png'); ?>"
                                alt="
										Registration">
                        </div>
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <h1 class="overview-card__title mb-0">Recent Attendance Logs</h1>
                            <select class="form-select w-25" aria-label="sort-and-filter">
                                <option selected disabled>Sort by</option>
                                <option value="date-asc">Oldest to Newest</option>
                                <option value="date-desc">Newest to Oldest</option>
                                <option value="status-late">Late</option>
                                <option value="status-on-time">On Time</option>
                                <option value="status-absent">Absent</option>
                            </select>

                        </div>

                    </div>
                    <div class="mt-4">
                        <div class="row row-cols-lg-3 row-cols-1 gx-lg-2 gy-lg-2 gy-3">
                            <div class="col">
                                <div class="overview-card recent-attendance__card-container">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="recent-attendance__date">July 11, 2024</div>
                                        <div class="recent-attendance__badge--success">On Time</div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 ">
                                        <div class="d-flex flex-column gap-1">
                                            <div class="recent-attendance__time-title">Check In Time</div>
                                            <div class="recent-attendance__time">2:00 PM</div>
                                        </div>
                                        <div class="d-flex flex-column gap-1">
                                            <div class="recent-attendance__time-title">Check Out Time</div>
                                            <div class="recent-attendance__time">6:00 PM</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="overview-card recent-attendance__card-container">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="recent-attendance__date">July 12, 2024</div>
                                        <div class="recent-attendance__badge--danger">Absent</div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between mt-4 ">
                                        <div class="d-flex flex-column gap-1">
                                            <div class="recent-attendance__time-title">Check In Time</div>
                                            <div class="recent-attendance__time">2:00 PM</div>
                                        </div>
                                        <div class="d-flex flex-column gap-1">
                                            <div class="recent-attendance__time-title">Check Out Time</div>
                                            <div class="recent-attendance__time">6:00 PM</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">

                                <div class="overview-card recent-attendance__card-container">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="recent-attendance__date">July 13, 2024</div>
                                        <div class="recent-attendance__badge--warning">Late</div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between mt-4 ">
                                        <div class="d-flex flex-column gap-1">
                                            <div class="recent-attendance__time-title">Check In Time</div>
                                            <div class="recent-attendance__time">2:00 PM</div>
                                        </div>
                                        <div class="d-flex flex-column gap-1">
                                            <div class="recent-attendance__time-title">Check Out Time</div>
                                            <div class="recent-attendance__time">6:00 PM</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="overview-card">
                    <div class="d-flex align-items-center gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <img class="overview-card__icon"
                                src="<?php echo base_url('assets/images/dashboard/upcoming.png'); ?>" alt="
										Registration">
                        </div>
                        <h1 class="overview-card__title mb-0">Upcoming Schedule</h1>
                    </div>

                    <div class="mt-4">
                        <div class="upcoming-sched__date-container-1 selected-date">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h1 class="upcoming-sched__weekday mb-0">Thursday</h1>
                                <div class="upcoming-sched__selected">Selected</div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between ">
                                <div class="upcoming-sched__date"><i
                                        class="fa-solid fa-calendar custom-text-primary me-1"></i> July 2,
                                    2024</div>
                                <div class="upcoming-sched__time"><i
                                        class="fa-solid fa-clock custom-text-danger me-1"></i> 09:00 AM -
                                    12:00 AM</div>
                            </div>
                        </div>

                        <div class="upcoming-sched__date-container-2 mt-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h1 class="upcoming-sched__weekday mb-0">Sunday</h1>

                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="upcoming-sched__date"><i
                                        class="fa-solid fa-calendar custom-text-primary me-1"></i> July 2,
                                    2024</div>
                                <div class="upcoming-sched__time"><i
                                        class="fa-solid fa-clock custom-text-danger me-1"></i> 09:00 AM -
                                    12:00 AM</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>












    <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/1.7.1/countUp.min.js"></script>