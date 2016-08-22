<!-------------added by trilok for calender------------>
	<script>
	$(document).ready(function() {

	json_events = '<?php echo  json_encode(getCalender($this->session->userdata('id'))); ?>';
	
	$('#calendar').fullCalendar({   

		dayClick: function(date, jsEvent, view) {
		
		// change the day's background color just for fun
       // $(this).css('background-color', 'red');
        
        insertEvent(date);

    },
			dayRender: function (date, cell) {
			
			$.each( JSON.parse(json_events), function( key, value ) {
					
					if (date.isSame(value.date)) {
					   cell.css("background-color",value.color);
					}
			   
			})	
           
        	},
			header: {
				left: '',
				center: 'title',
				right: ''
			},
			 height: 420
	});
	

	//function for adding event on database 
	function insertEvent(date){
	
		//$('.dateShow').html(date.format('MMMM-DD-YYYY'));
		$('#myModal').modal('show');
		$.ajax({
			method:"POST",
			url:"<?php echo base_url().'/admin/getEventByDate'; ?>",
			data:{'date': date.format('MMMM-DD-YYYY')},
			dataType:"json",
			success:function(res){
			
			$('.county').val(res.county);
			$('.state').val(res.state);
			
			$("input[name=check]").each(function () {
			if($(this).val()== res.color){
			$(this).prop("checked",'checked');
			}
			
			});
			}
		});
		
		
	
	}
	

	$('.saveEvent').on('click',function(){ 
		
		
		
		var state = $('.state').val();
		
		if(!state){
		alert('Please select state.');
		return false; 
		} 
		var county = $('.county').val();
		
		if(!county){
		alert('Please select county.');
		return false; 
		}
		var color = $("input[name=check]:checked").val();
		var recurring = $('.recurring').val();
		var dateShow = $('.dateShow').html();
		var delivery = $('.delivery').is(":checked");
		
		if(delivery){
			
		var color='red'; 
		
		}
		
		data ={'state': state,'county': county,'delivery': delivery,'recurring': recurring,'date': dateShow,'color': color };
		
		//$('#calendar').fullCalendar( 'refresh' );
		$.ajax({
			method:"POST",
			url:"<?php echo base_url().'/admin/addEvent'; ?>",
			data:data,
			dataType:"json",
			success:function(res){
			
			$('.savedata').html(res.msg);
			
			setTimeout(function(){ location.reload(); }, 1000);
			
			}
		});
	});
	});

</script>
			


<script>
jQuery(document).ready(function(){
    jQuery(".add_cart").on('click', (function(e) {
      jQuery(this).next("img.cart-loader").show();
      var id = jQuery(this).attr('id');
      //alert(id);
      var list_id = jQuery("."+id).attr('id');
      //alert(list_id);
      
      var curent_id    = list_id;
      var curent_qty   = jQuery("#"+list_id).find(".qnty").val();
      var curent_price = jQuery("#"+list_id).find('option:selected', this).attr('price');
      var curent_name  = jQuery("#"+list_id).find(".proname").attr('name');;
      var otherinfo    = jQuery("#"+list_id).find('option:selected', this).val();
      var img          = jQuery("#"+list_id).find('.gallery_img a img').attr('src'); 
      var link         = jQuery("#"+list_id).find('.gallery_img a').attr('href'); 



      // alert(curent_id);
      // alert(curent_qty);
      // alert(curent_price);
      // alert(curent_name);
      // alert(otherinfo);
      // alert(img);

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


<?php
// echo '<pre>';
// print_r($result);
// die;

$cal = getCalender();
$loc = getLocations();


//die; 
?>
<div class="main_container how_it">
    <section class="common howit_contain">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                   
					
					<!-- ======================= -->
						 <div class="row">
                        <div class="col-sm-12">
                            <div class="order_bar">
                                <ul>
                                    <li>
                                        <div class="ordbar_detal"><span>1</span> </div>
                                        <a href="#">Check Zipcode Availability</a>
                                    </li>
                                    <li>
                                        <div class="ordbar_detal"><span>2</span> </div>
                                        <a href="#">Choose Your Meals</a>
                                    </li>
                                    <li>
                                        <div class="ordbar_detal"><span>3</span> </div>
                                        <a href="#">Choose Your Delivery Date/Time</a>
                                    </li>
                                    <li>
                                        <div class="ordbar_detal"><span>4</span> </div>
                                        <a href="#">   Checkout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="top_search">
                                <form>
                                    <input type="search" placeholder="Check if your ZipCode is available for delivery..." class="form-control search_bar">
                                    <span><i class="fa fa-search" aria-hidden="true"></i>
</span>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="row gallery">
                        <div class="col-sm-4">
                            <div class="order_left">
                                <h2>CURRENT DELIVERY <span>SCHEDULE</span></h2>
                                <p><span>NOTE:</span> Delivery date must be no less than 5 days from order placement.</p>
                            </div>
                            <div class="calender">
                              
                               <div id='wrap'>
								<div id='calendar'></div>
								<div style='clear:both'></div>
								</div>
                            </div>
							<!---<div class="calender">
                                <div id="my-calendar1"></div>
                            </div>---->
                            <div class="event_dots">
                                <ul>
                                    <li><span class="event_color1"></span>Red color dates are blocked for delivery</li>
                                    <li><span class="event_color2"></span> Somerset, Mercer, Hunterdon, & Middlesex Counties:
                                        1st and 3rd Monday</li>
                                    <li><span class="event_color3"></span> Morris, Warren, Union, Essex, & Hudson Counties: 1st
                                        & 3rd Wednesday</li>
                                    <li><span class="event_color4"></span> Somerset, Mercer, Hunterdon, Middlesex, Morris, Warren,
                                        Union, Essex, & Hudson Counties: 2nd & 4th Saturday</li>
                                </ul>
                            </div>
                            <div class="save_btn"><a href="#">Save $.60 by choosing our 6-Serving Option!</a></div>
                        </div>
                        <div class="col-sm-8">
                            <div class="row">
                                <?php foreach ($result as $value) { ?>
                                 	<?php //$proid = $value['id']; ?>
                                    <?php 
                                        $proname = $value['title']; 
                                        $newproname = str_replace(" ", "_", $proname);
                                    ?>
                                	<div class="col-sm-6 ac-<?php echo $value['id'] ?>" id="list-<?php echo $value['id'] ?>" >
	                                    <div class="gallery_box  order_menu">
	                                        <div class="gallery_img"><a href="<?php echo base_url('home/productdetail/'.$newproname); ?>"><img src="<?php echo base_url(); ?>asset/admin/uploads/menu_meals/<?php echo $value['image']; ?>" class="img-responsive"></a></div>
	                                        <div class="gallery_cap">
	                                            <h3 class="proname" name="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></h3> 
	                                            <div class="dec_mhgt">
	                                                <p class="dec"><span>Description:</span> <?php echo $value['description']; ?> </p>
	                                                <p class="dec"><span>Total Time:</span> <?php echo $value['cooking_time']; ?> Mins, Serves 3 ($<?php echo $value['service_price_3']; ?>) & 6 ($<?php echo $value['service_price_6']; ?>)</p>
	                                            </div>
	                                            <div class="gallery_btn">
	                                                <select class="meal_serve_select" name="mealserve">
                                                        <option value="3 Servings" price="<?php echo $value['service_price_3']; ?>">Serves 3 $<?php echo $value['service_price_3']; ?></option>
                                                        <option value="6 Servings" price="<?php echo $value['service_price_6']; ?>">Serves 6 $<?php echo $value['service_price_6']; ?></option>
                                                    </select>
                                                    <div class="count_box mealcartbox">
                                                        <input type="number" name="quantity" class="qnty" min="18" value="18">
                                                    </div>
	                                                <a class="add_cart" href="javascript:void(0);" id="ac-<?php echo $value['id']; ?>">add to cart</a><img src="<?php echo base_url(); ?>asset/frontend/images/cart-loader.gif" alt="process" class="cart-loader meal-loader">
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>		
                                <?php } ?>
                                

                            </div>
                        </div>

                    </div>
					<!-- ============================ -->
				</div>
			</div>
		</div>
	</section>

	<section>
        <div class="top_deading">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="head_line"> <span><a class="order" href="<?php echo base_url('home/order_my_meal'); ?>">Order My Meals</a></span> </h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>		











            
                
                
                
            
        




















 
            
                
                   







                
            


        









            
                
                    
                        
                        


            
                
                    
                        
                            

                           
                           
                        
                    
                

            
            
        
                        
                    
                

            
           
        








    
        
            
            


            
            
        
        
    



























            
                
                    
                        

                        
                    
                

            
            
