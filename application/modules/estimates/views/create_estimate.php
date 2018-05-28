<div class="content">
	<div class="row">
		<div class="col-xs-12">
			<h3 class="page-title"><?=lang('create_estimate')?></h3>
		</div>
	</div>
	<!-- Start create estimate -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel">
				<div class="panel-body">
					<?php $attributes = array('class' => 'bs-example form-horizontal'); echo form_open(base_url().'estimates/add',$attributes); ?>
						<div class="form-group">
							<label class="col-lg-3 control-label"><?=lang('reference_no')?> <span class="text-danger">*</span></label>
							<div class="col-lg-4">
								<?php $this->load->helper('string'); ?>
								<input type="text" class="form-control" value="<?=config_item('estimate_prefix')?><?=Estimate::generate_estimate_number();?>" name="reference_no">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label"><?=lang('client')?> <span class="text-danger">*</span> </label>
							<div class="col-lg-4">
								<select class="select2-option" style="width:100%" name="client" >
									<optgroup label="<?=lang('clients')?>">
										<?php foreach (Client::get_all_clients() as $client): ?>
										<option value="<?=$client->co_id?>"><?=ucfirst($client->company_name)?></option>
										<?php endforeach; ?>
									</optgroup>
								</select>
							</div>
							<?php if(User::is_admin()) : ?>
							<a href="<?=base_url()?>companies/create" class="btn btn-primary" data-toggle="ajaxModal" title="<?=lang('new_company')?>" data-placement="bottom">
								<i class="fa fa-plus"></i> <?=lang('new_client')?>
							</a>
							<?php endif; ?>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label"><?=lang('due_date')?></label>
							<div class="col-lg-4">
								<input class="datepicker-input form-control" type="text" value="<?=strftime(config_item('date_format'), time());?>" name="due_date" data-date-format="<?=config_item('date_picker_format');?>" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label"><?=lang('tax')?> 1</label>
							<div class="col-lg-4">
								<div class="input-group">
									<span class="input-group-addon">%</span>
									<input class="form-control money" type="text" value="<?=config_item('default_tax')?>" name="tax">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label"><?=lang('tax')?> 2</label>
							<div class="col-lg-4">
								<div class="input-group">
									<span class="input-group-addon">%</span>
									<input class="form-control money" type="text" value="<?=config_item('default_tax2')?>" name="tax2">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label"><?=lang('discount')?></label>
							<div class="col-lg-4">
								<div class="input-group">
									<span class="input-group-addon">%</span>
									<input class="form-control money" type="text" value="0.00" name="discount">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label"><?=lang('notes')?> </label>
							<div class="col-lg-9">
								<textarea name="notes" class="form-control foeditor"><?=config_item('estimate_terms')?></textarea>
							</div>
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> <?=lang('create_estimate')?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<!-- End create estimate -->
</div>