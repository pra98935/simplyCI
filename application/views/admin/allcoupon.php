<div class="col-sm-8">
	<div class="admin_leftbar owner_admin">
		<h3 class="admin_heading">All Coupon</h3>
		
        <span class="error"> <?php echo $this->session->flashdata('coupon_del'); ?> </span>

		<table id="table_coupon" class="display">
            <thead>
                <tr>
                <th>No.</th>
                <th>Coupon Code</th>
                <th>% Off</th>
                <th>Expire</th>
                <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php  
                    $i=1;
                    if($coupon){
                        foreach ($coupon as $value) {
                            $id     = $value['id'];
                            $expire = $value['exp_date'];
                            $code   = $value['coupon_code'];
                            $offer  = $value['offer'];?>

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $code; ?></td>
                                <td><?php echo $offer; ?></td>
                                <td><?php echo $expire; ?></td>
                                <td><a href='<?php echo base_url()?>admin/edit_coupon/<?php echo $id; ?>'> edit</a> | <a href="javascript:voide();" onclick="deletecoupon(<?php echo $id ; ?>)"> delete</a></td>
                            </tr>
                        <?php 
                        $i++;
                        }
                    }    
                ?>
                
            </tbody>
        </table>

	</div>
</div>
  
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#table_coupon').DataTable();
    } );    
</script>

<script type="text/javascript">
   var url="<?php echo base_url();?>";
   function deletecoupon(id){
        var r = confirm("Do you want to delete this?");
        if (r == true){
          window.location = url+"admin/delete_coupon/"+id;
        }
        else{
          return false;
        }
   }
</script>