<?php
session_start();
require_once "core/functions.php";
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
                        <div class="row mb-2 mb-xl-3">
                            <div class="col-auto d-none d-sm-block">
                                <h3><strong>Analytics</strong> Dashboard</h3>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-xl-6 d-flex" onclick="window.location.href='<?php url() ?>users/users.php'">
                                <div class="w-100">
                                    <div class="row">
                                        <div class="col-sm-12">
                                        <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col mt-0">
                                                            <h5 class="card-title">Users</h5>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="stat text-primary">
                                                                <i class="align-middle" data-feather="users"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h1 class="mt-1 mb-3"><?php echo usersCount()['COUNT(id)']; ?></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 d-flex" onclick="window.location.href='<?php url() ?>roles/roles.php'">
                                <div class="w-100">
                                    <div class="row">
                                        <div class="col-sm-12">
                                        <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col mt-0">
                                                            <h5 class="card-title">Roles</h5>
                                                        </div>

                                                        <div class="col-auto">
                                                            <div class="stat text-primary">
                                                                <i class="align-middle" data-feather="file-text"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h1 class="mt-1 mb-3"><?php echo rolesCount()['COUNT(id)']; ?></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

<?php include file_patch()."template/footer.php"; ?>