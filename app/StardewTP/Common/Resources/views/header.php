<div class="header">
	<div class="row">
		<div class="col-md-8">
			<h1 class="title">
				<a href="<?=$router->generateUrl('index')?>">Stardew Valley Farms</a>
				<br/>
				<small>Connecting Farmers With Farmers</small>
			</h1>
		</div>
		<div class="col-md-4">
			<div class="row-fluid">
				<div class="pull-right btn-group nav">
					<?php if ($session->check()) { ?>
						<a class="btn btn-success" href="<?=$router->generateUrl('farmer:edit_self')?>"><?=strtoupper($session->getUser()->getUsername())?></a>
						<a class="btn btn-success" href="<?=$router->generateUrl('logout')?>">LOGOUT</a>
					<?php } else { ?>
						<a class="btn btn-success" href="<?=$router->generateUrl('register')?>">REGISTER</a>
						<a class="btn btn-success" href="<?=$router->generateUrl('login')?>">LOGIN</a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>