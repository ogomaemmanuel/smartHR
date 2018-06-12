<?php
$login = array(
	'name'	=> 'login',
	'class'	=> 'form-control',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or Username';
} else if ($login_by_username) {
	$login_label = 'Username';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'inputPassword',
	'size'	=> 30,
	'class' => 'form-control'
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'class'	=> 'form-control',
	'maxlength'	=> 10,
);
?>
<div class="content">
	<div id="login-form" class="container">
		<h3 class="account-title"><?=config_item('login_title')?></h3>
		<?php echo modules::run('sidebar/flash_msg');?>
		<div class="account-box">
			<div class="account-logo">
				<?php $display = config_item('logo_or_icon'); ?>
				<?php if ($display == 'logo' || $display == 'logo_title') { ?>
				<img src="<?=base_url()?>assets/images/<?=config_item('company_logo')?>" class="<?=($display == 'logo' ? "" : "login-logo")?>">
				<?php } ?>
			</div>
			<?php if(config_item('enable_languages') == 'TRUE'){/* ?>
			<div class="langage-menu2 text-right clearfix">
				<div class="btn-group dropdown">
					<button type="button" class="btn btn-sm dropdown-toggle btn-default" data-toggle="dropdown" btn-icon="" title="<?=lang('languages')?>"><i class="fa fa-globe"></i></button>
					<button type="button" class="btn btn-sm btn-default dropdown-toggle  hidden-nav-xs" data-toggle="dropdown"><?=lang('languages')?> <span class="caret"></span></button>
					<!-- Load Languages -->
					<ul class="dropdown-menu text-left">
						<?php $languages = App::languages(); foreach ($languages as $lang) : if ($lang->active == 1) : ?>
						<li>
							<a href="<?=base_url()?>set_language?lang=<?=$lang->name?>" title="<?=ucwords(str_replace("_"," ", $lang->name))?>">
								<img src="<?=base_url()?>assets/images/flags/<?=$lang->icon?>.gif" alt="<?=ucwords(str_replace("_"," ", $lang->name))?>"  /> <?=ucwords(str_replace("_"," ", $lang->name))?>
							</a>
						</li>
						<?php endif; endforeach; ?>
					</ul>
				</div>
			</div>
			<?php */} ?>
			<?php
			$attributes = array('class' => '');
			echo form_open($this->uri->uri_string(),$attributes); ?>
				<div class="form-group">
					<label class="control-label"><?=lang('email_user')?></label>
					<?php echo form_input($login); ?>
					<span style="color: red;">
					<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></span>
				</div>
				<div class="form-group">
					<label class="control-label"><?=lang('password')?></label>
					<?php echo form_password($password); ?>
					<span style="color: red;"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></span>
				</div>
				<table>
					<?php if ($show_captcha) {
						if ($use_recaptcha) { ?>
					<?php echo $this->recaptcha->render(); ?>
					<?php } else { ?>
					<tr><td colspan="2"><p><?=lang('enter_the_code_exactly')?></p></td></tr>
					<tr>
						<td colspan="3"><?php echo $captcha_html; ?></td>
						<td style="padding-left: 5px;"><?php echo form_input($captcha); ?></td>
						<span style="color: red;"><?php echo form_error($captcha['name']); ?></span>
					</tr>
					<?php }
					} ?>
				</table>
				<div class="form-group clearfix">
					<div class="pull-left">
						<label>
							<?php echo form_checkbox($remember); ?> <?=lang('this_is_my_computer')?>
						</label>
					</div>
					<a href="<?=base_url()?>auth/forgot_password" class="pull-right"><?=lang('forgot_password')?></a>
				</div>
				<button type="submit" class="btn btn-block btn-primary"><?=lang('sign_in')?></button>
				<?php if (config_item('allow_client_registration') == 'TRUE'){ ?>
				<p class="text-muted m-b-0 text-center"><span><?=lang('do_not_have_an_account')?></span> <a href="<?=base_url()?>auth/register" class=""><?=lang('get_your_account')?></a></p>
				<?php } ?>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>