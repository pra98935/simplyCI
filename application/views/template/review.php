<div class="main_container how_it">
    <section class="common howit_contain">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="main_head">What our customers are saying</h1>
                </div>
            </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="review_bnr">
                        <div class="review_img">
                            <img src="<?php echo base_url(); ?>asset/frontend/images/review2.png" class="img-responsive">
                        </div>
                     
                      
                      
                        <div class="review_img">
                            <img src="<?php echo base_url(); ?>asset/frontend/images/review1.png" class="img-responsive">
                        </div>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="review_right">

                            <?php
                                foreach($result as $val) { ?>
                                    <div class="col-sm-6">
                                        <div class="review_contin">
                                            <div class="qt_icon">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <p> <?php echo $val['review']; ?> </p>
                                            <h3> ~<?php echo $val['name']; ?> </h3>
                                        </div>
                                    </div>
                                <?php } 

                            ?>
                        </div>
                    </div>
                </div>
                <div class="rvw_navigation"><?php echo $links; ?></div>
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

<script>
jQuery(document).ready(function(){
   jQuery(".pagi_rvw:contains(<)").addClass("prev_rvw");
   jQuery(".pagi_rvw:contains(<)").text("Previous");
   if(!jQuery(".rvw_navigation a").hasClass("prev_rvw")){
   		jQuery(".pagi_rvw").before("<a href='javascript:void(0);' class='prev_rvw customadd'>Previous</a>");
   }

   jQuery(".pagi_rvw:contains(>)").addClass("next_rvw");
   jQuery(".pagi_rvw:contains(>)").text("Next");
   if(!jQuery(".rvw_navigation a").hasClass("next_rvw")){
   		jQuery(".pagi_rvw").after("<a href='javascript:void(0);' class='prev_rvw customadd'>Next</a>");
   }
});
</script>

<style type="text/css">
.rvw_navigation .pagi_rvw{font-size: 25px;padding: 8px 10px;}
.rvw_navigation .customadd {font-size: 25px;padding: 8px 10px;color: #999999;}
.rvw_navigation{text-align: center;}
</style>


