 <script>
jQuery(document).ready(function(){
    jQuery("#sendmail").on('submit', (function(e) {
        e.preventDefault();
        var url = "<?php echo base_url('home/sendform'); ?>"; 
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
                    }, 3000);
                    
                }
            },

        });
    }));
});
</script>

<div class="main_container how_it">
<section class="common howit_contain">
<div class="contact_container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="main_head">SEND US A MESSAGE</h1>
        </div>
    </div>
    <div class="row contactrow">

        <form role="form" method="post" action="#" id="sendmail">
            <div class="col-sm-6">
            <div class="form-group">
            <label for="firstname">First Name<span>*</span>:</label>
            <input type="text" class="form-control" id="fname" name="firstname">
            <span class="firstname err"></span>
            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
            <label for="lastname">Last Name<span>*</span>:</label>
            <input type="text" class="form-control" id="Lname" name="lastname">
            <span class="lastname err"></span>
            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
            <label for="email">Email<span>*</span>:</label>
            <input type="email" class="form-control" id="email" name="email">
            <span class="email err"></span>
            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="fname" name="phone">
            </div>
            </div>
            <div class="col-sm-12">
            <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control" name="message"></textarea>
            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
            <button type="submit" class="btn btn-contact" id="c-sub" name="mailbtn">send</button>
            </div>
            </div>
        </form>
        <span class="error"></span>
        <span class="success"></span>
        

    </div>
</div>
</section>

<section class="common contact_sec">
    <div class="contact_bar">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="contact_box">
                        <ul>
                            <li><i class="flaticon2-technology"></i>
                            <h3>Phone:</h3>
                            <a href="#">908-300-2087</a>
                            </li>
                            <li><i class="flaticon2-note-1"></i>
                             <h3>Email:</h3>
                              <a href="#">info@simplydeliciousdinners.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

 <section class="common blog_sec">

    <div class="top_deading">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="head_line"> <span><a href="<?php echo base_url('home/order_my_meal'); ?>" class="order">Order My Meals</a></span> </h1>
                </div>
            </div>
        </div>
    </div>
</section>

</div>