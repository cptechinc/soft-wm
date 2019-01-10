<?php include('./_head.php'); ?>

	<div class='container page'>

		<!-- Main Menu -->
		<div class="row mx-1 mt-3">
			<button type="submit" class="btn btn-block btn-primary btn-lg"><strong>Picking</strong></button>
			<button type="submit" class="btn btn-block btn-primary btn-lg"><strong>Bin Reassignment</strong></button>
			<button type="submit" class="btn btn-block btn-primary btn-lg"><strong>Inventory</strong></button>
		</div>

		<form class="mt-5" action="#" method="post">
			<div class="form-group">
			    <label class="h4 text-info" for="inputAddress">Order Number</label>
				<div class="input-group input-group-lg">
					<input type="text" class="form-control border border-primary" id="inputAddress" placeholder="Please Enter an Order Number">
				</div>
			</div>
			<button type="submit" class="btn btn-info btn-lg">Submit</button>
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


		<!-- Picking Menu -->

	</div>
	<!-- end content -->

<?php include('./_foot.php'); ?>
