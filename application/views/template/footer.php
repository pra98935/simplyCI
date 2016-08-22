<?php
// echo '<pre>';
// print_r($result_footer);
?>
<!--Footer sec start-->
  <footer id="footer" class="footer_sec">
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
          <div class="ftr_box">
            <h3>Contact Info</h3>
            <ul class="first_ftr">
              <li><a href="#">t is a long established fact that a reader will be distracted</a></li>
              <li><a href="#">Phone:<span>908-300-2087</span></a></li>
              <li><a href="mailto:simplydeliciousdinners@outlook.com">Email:<span>simplydeliciousdinners@outlook.com</span></a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="ftr_box">
            <h3> MY ACCOUNT</h3>
            <ul>
              <li><a href="#">My Account</a></li>
              <li><a href="#">Order History</a></li>
              <li><a href="#">Newsletter</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="ftr_box">
            <h3> INFORMATION</h3>
            <ul>
              <!-- <li><a href="<?php //echo base_url('home/pages/about_us'); ?>">About Us</a></li>
              <li><a href="<?php //echo base_url('home/pages/privacy_policy'); ?>">Privacy Policy</a></li>
              <li><a href="<?php //echo base_url('home/pages/terms_conditions'); ?>">Terms & Conditions</a></li>
              <li><a href="<?php //echo base_url('home/pages/faqs'); ?>">FAQs</a></li> -->
              
              <?php
              foreach ($result_footer as $value) {
                    $search = array(' ', '&');
                    $replace = array('_', 'and');
                    $title = str_replace($search, $replace, $value['title']);

                    //$title = str_replace(' ', '_', $value['title']); ?>
                    <li><a href="<?php echo base_url(); ?>home/pages/<?php echo $title; ?>"><?php echo $value['title']; ?></a></li>
              <?php } ?>


            </ul>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="ftr_box">
          <h3> Get Coupons & menu updates</h3>
<?php 
if(isset($_REQUEST['signup']))
{
	$res = insertSubscribers(array('name'=>$_REQUEST['name'],'email'=>$_REQUEST['email']));
	if($res){ 
	?><script>alert('Subscribed Succesfully.');</script> <?php }else{
	?><script>alert('Already Exist.');</script>
<?php }
}//if end ?>
          <form role="form" class="ftr_form" method="post">
            <div class="form-group">
              <input required type="text" class="form-control" name="name" placeholder="Your Name">
            </div>
            <div class="form-group">
              <input required type="email" class="form-control" name="email" placeholder="Email Address">
              <input type="submit" name="signup" class="ftr_submit" value="ok">
            </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3 col-sm-offset-3">
          <div class="ftr_logo"> <img src="<?php echo base_url(); ?>asset/frontend/images/dummy.png" class="img-responsive"> </div>
        </div>
        <div class="col-sm-3">
          <div class="ftr_logo"> <img src="<?php echo base_url(); ?>asset/frontend/images/partner.png" class="img-responsive"> </div>
        </div>
        <div class="col-sm-3">
          <div class="ftr_box second">
            <h3> FOLLOW OUR ADVENTURES</h3>
            <a href="#"><i class="fa fa-facebook"></i></a> </div>
        </div>
      </div>
    </div>
    </div>
    <div class="ftrbottom_sec">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h3>© simply delicious dinners, Inc. 2016 Privacy Terms</h3>
          </div>
        </div>
      </div>
    </div>
  </footer>

  </main>
    
    
    <script src="<?php echo base_url(); ?>asset/frontend/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/frontend/js/slick.js"></script>
    <script src="<?php echo base_url(); ?>asset/frontend/js/plugin.js"></script>
    <script src="<?php echo base_url(); ?>asset/frontend/js/custom.js"></script>

  <!-----------Added by trilok---------------->
	<link href='<?php echo base_url(); ?>asset/calender/css/fullcalendar.css' rel='stylesheet' />
	<link href='<?php echo base_url(); ?>asset/calender/css/fullcalendar.print.css' rel='stylesheet' media='print' />
	<script src='<?php echo base_url(); ?>asset/calender/js/moment.min.js'></script>
	<!--<script src='<?php echo base_url(); ?>asset/calender/js/jquery.min.js'></script>-->
	<script src='<?php echo base_url(); ?>asset/calender/js/jquery-ui.min.js'></script>
	<script src='<?php echo base_url(); ?>asset/calender/js/fullcalendar.min.js'></script>
	<!--------------------------->


</body>
</html>
