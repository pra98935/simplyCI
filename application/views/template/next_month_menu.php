<div class="main_container how_it">
            <section class="common howit_contain">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="menu_mhead">
                                <h1 class="main_head menu_head">Next Month's Menu</h1>
                            </div>
                        </div>
                    </div>

                    <div class="row gallery">
                        
                        <?php 
                        if($result){
                        foreach($result as $value) { ?>

                        <?php 
                            $proname = $value['title']; 
                            $newproname = str_replace(" ", "_", $proname);
                        ?>

                        <div class="col-sm-3">
                            <div class="gallery_box">
                                <div class="gallery_img">
                                    <a href="<?php echo base_url('home/productdetail/'.$newproname); ?>"><img src="<?php echo base_url(); ?>asset/admin/uploads/menu_meals/<?php echo $value['image']; ?>" class="img-responsive"></a>
                                </div>
                                <div class="gallery_cap"><?php echo $value['title']; ?></div>
                            </div>
                        </div>
                        <?php } 
                        }?>

                    </div>

                    <div class="row"></div>

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