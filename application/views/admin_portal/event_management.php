<style>
#tbl_event_management th:nth-child(4) {
    text-align: center;
}

@keyframes round {

    0% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.2);
    }

    100% {
        transform: scale(1.4);
    }
}

.overview-card {
    background: #ffffff;
    border-radius: 15px;
    padding: 1.25rem;
    color: #434875;
    box-shadow: 0 9px 20px rgba(46, 35, 94, .07);
    border: 2px solid #434875;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.overview-card__title {
    color: #434875;
    letter-spacing: .025em;
    font-weight: 600;
    font-size: 16px;
}

.custom-card {
    background: #f1f5f9;
    padding: 1rem;
    border-radius: .5rem;
    height: 100%;
}

.dashboard__img {
    width: 4.5rem;
}

.dashboard__img-container {
    padding: .4rem;
    border-radius: 100%;
    background-color: #ffffff;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
}

.custom-card__title {
    font-weight: 900;
    font-size: 1rem;
    background: linear-gradient(to right, #434875, #b18647);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-fill-color: transparent;
}

.error-text {
    color: #f44336
}

.success-text {
    color: #4caf50;

}

.custom-card__sub-text {
    color: rgba(82, 82, 108, .8);
    line-height: 1.125rem;
    font-weight: bold;
    font-size: 0.80rem;
}

.table__title {
    font-size: 20px;
    font-weight: 500;
    color: #434875 !important;
    padding: 8px 0;
    margin-bottom: 0;

}

.card {
    background: #ffffff;
    border-radius: 8px;
    color: #434875;
    box-shadow: 0 9px 20px rgba(46, 35, 94, .07);

}

.upcoming-event__event-name {
    font-size: 20px;
    font-weight: bold;
    color: #434875;

}

#church_schedule_chart {
    width: 450px !important;
    height: 450px !important;

}

@media (max-width: 768px) {
    #church_schedule_chart {
        width: 350px !important;
        height: 350px !important;

    }
}

@media (max-width: 420px) {
    #church_schedule_chart {
        width: 250px !important;
        height: 250px !important;

    }
}
</style>
<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header mb-3 pb-3 d-flex align-items-center gap-2 ">
                <img src="<?php echo base_url('assets/images/event_management.png'); ?>" width="36px" alt="Calendar" />
                <h5 class="table__title"><?= $card_title?></h5>
            </div>
            <div class="card-body mt-4">
                <div class="row gy-4 gy-lg-0">
                    <div class="col-md-7">
                        <div class="card" style="border: 2px solid #434875;">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-2">
                                    <img class="overview-card__icon"
                                        src="<?php echo base_url('assets/images/dashboard/event.png'); ?>" alt="
										Registration">
                                    <h1 class="overview-card__title mb-0">Upcoming Event</h1>
                                </div>
                                <div id="events_container"></div>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="overview-card__title">
                                    Event History
                                </div>

                                <table class="table mt-2" width="100%" id="tbl_event_management">
                                    <thead>
                                        <tr>
                                            <th>Event Name</th>
                                            <th>Event Location</th>
                                            <th class="d-none d-lg-table-cell">Event Date</th>
                                            <th class="d-none d-lg-table-cell">Event Time</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="table__title"><i class="bi bi-plus-circle-fill me-2"></i>Add Event
                                </h5>
                            </div>
                            <div class="card-body mt-4">
                                <div class="alert alert-info mt-3"><i class="bi bi-info-circle-fill me-2"></i>Event
                                    Details</div>
                                <form id="addEvent" class="needs-validation" novalidate>
                                    <div class="d-flex flex-column gap-2">
                                        <div class="form-group">
                                            <label for="event_img" class="form-label">Image</label>
                                            <input type="file" class="form-control" id="event_img" accept="image/*"
                                                required>
                                            <div class="invalid-feedback">
                                                Please provide a valid event image.
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="event_name" class="form-label">Event Name</label>
                                            <input type="text" class="form-control" id="event_name" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid event name.
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="date" class="form-label">Date</label>
                                            <input type="date" class="form-control" id="date" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid date.
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="start_time" class="form-label">Time</label>
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center gap-2">
                                                    <input type="time" class="form-control" id="start_time" required>
                                                    <div> - </div>
                                                    <input type="time" class="form-control" id="end_time" required>

                                                </div>
                                                <div class="invalid-feedback">
                                                    Please provide a valid time.
                                                </div>


                                                <div class="invalid-feedback" id="time-error" style="display: none;">
                                                    Time In should be less than Time Out.
                                                </div>


                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="event_location" class="form-label">Location</label>
                                            <input type="text" class="form-control" id="event_location" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid location.
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="event_description" class="form-label">event_description</label>
                                            <textarea type="text" placeholder="Description" id="event_description"
                                                class="form-control" required></textarea>
                                            <div class="invalid-feedback">
                                                Please provide a valid description.
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-md-end d-flex d-md-block flex-column gap-2">
                                        <button type="button" class="btn btn-primary" id="add_event_btn">Add
                                            Event</button>
                                        <a href="" type="button" class="btn btn-secondary"><i
                                                class="bi bi-x-square me-2"></i>Cancel</a>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {


    function loadActiveEvents() {
        $.ajax({
            url: '<?=base_url('portal/admin_portal/event_management/get_active_events');?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    var eventsHtml = '';
                    response.events.forEach(function(event) {
                        eventsHtml +=
                            '<div class="mt-4" id="upcoming_event_item" style="cursor:pointer;" data-id="' +
                            event.id + '">' +
                            '<div class="upcoming-sched__date-container-4">' +
                            '<div class="d-flex justify-content-between align-items-center">' +
                            '<h4 class="upcoming-event__event-name">' + event.event_name +
                            '</h4>' +
                            '</div>' +
                            '<div class="d-flex align-items-center justify-content-between">' +
                            '<div class="upcoming-sched__date"><i class="fa-solid fa-calendar custom-text-primary me-2"></i>' +
                            event.event_date + '</div>' +
                            '<div class="upcoming-sched__time"><i class="fa-solid fa-clock custom-text-danger me-2"></i>' +
                            event.start_time + ' - ' + event.end_time + '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    });
                    $('#events_container').html(
                        eventsHtml);
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Ooops...',
                        text: 'Failed to load events.',
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops...',
                    text: 'An error occurred while fetching events.',
                });
            }
        });
    }


    loadActiveEvents();

    $("#add_event_btn").on('click', function(e) {
        e.preventDefault();
        event.stopPropagation();


        var form = $('#addEvent')[0];
        var formData = new FormData(form);

        formData.append('event_name', $("#event_name").val());
        formData.append('event_date', $("#date").val());
        formData.append('start_time', $("#start_time").val());
        formData.append('end_time', $("#end_time").val());
        formData.append('event_location', $("#event_location").val());
        formData.append('event_description', $("#event_description").val());
        formData.append('event_img', $("#event_img")[0].files[0]);
        formData.append('_token', csrf_token_value);

        var isTimeValid = $('#start_time').val() < $('#end_time').val();
        form.classList.add('was-validated');

        if (form.checkValidity() === false || !isTimeValid) {
            if (!isTimeValid) {
                $('#time-error').show();
                $('#start_time').css('border', '1px solid red');
                $('#end_time').css('border', '1px solid red');
            } else {
                $('#time-error').hide();
                $('#start_time').css('border', '');
                $('#end_time').css('border', '');
            }
            event.preventDefault();
            event.stopPropagation();
        } else {
            $('#time-error').hide();
            $('#start_time').css('border', '');
            $('#end_time').css('border', '');
            Swal.fire({
                title: 'Are you sure..',
                text: "You want to add this event?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, continue',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?=base_url('portal/admin_portal/event_management/add_event');?>',
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(data) {
                            if (data.error) {
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
                                $('#addEvent')[0].reset();
                                $('#addEvent').removeClass('was-validated');
                                $('#time-error').hide();
                                $('#start_time').css('border', '');
                                $('#end_time').css('border', '');
                                loadActiveEvents();
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Ooops...',
                                text: 'An error occurred while processing the request.',
                            });
                        }
                    })
                }

            })
        }

    })


    function loadFinishedEvents() {

        $.ajax({
            url: '<?=base_url('portal/admin_portal/event_management/fetch_finished_events');?>',
            method: "GET",
            dataType: "json",
            success: function(data) {
                var html = '';
                if (data.length > 0) {

                    for (var i = 0; i < data.length; i++) {
                        var startTime = new Date('1970-01-01T' + data[i].start_time + 'Z');
                        var endTime = new Date('1970-01-01T' + data[i].end_time + 'Z');


                        var eventDate = new Date(data[i].event_date);
                        var formattedDate = eventDate.toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });

                        var formattedStartTime = startTime.toLocaleTimeString('en-US', {
                            hour: 'numeric',
                            minute: 'numeric',
                            hour12: true
                        });

                        var formattedEndTime = endTime.toLocaleTimeString('en-US', {
                            hour: 'numeric',
                            minute: 'numeric',
                            hour12: true
                        });


                        html += '<tr>';
                        html += '<td>' + data[i].event_name + '</td>';
                        html += '<td>' + data[i].event_location + '</td>';
                        html += '<td class="d-none d-lg-table-cell">' + formattedDate + '</td>';
                        html += '<td class="text-center d-none d-lg-table-cell">' +
                            formattedStartTime + " - " + formattedEndTime + '</td>';
                        html += '</tr>';
                    }
                } else {
                    html += '<tr><td colspan="4">No finished events found.</td></tr>';
                }
                $('#tbl_event_management tbody').html(html);
            }
        });
    }

    loadFinishedEvents();


    $(document).on('click', '#upcoming_event_item', function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure..',
            text: "You want to delete this event?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, continue',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?=base_url('portal/admin_portal/event_management/delete_event');?>',
                    type: 'POST',
                    data: {
                        id: id,
                        '_token': csrf_token_value,
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thank You!',
                                text: response.success,
                            });
                            loadActiveEvents();
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Ooops...',
                                text: response.error,
                            });
                        }

                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ooops...',
                            text: 'An error occurred while processing the request.',
                        });
                    }
                });
            }
        })
    });



})
</script>
