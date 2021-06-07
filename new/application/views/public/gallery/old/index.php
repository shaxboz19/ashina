<section class="content-views">
<div class="gallery container">
    <div class="photo">
        <div class="photo-title">
            <h3><?=_t(getPosts(29, 'title'), LANG)?></h3>
            <a href="<?=site_url('photo')?>"><?=_t(getPosts(38, 'title'), LANG)?></a>
        </div>
         <div class="clearfix"></div>        
        <div class="photo-content">
        <? 
        // controllers -> home
        foreach($gallery as $item): ?>
            <div class="photo-item">
            <a href="<?=site_url('photo/'.$item->alias)?>"><img src="<?= base_url("thumb/view/w/180/h/165/src/uploads/".$item->group."/" . $item->url) ?>" alt="" /></a>
            </div>
            <? endforeach; ?>
        </div>
    </div>
    <div class="video" id="main-video">
        <div class="video-title">
            <h3><?=_t(getPosts(30, 'title'), LANG)?></h3>
            <a href="<?=site_url('video')?>"><?=_t(getPosts(38, 'title'), LANG)?></a>
        </div>
         <div class="clearfix"></div>        
        <div class="video-content">
        <? foreach($video as $item): ?>
            <div class="video-item">
            <?php if($item->video_type == '1'){?>
            <iframe src="<?=$item->video_link?>?autohide=1&showinfo=0" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>
            <?php }?>
            <?php if($item->video_type == '2'){?>
            <iframe src="<?=$item->video_link?>" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>
            <?php }?> 
            <?php if($item->video_type == '3'){?>
            <div id="myjs">
            <link href="<?php echo base_url(); ?>assets/public/js/video-js/video-js.css?ver=1" rel="stylesheet" type="text/css">
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/public/js/video-js/video.js"></script>
            <script>
            videojs.options.flash.swf = "<?php echo base_url(); ?>assets/public/js/video-js/video-js.swf";
            </script>
            </div>
            <video  id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="602" height="340" poster="" data-setup='{"autoplay": false}'>
            <source class="video_source" src="<?=$item->video_link?>" type="video/mp4" /><track kind="captions" src="demo.captions.vtt" srclang="en" label="English"></track>
            <track kind="subtitles" src="demo.captions.vtt" srclang="en" label="English"></track>
            </video>  
            <?php }?>
            </div>
            <? endforeach; ?>

        </div>
    </div>
       <div class="clearfix"></div>
</div>
</section>