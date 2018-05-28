<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'class'	=> 'form-control',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if (config_item('use_username', 'tank_auth')) {
	$login_label = 'Email or login';
} else {
	$login_label = 'Email';
}
echo modules::run('sidebar/flash_msg');
?>  
<div class="content">
	<div class="container">
		<h3 class="account-title"><?=lang('forgot_password')?></h3>
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
					<label class="control-label"><?=lang('email')?>/<?=lang('username')?></label>
					<?php echo form_input($login); ?>
					<span style="color: red;">
					<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></span>
				</div>
				<button type="submit" class="btn btn-primary btn-block"><?=lang('get_new_password')?></button>
				<?php if (config_item('allow_client_registration') == 'TRUE'){ ?>
				<p class="text-muted text-center"><span><?=lang('do_not_have_an_account')?></span> <a href="<?=base_url()?>auth/register/"><?=lang('get_your_account')?></a></p> 
				<?php } ?>
				<p class="text-muted text-center"><span><?=lang('already_have_an_account')?></span> <a href="<?=base_url()?>login"><?=lang('sign_in')?></a></p> 
			<?php echo form_close(); ?>
		</div>
	</div>
</div>