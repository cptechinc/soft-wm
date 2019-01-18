<form action="<?= $page->child('name=redir')->url; ?>" method="post" class="allow-enterkey-submit sales-order-entry-form" id="sales-order-entry-form">
    <label class="h5 text-info">Enter Order Number</label>
    <input type="hidden" name="action" value="start-order">
    <input type="hidden" name="page" value="<?= $page->fullURL->getUrl(); ?>">
    <div class="input-group">
        <input type="text" class="form-control border border-info" name="ordn" placeholder="Order #" type="text" autofocus>
        <div class="input-group-append">
            <button type="submit" class="btn btn-info confirm-order-assignment">Grab Order&ensp;<i class="fa fa-file-text-o"></i></button>
        </div>
    </div>
</form>
<button type="button" class="btn btn-danger mt-3 remove-sales-order-locks" data-page="<?= $page->fullURL->getUrl(); ?>">Remove Lock on Sales Order&ensp;<i class="fa fa-times"></i></button>
