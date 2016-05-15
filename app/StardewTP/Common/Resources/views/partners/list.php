<?=$this->extend('master')?>

<?=$this->block('body')?>
    <div class="row">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6">
                    <h2>Partners</h2>
                </div>
                <div class="actions col-md-6 text-right">
                    <div class="btn-group" rel="adjust-list-style" data-target="#partner-list">
                        <div data-style="comfy" class="btn btn-primary"><i class="fa fa-th-large"></i></div>
                        <div data-style="compact" class="btn btn-primary"><i class="fa fa-th"></i></div>
                    </div>

                    <a href="<?=$router->generateUrl('search')?>" class="btn btn-success"><i class="fa fa-search"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div id="partner-list" class="row entity-list comfy">
        <?php if (count($partners) == 0) { ?>
            <p class="lead text-center">
                We are not working with any partners at this time, please come back later and check again...
            </p>
        <?php } ?>
        <?php foreach ($partners as $partner) { ?>
            <?=$this->import('partners/partner', ['partner' => $partner])?>
        <?php } ?>
    </div>
<?=$this->endBlock()?>