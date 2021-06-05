<?=form_open_multipart('form/virtual')?>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group vi-nopart">
                <label><?=lang('vir_first_name')?>*</label>
                <input type="text" class="form-control vi-nopart" autocomplete="off" name="first_name" required="" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group vi-nopart">
                <label><?=lang('vir_last_name')?>*</label>
                <input type="text" class="form-control vi-nopart" autocomplete="off" name="last_name" required=""/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group vi-nopart">
                <label><?=lang('vir_middle_name')?>*</label>
                <input type="text" class="form-control vi-nopart" autocomplete="off" name="middle_name" required=""/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group vi-nopart">
                <label><?=lang('vir_region')?>*</label>
                <select id="region_id" name="region_id" class="form-control vi-nopart" required>
                    <option value="" class="vi-nopart"><?=lang('vir_select')?></option>
                    <? foreach($region as $item): ?>
                    <option value="<?=$item->id_regions?>" class="vi-nopart"><?=_t($item->title, LANG)?></option>
                    <? endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group vi-nopart">
                <label><?=lang('vir_city')?>*</label>
                <select id="city_id" name="city_id" class="form-control vi-nopart">
                    <option value="" class="vi-nopart"><?=lang('vir_select1')?></option>
                    <? foreach($city as $item): ?>
                    <option value="<?=$item->id_city?>" class="hidden vi-nopart" data-region_id="<?=$item->region_id?>" <?//=($this->input->get('city_id') == $item->id_city) ? 'selected' : ''?> ><?=_t($item->title, LANG)?></option>
                    <? endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group vi-nopart">
                <label><?=lang('vir_postcode')?></label>
                <input type="number" class="form-control vi-nopart" autocomplete="off" name="postcode"/>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group vi-nopart">
                <label><?=lang('vir_address')?>*</label>
                <input type="text" class="form-control vi-nopart" autocomplete="off" name="address" required=""/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group vi-nopart">
                <label><?=lang('vir_passport')?>*</label>
                <input type="text" class="form-control vi-nopart" id="number_of_passport" autocomplete="off" name="passport" placeholder="AB 1234567" required=""/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group vi-nopart">
                <label><?=lang('vir_phone')?>*</label>
                <input type="phone" class="form-control phone vi-nopart" autocomplete="off" name="phone" required=""/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group vi-nopart">
                <label><?=lang('vir_email')?></label>
                <input type="email" class="form-control vi-nopart" autocomplete="off" name="email" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group vi-nopart">
                <label><?=lang('vir_face_type')?>*</label>
                 <select name="face_type" class="form-control vi-nopart">
                    <option value="1" class="vi-nopart"><?=lang('vir_face_type_1')?></option>
                    <option value="2" class="vi-nopart"><?=lang('vir_face_type_2')?></option>
                 </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group vi-nopart">
               <label><?=lang('vir_gender')?>*</label>
                 <select name="gender" class="form-control vi-nopart">
                    <option value="1" class="vi-nopart"><?=lang('vir_gender_1')?></option>
                    <option value="2" class="vi-nopart"><?=lang('vir_gender_2')?></option>
                 </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group vi-nopart">
                <label><?=lang('vir_birthday')?></label>
                <input type="date" class="form-control vi-nopart" autocomplete="off" name="birthday"/>
            </div>
        </div>
         <div class="col-md-12">
            <div class="form-group vi-nopart">
               <label><?=lang('vir_appeal_type')?>*</label>
                 <select name="appeal_type" class="form-control vi-nopart">
                    <option value="1" class="vi-nopart"><?=lang('vir_appeal_type_1')?></option>
                    <option value="2" class="vi-nopart"><?=lang('vir_appeal_type_2')?></option>
                    <option value="3" class="vi-nopart"><?=lang('vir_appeal_type_3')?></option>
                    <option value="4" class="vi-nopart"><?=lang('vir_appeal_type_4')?></option>
                 </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group vi-nopart">
               <label><?=lang('vir_message')?>*</label>
                 <textarea name="message" rows="4" class="form-control vi-nopart"  required=""></textarea>
            </div>
        </div>
        <div class="col-md-12">
              <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 file-main">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <div class="custom-file-uploader">
                                                    <input type="file" id="document" name="userfile"
                                                        onchange="$('#documentName').text(this.files.length ? this.files[0].name : '<?=lang('vir_file')?>')"/>
                                                </div>
                                                <span id="documentName"><?=lang('vir_file')?></span>
                                                <label for="document"><i class="fa fa-paperclip" aria-hidden="true"></i></label>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-8 form-send-main">
                                        <div class="row justify-content-between">                                         
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-md-6 captcha-input-2">
                                                        <input type="number" required maxlength="5" class="form-control vi-nopart" autocomplete="off" name="captcha" id="captcha" placeholder="<?= lang('captcha') ?> *">
                                                    </div>
                                                    <div class="col-md-6 captcha-main">                                                  
                                                        <div id="captcha_contacts" class="span3 field" style="float: left;">
                                                            <script>
                                                                jQuery(document).ready(function() {
                                                                    jQuery('#captcha_contacts').ready(function() {
                                                                        jQuery.ajax({
                                                                            type: 'post',
                                                                            url: '<?= site_url('u/action/generate_captcha') ?>',
                                                                            success: function(data) {
                                                                                jQuery('#captcha_contacts').html(data.captcha1.image);
                                                                            },
                                                                            error: function(data) {}
                                                                        });
                                                                        return false;
                                                                    });
                                                                });
                                                            </script>
                                                        </div>
                                                        <div id="captcha_contacts_button" class="span3 field" style="float: left;">
                                                            <a href="#" id="refresh_captcha_contacts" class="ref_button"> <i class="fa fa-refresh ref_button"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col col-auto">
                                                <button type="submit" class="send-form btn btn-primary" disabled><?=lang('send')?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        </div>
    </div>
</form>
<script>
$(document).ready(function() {
    $(".phone").inputmask({
        "mask": "+998 (dd) ddd-dd-dd"
    });  
    $("#number_of_passport").inputmask({
            "mask": "AA-ddddddd"
        });
});


$("#captcha").keyup(function(){
    if($(this).val().length == 5){        
        var token = "<?php echo $this->security->get_csrf_hash(); ?>";
        jQuery.ajax({
            method: 'POST',
            url: '<?= site_url('form/virtual/captcha_check_ajax') ?>',
            data: {
                captcha: jQuery('#captcha').val(),
                <?php echo $this->security->get_csrf_token_name(); ?>: token
            },
            success: function(res) {
                if (res) {                                    
                    $(".send-form").attr("disabled", false);
                } else {
                    $(".send-form").attr("disabled", true);
                    jQuery.ajax({
                        type: 'post',
                        url: '<?= site_url('u/action/generate_captcha') ?>',
                        success: function(data) {
                            jQuery('#captcha_contacts').html(data.captcha1.image);
                        },
                        error: function(data) {}
                    });
                    jQuery('#captcha').val('');
                }
            }
        });
    }else{
        $(".send-form").attr("disabled", true);
    }
});
 jQuery('#refresh_captcha_contacts').click(function() {
        jQuery.ajax({
            type: 'post',
            url: '<?= site_url('u/action/generate_captcha') ?>',
            success: function(data) {
                jQuery('#captcha_contacts').html(data.captcha1.image);
            },
            error: function(data) {}
        });
        return false;
    });
$("#region_id").change(function(){
    let region = $(this).val();
    //console.log(region);
    $("#city_id option").each(function( index ) {
        if(region == $(this).data("region_id")){
            $(this).addClass("show");
        }else{
            $(this).removeClass("show");
        }
    });
    /*$("#category_id option").each(function( index ) {
        if(region == $(this).data("region_id")){
            $(this).addClass("show");
        }else{
            $(this).removeClass("show");
        }
    });*/
});
$("#city_id").change(function(){
    let city = $(this).val();
    $("#category_id option").each(function( index ) {
        if(city == $(this).data("city_id")){
            $(this).addClass("show");
        }else{
            $(this).removeClass("show");
        }
    });
});

</script>