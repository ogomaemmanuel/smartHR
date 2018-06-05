<div class="col-lg-12">
        <form action="<?php echo base_url(); ?>settings/update" class="bs-example form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h3 class="panel-title">Salary Settings</h3>
                </div>
                <div class="panel-body">
                    <?php 
                        $settingsalray = array();
                        if(!empty($salary_setting)){
                            foreach ($salary_setting as  $value) {
                                $settingsalray[$value->config_key] = $value->value;
                            }
                        }

                     ?>
                    <input type="hidden" name="settings" value="setting_salary">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">DA <span class="text-danger">*</span></label>
                        <div class="col-lg-3">
                            <input type="number" min="0" max="40" name="salary_da"  class="form-control" value="<?php echo (!empty($settingsalray['salary_da']))?$settingsalray['salary_da']:''; ?>" required="" maxlength="2">
                        </div>
                    </div>
                   <div class="form-group">
                        <label class="col-lg-3 control-label">HRA <span class="text-danger">*</span></label>
                        <div class="col-lg-3">
                            <input type="number" min="0" max="20" name="salary_hra" class="form-control" value="<?php echo (!empty($settingsalray['salary_hra']))?$settingsalray['salary_hra']:''; ?>" required="" maxlength="2">
                        </div>
                    </div>
                    <div class="text-center m-t-30">
                        <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>