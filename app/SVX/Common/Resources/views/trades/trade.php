<div class="trade entity" data-id="<?=$trade->getId()?>">
    <a href="<?=$router->generateUrl('trade_overview', ['trade' => $trade->getId()])?>">
        <div class="row">
            <div class="col-md-6">
                <h3>#<?=$trade->getId()?> <span class="alt"><?=$trade->getSeller()->getUsername()?></span></h3>
            </div>
            <?php if ($trade->getTitle() != null) { ?>
                <div class="col-md-6 text-right">
                    <?=$trade->getTitle()?>
                </div>
            <?php } ?>
        </div>

        <hr/>

        <div class="row">
            <div class="col-md-12">
                <?php foreach ($trade->getItems() as $item) { ?>
                    <?=$this->import('trades/items/item', ['item' => $item])?>
                <?php } ?>
            </div>
        </div>

        <div class="footer row">
            <div class="col-md-12 text-right">
                <div class="cost label label-primary">
                    <?=$trade->getAskingPrice()?><span class="gold">G</span>
                </div>
            </div>
        </div>
    </a>
</div>