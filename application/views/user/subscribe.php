 <script>
jQuery(document).ready(function(){

    // jQuery("input[name='subscribe']").change(function(){
    //     var subscribe = jQuery(this).val();
    //     alert(subscribe);
    // });


    jQuery("input[name='subscribe']").on('change', (function(e) {
        e.preventDefault();
        var subscribe = jQuery(this).val();
        var url = "<?php echo base_url('user_admin/newsletter'); ?>"; 
        jQuery.ajax({
            url: url,
            type: "POST",
            data: {subsval:subscribe},
            dataType: "json",
            success: function(data) {
                // if(data.type == "error"){
                //     var total = data.msgs;
                //     var obj = Object.keys(total);
                //     for (var i = 0; i < obj.length; i++) {
                //        jQuery('.' + obj[i]).html(total[obj[i]]);
                //     };
                // }else if(data.type=="failed"){
                //     var msg = data.msg;
                //     jQuery(".success").hide();
                //     jQuery(".error").html(msg); 
                // }else if(data.type=="success"){
                //     var msg = data.msg;
                //     jQuery(".error").hide();
                //     jQuery(".success").html(msg); 
                //     setTimeout(function(){ 
                //         window.location.href = '<?php echo base_url(); ?>user_admin/modifyaddress';
                //     }, 2000);
                    
                // }
            },

        });
    }));




});
</script>


<div class="col-sm-8">
    <div class="admin_leftbar">
        <h3>Newsletter Subscribtion</h3>
        <div class="row">
            <form role="form" method="post" action="#">
                <div class="col-sm-12">
                    <div class="new_subscribed">
                        <label for="email">Remain Subscribed</label>
                        <div id="order_id" class="order_check">
                            <ul>
                                <li>
                                    <input type="radio" name="subscribe" id="f-option" value="1" <?php if($result->newsletter==="1"){echo 'checked'; }else{}; ?> >
                                    <label for="f-option">yes</label>
                                    <div class="check"></div>
                                </li>
                                <li>
                                    <input type="radio" name="subscribe" id="s-option" value="0" <?php if($result->newsletter==="0"){echo 'checked'; }else{}; ?>>
                                    <label for="s-option">no</label>
                                    <div class="check">
                                    <div class="inside"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <a href="#" class="btn btn-back"> Back</a>
                </div>
            </form>
        </div>
    </div>
</div>