<!DOCTYPE html>
<html>
	<?=$this->import('head')?>
	<body>
        <?=$this->import('header')?>
        
        <div class="center container-fluid">
            <?=$this->embed('body')?>
        </div>

        <?=$this->import('footer')?>
        <?php if ($application->getEnvironment() === 'dev' || $application->getConfig()->get('application.debug', false)) { ?>
            <?=$this->debugToolbar()?>
        <?php } ?>
	</body>
</html>