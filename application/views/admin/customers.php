<div class="col-sm-8">
	<div class="admin_leftbar owner_admin">
		<h3 class="admin_heading">List of customers</h3>

		<!-- <div class="form-group customer_serch">
			<label for="month"></label>
			<input type="search" class="form-control" placeholder="Search Customer">
			<div class="search_icon">
				<a href="#"> <i class="fa fa-search"></i></a>
			</div>
		</div> -->

		<div class="admin_order">
			<table id="customer_table" class="display">
				<thead>
					<tr>
						<th>name</th>
						<th>email</th>
						<th>address</th>
						<th>order</th>
						<th >action</th>
					</tr>
				</thead>
				<tbody>
				
				<tr>
					<td>john Doe</td>
					<td>Info@thationstery5251.com</td>
					<td>East Baseline 4690...</td>
					<td>01</td>
					<td><a href="<?php echo base_url(); ?>admin/customersdetail"> view</a></td>
				</tr>

				<tr>
					<td>john Doe</td>
					<td>Info@thationstery5251.com</td>
					<td>East Baseline 4690...</td>
					<td>02</td>
					<td><a href="<?php echo base_url(); ?>admin/customersdetail"> view</a></td>
				</tr>
				
				<tr>
					<td>john Doe</td>
					<td>Info@thationstery5251.com</td>
					<td>East Baseline 4690...</td>
					<td>03</td>
					<td><a href="<?php echo base_url(); ?>admin/customersdetail"> view</a></td>
				</tr>

				<tr>
					<td>john Doe</td>
					<td>Info@thationstery5251.com</td>
					<td>East Baseline 4690...</td>
					<td>04</td>
					<td><a href="<?php echo base_url(); ?>admin/customersdetail"> view</a></td>
				</tr>
				
				<tr>
					<td>john Doe</td>
					<td>Info@thationstery5251.com</td>
					<td>East Baseline 4690...</td>
					<td>05</td>
					<td><a href="<?php echo base_url(); ?>admin/customersdetail"> view</a></td>
				</tr>

				<tr>
					<td>john Doe</td>
					<td>Info@thationstery5251.com</td>
					<td>East Baseline 4690...</td>
					<td>06</td>
					<td><a href="<?php echo base_url(); ?>admin/customersdetail"> view</a></td>
				</tr>
				
				<tr>
					<td>john Doe</td>
					<td>Info@thationstery5251.com</td>
					<td>East Baseline 4690...</td>
					<td>07</td>
					<td><a href="<?php echo base_url(); ?>admin/customersdetail"> view</a></td>
				</tr>

				<tr>
					<td>john Doe</td>
					<td>Info@thationstery5251.com</td>
					<td>East Baseline 4690...</td>
					<td>08</td>
					<td><a href="<?php echo base_url(); ?>admin/customersdetail"> view</a></td>
				</tr>

				<tr>
					<td>john Doe</td>
					<td>Info@thationstery5251.com</td>
					<td>East Baseline 4690...</td>
					<td>09</td>
					<td><a href="<?php echo base_url(); ?>admin/customersdetail"> view</a></td>
				</tr>

				<tr>
					<td>john Doe</td>
					<td>Info@thationstery5251.com</td>
					<td>East Baseline 4690...</td>
					<td>10</td>
					<td><a href="<?php echo base_url(); ?>admin/customersdetail"> view</a></td>
				</tr>

				</tbody>
			</table>
		</div>

	<!-- 	<div class="row">
			<div class="cop-sm-12">
				<div class="reviw_pagination catering">
					<nav>
						<ul class="pagination">
							<li class="page-item disabled"><a aria-label="Previous" href="#" class="page-link">   Previous</a></li>
							<li class="page-item active"><a href="#" class="page-link">1 <span class="sr-only">(current)</span></a></li>
							<li class="page-item"><a href="#" class="page-link">2</a></li>
							<li class="page-item"><a href="#" class="page-link">3</a></li>
							<li class="page-item"><a href="#" class="page-link">4</a></li>
							<li class="page-item"><a href="#" class="page-link">5</a></li>
							<li class="page-item"><a href="#" class="page-link">6</a></li>
							<li class="page-item"><a href="#" class="page-link">7</a></li>
							<li class="page-item"><a href="#" class="page-link">8</a></li>
							<li class="page-item"><a href="#" class="page-link">. . .</a></li>
							<li class="page-item"><a aria-label="Next" href="#" class="page-link">Next </a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div> -->

		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<button class="btn btn-contact" type="submit">export</button>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#customer_table').DataTable();
	} );	
</script>