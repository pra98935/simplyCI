   <script>
jQuery(document).ready(function(){
    jQuery("#frmpass").on('submit', (function(e) {
        e.preventDefault();
        var url = "<?php echo base_url('user_admin/changepassAction'); ?>"; 
        //var oldpass = jQuery("#oldpass").val();

        jQuery.ajax({
            url: url,
            type: "POST",
            //data: {oldpass:oldpass},
            data:new FormData(this),
            contentType: false,
            cache: false,
            dataType: "json",
            processData: false,
            success: function(data) {
                if(data.type == "error"){
                    var total = data.msgs;
                    var obj = Object.keys(total);
                    for (var i = 0; i < obj.length; i++) {
                       jQuery('.' + obj[i]).html(total[obj[i]]);
                    };
                }else if(data.type=="failed"){
                    var msg = data.msg;
                    jQuery(".try").hide(); 
                    jQuery(".confirmpass").hide();
                    jQuery(".success").hide();
                    jQuery(".error").html(msg); 
                }else if(data.type=="success"){
                    var msg = data.msg;
                    jQuery(".try").hide(); 
                    jQuery(".confirmpass").hide();
                    jQuery(".error").hide();
                    jQuery(".success").html(msg); 
                    // setTimeout(function(){ 
                    //     location.reload(true);
                    // }, 1000);
                    
                }else if(data.type=="fail"){
                    var msg = data.msg;
                    jQuery(".error").hide();
                    jQuery(".confirmpass").hide();
                    jQuery(".success").hide(); 
                    jQuery(".try").html(msg); 
                }
            },

        });
    }));
});
</script>

  <div class="col-sm-8">
    <div class="admin_leftbar">
        <h3>Change Password:</h3>
        <div class="row">
            <form role="form" method="post" action="#" id="frmpass">
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="oldpassword"><span>*</span>Old Password:</label>
                        <input type="password" id="oldpass" class="form-control" name="oldpass" autocomplete="off">
                        <span class="err oldpass"></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="password"><span>*</span>New Password:</label>
                        <input type="password" id="" class="form-control" name="newpass">
                        <span class="err newpass"></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="confirmpassword"><span>*</span>Confirm Password:</label>
                        <input type="password" id="" class="form-control" name="confirmpass">
                        <span class="err confirmpass"></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <!-- <button class="btn btn-back" type="submit">Back</button> -->
                        <button class="btn btn-contact" type="submit">Countinue</button>
                    </div>
                </div>
            </form>
            <span class="success"></span>
            <span class="error"></span>
            <span class="try"></span>
        </div>
    </div>
</div>