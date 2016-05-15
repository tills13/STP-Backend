<!DOCTYPE html>
<html>
	<?=$this->import('head')?>
	<body>
        <div class="hide"><?=$this->import('header')?></div>
        
        <div class="center container-fluid">
            <?=$this->embed('body')?>
        </div>

        <?=$this->import('footer')?>
	</body>
</html>