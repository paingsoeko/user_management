<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('location:index.php');
    exit;
}
require_once "../core/functions.php";
include file_patch()."template/header.php";
include file_patch()."template/sidebar.php";
include file_patch()."template/navbar.php";
$result = fetch_role_permissions($_SESSION['session_role']);
if($result -> num_rows > 0){
    foreach($result as $row){
        $permissions_id[] = $row['permissions_id'];
    }
}
?>

<main class="content">
				<div class="container-fluid p-0">
                <?php
                if (in_array(6, $permissions_id)){
                ?>
                <a href="role-create.php" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New Role</a>
                <?php } ?>
					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Roles</h1>
						<h6 class="text-muted">Manage roles</h6>
					</div>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">All users</h5>
									<?php
										if(isset($_GET['deleteRole'])){
											echo delete_role();
										}
									?>
								</div>
								<div class="card-body">
									<table id="datatables-buttons" class="table table-striped" style="width:100%">
										<thead>
											<tr>
												<th>Roles</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
												$rows_data = fetch_all_role();
												if($rows_data -> num_rows > 0){
													foreach($rows_data as $row){
											?>
											<tr>
												<td><?php echo $row['name'] ?></td>
												<td class="table-action">
												<?php

												if($row['name']=="Default Administrator" && $_SESSION['session_role']>1){
                                                            echo "You can't edit or delete";
												}else{
													?>
                                               <?php
                                               if (in_array(7, $permissions_id)){
                                               ?>
                                                <button onclick="window.location.href='role-edit.php?id=<?php echo $row['id'] ?>';" class="btn btn-pill alert-warning btn-sm ml-2"><i class="fas fa-light fa-user-pen"></i> edit</button>
                                                <?php } ?>
                                                <?php
                                                if (in_array(8, $permissions_id)){
                                                ?>
                                                <button onclick="window.location='?deleteRole=<?php echo $row['id'] ?>';" class="btn btn-pill alert-danger btn-sm"><i class="fas fa-light fa-trash"></i> delete</button>
                                                <?php } ?>
											<?php
											}
												?>
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