<?php
	 session_start();

	 if(isset($_SESSION['userdata'])){
        if($_SESSION['userdata']['access'] == 'Administrator'){

            echo "<script> window.location.href = 'pages/Admin/';</script>";
        }else if($_SESSION['userdata']['access'] == 'User'){
            echo "<script> window.location.href = 'pages/User/';</script>";
        }else{
            
        }
		
	 }
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>LOGIN</title>

		<!-- Site favicon -->
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="backend/vendors/images/favicon/apple-touch-icon.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="backend/vendors/images/favicon/favicon-32x32.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="backend/vendors/images/favicon/favicon-16x16.png"
		/>

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="backend/vendors/styles/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="backend/vendors/styles/icon-font.min.css"
		/>
		<link rel="stylesheet" type="text/css" href="backend/vendors/styles/style.css" />


	</head>
	<body class="login-page">
		<div class="login-header box-shadow">
			<div
				class="container-fluid d-flex justify-content-between align-items-center"
			>
				<div class="brand-logo">
					<a href="login.html">
						<img src="backend/vendors/images/logo.jpg" alt="" />
					</a>
				</div>
			</div>
		</div>
		<div
			class="login-wrap d-flex align-items-center flex-wrap justify-content-center"
		>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-6 col-lg-7">
						<img src="backend/vendors/images/login-page-img.png" alt="" />
					</div>
					<div class="col-md-6 col-lg-5">
						<div class="login-box bg-white box-shadow border-radius-10">
							<div class="login-title">
								<h2 class="text-center text-primary">Login To Systech</h2>
							</div>
							<form id="loginForm">
                            <small id="error_username"></small>
								<div class="input-group custom">
									<input
										type="text" name="username" id="username"
										class="form-control form-control-lg"
										placeholder="Username"
									/>
									<div class="input-group-append custom">
										<span class="input-group-text"
											><i class="icon-copy dw dw-user1"></i
										></span>
									</div>
								</div>
                                <small id="error_password"></small>
								<div class="input-group custom">
									<input
										type="password" name="password" id="password"
										class="form-control form-control-lg"
										placeholder="**********"
									/>
									<div class="input-group-append custom">
										<span class="input-group-text"
											><i class="dw dw-padlock1"></i
										></span>
									</div>
								</div>
                                <div class="text-center alert-danger">
										<span id="error_message"></span>
									</div>
								<div class="row pb-30">
									<div class="col-6">
										<div class="custom-control custom-checkbox">
											<input
												type="checkbox"
												class="custom-control-input"
												id="customCheck1"
											/>
											<label class="custom-control-label" for="customCheck1"
												>Remember</label
											>
										</div>
									</div>
									<div class="col-6">
										<div class="forgot-password">
											<a href="forgot-password.html">Forgot Password</a>
										</div>
									</div>
								</div>
                               
								<div class="row">
									<div class="col-sm-12">
										<div class="input-group mb-0">
											<!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										
											<a class="btn btn-primary btn-lg btn-block" id="loginbtn">LOGIN</a>-->
                                            <button type="submit" id="loginbtn" class="btn btn-primary btn-lg btn-block">LOGIN</button>
										</div>
									</div>
								</div>
                                
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- js -->
		<script src="backend/vendors/scripts/core.js"></script>
		<script src="backend/vendors/scripts/script.min.js"></script>
		<script src="backend/vendors/scripts/process.js"></script>
		<script src="backend/vendors/scripts/layout-settings.js"></script>
	
	</body>
</html>


<script>
    $(document).ready(function(){
    $('#loginForm').submit(function(event){
        event.preventDefault();
        let data = $( "Form" ).serialize();
        
        $.ajax({
            type: "POST",
            url: "../private/controller/login.php",
            data: data,
            cache: false,
            beforeSend: function() {
                // setting a timeout
                $("#loginbtn").html('loading......');
               
            },
            success: function(data,status,xhr)
            {
                $("#loginbtn").html('Login');
                let newData = JSON.parse(data);
                
                if(newData == "NoUser"){
                    $("#error_username").html("<span style='color:red;'>Email required</span>");
                    $("#username").css('border-color', 'red');
                    setInterval(function(){  
                        $("#error_username").html("");
                        $("#username").css('border-color', '');
                     }, 3000);
                }else if(newData == "NoPass"){
                    $("#error_password").html("<span style='color:red;'>Password required</span><br/>");
                    $("#password").css('border-color', 'red');
                    setInterval(function(){  
                        $("#error_password").html("");
                        $("#password").css('border-color', '');
                     }, 3000);
                }else if(newData == 0){
                    $("#error_message").html("<span style='color:red; font-weight:1000px;'>Incorrect Password. Please try Again</span>");
                    setInterval(function(){  
                        $("#error_message").html("");
                     }, 3000);
                }else if(newData.access == 'Administrator'){

                        window.location.replace('pages/Admin/')
                    
                }else if(newData.access == 'User'){

                        window.location.replace('pages/User/user-dashboard.php')
                }
          
            },
            error:function(xhr,status,error){
                console.log(error);
            }
        

    });

    })
});
</script>
