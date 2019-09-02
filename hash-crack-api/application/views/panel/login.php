<!DOCTYPE html>
<html>
<head>
	<title><?php echo $pageTitle; ?></title>
	<link href="https://fonts.googleapis.com/css?family=Livvic|Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/login.css') ?>">
</head>
<body>

	<div class="body">
		<div class="formDiv">

			
        <?php $fattr = array('class' => 'form' ); echo form_open_multipart('login',$fattr); ?> 
				<p class="title">Account Login</p>

				<div class="error">
					<?php echo validation_errors(); ?>
					<?php if($this->session->flashdata('login_failed')): ?>
		              <?php echo $this->session->flashdata('login_failed'); ?>
		            <?php endif; ?>

		            <?php if($this->session->flashdata('user_loggedout')): ?>
		              <?php echo $this->session->flashdata('user_loggedout'); ?>
		            <?php endif; ?>

		            <?php if($this->session->flashdata('user_registered')): ?>
		              <?php echo '<p style="color:green;">'.$this->session->flashdata('user_registered').'</p>'; ?>
		            <?php endif; ?>
				</div>

				<div class="inputArea">

					<div class="inputBox">
						<input type="text" name="username" placeholder="username">
					</div>
					<div class="inputBox">
						<input type="password" name="password" placeholder="password">
					</div>
					<div class="inputBox">
						<button type="submit" >Log In</button>
					</div>
					
				</div>

				<div class="crateAccount">
					<p class="createAcc">Create an account? <a href="<?php echo base_url('register'); ?>">sign up</a></p>
				</div>
			</form>

		</div>
	</div>

</body>
</html>