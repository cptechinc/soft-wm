<?php include($config->paths->templates.'_head.php'); // include header markup ?>
    <div class="container page mt-4">
        <h1 class="font-weight-bold border-bottom border-primary pb-2 mb-4"><?= $page->get('pagetitle|headline|title') ; ?></h1>
        <?php include $page->body; ?>
    </div>
<?php include($config->paths->templates.'_foot-with-toolbar.php'); // include footer markup ?>
