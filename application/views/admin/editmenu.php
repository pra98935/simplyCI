<script>
//var checkboxValues = [];
jQuery(document).ready(function(){

    jQuery("#savestatus").on('click', (function(e) {

        month = jQuery("#id-menu-month-filter").val();
        year  = jQuery("#id-menu-year-filter").val();
                    	
    	jQuery(".loader").show();
    	setTimeout(function(){ 
    		jQuery(".loader").hide();
    	}, 2000);
    	var checkboxValues = [];
        e.preventDefault();
        var url = "<?php echo base_url('admin/changestatus'); ?>"; 
        
        jQuery('input:checkbox[name=checkmenu]').each(function() {    
		    if(jQuery(this).is(':checked')){
		    	checkboxValues.push(jQuery(this).val());
		    }
		});
        //alert(checkboxValues);
        jQuery.ajax({
            url: url,
            type: "POST",
            data: {checkboxValues:checkboxValues, month:month, year:year},
            dataType: "json",
            success: function(data) {
            	if(data.type == "success"){
	        		
	            }else{
	            	jQuery(".error").show();
	        		jQuery(".error").html(msg);
	        	}
            },

        });
    }));
});
</script>

<div class="col-sm-8">
	<div class="admin_leftbar owner_admin">
		<h3 class="admin_heading">Add new menu</h3>
		<!-- <div class="row">
			<div class="col-sm-12">
				<div class="new_subscribed">
					<label for="menu_type">MENU TYPE</label>
					<div class="order_check" id="order_id">
						<ul>
							<li>
								<input type="radio" id="f-option" name="selector">
								<label for="f-option">Set as Current Month's Menu</label>
								<div class="check"></div>
							</li>
							
						</ul>
					</div>
				</div>
			</div>
		</div> -->

		<div class="row">
            <form method="post" role="form" id="menu_filter_frm" action="<?php echo base_url('admin/filterEditMenu'); ?>">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="month">Select Month:</label>
                        <select class="form-control" name="add_menu_month" id="id-menu-month-filter">
                            <option value="">Select Month</option>
                            <option value="january"   <?php if($month_year['month']=='january'){echo "selected";}else{} ?>>January</option>
                            <option value="februry"   <?php if($month_year['month']=='februry'){echo "selected";}else{} ?>>februry</option>
                            <option value="march"     <?php if($month_year['month']=='march'){echo "selected";}else{} ?>>March</option>
                            <option value="april"     <?php if($month_year['month']=='april'){echo "selected";}else{} ?>>April</option>
                            <option value="may"       <?php if($month_year['month']=='may'){echo "selected";}else{} ?>>May</option>
                            <option value="june"      <?php if($month_year['month']=='june'){echo "selected";}else{} ?>>June</option>
                            <option value="july"      <?php if($month_year['month']=='july'){echo "selected";}else{} ?>>July</option>
                            <option value="august"    <?php if($month_year['month']=='august'){echo "selected";}else{} ?>>August</option>
                            <option value="september" <?php if($month_year['month']=='september'){echo "selected";}else{} ?>>September</option>
                            <option value="october"   <?php if($month_year['month']=='october'){echo "selected";}else{} ?>>October</option>
                            <option value="november"  <?php if($month_year['month']=='november'){echo "selected";}else{} ?>>November</option>
                            <option value="december"  <?php if($month_year['month']=='december'){echo "selected";}else{} ?>>December</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="year">Select Year:</label>
                        <select class="form-control" name="add_menu_year" id="id-menu-year-filter">
                            <option value="">Select Year</option>
                            <option  value="2016" <?php if($month_year['year']=='2016'){echo "selected";}else{} ?>>2016</option>
                            <option  value="2017" <?php if($month_year['year']=='2017'){echo "selected";}else{} ?>>2017</option>
                            <option  value="2018" <?php if($month_year['year']=='2018'){echo "selected";}else{} ?>>2018</option>
                            <option  value="2019" <?php if($month_year['year']=='2019'){echo "selected";}else{} ?>>2019</option>
                            <option  value="2020" <?php if($month_year['year']=='2020'){echo "selected";}else{} ?>>2020</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group filter_btn">
                        <button type="submit" class="btn btn-contact">FILTER</button>
                    </div>
                </div>
            </form>
        </div>

	<div class="admin_order">
		<table>
			<thead>
				<tr>
					<th><!-- <input type="checkbox"> --></th>
					<th></th>
					<th class="page_detail">List of dishes</th>
					<th colspan="2">action</th>
				</tr>
			</thead>
			
			<tbody>
				
				<!-- <tr>
					<td><input type="checkbox" checked></td>
					<td>7</td>
					<td>Garlic Turkey Meatballs in a Parmesan Sauce with Rice</td>
					<td><a href="<?php //echo base_url(); ?>admin/editmenumeal"> edit</a></td>
					<td><a href="#"> delete</a></td>
				</tr> -->
               
				<?php 
					if($result){
						$month = $month_year['month'];
                    	$year  = $month_year['year'];
						$i=0;
						
						foreach ($result as $val) { 
                            $i++;
							?>
														
							<tr>
								<td><input type="checkbox" name="checkmenu" value="<?php echo $val['id']; ?>" <?php if($val['status']=='1'){echo "checked";}else{} ?>></td>
								<td><?php echo $i; ?></td>
								<td><?php echo $val['title']; ?></td>
								<td><a href="<?php echo base_url(); ?>admin/editmenumeal/<?php echo $val['id']; ?>">Edit</a></td>
								<td><a href="javascript:void(0);" onclick="deleteitem(<?php echo $val['id'];?> )">DELETE </a></td>
							</tr>
	                        <?php  
						}


                        for($k=$i+1; $k < 16 ; $k++) { ?>
						<tr>
							<td><input type="checkbox" disabled></td>
							<td><?php echo $k; ?></td>
							<td>Add a Meal</td>
							<td><a href="<?php echo base_url(); ?>admin/addnewmeal/<?php echo $month; ?>/<?php echo $year; ?>"> Add</a></td>
							<td><a href="#"> </a></td>
						</tr>
					    <?php }



				    //}else if(!$result){
				    }else if((($month_year['month']!=='') && ($month_year['year']!=='')) && !$result){
                    
                    $month = $month_year['month'];
                    $year  = $month_year['year'];

				    for($i=1; $i < 16 ; $i++) { ?>
						<tr>
							<td><input type="checkbox"></td>
							<td><?php echo $i; ?></td>
							<td>Add a Meal</td>
							<td><a href="<?php echo base_url(); ?>admin/addnewmeal/<?php echo $month; ?>/<?php echo $year; ?>"> Add</a></td>
							<td><a href="#"> </a></td>
						</tr>

					<?php }	

				    }else{

				    }


				?>

			</tbody>
		</table>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="form-group save_menu">
				<button type="submit" class="btn btn-contact" id="savestatus">Save Menu</button> <img src="<?php echo base_url(); ?>asset/admin/images/cart-loader.gif" alt="process" class="loader">
			</div>
		</div>
	</div>

	<span class="success"></span>
	<span class="error"></span>
	
	</div>
</div>


<script type="text/javascript">
   var url="<?php echo base_url();?>";
   function deleteitem(id){
        var r = confirm("Do you want to delete this?");
        if (r == true){
           urlpath = url+"admin/del_menumeal_item/"+id;
           jQuery.ajax({
                url: urlpath,
                type: "POST",
                dataType: "json",
                success: function(data) {
                    if(data.type == "success"){
                       window.location.reload();
                    }
                },
            });
        }
        else{
          return false;
        }
   }
</script>