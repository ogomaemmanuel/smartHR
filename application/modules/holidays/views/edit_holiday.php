<div class="content">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h4 class="page-title"><?='Edit Holiday';?></h4>
			<?php  
			 if(!isset($holidays_det) || empty($holidays_det)){ redirect(base_url().'holidays');} 
			 $attributes = array('class' => 'bs-example');
			echo form_open(base_url().'holidays/edit',$attributes); ?> 
				<div class="form-group">
					<label>Holiday Name <span class="text-danger">*</span></label>
					<input type="text" class="form-control" value="<?=$holidays_det[0]['title']?>" name="holiday_title" required>
				</div>
				<div class="form-group">
					<label>Holiday Date <span class="text-danger">*</span></label>
					<div class="cal-icon">
						<input class="datepicker-input form-control" type="text"  value="<?=date('d-m-Y',strtotime($holidays_det[0]['holiday_date']))?>" name="holiday_date" data-date-format="dd-mm-yyyy" required >
					</div>
				</div>
				<div class="form-group">
					<label>Holiday Description</label>
					<textarea class="form-control" name="holiday_description"> <?=$holidays_det[0]['description']?> </textarea>
				</div>
				<div class="m-t-20 text-center">
					<input type="hidden" name="holiday_tbl_id" value="<?=$holidays_det[0]['id']?>">
					<button class="btn btn-primary" type="submit"> Update Holiday</button>
					<a href="<?php echo base_url().'holidays';?>" >
						<button class="btn btn-danger" type="button"> Cancel </button>
					</a>
				</div>
			</form>
		</div>
	</div>
</div> 