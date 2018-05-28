<div class="content">
	<div class="row">
		<div class="col-sm-8">
			<h4 class="page-title"><?=lang('messages')?></h4>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3">
			<div class="card-box">
				<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
					<section id="setting-nav" class="hidden-xs">
						<ul class="mail-menu">
							<li class="<?php echo ($group == 'inbox') ? 'active' : '';?>">
								<a href="<?=base_url()?>messages?group=inbox"> <i class="fa fa-fw fa-envelope"></i>
									<?=lang('inbox')?>
								</a>
							</li>
							<li class="<?php echo ($group == 'sent') ? 'active' : '';?>">
								<a href="<?=base_url()?>messages?group=sent"> <i class="fa fa-fw fa-exchange"></i>
									<?=lang('sent')?>
								</a>
							</li>
							<li class="<?php echo ($group == 'favourites') ? 'active' : '';?>">
								<a href="<?=base_url()?>messages?group=favourites"> <i class="fa fa-fw fa-star"></i>
									<?=lang('favourites')?>
								</a>
							</li>
							<li class="<?php echo ($group == 'trash') ? 'active' : '';?>">
								<a href="<?=base_url()?>messages?group=trash"> <i class="fa fa-fw fa-trash-o"></i>
									<?=lang('trash')?>
								</a>
							</li>
						</ul>
					</section>
				</div>
			</div>
		</div>
		<div class="col-sm-9">
			<div class="row">
				<div class="col-md-12">
					<div class="card-box">
						<div class="email-header">
							<div class="row">
								<div class="col-xs-6 pull-right top-action-left">
									<?php echo form_open(base_url().'messages/search/'); ?>
										<div class="input-group">
											<input type="text" class="input-sm form-control" name="keyword" placeholder="<?=lang('keyword')?>">
												<span class="input-group-btn"> <button class="btn btn-sm btn-default" type="submit">Go!</button>
												</span>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="email-content">
							<div>
								<?=$this->session->flashdata('form_error')?>
								<?php

								$attributes = array('class' => 'bs-example form-horizontal');
								echo form_open(base_url().'messages/send',$attributes); ?>
									<div class="">
										<h4 class="m-b-20"><?=lang('message_notification')?></h4>
										<div class="form-group">
											<label class="col-lg-3 control-label"><?=lang('username')?> <span class="text-danger">*</span> </label>
											<div class="col-lg-9">
												<div class="m-b">
													<select class="select2-option" multiple="multiple" style="width:260px" required name="user_to[]" >
														<?php if(User::is_admin()){ ?>
														<optgroup label="<?=lang('administrators')?>">
															<?php foreach (User::admin_list() as $admin): ?>
																<option value="<?=$admin->id?>">
																<?=ucfirst(User::displayName($admin->id))?></option>
															<?php endforeach; ?>
														</optgroup>
														<optgroup label="<?=lang('staff')?>">
															<?php foreach (User::staff_list() as $s): ?>
																<option value="<?=$s->id?>">
																<?=ucfirst(User::displayName($s->id))?></option>
															<?php endforeach; ?>
														</optgroup>
														<optgroup label="<?=lang('clients')?>">
															<?php foreach (User::user_list() as $client): ?>
																<option value="<?=$client->id?>">
																<?=ucfirst(User::displayName($client->id))?></option>
															<?php endforeach; ?>
														</optgroup>
														<?php }else{ ?>
														<optgroup label="<?=lang('administrators')?>">
															<?php foreach (User::admin_list() as $admin): ?>
																<option value="<?=$admin->id?>">
																<?=ucfirst(User::displayName($admin->id))?></option>
															<?php endforeach; ?>
														</optgroup>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-3 control-label"><?=lang('message')?> <span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<textarea name="message" required class="form-control foeditor"></textarea>
											</div>
										</div>
										<div class="text-center">
											<button type="submit" class="btn btn-success"><?=lang('send_message')?></button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>