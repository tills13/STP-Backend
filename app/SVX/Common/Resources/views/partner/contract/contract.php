<div class="entity contract" data-id="<?=$contract->getId()?>">
    <a href="">
        <div class="header">
            <h3 class="alt">#<?=$contract->getId()?> <small><?=$contract->getTitle()?></small></h3>
        </div>
        <hr/>
        <p><?=$contract->getDescription()?></p>
        <div class="items">
            <?php foreach($contract->getItems() as $index => $item) { ?>
                <div class="row">
                    <div class="name col-sm-6">
                        <?=$item->getItem()['name']?>
                    </div>
                    <div class="quantity col-sm-6 text-right">
                        <?=$item->getQuantity()?>
                    </div>
                </div>
                <?php if ($index < (count($contract->getItems()) - 1)) { ?><hr/><?php } ?>
            <?php } ?>
        </div>
        <div class="row footer">
            <div class="col-md-6 text-left">
                <?php
                     $remaining = $contract->getRemainingOrders();
                     $total = $contract->getTotalOrders();

                     if ($remaining < ($total * 0.25)) $label = "label-danger";
                     else if ($remaining < ($total * 0.50) && $remaining > ($total * 0.25)) $label = "label-warning";
                     else $label = "label-success";
                ?>
                <div class="label <?=$label?>">
                    <?=$remaining?>/<strong><?=$total?></strong>
                </div>
            </div>
            <div class="col-md-6 text-right">
                <div class="cost label label-primary">
                    <?=$contract->getPayout(true)?><span class="gold">G</span>
                </div>
            </div>
        </div>
    </a>
</div>