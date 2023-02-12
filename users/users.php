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
$result = fetch_role_permissions($_SESSION['session_role']);
if($result -> num_rows > 0){
    foreach($result as $row){
        $permissions_id[] = $row['permissions_id'];
    }
}
$result1= fetch_role($_SESSION['session_role']);
foreach ($result1 as $row1){
    $role_name = $row1['name'];
}
?>

            <main class="content">
				<div class="container-fluid p-0">
                <?php echo in_array(2, $permissions_id) ? '<a href="user-create.php" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New User</a>' : '' ?>

					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Users</h1>
						<h6 class="text-muted">Manage users</h6>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">All users</h5>
									<?php
										if(isset($_GET['deleteUser'])){
											echo delete_user();
										}
									?>
								</div>
								<div class="card-body">
									<table id="datatables-buttons" class="table table-striped" style="width:100%">
										<thead>
											<tr>
												<th>Username</th>
												<th>Name</th>
												<th>Role</th>
												<th>Email</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$rows_data = fetch_all_user();
												if($rows_data -> num_rows > 0){
													foreach($rows_data as $row){
											?>
											<tr>
												<td><?php echo $row['username'] ?></td>
												<td><?php echo $row['name'] ?></td>
												<td>
												<?php 
												$data = fetch_role($row['role_id'])->fetch_assoc();
												echo $data['name'];
												?>
												</td>
												<td><?php echo $row['email'] ?></td>
												<td class="table-action">
                                                    <?php

                                                    if($data['name']=="Default Administrator" && $_SESSION['session_role']>1){
                                                        echo "You can't edit or delete";
                                                    }else{
                                                        ?>
                                                    <?php
                                                    if (in_array(1, $permissions_id)){
                                                    ?>
                                                        <button onclick="window.location.href='user-view.php?id=<?php echo $row['id'] ?>';" class="btn btn-pill alert-success btn-sm"><i class="fas fa-light fa-eye"></i> view</button>
                                                    <?php } ?>

                                                    <?php
                                                    if (in_array(3, $permissions_id)){
                                                        ?>
                                                        <button onclick="window.location.href='user-edit.php?id=<?php echo $row['id'] ?>';" class="btn btn-pill alert-warning btn-sm"><i class="fas fa-light fa-user-pen"></i> edit</button>
                                                    <?php } ?>

                                                    <?php
                                                    if (in_array(4, $permissions_id)){
                                                        ?>
                                                        <button onclick="window.location='?deleteUser=<?php echo $row['id'] ?>';" class="btn btn-pill alert-danger btn-sm"><i class="fas fa-light fa-trash"></i> delete</button>
                                                    <?php } ?>
                                                        <?php } ?>

											    </td>
											</tr>
											<?php
                                                    }
												}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
			
				</div>
			</main>





<?php include file_patch()."template/footer.php" ?>