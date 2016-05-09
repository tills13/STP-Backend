<?=$this->extend('master')?>
<?=$this->block('title', 'All Trades')?>

<?=$this->block('body')?>
	<div class="row">
		<div class="page-header">
			<h2>SVE Trades <small>ALL TRADES</small></h2>	
		</div>
	</div>

	<div class="row">
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