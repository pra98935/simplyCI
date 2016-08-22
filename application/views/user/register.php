 <div class="col-sm-8">
    <div class="admin_leftbar">
        <h3>Your Personal Details</h3>
        <div class="row">
            <form role="form" method="post" action="<?php echo base_url()?>user_admin/register_cntrl">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span>*</span>First Name:</label>
                        <input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo set_value('firstname')?>">
                        <span><?php echo form_error('firstname'); ?></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span>*</span>Last Name:</label>
                        <input type="text" name="lastname" id="lname" class="form-control" value="<?php echo set_value('lastname')?>" >
                        <span><?php echo form_error('lastname'); ?></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span>*</span>Email:</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo set_value('email')?>" >
                        <span><?php echo form_error('email'); ?></span>
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
                        <label for="email">Do You Have Any Food Allergies?</label>
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
                        <label for="email"><span>*</span>Address1:</label>
                        <input type="text" id="" class="form-control" name="address1">
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
                        <label for="email"><span>*</span>County:</label>
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
                        <span class="county"></span>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span>*</span>City:</label>
                        <input type="text" id="email" class="form-control" name="city">
                        <span class="city"></span>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span>*</span>State:</label>
                        <input type="text" id="email" class="form-control" name="state" value="New Jersey">
                        <span class="city"></span>
                    </div>
                </div>

                 <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email"><span>*</span>Zip / Postal Code:</label>
                        <input type="text" id="fname" class="form-control" name="zip">
                        <span class="zip"></span>
                    </div>
                </div>

                <div class="col-sm-12">
                    <h2 class="sub_rgs">YOUR PASSWORD</h2>
                </div>
 
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="pass"><span>*</span>Password:</label>
                        <input type="password" name="password" id="email" class="form-control" value="<?php echo set_value('password')?>" > 
                        <span><?php echo form_error('password'); ?></span>
                    </div>
                </div>
               

                
                <div class="col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-contact" type="submit">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>