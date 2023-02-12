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
?>


<main class="content">
				<div class="container-fluid p-0">
				<a href="roles.php" class="btn btn-primary float-end mt-n1"><i class="fas fa-arrow-left"></i> Back</a>
					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Add Role</h1>
						<?php 
							if(isset($_POST['create_role'])){
								echo create_role();
							}
						?>
					</div>
				<form method="post" action="role-create.php">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<div class="row g-3 ">
										<div class="row g-3">
											<div class="col-md-5">
												<label for="role" class="form-label">Role Name:*</label>
												<input type="text" name="name" class="form-control" id="role" placeholder="Role Name" required>
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
													<input class="form-check-input checkbox-group-1" name="viewButtons" type="checkbox" value="21">
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
													<input class="form-check-input checkbox-group-2" name="viewUser" type="checkbox" value="1">
													<span class="form-check-label">
														View user
													</span>
												</label>
												<label class="form-check">
													<input class="form-check-input checkbox-group-2" name="addUser" type="checkbox" value="2">
													<span class="form-check-label">
														Add user
													</span>
												</label>
												<label class="form-check">
													<input class="form-check-input checkbox-group-2" name="editUser" type="checkbox" value="3">
													<span class="form-check-label">
														Edit user
													</span>
												</label>
												<label class="form-check">
													<input class="form-check-input checkbox-group-2" name="deleteUser" type="checkbox" value="4">
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
													<input class="form-check-input checkbox-group-3" name="viewRole" type="checkbox" value="5">
													<span class="form-check-label">
														View role
													</span>
												</label>
												<label class="form-check">
													<input class="form-check-input checkbox-group-3" name="addRole" type="checkbox" value="6">
													<span class="form-check-label">
														Add role
													</span>
												</label>
												<label class="form-check">
													<input class="form-check-input checkbox-group-3" name="editRole" type="checkbox" value="7">
													<span class="form-check-label">
														Edit role
													</span>
												</label>
												<label class="form-check">
													<input class="form-check-input checkbox-group-3" name="deleteRole" type="checkbox" value="8">
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
							<button class="btn btn-primary btn-lg" name="create_role" type="submit">Create New Role</button>
						</div>
					</div>
				</form>

				</div>
			</main>

		

	<script>
		for (let i = 1; i <= 5; i++) {
		document.getElementById(`select-all-${i}`).addEventListener('click', function() {
			const checkboxes = document.querySelectorAll(`.checkbox-group-${i}`);
			for (let j = 0; j < checkboxes.length; j++) {
			checkboxes[j].checked = this.checked;
			}
		});
		}
	</script>

<?php include file_patch()."template/footer.php" ?>