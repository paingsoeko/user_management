<?php
$result = fetch_role_permissions($_SESSION['session_role']);
if($result -> num_rows > 0){
    foreach($result as $row){
        $permissions_id[] = $row['permissions_id'];
    }
}
?>
<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a href="index.html" class="text-muted"><strong>KO-PAING</strong></a>
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="#">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<script src="<?php echo url(); ?>js/app.js"></script>
	<script src="<?php echo url(); ?>js/datatables.js"></script>

<?php
if (in_array(21, $permissions_id)){
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Datatables with Buttons
            var datatablesButtons = $("#datatables-buttons").DataTable({
                responsive: true,
                lengthChange: !1,
                buttons: [
                    'copy',
                    'csv',
                    'excel',
                    'print'
                ]
            });
            datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)");
        });
    </script>

<?php } ?>

<script>


			function alertMsg(msg, type, duration) {
				var message = msg;
				var type = type;
				var duration = duration;	
				var dismissible = 1;
				var positionX = 'right';
				var positionY = 'top';
				window.notyf.open({
					message,
					type,
					duration,
					dismissible,
					position: {
						x: positionX,
						y: positionY
					}
				});
				
			};

			
	
	</script>

</body>
</html>