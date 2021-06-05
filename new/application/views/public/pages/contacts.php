<div class="pages-breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url() ?>"><?= lang('home') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><span><?= _t($title, LANG) ?></span></li>
            </ol>
        </nav>
    </div>
</div>
 <section class="contact">
        <div class="container">
        <div class="title inner_title">
                <h2><?= _t($title, LANG) ?></h2>
            </div>
            <div class="contact__main">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="contact__main__content">
                            <div class="contact__main__content__title">
                                <i class="icon-telephone"></i>
                                <h4><?=lang('phones')?></h4>
                            </div>
                            <div class="contact__main__content__menu">
                                <ul>
                                    <li><span><?=lang('phones_1')?>:</span>
                                        <a href="tel:998712030050">
                                            (998 71) 203-00-50
                                        </a>
                                    </li>
                                    <li><span><?=lang('phones_2')?>:
                                        </span>
                                        <a href="tel:998712391570">(998 71) 239-15-70 </a>
                                        (<?=lang('phones_2_1')?>)
                                    </li>
                                    <li><span><?=lang('phones_3')?>:</span>
                                       	<a href="tel:998712391252">
                							(998 71) 239-12-52,
                						</a>
                						<a href="tel:998712391569">
                							(998 71) 239-15-69
                						</a>
                                    </li>
                                    <li><span><?=lang('phones_4')?>:</span>
                                       <a href="tel:998712394593">
                							(998 71) 239-45-93,
                					   </a>
              						   <a href="tel:998712394439">
                							(998 71) 239-44-39
              						   </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="contact__main__content">
                            <div class="contact__main__content__title">
                                <i class="icon-location"></i>
                                <h4><?=lang('address')?></h4>
                            </div>
                            <div class="contact__main__content__menu">
                                <ul>
                                    <li>
                                        <span><?=lang('address')?>:</span>
                                        <a href="#!"><?=lang('c_address')?></a>
                                    </li>
                                    <li>
                                        <span><?=lang('orientir')?>:</span>
                                        <a href="#!"><?=lang('orientir_1')?></a>
                                    </li>
                                    <li>
                                        <span><?=lang('transport')?>:</span>
                                        <a href="#!"><?=lang('transport_1')?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact__main__content">
                             <iframe allowfullscreen="" frameborder="0" loading="lazy" height="450" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11986.580946771239!2d69.2717131!3d41.3165807!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x101f6b6d7b32fb0f!2z0JrQsNC30L3QsNGH0LXQudGB0YLQstC-INCc0LjQvdC40YHRgtC10YDRgdGC0LLQsCDQpNC40L3QsNC90YHQvtCyINCg0LXRgdC_0YPQsdC70LjQutC4INCj0LfQsdC10LrQuNGB0YLQsNC9!5e0!3m2!1sru!2s!4v1528197146046" style="border:0" width="1100"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact__main__content">

                            <div class="contact__main__content__title">
                                <i class="icon-salary"></i>
                                <h4><?=lang('c_email')?></h4>
                            </div>
                            <div class="contact__main__content__menu">
                                <ul>
                                    <li><a href="mailto:info@mf.uz"><span>info@mf.uz
                                        </span></a>
                                        <p>
                                            (<?=lang('c_email_1')?>)
                                        </p>
                                    </li>
                                    <li><a href="mailto:mf@exat.uz">
                                    <span> mf@exat.uz</span></a>
                                        <a href="#!">
                                            (<?=lang('c_email_2')?>)
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact__main__content">
                            <div class="contact__main__content__title">
                                <i class="icon-calendar"></i>
                                <h4><?=lang('grafik_raboti')?></h4>
                            </div>
                            <div class="contact__main__content__menu">
                                <ul>
                                    <li><span><?=lang('vremya_raboti')?>:</span>
                                        <a href="#!">
                                            <?=lang('vremya_raboti_1')?>
                                        </a>
                                    </li>
                                    <li><span><?=lang('vremya_raboti_2')?>:</span>
                                        <a href="#!">
                                            <?=lang('vremya_raboti_3')?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php 
/*
 <div class="contacts-form">
                                    <?php echo form_open('action') ?>
                                    <div class="form-group">
                                        <input class="form-control vi-nopart nameform" id="name" autocomplete="off" name="name" placeholder="<?= lang('f_name') ?>: *" type="text" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control vi-nopart" id="phone" name="phone" placeholder="<?= lang('p_number') ?>: *" type="text" autocomplete="off" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control vi-nopart" id="email" name="pochta" placeholder="<?= lang('email') ?>: *" type="email" autocomplete="off" required="required">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control vi-nopart" rows="7" id="message" name="message" placeholder="<?= lang('description') ?>: *" required="required"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="pull-left vi-nopart captcha-input-2">
                                            <input style="height: 35px;" type="text" maxlength="100" class="form-control vi-nopart" name="captcha" id="captcha" autocomplete="off" placeholder="<?= lang('captcha') ?>: *">
                                        </div>
                                        <div class="captcha-main">
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
                                                <a href="#" id="refresh_captcha_contacts"><i class="fa fa-refresh ref_button" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" id="contactMSG" name="contactMSG" class="contact-button"><?= lang('send') ?></button>
                                    </form>
                                </div>
                                <script>
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
    });*/
    /*$(document).ready(function(){
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
    }
    });
</script>
*/
?>
