<?php
$i = Client::view_by_id($company);
$cur = Client::client_currency($i->co_id);
$due = Client::due_amount($i->co_id);
($i->is_lead == 1) ? redirect('leads/view/'.$i->co_id) : '';
?>
<div class="header-fixed clearfix">
	<div class="row">
		<div class="col-xs-6">
			<h3 class="page-title m-b-0"><?=$i->company_name?> <span class="label label-default"><?=$i->company_ref?></span></h3>
		</div>
		<div class="col-xs-6">
			<a href="<?=base_url()?>companies/update/<?=$i->co_id?>" class="btn btn-success btn-sm pull-right" data-toggle="ajaxModal" title="<?=lang('edit')?>"><i class="fa fa-edit"></i> <?=lang('edit')?></a>
		</div>
	</div>
</div>
<div class="content">
	<div class="sub-tab m-b-20">
		<ul class="nav nav-tabs nav-tabs-bottom bg-white">
			<li class="<?=($tab == 'dashboard') ? 'active' : '';?>">
				<a href="<?=base_url()?>companies/view/<?=$i->co_id?>/dashboard"><?=lang('overview')?></a>
			</li>
			<li class="<?=($tab == 'contacts') ? 'active' : '';?>">
				<a href="<?=base_url()?>companies/view/<?=$i->co_id?>/contacts"><?=lang('contacts')?></a>
			</li>
			<li class="<?=($tab == 'projects') ? 'active' : '';?>">
				<a href="<?=base_url()?>companies/view/<?=$i->co_id?>/projects"><?=lang('projects')?></a>
			</li>
			<li class="<?=($tab == 'invoices') ? 'active' : '';?>">
				<a href="<?=base_url()?>companies/view/<?=$i->co_id?>/invoices"><?=lang('invoices')?></a>
			</li>
			<li class="<?=($tab == 'estimates') ? 'active' : '';?>">
				<a href="<?=base_url()?>companies/view/<?=$i->co_id?>/estimates"><?=lang('estimates')?></a>
			</li>
			<li class="<?=($tab == 'payments') ? 'active' : '';?>">
				<a href="<?=base_url()?>companies/view/<?=$i->co_id?>/payments"><?=lang('payments')?></a>
			</li>
			<li class="<?=($tab == 'expenses') ? 'active' : '';?>">
				<a href="<?=base_url()?>companies/view/<?=$i->co_id?>/expenses"><?=lang('expenses')?></a>
			</li>
			<li class="<?=($tab == 'files') ? 'active' : '';?>">
				<a href="<?=base_url()?>companies/view/<?=$i->co_id?>/files"><?=lang('files')?></a>
			</li>
			<li class="<?=($tab == 'comments') ? 'active' : '';?>">
				<?php $count = $this->db->where(array('client_id'=>$i->co_id,'unread'=>1))->get('comments')->num_rows();?>
				<a href="<?=base_url()?>companies/view/<?=$i->co_id?>/comments">
					<?=lang('comments')?>
					<?=($count > 0) ? '<label class="label bg-success">'.$count.'</label>' : '';?>
				</a>
			</li>
		</ul>
	</div>
	<?php if($due > 0) : ?>
	<div class="overdue-cn-banner fill-container alert alert-success">
		<strong> Balance: </strong> Client has a balance of <?=Applib::format_currency($cur->code, $due);?>
	</div>
	<?php endif; ?>
	<div class="company-content">
		<?php $data = array('i' => $i,'cur' => $cur,'due' => $due); ?>
		<?php $this->view('tab/view_'.$tab, $data); ?>
	</div>
</div>