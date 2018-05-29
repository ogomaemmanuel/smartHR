
<div class="content container-fluid">
	<div class="col-xs-12">
		<h4 class="page-title"><?=lang('activities')?></h4>
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
										<a><?=User::displayName($a->user)?></a>&nbsp;&nbsp;
										<a><?=strtoupper($a->module)?></a>&nbsp;&nbsp;
										<a>
											<?php 
											if (lang($a->activity) != '') {
												if (!empty($a->value1)) {
													if (!empty($a->value2)){
														echo sprintf(lang($a->activity), '<em>'.$a->value1.'</em>', '<em>'.$a->value2.'</em>');
													} else {
														echo sprintf(lang($a->activity), '<em>'.$a->value1.'</em>');
													}
												} else { echo lang($a->activity); }
											} else { echo $a->activity; } 
											?>
											</a>
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