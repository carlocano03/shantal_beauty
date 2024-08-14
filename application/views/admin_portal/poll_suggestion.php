<style>
    .not-rounded {
        border-radius:0px;
    }

    .bg-polygon {
        position: relative;
        margin-top: -15px;
        width: 62px;
        height: 62px;
        clip-path: polygon(40% 7.67949%, 43.1596% 6.20615%, 46.52704% 5.30384%, 50% 5%, 53.47296% 5.30384%, 56.8404% 6.20615%, 60% 7.67949%, 81.65064% 20.17949%, 84.50639% 22.17911%, 86.97152% 24.64425%, 88.97114% 27.5%, 90.44449% 30.6596%, 91.34679% 34.02704%, 91.65064% 37.5%, 91.65064% 62.5%, 91.34679% 65.97296%, 90.44449% 69.3404%, 88.97114% 72.5%, 86.97152% 75.35575%, 84.50639% 77.82089%, 81.65064% 79.82051%, 60% 92.32051%, 56.8404% 93.79385%, 53.47296% 94.69616%, 50% 95%, 46.52704% 94.69616%, 43.1596% 93.79385%, 40% 92.32051%, 18.34936% 79.82051%, 15.49361% 77.82089%, 13.02848% 75.35575%, 11.02886% 72.5%, 9.55551% 69.3404%, 8.65321% 65.97296%, 8.34936% 62.5%, 8.34936% 37.5%, 8.65321% 34.02704%, 9.55551% 30.6596%, 11.02886% 27.5%, 13.02848% 24.64425%, 15.49361% 22.17911%, 18.34936% 20.17949%);
        display: flex;
        align-items: center;
        justify-content: center;
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
</style>
<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header mb-3 pb-3 d-flex align-items-center gap-2 ">
                        <img src="<?php echo base_url('assets/images/client/suggestion.png'); ?>" width="36px"
                            alt="Calendar" />
                        <h5 class="table__title">Suggestions</h5>
                    </div>
                    <div class="card-body mt-3">
                        <div id="suggestion_list">
                            <!-- AJAX Request -->
                        </div>
                        <div class="pagination_suggestion"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card">
                    <div class="card-header mb-3 pb-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <img src="<?php echo base_url('assets/images/client/poll.png'); ?>" width="36px"
                                alt="Calendar" />
                            <h5 class="table__title">Poll Request</h5>
                        </div>
                        <button class="upcoming-sched__create-btn me-4" data-bs-target="#pollModal"
                                    data-bs-toggle="modal"><i class="fa-solid fa-plus me-1"></i>Create a Poll</button>
                    </div>
                    <div class="card-body mt-3">
                        <div class="row" id="poll_request">
                            <!-- AJAX Request -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

<script>
    function getPollRequest() {
        $.ajax({
            url: "<?= base_url('portal/admin_portal/poll_suggestion/getPollRequest')?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                $('#poll_request').html(data.poll_request);
            }
        });
    }

    function getSuggestion(page) {
        $.ajax({
            url: "<?= base_url('portal/admin_portal/poll_suggestion/getSuggestion/')?>" + page,
            method: "GET",
            dataType: "json",
            success: function(data) {
                $('#suggestion_list').html(data.suggestion_list);
                $('.pagination_suggestion').html(data.links);
            }
        }); 
    }

    $(document).ready(function() {
        getPollRequest();
        getSuggestion(0);
        
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('/').pop();
            getSuggestion(page);
        });

        $(document).on('click', '#save_poll', function(event) {
            event.preventDefault();
            event.stopPropagation();

            var form = $('#pollForm')[0];
            var formData = new FormData(form);

            var choices = document.querySelectorAll('input[name="choices[]"]');
            var choicesArr = [];
            var counter = choicesArr.length;
            for (let index = 0; index < choices.length; index++) {
                choicesArr[counter] = {
                    'choices' :choices[index].value,
                }
                counter++;
            }

            formData.append('poll_title', $('#poll_title').val());
            formData.append('choices', JSON.stringify(choicesArr));
            formData.append('_token', csrf_token_value);

            form.classList.add('was-validated');
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            } else { 
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
                            url: "<?= base_url('portal/admin_portal/poll_suggestion/add_new_poll')?>",
                            method: "POST",
                            data: formData,
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function(data) {
                                if (data.error != '') {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Oops...',
                                        text: data.error,
                                    }); 
                                } else {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Thank you!',
                                        text: data.success,
                                    });
                                    getPollRequest();
                                    form.reset();
                                    form.classList.remove('was-validated');
                                    $('#pollModal').modal('hide');
                                }
                            },
                            error :function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'An error occurred while processing the request.',
                                });
                            }
                        });
                    }
                });
            }
        });

        $(document).on('click', '.end_poll', function() {
            var poll_id = $(this).data('id');

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
                        url: "<?= base_url('portal/admin_portal/poll_suggestion/end_poll')?>",
                        method: "POST",
                        data: {
                            poll_id: poll_id,
                            '_token': csrf_token_value,
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.error != '') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Oops...',
                                    text: data.error,
                                }); 
                                getPollRequest();
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thank you!',
                                    text: data.success,
                                });
                                getPollRequest();
                            }
                        },
                        error :function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'An error occurred while processing the request.',
                            });
                        }
                    });
                }
            });
        });
    });
</script>

<?php $this->load->view('admin_portal/modal/poll_suggestion_modal');?>