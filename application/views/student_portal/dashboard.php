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
                                            <div class="recent-attendance__time">---------------</div>
                                        </div>
                                        <div class="d-flex flex-column gap-1">
                                            <div class="recent-attendance__time-title">Check Out Time</div>
                                            <div class="recent-attendance__time">---------------</div>
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
                                            <div class="recent-attendance__time">2:01 PM</div>
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
