<?=$this->extend('master')?>

<?=$this->block('title', 'Edit Profile')?>

<?=$this->block('body')?>
    <div class="page-header">
        <div class="row"> 
            <div class="col-md-6 col-sm-6 col-xs-6">
                <h3>Edit Profile</h3>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="text-right">
                    <b>Last Sync:</b> <?=$farmer->getLastSync()->format('Y-m-d')?>
                </div>
            </div>
        </div>
    </div>

    <?php if (!$form->isValid()) { 
        foreach ($form->getErrors() as $error) { ?>
            <div class="alert alert-danger">
                <?=$error->getMessage()?>
            </div>
    <?php } } ?>

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
