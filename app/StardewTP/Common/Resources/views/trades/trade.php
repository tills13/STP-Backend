<div class="trade" data-id="<?=$trade['id']?>">
    <a href="<?=$router->generateUrl('trade_overview', ['trade' => $trade['id']])?>">
        <h3>#<?=$trade['id']?> <span class="alt"><?=$trade['seller']?></span></h3>

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