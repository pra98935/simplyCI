<script>
jQuery(document).ready(function(){

jQuery("#uploadBtn").change(function(){
    var f = jQuery(this).val();
    //alert(f);
    jQuery("#uploadFiletext").val(f);
});    
 
jQuery("#addcatfrm").on('submit', (function(e) {
    e.preventDefault();
    var url = "<?php echo base_url('admin/addcateringAction'); ?>"; 
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
                        window.location.href = '<?php echo base_url(); ?>admin/catering';
                    }, 2000);
                    
                }
        },

    });

}));
    

});
</script>


<div class="col-sm-8">
    <div class="admin_leftbar owner_admin">
        <h3 class="admin_heading">Add a Meal</h3>
        <div class="row">
            <form role="form" method="post" action="#" id="addcatfrm">
                <div class="col-sm-12 add_catering">
                    <div class="form-group">
                        <label for="month">Category:</label>
                        <select class="form-control" name="catlist">
                            <?php
                            foreach ($result as  $value) { ?>
						         <option value="<?php echo $value['category']; ?>" id="<?php echo $value['id']; ?>"><?php echo $value['category']; ?></option>
							<?php } ?>
                        </select>

                        <div class="add_newcat"> <a href="#myModal" data-toggle="modal" ><i class="fa fa-plus"></i></a></div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="" name="item">
                        <span class="item err"></span>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="image">Upload Image:</label>
                        <input disabled="disabled" class="form-control" id="uploadFiletext">
                        <div class="fileUpload btn btn-primary">
                            <span>Upload Image</span>
                            <input type="file" class="upload" id="uploadBtn" name="image">
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="halftray">Half Tray Price:</label>
                        <input type="text" class="form-control" id="fname" name="half_tray">
                        <span class="half_tray err"></span>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="fulltray">Full Tray Price:</label>
                        <input type="text" class="form-control" name="full_tray">
                        <span class="full_tray err"></span>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-contact">save</button>
                    </div>
                </div>
            </form>
 
            <div class="success"></div>
            <div class="error"></div>
            
        </div>
    </div>
</div>

<!-- add modal -->

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#cat_name_form").on('submit', (function(e) {
	    e.preventDefault();
	    var url = "<?php echo base_url('admin/addcat'); ?>"; 
	    jQuery.ajax({
	        url: url,
	        type: "POST",
	        data: new FormData(this),
	        contentType: false,
	        cache: false,
	        dataType: "json",
	        processData: false,
	        success: function(data) {

	        	if(data.type == "invalid"){
	        		var msg = data.msg;
	        		jQuery('.error').html(msg);
	        	}else if(data.type == "failed"){
	                var msg = data.msg;
	                jQuery('.success').hide();
	        		jQuery('.error').html(msg);
	        	}else if(data.type == "success"){
	                var msg = data.msg;
	                jQuery('.error').hide();
	        		jQuery('.success').html(msg);
	        		setTimeout(function(){ 
	        			window.location.href = '<?php echo base_url(); ?>admin/addcatering';
	        		}, 2000);
	        	}
	        },

	    });

	}));
});
</script>


<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog add_cateringmn">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h3 class="admin_heading">Add a Category</h3>
                <form method="post" action="#" id="cat_name_form">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="email">Title</label>
                            <input type="text" class="form-control" id="cat_name" name="category" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-contact">save</button>
                        </div>
                    </div>
                    
                    <div class="success"></div>
                    <div class="error"></div>

                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>