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
					<a href="<?php echo url() ?>users/users.php" class="btn btn-primary float-end mt-n1"><i class="fas fa-arrow-left"></i> Back</a>
					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">User view</h1>
					</div>

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
										Comeing Soon...
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
														<p><?php echo $data['name'] ?></p>
													</div>
													<div class="col-md-2">
														<h4>Username:</h4>
													</div>
													<div class="col-md-4">
														<p><?php echo $data['username'] ?></p>
													</div>
												</div>
												<div class="row">
													<div class="col-md-2">
														<h4>Gender:</h4>
													</div>
													<div class="col-md-4">
														<p>
															<?php 
																switch($data['gender']){
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
															$role = fetch_role($data['role_id'])->fetch_assoc();
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
														<p><?php echo $data['email'] ?></p>
													</div>
												</div>
												<div class="row">
													<div class="col-md-2">
														<h4>Phone:</h4>
													</div>
													<div class="col-md-6">
														<p><?php echo $data['phone'] ?></p>
													</div>
												</div>
												<div class="row">
													<div class="col-md-2">
														<h4>Account Status:</h4>
													</div>
													<div class="col-md-6">
                                                        <?php echo $data['is_active']==1 ?
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
											<h5 class="card-title">Comeing Soon</h5>
											<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium, voluptates nostrum? Accusamus, ab? Quisquam dolor ipsum consectetur! Ipsum corrupti sit ea? Delectus ab tempore fugit dolor iure molestiae corrupti cum facilis at officia blanditiis voluptas eius ullam, facere consequatur repudiandae perspiciatis quisquam excepturi obcaecati. Iure earum eum inventore, tenetur sed nesciunt assumenda ipsa beatae officia magni, accusamus voluptatem id? Harum tenetur aspernatur voluptate dolorem excepturi? Voluptatum ipsum assumenda aut illo, saepe quas unde non, ea voluptate eligendi atque! Animi facilis assumenda cupiditate qui corporis esse beatae, atque consequuntur cum. Dolorum doloremque maiores reprehenderit ipsa ducimus animi provident fugit odio unde.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>

<?php include file_patch()."template/footer.php" ?>