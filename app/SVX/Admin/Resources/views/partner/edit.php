<?=$this->extend('master')?>

<?=$this->block('body')?>
    <div class="row">
        <div class="col-md-6">
            <div class="page-header logo-header logo-small">
                <img src="<?=$partner->getLogo()?>" class="logo small">
                <h2>Edit <?=$partner->getName()?></h2>
            </div>
            <?=$form->start()?>
                <div class="form-group">
                    <?=$form->get('name')->render()?>                    
                </div>
                <div class="form-group">
                    <?=$form->get('description')->render()?>
                </div>
                <div class="form-group">
                    <?=$form->get('logo')->render()?>
                </div>
                <h3>Other Options</h3>
                <div class="form-group">
                    <label for="<?=$form->get('is_approved')->getId()?>">Approved</label>
                    <?=$form->get('is_approved')->render()?>
                </div>
                <div class="form-group">
                    <label for="<?=$form->get('is_enabled')->getId()?>">Enabled</label>
                    <?=$form->get('is_enabled')->render()?>
                </div>
                <div class="text-right">
                    <div class="btn-group">
                        <input class="btn btn-success" type="submit"/>
                        <input class="btn btn-warning" type="reset"/>
                    </div> 
                </div>
            <?=$form->end()?>
        </div>
        <div class="col-md-6">
            <div class="page-header logo-header">
                <h3>Latest Contract</h3>
            </div>
            <div class="entity-list list">
                <?php if (count($partner->getContracts()) == 0) { ?>
                    <p class="center">No contracts...</p>
                <?php } else { ?>
                    <?=$this->import('partner/contract/contract', ['contract' => $partner->getContracts()[0]])?>
                <?php } ?>
            </div>
        </div>
    </div>
    
<?=$this->endBlock()?>