<?=$this->extend('master')?>

<?=$this->block('title', 'New Partner')?>

<?=$this->block('javascript')?>
    <script type="text/javascript" src="<?=$router->generateUrl('javascript', [
        'filename' => 'partner.js'
    ])?>"></script>
<?=$this->endBlock()?>

<?=$this->block('body')?>
    <div class="row">
        <div class="col-md-12">
            <?=$form->start()?>
                <div class="page-header logo-header logo-small">
                    <img src="<?=$partner->getLogo()?>" class="logo small">
                    <h2><strong rel="partner-name"><?=$partner->getName()?></strong></h2>
                </div>
                <div class="form-group">
                    <?=$form->get('name')->render()?>                    
                </div>
                <div class="form-group">
                    <?=$form->get('description')->render()?>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <?=$form->get('logo')->render()?>
                    </div>
                    <div class="col-md-6 form-group">
                        <select name="<?=$form->get('logo')->getName()?>" class="form-control">
                            <option value="">Other</option>
                            <?php foreach ($logos as $logo) { 
                                $url = $router->generateUrl('logo', [
                                    'filename' => $logo
                                ]);
                            ?>
                                <option value="<?=$url?>"><?=$logo?></option>
                            <?php } ?>
                        </select>
                    </div>
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
    </div>
    
<?=$this->endBlock()?>