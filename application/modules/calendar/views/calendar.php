<div class="content">
	<div class="row">
		<div class="col-sm-8 col-xs-3">
			<h4 class="page-title"><?=lang('calendar')?></h4>
		</div>
		<div class="col-sm-4 col-xs-9 text-right m-b-30">
			<?php if(User::is_admin()) : ?>
			<a href="<?=base_url()?>calendar/settings" data-toggle="ajaxModal" class="btn btn-primary rounded pull-right"><i class="fa fa-cog"></i> <?=lang('calendar_settings')?></a>
			<?php endif; ?>
			<?php  if(User::is_admin() || User::is_staff()){ ?>
			<a href="<?=base_url()?>calendar/add_event" data-toggle="ajaxModal" class="btn btn-primary rounded pull-right m-r-10"><i class="fa fa-calendar-plus-o"></i> <?=lang('add_event')?></a>
			<?php } ?>
		</div>
	</div>
	<?php
	if (User::is_admin() || User::is_staff()) { ?>
	<div class="card-box m-b-0">
		<div class="row">
			<div class="col-md-12">
				<div class="calendar" id="calendar"></div>
			</div>
		</div>
	</div>
	<?php } ?>
</div>