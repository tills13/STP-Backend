<?=$this->extend('master')?>

<?=$this->block('body')?>
    <div class="partner-overview">
        <div class="row info">
            <div class="col-md-4">
                <img src="<?=$partner->getLogo()?>" width="100%">
            </div>
            <div class="col-md-8">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h2><?=$partner->getName()?></h2>
                        </div>
                    </div>
                </div>
                <p class="lead"><?=nl2br($partner->getDescription()) ?: "No description provided"?></p>
                <div class="text-right">
                    <div class="btn-group">
                        <a class="btn btn-success" href="<?=$router->generateUrl('partner:edit', ['partner' => $partner->getId()])?>">Edit Partner</a>
                        <a class="btn btn-success" href="<?=$router->generateUrl('partner:new_contract', ['partner' => $partner->getId()])?>">New Contract</a>
                    </div>
                </div>
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