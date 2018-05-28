<div class="content">  
	<div class="row">
		<div class="col-xs-4">
			<h4 class="page-title"><?='Pay Slip';?></h4>
		</div>
	</div>
	<?php  
	if ($this->tank_auth->user_role($this->tank_auth->get_role_id()) == 'admin') { ?>
	<div class="table-responsive">
	   <?php 
		$users_list = $this->db->query("SELECT u.*,ad.*,(select concat(amount,'[^]',date_created) from fx_salary where user_id = u.id order by id desc limit 1) as salary_det
										FROM `fx_users` u  
										left join fx_account_details ad on ad.user_id = u.id 
										where u.activated = 1 and u.role_id = 3 order by u.created desc")->result_array();
	   ?>
	   <table id="table-users" class="table table-striped custom-table m-b-0 AppendDataTables">
			<thead>
				<tr>
					<th> # </th> 
					<th> Fullname </th> 
					<th> Company </th>
					<th> Current Salary </th>
					<th> Role </th>
					<th class="hidden-sm"> Registered on</th>
					<th class="col-options no-sort text-right">Options</th>
				</tr>
			 </thead>
			 <tbody>
				<?php  foreach($users_list as $key => $usrs){  ?>
				<tr>
					<td><?=$key+1?></td>
					<td>
						<a class="pull-left thumb-sm avatar">
							<?php 
							if(config_item('use_gravatar') == 'TRUE' AND 
								Applib::get_table_field(Applib::$profile_table,
									array('user_id'=>$usrs['user_id']),'use_gravatar') == 'Y'){
												$user_email = Applib::login_info($usrs['user_id'])->email; 
							?>
							<img src="<?=$this->applib->get_gravatar($user_email)?>" class="img-circle">
							<?php }else{ ?>
							<img src="<?=base_url()?>assets/avatar/<?=Applib::profile_info($usrs['user_id'])->avatar?>" class="img-circle">
							<?php } ?>
						</a>
						<h2>
							<a href="javascript:;"> 
								<?=$usrs['fullname']?>
							</a>
						</h2>
					</td> 
					<td>
						<a href="<?=base_url()?>companies/view/<?=$usrs['company']?>" class="text-info">
							<?=$this->applib->company_details($usrs['company'],'company_name')?>
						</a>
					</td>
					<td>  
					<?php
						$salary = ''; 
						if(isset($usrs['salary_det'])&& $usrs['salary_det'] != ''){
							$exp = explode('[^]',$usrs['salary_det']);
							if($exp[0] != 0){ $salary = $exp[0]; }
						} 
						?>
						<strong> <?php echo  $salary; ?> </strong> 
					</td>
					<td>
						<span class="label label-info"><?='staff'?></span>
					</td>
					<td>
						<?=strftime(config_item('date_format'), strtotime($usrs['created']));?>
					</td> 
					<td class="text-right">
						<a class="btn btn-success btn-xs" data-toggle="ajaxModal" href="<?=base_url()?>payroll/edit_salary/<?=$usrs['user_id']?>" title="Edit Salary" data-original-title="Edit Salary">
							<i title="Edit Salary" class="fa fa-suitcase"></i>
						</a>
						<a class="btn btn-danger btn-xs" data-toggle="ajaxModal" href="<?=base_url()?>payroll/create/<?=$usrs['user_id']?>" title="Create Pay Slip" data-original-title="Create Pay Slip">
							<i title="Create Pay Slip" class="fa fa-money"></i>
						</a>    
					</td>
				</tr>
				<?php } ?>  
			</tbody>
	   </table>    
   </div>
   <?php } ?>
</div>