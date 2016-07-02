<?=$this->extend('master')?>
<?=$this->block('title', "Trade {$trade->getId()}")?>

<?=$this->block('body')?>
	<?php $seller = $trade->getSeller(); ?>

	<div class="trade <?=$trade->getStatus()?>">
		<h2>Trade <?=$trade->getId()?> <small>from farmer <?=$seller->getName()?></small></h2>
		<table class="table">
			<thead>
				<tr>
					<th></th>
					<th>quanity</th>
					<th>item</th>
					<th>quality</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($trade->getItems() as $index => $item) { ?>
					<tr class="trade-item">
						<td>
							<img src="<?=$item->getItem()['image_url']?>" width="40px" height="40px">
						</td>
						<td><?=$item->getAmount()?></td>
						<td><?=$item->getItem()['name']?></td>
						<td><?=['normal', 'silver', 'gold'][$item->getQuality()]?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>

		<?php if ($trade->is($trade::STATUS_OPEN) && $session->check() && (!$trade->getSeller()->equals($session->getUser()))) { ?>
			<div class="well">
				If you'd like to buy these items, hit buy below and the next time you're on your farm, you'll be debited the amount listed and given the items.
			</div>
		<?php } ?>

		<div class="row footer">
			<div class="col-md-6 col-sm-6 col-xs-6">
				<div class="btn-group">
					<?php if ($trade->is($trade::STATUS_OPEN) && $session->check() && (!$trade->getSeller()->equals($session->getUser()))) { ?>
						<a href="<?=$router->generateUrl('trade:purchase_trade', ['trade' => $trade->getId()])?>" class="btn btn-success">Purchase</a>
					<?php } ?>

					<?php if ($trade->is($trade::STATUS_OPEN) && ($trade->getSeller()->equals($session->getUser()))) { ?>
						<a href="" class="btn btn-warning">Edit Trade</a>
						<a href="<?=$router->generateUrl('trade:delete_trade', ['trade' => $trade->getId()])?>" class="btn btn-danger">Delete Trade</a>
					<?php } ?>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-6 text-right">
				<div class="label label-primary cost"><?=$trade->getAskingPrice()?><span class="gold">G</span></div>
			</div>
		</div>
	</div>
<?=$this->endBlock()?>
