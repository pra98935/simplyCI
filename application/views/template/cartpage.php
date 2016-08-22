<script>
jQuery(document).ready(function(){
    jQuery(".delcart").on('click', (function(e) {
        e.preventDefault();
        var cartid = jQuery(this).attr('id');
        var url = "<?php echo base_url('home/daletecart/"+cartid+"'); ?>"; 
        jQuery.ajax({
            url: url,
            type: "POST",
            //data: {subsval:subscribe},
            dataType: "json",
            success: function(data) {
            	if(data.type == "success"){
            		//var msg = data.msg;
            		//jQuery(".error").html(msg); 
            		window.location.reload();  
            	}
            },
        });
    }));
});
</script>




<?php
	$chk_quantity='';
	foreach ($this->cart->contents() as $items){
		$chk_quantity += $items['qty'];
	}
?>


<script type="text/javascript">
	
	function registercheckout(){
		var js_email = '<?php echo $records; ?>'; //check cartpage() function
		var js_qty   = '<?php echo $chk_quantity; ?>';
		
		if(js_email==0 && js_qty >= 18){
			window.location.href = '<?php echo base_url(); ?>home/checkout';
		}else if(js_email >= 1 && js_qty >= 30){
			window.location.href = '<?php echo base_url(); ?>home/checkout';
		}else if(js_email==0 && js_qty <= 17){
			alert('Quantity should be 18');
		}else if(js_email >= 1 && js_qty <= 29){
			alert('Quantity should be 30');
		}
	}
		

</script>


<script type="text/javascript">
	
	function guestcheckout(){
		var js_qty   = '<?php echo $chk_quantity; ?>';

		if(js_qty >= 18){
			window.location.href = '<?php echo base_url(); ?>home/checkout';
		}else{
			alert('Quantity should be 18');
		}
	}

</script>


<?php if($this->session->userdata('coupon_code')){ ?>
	<script>
		jQuery(document).ready(function(){
		    // registeration of user
		    jQuery("#coupon_varify").on('submit', (function(e) {
		      alert("you have already used a coupon");
		      return false;
		    }));

		});
	</script>
<?php }else{ ?>
	<script>
		jQuery(document).ready(function(){

		    
		    jQuery("#coupon_varify").on('submit', (function(e) {
		        e.preventDefault();
		      

		        var url = "<?php echo base_url('home/couponVarify'); ?>/"; 
		        
		        jQuery.ajax({
		            url: url,
		            type: "POST",
		            data: new FormData(this),
		            contentType: false,
		            cache: false,
		            dataType: "json",
		            processData: false,
		            success: function(data) {
		                if(data.type == "error"){
		                	var msg = data.msg;
		                    jQuery(".success").hide();
		                    jQuery(".error").hide();
		                    jQuery(".err").show();
		                    jQuery(".err").html(msg); 
		                }else if(data.type=="failed"){
		                    var msg = data.msg;
		                    jQuery(".err").hide();
		                    jQuery(".success").hide();
		                    jQuery(".error").show();
		                    jQuery(".error").html(msg); 
		                }else if(data.type=="success"){
		                    var msg   = data.msg;
		                    var price = data.discount_price;
		                    jQuery(".err").hide();
		                    jQuery(".error").hide();
		                    jQuery(".success").show();
		                    jQuery(".success").html(msg); 
		                    jQuery("#ajax_price").html(price); 

		                    //

		                }
		            },

		        });
		    }));

		});
		</script>
<?php } ?>



<?php echo $this->session->userdata('coupon_code'); ?>

<div class="main_container how_it">
	<section class="common howit_contain">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<b>Your Cart</b>

					<?php //echo form_open(base_url()); ?>
					<form method="post" name="cartform" action="#">
						<table cellpadding="6" cellspacing="1" style="width:100%" border="1">
							<tr>
								<th>Item Description</th>
								<th>QTY</th>
								<th style="text-align:right">Item Price</th>
								<th style="text-align:right">Sub-Total</th>
								<th style="text-align:right">Action</th>
							</tr>
							<?php $i = 1; ?>
							<?php foreach ($this->cart->contents() as $items): ?>
								
								<?php
								//echo '<pre>';
								//print_r($items);
								?>
								<?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
								<tr>
									<td>
										
										<?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
											<?php if($option_name == 'Image' && $option_value){ ?>	
												<img src="<?php echo $option_value; ?>" alt="proimage" width="100" height="100">
											<?php } ?>
										<?php endforeach; ?>

										<?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
											<?php if($option_name == 'Link' && $option_value){ ?>	
												<a href="<?php echo $option_value; ?>" target="_blank"> <?php echo $items['name']; ?> </a>
											<?php }elseif($option_name == 'Link' && $option_value == ''){
													 echo $items['name']; 
												} ?>
										<?php endforeach; ?>

										
										<?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
										
										
										<?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
											<?php if(($option_name == 'Servings' || $option_name == 'Tray') && $option_value){ ?>	
												<strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />
											<?php } ?>
										<?php endforeach; ?>
										
										
										
										<?php endif; ?>
									</td>
									<td><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>
									<td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
									<td style="text-align:right">$<?php echo $this->cart->format_number($items['subtotal']); ?></td>
									<?php $rowid = $items['rowid']; ?>
									<td style="text-align:right"><a href="javascript:void(0)" id="<?php echo $rowid; ?>" class="delcart">Delete</a></td>
								</tr>
								<?php $i++; ?>
							<?php endforeach; ?>
							<!-- <tr>
								<td colspan="2"></td>
								<td class="right"><strong>Total</strong></td>
								<td class="right" align="right">$<?php //echo $this->cart->format_number($this->cart->total()); ?></td>
							</tr> -->
						</table>
						<p><?php //echo form_submit('update_cart', 'Update your Cart'); ?></p>
						<input type="submit" name="update_cart" value="Update your Cart" />
						<input type="submit" name="clear_cart" value="Clear your Cart" />
						<!-- <a href="<?php //echo base_url('home/checkout'); ?>">Checkout</a> -->

						<?php if($this->session->userdata('email')){?>
							<a href="javascript:void(0);" onclick="registercheckout();">Checkout</a>
						<?php }else{ ?>
							<a href="javascript:void(0);" onclick="guestcheckout();">Checkout</a>
						<?php } ?>

					</form>

									

					<div class="coupon_section">
						<form method="post" id="coupon_varify" action="#">
							<input type="text" name="couponname" id="id_cpnname" required/>
							<input type="submit" name="coupon_submit">
						</form>
						<span class="err"></span>
						<span class="error"></span>
						<span class="success"></span>
					</div>

					<?php 
					 if(!empty($this->session->userdata('coupon_code')) && count($this->cart->contents())>0){


						$cartprice = $this->cart->format_number($this->cart->total());
						$offer     = $this->session->userdata('offer');

					?>
						<div id="total_price"><span class="crncy">$</span><span id="ajax_price"><?php echo $cartprice - $offer; ?></span></div>
					<?php }else{ ?>
						<div id="total_price"><span class="crncy">$</span><span id="cart_price"><?php echo $this->cart->format_number($this->cart->total()); ?></span></div>
					<?php } ?>

				</div>
			</div>
		</div>  
	</section>
</div>

