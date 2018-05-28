<div class="row">
    <!-- Start Form -->
    <div class="col-lg-12">
        <?php
        $attributes = array('class' => 'bs-example form-horizontal');
        echo form_open_multipart('settings/departments', $attributes); ?>
            <div class="panel panel-white">
                <div class="panel-heading">
					<h3 class="panel-title"><?=lang('departments')?></h3>
				</div>
                <div class="panel-body">
                    <input type="hidden" name="settings" value="<?=$load_setting?>">
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?=lang('department_name')?> <span class="text-danger">*</span></label>
                        <div class="col-lg-7">
                            <input type="text" name="deptname" class="form-control" style="width:260px" placeholder="<?=lang('department_name')?>" required>
                        </div>
                    </div>
                    <?php
                    $departments = $this -> db -> get('departments') -> result();
                    if (!empty($departments)) {
                        foreach ($departments as $key => $d) { ?>
                            <label class="label label-danger"><a href="<?=base_url()?>settings/edit_dept/<?=$d->deptid?>" data-toggle="ajaxModal" title = ""><?=$d->deptname?></a></label>
                        <?php } } ?>
					<div class="text-center m-t-30">
                        <button type="submit" class="btn btn-primary btn-lg"><?=lang('save_changes')?></button>
					</div>
                </div>
            </div>
        </form>
    </div>
    <!-- End Form -->
</div>