<script src="<?php echo base_url(); ?>/assets/js/register.js"></script>

<div class="login_page">
	<div class="login_box">
		<div class="logo_section">
			<a class="navbar-brand" href="<?php echo base_url(); ?>/home">Virdemy</a>
		</div>
		<div id="first" style="display: <?php echo ($state == 'register')? 'none' : '' ?>">
			<?php echo form_open(base_url() . 'login/check_login'); ?>
			<div class="form-group">
				<input type="email" class="form-control" placeholder="Email" required="required" name="email" value="<?php echo ($name) ? $name : "" ?>">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" placeholder="Password" required="required" name="password" value="<?php echo ($name) ? $name : "" ?>">
			</div>
			<div class="form-group">
				<?php if ($error) {
					echo $error; 
				} else if ($success) {
					echo $success; 
				}
				?>
			</div>
			
			<div class="form-group">
				<button type="submit" class="button">Log in</button>
			</div>
			<div class="clearfix">
				<label class="float-left form-check-label"><input type="checkbox" name="remember"> Remember me</label>
				<a href="<?php echo base_url(); ?>login/render_reset_password" class="float-right">Forgot Password?</a>
			</div>
			<hr>
			<a href="#" id="signup" class="signup">Need an account? Register here!</a>
			<?php echo form_close(); ?>
		</div>

		<div id="second" style="display: <?php echo ($state == 'register')? 'bock' : 'none' ?>">
			<?php echo form_open(base_url() . 'login/register'); ?>
			<div class="form-group">
				<input type="name" class="form-control <?php echo ($highlightItem == "name") ? "highlight" : "" ?>" placeholder="Name" required="required" name="name" value="<?php echo ($name) ? $name : "" ?>">
			</div>
			<div class="form-group">
				<input type="email" class="form-control <?php echo ($highlightItem == "email") ? "highlight" : "" ?>" placeholder="Email" required="required" name="email" value="<?php echo ($email) ? $email : "" ?>">
			</div>
			<div class="form-group">
				<input type="password" class="form-control <?php echo ($highlightItem == "password") ? "highlight" : "" ?>" placeholder="Password" required="required" name="password" value="<?php echo ($password) ? $password : "" ?>">
			</div>
			<div class="form-group">
				<input type="password" class="form-control <?php echo ($highlightItem == "confirmPassword") ? "highlight" : "" ?>" placeholder="Confrim Password" required="required" name="confirmPassword" value="<?php echo ($confirmPassword) ? $confirmPassword : "" ?>">
			</div>
			<div class="form-group">
				<?php echo $error; ?>
			</div>
			<div class="form-group">
				<button type="submit" class="button">Register</button>
			</div>
			<hr>
			<a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>
			<?php echo form_close(); ?>
		</div>

	</div>
</div>