<?php include('../../backend/layout/inc/header.php');

if ($_SESSION['userdata']['access'] != 'User') 
{
    echo "<script> window.location.href = '../../';</script>";
    die();
}


?>
<title>HOME</title>

<body>

    <?php include('../../backend/layout/inc/right-sidebar.php'); ?>

    <?php include('../../backend/layout/inc/left-side-bar.php'); ?>

    <?php

    if (isset($_SESSION['userdata'])) {
        if ($_SESSION['userdata']['access'] == 'User') {
        } else {
            echo "<script> window.location.href = '../Admin/';</script>";
        }
    } else {
        echo "<script> window.location.href = '../../';</script>";
    }

    include('../../../private/initialize.php');

    $count_pmvic = new Upload();
    $duplicates  = new Duplicates();
    $all_upload = $count_pmvic->All_Upload_Today($_SESSION['userdata']['pmvicName']);
    $today_upload = $count_pmvic->Upload_Today($_SESSION['userdata']['pmvicName']);
    $countAllDuplicates = $duplicates->todayDuplicateRecordUser($_SESSION['userdata']['pmvicName'])


    ?>


    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="xs-pd-20-10 pd-ltr-20">
            <div class="title pb-20">
                <h2 class="h3 mb-0">PMVIC Overview</h2>
            </div>

            <div class="row pb-10">
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark"><?= $all_upload  ?></div>
                                <div class="font-14 text-secondary weight-500">
                                    ALL UPLOAD'S
                                </div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#00eccf">
                                    <i class="icon-copy fa fa-upload text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark"><?= $today_upload ?></div>
                                <div class="font-14 text-secondary weight-500">
                                    TODAY UPLOAD'S
                                </div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#ff55b">
                                    <span class="icon-copy dw dw-calendar1 text-info"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark"><?= $countAllDuplicates ?></div>
                                <div class="font-14 text-secondary weight-500">
                                    NUMBER OF DUPLICATES
                                </div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#ff5b5b">
                                    <span class="icon-copy fa fa-copy"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('../../backend/layout/inc/footer.php'); ?>