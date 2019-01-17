<div>
    <div class="row mt-3">
        <div class="col-lg-6">
            <?php foreach ($page->children('template!=redir') as $child) : ?>
                <a href="<?= $child->url; ?>" class="btn btn-block btn-primary"><strong><?= $child->title; ?></strong></a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
