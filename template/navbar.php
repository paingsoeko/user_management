<div class="main">
<nav class="navbar navbar-expand navbar-light navbar-bg">
	<a class="sidebar-toggle js-sidebar-toggle">
		<i class="hamburger align-self-center"></i>
	</a>
	<div class="navbar-collapse collapse">
		<ul class="navbar-nav navbar-align">
			<li class="nav-item">
				<a class="nav-icon js-fullscreen d-none d-lg-block" href="#">
					<div class="position-relative">
						<i class="align-middle" data-feather="maximize"></i>
					</div>
				</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-icon pe-md-0 dropdown-toggle" href="#" data-bs-toggle="dropdown">
				<img src="<?php echo url() ?>img/default_profile.jpg" class="avatar img-fluid rounded" alt="default profile">
				</a>
				<div class="dropdown-menu dropdown-menu-end">
					<a class="dropdown-item" href="<?php echo url(); ?>profile.php"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
					<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?php echo url(); ?>logout.php">Log out</a>
					</div>
			</li>
		</ul>
	</div>
</nav>