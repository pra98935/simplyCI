<div class="col-sm-8">

    <!-- <div class="add_nmenu">
        <a href="<?php //echo base_url(); ?>admin/addnewpagesmenu"><img src="<?php //echo base_url(); ?>asset/admin/images/admin_cms.png"> Add New Pages </a>
        <p style="height:15px;"></p>
    </div>  -->

    <div class="admin_leftbar owner_admin">
        <div class="admin_order">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th class="page_detail">CMS pages</th>
                        <th colspan="2">action</th>
                       
                    </tr>
                </thead>
                <tbody>
                     <?php 
                      if($result){
                        $i=1;
                        foreach ($result as $value) { ?>
                            <?php 
                                
                                $id = $value['id'];
                                $title = $value['title'];
                                $full_desc = $value['description']; 
                                $strip_desc  = strip_tags($full_desc); //will remove all html tag
                                $short_desc = substr($strip_desc,'0','300');

                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><a href="<?php echo base_url('admin/editpage'); ?>/<?php echo $id; ?>">Edit</a></td>
                                <td><a href="javascript:voide();" onclick="delpage(<?php echo $id; ?>)">Delete</a></td>
                            </tr>
                            
                        <?php 
                          $i++;
                      } 
                     }
                  ?>
                </tbody>
            </table>
            <div class="success"><?php echo $this->session->flashdata('daletepage');  ?></div>
         </div>
        
    </div>
</div>		

<script type="text/javascript">
   var url="<?php echo base_url();?>";
   function delpage(id){
        var r = confirm("Do you want to delete this?");
        if (r == true){
          window.location = url+"admin/deletepage/"+id;
        }
        else{
          return false;
        }
   }
</script>