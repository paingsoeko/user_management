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
				<a href="users.php" class="btn btn-primary float-end mt-n1"><i class="fas fa-arrow-left"></i> Back</a>
					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Add user</h1>
					</div>
				<form class="needs-validation" novalidate="" method="post" action="user-create.php">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<?php 
										if(isset($_POST['create_user'])) {
                                            echo create_user();
                                        }
									?>
									<h5 class="card-title">Basic Info</h5>
								</div>
								<div class="card-body">
									<div class="row g-3 ">
										<div class="col-md-2">
											<label for="prefix" class="form-label">Prefix:</label>
											<select class="form-select" name="prefix" id="prefix">
												<option selected="" disabled="" value="">Choose...</option>
												<option value="Mr">Mr</option>
												<option value="Mrs">Mrs</option>
												<option value="Miss">Miss</option>
											</select>
                                        </select>
										</div>
										<div class="col-md-5">
											<label for="firstName" class="form-label">First Name:*</label>
											<input type="text" name="firstName" class="form-control" id="firstName" placeholder="First Name" required="">
											<div class="invalid-feedback">
												Please enter your first name.
											</div>
										</div>
										<div class="col-md-5">
											<label for="lastName" class="form-label">Last Name:</label>
											<input type="text" name="lastName" class="form-control" id="lastName" placeholder="Last Name">
										</div>
										<div class="col-md-2">
											<label for="gender" class="form-label">Gender:</label>
											<select class="form-select" name="gender" id="role">
												<option selected="" disabled="" value="">Choose...</option>
												<option value="0">Male</option>
												<option value="1">Female</option>
												<option value="2">Rather not say</option>
											</select>
										</div>
										<div class="col-md-5">
												<label class="form-label">Email Address</label>
												<input type="text" name="email" class="form-control" data-inputmask="'alias': 'email'">
										</div>
										<div class="col-md-5">
											<label for="username" class="form-label">Phone:</label>
											<div class="input-group">
												<span class="input-group-text" id="inputUser">09</span>
												<input type="text" name="phone" class="form-control" id="username" aria-describedby="inputUser">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-check form-switch mt-4 pt-3">
											<input class="form-check-input" name="is_active" type="checkbox" id="flexSwitchCheckChecked" checked="">
											<label class="form-check-label" for="flexSwitchCheckChecked">Is active ?</label>
										</div>
										</div>
									</div>
								</div>
							</div>

							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Roles and Permissions</h5>
								</div>
								<div class="card-body">
									<div class="row g-3">
										<div class="col-md-4">
											<label for="username" class="form-label">Username:</label>
											<div class="input-group">
												<span class="input-group-text" id="inputUser">@</span>
												<input type="text" name="username" class="form-control" id="username" aria-describedby="inputUser" required="">
												<div class="invalid-feedback">
													Please enter username.
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<label for="password" class="form-label">Password:*</label>
											<input type="password" name="password" partner="a" class="form-control" id="password" required="">
										</div>
										<div class="col-md-4">
											<label for="confirmPassword" class="form-label">Confirm Password:*</label>
											<input type="password" name="confirmPassword" partner="a" class="my-form-control" id="confirmPassword" data-error="The passwords do not match." required="">
											<div class="invalid-feedback">The passwords do not match.</div>
										</div>
										<div class="col-md-3">
											<label for="role" class="form-label">Role:*</label>
											<select class="form-select" name="role" id="role" required="">
												<option selected="" disabled="" value="">Choose...</option>
												<?php $rows_data = fetch_all_role();
													if($rows_data -> num_rows > 0){
														foreach($rows_data as $row){
                                                            ?>
															<option <?php if($row['name']=="Default Administrator" && $_SESSION['session_role']>1){echo "disabled";}  ?> value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
															<?php
														}
													}
												?>
											</select>
										</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center">
							<button name="create_user" class="btn btn-primary btn-lg" type="submit">Create User Account</button>
						</div>
					</div>
				</form>

				</div>
			</main>
<script>
		(function() {
			'use strict';
			window.addEventListener('load', function() {
				// Fetch all the forms we want to apply custom Bootstrap validation styles to
				var forms = document.getElementsByClassName('needs-validation');
				// Fetch the partner-IDs of the inputs to be compared against each other
				var ids = jQuery.unique($('[partner]').map(function() {
				return $(this).attr('partner');
				}).get());

				// Loop over them and prevent submission
				var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {

					var i;
					var c = false;

					// Handle the initial form
					for (i = 0; i < ids.length; ++i) {
					var p = $('[partner=' + ids[i] + ']');
					if ((p[0].value !== '' && p[1].value === '') ||
						(p[0].value === '' && p[1].value !== '') ||
						(p[0].value === '' && p[1].value === '') ||
						(p[0].value !== p[1].value)) {
						p[1].classList.remove('match');
						p[1].classList.add('no-match');
						c = false;
					} else {
						p[1].classList.remove('no-match');
						p[1].classList.add('match');
						c = true;
					}
					}

					// Handle changes in the form
					$('[partner]').on('keyup', function() {
					for (i = 0; i < ids.length; ++i) {
						var p = $('[partner=' + ids[i] + ']');
						c = false;
						if ((p[0].value !== '' && p[1].value === '') ||
						(p[0].value === '' && p[1].value !== '') ||
						(p[0].value === '' && p[1].value === '') ||
						(p[0].value !== p[1].value)) {
						c = false;
						p[1].classList.remove('match');
						p[1].classList.add('no-match');
						} else {
						c = true;
						p[1].classList.remove('no-match');
						p[1].classList.add('match');
						}
					}
					});

					if (form.checkValidity() === false || c === false) {
					event.preventDefault();
					event.stopPropagation();
					}
					form.classList.add('was-compared');
					form.classList.add('was-validated');
				}, false);
				});
			}, false);
			})();
	</script>
<?php include file_patch()."template/footer.php" ?>