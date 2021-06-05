<?php
/*
<!--<div class="modal fade vi-nopart" id="volume" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xm vi-nopart">
        <div class="modal-content vi-nopart">
            <div class="modal-header vi-nopart"><h4 class="modal-title padding-20 vi-nopart" id="smallModalLabel"><i class="fa fa-volume-up vi-nopart" aria-hidden="true"></i> <?= lang('volume') ?></h4>
                <button type="button" class="close vi-nopart" data-dismiss="modal" aria-hidden="true">&times;</button>
                
            </div>
            <div class="modal-body vi-nopart">
                <div class="box-content vi-nopart" style="text-align: center;">
                    <?= lang('volume_text') ?> </div>
            </div>
        </div>
    </div>
</div>

-->


<!---->
*/
?>
<!-- <div class="modal fade vi-nopart" id="volume" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xm vi-nopart">
        <div class="modal-content vi-nopart">
            <div class="modal-header vi-nopart"><h4 style="color: #000;" class="modal-title padding-20 vi-nopart" id="smallModalLabel"><i class="fa fa-volume-up vi-nopart" aria-hidden="true"></i> <?= lang('volume') ?></h4>
                <button type="button" class="close vi-nopart" data-dismiss="modal" aria-hidden="true">&times;</button>
                
            </div>
            <div class="modal-body vi-nopart">
                <div class="box-content vi-nopart" style="text-align: center;color: #000;">
                    <?= lang('volume_text') ?> </div>
            </div>
        </div>
    </div>
</div> -->

<!-- <span id="gs_tooltip_title"><span class="the-tooltip top left dark-midnight-blue"><span class="tooltip_inner">Нажмите на кнопку ниже, чтобы прослушать текст</span></span></span> -->
<!-- <span style="position: absolute; margin-top: -50000px;" id="gs_tooltip"><span class="the-tooltip bottom left dark-midnight-blue"><span class="tooltip_inner powered_by_3 powered_by">Powered by <a href="http://2glux.com/projects/gspeech" target="_top" class="backlink_a">GSpeech</a></span></span></span> -->
<!-- <div id="sound_container" class="sound_div sound_div_basic size_1 speaker_32" title="" style="">
    <div id="sound_text"></div>
</div> -->
<div id="sound_audio"></div>
<script src="<?= get_resource_url() ?>js/popper.min.js"></script>
<script src="<?= get_resource_url() ?>js/bootstrap.min.js"></script>
<script src="<?= get_resource_url() ?>bootstrap/js/bootstrap-select.min.js"></script>
<script src="<?= get_resource_url() ?>js/main.js?v=<?= time() ?>"></script>

<script src="<?= get_resource_url() ?>gs/gs.js?v=0.2"></script>
<script type="text/javascript" src="<?= get_resource_url() ?>gs/color.js?v=0.2"></script>
<script type="text/javascript" src="<?= get_resource_url() ?>gs/jQueryRotate.2.1.js?v=0.2"></script>
<script type="text/javascript" src="<?= get_resource_url() ?>gs/easing.js?v=0.2"></script>
<script type="text/javascript" src="<?= get_resource_url() ?>gs/mediaelement-and-player.min.js?v=0.1"></script>
<script type="text/javascript" src="<?= get_resource_url() ?>gs/gspeech.js?v=<?= time() ?>"></script>
<script type="text/javascript" src="<?= get_resource_url() ?>gs/gspeech_pro.js?v=0.2"></script>
<script>
    $(function() {
        $('.scrollDown').on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $($(this).attr('href')).offset().top
            }, 600, 'linear');
        });

        $('.selectpicker').selectpicker();
    });
</script>

<script type='text/javascript' src="<?= get_resource_url() ?>fancybox-master/dist/jquery.fancybox.min.js"></script>


<script src="<?= get_resource_url() ?>menu/jquery.smartmenus.js?v=0.5"></script>
<script type="text/javascript" src="<?= get_resource_url() ?>menu/jquery.smartmenus.bootstrap-4.js?v=0.5"></script>
<script type="text/javascript" src="<?= get_resource_url() ?>send/jquery.textmistake.js?v=<?= time() ?>"></script>

<script src="<?= get_resource_url() ?>menu/mmenu_new.js"></script>
<script src="<?= get_resource_url() ?>menu/mmenu.polyfills.js"></script>
<script type="text/javascript" src="<?= get_resource_url() ?>js/spec/specialview.js?v=0.7"></script>
<script src="<?= get_resource_url() ?>stacktable/stacktable.min.js"></script>
<script src="<?= get_resource_url() ?>js/custom.js?v=<?= time() ?>"></script>



<script>
    // $( window ).on('load', function() {
    //     $("#dl-menu").css("display", "block");

    // });
    AOS.init({
        disable: function() {
            var maxWidth = 767;
            return window.innerWidth < maxWidth;
        }
    });
</script>
<!-- <script>
    SpecialView.run();
    window.onresize = function(event) {
   //SpecialView.visibleOff();
};
    (function(e){
jQuery(document).textmistake({
'l10n': {
    'title': '<?= lang('title') ?>:',
    'urlHint': '<?= lang('urlHint') ?>:',
    'errTextHint': '<?= lang('errTextHint') ?>:',
    'yourComment': '<?= lang('yourComment') ?>:',
    'userComment': '<?= lang('userComment') ?>:',
    'commentPlaceholder': '<?= lang('commentPlaceholder') ?>',
    'cancel': '<?= lang('cancel') ?>',
    'send': '<?= lang('send') ?>',
    'mailSubject': '<?= lang('mailSubject') ?>',
    'mailTitle': '<?= lang('mailTitle') ?>',
    'mailSended': '<?= lang('mailSended') ?>',
    'mailSendedDesc': '<?= lang('mailSendedDesc') ?>',
    'mailNotSended': '<?= lang('mailNotSended') ?>',
    'mailNotSendedDesc': '<?= lang('mailNotSendedDesc') ?>',
},        
'sendmailUrl': '<?= site_url('u/enter') ?>', 
});
})(jQuery)
</script> -->

<script>
    $('.no-link').click(function(e) {
        e.preventDefault();
    });
    jQuery(document).ready(function() {
        jQuery(".fancybox").fancybox({
            padding: 3
        });
        jQuery(".fancybox-1").fancybox({
            padding: 8
        });
    });
    $(document).ready(function() {
        $('table').stacktable();
    });
</script>
<script>
    document.addEventListener(
        "DOMContentLoaded", () => {
            new Mmenu("#dl-menu", {
                "extensions": [
                    "position-left",
                    "theme-black",
                    "position-front",
                    "pagedim-black"
                ],
                "navbar": {
                    "title": "<?= lang('menu') ?>"

                },
                "navbars": [{
                        "content": [
                            "close",
                        ]
                    }

                ],



            });
        }
    );
</script>

<?php if ($this->session->flashdata('message') or $this->session->flashdata('success') or $this->session->flashdata('error_success') or $this->session->flashdata('erro_subtime')) { ?>
    <div id="messages_s" class="white-popup-block vi-nopart">
        <p class="vi-nopart"><?= $this->session->flashdata('message') ?>
            <?= $this->session->flashdata('success') ?>
            <?= $this->session->flashdata('error_success') ?> <?= $this->session->flashdata('erro_subtime') ?></p>
        <?= validation_errors() ?>
    </div>
    <script>
        $.magnificPopup.open({
            items: {
                src: '#messages_s'
            },
            type: 'inline'
        });
    </script>
<?php } ?>