<div class="left-side-bar">
	<div class="brand-logo">
		<a href="index.html">
			<img src="../../backend/vendors/images/logo.jpg" alt="" class="dark-logo" />
			<img src="../../backend/vendors/images/logo.jpg" alt="" class="light-logo" />
		</a>
		<div class="close-sidebar" data-toggle="left-sidebar-close">
			<i class="ion-close-round"></i>
		</div>
	</div>
	<div class="menu-block customscroll">
		<div class="sidebar-menu">
			<ul id="accordion-menu">
				<?php

				if ($_SESSION['userdata']['access'] == 'Administrator') {
				?>
					<li class="dropdown">
						<a class="dropdown-toggle no-arrow" href="index.php">
							<span class="micon fa fa-dashboard"></span><span class="mtext">Home</span>
						</a>
					</li>


					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon fa fa-home"></span><span class="mtext">PMVIC Center</span>
						</a>
						<ul class="submenu">
							<li>
								<a class="dropdown-toggle no-arrow" href="location.php">
									<span class="micon fa fa-map"></span>Location List</span>
								</a>
							</li>
							<li>
								<a class="dropdown-toggle no-arrow" href="center.php">
									<span class="micon fa fa-home"></span>PMVIC Center
								</a>
							</li>
							<li>
								<a class="dropdown-toggle no-arrow" href="user.php">
									<span class="micon fa fa-users"></span>PMVIC User List
								</a>
							</li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon fa fa-home"></span><span class="mtext">PMVIC UPLOADS</span>
						</a>
						<ul class="submenu">
							<li>
								<a class="dropdown-toggle no-arrow" href="today-pmvic-record.php">
									<span class="micon fa fa-map"></span>Today records</span>
								</a>
							</li>
							<li>
								<a class="dropdown-toggle no-arrow" href="reupload.php">
									<span class="micon fa fa-home"></span>All PMVIC Datas
								</a>
							</li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon fa fa-file-pdf-o"></span><span class="mtext">Duplicates</span>
						</a>
						<ul class="submenu">
							<li>
								<a class="dropdown-toggle no-arrow" href="daily-duplicates.php">
									<span class="micon fa fa-file-pdf-o"></span>Daily Duplicates</span>
								</a>
							</li>
							<li>
								<a class="dropdown-toggle no-arrow" href="all-duplicates.php">
									<span class="micon fa fa-file-pdf-o"></span>All Duplicates
								</a>
							</li>
						</ul>
					</li>


					<li class="dropdown">
						<a class="dropdown-toggle no-arrow" href="reports.php">
							<span class="micon fa fa-file-pdf-o"></span><span class="mtext">Upload Report</span>
						</a>
					</li>

					<li class="dropdown">
						<a class="dropdown-toggle no-arrow" href="invoice.php">
							<span class="micon bi bi-receipt"></span><span class="mtext">Generate Billing/Invoice</span>
						</a>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon fa fa-file-pdf-o"></span><span class="mtext">Utilities</span>
						</a>
						<ul class="submenu">

							<li>
								<a class="dropdown-toggle no-arrow" href="#">
									<span class="micon fa fa-file-pdf-o"></span>User Logs</span>
								</a>
							</li>

							<li>
								<a class="dropdown-toggle no-arrow" href="deleted-pmvic.php">
									<span class="micon fa fa-file-pdf-o"></span>Deleted PMVIC Data
								</a>
							</li>
						</ul>
					</li>

					<li class="dropdown">
						<a class="dropdown-toggle no-arrow" href="settings.php">
							<span class="micon ti-settings"></span><span class="mtext">Settings</span>
						</a>
					</li>
				<?php
				} else {
				?>

					<li class="dropdown">
						<a class="dropdown-toggle no-arrow" href="user-dashboard.php">
							<span class="micon fa fa-dashboard"></span><span class="mtext">dashboard</span>
						</a>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle no-arrow" href="user-upload.php">
							<span class="micon fa fa-cloud-upload"></span><span class="mtext">Upload</span>
						</a>
					</li>

					<li class="dropdown">
						<a class="dropdown-toggle no-arrow" href="all-uploads.php">
							<span class="micon bi bi-upload"></span><span class="mtext">All Uploads</span>
						</a>
					</li>

					<li class="dropdown">
						<a class="dropdown-toggle no-arrow" href="daily-duplicates.php">
							<span class="micon fa fa-file-pdf-o"></span><span class="mtext">Daily Duplicates</span>
						</a>
					</li>

					<li class="dropdown">
						<a class="dropdown-toggle no-arrow" href="invoice.php">
							<span class="micon bi bi-receipt"></span><span class="mtext">Generate Billing/Invoice</span>
						</a>
					</li>

				<?php
				}
				?>
			</ul>
		</div>
	</div>
</div>