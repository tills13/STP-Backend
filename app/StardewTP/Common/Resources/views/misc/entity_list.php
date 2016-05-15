<?php // defaults
    $header = ($header === null) ? true : $header;
    $listStyle = (!isset($listStyle) || $listStyle === null) ? 'comfy' : $listStyle;
    $listEmptyMessage = (!isset($listEmptyMessage) || $listEmptyMessage === null) ? "There's nothing here..." : $listEmptyMessage;
    $showSearch = (!isset($showSearch) || $showSearch === null) ? false : $showSearch;
?>

<?=$this->import('misc/list_header', [
    'title' => $title,
    'target' => $listId,
    'listStyle' => $listStyle,
    'showSearch' => $showSearch
], null, $header)?>

<div class="row">
    <div class="col-md-12">
        <div id="<?=$listId?>" class="entity-list <?=$listStyle?>">
            <?php if (count($items) == 0) { ?>
                <p class="lead text-center empty"><?=$listEmptyMessage?></p>
            <?php } ?>
            <?php foreach ($items as $item) { ?>
                <?=$this->import($listTemplate, [$itemId => $item])?>
            <?php } ?>
        </div>
    </div>
</div>

