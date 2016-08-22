 <script>
jQuery(document).ready(function(){
    jQuery("#updateaddress").on('submit', (function(e) {
        e.preventDefault();
        var url = "<?php echo base_url('user_admin/updateaddress'); ?>"; 
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
                    var total = data.msgs;
                    var obj = Object.keys(total);
                    for (var i = 0; i < obj.length; i++) {
                       jQuery('.' + obj[i]).html(total[obj[i]]);
                    };
                }else if(data.type=="failed"){
                    var msg = data.msg;
                    jQuery(".success").hide();
                    jQuery(".error").html(msg); 
                }else if(data.type=="success"){
                    var msg = data.msg;
                    jQuery(".error").hide();
                    jQuery(".success").html(msg); 
                    setTimeout(function(){ 
                        location.reload(true);
                    }, 1000);
                    
                }
            },

        });
    }));
});
</script>


<div class="col-sm-8">
    <div class="admin_leftbar">
        <h3>Edit Address 1:</h3>
        <div class="row">
            <?php if($result){ ?>
            <form role="form" method="post" action="#" id="updateaddress">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span>*</span>First Name:</label>
                        <input type="text" id="" class="form-control" value="<?php echo $result->firstname; ?>" name="firstname">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span>*</span>Last Name:</label>
                        <input type="text" id="Lname" class="form-control"  value="<?php echo $result->lastname; ?>" name="lastname">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="email">Company:</label>
                        <input type="text" id="email" class="form-control"  value="<?php echo $result->company; ?>" name="company">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Telephone:</label>
                        <input type="text" id="fname" class="form-control"  value="<?php echo $result->phone; ?>" name="phone">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Fax:</label>
                        <input type="text" id="email" class="form-control" value="<?php echo $result->fax; ?>" name="fax">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="email">Address:</label>
                        <input type="text" id="email" class="form-control" value="<?php echo $result->address1; ?>" name="address1">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="text" id="" class="form-control" value="<?php echo $result->address2; ?>" name="address2">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="email"><span>*</span>City:</label>
                        <input type="text" id="email" class="form-control" value="<?php echo $result->city; ?>" name="city">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span>*</span>Zip / Postal Code:</label>
                        <input type="text" id="fname" class="form-control" value="<?php echo $result->zip; ?>" name="zip">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span>*</span>Country:</label>
                        <input type="text" id="Lname" class="form-control" value="<?php echo $result->country; ?>" name="country">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="form_last">
                            <input type="checkbox" name="default_address" <?php if($result->default_address==="1"){echo 'checked';}else{}; ?>> Set as default address. <span class="requerd"><span>*</span>Required
                            Fields</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <button class="btn btn-contact" type="submit">SAVE</button>
                    </div>
                </div>
            </form>
            <?php } ?>
        </div>
    </div>
</div>