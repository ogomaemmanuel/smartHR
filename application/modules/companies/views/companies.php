<div class="content">
	<div class="row">
		<div class="col-sm-4 col-xs-3">
			<h4 class="page-title"><?=lang('clients')?></h4>
		</div>
		<div class="col-sm-8 col-xs-9 text-right m-b-20">
			<a class="btn btn-primary rounded pull-right" href="<?=base_url()?>companies/create" data-toggle="ajaxModal" title="<?=lang('new_company')?>" data-placement="bottom">
				<i class="fa fa-plus"></i> <?=lang('new_client')?>
			</a>
		</div>
	</div>

	<div class="row filter-row">
						<div class="col-sm-3 col-xs-6">  
							<div class="form-group form-focus">
								<label class="control-label">Client</label>
								<input type="text" id="client_name" name="client_name" class="form-control floating">
							</div>
						</div>
						<div class="col-sm-3 col-xs-6">  
							<div class="form-group form-focus">
								<label class="control-label" >Email</label>
								<input type="text" id="client_email" name="client_email" class="form-control floating">
							</div>
						</div>
					<!-- 	<div class="col-sm-3 col-xs-6"> 
							<div class="form-group form-focus select-focus">
								<label class="control-label">Role</label>
								<select class="select floating select2-hidden-accessible" tabindex="-1" aria-hidden="true"> 
									<option value="">Select Roll</option>
									<option value="">Web Developer</option>
									<option value="1">Web Designer</option>
									<option value="1">Android Developer</option>
									<option value="1">Ios Developer</option>
								</select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-io4z-container"><span class="select2-selection__rendered" id="select2-io4z-container" title="Select Roll">Select Roll</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
							</div>
						</div> -->
						<div class="col-sm-3 col-xs-6">  
							<a href="javascript:void(0)" id="client_search" class="btn btn-success btn-block"> Search </a>  
						</div>     
                    </div>

	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<table id="table-clients-compaines" class="table table-striped custom-table m-b-0">
					<thead>
						<tr>
							<th><?=lang('client')?> </th>
							<th><?=lang('due_amount')?></th>
							<th><?=lang('expense_cost')?> </th>
							<th class="hidden-sm"><?=lang('primary_contact')?></th>
							<th><?=lang('email')?> </th>
							<th class="col-options no-sort text-right"></th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (!empty($companies)) {
						foreach ($companies as $client) { 
						$client_due = Client::due_amount($client->co_id);
						?>
						<tr>
							<td>
								<h2>
									<a href="<?=base_url()?>companies/view/<?=$client->co_id?>" class="text-info">
										<?=($client->company_name != NULL) ? $client->company_name : '...'; ?>
									</a>
								</h2>
							</td>
							<td>
								<strong><?=Applib::format_currency($client->currency, $client_due)?></strong>
							</td>
							<td>
								<strong <?=(Expense::total_by_client($client->co_id) > 0) ? 'class="text-danger"' : 'class="text-success"';?>>
									<?=Applib::format_currency($client->currency, Expense::total_by_client($client->co_id))?>
								</strong>
							</td>
							<td class="hidden-sm">
								<?php if ($client->individual == 0) { 
									echo ($client->primary_contact) ? User::displayName($client->primary_contact) : 'N/A'; 
								} ?>
							</td>
							<td><?=$client->company_email?></td>
							<td class="text-right">
								<a href="<?=base_url()?>companies/delete/<?=$client->co_id?>" class="btn btn-danger btn-xs" data-toggle="ajaxModal" title="<?=lang('delete')?>">
									<i class="fa fa-trash-o"></i>
								</a>
							</td>
						</tr>
                    <?php } } ?>
					</tbody>
                </table>
			</div>        
		</div>
	</div>
</div>