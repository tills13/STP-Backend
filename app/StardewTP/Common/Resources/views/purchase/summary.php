<?=$this->extend('master')?>

<?=$this->block('body')?>
<div class="page-header">
    <h2>Order Summary</h2>
</div>
<form method="POST">
    <?php foreach ($order as $type => $part) { 
        $total = 0; ?>
        <h4 class="text-uppercase"><?=$type?></h4>
        <?php if ($type == 'trades') { ?>
            <table class="table table-striped">
            <?php foreach ($part as $trade) { 
                $total = $total + $trade->getAskingPrice(); ?> 
                <tr>
                    <td>#<?=$trade->getId()?></td>
                    <td class="text-right"><?=$trade->getAskingPrice()?><span class="gold">G</span></td>
                </tr>
            <?php } ?>
            </table>
            <div class="row">
                <div class="col-md-3 pull-right">
                    <b class="text-uppercase">total</b>
                    <hr/>
                    <?=$total?><span class="gold">G</span>
                </div>
            </div>
        <?php }?>
    <?php } ?>

    <div class="row">
        <div class="col-md-12">
            <div class="btn-group pull-right">
                <button class="btn btn-success">Confirm</button>
                <a href="#" class="btn btn-warning">Cancel</a>
            </div>
        </div>
    </div>
</form>
<?=$this->endBlock()?>