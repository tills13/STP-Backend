<div class="partner entity" data-id="<?=$partner->getId()?>">
    <a href="<?=$router->generateUrl('partners:overview', ['partner' => $partner->getId()])?>">
        <div class="header">
            <img src="<?=$partner->getLogo()?>" width="50px" height="50px">
            <h2><?=$partner->getName()?></h2>
        </div>
        <hr/>
        <p><?=$partner->getDescription()?></p>
        <div class="jobs clearfix">
            <?=count($partner->getContracts())?> contracts available
            <?php if (count($partner->getContracts()) != 0) { ?>
                <span class="pull-right">click to view</span>
            <?php } ?>
        </div>
    </a>
</div>