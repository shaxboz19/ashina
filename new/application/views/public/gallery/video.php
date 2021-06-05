<div id="myjs">
    <link href="<?php echo base_url(); ?>assets/public/js/video-js/video-js.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/public/js/video-js/video.js"></script>
    <script>
        videojs.options.flash.swf = "<?php echo base_url(); ?>assets/public/js/video-js/video-js.swf";
    </script>
</div>
<div class="pages-breadcrumb">
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="<?= site_url() ?>"><?= lang('home') ?></a></li>
                    <?php if ($category_id_title) { ?><li class="breadcrumb-item" aria-current="page"><span><?= _t(getPosts($category_id_title, 'title'), LANG) ?></span></li><?php } ?>
                    <li class="breadcrumb-item active" aria-current="page"><span><?= _t($title, LANG) ?></span></li>
        </ol>
    </nav>
</div>
</div>
<section class="pages">
    <div class="container">
          <div class="title inner_title">
                <h2><?= _t($title, LANG) ?></h2>
            </div>
        <div class="pages-content">
            <div class="row">
                <div class="col-lg-9 col-md-8">
                    <div class="content" data-aos="fade-up">
                     
                        <div class="content-body">
                            <div class="gallery">
                            <div class="row">
                            <? foreach ($video_all as $item): ?>
                                <?php $news_date = date_parse($item->created_on); ?>
                                <div class="col-lg-4 col-sm-6">    
                                    <?php if($item->video_type == '3'){ ?>
                                        <a href="<?=$item->video_link?>" data-fancybox  class="gallery-item video_src" data-value="<?=$item->video_link?>" title="<?=_t($item->title, LANG)?>">
                                    <?php } else {?>
                                        <?php 
                                        if($item->video_type == '1'){
                                            $v = 'https://www.youtube.com/embed/';
                                        }
                                        if($item->video_type == '2'){
                                            $v = 'https://mover.uz/video/embed/';
                                        }
                                        if($item->value_1 && LANG == 'ru'){
                                             $link = $v.$item->value_1;
                                        }elseif($item->value_2 && LANG == 'uz'){
                                            $link = $v.$item->value_2;
                                        }else{
                                            $link = $item->video_link;
                                        }    
                                        ?>
                                        
                                        <a href="<?=$link?>" data-fancybox class="gallery-item local_video"  title="<?=_t($item->title, LANG)?>">
                                    <?php }?>
                                    <?php $img = ($item->video_img) ? base_url('uploads/'.$item->group.'/'.$item->video_img) : get_resource_url().'images/news_default.png';?>
                                        <div class="gallery-item__image">
                                            <img src="<?=$img?>" alt="">
                                        </div> 
                                        <div class="gallery-item__info">
                                          <!--  <span class="date"><?=$news_date['day']?> <?=getMonthName($item->created_on);?> <?=$news_date['year']?> </span> -->
                                            <h2><?=char_lim(_t($item->title, LANG), 90)?></h2>
                                        </div>
                                    </a>
                                </div> 
                            <? endforeach; ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="pagination-main">
                            <?= $pagination; ?>
                        </div> 
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-12">
                    <?php $this->load->view('public/companents/sidebar'); ?>
                </div>
            </div>
        </div>
    </div>
</section>



<?php /*

<section class="pages-header d-flex align-items-center">
    <div class="container">
        <div class="pages-header__main">
            <div class="title">
                <h1><?=_t($title, LANG)?></h1>
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
                    <li class="breadcrumb-item" aria-current="page"><?//=_t(getPosts(4,'title'), LANG)?></li>
                   <li class="breadcrumb-item active" aria-current="page"><?=_t($title, LANG)?></li>
                </ol>
            </nav>
            <div class="pages-content">
                <div class="gallery">
                <div class="row">
                <? foreach ($video_all as $item): ?>
                    <?php $news_date = date_parse($item->created_on); ?>
                    <div class="col-lg-4 col-sm-6">
                        <div class="gallery-item">
                                    <?php if($item->video_type == '3'){ ?>
                            <a href="<?=$item->video_link?>" data-fancybox  class="video_src" data-value="<?=$item->video_link?>" title="<?=_t($item->title, LANG)?>">
                        <?php } else {?>
                            <a href="<?=$item->video_link?>" data-fancybox class="local_video"  title="<?=_t($item->title, LANG)?>">
                        <?php }?>
                        <?php
                            $url = ($item->group == 'video') ? $item->video_img : $item->url;
                        ?>
                        <img src="<?=base_url().'thumb/view/w/495/h/291/src/uploads/'.$item->group.'/'.$url?>" alt=""/>
                                <div class="card-full-image">
                                <div class="card-date-holder"><?=$news_date['day']?> <?=getMonthName($item->created_on);?> <?=$news_date['year']?> </div> 
                                <span class="card-label"><?=char_lim(_t($item->title, LANG), 90)?></span>
                            </div>
                            </a>
                        </div>
                    </div> 
                <? endforeach; ?>
                </div>
                </div>
                <div class="clearfix"></div>
                <div class="pagination-main">
                    <?= $pagination; ?>
                </div> 
            </div>
                
        </div>
    </div>
</section>
*/?>
