<?php
// print_r($result);
// die;
?>
<div class="col-sm-8">
    <div class="admin_leftbar modify_right">
        <h3>Address Book Entries</h3>
        <div class="addres_modify">
            <ul>
                <?php
                if($result){
                $i = 1;
                foreach($result as $row) { ?>
                    <li>
                        <i class="fa fa-map-marker" aria-hidden="true"></i> <span>Address <?php echo $i; ?></span> : <?php echo $row['address1']; ?>, <?php echo $row['city']; ?>, <?php echo $row['county'];?>
                        <span class="dledit"> 
                            <a href="<?php echo base_url(); ?>user_admin/editaddress/<?php echo $row['id'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a href="javascript:void();" onclick="deladd(<?php echo $row['id']; ?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </span>
                    </li>
                    <?php $i++; ?>
                <?php }
            }
                ?>
            </ul>
        </div>
        <div class="row">
            
                <div class="col-sm-12">
                    <div class="form-group modify_btnh">
                        
                        <a href="<?php echo base_url(); ?>user_admin/modifyaddress" class="btn btn-contact"> Back</a>
                        <a href="<?php echo base_url(); ?>user_admin/addnewaddress" class="btn btn-contact"> Add New Address</a>

                    </div>
                </div>
            
        </div>
    </div>
</div>
<?php
echo $this->session->flashdata('delete');
?>

<script type="text/javascript">
   var url="<?php echo base_url();?>";
   function deladd(id){
        var r = confirm("Do you want to delete this?");
        if (r == true){
          window.location = url+"user_admin/deleteaddress/"+id;
        }
        else{
          return false;
        }
   }
</script>