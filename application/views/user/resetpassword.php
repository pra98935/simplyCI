<?php
//echo $result['uid'];
//echo $result['token'];
?>
<script>
jQuery(document).ready(function(){
    jQuery("#changepass").on('submit', (function(e) {
        e.preventDefault();
        var url = "<?php echo base_url(); ?>user_admin/resetPasswordAction/<?php echo $result['uid']; ?>/<?php echo $result['token']; ?>"; 
        
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
                    jQuery(".success").hide();
                    jQuery(".error").hide();
                    jQuery(".err").show();
                    var total = data.msgs;
                    var obj = Object.keys(total);
                    for (var i = 0; i < obj.length; i++) {
                       jQuery('.' + obj[i]).html(total[obj[i]]);
                    };
                }else if(data.type=="failed"){
                    var msg = data.msg;
                    jQuery(".err").hide();
                    jQuery(".success").hide();
                    jQuery(".error").html(msg); 
                }else if(data.type=="success"){
                    var msg = data.msg;
                    jQuery(".err").hide();
                    jQuery(".error").hide();
                    jQuery(".success").html(msg); 
                }
            },

        });
    }));
});
</script>

<div class="main_container how_it">
<section class="common howit_contain">
<div class="contact_container">
    
    <div class="row contactrow">

        <form role="form" method="post" action="#" id="changepass">
            
            

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="pass">New Password<span>*</span>:</label>
                    <input type="password" class="form-control" id="newpass" name="password">
                    <span class="password err"></span>
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
                    <button type="submit" class="btn btn-contact" id="c-sub" name="mailbtn">Update</button>
                </div>
            </div>

        </form>
        <span class="error"></span>
        <span class="success"></span>
        

    </div>
</div>
</section>
</div>