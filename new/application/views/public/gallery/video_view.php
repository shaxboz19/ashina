<section class="content-block">
    <div class="container">
        <div class="content-main-block">
            <div class="content-main">
                <div class="media-main">
                <div class="media-view__title">
                        <h2><?=_t($post->title, LANG)?></h2>
                </div>
                 <?php if($post->video_type == '1'){?>
                            <iframe src="<?=$post->video_link?>?autohide=1" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>
                        <?php }?>
                        <?php if($post->video_type == '2'){?>
                            <iframe src="<?=$post->video_link?>" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>
                        <?php }?> 
                        <?php if($post->video_type == '3'){?>
                            <div id="myjs">
                            <link href="<?php echo base_url(); ?>assets/public/js/video-js/video-js.css?ver=1" rel="stylesheet" type="text/css">
                            <script type="text/javascript" src="<?php echo base_url(); ?>assets/public/js/video-js/video.js"></script>
                            <script>
                            videojs.options.flash.swf = "<?php echo base_url(); ?>assets/public/js/video-js/video-js.swf";
                            </script>
                            </div>
                         <div class="video-news">
                                <video  id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="602" height="340" poster="<?= base_url("uploads/".$post->group."/" . $post->video_img) ?>" data-setup='{"autoplay": false}'>
                                    <source class="video_source" src="<?= base_url("uploads/".$post->group."/".$post->url) ?>" type="video/mp4" /><track kind="captions" src="demo.captions.vtt" srclang="en" label="English"></track>
                                    <track kind="subtitles" src="demo.captions.vtt" srclang="en" label="English"></track>
                                </video>
                            </div>  
                        <?php }?> 
            
                </div>     
            </div>
            <style>
                .sidebar-news{display: none;}
            </style>
            <?php $this->load->view('public/companents/sidebar'); ?>
        </div>
        <div class="clearfix"></div>
    </div>
</section>
