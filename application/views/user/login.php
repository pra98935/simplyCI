<?php 
    if($this->input->cookie('remember_me', TRUE)){ 
        $str = $this->input->cookie('remember_me', TRUE); 
        $Arrcookie = explode("/",$str);
        $email_cookie = $Arrcookie[0];
        $pass_cookie  = $Arrcookie[1];
    }
?>

          <div class="login_contain">
            <section class="common">
                <div class="login_container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="login_form">
                                
                              <?php echo form_error('email'); ?>
                              <?php echo form_error('password'); ?>
                              <?php echo $this->session->flashdata('error'); ?>

                                <h1 class="main_head">LOGIN</h1>
                                <div class="row contactrow">
                                <form action="<?php echo base_url(); ?>user_admin/user_login_cntrl" method="post">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>E-mail Address:</label>
                                        <input type="text" class="form-control" name="email" value="<?php if($this->input->cookie('remember_me', TRUE)){ echo $email_cookie; }else{} ?>" />
                                    </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input type="password" class="form-control" name="password" value="<?php if($this->input->cookie('remember_me', TRUE)){ echo $pass_cookie; }else{} ?>" />
                                    </div>
                                    </div> 
                                    
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <a href="<?php echo base_url(); ?>user_admin/forgotpass" class="frt_paswrd">Forgot Password?</a>
                                    </div>
                                    </div>

                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="submit" name="submit" value="Submit" class="btn btn-contact" />
                                    </div>
                                    </div> 

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                          <div class="checkbox">
                                            <label><input type="checkbox" name="remember" value="1" <?php if($this->input->cookie('remember_me', TRUE)){ echo 'checked'; }else{} ?>> Remember me</label>
                                          </div>
                                        </div>
                                    </div>

                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
          </div>
          