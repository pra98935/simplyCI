<div class="col-sm-8">
    
    <div class="add_nmenu">
        <a href="<?php echo base_url(); ?>admin/addnewreviews">Add new review</a>
    </div>

	<div class="admin_leftbar owner_admin">
		<h3 class="admin_heading">List of reviews</h3>

		<div class="admin_order">
		<?php echo $this->session->flashdata('review_del'); ?>
			<table id="table_id" class="display">
				<thead>
					<tr>
					<th></th>
					<th> reviews</th>
					<th>action</th>
					</tr>
				</thead>
				<tbody>
                    <?php  
                    	if($result){
	                    	$i=1;
							foreach ($result as $value) {
								$id     = $value['id'];
								$name   = $value['name'];
								$review = substr($value['review'], '0', '100')."..."; ?>

								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $review; ?></td>
									<td><a href='<?php echo base_url()?>admin/editreview/<?php echo $id; ?>'> edit</a> | <a href="javascript:voide();" onclick="deletereview(<?php echo $id ; ?>)"> delete</a></td>
								</tr>
							<?php 
							$i++;
							}
						}
					?>
					
				</tbody>
			</table>
		</div>

		
		<!-- <div class="row">
			<div class="cop-sm-12">
				<div class="reviw_pagination catering">
					<nav>
						<ul class="pagination">
							<li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous">   Previous</a></li>
							<li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
							<li class="page-item"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
							<li class="page-item"><a class="page-link" href="#">4</a></li>
							<li class="page-item"><a class="page-link" href="#">5</a></li>
							<li class="page-item"><a class="page-link" href="#">6</a></li>
							<li class="page-item"><a class="page-link" href="#">7</a></li>
							<li class="page-item"><a class="page-link" href="#">8</a></li>
							<li class="page-item"><a class="page-link" href="#">. . .</a></li>
							<li class="page-item"><a class="page-link" href="#" aria-label="Next">Next </a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div> -->
		
	</div>
</div>

<script type="text/javascript">
   var url="<?php echo base_url();?>";
   function deletereview(id){
        var r = confirm("Do you want to delete this?");
        if (r == true){
          window.location = url+"admin/deletereview/"+id;
        }
        else{
          return false;
        }
   }
</script>


<!-- <table id="table_id" class="display">
    <thead>
        <tr>
            <th>Column 1</th>
            <th>Column 2</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
        </tr>
    </tbody>
</table> -->




<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#table_id').DataTable();
	} );	
</script>