<?php

if ($use_username) {
	$username = array(
		'name'	=> 'username',
		'class'	=> 'form-control',
		'value' => set_value('username'),
		'maxlength'	=> config_item('username_max_length', 'tank_auth'),
		'size'	=> 30,
	);
}
$email = array(
	'name'	=> 'email',
	'class'	=> 'form-control',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
$fullname = array(
	'name'	=> 'fullname',
	'class'	=> 'form-control',
	'value'	=> set_value('fullname'),
);
$company_name = array(
	'name'	=> 'company_name',
	'class'	=> 'form-control',
	'value'	=> set_value('company_name'),
);
$password = array(
	'name'	=> 'password',
	'class'	=> 'form-control',
	'value' => set_value('password'),
	'maxlength'	=> config_item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$confirm_password = array(
	'name'	=> 'confirm_password',
	'class'	=> 'form-control',
	'value' => set_value('confirm_password'),
	'maxlength'	=> config_item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'class'	=> 'form-control',
	'maxlength'	=> 8,
);
?>
<div class="content">
	<div class="container">
		<h3 class="account-title"><?=lang('sign_up_form')?> <?=config_item('company_name')?></h3>
		<div class="account-box">
			<div class="account-logo">
				<?php $display = config_item('logo_or_icon'); ?>
				<?php if ($display == 'logo' || $display == 'logo_title') { ?>
				<img src="<?=base_url()?>assets/images/<?=config_item('company_logo')?>" class="<?=($display == 'logo' ? "" : "login-logo")?>">
				<?php } ?>
			</div>
			<?php
			$attributes = array('class' => '');
			echo form_open($this->uri->uri_string(),$attributes); ?>
				<div class="form-group">
					<label class="control-label"><?=lang('company_name')?></label>
					<?php echo form_input($company_name); ?>
					<span style="color: red;"><?php echo form_error($company_name['name']); ?><?php echo isset($errors[$company_name['name']])?$errors[$company_name['name']]:''; ?></span>
				</div>
				<div class="form-group">
					<label class="control-label"><?=lang('full_name')?></label>
					<?php echo form_input($fullname); ?>
					<span style="color: red;"><?php echo form_error($fullname['name']); ?><?php echo isset($errors[$fullname['name']])?$errors[$fullname['name']]:''; ?></span>
				</div>
				<?php if ($use_username) { ?>
				<div class="form-group">
					<label class="control-label"><?=lang('username')?></label>
					<?php echo form_input($username); ?>
					<span style="color: red;"><?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?></span>
				</div>
				<?php } ?>
				<div class="form-group">
					<label class="control-label"><?=lang('email')?></label>
					<?php echo form_input($email); ?>
					<span style="color: red;">
					<?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></span>
				</div>
				<div class="form-group">
					<label class="control-label"><?=lang('password')?> </label>
					<?php echo form_password($password); ?>
					<span style="color: red;"><?php echo form_error($password['name']); ?></span>
				</div>
				<div class="form-group">
					<label class="control-label"><?=lang('confirm_password')?> </label>
					<?php echo form_password($confirm_password); ?>
					<span style="color: red;"><?php echo form_error($confirm_password['name']); ?></span>
				</div>
				<table>
					<?php if ($captcha_registration == 'TRUE') {
						if ($use_recaptcha) { ?>
					<?php echo $this->recaptcha->render(); ?>
					<?php } else { ?>
					<tr><td colspan="4"><p><?=lang('enter_the_code_exactly')?></p></td></tr>
					<tr>
						<td colspan="3"><?php echo $captcha_html; ?></td>
						<td style="padding-left: 5px;"><?php echo form_input($captcha); ?></td>
						<span style="color: red;"><?php echo form_error($captcha['name']); ?></span>
					</tr>
					<?php }
					} ?>
				</table>
				<button type="submit" class="btn btn-primary btn-block m-t-15"><?=lang('sign_up')?></button>
				<p class="text-muted text-center"><span><?=lang('already_have_an_account')?></span> <a href="<?=base_url()?>login"><?=lang('sign_in')?></a></p>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>