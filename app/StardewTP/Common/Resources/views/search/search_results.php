<?=$this->extend('master')?>

<?=$this->block('body')?>
    <?=$this->import('search/search', ['query' => $query])?>
<?=$this->endBlock()?>