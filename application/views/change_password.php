<script src="<?php echo base_url(); ?>/assets/js/register.js"></script>

<div class="login_page">
	<div class="login_box">
		<div class="logo_section">
			<a class="navbar-brand" href="<?php echo base_url(); ?>/home">Virdemy</a>
		</div>
		<div id="first">
			<?php echo form_open(base_url() . 'login/send_reset_email'); ?>
			<p>Enter your user account's email address and we will send you a password reset link.</p>
			<div class="form-group">
				<input type="email" class="form-control" placeholder="Email" required="required" name="email" ?>
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
				<button type="submit" class="button">Send password reset email</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>