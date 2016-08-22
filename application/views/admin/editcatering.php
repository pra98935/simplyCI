<script>
jQuery(document).ready(function(){
 
jQuery("#uploadBtn").change(function(){
    var f = jQuery(this).val();
    //alert(f);
    jQuery("#uploadFileedit").val(f);
});   

jQuery("#updatectrrecord").on('submit', (function(e) {
    e.preventDefault();
    <?php  $id = $result->id; ?>
    var url = "<?php echo base_url('admin/updatecatAction/'.$id.''); ?>"; 
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
		<h3 class="admin_heading">Edit Sausage Penne</h3>
		<div class="row">
		<form role="form" id="updatectrrecord" action="#" method="post">
			<div class="col-sm-12">
				<div class="form-group">
					<label for="month">Category:</label>
					<select class="form-control" name="catlist">
		              <?php
		                foreach ($allcatering as $val) { ?>
		                  <option value="<?php echo $val['category']; ?>" <?php if($result->cat_name==$val['category']){echo 'selected';}else{} ?>><?php echo $val['category']; ?></option>
		              <?php } ?>
		            </select>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label for="email">Title</label>
					<input type="text" class="form-control" id="Lname" name="item" value="<?php echo $result->item; ?>">
					<span class="item err"></span>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group">
					<label for="email">Upload Image:</label>
					<!-- <input type="file" id="email" class="form-control" placeholder="New Jersey"> -->
					<input disabled="disabled" class="form-control" id="uploadFileedit" value="<?php echo base_url()."asset/admin/uploads/catering_item/".$result->image; ?>">
					<div class="fileUpload btn btn-primary">
						<span>Upload Image</span>
						<input type="file" class="upload" id="uploadBtn" name="image"> 
					</div>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group">
					<label for="email">Half Tray Price:</label>
					<input type="text" class="form-control" id="fname" name="half_tray" value="<?php echo $result->half_tray; ?>">
					<span class="half_tray err"></span>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group">
					<label for="email">Full Tray Price:</label>
					<input type="text" class="form-control" name="full_tray" value="<?php echo $result->full_tray; ?>">
					<span class="full_tray err"></span>
				</div>
			</div>

			<div class="col-sm-12">
				<div class="form-group">
					<button type="submit" class="btn btn-contact">update</button>
				</div>
			</div>
			</form>
			<div class="success"></div>
			<div class="error"></div>
		</div>
	</div>
</div>