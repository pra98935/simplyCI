<script>
jQuery(document).ready(function(){
  jQuery(".add_cart").on('click', (function(e) {
      jQuery(this).next("img.cart-loader").show();

      var id = jQuery(this).attr('id');
      //alert(id);

      var curent_id    = jQuery(this).closest('.orderdt_contain').attr('id');
      var curent_qty   = jQuery('#'+curent_id).find('.qnty').val();
      var curent_price = jQuery('#'+curent_id).find('option:selected', this).attr('price');
      var curent_name  = jQuery('#'+curent_id).find('.productname').attr('name');
      var otherinfo    = jQuery('#'+curent_id).find('option:selected', this).val();
      var img          = jQuery('#'+curent_id).find('.gallery_img img').attr('src'); 
      var link         = window.location.href; 

      // alert(curent_id);
      // alert(curent_qty);
      // alert(curent_price);
      // alert(curent_name);
      // alert(otherinfo);
      //alert(link);
      //alert(img);
      
      e.preventDefault();
      

      var url = "<?php echo base_url('home/addtocart'); ?>"; 
      
      jQuery.ajax({
          url: url,
          type: "POST",
          data: {curent_id:curent_id, curent_qty:curent_qty, curent_price:curent_price, curent_name:curent_name, otherinfo:otherinfo, img:img, link:link},
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
            <?php if($result){ ?>
            <div class="row orderdt_contain" id="<?php echo $result->id; ?>">
                
                    <?php if($result->image){ ?>
                        <div class="col-sm-6">
                            <div class="gallery_img orderdt_img">
                                <img src="<?php echo base_url(); ?>asset/admin/uploads/menu_meals/<?php echo $result->image; ?>" class="img-responsive">
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-sm-6">
                        <div class="orderdt_contain123">
                            <h2 name="<?php echo $result->title; ?>" class="productname"><?php echo $result->title; ?></h2>
                            <p class="dec"><span>Description:</span><?php echo $result->description; ?></p>

                            <p class="time"><span>Total Time:</span> <?php echo $result->cooking_time; ?> Mins </p>
                            
                            <?php if($result->cooking_instructions) {?>
                                <div class="cook_instruc">
                                    <span>Easy Cooking Instructions:</span>
                                    <?php echo $result->cooking_instructions; ?>
                                </div>
                            <?php } ?>

                            <div class="cook_inform">
                                <ul>
                                    <span>Nutrition Information</span>
                                    <li> Amount per Serving </li>
                                    <li>Calories <span><?php echo $result->cal; ?></span></li>
                                    <li>Total fat <span><?php echo $result->total_fat; ?> g</span></li>
                                    <li>Carbohydrate <span><?php echo $result->carbohydrate; ?> g</span></li>
                                    <li>Protein <span><?php echo $result->protein; ?> g</span></li>
                                    <li>Sodium <span><?php echo $result->sodium; ?> g</span></li>
                                    <li>Sugar <span><?php echo $result->sugar; ?> g</span></li>
                                </ul>
                            </div>
                            
                            <div class="gallery_btn">
                                
                                <select class="meal_serve_select" name="detailmenu">
                                    <option value="3 Servings" price="<?php echo $result->service_price_3; ?>">Serves 3 $<?php echo $result->service_price_3; ?></option>
                                    <option value="6 Servings" price="<?php echo $result->service_price_6; ?>">Serves 6 $<?php echo $result->service_price_6; ?></option>
                                </select> 


                                <div class="count_box">
                                    <input type="number" name="quantity" class="qnty" min="18" value="18">
                                </div>

                                <a class="add_cart" href="javascript:void(0);" id="cart-<?php echo $result->id; ?>">add to cart</a><img src="<?php echo base_url(); ?>asset/frontend/images/cart-loader.gif" alt="process" class="cart-loader">
                                <br/>
                                <br/>
                                <a href="<?php echo base_url(); ?>home/menu" class="add_menu" style="padding-left:0;">Back to menu</a>
                            </div>
                        </div>
                    </div>
                
            </div>
            <?php }else{
            	echo '<h1> Product Not Found</h1>';
            } ?>
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
</div>