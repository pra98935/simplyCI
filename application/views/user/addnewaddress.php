 <script>
jQuery(document).ready(function(){
    jQuery("#newaddress").on('submit', (function(e) {
        e.preventDefault();
        var url = "<?php echo base_url('user_admin/insertnewadd'); ?>"; 
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
                    // setTimeout(function(){ 
                    //     location.reload(true);
                    // }, 2000);
                    
                }
            },

        });
    }));
});
</script>

<div class="col-sm-8">
    <div class="admin_leftbar">
        <h3>Add New Address:</h3>
        <div class="row">
            <form role="form" method="post" action="#" id="newaddress">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="firstname"><span>*</span>First Name:</label>
                        <input type="text" id="" class="form-control" name="firstname">
                        <span class="firstname err"></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="lastname"><span>*</span>Last Name:</label>
                        <input type="text" id="" class="form-control" name="lastname">
                        <span class="lastname err"></span>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="company">Company:</label>
                        <input type="text" id="" class="form-control" name="company">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="phone">Telephone:</label>
                        <input type="text" id="" class="form-control" name="phone">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="fax">Fax:</label>
                        <input type="text" id="" class="form-control" name="fax">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="" class="form-control" name="address1">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">

                        <input type="text" id="" class="form-control" name="address2">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="city"><span>*</span>City:</label>
                        <input type="text" id="" class="form-control" name="city">
                        <span class="city err"></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="state"><span>*</span>State:</label>
                        <input type="text" id="email" class="form-control" value="New Jersey" name="state" disabled>
                        <span class="state err"></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="county"><span>*</span>County:</label>
                        <select name="county" id="input-county" class="form-control">
                          <option value="">--Select--</option>
                          <option value="essex_counties">Essex Counties</option>
                          <option value="hunterdon">Hunterdon</option>
                          <option value="mercer">Mercer</option>
                          <option value="middlesex_counties">Middlesex Counties</option>
                          <option value="morris">Morris</option>
                          <option value="somerset">Somerset</option>
                          <option value="union">Union</option>
                          <option value="warren">Warren</option>
                        </select>
                        <span class="county err"></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="zip"><span>*</span>Zip / Postal Code:</label>
                        <input type="text" id="" class="form-control" name="zip">
                        <span class="zip err"></span>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="form_last">
                            <input type="checkbox" name="da" value="1"> Set as default address. <span class="requerd"><span>*</span>Required
                            Fields</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <button class="btn btn-contact" type="submit" name="save">SAVE</button>
                    </div>
                </div>
            </form>
            <span class="error"></span>
            <span class="success"></span>
        </div>
    </div>
</div>