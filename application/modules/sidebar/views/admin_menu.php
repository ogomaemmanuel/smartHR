<div class="sidebar-<?=config_item('sidebar_theme')?> sidebar" id="nav">
	<div class="slimscroll">	
		<?php if(config_item('enable_languages') == 'TRUE'){ ?>
		<div class="language-menu">
			<div class="dropdown">
				<button type="button" class="btn btn-sm btn-default dropdown-toggle btn-block hidden-nav-xs" data-toggle="dropdown"><?=lang('languages')?> <span class="caret"></span></button>
				<ul class="dropdown-menu text-left">
					<?php foreach ($languages as $lang) : if ($lang->active == 1) : ?>
					<li>
						<a href="<?=base_url()?>set_language?lang=<?=$lang->name?>" title="<?=ucwords(str_replace("_"," ", $lang->name))?>">
							<img src="<?=base_url()?>assets/images/flags/<?=$lang->icon?>.gif" alt="<?=ucwords(str_replace("_"," ", $lang->name))?>"  /> <?=ucwords(str_replace("_"," ", $lang->name))?>
						</a>
					</li>
					<?php endif; endforeach; ?>
				</ul>
			</div>
		</div>
		<?php } ?>
		<div id="sidebar-menu" class="sidebar-menu">
			<ul class="nav">
				<?php
				$badge = array();
				$timer_on = App::counter('project_timer',array('status'=>'1'));
				if($timer_on > 0){ $badge['menu_projects'] = '<b class="badge bg-danger pull-right">'.$timer_on.'<i class="fa fa-refresh fa-spin"></i></b>'; }

				$unread = App::counter('messages',array('user_to'=>User::get_id(),'status' => 'Unread'));
				$open_tickets = App::counter('tickets',array('status !=' => 'closed'));

				if($unread > 0){ $badge['menu_messages'] = '<b class="badge bg-primary pull-right">'.$unread.'</b>'; }
				if($open_tickets > 0){ $badge['menu_tickets'] = '<b class="badge bg-primary pull-right">'.$open_tickets.'</b>'; }

				$menus = $this->db->where('access',1)->where('visible',1)->where('parent','')->where('hook','main_menu_admin')->order_by('order','ASC')->get('hooks')->result();
				
				foreach ($menus as $menu) {
					$sub = $this->db->where('access',1)->where('visible',1)->where('parent',$menu->module)->where('hook','main_menu_admin')->order_by('order','ASC')->get('hooks');
				?>
				<?php if ($sub->num_rows() > 0) {
				$submenus = $sub->result(); 

				?>
				<li class="<?php
					foreach ($submenus as $submenu) {

						if(strtolower($page) == strtolower(lang($submenu->name))){echo  "active"; }
					}
				?>">
					<a href="<?=base_url()?><?=$menu->route?>">
						<i class="fa <?=$menu->icon?> icon"> <b class="bg-<?=config_item('theme_color');?>"></b></i>
						<span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i></span>
						<span><?=lang($menu->name)?></span>
					</a>
					<ul class="nav lt">
						<?php foreach ($submenus as $submenu) { ?>
						<li class="<?php if($page == lang($submenu->name)){echo  "active"; }?>">
							<a href="<?=base_url()?><?=$submenu->route?>">
								<?php if (isset($badge[$submenu->module])) { echo $badge[$menu->module]; } ?>
								<span><?=lang($submenu->name)?></span>
							</a>
						</li>
						<?php } ?>
					</ul>
				</li>
				<?php } else { ?>
				<li class="<?php if($page == lang($menu->name)){echo  "active"; }?>">
					<a href="<?=base_url()?><?=$menu->route?>">
						<?php if (isset($badge[$menu->module])) { echo $badge[$menu->module]; } ?>
						<i class="fa <?=$menu->icon?> icon"> <b class="bg-<?=config_item('theme_color');?>"></b></i>
						<span><?=lang($menu->name)?></span>
					</a>
				</li>
				<?php } ?>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>