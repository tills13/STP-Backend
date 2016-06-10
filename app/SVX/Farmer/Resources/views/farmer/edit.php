<?=$this->extend('master')?>

<?=$this->block('title', 'Edit Profile')?>

<?=$this->block('body')?>
    <div class="page-header">
        <h3>Edit Profile</h3>
    </div>
    <?=$form->start()?>
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Username</span>
                        <?=$form->get('username')->render()?>    
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label><?=$form->get('is_admin')->getName()?></label>
                    <?=$form->get('is_admin')->render()?>
                </div>
            </div>
        </div>
        <div class="text-right">
            <div class="btn-group">
                <input type="reset" class="btn btn-warning"/>
                <input type="submit" class="btn btn-success">
            </div>
        </div>
    <?=$form->end()?>
<?=$this->endBlock()?>
