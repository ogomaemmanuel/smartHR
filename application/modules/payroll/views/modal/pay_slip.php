<div class="modal-dialog" style="width:50%">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button> 
			<h4 class="modal-title"> Create Pay Slip </h4>
		</div>
		<?php echo form_open(base_url().'fopdf/payslip_pdf'); ?>
			<div class="modal-body">
				<input type="hidden" name="payslip_user_id" value="<?=$user_id?>"> 
				<div class="row"> 
					<div class="col-md-6"> 
						<div class="form-group"> 
							<label>Year <span class="text-danger">*</span></label>
							<select class="select2-option form-control" style="width:100%;"  name="payslip_year" id="payslip_year" required onchange="staff_salary_detail(<?=$user_id?>);"> 
								<option value=""> -- Select Year -- </option>
								<?php for($i = 2013;$i <= date('Y'); $i++ ){ ?>
								<option value="<?=$i?>" <?php if($i == date('Y')){ echo "selected";}?>><?=$i?></option>
								<?php } ?>       
							</select>
						</div>
					</div>
					<div class="col-md-6"> 
						<div class="form-group"> 
							<label>Month <span class="text-danger">*</span></label>
							<?php
							$mons = array(1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July", 
							8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December");
							?>
							<select class="select2-option form-control" style="width:100%; padding:5px"  name="payslip_month" id="payslip_month" required onchange="staff_salary_detail(<?=$user_id?>);"> 
								<option value=""> -- Select month -- </option>
								<?php foreach($mons as $key => $vl){ ?>
								<option value="<?=$key?>" <?php if($key == date('m')){ echo "selected";}?>><?=$vl?></option>
								<?php } ?>       
							</select>
						</div>
					</div>
				</div>
				<hr>   
				<div class="row"> 
					<div class="col-md-6"> 
						<h4 class="text-primary">Earnigns</h4>
						<div class="form-group">
							<label> Basic  </label>
							<?php
							$basic = $da = $hra = '';
							$curr_slry_res = $this->db->query("SELECT amount from fx_salary where user_id = ".$user_id." order by id desc limit 1")->result_array();
							if(!empty($curr_slry_res)){
							$da     = (40*$curr_slry_res[0]['amount']/100);
							$hra    = (15*$curr_slry_res[0]['amount']/100);
							$basic  = ($curr_slry_res[0]['amount']-($da+$hra));
							}
							?> 
							<input type="text" name="payslip_basic" id="payslip_basic"  class="form-control"  value="<?=$basic?>" readonly="readonly">
						</div>
						<div class="form-group">
							<label> DA(40%) </label>
							<input type="text" name="payslip_da" id="payslip_da" class="form-control"  value="<?=$da?>" readonly="readonly">
						</div>
						<div class="form-group">
							<label>HRA(15%) </label>
							<input type="text" name="payslip_hra" id="payslip_hra" class="form-control"  value="<?=$hra?>" readonly="readonly">
						</div>
						<div class="form-group">
							<label> Conveyance </label>
							<input type="text" name="payslip_conveyance" id="payslip_conveyance" class="form-control"  value="" >
						</div>
						<div class="form-group">
							<label> Allowance </label>
							<input type="text" name="payslip_allowance" id="payslip_allowance" class="form-control"  value="" >
						</div>
						<div class="form-group">
							<label> Medical  Allowance </label>
							<input type="text" name="payslip_medical_allowance" id="payslip_medical_allowance" class="form-control"  value="" >
						</div>
						<div class="form-group">
							<label> Others </label>
							<input type="text" name="payslip_others" id="payslip_others" class="form-control"  value="" >
						</div>  
					</div>  
					<div class="col-md-6">
						<h4 class="text-primary"> Deductions </h4>
						<div class="form-group">
							<label> TDS </label>
							<input type="text" name="payslip_ded_tds" id="payslip_ded_tds" class="form-control"  value="" >
						</div> 
						<div class="form-group">
							<label> ESI </label>
							<input type="text" name="payslip_ded_esi" id="payslip_ded_esi" class="form-control"  value="" >
						</div>
						<div class="form-group">
							<label>PF</label>
							<input type="text" name="payslip_ded_pf" id="payslip_ded_pf" class="form-control"  value="" >
						</div>
						<div class="form-group">
							<label>Leave</label>
							<input type="text" name="payslip_ded_leave" id="payslip_ded_leave" class="form-control"  value="" >
						</div>
						<div class="form-group">
							<label>Prof. Tax </label>
							<input type="text" name="payslip_ded_prof" id="payslip_ded_prof" class="form-control"  value="" >
						</div>
						<div class="form-group">
							<label>Labour Welfare  </label>
							<input type="text" name="payslip_ded_welfare" id="payslip_ded_welfare" class="form-control"  value="" >
						</div>
						<div class="form-group">
							<label> Fund </label>
							<input type="text" name="payslip_ded_fund" id="payslip_ded_fund" class="form-control"  value="" >
						</div>
						<div class="form-group">
							<label> Others  </label>
							<input type="text" name="payslip_ded_others" id="payslip_ded_others" class="form-control"  value="" >
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer text-center">
				<button type="submit" class="btn btn-success"> Create Pay Slip </button>
				<a href="#" class="btn btn-danger" data-dismiss="modal"> Close </a>
			</div>
		</form>
	</div>
</div>