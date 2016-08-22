 <script>
jQuery(document).ready(function(){
	jQuery("#updateuserdetail").on('submit', (function(e) {
		e.preventDefault();
	    var url = "<?php echo base_url('user_admin/userupdateacnt'); ?>"; 
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
        <h3>Your Personal Details</h3>
        <div class="row">
        <?php if($result){ ?>
            <form  method="post" action="#" id="updateuserdetail" enctype="multipart/form-data">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span>*</span>First Name:</label>
                        <input type="text" id="fname" class="form-control" name="firstname" value="<?php echo $result->firstname; ?>">
                        <span class="error firstname"><?php echo form_error('firstname'); ?></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span>*</span>Last Name:</label>
                        <input type="text" id="Lname" name="lastname" class="form-control" value="<?php echo $result->lastname; ?>">
                        <span class="error lastname"><?php echo form_error('lastname'); ?></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" class="form-control"  value="<?php echo $this->session->userdata('email'); ?>" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Telephone:</label>
                        <input type="text" id="" name="phone" class="form-control"  value="<?php echo $result->phone; ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="fax">Fax:</label>
                        <input type="text" id="" class="form-control" name="fax" value="<?php echo $result->fax; ?>">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">How Did You Hear About Us?</label>
                        <select class="form-control" name="hearabtus">
                            <option <?php if($result->hearabtus==="Search Engine"){ echo 'selected';}else{}; ?> value="Search Engine" >Search Engine</option>
                            <option <?php if($result->hearabtus==="Newspaper"){ echo 'selected';}else{}; ?> value="Newspaper">Newspaper</option>
                            <option <?php if($result->hearabtus==="By Email"){ echo 'selected';}else{}; ?> value="By Email">By Email</option>
                            <option <?php if($result->hearabtus==="By Friends"){ echo 'selected';}else{}; ?> value="By Friends">By Friends</option>
                            <option <?php if($result->hearabtus==="Others"){ echo 'selected';}else{}; ?> value="Others">Others</option>
                        </select>
                    </div>
                </div>
                <!-- <div class="col-sm-12">
                    <div class="form-group">
                        <input type="text" id="email" class="form-control">
                    </div>
                </div> -->
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="email">Your Profile Image:</label>
                        <?php 
                           
                           if($result->image){
                                $pathdp = base_url("asset/user/uploads/profile_pic/$result->image");
                           }else{
                                $pathdp = base_url("asset/user/images/avatar.png");
                           }
                        ?>
                        <input type="text" id="uploadFile" class="form-control" placeholder="<?php echo $pathdp; ?>" disabled="disabled" name="imgpath"/>
                        <div class="fileUpload btn btn-primary">
                            <span>Browse</span>
                            <input id="uploadBtn" type="file" class="upload" name="image"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="email">Do You Have Any Food Allergies?</label>
                        <?php $saveallergies = $result->allergies; ?>
                        <div class="chk_box">
                            <ul>
		                        <li><input type="checkbox" name="allergies[]" value="nuts1" <?php if(strpos($saveallergies, 'nuts1') !== false){echo 'checked';}else{} ?> > Nuts1 </li>
		                        <li><input type="checkbox" name="allergies[]" value="nuts2" <?php if(strpos($saveallergies, 'nuts2') !== false){echo 'checked';}else{} ?>> Nuts2 </li>
		                        <li><input type="checkbox" name="allergies[]" value="nuts3" <?php if(strpos($saveallergies, 'nuts3') !== false){echo 'checked';}else{} ?>> Nuts3 </li>
		                        <li><input type="checkbox" name="allergies[]" value="nuts4" <?php if(strpos($saveallergies, 'nuts4') !== false){echo 'checked';}else{} ?>> Nuts4 </li>
		                        <li><input type="checkbox" name="allergies[]" value="nuts5" <?php if(strpos($saveallergies, 'nuts5') !== false){echo 'checked';}else{} ?>> Nuts5 </li>
		                        <li><input type="checkbox" name="allergies[]" value="nuts6" <?php if(strpos($saveallergies, 'nuts6') !== false){echo 'checked';}else{} ?>> Nuts6 </li>
		                        <li><input type="checkbox" name="allergies[]" value="nuts7" <?php if(strpos($saveallergies, 'nuts7') !== false){echo 'checked';}else{} ?>> Nuts7 </li>
                            </ul>
                        </div>
                    </div>
                </div>
             
          
                <div class="col-sm-12">
                    <div class="form-group">
                        <!--<button type="submit" class="btn btn-back">Back</button>-->
                        <button class="btn btn-contact" type="submit">CONTINUE</button>
                    </div>
                </div>
            </form>
            <div class="success"></div>
            <div class="error"></div>
        <?php } ?>    
        </div>
    </div>
</div>