<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
jQuery(document).ready(function(){
	tinymce.init({
    selector: "#editor2",
    theme: "modern",
    height: 400,
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

	

    
jQuery("#updatefrm").on('submit', (function(e) {
    e.preventDefault();
    tinyMCE.triggerSave();
    var url = "<?php echo base_url('admin/updatepage'); ?>"; 
    jQuery.ajax({
        url: url,
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        dataType: "json",
        processData: false,
        success: function(data) {
        	if(data.type == "failed"){
                var msg = data.msg;
        		jQuery('.error').html(msg);
        	}else if(data.type == "title_blank"){
                var msg = data.msg;
        		jQuery('.error').html(msg);
        	}else{
               //window.location.href = 'http://43.229.224.74/ci/simplydeliciousdinners/admin/allpagesmenu';
               window.location.href = '<?php echo base_url(); ?>admin/allpagesmenu';

        	}
        },

    });

}));
	
});
</script>


<div class="col-sm-8">
    <div class="admin_leftbar owner_admin">
        <div class="admin_order">
		
            <?php if($result){ ?>
                <form method="post" action="#" id="updatefrm">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="email">Page Title:</label>
                            <input type="text" name="page_title" class="in_pagetitle form-control" value="<?php echo $result->title; ?>"/>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 nopadding">
                        <div class="form-group">
                            <label for="email">Customer Review:</label>
                            <textarea id="editor2" name="desc"><?php echo $result->description; ?></textarea>
                            
                            <div class="form-group">
                                <input type="hidden" id="" name="pageid" value="<?php echo $result->id; ?>" />
                                <button type="submit" id="updatepage" class="btn btn-contact">Update</button>
                            </div>
                            
                        </div>
                    </div>      
                </form>
            <?php } ?>
			<div class="error"></div>
    
        </div> 
    </div>
</div>