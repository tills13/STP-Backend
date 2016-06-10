<?=$this->extend('master')?>

<?=$this->block('body')?>
    <?=$form->start()?>
        <?=$form->get('test1')->render()?>
        <?=$form->get('test2')->render()?>
        <input type="submit"></input>
    <?=$form->end()?>
<?=$this->endBlock()?>

