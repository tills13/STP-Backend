<?=$this->extend('master')?>
<?=$this->block('title', 'All Trades')?>

<?=$this->block('body')?>
	<h2>Trades</h2>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Price</th>
				<th>Items</th>
				<th>Seller</th>
				<th class="text-right">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($trades as $id => $trade) { ?>
				<tr>
					<td>
						<a href="<?=$router->generateUrl('trade_overview', ['trade' => $id])?>"><?=$id?></a>
					</td>
					<td><?=$trade['asking_price']?>G</td>
					<td>
						<?php foreach ($trade['items'] as $item) { ?>
							<span class="badge"><?=$item['item']?></span>
						<?php } ?>
					</td>
					<td>
						<a class="btn btn-sm btn-warning" href="<?=$router->generateUrl('farmer_overview', ['farmer' => $trade['seller']])?>"><?=$trade['seller']?></a>
					</td>
					
					<td class="text-right">
						<div class="btn-group btn-group-sm">
						<?php if ($session->check()) { ?>
							<a class="btn btn-success" href="">Purchase</a>
						<?php } ?>
							<a class="btn btn-default" href="<?=$router->generateUrl('trade_overview', ['trade' => $id])?>">View</a>
						</div>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<div class="row">
		<div class="col-md-12">
			<div class="btn-group pull-right">
				<a 
					class="btn btn-default"
					href="<?=$router->generateUrl('trades', ['page' => max($page - 1, 0)])?>"><</a>
				<a class="btn btn-default" href="#"><?=$page?></a>	
				<a 
					class="btn btn-default"
					href="<?=$router->generateUrl('trades', ['page' => $page + 1])?>">></a>
			</div>
		</div>
	</div>
<?=$this->endBlock()?>