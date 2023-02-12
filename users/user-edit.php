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

$row = fetch_user($_GET['id']);
$data = $row -> fetch_assoc();
?>


<main class="content">
				<div class="container-fluid p-0">
				<a href="users.php" class="btn btn-primary float-end mt-n1"><i class="fas fa-arrow-left"></i> Back</a>
					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Edit user</h1>
					</div>
				<form method="post" action="user-edit.php?id=<?php echo $data['id'] ?>">
					<div class="row">
						<div class="col-12">
							<div class="card">
									<?php 
										if(isset($_POST['edit_user'])){
											echo edit_user();
										}
									?>
								<div class="card-header">
									<h5 class="card-title">Basic Info</h5>
								</div>
								<div class="card-body">
									<div class="row g-3 ">
									<div class="col-md-2">
											<label for="prefix" class="form-label">Prefix:</label>
											<select class="form-select" name="prefix" id="prefix">
												<option selected="" disabled="" value="">Choose...</option>
												<option <?php echo str_starts_with($data['name'], 'Mr') ? 'selected' : '' ?> value="Mr">Mr</option>
												<option <?php echo str_starts_with($data['name'], 'Mrs') ? 'selected' : '' ?> value="Mrs">Mrs</option>
												<option <?php echo str_starts_with($data['name'], 'Miss') ? 'selected' : '' ?> value="Miss">Miss</option>
											</select>
                                        </select>
										</div>
										<div class="col-md-5">
											<label for="firstName" class="form-label">First Name:*</label>
											<input type="text" name="firstName" class="form-control" id="firstName" value="<?php echo str_replace(checkPrefix($data['name']), '', $data['name']) ?>" placeholder="First Name">
										</div>
										<div class="col-md-5">
											<label for="lastName" class="form-label">Last Name:</label>
											<input type="text" name="lastName" class="form-control" id="lastName" placeholder="Last Name">
										</div>
										<div class="col-md-2">
											<label for="gender" class="form-label">Gender:</label>
											<select class="form-select" name="gender" id="role">
												<option selected="" disabled="" value="">Choose...</option>
												<option  <?php echo $data['gender']==0 ? 'selected' : '' ?> value="0">Male</option>
												<option <?php echo $data['gender']==1 ? 'selected' : '' ?> value="1">Female</option>
												<option <?php echo $data['gender']==2 ? 'selected' : '' ?> value="2">Rather not say</option>
											</select>
										</div>
										<div class="col-md-5">
												<label class="form-label">Email Address</label>
												<input type="text" name="email" class="form-control" value="<?php echo $data['email'] ?>" data-inputmask="'alias': 'email'">
										</div>
										<div class="col-md-5">
											<label for="username" class="form-label">Phone:</label>
											<div class="input-group">
												<span class="input-group-text" id="inputUser">09</span>
												<input type="text" name="phone" class="form-control" id="username" value="<?php echo substr($data['phone'], 2) ?>" aria-describedby="inputUser">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-check form-switch mt-4 pt-3">
											<input class="form-check-input" type="checkbox" name="is_active" id="flexSwitchCheckChecked" <?php echo $data['is_active']==1 ? 'checked' : '' ?>>
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
												<input type="text" name="username" class="form-control" id="username" value="<?php echo $data['username'] ?>" aria-describedby="inputUser">
											</div>
										</div>
										<div class="col-md-4">
											<label for="password" class="form-label">Password:</label>
											<input type="password" name="password" class="form-control" id="password">
										</div>
										<div class="col-md-4">
											<label for="confirmPassword" class="form-label">Confirm Password:*</label>
											<input type="password" name="confirmPassword" class="form-control" id="confirmPassword">
											<div class="invalid-feedback">The passwords do not match.</div>
										</div>
										<div class="col-md-3">
											<label for="role" class="form-label">Role:*</label>
											<select class="form-select" name="role" id="role">
												<option selected="" disabled="" value="">Choose...</option>
												<?php $rows_data = fetch_all_role();
													if($rows_data -> num_rows > 0){
														foreach($rows_data as $row){
															$select = ($row['id'] == $data['role_id']) ? "selected" : "";
															echo '<option '.$select.' value="'.$row['id'].'">'.$row['name'].'</option>';
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
							<button class="btn btn-primary btn-lg" name="edit_user" type="submit">Update</button>
						</div>
					</div>
				</form>

				</div>
			</main>

	

<?php include file_patch()."template/footer.php" ?>