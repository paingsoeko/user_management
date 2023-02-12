<?php
$result = fetch_role_permissions($_SESSION['session_role']);
if($result -> num_rows > 0){
    foreach($result as $row){
        $permissions_id[] = $row['permissions_id'];
    }
}
?>
<nav id="sidebar" class="sidebar js-sidebar">
	<div class="sidebar-content js-simplebar">
		<a class="sidebar-brand" href="<?php echo url(); ?>dashboard.php">
			<span class="sidebar-brand-text align-middle">
				UMS
			</span>
			<svg class="sidebar-brand-icon align-middle" width="32px" height="32px" viewbox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="miter" color="#FFFFFF" style="margin-left: -3px">
				<path d="M12 4L20 8.00004L12 12L4 8.00004L12 4Z"></path>
				<path d="M20 12L12 16L4 12"></path>
				<path d="M20 16L12 20L4 16"></path>
			</svg>
		</a>
		<ul class="sidebar-nav">
			<li class="sidebar-header">
				Home
			</li>
			<li class="sidebar-item <?php echo $_SERVER['PHP_SELF'] === '/user_management/dashboard.php' ? 'active' : '' ?>">
				<a class="sidebar-link" href="<?php echo url(); ?>dashboard.php">
					<i class="align-middle" data-feather="pie-chart"></i> <span class="align-middle">Dashboard</span>
				</a>
			</li>
			<li class="sidebar-header">
				Settings
			</li>
			<li class="sidebar-item <?php echo $_SERVER['PHP_SELF'] === '/user_management/users/users.php' ? 'active' : ''; echo $_SERVER['PHP_SELF'] === '/user_management/roles/roles.php' ? 'active' : ''; ?>">
				<a data-bs-target="#ui" data-bs-toggle="collapse" class="sidebar-link collapsed">
					<i class="align-middle" data-feather="user"></i> <span class="align-middle">User Management</span>
				</a>
				<ul id="ui" class="sidebar-dropdown list-unstyled collapse <?php echo $_SERVER['PHP_SELF'] === '/user_management/users/users.php' ? 'show' : ''; echo $_SERVER['PHP_SELF'] === '/user_management/roles/roles.php' ? 'show' : ''; ?>" data-bs-parent="#sidebar">
                    <?php
                    if (in_array(1, $permissions_id)){
                        ?>
                        <li class="sidebar-item <?php echo $_SERVER['PHP_SELF'] === '/user_management/users/users.php' ? 'active' : ''; ?>"><a class="sidebar-link" href="<?php echo url() ?>users/users.php">Users</a></li>
                    <?php } ?>
                    <?php
                    if (in_array(5, $permissions_id)){
                        ?>
                        <li class="sidebar-item <?php echo $_SERVER['PHP_SELF'] === '/user_management/roles/roles.php' ? 'active' : ''; ?>"><a class="sidebar-link" href="<?php echo url() ?>roles/roles.php">Roles</a></li>
                    <?php } ?>
                </ul>
			</li>
		</ul>
	</div>
</nav>