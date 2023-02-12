<?php
session_start();
require_once "../core/functions.php";
if (!isset($_SESSION['loggedin'])) {
    header('location:'.url().'index.php');
    exit;
}
include file_patch()."template/header.php";
include file_patch()."template/sidebar.php";
include file_patch()."template/navbar.php";

$row = fetch_role($_GET['id']);
$data = $row -> fetch_assoc();


$row1 = fetch_role_permissions($_GET['id']);
$data1 = $row1 -> fetch_assoc();


if($row1 -> num_rows > 0){
	foreach($row1 as $row){
        $premission[] = $row['permissions_id'];
	}
}
?>


<main class="content">
				<div class="container-fluid p-0">
				<a href="roles.php" class="btn btn-primary float-end mt-n1"><i class="fas fa-arrow-left"></i> Back</a>
					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Edit Role</h1>
                        <?php
                        if (isset($_POST['edit_role'])){edit_role();};
                        ?>
					</div>
					<form method="post" action="role-edit.php?id=<?php echo $data['id']; ?>">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<div class="row g-3 ">
										<div class="row g-3">
											<div class="col-md-5">
												<label for="role" class="form-label">Role Name:</label>
												<input type="text" name="name" class="form-control" id="role" value="<?php echo $data['name'] ?>" placeholder="Role Name" required>
											</div>
										</div>
										<div class="row g-3">
											<div class="col-md-3">
												<label>Permissions:</label>
											</div>
										</div>
										<div class="row g-3">
											<div class="col-md-1">
												<h4>Other</h4>
											</div>
											<div class="col-md-2">
											</div>
											<div class="col-md-9">
												<label class="form-check">
													<input <?php echo in_array(21, $premission) ? 'checked' : ''; ?> class="form-check-input checkbox-group-1" name="viewButtons" type="checkbox" value="21">
													<span class="form-check-label">
														View export to buttons (csv/excel/print/pdf) on tables
													</span>
												</label>
											</div>
										</div>
										<hr>
										<div class="row g-3">
											<div class="col-md-1">
												<h4>User</h4>
											</div>
											<div class="col-md-2">
												<label class="form-check">
													<input class="form-check-input" type="checkbox" id="select-all-2">
													<span class="form-check-label">
														Select All
													</span>
												</label>
											</div>
											<div class="col-md-9">
												<label class="form-check">
													<input <?php echo in_array(1, $premission) ? 'checked' : ''; ?> class="form-check-input checkbox-group-2" name="viewUser" type="checkbox" value="1">
													<span class="form-check-label">
														View user
													</span>
												</label>
												<label class="form-check">
													<input <?php echo in_array(2, $premission) ? 'checked' : ''; ?> class="form-check-input checkbox-group-2" name="addUser" type="checkbox" value="2">
													<span class="form-check-label">
														Add user
													</span>
												</label>
												<label class="form-check">
													<input <?php echo in_array(3, $premission) ? 'checked' : ''; ?> class="form-check-input checkbox-group-2" name="editUser" type="checkbox" value="3">
													<span class="form-check-label">
														Edit user
													</span>
												</label>
												<label class="form-check">
													<input <?php echo in_array(4, $premission) ? 'checked' : ''; ?> class="form-check-input checkbox-group-2" name="deleteUser" type="checkbox" value="4">
													<span class="form-check-label">
														Delete user
													</span>
												</label>
											</div>
										</div>
									<hr>
										<div class="row g-3">
											<div class="col-md-1">
												<h4>Role</h4>
											</div>
											<div class="col-md-2">
												<label class="form-check">
													<input class="form-check-input checkAll" type="checkbox" id="select-all-3">
													<span class="form-check-label">
														Select All
													</span>
												</label>
											</div>
											<div class="col-md-9">
												<label class="form-check">
													<input <?php echo in_array(5, $premission) ? 'checked' : ''; ?> class="form-check-input checkbox-group-3" name="viewRole" type="checkbox" value="5">
													<span class="form-check-label">
														View role
													</span>
												</label>
												<label class="form-check">
													<input <?php echo in_array(6, $premission) ? 'checked' : ''; ?> class="form-check-input checkbox-group-3" name="addRole" type="checkbox" value="6">
													<span class="form-check-label">
														Add role
													</span>
												</label>
												<label class="form-check">
													<input <?php echo in_array(7, $premission) ? 'checked' : ''; ?> class="form-check-input checkbox-group-3" name="editRole" type="checkbox" value="7">
													<span class="form-check-label">
														Edit role
													</span>
												</label>
												<label class="form-check">
													<input <?php echo in_array(8, $premission) ? 'checked' : ''; ?> class="form-check-input checkbox-group-3" name="deleteRole" type="checkbox" value="8">
													<span class="form-check-label">
														Delete role
													</span>
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center">
							<button class="btn btn-primary btn-lg" name="edit_role" type="submit">Update</button>
						</div>
					</div>
				</form>

				</div>
			</main>
			<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.querySelectorAll('.needs-validation')
			// Loop over them and prevent submission
			Array.prototype.slice.call(forms)
				.forEach(function(form) {
					form.addEventListener('submit', function(event) {
						if (!form.checkValidity()) {
							event.preventDefault()
							event.stopPropagation()
						}
						form.classList.add('was-validated')
					}, false)
				});
					var elements = document.getElementById("#checkAll");
                    console.log(elements);
					for (var i = 0, len = elements.length; i < len; i++) {
    				elements [i].addEventListener("click", function() {
							console.log("work".i);
    				});
  }

		});
	</script>

<?php include file_patch()."template/footer.php" ?>