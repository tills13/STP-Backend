<div class="entity" data-id="<?=$contract->getId()?>">
    <a href="">
        <div class="header">
            <h3 class="alt">#<?=$contract->getId()?> <small><?=$contract->getTitle()?></small></h3>
        </div>
        <hr/>
        <p><?=$contract->getDescription()?></p>
        <div class="row footer">
            <div class="col-md-12 text-right">
                <div class="cost label label-primary">
                    <?=$contract->getPayout(true)?><span class="gold">G</span>
                </div>
            </div>
        </div>
    </a>
</div>