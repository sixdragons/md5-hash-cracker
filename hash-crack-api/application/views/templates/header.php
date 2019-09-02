<!DOCTYPE html>
<html>
<head>
	<title><?php echo $pageTitle; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/main.css') ?>">
	<link href="https://fonts.googleapis.com/css?family=Livvic|Roboto&display=swap" rel="stylesheet">
</head>
<body>

	<header>
		<div class="container">
			
			<div class="leftside">
				<h3>DashBord</h3>
			</div>

			<nav class="rightnav">
				<ul>
					<li><a href="<?php echo base_url(); ?>">Home</a></li>
					<li><a href="<?php echo base_url('logout'); ?>">Logout</a></li>
				</ul>
			</nav>

		</div>
	</header>

