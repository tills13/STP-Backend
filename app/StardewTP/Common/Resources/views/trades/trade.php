<div class="trade" data-id="<?=$trade['id']?>">
    <a href="<?=$router->generateUrl('trade_overview', ['trade' => $trade['id']])?>">
        <?php if ($trade['title'] != null) { ?>
            <div class="row">
                <div class="col-md-6">
                    <h3>#<?=$trade['id']?> <span class="alt"><?=$trade['seller']?></span></h3>
                </div>
                <div class="col-md-6 text-right">
                    <?=$trade['title']?>
                </div>
            </div>
        <?php } else { ?>
            <h3>#<?=$trade['id']?> <span class="alt"><?=$trade['seller']?></span></h3>
        <?php } ?>

        <hr/>
        
        <div class="row">
            <div class="col-md-12">
                <?php foreach ($trade['items'] as $item) { ?>
                    <?=$this->import('trades/items/item', ['item' => $item])?>
                <?php } ?>
            </div>
        </div>

        <div class="footer row">
            <div class="col-md-12 text-right">
                <div class="cost label label-primary">
                    <?=$trade['asking_price']?><span class="gold">G</span>
                </div>
            </div>
        </div>
    </a>
</div>