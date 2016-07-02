<div class="item">  
    <div class="inner"> 
        <div class="quantity">
            <?=$item->getAmount()?>
            <i class="fa fa-star quality <?=['bronze','silver','gold'][$item->getQuality()]?>"></i>
        </div>
        <img src="<?=$item->getItem()['image_url']?>" width="40px" height="40px">
        <div class="description"><?=$item->getItem()['name']?></div>
    </div>
</div>