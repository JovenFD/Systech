<?php include('../../backend/layout/inc/header.php');
if ($_SESSION['userdata']['access'] != 'Administrator') {
    echo "<script> window.location.href = '../../';</script>";
    die();
}
?>

<title>PMVIC SETTING</title>

<body>

    <?php include('../../backend/layout/inc/right-sidebar.php'); ?>

    <?php include('../../backend/layout/inc/left-side-bar.php'); ?>

    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="title pb-20">
                <h2 class="h3 mb-0">PMVIC SETTING</h2>
            </div>
            <div class="min-height-200px">
                <div>
                    <div class="pd-20 card-box mb-4">
                        <div class="tab">
                            <ul class="nav nav-tabs customtab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home2" role="tab" aria-selected="true">General Setting</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#profile2" role="tab" aria-selected="false">Logo & Favicon</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#contact2" role="tab" aria-selected="false">Social Media</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="home2" role="tabpanel">
                                    <div class="pd-20">
                                        <form action="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Website Title</label>
                                                        <input type="text" class="form-control" placeholder="Enter Title">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Website Email</label>
                                                        <input type="text" class="form-control" placeholder="Website Email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Website Number</label>
                                                        <input type="text" class="form-control" placeholder="Enter Website Number">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Website Meta Keywords</label>
                                                        <input type="text" class="form-control" placeholder="Enter Meta Keywords">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Website Description</label>
                                                <textarea name="" class="form-control" id="" cols="30" rows="10" placeholder="Write Website Description"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary"> Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile2" role="tabpanel">
                                    <div class="pd-20">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <form action="" enctype="multipart/form-data">
                                                    <div class="mb-2">
                                                        <input type="file" name="" id="" class="form-control">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Save Logo</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact2" role="tabpanel">
                                    <div class="pd-20">
                                        ------Social Media -------
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php include('../../backend/layout/inc/footer.php'); ?>