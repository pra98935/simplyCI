<script>
jQuery(document).ready(function(){
  jQuery(".add_cart").on('click', (function(e) {
      jQuery(this).next("img.cart-loader").show();
      var id = jQuery(this).attr('id');
      //alert(id);
      var list_id = jQuery("."+id).attr('id');
      
      var curent_id    = list_id;
      var curent_qty   = jQuery("#"+list_id).find("#catquntity-"+id).val();
      var curent_price = jQuery("#"+list_id).find('input[name=price-'+id+']:checked').val();
      var curent_name  = jQuery("#"+list_id).find(".menu_name").attr('name');
      
      var traytype     = jQuery("#"+list_id).find("input[name=price-"+id+"]:checked").attr('traytype');

      var img          = jQuery("#"+list_id).find('.menu_img img').attr('src'); 
      var link         = window.location.href; 


      e.preventDefault();
      
      var url = "<?php echo base_url('home/addtocart'); ?>"; 
      jQuery.ajax({
          url: url,
          type: "POST",
          data: {curent_id:curent_id, curent_qty:curent_qty, curent_price:curent_price, curent_name:curent_name, traytype:traytype, img:img, link:link},
          dataType: "json",
          success: function(data) {
            if(data.type == "success"){
                jQuery(".cart-loader").hide();
              }  
          },

      });

      }));
  });
</script>

<div class="main_container how_it">
    <section class="common howit_contain">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h1 class="main_head">CATERING</span></h1>
            <p class="main_pera"> Please allow 3-5 business days for us to prepare and deliver. <br>
              Call to Order: 908-300-2087 </p>
          </div>
        </div>
        <div class="row catering_menu">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          
<div class="col-sm-12">
 
<?php foreach ($catering as $val) { 
      $id = $val['id'];
      $item = getCategoryItemById($id);
?>
<div class="col-sm-6">
    <div class="catering_list">
        <h2 class="cumn_sub"><?php echo $val['category']; ?><span class="menu_type">Half Tray / Full Tray</span></h2>
        <ul>
        <?php
          foreach ($item as $value) {
          //echo $value['item']."<br/>";
        ?>
            <li class="ac-<?php echo $value['id'] ?>" id="list-<?php echo $value['id'] ?>">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading21">
                        <div class="menu_img"><img src="<?php echo base_url(); ?>asset/admin/uploads/catering_item/<?php echo $value['image']; ?>"></div>
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $value['id']; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $value['id'] ?>" class="menu_name" name="<?php echo $value['item'] ?>"> <?php echo $value['item'] ?> </a> <span class="menu_price">$<?php echo $value['half_tray'] ?> - $<?php echo $value['full_tray'] ?></span>
                    </div>
                    <div id="collapse-<?php echo $value['id'] ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading21">
                        <div class="order_box">
                            <h2 class="cumn_sub">ADD TO ORDER</h2>
                            <div class="order_check" id="order_id">
                                <ul>
                                    <li>
                                        <input type="radio" class="half_tray" id="half-price-<?php echo $value['id'] ?>" name="price-ac-<?php echo $value['id'] ?>" value="<?php echo $value['half_tray'] ?>" traytype="Half Tray">
                                        <label for="f-option23">Half tray</label>
                                        <div class="check"></div>
                                    </li>
                                    <li>
                                        <input type="radio" class="full_tray" id="full-price-<?php echo $value['id'] ?>" name="price-ac-<?php echo $value['id'] ?>" value="<?php echo $value['full_tray'] ?>" traytype="Full Tray" checked>
                                        <label for="s-option23">Full tray</label>
                                        <div class="check">
                                        <div class="inside"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <select name="catquntity" id="catquntity-ac-<?php echo $value['id'] ?>">
                                           <?php
                                            for ($i=1; $i < 7 ; $i++) { 
                                              echo '<option value="'.$i.'">' .$i. '</option>';
                                            }
                                           ?>
                                        </select>
                                    </li>
                                </ul>
                            </div>
                            <div class="gallery_btn"> <a class="add_cart" href="javascript:void(0);" id="ac-<?php echo $value['id'];?>">add to cart</a> <img src="<?php echo base_url(); ?>asset/frontend/images/cart-loader.gif" alt="process" class="cart-loader"> </div>
                        </div>
                    </div>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>
<?php } ?>
</div>
          </div>
        </div>
      </div>
      </div>
    </section>
    <section class="common blog_sec">
      <div class="top_deading">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <h1 class="head_line"> <span><a href="<?php echo base_url('home/order_my_meal'); ?>" class="order">Order My Meals</a></span> </h1>
            </div>
          </div>
        </div>
      </div>
    </section>
      <!-- Modal -->
  <div id="myModal" class="modal fade modal_form" role="dialog">
    <div class="modal-dialog"> 
      
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="modal_contain">
            <h1>Get Coupons and <span>Menu Updates</span></h1>
            <form role="form">
              <div class="form-group">
                <label for="name">Your Name:</label>
                <input type="text" class="form-control" id="name">
              </div>
              <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" class="form-control" id="email">
              </div>
              <button type="submit" class="btn btn-default mdl">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
