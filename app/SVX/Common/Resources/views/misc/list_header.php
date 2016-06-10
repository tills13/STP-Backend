<?php // defaults
    $listStyle = (!isset($listStyle) || $listStyle === null) ? 'comfy' : $listStyle;
    $availableDensities = ['comfy' => 'fa-th-large', 'compac' => 'fa-th', 'list' => 'fa-list'];
    $showSearch = (!isset($showSearch) || $showSearch === null) ? false : $showSearch;
?>

<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <h2><?=$title?></h2>
        </div>
        <div class="actions col-md-6 col-sm-6 text-right">
            <div class="btn-group" rel="adjust-list-style" data-target="#<?=$target?>">
                <div data-style="comfy" class="btn btn-primary <?=(($listStyle == "comfy") ? " active" : "")?>"><i class="fa fa-th-large"></i></div>
                <div data-style="compact" class="btn btn-primary <?=(($listStyle == "compact") ? " active" : "")?>"><i class="fa fa-th"></i></div>
                <div data-style="list" class="btn btn-primary <?=(($listStyle == "list") ? " active" : "")?>"><i class="fa fa-list"></i></div>
            </div>

            <?php if ($showSearch) { ?>
                <a href="<?=$router->generateUrl('search')?>" class="btn btn-success"><i class="fa fa-search"></i></a>
            <?php } ?>
        </div>
    </div>
</div>