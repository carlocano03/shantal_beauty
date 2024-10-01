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

    .img-wrapper {
        width: 100%;
    }
    .tbl-info {
        width: 100%;
        border-collapse: collapse;
        color: #636e72;
    }
    .tbl-info td {
        border: 1.5px solid #b2bec3;
        padding: 5px !important;
    }

    #tbl_sales th:nth-child(1),
    #tbl_sales td:nth-child(1),
    #tbl_sales th:nth-child(3),
    #tbl_sales td:nth-child(3) {
        text-align: center;
    }

    #tbl_sales th:nth-child(4),
    #tbl_sales td:nth-child(4),
    #tbl_sales th:nth-child(5),
    #tbl_sales td:nth-child(5) {
        text-align: right;
    }

</style>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header mb-3 pb-3 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <img src="<?php echo base_url('assets/images/home/trade-show.png'); ?>" width="36px"
                        alt="Calendar" />
                    <h5 class="table__title"><?= $card_title?></h5>
                </div>
                <div class="me-3">
                    <a href="<?= base_url('admin/reseller-account')?>" class="btn btn-dark btn-sm"><i class="bi bi-backspace-fill me-2"></i>Back</a>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active position-relative" id="reseller-info-tab" data-bs-toggle="tab"
                            data-bs-target="#reseller-info" type="button" role="tab" aria-controls="reseller-info"
                            aria-selected="true"><i class="bi bi-person-circle me-2"></i>Reseller Information</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link position-relative" id="sales-tab" data-bs-toggle="tab" data-bs-target="#sales"
                            type="button" role="tab" aria-controls="sales" aria-selected="false"><i class="bi bi-bar-chart-line me-2"></i>Sales Report</button>
                    </li>
                </ul>
                <div class="tab-content p-0" id="myTabContent">
                    <div class="tab-pane fade show active" id="reseller-info" role="tabpanel" aria-labelledby="reseller-info">
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <?php
                                    $img = base_url()."assets/images/home/valid-id.png";
                                    if(!empty($reseller['id_attachment'])){
                                        if(file_exists('./assets/uploaded_file/reseller_application/'.$reseller['id_attachment'])){
                                            $img = base_url()."assets/uploaded_file/reseller_application/".$reseller['id_attachment'];
                                        }
                                    }
                                ?>
                                <div class="img-wrapper">
                                    <img src="<?= $img;?>" alt="">
                                </div>
                                <hr>
                                <table class="tbl-info">
                                    <tr>
                                        <td colspan="2" style="background: #b2bec3; color:#fff;" class="fw-bold">REFERRED BY</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold" style="width:30%;">Name</td>
                                        <td><?= isset($referred_by['referred_name']) ? $referred_by['referred_name'] : '';?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Referred Code</td>
                                        <td><?= isset($reseller['referred_by']) ? $reseller['referred_by'] : '';?></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-8">
                                <table class="tbl-info">
                                    <tr>
                                        <td colspan="2" style="background: #b2bec3; color:#fff;" class="fw-bold">PERSONAL INFORMATION</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold" style="width:20%;">Type of ID</td>
                                        <td><?= isset($reseller['type_id']) ? $reseller['type_id'] : '';?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Reseller Name</td>
                                        <?php
                                            $last_name = isset($reseller['last_name']) ? $reseller['last_name'] : '';
                                            $first_name = isset($reseller['first_name']) ? $reseller['first_name'] : '';
                                        ?>
                                        <td>
                                            <?= ucwords($first_name).' '.ucwords($last_name);?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Email Address</td>
                                        <td><?= isset($reseller['email_address']) ? $reseller['email_address'] : '';?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Contact Number</td>
                                        <td><?= isset($reseller['phone_number']) ? $reseller['phone_number'] : '';?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">TIN Number</td>
                                        <td><?= isset($reseller['tin_no']) ? $reseller['tin_no'] : '';?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Referral Code</td>
                                        <td><?= isset($reseller['referral_code']) ? $reseller['referral_code'] : '';?></td>
                                    </tr>
                                </table>
                                <table class="tbl-info">
                                    <tr>
                                        <td style="background: #b2bec3; color:#fff;" class="fw-bold">COMPLETE ADDRESS</td>
                                    </tr>
                                    <tr>
                                        <?php
                                            $address = $reseller['street'].' '.$reseller['barangay'].', '.$reseller['municipality'].', '.$reseller['province'];
                                        ?>
                                        <td><?= ucwords($address);?></td>
                                    </tr>
                                </table>
                                <table class="tbl-info">
                                    <tr>
                                        <td colspan="2" style="background: #b2bec3; color:#fff;" class="fw-bold">BANK INFORMATION</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold" style="width:20%;">Bank Type</td>
                                        <td><?= isset($reseller['bank_type']) ? $reseller['bank_type'] : '';?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Bank Name</td>
                                        <td><?= isset($reseller['bank_name']) ? $reseller['bank_name'] : '';?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Account Number</td>
                                        <td><?= isset($reseller['account_number']) ? $reseller['account_number'] : '';?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <table class="table" width="100%" id="tbl_sales">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="<?= base_url('assets/images/home/commission.png')?>" width="40px">
                                        <div class="fw-bold" style="font-size:17px;">Sales Chart</div>
                                    </div>  
                                    <div class="custom-date-input">
                                        <select name="filter_options" id="filter_options" class="form-select">
                                            <option value="1">Weekly</option>
                                            <option value="2">Monthly</option>
                                            <option value="3">Yearly</option>
                                        </select>
                                    </div>
                                </div>
                                <canvas id="barChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var salesChartInstance;
    var referral_code = "<?= isset($reseller['referral_code']) ? $reseller['referral_code'] : '';?>";
    function getSalesChart()
    {
        var range = $('#filter_options').val();
        var salesData;
        const salesChart = document.getElementById('barChart');

        if (salesChartInstance) {
            salesChartInstance.destroy();
        }

        $.ajax({
            url: "<?= base_url('admin_portal/reseller_application/get_sales_chart');?>",
            method: "POST",
            data: {
                referral_code: referral_code,
                range: range,
                '_token': csrf_token_value,
            },
            success: function(data) {
                var labels = Object.keys(data[0]).filter(key => key !== 'sales_status' && key !== 'sales_count');

                var formattedLabels = labels.map(date => {
                    var dateObj = new Date(date);
                    var options = {
                        month: 'short',
                        day: '2-digit',
                        year: 'numeric'
                    };
                    // Manually format the date to remove the comma
                    var day = dateObj.getDate().toString().padStart(2, '0');
                    var month = dateObj.toLocaleString('en-US', { month: 'short' });
                    var year = dateObj.getFullYear();
                    return `${day} ${month} ${year}`;
                });

                var datasets = [];
                var aggregatedData = {};

                // Process response to aggregate data
                data.forEach(function(sales) {
                    if (!aggregatedData[sales.sales_status]) {
                        aggregatedData[sales.sales_status] = new Array(labels.length).fill(0);
                    }
                });

                // Aggregate data
                data.forEach(function(sales) {
                    labels.forEach(function(date, index) {
                        aggregatedData[sales.sales_status][index] += parseInt(sales[date]);
                    });
                });

                // Convert aggregated data into datasets array format
                Object.keys(aggregatedData).forEach(function(salestype) {
                    datasets.push({
                        label: salestype,
                        data: aggregatedData[salestype],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    });
                });

                // Construct applicationData
                var salesData = {
                    labels: formattedLabels,
                    datasets: datasets
                };

                // Create the chart
                salesChartInstance = new Chart(salesChart, {
                    type: 'bar',
                    data: salesData,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top'
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    min: 0
                                }
                            }
                        }
                    }
                });
            }
        });
    }

    $(document).ready(function() {
        getSalesChart();

        $(document).on('change', '#filter_options', function() {
            getSalesChart();
        });

        var tbl_sales = $('#tbl_sales').DataTable({
            language: {
                search: '',
                searchPlaceholder: "Search Here...",
                paginate: {
                    next: '<i class="bi bi-chevron-double-right"></i>',
                    previous: '<i class="bi bi-chevron-double-left"></i>'
                }
            },
            "ordering": false,
            "serverSide": true,
            "processing": true,
            "deferRender": true,
            "ajax": {
                "url": "<?= base_url('admin_portal/reseller_application/get_product_sales');?>",
                "type": "POST",
                "data": function(d) {
                    d[csrf_token_name] = csrf_token_value;
                    d.referral_code = referral_code;
                },
                "complete": function(res) {
                    csrf_token_name = res.responseJSON.csrf_token_name;
                    csrf_token_value = res.responseJSON.csrf_token_value;
                }
            }
        });
    });
</script>