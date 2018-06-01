<div class="content">
	<div class="row">
		<div class="col-sm-5 col-xs-3">
			<h4 class="page-title"><?=($archive ? lang('project_archive') : lang('projects'));?></h4>
		</div>
		<div class="col-sm-7 col-xs-9 text-right m-b-30">
			<?php if (User::is_admin() || User::perm_allowed(User::get_id(),'add_projects') || User::login_role_name() == 'client' && config_item('client_create_project') == 'TRUE') { ?>
			<a href="<?=base_url()?>projects/add" class="btn btn-primary rounded pull-right"><i class="fa fa-plus"></i> <?=lang('create_project')?></a>
			<?php } ?>
			<?php if ($archive) : ?>
			<a href="<?=base_url()?>projects" class="btn btn-primary m-r-10 rounded pull-right"><?=lang('view_active')?></a>
			<?php else: ?>
			<a href="<?=base_url()?>projects?view=archive" class="btn btn-primary rounded m-r-10 pull-right">
			<?=lang('view_archive')?></a>
			<?php endif; ?>            
			<div class="btn-group pull-right m-r-10"> 
				<button class="btn btn-default">
				<?php
				$view = isset($_GET['view']) ? $_GET['view'] : NULL;
				switch ($view) {
				case 'on_hold':
				echo lang('on_hold');
				break;
				case 'done':
				echo lang('done');
				break;
				case 'active':
				echo lang('active');
				break;
				default:
				echo lang('filter');
				break;
				}
				?>
				</button> 
				<button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					<span class="caret"></span>
				</button> 
				<ul class="dropdown-menu"> 
					<li><a href="<?=base_url()?>projects?view=active"><?=lang('active')?></a></li> 
					<li><a href="<?=base_url()?>projects?view=on_hold"><?=lang('on_hold')?></a></li> 
					<li><a href="<?=base_url()?>projects?view=done"><?=lang('done')?></a></li>
					<li><a href="<?=base_url()?>projects"><?=lang('all_projects')?></a></li>   
				</ul> 
			</div>
		</div>
	</div>

	<div class="row filter-row">
						<div class="col-sm-3 col-xs-6">  
							<div class="form-group form-focus">
								<label class="control-label">Project Title</label>
						<input type="text" class="form-control floating" id="project_title" name="project_title">
							</div>
						</div>
						<div class="col-sm-3 col-xs-6">  
							<div class="form-group form-focus">
								<label class="control-label">Client Name</label>
								<input type="text" class="form-control floating"  id="client_name" name="client_name">
							</div>
						</div> 
						<!-- <div class="col-sm-3 col-xs-6"> 
							<div class="form-group form-focus select-focus">
								<label class="control-label">Role</label>
								<select class="select floating select2-hidden-accessible" tabindex="-1" aria-hidden="true"> 
									<option value="">Select Roll</option>
									<option value="">Web Developer</option>
									<option value="1">Web Designer</option>
									<option value="1">Android Developer</option>
									<option value="1">Ios Developer</option>
								</select><span class="select2 select2-container select2-container--default select2-container--below select2-container--open select2-container--focus" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="true" tabindex="0" aria-labelledby="select2-t6kx-container" aria-owns="select2-t6kx-results"><span class="select2-selection__rendered" id="select2-t6kx-container" title="Select Roll">Select Roll</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
							</div>
						</div> -->
						<div class="col-sm-3 col-xs-6">  
							<a href="javascript:void(0)" id="project_search_btn" class="btn btn-success btn-block"> Search </a>  
						</div>     
                    </div>


	<div class="table-responsive">
		<table id="table-projects<?=($archive ? '-archive':'')?>" class="table table-striped custom-table m-b-0">
			<thead>
				<tr>
					<th style="width:5px; display:none;"></th>
					<th class="col-title"><?=lang('project_title')?></th>
					<?php if (User::login_role_name() == 'admin') { ?>
					<th class=""><?=lang('client_name')?></th>
					<?php } ?>
					<?php if (User::login_role_name() != 'client') { ?>
					<th class="col-title "><?=lang('status')?></th>
					<?php } ?>
					<th><?=lang('team_members')?></th>
					<th class="col-date "><?=lang('used_budget')?></th>
					<?php if (User::login_role_name() != 'admin') { ?>
					<th class=""><?=lang('hours_spent')?></th>
					<?php } ?>
					<?php if(User::login_role_name() != 'staff' || User::perm_allowed(User::get_id(),'view_project_cost')){ ?>
					<th class="col-currency"><?=lang('amount')?></th>
					<?php } ?>
					<th class="text-right">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($projects as $key => $p) { 
				$progress = Project::get_progress($p->project_id); ?>
				<tr class="<?php if (Project::timer_status('project',$p->project_id) == 'On') { echo "text-danger"; } ?>">
					<td style="display:none;"><?=$p->project_id?></td>
					<td>
						<?php  $no_of_tasks = App::counter('tasks',array('project' => $p->project_id)); ?>
						<a class="text-info" data-toggle="tooltip" data-original-title="<?=$no_of_tasks?> <?=lang('tasks')?> | <?=$progress?>% <?=lang('done')?>" href="<?=base_url()?>projects/view/<?=$p->project_id?>">
							<?=$p->project_title?>
						</a>
						<?php if (Project::timer_status('project',$p->project_id) == 'On') { ?>
						<i class="fa fa-spin fa-clock-o text-danger"></i>
						<?php } ?>
						<?php 
						if (time() > strtotime($p->due_date) AND $progress < 100){
						$color = (valid_date($p->due_date)) ? 'danger': 'default';
						echo '<span class="label label-'.$color.' pull-right">';
						echo (valid_date($p->due_date)) ? lang('overdue') : lang('ongoing'); 
						echo '</span>'; 
						} ?>
						<div class="progress-xxs not-rounded mb-0 inline-block progress" style="width: 100%; margin-right: 5px">
							<div class="progress-bar progress-bar-<?php echo ($progress >= 100 ) ? 'success' : 'danger'; ?>" role="progressbar" aria-valuenow="<?=$progress?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$progress?>%;" data-toggle="tooltip" data-original-title="<?=$progress?>%"></div>
						</div>
					</td>
					<?php if (User::is_admin()) { ?>
					<td class="">
						<?=($p->client > 0) ? Client::view_by_id($p->client)->company_name : 'N/A'; ?>
					</td>
					<?php } ?>

					<?php if (User::login_role_name() != 'client') { ?>
					<?php 
						switch ($p->status) {
							case 'Active': $label = 'success'; break;
							case 'On Hold': $label = 'warning'; break;
							case 'Done': $label = 'default'; break;
						}
					?>
					<td>
						<span class="label label-<?=$label?>"><?=lang(str_replace(" ","_",strtolower($p->status)))?></span>
					</td>
					<?php } ?>
					<td class="text-muted">
						<ul class="team-members">
							<?php foreach (Project::project_team($p->project_id) as $user) { ?>
							<li>
								<a>
									<img src="<?php echo User::avatar_url($user->assigned_user); ?>" class="img-circle" data-toggle="tooltip" data-title="<?=User::displayName($user->assigned_user); ?>" data-placement="top">
								</a>
							</li>
							<?php } ?>
						</ul>
					</td>
					<?php $hours = Project::total_hours($p->project_id);
						if($p->estimate_hours > 0){
							$used_budget = round(($hours / $p->estimate_hours) * 100,2);
						} else{ $used_budget = NULL; }
					?>
					<td>
						<strong class="<?=($used_budget > 100) ? 'text-danger' : 'text-success'; ?>"><?=($used_budget != NULL) ? $used_budget.' %': 'N/A'?></strong>
					</td>
					<?php if (!User::is_admin()) { ?>
					<td class="text-muted"><?=$hours?> <?=lang('hours')?></td>
					<?php } ?>
					<?php if(User::login_role_name() != 'staff' || User::perm_allowed(User::get_id(),'view_project_cost')){ ?>
					<?php $cur = ($p->client > 0) ? Client::client_currency($p->client)->code : $p->currency; ?>
					<td class="col-currency">
						<strong><?=Applib::format_currency($cur, Project::sub_total($p->project_id))?></strong>
						<small class="text-muted" data-toggle="tooltip" data-title="<?=lang('expenses')?>"> (<?=Applib::format_currency($cur, Project::total_expense($p->project_id))?>) </small>
					</td>
					<?php } ?>
					<td class="text-right">
						<div class="dropdown">
							<a data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="fa fa-ellipsis-v"></i></a>
							<ul class="dropdown-menu pull-right">
								<li>
									<a href="<?=base_url()?>projects/view/<?=$p->project_id?>"><?=lang('preview_project')?></a>
								</li>
								<?php if (User::is_admin() || User::perm_allowed(User::get_id(),'edit_all_projects')){ ?>   
								<li>
									<a href="<?=base_url()?>projects/view/<?=$p->project_id?>/?group=dashboard&action=edit"><?=lang('edit_project')?></a>
								</li>
								<?php if ($archive) : ?>
								<li><a href="<?=base_url()?>projects/archive/<?=$p->project_id?>/0"><?=lang('move_to_active')?></a></li>  
								<?php else: ?>
								<li>
									<a href="<?=base_url()?>projects/archive/<?=$p->project_id?>/1"><?=lang('archive_project')?></a>
								</li>        
								<?php endif; ?>
								<?php } ?>  
								<?php if (User::is_admin() || User::perm_allowed(User::get_id(),'delete_projects')){ ?> 
								<li>
									<a href="<?=base_url()?>projects/delete/<?=$p->project_id?>" data-toggle="ajaxModal"><?=lang('delete_project')?></a>
								</li>
								<?php } ?>
							</ul>
						</div>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>