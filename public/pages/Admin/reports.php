<?php include('../../backend/layout/inc/header.php');
if ($_SESSION['userdata']['access'] != 'Administrator') {
    echo "<script> window.location.href = '../../';</script>";
    die();
}

include('../../../private/initialize.php');

$get_pmvic_name = new Center();
$pmvic_name = $get_pmvic_name->get_Center_Name();

?>
<title>UPLOAD REPORT</title>

<body>

    <?php include('../../backend/layout/inc/right-sidebar.php'); ?>

    <?php include('../../backend/layout/inc/left-side-bar.php'); ?>

    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">

            <div class="min-height-200px">
                <!-- Simple Datatable start -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <div class="row mb-4">
                            <div class="col order-last">
                            </div>
                            <div class="col">
                                <h4 class="text-center" data-color="#3033af">UPLOAD REPORTS</h4>
                            </div>
                            <div class="col order-first">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for=""><b>START DATE</b></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="icon-copy bi bi-calendar-plus-fill"></i></span>
                                    </div>
                                    <input id="start_date" class="form-control date-picker" placeholder="Select Start Date" type="text">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for=""><b>END DATE</b></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="icon-copy bi bi-calendar-plus-fill"></i> </span>
                                    </div>
                                    <input id="end_date" class="form-control date-picker" placeholder="Select End Date" type="text">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for=""><b>SELECT PMVIC</b></label>
                                <div class="form-group">
                                    <div class="dropdown bootstrap-select form-control">
                                        <select class="selectpicker form-control" data-style="btn-outline-primary" data-size="5" tabindex="-98" id="select_pmvic">
                                            <option>--SELECT PMVIC CENTER--</option>
                                            <?php foreach ($pmvic_name as $row) : ?>
                                                <option value="<?= $row['pmvic_name'] ?>" class="form-control"><?= $row['pmvic_name'] . ' - ' . $row['pmvic_address'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mt-4">
                                <div>
                                    <button id="search" class="btn btn-info"><i class="icon-copy fa fa-filter" aria-hidden="true"></i> FILTER</button>
                                    <button id="reset" class="btn btn-warning"><i class="icon-copy fa fa-eraser" aria-hidden="true"></i> RESET</button>
                                </div>
                            </div>
                        </div>
                        <!---->
                        <div class="row mb-4 mt-4">
                            <div class="col-md-12 text-center">
                                <h4>Summary of Uploaded Vehicles </h4>
                            </div>
                            <div class="col-md-12 text-center mt-4">
                                <h5>Total Uploaded: <b class="text-danger"><span id="tottal-upload">0</span></b></h5>
                            </div>
                            <div class="col-md-12 text-center mt-2">
                                <h5>Total Duplicate Entry with Different Transaction no: <b class="text-danger"><span id="tot_duplicates"></span></b></h5>
                            </div>
                        </div>
                        <!-- -->
                        <div class="pb-20">
                            <table class="data-table table hover multiple-select-row nowrap dataTable no-footer dtr-inline collapsed" id="upload_data">
                                <thead>
                                    <tr>
                                        <th class="table-plus datatable-nosort">ID</th>
                                        <th>INSPECTION NO</th>
                                        <th>MV FILE NO</th>
                                        <th>PLATE NO</th>
                                        <th>SUCCESS LOG</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody"></tbody>
                            </table>
                        </div>
                        <!-- -->
                    </div>
                </div>
            </div>
            <!-- Simple Datatable End -->
        </div>


        <?php include('../../backend/layout/inc/footer.php'); ?>

        <script>
            $(document).on('click', '#search', function() {

                let startdate = $('#start_date').val();
                let enddate = $('#end_date').val();
                let selectPmvic = $('#select_pmvic').val();

                if (startdate != '' && enddate != '' && selectPmvic != '') {
                    $.ajax({
                        method: "POST",
                        url: "../../../private/controller/report/upload-report.php",
                        data: {
                            'startdate': startdate,
                            'enddate': enddate,
                            'selectPmvic': selectPmvic
                        },
                        success: function(response) {
                            const data = JSON.parse(response);

                            // console.log(data);
                            // return;

                            getShowData(data);

                            $('#tottal-upload').html(data['rowCount'] != 0 ? data['rowCount'] : 0);
                            $('#tot_duplicates').html(data['dataDuplicates'] != 0 ? data['dataDuplicates'] : 0);
                        },
                        error: function(response) {
                            poUpRightCorner('error', 'Error Seleting Data');
                        }
                    });
                } else {
                    alert('Empty one or more fields');
                }

                const getShowData = (data) => {
                    let list = '',
                        total = 0;

                    data['data'].map(items => {

                        total += parseInt(items['TOTAL'])

                        list += `
                            <tr>
                                <td>${items[0]}</td>
                                <td>${items['INSPECTION_REF_NO']}</td>
                                <td>${items['MV_FILE']}</td>
                                <td>${items['PLATE_NUM']}</td>
                                <td>${items['SUCCESS_LOG']}</td>
                            </tr>
                        `;
                    })



                    document.querySelector('#tbody').innerHTML = list;
                }
            });
        </script>