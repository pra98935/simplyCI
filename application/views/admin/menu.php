<div class="col-sm-8">

    <div class="add_nmenu">
        <a href="<?php echo base_url(); ?>admin/editmenu">Edit Menu</a>
    </div>
    
    <div class="admin_leftbar owner_admin">
            <h3 class="admin_heading">Current Month’s Menu</h3>
            <div class="row">
                <form method="post" role="form" id="menu_filter_frm" action="<?php echo base_url('admin/filtermenu'); ?>">
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
                        <th></th>
                        <th class="page_detail">This month menu</th>
                        <th colspan="2">action</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if($result){
                            $i=1;
                            foreach ($result as $val) { ?>
                               
                               <tr>
                                   <td><?php echo $i; ?></td>
                                   <td><?php echo $val['title']; ?></td>
                                   <td><a href="<?php echo base_url(); ?>admin/editmenumeal/<?php echo $val['id']; ?>"> edit</a></td>
                                   <td><a href="javascript:void(0);" onclick="deleteitem(<?php echo $val['id'];?> )"> delete </a></td>
                               </tr>
                            <?php 
                            $i++;
                            }
                        }else{

                        }
                    ?>
                    
                        
                    
                </tbody>
            </table>
 
        </div>
        
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