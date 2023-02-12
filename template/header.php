<?php
//require_once "http://{$_SERVER['HTTP_HOST']}/user_management/core/functions.php";
require_once($_SERVER['DOCUMENT_ROOT'].'/user_management/core/functions.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icon-48x48.png">
	<title>UMS - User Management System</title>

	<link class="js-stylesheet" href="<?php echo url(); ?>css/style.css" rel="stylesheet">
</head>
<style>
.my-form-control {

  	display: block;
    width: 100%;
    padding: 0.3rem 0.85rem;
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-appearance: none;
    appearance: none;
    border-radius: 0.2rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.my-form-control.no-match:focus,
.was-compared .my-form-control.no-match:focus {
  border-color: #dc3545;
  box-shadow: 0 0 0 0.2rem rgb(220 53 69 / 25%);
}
.my-form-control.no-match,
.was-compared .my-form-control.no-match {
  border-color: #dc3545;
}
.my-form-control.match,
.was-compared .my-form-control.match {
  border-color: #28a745;
}
.my-form-control:focus {
  color: #495057;
  background-color: #fff;
  border-color: #80bdff;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgb(0 123 255 / 25%);
}

.was-compared .my-form-control.no-match~.invalid-feedback,
.was-compared .my-form-control.no-match~.invalid-tooltip {
  display: block;
}

</style>
<body>
<div class="wrapper">