<?=$this->extend('master')?>

<?=$this->block('body')?>
    <form action="<?=$router->generateUrl('trade:delete_trade', ['trade' => $trade->getId()])?>" method="POST">
        <h2>Are you sure?</h2>
        <p>Delete trade #<?=$trade->getId()?>?</p>
        <div class="row-fluid">
            <div class="btn-group pull-right">
                <input type="submit" name="confirm" class="btn btn-danger" value="Delete">
                <a href="<?=$router->generateUrl('trade_overview', ['trade' => $trade->getId()])?>" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </form>
<?=$this->endBlock()?>