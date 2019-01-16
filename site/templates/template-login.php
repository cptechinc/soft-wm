<?php include('./_head-blank.php'); ?>
	<div class="container page">
		<div class="row">
			<div class="col-sm-6 mx-auto login">
                <div class="sign-in shadow-lg">
                    <div class="card rounded" style="col-sm-6">
                        <div class="card-body bg-primary text-white">
                            <p class="text-center"><img src="<?= $appconfig->companylogo->url; ?>" alt="<?= $appconfig->companydisplayname.' logo'; ?>"></p>
        					   <h2 class="text-center">Warehouse Login</h2>
                        </div>
                        <div class="card-body border border-primary">
                            <?php if (!$user->loggedin) : ?>
        						<?php // $errormsg = get_loginerrormsg(session_id()); ?>
        						<?php if (!empty($errormsg)) : ?>
        							<div class="alert alert-danger alert-dismissible not-round" role="alert">
        							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        							  <strong>Warning!</strong> <?= $errormsg; ?>
        							</div>
        						<?php else : ?>
        							<br>
        						<?php endif; ?>
        					<?php endif; ?>
        					<form action="<?= $config->pages->account."redir/"; ?>" method="post" class="allow-enterkey-submit mt-3">
        						<input type="hidden" name="action" value="login">
        						<div class="input-group form-group">
        							<input type="text" class="form-control border border-primary" name="username" value="" placeholder="username" autocapitalize="off" autofocus>
        						</div>
        						<div class="input-group form-group mb-4">
        							<input type="password" class="form-control border border-primary" name="password" placeholder="password">
        						</div>
                                <button type="submit" class="btn btn-block btn-success mt-5">Log In</button>
        					</form>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
<?php include('./_foot.php'); // include footer markup ?>
