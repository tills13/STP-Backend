<div class="item">
    <span class="quantity">
        <?=$item['amount']?>
        <i class="fa fa-star quality <?=['bronze','silver','gold'][$item['quality']]?>"></i>
    </span>
    <img src="<?=$item['image']?>" width="40px" height="40px">
    <div class="description"><?=$item['item']?></div>
</div>