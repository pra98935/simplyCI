 <script>
jQuery(document).ready(function(){
    jQuery("#user_register").on('submit', (function(e) {
        e.preventDefault();
        var url = "<?php echo base_url('home/registerAction'); ?>"; 
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
                    var msg = data.msgs;
                    jQuery(".err").hide();
                    jQuery(".success").hide();
                    jQuery(".error").show(); 
                    jQuery(".error").html(msg); 
                }else if(data.type=="success"){
                    // var msg = data.msgs;
                    // jQuery(".err").hide();
                    // jQuery(".error").hide();
                    // jQuery(".success").show();
                    // jQuery(".success").html(msg); 

                    window.location.href = "<?php echo base_url('user_admin'); ?>";
                }
            },

        });
    }));
});
</script> 




 <div class="main_container how_it">
            <section class="common howit_contain">
                <div class="container">
                    <div class="row">



<div class="login_container registration_page">
    <div class="admin_leftbar">
        <h1 class="main_head">Register Your account</h1>
        <div class="row">
            <form role="form" method="post" action="#" id="user_register">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span class="cmplsry">*</span>First Name:</label>
                        <input type="text" name="firstname" id="firstname" class="form-control">
                        <span class="firstname err"></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span class="cmplsry">*</span>Last Name:</label>
                        <input type="text" name="lastname" id="lname" class="form-control">
                        <span class="lastname err"></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span class="cmplsry">*</span>Email:</label>
                        <input type="email" name="email" id="email" class="form-control">
                        <span class="email err"></span>
                    </div>
                </div>
                
                 <div class="col-sm-6">
                    <div class="form-group">
                        <label for="phone">Telephone:</label>
                        <input type="text" id="phone" name="phone" class="form-control">
                    </div>
                </div> 

                 <div class="col-sm-6">
                    <div class="form-group">
                        <label for="fax">Fax:</label>
                        <input type="text" id="" class="form-control" name="fax">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">How Did You Hear About Us?</label>
                        <select class="form-control" name="hearabtus">
                            <option value="Search Engine" >Search Engine</option>
                            <option value="Newspaper">Newspaper</option>
                            <option value="By Email">By Email</option>
                            <option value="By Friends">By Friends</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="Allergies">Do You Have Any Food Allergies?</label>
                        <div class="chk_box">
                            <ul>
                                <li><input type="checkbox" name="allergies[]" value="nuts1"> Nuts1 </li>
                                <li><input type="checkbox" name="allergies[]" value="nuts2"> Nuts2 </li>
                                <li><input type="checkbox" name="allergies[]" value="nuts3"> Nuts3 </li>
                                <li><input type="checkbox" name="allergies[]" value="nuts4"> Nuts4 </li>
                                <li><input type="checkbox" name="allergies[]" value="nuts5"> Nuts5 </li>
                                <li><input type="checkbox" name="allergies[]" value="nuts6"> Nuts6 </li>
                                <li><input type="checkbox" name="allergies[]" value="nuts7"> Nuts7 </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <h2 class="sub_rgs">YOUR ADDRESS</h2>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Company:</label>
                        <input type="text" id="email" class="form-control" name="company">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span class="cmplsry">*</span>Address1:</label>
                        <input type="text" id="" class="form-control" name="address1">
                        <span class="address1 err"></span>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Address2:</label>
                        <input type="text" id="" class="form-control" name="address2">
                    </div>
                </div>

                 <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span class="cmplsry">*</span>County:</label>
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
                        <label for="city"><span class="cmplsry">*</span>City:</label>
                        <input type="text" id="city" class="form-control" name="city">
                        <span class="city err"></span>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="state"><span class="cmplsry">*</span>State:</label>
                        <input type="text" id="state" class="form-control" name="state" value="New Jersey" disabled="">
                        <span class="state err"></span>
                    </div>
                </div>

                 <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span class="cmplsry">*</span>Zip / Postal Code:</label>
                        <input type="text" id="zip" class="form-control" name="zip">
                        <span class="zip err"></span>
                    </div>
                </div>

                <div class="col-sm-12">
                    <h2 class="sub_rgs">YOUR PASSWORD</h2>
                </div>
  
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="password"><span class="cmplsry">*</span>Password:</label>
                    <input type="password" id="" class="form-control" name="password">
                    <span class="err password"></span>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="confirmpassword"><span class="cmplsry">*</span>Confirm Password:</label>
                    <input type="password" id="" class="form-control" name="confirmpass">
                    <span class="err confirmpass"></span>
                  </div>
                </div>
               

                
                <div class="col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-contact" type="submit">Register</button>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="success"></div>
                    <div class="error"></div>
                </div>
            </form>
        </div>
    </div>
</div>

             </div>
                </div>
            </section>
 </div>