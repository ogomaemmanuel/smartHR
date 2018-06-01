<div class="content container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<h4 class="page-title"><?=lang('activities')?></h4>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="activity">
				<div class="activity-box">
					<ul class="activity-list">
						<?php foreach (User::user_log(User::get_id()) as $key => $a) { 
						?>
						<li>								
							<div class="activity-user">
								<a class="avatar" href="javascript:void(0);">
									<img src="<?php echo User::avatar_url($a->user);?>" class="img-circle">
								</a>
							</div>
							<div class="activity-content">
								<div class="timeline-content">
									<a href="javascript:void(0);" class="name"><?=User::displayName($a->user)?></a>
									<?php 
									if (lang($a->activity) != '') {
										if (!empty($a->value1)) {
											if (!empty($a->value2)){
												echo sprintf(lang($a->activity), '<a href="#">'.$a->value1.'</a>', '<a href="#">'.$a->value2.'</a>');
											} else {
												echo sprintf(lang($a->activity), '<a href="#">'.$a->value1.'</a>');
											}
										} else { echo lang($a->activity); }
									} else { echo $a->activity; } 
									?>
									<span class="time"><?php echo Applib::time_elapsed_string(strtotime($a->activity_date));?></span>
								</div>
							</div>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>