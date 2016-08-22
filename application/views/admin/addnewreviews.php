<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
jQuery(document).ready(function(){
	tinymce.init({
    selector: "#editoraddreview",
    theme: "modern",
    height: 100,
    font_size_classes: "fontSize1, fontSize2, fontSize3, fontSize4, fontSize5, fontSize6",
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
    ],

    //content_css: "css/content.css",
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | sizeselect | fontselect | fontsize | fontsizeselect",
    style_formats: [{
        title: 'Bold text',
        inline: 'b'
    }, {
        title: 'Red text',
        inline: 'span',
        styles: {
            color: '#ff0000'
        }
    }, {
        title: 'Red header',
        block: 'h1',
        styles: {
            color: '#ff0000'
        }
    }, {
        title: 'Example 1',
        inline: 'span',
        classes: 'example1'
    }, {
        title: 'Example 2',
        inline: 'span',
        classes: 'example2'
    }, {
        title: 'Table styles'
    }, {
        title: 'Table row 1',
        selector: 'tr',
        classes: 'tablerow1'
    }]
});

jQuery("#rvwfrm").on('submit', (function(e) {
    e.preventDefault();
    tinyMCE.triggerSave();
    var url = "<?php echo base_url('admin/addnewreviewsAction'); ?>"; 
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
            }else if(data.type == "failed"){
                var msg = data.msg;
        		jQuery(".err").hide();
        		jQuery(".success").hide();
        		jQuery(".error").show();
        		jQuery(".error").html(msg);
        	}else if(data.type == "success"){
                var msg = data.msg;
                jQuery(".err").hide();
                jQuery(".error").hide();
                jQuery(".success").show();
        		jQuery(".success").html(msg);
        	}
        },

    });

}));

});
</script>



<div class="col-sm-8">
	<div class="admin_leftbar owner_admin">
		<h3 class="admin_heading">Add New Review</h3>
		<div class="row">
			<form role="form" method="post" id="rvwfrm" action="#">
				<div class="col-sm-12">
					<div class="form-group">
						<label for="customer_name">Customer Name:</label>
						<input type="text" class="form-control" id="" name="name">
						<span class="name err"></span>
					</div>
				</div>
				
				<div class="col-lg-12 nopadding">
					<div class="form-group">
						<label for="customer review">Customer Review:</label>
						<textarea id="editoraddreview" name="review"></textarea>
						<span class="review err"></span> 
						
						<div class="form-group">
							<button type="submit" class="btn btn-contact">SAVE</button>
						</div>
						
					</div>
				</div>		
			</form>
           
            <span class="success"></span>
            <span class="error"></span>

		</div>
	</div>
</div>