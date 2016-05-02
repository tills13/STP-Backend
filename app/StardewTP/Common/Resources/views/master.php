<!DOCTYPE html>
<html>
	<?=$this->import('head')?>
	<body>
        <div class="screen"></div>
        <div class="center">
		    <?=$this->import('header')?>
            <div class="container-fluid">
                <div class="content row">
                    <?=$this->embed('body')?>
                </div>
            </div>
		</div>
	</body>
</html>