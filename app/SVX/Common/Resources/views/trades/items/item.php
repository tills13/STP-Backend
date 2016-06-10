<div class="item">
    <span class="quantity">
        <?=$item->getAmount()?>
        <i class="fa fa-star quality <?=['bronze','silver','gold'][$item->getQuality()]?>"></i>
    </span>
    <img src="<?=$item->getItem()['image_url']?>" width="40px" height="40px">
    <div class="description"><?=$item->getItem()['name']?></div>
</div>