<style>
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
        <div class="card">
            <div class="card-header mb-3 pb-3 d-flex align-items-center gap-2 ">
                <img src="<?php echo base_url('assets/images/home/verified-account.png'); ?>" width="36px"
                    alt="Calendar" />
                <h5 class="table__title"><?= $card_title?></h5>
            </div>
            <div class="card-body mt-4">
                <table class="table" width="100%" id="tbl_user_account">
                    <thead>
                        <tr>
                            <th>Reseller ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email Address</th>
                            <th>Date Created</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var tbl_reseller_account = $('#tbl_user_account').DataTable({
            language: {
                search: '',
                searchPlaceholder: "Search Here...",
                paginate: {
                    next: '<i class="bi bi-chevron-double-right"></i>',
                    previous: '<i class="bi bi-chevron-double-left"></i>'
                }
            },
            "ordering": false,
            // "serverSide": true,
            // "processing": true,
            // "deferRender": true,
            // "ajax": {
            //     "url": "<?= base_url('portal/admin_portal/biometric_logs/get_biometric_logs')?>",
            //     "type": "POST",
            //     "data": function(d) {
            //         d[csrf_token_name] = csrf_token_value;
            //     },
            //     "complete": function(res) {
            //         csrf_token_name = res.responseJSON.csrf_token_name;
            //         csrf_token_value = res.responseJSON.csrf_token_value;
            //     }
            // }
        });
    });
</script>