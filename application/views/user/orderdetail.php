<?php 
//echo '<pre>';
  
$txn_id    = $normalinfo['txn_id'];
$dlveryid  = $normalinfo['dlvry_id'];
$billingid = $normalinfo['billing_id'];
$date = $normalinfo['date'];
 
 if($dlveryid=='0'){
    $userdlvryadd = getbillingAddressById($billingid);  //helper function 
 }else{
    $userdlvryadd = getUserAddressById($dlveryid);   //helper function
 }

//print_r($userdlvryadd);

//print_r($userdlvryadd);

 
$name    = $userdlvryadd->firstname.' '.$userdlvryadd->lastname;
$phone   = $userdlvryadd->phone;
$company = $userdlvryadd->company;

$address1 = $userdlvryadd->address1;
$address2 = $userdlvryadd->address2;
$city     = $userdlvryadd->city;
$state    = $userdlvryadd->state;
$zip      = $userdlvryadd->zip;
$county   = $userdlvryadd->county;


?>

<div class="col-sm-8">
    <div class="row">
    <div class="col-sm-12">
        <div class="back_toorder">
            <a href="<?php echo base_url(); ?>user_admin/allorder">Back to Order List</a>
        </div>
    </div>
    </div>
    <div class="order_right">
        <h3 class="order_head">Oder ID #<?php echo $txn_id; ?></h3>
        <div class="order_detailbar">
            <ul>
                <li><span>Name: </span><span><?php echo $name; ?></span></li>
                <li><span>Phone Number:</span> <span><?php echo $phone; ?></span></li>
                <li><span>Shipping Address:</span>
                <span>
                <?php

                  if($company){
                    echo $company.", ";
                  }

                  echo $address1.", ";
                  
                  if($address2){
                    echo $address2.", ";
                  }

                  echo $city.", ".$zip.", ".$county.", ".$state;


                ?>
                </span>
                </li>
                <li><span>Delivery Schedule:</span><span><?php echo $date; ?></span></li>
            </ul>
        </div>
    </div>
    <div class="order_right">
        <h3 class="order_head">Order Details</h3>
        <table>
            <thead>
                <tr>
                <th>Item name</th>
                <th>Qty</th>
                <th>Amount</th>
                <th>Total</th>
                </tr>
            </thead>
            <tbody>
               
               <?php
                $sum = 0;
                if($orderdetail){
                    foreach ($orderdetail as $value) {
                        echo '<tr>';
                            echo '<td>' .$value['product_name']. '</td>';
                            echo '<td>' .$value['quantity']. '</td>';
                            echo '<td>' .$value['payment_gross']/$value['quantity']. '</td>';
                            echo '<td>' .$value['payment_gross']. '</td>';
                        echo '</tr>';

                        $sum+= $value['payment_gross'];
                    }
                    
                }    

               ?>

                              
            </tbody>
        </table>
    </div>      
                <?php if($orderdetail){ ?>
                <div class="total_sub">
                    <ul> 
                        <li> <span>Sub Total:</span>              $<?php echo $sum; ?> </li>
                        <li>  <span>Order Total:</span>              $<?php echo $sum; ?> </li>
                    </ul>
                    <a href="<?php echo base_url('user_admin/allorder'); ?>" class="btn btn-back">Back</a>
                    <button type="submit" class="btn btn-contact">PRINT</button>
                </div>
                <?php } ?>
</div>