<?php include('../../../private/initialize.php'); ?>

<?php include('../../backend/layout/inc/header.php');
if ($_SESSION['userdata']['access'] != 'Administrator') {
    echo "<script> window.location.href = '../../';</script>";
    die();
}
?>

<title>PMVIC Center</title>

<body>

    <?php include('../../backend/layout/inc/right-sidebar.php'); ?>

    <?php include('../../backend/layout/inc/left-side-bar.php'); ?>

    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div>
                    <!-- Simple Datatable start -->
                    <div class="card-box mb-30">
                        <div class="pd-20">
                            <div class="row">
                                <div class="col order-last">
                                    <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-pmvic"> <i class="bi bi-plus-circle"></i> ADD PMVIC</button> -->

                                </div>
                                <div class="col">
                                    <h4 class="text-center" data-color="#3033af">PMVIC CENTER</h4>
                                </div>
                                <div class="col order-first">
                                    <button type="button" class="btn" data-toggle="modal" data-target="#add-pmvic" data-bgcolor="#007bb5" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 123, 181);">
                                        <i class="bi bi-plus-circle"></i> ADD PMVIC
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="pb-20">
                            <table class="data-table table stripe hover nowrap" id="pmvic_data">
                                <thead>
                                    <tr>
                                        <th class="table-plus datatable-nosort">ID</th>
                                        <th>Profile</th>
                                        <th>PMVIC Name</th>
                                        <th>Address</th>
                                        <th>Owner</th>
                                        <th>Contact</th>
                                        <th>Status</th>
                                        <th>Start Date</th>
                                        <th>Update Date</th>
                                        <th class="datatable-nosort">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- Simple Datatable End -->
                </div>
            </div>
            <!-- MODALS -->

            <!-- ADD -->
            <div class="modal fade bs-example-modal-lg" id="add-pmvic" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myLargeModalLabel">
                                ADD PMVIC RECORDS
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                ×
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="formPmvic" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">PMVIC Name</label>
                                            <input type="text" class="form-control" name="pmvicName" placeholder="Enter Name">
                                            <span class="error-pmvicName"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Description</label>
                                            <input type="text" class="form-control" name="pmvicDesc" placeholder="Enter Description">
                                            <span class="error-pmvicDesc"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label for="">PMVIC Address</label>
                                            <input type="text" class="form-control" name="pmvicAddress" placeholder="Enter Address">
                                            <span class="error-pmvicAddress"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label for="">PMVIC Owner</label>
                                            <input type="text" class="form-control" name="pmvicOwner" placeholder="Enter Owner">
                                            <span class="error-pmvicOwner"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label for="">PMVIC Contact</label>
                                            <input type="text" class="form-control" name="pmvicContact" placeholder="Enter Contacts">
                                            <span class="error-pmvicContact"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label for="">Date Operate</label>
                                            <input type="date" class="form-control" name="pmvicDateOperate">
                                            <span class="error-pmvicDateOperate"></span>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">STATUS</label>
                                        <select name="pmvicStatus" id="pmvicStatus" class="form-control">
                                            <option value="INACTIVE" class="form-control">INACTIVE</option>
                                            <option value="ACTIVE" class="form-control">ACTIVE</option>
                                        </select>
                                        <span class="error-pmvicStatus"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Profile Image</label>
                                            <input type="file" class="form-control" name="pmvicProfile">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                Cancel
                            </button>
                            <button type="Submit" class="btn btn-primary" id="InsertPmvic">
                                SAVE
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ADD MODAL -->

            <!-- UPDATE MODAL -->

            <div class="modal fade bs-example-modal-lg" id="edit-pmvic" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myLargeModalLabel">
                                UPDATE PMVIC RECORDS
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                ×
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="formPmvicUpdate" enctype="multipart/form-data">

                                <input type="hidden" class="form-control" name="pmvicID" id="pmvicID">
                                <input type="hidden" class="form-control" name="pmvicOldLogo" id="pmvicOldLogo">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">PMVIC Name</label>
                                            <input type="text" class="form-control" id="pmvicName" name="pmvicName" placeholder="Enter Name">
                                            <span class="error-pmvicName"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Description</label>
                                            <input type="text" class="form-control" id="pmvicDesc" name="pmvicDesc" placeholder="Enter Description">
                                            <span class="error-pmvicDesc"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label for="">PMVIC Address</label>
                                            <input type="text" class="form-control" id="pmvicAddress" name="pmvicAddress" placeholder="Enter Address">
                                            <span class="error-pmvicAddress"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label for="">PMVIC Owner</label>
                                            <input type="text" class="form-control" id="pmvicOwner" name="pmvicOwner" placeholder="Enter Owner">
                                            <span class="error-pmvicOwner"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label for="">PMVIC Contact</label>
                                            <input type="text" class="form-control" id="pmvicContact" name="pmvicContact" placeholder="Enter Contacts">
                                            <span class="error-pmvicContact"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label for="">Date Operate</label>
                                            <input type="date" class="form-control" id="pmvicDateOperate" name="pmvicDateOperate">
                                            <span class="error-pmvicDateOperate"></span>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">STATUS</label>
                                        <select name="pmvicStatus" id="pmvicStatus" class="form-control">
                                            <option value="INACTIVE" class="form-control">INACTIVE</option>
                                            <option value="ACTIVE" class="form-control">ACTIVE</option>
                                        </select>
                                        <span class="error-pmvicStatus"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Profile Image</label>
                                            <input type="file" class="form-control" name="pmvicProfile">
                                        </div>
                                    </div>
                                </div>



                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                Cancel
                            </button>
                            <button type="Submit" class="btn btn-primary" id="UpdatePmvic">
                                SAVE
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DELETE MODAL -->

            <div class="modal fade " id="delete-pmvic" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="myLargeModalLabel">
                                DELETE PMVIC RECORDS
                            </h6>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                ×
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <input type="hidden" class="form-control" name="pmvicIDDeleted" id="pmvicIDDeleted">
                                <div class="col-md-12 text-center">
                                    <div id="DataDeleted"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                Cancel
                            </button>
                            <button type="Submit" class="btn btn-danger" id="DeletePmvic">
                                DELETE
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- VIEW MODAL -->

            <div class="modal fade" id="view-pmvic" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <h4 class="mb-15">
                                <i class="fa fa-info-circle"> </i> PMVIC VIEW RECORD
                            </h4>
                            <div id="logo">

                            </div>
                            <div id="name">

                            </div>
                            <div id="address">

                            </div>
                            <div id="owner">

                            </div>
                            <div id="status">

                            </div>
                            <div id="start-date">

                            </div>
                            </br>
                            <button type="button" class="btn btn-dark" data-dismiss="modal">
                                BACK
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <?php include('../../backend/layout/inc/footer.php'); ?>

            <script>
                $(document).ready(function() {

                    let pmvicData = $('#pmvic_data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "scrollCollapse": true,
                        "autoWidth": false,
                        "responsive": true,
                        "order": [],
                        "ajax": {
                            url: "../../../private/controller/center/process-center.php",
                            type: "POST"
                        },
                        "columnDefs": [{
                            "targets": "datatable-nosort",
                            "orderable": false,
                        }, ],
                        lengthMenu: [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ],
                        language: {
                            info: "_START_-_END_ of _TOTAL_ entries",
                            searchPlaceholder: "Search Here",
                            paginate: {
                                next: '<i class="ion-chevron-right"></i>',
                                previous: '<i class="ion-chevron-left"></i>'
                            }
                        },
                    });



                    $(document).on('click', '#InsertPmvic', function() {
                        event.preventDefault();

                        let form = $('#formPmvic')[0];
                        let data = new FormData(form);

                        checkUserInputs(data);

                        if (data.get('pmvicName') != '' && data.get('pmvicAddress') != '' && data.get('pmvicOwner') != '' &&
                            data.get('pmvicContact') != '' && data.get('pmvicDateOperate') != '' && data.get('pmvicStatus') != '') {

                            $.ajax({
                                type: "POST",
                                url: "../../../private/controller/center/insert-center.php",
                                data: data,
                                processData: false,
                                contentType: false,
                                cache: false,
                                async: false,
                                beforeSend: function() {
                                    $('#InsertPmvic').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                                    $('#InsertPmvic').attr("disabled", true);
                                    $('#InsertPmvic').css({
                                        "border-radius": "50%"
                                    });
                                },
                                success: function(data) {


                                    if (data == 'true') {
                                        poUpRightCorner('success', 'Added Successfully.');
                                        pmvicData.ajax.reload();
                                    } else {
                                        poUpRightCorner('error', 'Someting Went Wrong!!!.');
                                    }

                                },
                                complete: function() {

                                    $('#add-pmvic').modal('hide');
                                    $('#formPmvic').trigger("reset");
                                    $('#InsertPmvic').html('Submit');
                                    $('#InsertPmvic').attr("disabled", false);
                                    $('#InsertPmvic').css({
                                        "border-radius": "4px"
                                    });


                                },
                                error: function(data) {

                                    poUpRightCorner('error', data.statusText);
                                }
                            });

                        } else {
                            return false;
                        }


                    });

                    $(document).on('click', '.view-pmvic', function() {
                        event.preventDefault();

                        let view_id = $(this).data('id');

                        $.ajax({
                            method: "POST",
                            url: "../../../private/controller/center/fetch-center.php",
                            data: {
                                'edit_id': view_id
                            },
                            success: function(response) {
                                const data = JSON.parse(response);

                                if (data.pmvic_profile == "") {
                                    $('#logo').html('<img src="../../backend/img/no-image.png" style="width:120px; heigth:120px; padding:0;" class="rounded-circle"><img>');
                                } else {
                                    $('#logo').html('<img src="data:image/png;base64,' + data.pmvic_profile + '" style="width:120px; heigth:120px; padding:0;" class="rounded-circle"><img>');
                                }


                                $('#name').html('<h5>Pmvic Name: <b>' + data.pmvic_name + '</b></h5>');
                                $('#address').html('<h5>Pmvic Address: <b>' + data.pmvic_address + '</b></h5>');
                                $('#owner').html('<h5>Pmvic Owner: <b>' + data.pmvic_owner + '</b></h5>');
                                $('#status').html('<h5>Status: <b>' + data.pmvic_status + '</b></h5>');
                                $('#start-date').html('<h5>Start Operate: <b>' + data.date_operate + '</b></h5>');

                                $('#view-pmvic').modal('show');


                            },
                            error: function(response) {
                                poUpRightCorner('error', 'Error Seleting Data');
                            }
                        });
                    });

                    $(document).on('click', '.fetch-pmvic', function() {
                        event.preventDefault();

                        let edit_id = $(this).data('id');

                        $.ajax({
                            method: "POST",
                            url: "../../../private/controller/center/fetch-center.php",
                            data: {
                                'edit_id': edit_id
                            },
                            success: function(response) {
                                const data = JSON.parse(response);

                                $('#pmvicID').val(data.pmvic_id);
                                $('#pmvicOldLogo').val(data.pmvic_profile);
                                $('#pmvicName').val(data.pmvic_name);
                                $('#pmvicAddress').val(data.pmvic_address);
                                $('#pmvicContact').val(data.pmvic_contact);
                                $('#pmvicOwner').val(data.pmvic_owner);
                                $('#pmvicDateOperate').val(data.date_operate);
                                $('#pmvicDesc').val(data.pmvic_desc);


                                if (data.pmvic_profile == "") {
                                    $('.image-logo').html('<img src="../../backend/img/no-image.png" style="width:120px; heigth:120px; padding:0;" class="rounded-circle"><img>');
                                } else {
                                    $('.image-logo').html('<img src="data:image/png;base64,' + data.pmvic_profile + '" style="width:120px; heigth:120px; padding:0;" class="rounded-circle"><img>');
                                }

                                $('#edit-pmvic').modal('show');

                            },
                            error: function(response) {
                                poUpRightCorner('error', 'Error Seleting Data');
                            }
                        });
                    });

                    $(document).on('click', '#UpdatePmvic', function() {
                        event.preventDefault();

                        //let update_id = $('#pmvicID').val();

                        let form = $('#formPmvicUpdate')[0];
                        let data = new FormData(form);

                        checkUserInputs(data);


                        if (data.get('pmvicName') != '' && data.get('pmvicAddress') != '' && data.get('pmvicOwner') != '' &&
                            data.get('pmvicContact') != '' && data.get('pmvicDateOperate') != '' && data.get('pmvicStatus') != '') {

                            $.ajax({
                                type: "POST",
                                url: "../../../private/controller/center/update-center.php",
                                data: data,
                                processData: false,
                                contentType: false,
                                cache: false,
                                async: false,
                                beforeSend: function() {
                                    $('#UpdatePmvic').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                                    $('#UpdatePmvic').attr("disabled", true);
                                    $('#UpdatePmvic').css({
                                        "border-radius": "50%"
                                    });
                                },

                                success: function(data) {

                                    //console.log(data);

                                    if (data == 'true') {
                                        poUpRightCorner('success', 'Update Successfully.');
                                        pmvicData.ajax.reload();
                                    } else {
                                        poUpRightCorner('error', 'Someting Went Wrong!!!.');
                                    }

                                },
                                complete: function() {

                                    $('#edit-pmvic').modal('hide');
                                    $('#formPmvicUpdate').trigger("reset");
                                    $('#UpdatePmvic').html('Submit');
                                    $('#UpdatePmvic').attr("disabled", false);
                                    $('#UpdatePmvic').css({
                                        "border-radius": "4px"
                                    });


                                },
                                error: function(data) {

                                    poUpRightCorner('error', data.statusText);
                                }
                            });

                        } else {
                            return false;
                        }




                    });

                    $(document).on('click', '.select-delete-pmvic', function() {
                        event.preventDefault();

                        let delete_id = $(this).data('id');

                        $.ajax({
                            method: "POST",
                            url: "../../../private/controller/center/fetch-center.php",
                            data: {
                                'edit_id': delete_id
                            },
                            success: function(response) {

                                const data = JSON.parse(response);

                                $('#pmvicIDDeleted').val(data.pmvic_id);
                                $('#DataDeleted').html('<span class="text-center"><h5>Do You Want delete "' + data.pmvic_name + '"</h5></span>');

                                $('#delete-pmvic').modal('show');

                            },
                            error: function(response) {
                                poUpRightCorner('error', 'Error Seleting Data');
                            }
                        });
                    });

                    $(document).on('click', '#DeletePmvic', function() {
                        event.preventDefault();

                        let delete_id = $('#pmvicIDDeleted').val();

                        $.ajax({
                            method: "POST",
                            url: "../../../private/controller/center/delete-center.php",
                            data: {
                                'delete_id': delete_id
                            },
                            beforeSend: function() {
                                $('#DeletePmvic').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                                $('#DeletePmvic').attr("disabled", true);
                                $('#DeletePmvic').css({
                                    "border-radius": "50%"
                                });
                            },
                            success: function(data) {
                                if (data == 'true') {
                                    pmvicData.ajax.reload();
                                    poUpRightCorner('success', 'Delete Successfully');
                                } else {
                                    poUpRightCorner('error', 'Someting Went Wrong!!!.');
                                }

                            },
                            complete: function() {

                                $('#delete-pmvic').modal('hide');
                                $('#DeletePmvic').html('Submit');
                                $('#DeletePmvic').attr("disabled", false);
                                $('#DeletePmvic').css({
                                    "border-radius": "4px"
                                });

                            },
                            error: function(data) {
                                poUpRightCorner('error', data.statusText);
                            }
                        });
                    });


                });

                function poUpRightCorner(status, message) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: status,
                        title: message
                    })
                }

                const showMSG = (data, domId, msg, domIdError) => {
                    if ($.trim(data.get(`${domId}`)).length == 0) {
                        $(`${domIdError}`).html(`<small class='ml-3'><span style='color:red;'> Please type ${msg}.</span></small>`);
                        setInterval(function() {
                            $(`${domIdError}`).html("");
                        }, 5000);
                    }
                }

                function checkUserInputs(data) {
                    showMSG(
                        data,
                        'pmvicName',
                        'Pmvic Name',
                        '.error-pmvicName'
                    );

                    showMSG(
                        data,
                        'pmvicDesc',
                        'Pmvic Description',
                        '.error-pmvicDesc'
                    );

                    showMSG(
                        data,
                        'pmvicAddress',
                        'Pmvic Address',
                        '.error-pmvicAddress'
                    );

                    showMSG(
                        data,
                        'pmvicOwner',
                        'Pmvic Owner',
                        '.error-pmvicOwner'
                    );

                    showMSG(
                        data,
                        'pmvicContact',
                        'Pmvic Contact',
                        '.error-pmvicContact'
                    );

                    showMSG(
                        data,
                        'pmvicDateOperate',
                        'Pmvic Operate',
                        '.error-pmvicDateOperate'
                    );

                    showMSG(
                        data,
                        'pmvicStatus',
                        'Pmvic Operate',
                        '.error-pmvicStatus'
                    );
                }
            </script>