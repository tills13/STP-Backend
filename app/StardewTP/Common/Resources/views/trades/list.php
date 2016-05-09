<?=$this->extend('master')?>
<?=$this->block('title', 'All Trades')?>

<?=$this->block('body')?>
	<div class="row">
		<div class="page-header">
			<div class="row">
				<div class="col-md-6">
					<h2>SVE Trades <small>ALL TRADES</small></h2>
				</div>
				<div class="actions col-md-6 text-right">
					<div class="btn-group" rel="adjust-list-style" data-target="#trade-list">
						<div data-style="list" class="btn btn-primary"><i class="fa fa-list"></i></div>
						<div data-style="comfy" class="btn btn-primary"><i class="fa fa-th-large"></i></div>
						<div data-style="compact" class="btn btn-primary"><i class="fa fa-th"></i></div>
					</div>

					<a href="<?=$router->generateUrl('search')?>" class="btn btn-success"><i class="fa fa-search"></i></a>
				</div>
			</div>
		</div>
	</div>

	<div id="trade-list" class="row entity-list list">
		<?php foreach ($trades as $id => $trade) { ?>
			<?=$this->import('trades/trade', ['trade' => $trade])?>
		<?php } ?>
	</div>
	
	<nav class="text-right">
		<ul class="pagination">
			<li>
				<a href="<?=$router->generateUrl('trades', [
					'page' => max($page - 1, 0)
				])?>" aria-label="Previous">
				<span aria-hidden="true">&laquo;</span>
				</a>
			</li>
			<?php for ($i = max(0, $page - 2); $i <= ($page + 2); $i++) { ?>
				<li<?=(($page == $i) ? " class=\"active\"" : "")?>><a href="<?=$router->generateUrl('trades', [
					'page' => $i
				])?>"><?=$i?></a></li>
			<?php } ?>
			<li>
				<a href="<?=$router->generateUrl('trades', [
					'page' => $page + 1
				])?>" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
				</a>
			</li>
		</ul>
	</nav>
<?=$this->endBlock()?>