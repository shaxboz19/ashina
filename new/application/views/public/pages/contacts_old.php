<section class="pages-header d-flex align-items-center">
    <div class="container">
        <div class="pages-header__main">
            <div class="title">
                <h1><?= _t($title, LANG) ?></h1>
            </div>
        </div>
    </div>
</section>
<section class="pages-main">
    <div class="container">
        <div class="pages">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?=site_url()?>"><?=lang('home')?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?=_t($title, LANG)?></li>
            </ol>
          </nav>
          <div class="pages-content">
            
            <div class="row">
                <div class="col-lg-6 col-md-4">
                    <div class="contact-info">
                        <div class="row">
                            <div class="col-12">
                                <div class="pages-title">
                                    <h1><?= _t($title, LANG) ?></h1>
                                </div>
                                <div class="contact-item">
                                    <h3><?=lang('phone')?></h3>
                                    <?php 
                                    //$phone = getPostsAll(35);
                                    ?>
                                    <p><a href="tel:+<?=phone_tel($phone)?>"><?=$phone?></a></p>
                                </div>
                                
                                <div class="contact-item">
                                    <h3><?=lang('email')?></h3>
                                    <?php 
                           $e = explode(';', $emails);
                           ?>
                           <?php foreach($e as $item){?>
                            <p><a href="mailto:<?=$item?>"><?=$item?></a></p>
                            <?php }?>
                                </div>
                                <div class="contact-item">
                                    <h3><?=lang('address')?></h3>
                                    <p><?=$address?></p>
                                </div>
                                <div class="contact-item">
                                    <h3><?=lang('mode')?></h3>
                                    <p><?=lang('mode_full')?></p>
                                </div>                             
                            </div>
                        </div>
                    </div>                    
                </div>  
                <div class="col-lg-6 col-md-8">
                    <div class="pages-title">
                        <h1><?=lang('form_callback');?></h1>
                    </div>
                <?php echo form_open('action')?> 
                    <div class="form-group">
                    <input class="form-control nameform" id="name" name="name" placeholder="<?=lang('name')?>: *" type="text" value="" required="required">
                    </div>
                    <div class="form-group">          
                    <input class="form-control" id="email" name="pochta" placeholder="Email: *" type="email" required="required">
                    </div>                
                    <div class="form-group">       
                        <textarea class="form-control" rows="5" id="message" name="message" placeholder="<?=lang('message')?>: *" required="required"></textarea>                  
                    </div>
                    <div class="form-group">
                            <div class="pull-left captcha-input-2">									
                            <input type="text" maxlength="100" class="form-control" name="captcha" id="captcha" placeholder="<?=lang('captcha')?> *">
                            </div>
                            <div class="captcha-main">
                                <div id="captcha_contacts" class="span3 field" style="float: left;">
                                    <script>
                                        jQuery(document).ready(function(){
                                        jQuery('#captcha_contacts').ready(function(){       
                                            jQuery.ajax({
                                                type: 'post',
                                                url: '<?=site_url('u/action/generate_captcha')?>',
                                                success: function(data){
                                                    jQuery('#captcha_contacts').html(data.captcha1.image);
                                                },
                                                error: function(data){
                                                }
                                            });
                                            return false;
                                            });        
                                        });
                                    </script> 
                                </div>
                                <div id="captcha_contacts_button" class="span3 field" style="float: left;">
                                    <a href="#" id="refresh_captcha_contacts"><i class="fa fa-refresh ref_button" aria-hidden="true"></i></a>
                                </div>
                                <input type="submit" id="contactMSG" name="contactMSG" value="<?=lang('send')?>" class="btn button">
                            </div>
                    </div>            
                    </form>
                </div>   
       </div>
       <div class="contact-map">
            <?=_t($short_content, 'ru')?>
         </div>
          </div>
        </div>
    </div>
</section>
<script>
jQuery('#refresh_captcha_contacts').click(function(){       
jQuery.ajax({
    type: 'post',
    url: '<?=site_url('u/action/generate_captcha')?>',
        success: function(data){
            jQuery('#captcha_contacts').html(data.captcha1.image);
        },
    error: function(data){
    }
});
return false;
});
</script>