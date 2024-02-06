<div class="footer-wrap pd-20 mb-20 card-box" id="footer">
	PMVIC - Powered By
	<a href="#" target="_blank">SYSTECH</a>
</div>
</div>
</div>
<!-- welcome modal start -->

<!-- welcome modal end -->
<!-- js -->
<script src="../../backend/vendors/scripts/core.js"></script>
<script src="../../backend/vendors/scripts/script.min.js"></script>
<script src="../../backend/vendors/scripts/process.js"></script>
<script src="../../backend/vendors/scripts/layout-settings.js"></script>
<script src="../../backend/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="../../backend/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="../../backend/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="../../backend/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>



<!-- buttons for Export datatable -->
<script src="../../backend/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="../../backend/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="../../backend/src/plugins/datatables/js/buttons.print.min.js"></script>
<script src="../../backend/src/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="../../backend/src/plugins/datatables/js/buttons.flash.min.js"></script>
<script src="../../backend/src/plugins/datatables/js/pdfmake.min.js"></script>
<script src="../../backend/src/plugins/datatables/js/vfs_fonts.js"></script>

<!-- add sweet alert js & css in footer -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>

<script>
	$(document).on('click', '#logout', function() {
		Swal.fire({
			title: 'Are you sure to logout',
			text: "",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'YES'
		}).then((result) => {
			if (result.isConfirmed) {

				logout();
				Swal.fire(
					'Logout',
					'',
					'success'
				)

			}
		})

		function logout() {
			$.ajax({
				url: "../../../private/controller/logout.php",
				type: 'GET',
				success: function(response) {
					location.reload();
				}
			});
		}

	});
</script>