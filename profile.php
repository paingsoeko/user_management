<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('location:index.php');
    exit;
}
include "template/header.php";
include "template/sidebar.php";
include "template/navbar.php";

$data = fetch_user($_SESSION['user_id']);
$row = $data -> fetch_assoc();
?>

<main class="content">
				<div class="container-fluid p-0">
                    <a href="<?php echo url() ?>users/users.php" class="btn btn-primary float-end mt-n1"><i class="fas fa-arrow-left"></i> Back</a>
                    <h1 class="h3 mb-3">Settings</h1>
					<div class="row">
						<div class="col-md-3 col-xl-2">

							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Profile Settings</h5>
								</div>

								<div class="list-group list-group-flush" role="tablist">
									<a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab">
										Account
									</a>
									<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password" role="tab">
										Password
									</a>
								</div>
							</div>
						</div>

						<div class="col-md-9 col-xl-10">
							<div class="tab-content">
								<div class="tab-pane fade show active" id="account" role="tabpanel">

									

									<div class="card">
										<div class="card-header">

											<h5 class="card-title mb-0">Account Info</h5>
										</div>
										<div class="card-body">

												<div class="row">
													<div class="col-md-2">
														<h4>Name:</h4>
													</div>
													<div class="col-md-4">
														<p><?php echo $row['name'] ?></p>
													</div>
													<div class="col-md-2">
														<h4>Username:</h4>
													</div>
													<div class="col-md-4">
														<p><?php echo $row['username'] ?></p>
													</div>
												</div>
												<div class="row">
													<div class="col-md-2">
														<h4>Gender:</h4>
													</div>
													<div class="col-md-4">
														<p>
                                                            <?php
                                                            switch($row['gender']){
                                                                case 0 : echo 'Male';
                                                                    break;
                                                                case 1 : echo 'Female';
                                                                    break;
                                                                case 2 : echo 'Rather not say';
                                                                    break;
                                                            }
                                                            ?>
                                                        </p>
													</div>
													<div class="col-md-2">
														<h4>Role:</h4>
													</div>
													<div class="col-md-4">
														<p>
                                                            <?php
                                                            $role = fetch_role($row['role_id'])->fetch_assoc();
                                                            echo $role['name'];
                                                            ?>
                                                        </p>
													</div>
												</div>
												<div class="row">
													<div class="col-md-2">
														<h4>Email:</h4>
													</div>
													<div class="col-md-6">
														<p><?php echo $row['email'] ?></p>
													</div>
												</div>
												<div class="row">
													<div class="col-md-2">
														<h4>Phone:</h4>
													</div>
													<div class="col-md-6">
														<p><?php echo $row['phone'] ?></p>
													</div>
												</div>
												<div class="row">
													<div class="col-md-2">
														<h4>Account Status:</h4>
													</div>
													<div class="col-md-6">
                                                        <?php echo $row['is_active']==1 ?
                                                            '<p class="text-success">active</p>' :
                                                            '<p class="text-danger">deactivate</p>' ?>
													</div>
												</div>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="password" role="tabpanel">
									<div class="card">
										<div class="card-body">
                                            <?php
                                            if(isset($_POST['pwd_change'])) {
                                                echo pwd_change();
                                            }
                                            ?>
											<h5 class="card-title">Password</h5>
											<form method="post" action="profile.php?id=<?php echo $row['id'] ?>">
												<div class="mb-3">
													<label class="form-label" for="inputPasswordCurrent">Current password</label>
													<input type="password" class="form-control" name="current_pwd" id="inputPasswordCurrent">
												</div>
												<div class="mb-3">
													<label class="form-label" for="inputPasswordNew">New password</label>
													<input type="password" class="form-control" name="new_pwd" id="inputPasswordNew">
												</div>
												<button type="submit" name="pwd_change" class="btn btn-primary">Save changes</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>

<?php include "template/footer.php" ?>