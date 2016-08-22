<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
jQuery(document).ready(function(){
	tinymce.init({
    selector: "#editmenumeal",
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

	

    
jQuery("#frm_update_new_meal").on('submit', (function(e) {
    
    var id = jQuery(".btn-contact").attr('id');
    e.preventDefault();
    tinyMCE.triggerSave();
    var url = "<?php echo base_url('admin/editMealAction/"+id+"'); ?>";
    
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
                jQuery(".success").hide();
                jQuery(".error").hide(); 
                for (var i = 0; i < obj.length; i++) {
                   jQuery('.' + obj[i]).html(total[obj[i]]);
                };
            }else if(data.type=="failed"){
                var msg = data.msg;
                jQuery(".err").hide();
                jQuery(".success").hide();
                jQuery(".error").html(msg); 
            }else if(data.type=="success"){
                var msg = data.msg;
                jQuery(".error").hide();
                jQuery(".err").hide();
                jQuery(".success").html(msg); 
                // setTimeout(function(){ 
                //     window.location.href = '<?php echo base_url(); ?>admin/filterEditMenu';
                // }, 2000);
                
            }
        },

    });

}));
	
});
</script>


<div class="col-sm-8">
    <div class="admin_leftbar owner_admin">
        <h3 class="admin_heading">Edit Lemon Pepper Shrimp Scampi with orzo</h3>
        <div class="row">
            <form role="form" method="post" action="#" id="frm_update_new_meal">
                 <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Title:</label>
                        <input type="text" class="form-control" id="" name="title" value="<?php echo $result->title; ?>">
                        <span class="title err"></span>
                    </div>
                </div>

                 <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Total Cooking Time:</label>
                        <input type="text" class="form-control" id="" name="cooking_time" value="<?php echo $result->cooking_time; ?>" >
                        <span class="cooking_time err"></span>
                    </div>
                </div>

                 <div class="col-sm-12">
                    <div class="form-group">
                        <label for="email">Description:</label>
                        <input type="text" class="form-control" id="" name="description" value="<?php echo $result->description; ?>">
                        <span class="description err"></span>
                    </div>
                </div>

                <div class="col-lg-12 nopadding">
                    <div class="form-group">
                        <textarea id="editmenumeal" name="cooking_instructions">
                            <?php echo $result->cooking_instructions; ?>
                        </textarea> 
                    </div>
                </div>

                 <div class="col-lg-12 ">
                    <label for="email"></label>
                </div>

                <div class="col-lg-12 ">
                    <label for="email">Nutritional Information:</label>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">calories:</label>
                        <input type="text" class="form-control" id="" name="cal" value="<?php echo $result->cal; ?>">
                        <span class="cal err"></span>
                    </div>
                </div>

               <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Total fat:</label>
                        <input type="text" class="form-control" id="" name="total_fat" value="<?php echo $result->total_fat; ?>">
                        <span class="total_fat err"></span>
                    </div>
                </div>

               <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Carbohydrate:</label>
                        <input type="text" class="form-control" id="" name="carbohydrate" value="<?php echo $result->carbohydrate; ?>">
                        <span class="carbohydrate err"></span>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Protein:</label>
                        <input type="text" class="form-control" id="" name="protein" value="<?php echo $result->protein; ?>">
                        <span class="protein err"></span>
                    </div>
                </div>

                 <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Sodium:</label>
                        <input type="text" class="form-control" id="" name="sodium" value="<?php echo $result->sodium; ?>">
                        <span class="sodium err"></span>
                    </div>
                </div>

               <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Sugar:</label>
                        <input type="text" class="form-control" id="" name="sugar" value="<?php echo $result->sugar; ?>">
                        <span class="sugar err"></span>
                    </div>
                </div>

                 <div class="col-sm-12">
                    <div class="form-group">
                        <label for="image">Upload Image:</label>
                        <input disabled="disabled" class="form-control" id="uploadFiletext" value="<?php echo $result->image; ?>">
                        <div class="fileUpload btn btn-primary">
                            <span>Upload Image</span>
                            <input type="file" class="upload" id="uploadBtn" name="image">
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">3 Servings Price:</label>
                        <input type="text" class="form-control" id="" name="service_price_3" value="<?php echo $result->service_price_3; ?>">
                        <span class="service_price_3 err"></span>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">6 Servings Price:</label>
                        <input type="text" class="form-control" id="" name="service_price_6" value="<?php echo $result->service_price_6; ?>">
                        <span class="service_price_6 err"></span>
                    </div>
                </div>

                <div class="col-sm-6">
                        <div class="form-group">
                            <label for="month">Select Month:</label>
                            <?php //echo $result->add_menu_year; ?>
                            <select class="form-control" name="add_menu_month" id="id-add-month-filter">
                                <option value="january"   <?php if($result->add_menu_month =='january'){echo 'selected';}else{} ?> >January</option>
                                <option value="februry"   <?php if($result->add_menu_month =='februry'){echo 'selected';}else{} ?>>februry</option>
                                <option value="march"     <?php if($result->add_menu_month =='march'){echo 'selected';}else{} ?>>March</option>
                                <option value="april"     <?php if($result->add_menu_month =='april'){echo 'selected';}else{} ?>>April</option>
                                <option value="may"       <?php if($result->add_menu_month =='may'){echo 'selected';}else{} ?>>May</option>
                                <option value="june"      <?php if($result->add_menu_month =='june'){echo 'selected';}else{} ?>>June</option>
                                <option value="july"      <?php if($result->add_menu_month =='july'){echo 'selected';}else{} ?>>July</option>
                                <option value="august"    <?php if($result->add_menu_month =='august'){echo 'selected';}else{} ?>>August</option>
                                <option value="september" <?php if($result->add_menu_month =='september'){echo 'selected';}else{} ?>>September</option>
                                <option value="october"   <?php if($result->add_menu_month =='october'){echo 'selected';}else{} ?>>October</option>
                                <option value="november"  <?php if($result->add_menu_month =='november'){echo 'selected';}else{} ?>>November</option>
                                <option value="december"  <?php if($result->add_menu_month =='december'){echo 'selected';}else{} ?>>December</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="year">Select Year:</label>
                            <?php //echo $result->add_menu_month; ?>
                            <select class="form-control" name="add_menu_year" id="id-add-year-filter">
                                <option value="2016" <?php if($result->add_menu_year == '2016'){echo 'selected';}else{} ?>>2016</option>
                                <option value="2017" <?php if($result->add_menu_year == '2017'){echo 'selected';}else{} ?>>2017</option>
                                <option value="2018" <?php if($result->add_menu_year == '2018'){echo 'selected';}else{} ?>>2018</option>
                                <option value="2019" <?php if($result->add_menu_year == '2019'){echo 'selected';}else{} ?>>2019</option>
                                <option value="2020" <?php if($result->add_menu_year == '2020'){echo 'selected';}else{} ?>>2020</option>
                            </select>
                        </div>
                    </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-contact" id="<?php echo $result->id; ?>" >SAVE</button>
                    </div>
                </div>
                <span class="success"></span>
                <span class="error"></span>
            </form>
        </div>
    </div>
</div>