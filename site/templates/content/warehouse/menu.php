<div>
    <div class="row mt-3">
        <div class="col-lg-9">
            <?php foreach ($page->children('template!=redir') as $child) : ?>
                <a href="<?= $child->url; ?>" class="btn btn-block btn-info"><?= $child->title; ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
