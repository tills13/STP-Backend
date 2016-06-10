<?=$this->extend('master')?>

<?=$this->block('title', 'Partners')?>

<?=$this->block('body')?>
    <?=$this->import('misc/entity_list', [
        'header' => true,
        'title' => 'Partners',
        'listId' => 'partner-list',
        'listEmptyMessage' => "We are not working with any partners at this time, please come back later and check again...",
        'items' => $partners,
        'itemId' => 'partner',
        'listTemplate' => 'partners/partner'
    ])?>
<?=$this->endBlock()?>