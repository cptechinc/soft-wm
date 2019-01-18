<form action="<?= $page->parent->child('name=redir')->url; ?>" method="post" class="allow-enterkey-submit">
	<input type="hidden" name="action" value="inventory-search">
	<input type="hidden" name="page" value="<?= $page->fullURL->getUrl(); ?>">
	<label class="h5 text-info">Scan barcode, UPC, Item ID, or Serial #</label>
	<div class="form-group">
		<div class="input-group">
			<input class="form-control border border-info" name="scan" placeholder="barcode, UPC, Item ID, Serial #" type="text">
			<span class="input-group-append">
				<button type="submit" class="btn btn-info not-round">Submit&ensp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
			</span>
		</div>
	</div>
</form>
