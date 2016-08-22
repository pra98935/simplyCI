 <script>
jQuery(document).ready(function(){
    jQuery("#edituseradd").on('submit', (function(e) {
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
                    jQuery(".err").show();
                    jQuery(".success").hide();
                    jQuery(".error").hide(); 

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
                    setTimeout(function(){ 
                        window.location.href = '<?php echo base_url(); ?>user_admin/modifyaddress';
                    }, 2000);
                    
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
            <form role="form" method="post" action="#" id="edituseradd">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span>*</span>First Name:</label>
                        <input type="text" id="" class="form-control" value="<?php echo $result->firstname; ?>" name="firstname">
                        <span class="firstname err"></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span>*</span>Last Name:</label>
                        <input type="text" id="Lname" class="form-control"  value="<?php echo $result->lastname; ?>" name="lastname">
                        <span class="lastname err"></span>
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
                        <input type="text" id="" class="form-control" value="<?php echo $result->address1; ?>" name="address1">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="text" id="" class="form-control" value="<?php echo $result->address2; ?>" name="address2">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span>*</span>City:</label>
                        <input type="text" id="email" class="form-control" value="<?php echo $result->city; ?>" name="city">
                        <span class="city err"></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="state"><span>*</span>State:</label>
                        <input type="text" id="email" class="form-control" value="<?php echo $result->state; ?>" name="state" disabled>
                        <span class="state err"></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span>*</span>County:</label>
                        <!-- <input type="text" id="Lname" class="form-control" value="<?php //echo $result->county; ?>" name="county"> -->
                        <select name="county" id="input-county" class="form-control">
                          <option value="">--Select--</option>
                          <option value="essex_counties" <?php if($result->county=='essex_counties'){echo 'selected';}else{} ?> >Essex Counties</option>
                          <option value="hunterdon" <?php if($result->county=='hunterdon'){echo 'selected';}else{} ?>>Hunterdon</option>
                          <option value="mercer" <?php if($result->county=='mercer'){echo 'selected';}else{} ?>>Mercer</option>
                          <option value="middlesex_counties" <?php if($result->county=='middlesex_counties'){echo 'selected';}else{} ?>>Middlesex Counties</option>
                          <option value="morris" <?php if($result->county=='morris'){echo 'selected';}else{} ?>>Morris</option>
                          <option value="somerset" <?php if($result->county=='somerset'){echo 'selected';}else{} ?>>Somerset</option>
                          <option value="union" <?php if($result->county=='union'){echo 'selected';}else{} ?>>Union</option>
                          <option value="warren" <?php if($result->county=='warren'){echo 'selected';}else{} ?>>Warren</option>
                        </select>
                        <span class="county err"></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span>*</span>Zip / Postal Code:</label>
                        <input type="text" id="fname" class="form-control" value="<?php echo $result->zip; ?>" name="zip">
                        <span class="zip err"></span>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="form_last">
                            <input type="checkbox" name="da" value = "1" <?php if($result->default_address==="1"){echo 'checked'; }else{}; ?>> Set as default address. <span class="requerd"><span>*</span>Required
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
            <span class="error"></span>
            <span class="success"></span>
            <?php } ?>
        </div>
    </div>
</div>

<?php
// echo '<pre>';
// print_r($result);
?>