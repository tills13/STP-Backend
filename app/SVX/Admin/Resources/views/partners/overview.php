<?=$this->extend('master')?>

<?=$this->block('body')?>
    <div class="partner-overview">
        <div class="row info">
            <div class="col-md-4 col-sm-4">
                <img src="<?=$partner->getLogo()?>" width="100%">
                <hr/>
                <div class="btn-group full">
                    <a class="btn btn-primary" href="<?=$router->generateUrl('partner:edit', ['partner' => $partner->getId()])?>">Edit</a>
                    <a class="btn btn-success" href="<?=$router->generateUrl('partner:new_contract', ['partner' => $partner->getId()])?>">New Contract</a>
                </div>
            </div>
            <div class="col-md-8 col-sm-8">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h2><?=$partner->getName()?></h2>
                        </div>
                    </div>
                </div>
                <p class="lead"><?=nl2br($partner->getDescription()) ?: "No description provided"?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?=$this->import('misc/entity_list', [
                    'header' => true,
                    'title' => 'Contracts',
                    'listId' => 'contract-list',
                    'items' => $partner->getContracts(),
                    'itemId' => 'contract',
                    'listTemplate' => 'partners/contracts/contract'
                ])?>
            </div>
        </div>
    </div>
    
<?=$this->endBlock()?>