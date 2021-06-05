  <div class="row">
        <div class="col-md-4">
            <div class="form-group vi-nopart">
                <label class="vi-nopart"><?=lang('vir_number_request')?>*</label>
                <input type="text" id="check_id" class="form-control vi-nopart" name="check_id" autocomplete="off" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group vi-nopart">
                <label class="vi-nopart"><?=lang('vir_password')?>*</label>
                <input type="text" id="check_cid" class="form-control vi-nopart" name="check_cid" autocomplete="off"  />
            </div>
        </div>
        <div class="col-md-4" style="display: flex;align-items:flex-end">
            <div class="vi-nopart">
               <button class="form-check btn" id="checkStatus"><?=lang('vir_btn_check')?></button>
            </div>
        </div>
  </div>
  <div id="form-result"><div class="res"></div></div>
  <script>
  $(document).ready(function() {
  $("#checkStatus").click(function() {
    //alert('test');
    if (jQuery('#check_id').val() == "") {
         jQuery('#check_id').css("border", "2px solid red");
    } else if (!validateNumSize(jQuery('#check_id').val())) {
        jQuery('#check_id').css("border", "2px solid red");
        has_errors = true;
    } else if (jQuery('#check_cid').val() == "") {
        jQuery('#check_cid').css("border", "2px solid red");
    } else if (!validateNumSize(jQuery('#check_cid').val())) {
        jQuery('#check_cid').css("border", "2px solid red");
        has_errors = true;
    } else {
       jQuery('#check_id').css("border", "1px solid #ced4da");
       jQuery('#check_cid').css("border", "1px solid #ced4da");
        var token = "<?php echo $this->security->get_csrf_hash(); ?>";
        jQuery.ajax({
            method: 'POST',
            url: '<?= site_url('form/virtual/status') ?>',
            data: {
                id: jQuery('#check_id').val(),
                cid: jQuery('#check_cid').val(),
                <?php echo $this->security->get_csrf_token_name(); ?>: token
            },
            success: function(res) {
                var resClass = '.res';
                if (res != 'false') {
                    console.log(res.data);
                    jQuery('.res').html(res.data);                                

                        jQuery('#form-result').slideDown('slow');
                        $('#form-result').show();
                    
                } else {
                     $('.res').html(); 
                    $('#form-result').hide();
                                   
                }
            }
        });
    }
});
function validateNumSize(num) {
    var number = /^[0-9]+$/;
    return num && number.test(num);
};
});
  </script>