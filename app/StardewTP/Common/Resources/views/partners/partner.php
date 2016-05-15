<div class="partner" data-id="<?=$partner->getId()?>">
    <a href="">
        <div class="header">
            <img src="<?=$partner->getLogo()?>" width="50px" height="50px">
            <h2><?=$partner->getName()?></h2>
        </div>
        <hr/>
        <p><?=$partner->getDescription()?></p>
        <div class="jobs clearfix">
            <?=count($partner->getJobs())?> contracts available
            <?php if (count($partner->getJobs()) != 0) { ?>
                <span class="pull-right">click to view</span>
            <?php } ?>
        </div>
    </a>
</div>