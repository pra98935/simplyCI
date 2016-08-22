<script>

//

jQuery(document).ready(function(){

   document.getElementById("coupontext").disabled = true;

    //already registered user 
    jQuery("#updatecouponfrm").on('submit', (function(e) {
        e.preventDefault();

        var c_code   = jQuery("#coupontext").val();
        var c_offer  = jQuery("#coupon_ofr").val();
        var c_expire = jQuery("#datepicker").val();

        var c_id = '<?php echo $singlecoupon->id; ?>';
        var url = "<?php echo base_url('admin/updateCouponAction'); ?>"+"/"+c_id; 
        
        jQuery.ajax({
            url: url,
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            dataType: "json",
            processData: false,
            success: function(data) {
                if(data.type=="error"){
                    var total = data.msgs;
                    var obj = Object.keys(total);
                    jQuery(".err").show()
                    jQuery(".success").hide();
                    jQuery(".error").hide(); 
                    for (var i = 0; i < obj.length; i++) {
                       jQuery('.' + obj[i]).html(total[obj[i]]);
                    };
                }else if(data.type=="failed"){
                    var msg = data.msgs;
                    jQuery(".err").hide()
                    jQuery(".success").hide();
                    jQuery(".error").show();
                    jQuery(".error").html(msg); 
                }else if(data.type=="success"){
                    var msg = data.msgs;
                    jQuery(".err").hide()
                    jQuery(".error").hide();
                    jQuery(".success").show();
                    jQuery(".success").html(msg); 
                }
            },

        });


    }));



});
</script> 


<div class="col-sm-8">
	<div class="admin_leftbar owner_admin">
		<h3 class="admin_heading">Edit Coupon</h3>
		
		<form method="post" action="#" id="updatecouponfrm">
			

			<div class="col-sm-12">
                <div class="form-group">
                    <label for="codegenerator">Generate Coupon</label>
                    <br/>
                    <button type="button" onclick="document.getElementById('coupontext').value = randomString(4)"> Generate Coupon </button>
			        <input type="text" value="<?php echo $singlecoupon->coupon_code; ?>" name="coupon_code" id="coupontext" class="" />
			    </div>
            </div>

			<div class="col-sm-12">
                <div class="form-group">
                    <label for="off">How many % off</label>
                    <input type="text" name="offer" class="form-control" id="coupon_ofr" value="<?php echo $singlecoupon->offer; ?>" >
                    <span class="err offer"></span>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label for="expire">Expire date of Coupon</label>
                    <input type="text" id="datepicker" class="form-control" value="<?php echo $singlecoupon->exp_date; ?>" name="exp_date" >
                    <span class="err exp_date"></span>
                </div>
            </div>

             <div class="col-sm-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-coupon">Update Coupon</button>
                </div>
            </div>
           
		</form>

		<div class="col-sm-12">
            <span class="success"></span>
        	<span class="error"></span>
        </div>

	</div>
</div>

<script>
	function randomString(length) {
	    var text = "";
	    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	    for(var i = 0; i < length; i++) {
	        text += possible.charAt(Math.floor(Math.random() * possible.length));
	    }
	    return text;
	}

</script>

<script>
  jQuery(function() {
    jQuery( "#datepicker" ).datepicker();
  });
</script>



<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  


