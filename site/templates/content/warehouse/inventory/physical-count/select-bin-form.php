<?php include "{$config->paths->content}warehouse/session.js.php"; ?>
<div>
	<form action="<?= $page->fullURL->getUrl(); ?>" method="GET" class="select-bin-form">
		<div class="form-group">
			<label class="h5 text-info" for="binID">Bin ID</label>
			<div class="input-group">
				<input type="text" class="form-control border border-info" id="binID" name="binID">
				<span class="input-group-append">
					<button type="button" class="btn btn-info show-possible-bins">Search&ensp;<span class="fa fa-search" aria-hidden="true"></span> </button>
				</span>
			</div>
		</div>
		<button type="submit" class="btn btn-success not-round">Submit&ensp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
	</form>
</div>
