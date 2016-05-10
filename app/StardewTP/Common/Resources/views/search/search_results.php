<?=$this->extend('master')?>

<?=$this->block('title', "Search - {$query}")?>
<?=$this->block('body')?>
    <?=$this->import('search/search', ['query' => $query], 'body')?>
    <div class="page-header">
        <h2>Results for <b><?=$query?></b> <small><?=count($results)?> results</small></h2>
        <?php foreach ($results as $result) { ?>
            
        <?php } ?>
    </div>
<?=$this->endBlock()?>