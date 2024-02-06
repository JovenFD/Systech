<?php include('../../backend/layout/inc/header.php');
if ($_SESSION['userdata']['access'] != 'Administrator') {
    echo "<script> window.location.href = '../../';</script>";
    die();
}
?>

<title>DELETED HISTORY</title>

<body>

    <?php include('../../backend/layout/inc/right-sidebar.php'); ?>

    <?php include('../../backend/layout/inc/left-side-bar.php'); ?>

    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div>

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
                                    <h4 class="text-center" data-color="#3033af">ALL DELETED PMVIC UPLOAD'S</h4>
                                </div>
                                <div class="col order-first">

                                </div>
                            </div>
                        </div>
                        <div class="pb-20" style="padding: 10px;">
                            <table class="data-table table hover multiple-select-row nowrap dataTable no-footer dtr-inline collapsed" id="upload_deleted_data">
                                <thead>
                                    <tr>
                                        <th>Deleted By</th>
                                        <th>Date Remove</th>
                                        <th>PMVIC</th>
                                        <th>MVISR</th>
                                        <th>MV FILE</th>
                                        <th>PLATE</th>
                                        <th>INSPEC. NAME</th>
                                        <th>SUCCESS LOG</th>
                                        <th>EMISSION RESULT</th>
                                        <th>DATE UPLOAD</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- Simple Datatable End -->
                </div>
            </div>

            <!-- DELETE MODAL -->

            <div class="modal fade " id="upload-undeleted" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="myLargeModalLabel">
                                REPLACE PMVIC RECORDS
                            </h6>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                ×
                            </button>
                        </div>
                        <div class="modal-body">
                        <form method="POST" id="formunDeleted">
                            <div class="row">

                                <input type="hidden" class="form-control" name="id-deleted" id="id-deleted">
                                <input type="hidden" class="form-control" name="DATE-CREATED" id="DATE-CREATED">
                                <div class="col-md-12 text-center">
                                    <div id="mv-file"></div>
                                </div>
                            </div>
                        </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                Cancel
                            </button>
                            <button type="Submit" class="btn btn-primary" id="MoveToUndelete">
                                REPLACE
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('../../backend/layout/inc/footer.php'); ?>

            <script>
                $(document).ready(function() {
                    let deleted_data = $('#upload_deleted_data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "scrollCollapse": true,
                        "autoWidth": false,
                        "responsive": true,
                        "order": [],
                        "ajax": {
                            url: "../../../private/controller/deleted/process-deleted.php",
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

                    $(document).on('click', '.re-upload', function() {
                        event.preventDefault();

                        let reupload_id = $(this).data('id');

                        $.ajax({
                            method: "POST",
                            url: "../../../private/controller/upload/fetch-upload.php",
                            data: {
                                'reupload_id': reupload_id
                            },
                            success: function(response) {
                                const data = JSON.parse(response);

                                $('#id-upload').val(data.id);

                                $('#pmvic-upload').val(data.PMVIC_CENTER);

                                $('#ref_no').val(data.INSPECTION_REF_NO);

                                $('#mvfile-upload').val(data.MV_FILE);

                                $('#plate-upload').val(data.PLATE_NUM);

                                $('#Engine').val(data.ENGINE_NUM);

                                $('#Chassis').val(data.CHASIS_NUM);

                                $('#inspector_name').val(data.INSPECTOR_USERNAME);

                                $('#id').val(data.id);

                                $('#pmvic_name').val(data.PMVIC_CENTER);

                                $('#inspection_id').val(data.INSPECTION_ID);

                                $('#re-upload').modal('show');
                            },
                            error: function(response) {
                                poUpRightCorner('error', 'Error Seleting Data');
                            }
                        });
                    });


                    $(document).on('click', '#reupload-submit', function() {
                        event.preventDefault();

                        //let update_id = $('#pmvicID').val();

                        let form = $('#formReupload')[0];
                        let data = new FormData(form);

                        checkUserInputs(data);

                        if (data.get('plate-upload') != '' && data.get('mvfile-upload') != '') {

                            $.ajax({
                                type: "POST",
                                url: "../../../private/controller/upload/update-upload.php",
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

                                    console.log(data);
                                    return;

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
                            'plate-upload',
                            'Plate No.',
                            '.error-plate'
                        )

                        showMSG(
                            data,
                            'mvfile-upload',
                            'MV File No.',
                            '.error-mvfile'
                        )
                    }

                    $(document).on('click', '.fetch-deleted', function() {
                        event.preventDefault();

                        let reupload_id = $(this).data('id');

                        $.ajax({
                            method: "POST",
                            url: "../../../private/controller/upload/fetch-upload.php",
                            data: {
                                'reupload_id': reupload_id
                            },
                            success: function(response) {
                                const data = JSON.parse(response);

                                $('#id-deleted').val(data.id);
                                $('#mv-file').html("MV FILE No: <b>"  + data.TRANSACTION_NO + "</b> Move to Record");
                                $('#DATE-CREATED').val(data.DATE_CREATED);
                                $('#upload-undeleted').modal('show');
                            },
                            error: function(response) {
                                poUpRightCorner('error', 'Error Seleting Data');
                            }
                        });
                    });

                    $(document).on('click', '#MoveToUndelete', function() {
                        event.preventDefault();

                        let form = $('#formunDeleted')[0];
                        let data = new FormData(form);

                    
                            $.ajax({
                                type: "POST",
                                url: "../../../private/controller/deleted/deleted-replace.php",
                                data: data,
                                processData: false,
                                contentType: false,
                                cache: false,
                                async: false,
                                beforeSend: function() {
                                    $('#MoveToUndelete').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                                    $('#MoveToUndelete').attr("disabled", true);
                                    $('#MoveToUndelete').css({
                                        "border-radius": "50%"
                                    });
                                },

                                success: function(data) {

                               // console.log(data);

                                    if (data == 'true') {
                                        poUpRightCorner('success', 'Replace Successfully.');
                                        deleted_data.ajax.reload();
                                    } else {
                                        poUpRightCorner('error', 'Someting Went Wrong!!!.');
                                    }

                                },
                                complete: function() {

                                    $('#upload-undeleted').modal('hide');
                                    //$('#formPmvicUpdate').trigger("reset");
                                    $('#MoveToUndelete').html('Submit');
                                    $('#MoveToUndelete').attr("disabled", false);
                                    $('#MoveToUndelete').css({
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
            </script>