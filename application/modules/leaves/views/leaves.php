<div class="content">
	<div class="row">
		<div class="col-sm-8">
			<h4 class="page-title">Leaves</h4>
		</div>
		<div class="col-sm-4 text-right m-b-30">
			<?php if ($this->tank_auth->user_role($this->tank_auth->get_role_id()) != 'admin') { ?>
			<a href="javascript:;" class="btn btn-primary rounded pull-right" onclick="$('.new_leave_reqst').show();$('#date_alert_msg').hide();"><i class="fa fa-plus"></i> <?='New Leave Request';?></a>
			<?php } ?>
		</div>
	</div>
	<?php  if($this->session->flashdata('alert_message')){?>
	<div class="panel panel-default" id="date_alert_msg">
		<div class="panel-heading font-bold" style="color:white; background:#FF0000">
			<i class="fa fa-info-circle"></i> Alert Details 
			<i class="fa fa-times pull-right" style="cursor:pointer" onclick="$('#date_alert_msg').hide();"></i>
		</div>
		<div class="panel-body">
			<p style="color:red"> Already you have make request for now requested Dates! Please Check...</p>
		</div>
	</div>
	<?php  }  ?>  
	<div class="panel panel-white new_leave_reqst" style="display:none">
		<div class="panel-heading">
			<h3 class="panel-title">New Leave Request</h3>
		</div>
		<div class="panel-body"> 
			<?php $attributes = array('class' => 'bs-example form-horizontal');
			echo form_open(base_url().'leaves/add',$attributes); ?> 
			<?php $leav_types =  $this->db->query("SELECT * FROM `fx_leave_types` where status = 0")->result_array();  ?> 
				<div class="form-group">
					<label class="col-lg-2 control-label"> Leave Type <span class="text-danger">*</span></label>
					<div class="col-lg-3">
						<select class="select2-option" style="width:100%;" id="req_leave_type" name="req_leave_type" required> 
							<option value=""> -- Select Leave Type -- </option>
							<?php for($i = 0;$i < count($leav_types); $i++ ){ ?>
							<option value="<?=$leav_types[$i]['id']?>"><?=$leav_types[$i]['leave_type'].' - '.$leav_types[$i]['leave_days'].' Days'?></option>
							<?php } ?>       
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label"> Date From <span class="text-danger">*</span></label>
					<div class="col-lg-3">
						<input class="leave_datepicker form-control" size="16" type="text"
						onchange="leave_days_calc();"
						  value="" name="req_leave_date_from" id="req_leave_date_from" data-date-format="dd-mm-yyyy" required > 
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label"> Date To <span class="text-danger">*</span></label>
					<div class="col-lg-3">
					<input class="leave_datepicker form-control" size="16" type="text"  
					onchange="leave_days_calc();"
					value="" name="req_leave_date_to" id="req_leave_date_to" data-date-format="dd-mm-yyyy" required > 
					</div>
				</div>
				<div class="form-group" style="display:none" id="leave_day_type">
					<label class="col-lg-2 control-label">  &nbsp; </label>
					<div class="col-lg-3"> 
					 Full Day <input type="radio" name="req_leave_day_type" value="1" checked="checked" onclick="leave_day_type();"> 
					 &nbsp; First Half <input type="radio" name="req_leave_day_type" value="2" onclick="leave_day_type();"> 
					 &nbsp; Second Half <input type="radio" name="req_leave_day_type" value="3" onclick="leave_day_type();">
					 </div>
				</div> 
				<div class="form-group">
					<label class="col-lg-2 control-label"> Number of days </label>
					<div class="col-lg-1">
						<input type="text" name="req_leave_count" class="form-control" id="req_leave_count" value="" readonly="readonly">
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label"> Leave reason <span class="text-danger">*</span></label>
					<div class="col-lg-4">
						<textarea class="form-control" name="req_leave_reason" required> </textarea>
					</div>
				</div> 
				<div class="form-group">
					<label class="col-lg-2 control-label"> &nbsp; </label>
					<div class="col-lg-4">
						<button class="btn btn-success" type="submit"> Send Leave Request </button>
						<button class="btn btn-danger" type="button" onclick="$('.new_leave_reqst').hide();"> Cancel </button>
					 </div>
				</div> 
			</form> 
		</div>
	</div>
	<?php if ($this->tank_auth->user_role($this->tank_auth->get_role_id()) == 'admin') { ?>
	<!-- user leaves -->
		<div class="row filter-row">
			<div class="col-sm-4 col-md-4 col-xs-6 col-lg-2">
				<div class="form-group form-focus select-focus">
					<label class="control-label">Leave Type</label>
					<select class="select2-option floating" id="ser_leave_type" name="ser_leave_type" required>
						<option value=""> -- Leave Type -- </option>
						<?php for($i = 0;$i < count($leav_types); $i++ ){ ?>
						<option value="<?=$leav_types[$i]['id']?>"><?=$leav_types[$i]['leave_type']?></option>
						<?php } ?> 
					</select>
				</div>
			</div>
			<div class="col-sm-4 col-md-4 col-xs-6 col-lg-2">
				<div class="form-group form-focus select-focus">
					<label class="control-label">Leave Status</label>
					<select class="select2-option floating" id="ser_leave_sts" name="ser_leave_sts" required>
						<option value=""> -- Leave Status -- </option>
						<option value="0"> Pending </option>
						<option value="1"> Approved </option>
						<option value="2"> Rejected </option>
					</select>
				</div>
			</div>
			<div class="col-sm-4 col-md-4 col-xs-6 col-lg-2">
				<div class="form-group form-focus">
					<label class="control-label">User Name</label>
					<input type="text" class="form-control floating" id="ser_leave_user_name" name="ser_leave_user_name" value="">
				</div>
			</div>
			<div class="col-sm-8 col-md-8 col-xs-12 col-lg-4">
				<div class="row">
					<div class="col-sm-5 col-md-5 col-xs-5">
						<div class="form-group form-focus">
							<label class="control-label">Date From</label>
							<div class="cal-icon">
								<input class="form-control floating datepicker-input" type="text" data-date-format="dd-mm-yyyy" id="ser_leave_date_from" value="" size="16">
							</div>
						</div>
					</div>
					<div class="col-sm-1 col-md-1 col-xs-1"> 
						<i class="fa fa-refresh" style="cursor:pointer; margin-top:15px; font-size:18px" title="Clear From Date" onclick="$('#ser_leave_date_from').val('');"></i>
					</div>
					<div class="col-sm-5 col-md-5 col-xs-5">
						<div class="form-group form-focus">
							<label class="control-label">Date To</label>
							<div class="cal-icon">
								<input class="form-control floating datepicker-input" type="text" data-date-format="dd-mm-yyyy" id="ser_leave_date_to" value="" size="16">
							</div>
						</div>
					</div>
					<div class="col-sm-1 col-md-1 col-xs-1"> 
						<i class="fa fa-refresh" style="cursor:pointer; margin-top:15px; font-size:18px" title="Clear To Date" onclick="$('#ser_leave_date_to').val('');"></i>
				   </div>
				</div>
			</div>
			<div class="col-sm-4 col-md-4 col-xs-6 col-lg-2">
				<a href="<?php base_url();?>leaves/search_leaves" class="btn btn-success btn-block" id="admin_search_leave"> Search </a>
			</div>
		</div>
		<div class="table-responsive">
			<?php 
			$leave_list = $this->db->query("SELECT ul.*,lt.leave_type as l_type,ad.fullname
										FROM `fx_user_leaves` ul
										left join fx_leave_types lt on lt.id = ul.leave_type
										left join fx_account_details ad on ad.user_id = ul.user_id 
										where ul.status != 4 and DATE_FORMAT(ul.leave_from,'%Y') = ".date('Y')." order by ul.id  DESC ")->result_array();
	   ?>
			 <table id="table-holidays" class="table table-striped custom-table m-b-0 AppendDataTables">
				<thead>
					<tr>
						<th> No </th>
						<th> User </th>
						<th> Leave Type </th>
						<th> Date From </th>
						<th> Date To </th>
						<th> Reason </th> 
						<th> No.of Days </th>  
						<th> Status </th>  
						<th class="text-right"> Options </th>  
					</tr>
				</thead>
				<tbody id="admin_leave_tbl">
					<?php  foreach($leave_list as $key => $levs){  ?>
					<tr>
						<td><?=$key+1?></td>
						<td><?=$levs['fullname']?></td>
						<td><?=$levs['l_type']?></td>
						<td><?=date('d-m-Y',strtotime($levs['leave_from']))?></td>
						<td><?=date('d-m-Y',strtotime($levs['leave_to']))?></td>
						<td><?=$levs['leave_reason']?></td>
						<td>
							<?php 
							echo $levs['leave_days'];
							if($levs['leave_day_type'] == 1){
								echo ' ( Full Day )';
							}else if($levs['leave_day_type'] == 2){
								echo ' ( First Half )';
							}else if($levs['leave_day_type'] == 3){
								echo ' ( Second Half )';
							}?>
						  </td>
						<td>
						<?php
							if($levs['status'] == 0){
								echo ' <span class="label" style="background:#D2691E"> Pending </span>';
							}else if($levs['status'] == 1){
								echo '<span class="label label-success"> Approved </span> ';
							}else if($levs['status'] == 2){
								echo '<span class="label label-danger"> Rejected</span>';
							}else if($levs['status'] == 3){
								echo '<span class="label label-danger"> Cancelled</span>';
							}?>
						</td>
						<td class="text-right"> 
						<?php if($levs['status'] == 0){ ?>
							 <a  class="btn btn-success btn-xs"  
							 data-toggle="ajaxModal" href="<?=base_url()?>leaves/approve/<?=$levs['id']?>" title="Approve" data-original-title="Approve" >
								<i class="fa fa-thumbs-o-up"></i> 
							 </a>
						 <?php } 
						 if($levs['status'] == 0 || $levs['status'] == 1){ ?>     
							 <a class="btn btn-danger btn-xs"  
							 data-toggle="ajaxModal" href="<?=base_url()?>leaves/reject/<?=$levs['id']?>" title="Reject" data-original-title="Reject">
								<i class="fa fa-thumbs-o-down"></i> 
							 </a>
						 <?php } ?>
						 <!--<a class="btn btn-danger btn-xs"  
							 data-toggle="ajaxModal" href="<?=base_url()?>leaves/delete/<?=$levs['id']?>" title="Delete" data-original-title="Delete">
								<i class="fa fa-trash-o"></i> 
						 </a>-->
						</td>
					</tr>
				 <?php  } ?>  
				</tbody>
		   </table>    
	   </div>
		<!-- user leave end -->
		<?php } ?>
		<?php if ($this->tank_auth->user_role($this->tank_auth->get_role_id()) != 'admin') { ?>
		<!-- user leaves -->
		<div class="panel panel-table">
			<div class="panel-heading">
				<h3 class="panel-title">Leaves Details</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
				   <?php 
					$leave_list = $this->db->query("SELECT ul.*,lt.leave_type as l_type
													FROM `fx_user_leaves` ul
													left join fx_leave_types lt on lt.id = ul.leave_type
													where DATE_FORMAT(ul.leave_from,'%Y') = ".date('Y')." and 
													ul.status != 4 and ul.user_id =".$this->tank_auth->get_user_id()." order by ul.id  ASC ")->result_array();
				   ?>
					<table id="table-holidays" class="table table-striped custom-table m-b-0 AppendDataTables">
						<thead>
							<tr>
								<th> No </th>
								<th> Leave Type </th>
								<th> Date From </th>
								<th> Date To </th>
								<th> Reason </th> 
								<th> No.of Days </th>  
								<th> Status </th>  
								<th> Options </th>  
							</tr>
						</thead>
						<tbody>
						 <?php  foreach($leave_list as $key => $levs){  ?>
							<tr>
								<td><?=$key+1?></td>
								<td><?=$levs['l_type']?></td>
								<td><?=date('d-m-Y',strtotime($levs['leave_from']))?></td>
								<td><?=date('d-m-Y',strtotime($levs['leave_to']))?></td>
								<td><?=$levs['leave_reason']?></td>
								<td>
									<?php 
									echo $levs['leave_days'];
									if($levs['leave_day_type'] == 1){
										echo ' ( Full Day )';
									}else if($levs['leave_day_type'] == 2){
										echo ' ( First Half )';
									}else if($levs['leave_day_type'] == 3){
										echo ' ( Second Half )';
									}
									?>
								</td>
								<td>
								<?php
									if($levs['status'] == 0){
										echo '<span class="label" style="background:#D2691E"> Pending </span>';
									}else if($levs['status'] == 1){
										echo '<span class="label label-success"> Approved </span> ';
									}else if($levs['status'] == 2){
										echo '<span class="label label-danger"> Rejected</span>';
									}else if($levs['status'] == 3){
										echo '<span class="label label-danger"> Cancelled</span>';
									}
								?>
								</td>
								<td> 
								<?php if($levs['status'] == 0){ ?> 
									 <a class="btn btn-danger btn-xs"  
									 data-toggle="ajaxModal" href="<?=base_url()?>leaves/cancel/<?=$levs['id']?>" title="Cancel" data-original-title="Cancel">
										<i class="fa fa-times"></i> 
									 </a>
								<?php } ?>
									 <!--<a class="btn btn-danger btn-xs"  
									 data-toggle="ajaxModal" href="<?=base_url()?>leaves/delete/<?=$levs['id']?>" title="Delete" data-original-title="Delete">
										<i class="fa fa-trash-o"></i> 
									 </a>-->
								</td>
							</tr>
						 <?php  } ?>  
						</tbody>
				   </table>    
				</div>
			</div>
		</div>
	 <!-- user leave end -->
	 <?php } ?>
</div> 