<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container">
        <a class="text-white font-weight-bold navbar-brand" href="<?= $pages->get('/')->url; ?>"><?= $site->company_name; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav mr-auto">
        		<?php $children = $pages->get('/')->children('template!=user-page|cart|build-items|site-admin'); ?>
                <?php foreach ($children as $child) : ?>
                    <li class="nav-item">
                        <a class="text-white nav-link" href="<?= $child->url; ?>"><?= $child->title; ?></a>
                    </li>
                <?php endforeach; ?>
                <li class="nav-item">
                    <a class="text-white nav-link" href="<?= $pages->get('template=orders')->url; ?>"><?= $pages->get('template=orders')->title; ?></a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right hidden-sm">
                <?php //if($page->editable()) echo "<li class='edit'><a href='$page->editUrl'>Edit</a></li>"; ?>
                <?php if ($user->loggedin) : ?>
                    <li class="nav-item">
                        <a href="<?= $pages->get('/')->url; ?>" class="text-white nav-link">
                            <i class="fa fa-user text-white" aria-hidden="true"></i>&nbsp;User : <span class="font-weight-bold"><?= $user->fullname; ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <?php $count = count_cartdetails(session_id()); ?>
                        <a href="<?= $pages->get('/cart/')->url; ?>" class="text-white nav-link">&nbsp;<i class="fa fa-shopping-cart text-white" aria-hidden="true"></i>&ensp;Your Cart&emsp;</a>
                    </li>
                    <li class="nav-item">
                    	<a href="<?php echo $config->pages->account; ?>redir/?action=logout" class="btn btn-danger logout">Logout</a>
                    </li>
                <?php endif; ?>
          	</ul>
        </div>

    </div>
</nav>
