<div class="form-group">
	<?php include __DIR__."/item-form.php"; ?>
</div>

<div class="row mt-4">
	<div class="col-lg-9">
		<?php if ($resultscount) : ?>
			<?php foreach ($items as $item) : ?>
				<div class="card border-primary mb-2">
			  		<div class="card-body bg-primary text-white">
				    	<h4 class="card-title font-weight-bold"><?= strtoupper($item->get_itemtypepropertydesc()) . " " . $item->get_itemidentifier(); ?></h4>
				    	<p class="card-text"><?= $item->desc1; ?></p>
			  		</div>
			  		<ul class="list-group list-group-flush">
			    		<li class="list-group-item bg-secondary"><strong>Bin:</strong> <?= $item->bin; ?> <strong>Qty:</strong> <?= $item->qty; ?></li>
			    		<li class="list-group-item"><?= "Origin: " . strtoupper($item->xorigin); ?></li>
			    		<li class="list-group-item"><?= "X-ref Item ID: " . $item->xitemid; ?></li>
			  		</ul>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
				<div class="col-xs-12">
					<h3 class="list-group-item-heading">No items found for "<?= $input->get->text('scan'); ?>"</h3>
					<p class="list-group-item-text"></p>
				</div>
		<?php endif; ?>
	</div>
</div>
