<script src="<?php echo base_url(); ?>/assets/js/register.js"></script>

<div class="login_page">
	<div class="login_box">
		<div class="logo_section">
			<a class="navbar-brand" href="<?php echo base_url(); ?>/home">Virdemy</a>
		</div>
		<div id="first">
			<?php echo form_open(base_url() . 'login/reset_password'); ?>
			<p>Enter your new password below.</p>
			<div class="form-group">
				<input type="password" class="form-control" placeholder="Password" required="required" name="password" ?>
			</div>
            <div class="form-group">
				<input type="password" class="form-control" placeholder="Confirm passwrod" required="required" name="confirmPassword" ?>
			</div>
			<div class="form-group">
				<input hidden type="text" class="form-control" name="token" value="<?php echo $token ?>"?>
			</div>
			<?php if ($this->session->flashdata('message')) { ?>
				<div class="form-group"> 
					<span class="success-message"><?php echo $this->session->flashdata('message'); ?></span> 
				</div>
			<?php } else if ($this->session->flashdata('error')) { ?>
				<div class="form-group">
					 <span class="error-message"><?php echo $this->session->flashdata('error'); ?></span> 
				</div>
			<?php } ?>
			<div class="form-group">
				<button type="submit" class="button">Reset password</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>