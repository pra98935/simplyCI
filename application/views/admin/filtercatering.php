<div class="col-sm-8">
  <div class="add_nmenu">
    <a href="<?php echo base_url(); ?>admin/addcatering">Add new Meal</a>
  </div>

  <div class="admin_leftbar owner_admin">
    <h3 class="admin_heading">Catering LIST</h3>
    <div class="row">
      <form method="post" role="form" id="cat_filter_frm" action="<?php echo base_url('admin/filtercatering'); ?>">
        <div class="col-sm-10">
          <div class="form-group">
            <label for="month">Choose a Category:</label>
            <select class="form-control" name="catnamefilter">
              <option value="selected">Please select category</option>
              <option value="all" <?php if($selectedcatname=='all'){echo 'selected';}else{} ?>>All</option>
              <?php
                foreach ($allcatering as $val) { ?>
                  <option value="<?php echo $val['category']; ?>" <?php if($selectedcatname==$val['category']){echo 'selected';}else{} ?> ><?php echo $val['category']; ?></option>
                <?php } ?>
            </select>
          </div>
        </div>
        <div class="col-sm-2">
        <div class="form-group filter_btn">
        <button type="submit" class="btn btn-contact" name="submit1">FILTER</button>
        </div>
        </div>
      </form>
    </div>

    <div class="admin_order">
      <table id="tbl_catering" class="display">
        <thead>
          <tr>
            <th></th>
            <th>ITEM NAME</th>
            <th>Category</th>
            <th>Half Tray Price</th>
            <th>Full Tray Price</th>
            <th>action</th>
          </tr>
        </thead>
          
        <tbody>
          
          <?php
          if($result){
            foreach ($result as $val) { ?>
              
              <tr>
                <td><?php echo $val['id']; ?></td>
                <td><?php echo $val['item']; ?></td>
                <td><?php echo $val['cat_name']; ?></td>
                <td><?php echo $val['half_tray']; ?></td>
                <td><?php echo $val['full_tray']; ?></td>
                <td><a href="<?php echo base_url(); ?>admin/editcatering/<?php echo $val['id']; ?>"> edit</a> | <a href="javascript:void();" onclick="deleteitem(<?php echo $val['id'];?> )"> delete</a></td>
              </tr>
                  
              <!-- echo $val['id']; -->
            <?php }
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
              <li class="page-item disabled"> <a aria-label="Previous" href="#" class="page-link">   Previous</a></li>
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
    
  </div>
</div>

<script type="text/javascript">
   var url="<?php echo base_url();?>";
   function deleteitem(id){
        var r = confirm("Do you want to delete this?");
        if (r == true){
          window.location = url+"admin/del_catering_item/"+id;
        }
        else{
          return false;
        }
   }
</script>

<script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery('#tbl_catering').DataTable();
  } );  
</script>