<style>
.datepicker{ z-index:1151 !important; }

</style>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"><?=lang('add_event')?></h4>
		</div><?php
			 $attributes = array('class' => 'bs-example');
          echo form_open(base_url().'calendar/add_event',$attributes); ?>
		<div class="modal-body">

			 <div class="form-group">
				<label><?=lang('event_name')?> <span class="text-danger">*</span></label>
					<input type="text" class="form-control" placeholder="<?=lang('event_name')?>" name="event_name">
				</div>

				<div class="form-group">
				<label><?=lang('description')?></label>
					<textarea class="form-control ta" name="description"></textarea>
				</div>


				<div class="form-group">
                                    <label><?=lang('start_date')?> <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="datepicker-input form-control" type="text" value="<?=strftime(config_item('date_format'));?>" name="start_date" data-date-format="<?=config_item('date_picker_format');?>" data-date-start-date="0d" >
                                    </div>
                                </div>

                <div class="form-group">
                                    <label><?=lang('end_date')?> <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="datepicker-input form-control" type="text" value="<?=strftime(config_item('date_format'));?>" name="end_date" data-date-format="<?=config_item('date_picker_format');?>" data-date-start-date="0d">
                                    </div>
                                </div>



				<div class="form-group">
                                <label><?=lang('project')?></label>
                                    <select class="select2-option form-control" name="project" >
                                    <optgroup label="<?=lang('none')?>">
                                        <option value="0" selected="selected"><?=lang('none')?></option>
                                    </optgroup>
                                    <optgroup label="<?=lang('projects')?>">
										<?php if(User::is_admin()) : ?>
											<?php $list = Project::all(); ?>
										<?php else: ?>
											<?php $list = $this->db->join('assign_projects','project_assigned = project_id')
											                  ->where('assigned_user',User::get_id())->get('projects')->result();
											?>
										<?php endif; ?>

                                        <?php foreach ($list as $p){ ?>
                                        <option value="<?=$p->project_id?>"><?=$p->project_title?></option>
                                        <?php } ?>
                                    </optgroup>
                                    </select>
                            </div>

                <div class="form-group">
				<label><?=lang('event_color')?> <span class="text-danger">*</span></label>
					<input type="text" class="form-control" placeholder="#38354a" name="color">
				</div>



		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-danger" data-dismiss="modal"><?=lang('close')?></a>
		<button type="submit" class="btn btn-success"><?=lang('add_event')?></button>
		</form>
		</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
<script type="text/javascript">
    $('.datepicker-input').datepicker({ language: locale, autoclose: true});
</script>
<script type="text/javascript">
    $(".select2-option").select2();
</script>
