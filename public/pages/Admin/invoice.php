<?php include('../../backend/layout/inc/header.php');
if ($_SESSION['userdata']['access'] != 'Administrator') {
	echo "<script> window.location.href = '../../';</script>";
	die();
}



include('../../../private/initialize.php');

$get_pmvic_name = new Center();
$pmvic_name = $get_pmvic_name->get_Center_Name();

?>

<title>PMVIC BILLING</title>

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
								<h4 class="text-center" data-color="#3033af">PMVIC BILLING</h4>
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
											<?php foreach ($pmvic_name as $row) :?>
												<option value="<?= $row['pmvic_name'] . ' - ' . $row['pmvic_address'] ?>" class="form-control"><?= $row['pmvic_name'] . ' - ' . $row['pmvic_address'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-3 mt-4">
								<div>
									<button id="search" class="btn btn-info"><i class="icon-copy fa fa-filter" aria-hidden="true"></i> FILTER</button>
									<button id="printButton" class="btn btn-success"><i class="icon-copy fa fa-print" aria-hidden="true"></i> PRINT</button>
									<div class="d-none" id="conatinerFrame"></div>
								</div>
							</div>
						</div>


						<div class="invoice-wrap" id="content">
							<div class="invoice-box">
								<div class="invoice-header">
									<div class="logo text-center">
										<div class="row mt-4">
											<div class="col-md-12 text-center">
												<img width="310px" src="../../backend/img/logo.jpg" alt="logo">
												<h5><strong>SYSTECH IT SOLUTION AND SERVICES CORP.</strong></h5>
												<h6>72 RICHMAK BLG MINDANAO AVENUE, PROJECT 6 QUEZON CITY</h6>
												<p>Tel No.:02-828-593-60</p>
											</div>

											<div class="col-md-12 text-center">
												<h5><strong>STATEMENT OF ACCOUNT</strong></h5>
											</div>

											<div class="col-md-12 text-center">
												<p>Billing Period <br>
													<span id="dates">Sept 25, 2023 - Sept 29, 2023</span>
												</p>
											</div>
										</div>
									</div>
								</div>

								<div class="row pb-10">
									<div class="col-md-6">
										<h5 class="mb-5"><span id="pmvicName"></span></h5>
										<p class="font-14 mb-5">
											<span id="pmvicAddres"></span>
										</p>

									</div>
									<div class="col-md-6">
										<div class="text-right">
											<p class="font-14 mb-5">
												Date Issued: <strong class="weight-600"><?= date('M, d Y') ?></strong>
											</p>
											<p class="font-14 mb-3">
												Transation No: <strong class="weight-600">4556</strong>
											</p>
										</div>
									</div>
								</div>

								<div class="row mb-4">
									<div class="col-md-12 text-center">
										<h5>Summary of Uploaded Vehicles</h5>
									</div>
								</div>

								<div class="invoice-desc pb-10">
									<div class="invoice-desc-head clearfix">
										<div class="invoice-sub">DATE</div>
										<div class="invoice-rate">TOTAL UPLOAD</div>
										<div class="invoice-hours">UPLOAD RATE</div>
										<div class="invoice-subtotal">TOTAL AMOUNT</div>
									</div>
									<div class="invoice-desc-body">
										<ul id="itemList">
											<?php for ($i = 0; $i < 4; $i++) : ?>
												<li class="clearfix">
													<div class="invoice-sub"><?= date('Y-m-d', strtotime('+' . ($i - 5) . ' day', strtotime(date('Y-m-d')))) ?></div>
													<div class="invoice-rate">0</div>
													<div class="invoice-hours">0</div>
													<div class="invoice-subtotal">
														<span class="weight-600">0</span>
													</div>
												</li>
											<?php endfor; ?>
										</ul>
									</div>
									<div class="invoice-desc-footer">
										<div class="invoice-desc-head clearfix">
											<div class="invoice-sub">Bank Info</div>
											<div class="invoice-rate"></div>
											<div class="invoice-subtotal">Total Due</div>
										</div>
										<div class="invoice-desc-body">
											<ul>
												<li class="clearfix">
													<div class="invoice-sub">
														<p class="font-14 mb-5">
															Account No:
															<strong class="weight-600">123 456 789</strong>
														</p>
														<p class="font-14 mb-5">
															Code: <strong class="weight-600">4556</strong>
														</p>
													</div>
													<div class="invoice-rate font-20 weight-600">

													</div>
													<div class="invoice-subtotal">
														<span class="weight-600 font-24 text-black">Php <span id="totalDue">0.00</span></span>
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="footer text-center">
									<h6 class="text-center pb-6">Please remit check payment payable to: <strong>SYSTECH IT SOLUTION AND SERVICES CORP.</strong></h6>
									<p class="pt-10"><strong>PNB ( Account #:2342345345 )</strong></p>
									<p> Please viber/email us the validated deposit slip within two days after the date deposited to: </p>

									<p>
										<strong>
											Viber: 0997 826 5901
											<br>
											Email: systechitsolutionandservices@gmail.com <br>
											Email: systechitsolutioncorp@yahoo.com
										</strong>
									</p>
								</div>
							</div>
						</div>
						<!-- -->
					</div>
				</div>
			</div>
			<!-- -->
			<!-- Simple Datatable End -->
		</div>

		<?php include('../../backend/layout/inc/footer.php'); ?>

		<script>
			$(document).on('click', '#search', function() {

				let startdate = $('#start_date').val();
				let enddate = $('#end_date').val();
				let selectPmvic = $('#select_pmvic').val();

				let arrPmvic = selectPmvic.split("-");


				if (startdate != '' && enddate != '' && selectPmvic != '') {
					$.ajax({
						method: "POST",
						url: "../../../private/controller/invoice/fetch-invoice.php",
						data: {
							'startdate': startdate,
							'enddate': enddate,
							'selectPmvic': arrPmvic[0].trim()
						},
						success: function(response) {
							const data = JSON.parse(response);
							showListItem(data);
							$('#pmvicName').html(arrPmvic[0])
							$('#pmvicAddres').html(arrPmvic[1])

							function dateToYMD(date) {
								var strArray = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
								var d = date.getDate();
								var m = strArray[date.getMonth()];
								var y = date.getFullYear();
								return '' + m + ' ' + (d <= 9 ? '0' + d : d) + ', ' + y;
							}

							$('#dates').html(`${dateToYMD(new Date(startdate))} - ${dateToYMD(new Date(enddate))}`)
						},
						error: function(response) {
							poUpRightCorner('error', 'Error Seleting Data');
						}
					});
				} else {
					alert('Empty one or more fields');
				}

				const showListItem = (data) => {
					let result = '';
					let total = 0;
					data.map(el => {
						result += `
						<li class="clearfix">
							<div class="invoice-sub">${el.date}</div>
							<div class="invoice-rate">${el.count}</div>
							<div class="invoice-hours">${el.price}</div>
							<div class="invoice-subtotal">
								<span class="weight-600">${el.total_price}</span>
							</div>
						</li>
					`;

						total += parseInt(el.total_price);
					})

					document.querySelector('#itemList').innerHTML = result;
					document.querySelector('#totalDue').innerHTML =  String(total).replace(/(.)(?=(\d{3})+$)/g,'$1,');
				}
			});



			$("#printButton").click(function() {
				var contentToPrint = $("#content").html();
				var iframe = $("<iframe>");

				$("#conatinerFrame").append(iframe);

				var iframeDoc =
					iframe[0].contentDocument || iframe[0].contentWindow.document;

				iframeDoc.write(`
			<html>
			<head>

		
					<link rel="stylesheet" type="text/css" href="../../backend/vendors/styles/core.css" />
					<link
						rel="stylesheet"
						type="text/css"
						href="../../backend/src/plugins/datatables/css/dataTables.bootstrap4.min.css"
					/>
					<link
						rel="stylesheet"
						type="text/css"
						href="../../backend/src/plugins/datatables/css/responsive.bootstrap4.min.css"
					/>
					<link rel="stylesheet" type="text/css" href="../../backend/vendors/styles/style.css" />
				</head>
				<body>
				`);

				iframeDoc.write(contentToPrint);
				iframeDoc.write(`</body></html>`);
				iframeDoc.close();

				iframe[0].contentWindow.print();
			});
		</script>