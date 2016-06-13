<?=$this->extend('master')?>
<?=$this->block('title', 'All Trades')?>

<?=$this->block('body')?>
	<?=$this->import('misc/entity_list', [
        'header' => true,
        'title' => "{$farmer->getUsername()}'s Trades",
        'showSearch' => false,
        'listId' => 'trade-list',
        'items' => $trades,
        'itemId' => 'trade',
        'listTemplate' => 'trades/trade'
    ])?>
<?=$this->endBlock()?>