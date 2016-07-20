<?=$this->extend('master')?>

<?=$this->block('title', 'New Contract')?>

<?=$this->block('body')?>
    <div class="row">
        <div class="col-md-6">
            <div class="page-header logo-header logo-small">
                <img src="<?=$partner->getLogo()?>" class="logo small">
                <h2>New Contract</h2>
            </div>
            <?=$form->start()?>
                <div class="form-group">
                    <?=$form->get('title')->render()?>                    
                </div>
                <div class="form-group">
                    <?=$form->get('description')->render()?>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?=$form->get('payout')->render()?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?=$form->get('total_orders')->render()?>
                        </div>
                    </div>
                </div>
                
                <div class="items">
                    <h3>Contract Items <small rel="add-contract-item">new</small></h3>
                    <hr/>
                    <div class="form-group item">  
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select id="items" class="form-control" name="<?=$form->getName()?>[items][item][]">
                                        <?php foreach ($items as $item) { ?>
                                            <option value="<?=$item['id']?>"><?=$item['name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select id="quality" class="form-control" name="<?=$form->getName()?>[items][quality][]">
                                        <option value="0">Bronze</option>
                                        <option value="1">Silver</option>
                                        <option value="2">Gold</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="number" min="1" class="form-control" id="quantity" placeholder="quantity" name="<?=$form->getName()?>[items][quantity][]"/>
                                </div>
                            </div>
                        </div> 
                    </div>
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