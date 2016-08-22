<?php
//echo '<pre>';
//print_r($allorder);

// foreach ($allorder as $value) {
//   echo $value['delivery_date'];  
//   echo $value['txn_id'];  
//   echo $value['payment_status'];  
//   echo $value['payment_gross'];  
// }

//die;
?>

<div class="col-sm-8">
    <div class="admin_leftbar modify_right">
      <h3>View Order History</h3>
      <div class="view_order table-responsive">
        <table>
          <thead>
            <tr>
              <th>Date</th>
              <th>Order Number</th>
              <th>Status</th>
              <th>Total</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
           
          <?php
          if($allorder){
            foreach ($allorder as $value) { ?>
            <tr>
              <td><?php echo $value['delivery_date'];?></td>  
              <td><?php echo $value['txn_id'];?></td>
              <td><?php echo $value['payment_status'];?></td>
              <td><?php echo $value['total'];?></td> <!-- please this function getAllRecordsGroupByWhere() in model -->
              <td><a href="<?php echo base_url('user_admin/orderdetail/'.$value['txn_id'].'/'.$value['delivery_add_id'].'/'.$value['billing_add_id'].'/?date='.$value['delivery_date']); ?>"> view </a></td>
            </tr>
            <?php } 
          }
          ?> 


          </tbody>
        </table>
      </div>
      <div class="row">
        <form role="form">
          <div class="col-sm-12">
            <div class="form-group modify_btnh">
              <button type="submit" class="btn btn-back">Back</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>