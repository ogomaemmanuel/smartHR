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
	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<table id="table-clients" class="table table-striped custom-table m-b-0 AppendDataTables">
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