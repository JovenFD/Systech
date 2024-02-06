<?php include('../../backend/layout/inc/header.php');
if ($_SESSION['userdata']['access'] != 'Administrator') {
    echo "<script> window.location.href = '../../';</script>";
    die();
}
?>

<title>USER ACCOUNT</title>
	
    <body>

<?php include('../../backend/layout/inc/right-sidebar.php');?>	

<?php include('../../backend/layout/inc/left-side-bar.php');?>

<style>
	.odd,.even{
		
	
		padding: 50%;
		
	}
</style>
<?php include('../../../private/initialize.php');

	$get_pmvic_name = new Center();
	$pmvic_name = $get_pmvic_name->get_Center_Name();

?>



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
									
								</div>
								<div class="col">
									<h4 class="text-center" data-color="#3033af">PMVIC USER ACCOUNT</h4>
								</div>
								<div class="col order-first">
									<button type="button" class="btn" data-toggle="modal" data-target="#add-user" data-bgcolor="#007bb5" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 123, 181);">
											<i class="bi bi-plus-circle"></i> ADD USER
									</button>
								</div>
							</div>  
						</div>
						<div class="pb-20">
							<table class="data-table table stripe hover nowrap" id="user_data">
								<thead>
									<tr>
                                        <th  class="table-plus datatable-nosort">ID</th>
										<th>PMVIC Name</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Role</th>
                                        <th>Status</th>
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

		<!-- ADD -->
		<div
            class="modal fade bs-example-modal-lg"
            id="add-user"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myLargeModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">
                            ADD ACCOUNT RECORD
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-hidden="true"
                        >
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="formUserAdd" enctype="multipart/form-data">
                            <div class="row">
							<div class="col-md-6">
									<div class="form-group">
										<label for="">Select PMVIC Center</label>
											<select name="pmvic" id="pmvic" class="form-control">
												<option value="" class="form-control">Select Center</option>
												<?php foreach($pmvic_name as $row): ?>
														<option value="<?= $row['pmvic_name'] ?>" class="form-control"><?= $row['pmvic_name'] ?></option>
												<?php endforeach;?>
												
											</select>
											<span class="error-pmvic"></span>
									</div>
								</div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" class="form-control" name="username" placeholder="Enter Username">
                                        <span class="error-username"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="text" class="form-control" name="password" placeholder="Enter Password">
                                        <span class="error-password"></span>
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Status</label>
                                            <select name="status" id="status" class="form-control">
												<option value="" class="form-control">Select Status</option>
                                                <option value="INACTIVE" class="form-control">INACTIVE</option>
                                                <option value="ACTIVE" class="form-control">ACTIVE</option>
                                            </select>
                                            <span class="error-status"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
								<div class="col-md-6">
										<div class="form-group">
											<label for="">Account Type</label>
												<select name="role" id="role" class="form-control">
													<option value="" class="form-control">Select Type</option>
													<option value="User" class="form-control">User</option>
													<option value="Administrator" class="form-control">Administrator</option>
												</select>
												<span class="error-role"></span>
										</div>
									</div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Profile Image</label>
                                            <input type="file" class="form-control" name="userProfile">
                                        </div>
                                    </div>
								</div>
                                
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <div class="form-group text-center">
                                            <div class="image-profile"></div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-danger"
                            data-dismiss="modal"
                        >
                            Cancel
                        </button>
                        <button type="Submit" class="btn btn-primary" id="InsertUser">
                            SAVE
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- ADD MODAL -->

		<!-- UPDATE MODAL -->
		<div
            class="modal fade bs-example-modal-lg"
            id="edit-user"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myLargeModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">
                            UPDATE ACCOUNT RECORD
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-hidden="true"
                        >
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="formUserEdit" enctype="multipart/form-data">
                            <div class="row">
							<div class="col-md-6">
									<div class="form-group">
									<input type="hidden" class="form-control" name="user_id" id="user_id">
										<label for="">Select PMVIC Center</label>
											
											<select name="pmvic" id="edit-pmvic" class="form-control">
												<?php foreach($pmvic_name as $row): ?>
														<option class="list-name" value="<?= $row['pmvic_name'] ?>" class="form-control"><?= $row['pmvic_name']?> - <?= $row['pmvic_address']?></option>
												<?php endforeach;?>
												
											</select>
											<span class="error-pmvic"></span>
									</div>
								</div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" class="form-control" name="username" id="username" >
                                        <span class="error-username"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="text" class="form-control" name="password" id="password">
                                        <span class="error-password"></span>
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Status</label>
                                            <select name="status" id="edit-status" class="form-control">
                                                <option value="INACTIVE" class="form-control">INACTIVE</option>
                                                <option value="ACTIVE" class="form-control">ACTIVE</option>
                                            </select>
                                            <span class="error-status"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
								<div class="col-md-6">
										<div class="form-group">
											<label for="">Account Type</label>
												<select name="role" id="edit-role" class="form-control">
													<option value="User" class="form-control">User</option>
													<option value="Administrator" class="form-control">Administrator</option>
												</select>
												<span class="error-role"></span>
										</div>
									</div>
								</div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-danger"
                            data-dismiss="modal"
                        >
                            Cancel
                        </button>
                        <button type="Submit" class="btn btn-primary" id="UpdateUser">
                            UPDATE
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- UPDATE MODAL -->

		        <!-- DELETE MODAL -->

				<div
            class="modal fade "
            id="delete-user"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myLargeModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="myLargeModalLabel">
                            DELETE USER RECORDS
                        </h6>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-hidden="true"
                        >
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        
                            <input type="hidden" class="form-control" name="userIDDeleted" id="userIDDeleted">
                        <div class="col-md-12 text-center">
                            <div id="DataDeleted"></div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-warning"
                            data-dismiss="modal"
                        >
                            Cancel
                        </button>
                        <button type="Submit" class="btn btn-danger" id="DeleteUser">
                            DELETE
                        </button>
                    </div>
                </div>
            </div>
        </div>

		<!-- VIEW MODAL -->

		<div class="modal fade" id="view-user" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body text-center">
					<h4 class="mb-15">
						<i class="fa fa-info-circle"> </i> ACCOUNT VIEW RECORD
					</h4>
					<div id="view-pmvic">

					</div>
					<div id="view-username">

					</div>
					<div id="view-password">

					</div>
					<div id="view-role">

					</div>
					<div id="view-status">

					</div>
					<div id="view-dateUpdate">

					</div>
					</br>
					<button type="button" class="btn btn-dark" data-dismiss="modal">
						BACK
					</button>
				</div>
			</div>
		</div>
	</div>

<?php include('../../backend/layout/inc/footer.php');?>

<script>
$( document ).ready(function() {

        let userData = $('#user_data').DataTable({
            "processing": true,
            "serverSide": true,
            "scrollCollapse": true,
            "autoWidth": false,
            "responsive": true,
            "order": [],
            "ajax": {
                url: "../../../private/controller/user/process-user.php",
                type: "POST"
            },
            "columnDefs": [
                {
                    "targets": "datatable-nosort",
                    "orderable": false,
                },
            ],
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            language: {
            info: "_START_-_END_ of _TOTAL_ entries",
            searchPlaceholder: "Search Here",
            paginate: {
                next: '<i class="ion-chevron-right"></i>',
                previous: '<i class="ion-chevron-left"></i>'  
            }
            },
        });

		$(document).on('click','#InsertUser',function() {
            event.preventDefault();

            let form = $('#formUserAdd')[0];
            let data = new FormData(form);

			checkUserInputs(data)

			if(data.get('pmvic') != '' && data.get('username') != '' && data.get('password') != '' &&
                data.get('status') != '' && data.get('role')){

                     $.ajax({
                        type: "POST",
                        url: "../../../private/controller/user/insert-user.php",
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        async: false,
                        beforeSend: function () {
                            $('#InsertUser').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                            $('#InsertUser').attr("disabled", true);
                            $('#InsertUser').css({ "border-radius": "50%" });
                        },
                        success: function (data) {


                            if(data == 'true'){
                                poUpRightCorner('success', 'Added Successfully.');
                                userData.ajax.reload(); 
                            }else{
                                poUpRightCorner('error', 'Someting Went Wrong!!!.');
                            }
                           
                        },
                        complete: function () {
                            
                            $('#add-user').modal('hide');
                            $('#formUserAdd').trigger("reset");
                            $('#InsertUser').html('Submit');
                            $('#InsertUser').attr("disabled", false);
                            $('#InsertUser').css({ "border-radius": "4px" });
                          
                                
                        },
                        error: function (data) {

                            poUpRightCorner('error', data.statusText);
                }
                    });
                    
            }else{
                return false;
            }

			
		});

		$(document).on('click','.fetch-user',function() {
            event.preventDefault();

			let edit_id = $(this).data('id');
		
			$.ajax({
                method: "POST",
                url: "../../../private/controller/user/fetch-user.php",
                data: {
                    'edit_id': edit_id
                },
				beforeSend: function () {
					//clearSelected();
                },
                success: function (response) {
                    const data = JSON.parse(response);
                    
                    $('#user_id').val(data.user_id);
					$('#password').val(data.password);
                    $('#username').val(data.username);

					let lsitItem = document.querySelectorAll('#edit-pmvic')[0];

                    for (let i = 0; i < lsitItem.length; i++) {
                        let names = lsitItem[i].value;

                        if(names==data.pmvic_name) {
                            lsitItem[i].setAttribute('selected', 'selected');

                            document.querySelector('#edit-pmvic').innerHTML+=lsitItem[i];
                        }
                    }
                        
                    if(data.status=='ACTIVE') {
                        $option = `
                            <option value="ACTIVE" selected>ACTIVE</option>
                            <option value="INACTIVE">INACTIVE</option>
                        `;
                    } else {
                        $option = `
                            <option value="ACTIVE">ACTIVE</option>
                            <option value="INACTIVE" selected>INACTIVE</option>
                        `;
                    }
					$('#edit-status').html($option);

                    if(data.role=='Administrator') {
                        $role=`<option value="User" class="form-control">User</option>
							<option value="Administrator" class="form-control" selected>Administrator</option>`;
                    } else {
                        $role=`<option value="User" class="form-control" selected>User</option>
							<option value="Administrator" class="form-control">Administrator</option>`;
                    }

                    $('#edit-role').html($role);
    

                    $('#edit-user').modal('show');

                },
                error: function (response) {
                    poUpRightCorner('error', 'Error Seleting Data');
                }
            });   
		});

		$(document).on('click','#UpdateUser',function() {
            event.preventDefault();

            let form = $('#formUserEdit')[0];
            let data = new FormData(form);

			checkUserInputs(data);


            if(data.get('pmvic') != '' && data.get('username') != '' && data.get('password') != '' &&
                data.get('status') != '' && data.get('role')){
				
                     $.ajax({
                        type: "POST",
                        url: "../../../private/controller/user/update-user.php",
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        async: false,
                        beforeSend: function () {
                            $('#UpdateUser').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                            $('#UpdateUser').attr("disabled", true);
                            $('#UpdateUser').css({ "border-radius": "50%" });
                        },

                        success: function (data) {

                            //console.log(data);

                            if(data == 'true'){
                                poUpRightCorner('success', 'Update Successfully.');
                                userData.ajax.reload(); 
                            }else{
                                poUpRightCorner('error', 'Someting Went Wrong!!!.');
                            }
                           
                        },
                        complete: function () {
                            
                            $('#edit-user').modal('hide');
                            $('#formUserEdit').trigger("reset");
                            $('#UpdateUser').html('Submit');
                            $('#UpdateUser').attr("disabled", false);
                            $('#UpdateUser').css({ "border-radius": "4px" });        
                        },
                        error: function (data) {

                            poUpRightCorner('error', data.statusText);
							
                }
                    });
                    
            }else{
                return false;
            }  
        });

		$(document).on('click','.view-user',function() {
            event.preventDefault();

            let view_id = $(this).data('id');

            $.ajax({
                method: "POST",
                url: "../../../private/controller/user/fetch-user.php",
                data: {
                    'edit_id': view_id
                },
                success: function (response) {
                    const data = JSON.parse(response);

                   //console.log(data);
                    $('#view-pmvic').html('<h5>Pmvic Name: <b>'+data.pmvic_name+'</b></h5>');
                    $('#view-username').html('<h5>Username: <b>'+data.username+'</b></h5>');
                    $('#view-password').html('<h5>Password: <b>'+data.password+'</b></h5>');
                    $('#view-role').html('<h5>Account Type: <b>'+data.role+'</b></h5>');
                    $('#view-status').html('<h5>Status: <b>'+data.status+'</b></h5>');
					$('#view-dateUpdate').html('<h5>Date Update: <b>'+data.dateUpdate+'</b></h5>');

                    $('#view-user').modal('show');
                    

                },
                error: function (response) {
                    poUpRightCorner('error', 'Error Seleting Data');
                }
            });   
        });

		$(document).on('click','.select-delete-user',function() {
            event.preventDefault();

            let delete_id = $(this).data('id');

            $.ajax({
                method: "POST",
                url: "../../../private/controller/user/fetch-user.php",
                data: {
                    'edit_id': delete_id
                },
                success: function (response) {

                    const data = JSON.parse(response);

                    $('#userIDDeleted').val(data.user_id);
                    $('#DataDeleted').html('<span class="text-center"><h5>Do You Want delete "'+data.username+'"</h5></span>');
                    
                    $('#delete-user').modal('show');

                },
                error: function (response) {
                    poUpRightCorner('error', 'Error Seleting Data');
                }
            });   
        });

		$(document).on('click','#DeleteUser',function() {
            event.preventDefault();

            let delete_id = $('#userIDDeleted').val();

            $.ajax({
                method: "POST",
                url: "../../../private/controller/user/delete-user.php",
                data: {
                    'delete_id': delete_id
                },
                beforeSend: function () {
                            $('#DeleteUser').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                            $('#DeleteUser').attr("disabled", true);
                            $('#DeleteUser').css({ "border-radius": "50%" });
                },
                success: function (data) {
                    if(data == 'true'){
                        userData.ajax.reload(); 
                        poUpRightCorner('success', 'Delete Successfully');
                    }else{
                        poUpRightCorner('error', 'Someting Went Wrong!!!.');
                    }

                },
                complete: function () {

                    $('#delete-user').modal('hide');
                    $('#DeleteUser').html('Submit');
                    $('#DeleteUser').attr("disabled", false);
                    $('#DeleteUser').css({ "border-radius": "4px" });
                           
                },
                error: function (data) {
                    poUpRightCorner('error', data.statusText);
                }
            });   
        });
});

function poUpRightCorner(status, message){
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

    function checkUserInputs(data){
                if($.trim(data.get('pmvic')).length == 0){
                 $('.error-pmvic').html("<small class='ml-3'><span style='color:red;'> Please Please Select Center.</span></small>");
                    setInterval(function(){  
                        $(".error-pmvic").html("");
                    }, 5000);
                        
                }
                if($.trim(data.get('username')).length == 0){
                    $('.error-username').html("<small class='ml-3'><span style='color:red;'> Please type Username.</span></small>");
                        setInterval(function(){  
                            $(".error-username").html("");
                        }, 5000);
                }
                if($.trim(data.get('password')).length == 0){
                    $('.error-password').html("<small class='ml-3'><span style='color:red;'> Please type Password.</span></small>");
                        setInterval(function(){  
                            $(".error-password").html("");
                        }, 5000);
                }
                if($.trim(data.get('status')).length == 0){
                    $('.error-status').html("<small class='ml-3'><span style='color:red;'> Please type Status.</span></small>");
                        setInterval(function(){  
                            $(".error-status").html("");
                        }, 5000);
                }


                if($.trim(data.get('role')).length == 0){
                    $('.error-role').html("<small class='ml-3'><span style='color:red;'> Please Select Role.</span></small>");
                        setInterval(function(){  
                            $(".error-role").html("");
                        }, 5000);
                }
            }
	function clearSelected(){

		$('#edit-pmvic option:selected').append('<option value="" selected ></option>');
		$('#edit-status option:selected').html("");
		$('#edit-role option:selected').html("");
	}

</script>