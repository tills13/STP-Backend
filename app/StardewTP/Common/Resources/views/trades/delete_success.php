<?=$this->extend('master')?>

<?=$this->block('body')?>
    <h2 class="text-success">Successfully Deleted Trade</h2>
    <p>You will will be refunded your items...</p>
    <div class="row-fluid">
        <div class="btn-group pull-right">
            <a href="<?=$router->generateUrl('trades')?>" class="btn btn-default">Return to Trades</a>
        </div>
    </div>
<?=$this->endBlock()?>