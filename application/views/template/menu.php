<div class="main_container how_it">
            <section class="common howit_contain">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="menu_mhead">
                                <h1 class="main_head menu_head">Current Month's Menu<span class="menu_right">Next Month Menu <a href="<?php echo base_url('home/nextmonthmenu'); ?>" class="view_menu">view menu</a></span></h1>
                            </div>
                        </div>
                    </div>

                    <div class="row gallery">
                        
                        <?php 
                        if($result){
                        foreach($result as $value) { ?>
                        <div class="col-sm-3">
                            <div class="gallery_box">
                                <div class="gallery_img">
                                    <?php //$proid = $value['id']; ?>
                                    <?php 
                                        $proname = $value['title']; 
                                        $newproname = str_replace(" ", "_", $proname);
                                    ?>
                                    <a href="<?php echo base_url('home/productdetail/'.$newproname); ?>"><img src="<?php echo base_url(); ?>asset/admin/uploads/menu_meals/<?php echo $value['image']; ?>" class="img-responsive"></a>
                                </div>
                                <div class="gallery_cap"><?php echo $value['title']; ?></div>
                            </div>
                        </div>
                        <?php } 
                        }?>

                    </div>


                    <div class="row">
                        <div class="col-sm-12">
                            <h1 class="main_head slide">Next Months’ Menu<span class="menu_right"> <a href="<?php echo base_url('home/nextmonthmenu'); ?>" class="view_menu1">View Menu</a></span></h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div id="menu_slider" class="owl-carousel">
                                <?php 
                                if($nextmonthmenu){
	                                foreach ($nextmonthmenu as $value) { ?>
	                             		<div class="item"><img src="<?php echo base_url(); ?>asset/admin/uploads/menu_meals/<?php echo $value['image']; ?>" class="img-responsive"></div>   	
	                                <?php }
                                } ?>
                            </div>

                        </div>
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