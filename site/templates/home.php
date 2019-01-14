<?php include('./_head.php'); ?>

	<div class='container page'>

		<!-- Main Menu -->
		<div class="row mt-3">
			<div class="col-lg-6 mt-2">
				<a href="" class="btn btn-block btn-primary"><strong>Picking</strong></a>
			</div>
			<div class="col-lg-6 mt-2">
				<a href="" class="btn btn-block btn-primary"><strong>Bin Reassignment</strong></a>
			</div>
			<div class="col-lg-6 mt-2">
				<a href="" class="btn btn-block btn-primary"><strong>Inventory</strong></a>
			</div>
		</div>

		<form class="mt-5" action="#" method="post">
			<label class="h5 text-info" for="inputAddress">Order Number</label>
			<div class="input-group">
				<input type="text" class="form-control border border-info" placeholder="Please enter an order number" aria-label="Recipient's username" aria-describedby="button-addon2">
				<div class="input-group-append">
				    <button class="btn btn-info" type="button" id="button-addon2">Search&ensp;<i class="fa fa-search" aria-hidden="true"></i></button>
				</div>
			</div>
		</form>

		<table class="table table-bordered mt-5">
		  	<thead class="bg-success text-light">
		    	<tr>
			      	<th scope="col">#</th>
			      	<th scope="col">First</th>
			      	<th scope="col">Last</th>
			      	<th scope="col">Handle</th>
		    	</tr>
		  	</thead>
		  	<tbody>
		    	<tr>
		      		<th scope="row">1</th>
		      		<td>Mark</td>
		      		<td>Otto</td>
		      		<td>@mdo</td>
		    	</tr>
	    		<tr>
		      		<th scope="row">2</th>
		      		<td>Jacob</td>
		      		<td>Thornton</td>
		      		<td>@fat</td>
		    	</tr>
		    	<tr>
		      		<th scope="row">3</th>
		      		<td>Larry</td>
		      		<td>the Bird</td>
		      		<td>@twitter</td>
		    	</tr>
		  	</tbody>
		</table>

		<table class="table table-borderless table-sm table-striped mt-5">
		  	<tbody>
		    	<tr>
		      		<td>Mark</td>
		      		<td>Otto</td>
					<td>Otto</td>
		    	</tr>
		    	<tr>
		      		<td>Jacob</td>
		      		<td>Thornton</td>
					<td>Otto</td>
		    	</tr>
		    	<tr>
		      		<td>Larry</td>
		      		<td>@twitter</td>
					<td>Otto</td>
		    	</tr>
		  	</tbody>
		</table>

		<div class="mt-5">
			<button type="button" name="button" class="btn btn-info mb-1">Search&ensp;<i class="fa fa-search" aria-hidden="true"></i></button>
			<button type="button" name="button" class="btn btn-success mb-1">Save&ensp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
			<button type="button" name="button" class="btn btn-danger mb-1">Delete&ensp;<i class="fa fa-trash-o" aria-hidden="true"></i></button>
			<button type="button" name="button" class="btn btn-info mb-1">Submit&ensp;<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
		</div>

		<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
		  	<strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;Warning!</strong> This is an alert.
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>

		<nav aria-label="Page navigation example" class="mt-5">
		  	<ul class="pagination">
		    	<li class="page-item">
		      		<a class="page-link" href="#" aria-label="Previous">
		        		<i class="fa fa-chevron-left" aria-hidden="true"></i>
		      		</a>
		    	</li>
		    	<li class="page-item"><a class="page-link" href="#">1</a></li>
		    	<li class="page-item"><a class="page-link" href="#">2</a></li>
		    	<li class="page-item"><a class="page-link" href="#">3</a></li>
		    	<li class="page-item">
		      		<a class="page-link" href="#" aria-label="Next">
						<i class="fa fa-chevron-right" aria-hidden="true"></i>
		      		</a>
		    	</li>
		  	</ul>
		</nav>

	</div>
	<!-- end content -->

<?php include('./_foot.php'); ?>
