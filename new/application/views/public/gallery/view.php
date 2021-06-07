<div class="pages-breadcrumb">
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="<?= site_url() ?>"><?= lang('home') ?></a></li>
                    <?php if ($category_id_title) { ?><li class="breadcrumb-item" aria-current="page"><span><?= _t(getPosts($category_id_title, 'title'), LANG) ?></span></li><?php } ?>
                        <?php 
                        $t = _t(getPosts(45, 'title'), LANG);
                        ?>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?=site_url('gallery')?>"><?= $t ?></a></li>
        </ol>
    </nav>
</div>
</div>
<style>
.gallery-item__image::after{display: none;}
</style>
<section class="pages">
    <div class="container">
          <div class="title inner_title">
                <h2><?= $t ?></h2>
            </div>
        <div class="pages-content">
            <div class="row">
                <div class="col-lg-9 col-md-8">
                    <div class="content" data-aos="fade-up">
                        <div class="content-title">
                            <h3><?= _t($title, LANG) ?></h3>
                        </div>
                        <div class="content-body">
                            <div class="gallery">
                            <div class="row">
                            <? foreach ($gallery_all as $item): ?>
                                <?php $news_date = date_parse($item->created_on); ?>
                                <div class="col-lg-4 col-sm-6">    
                                    <a href="<?=base_url().'uploads/'.$item->group.'/'.$item->url?>" class="gallery-item" data-fancybox="gallery">
                                        <div class="gallery-item__image">
                                            <img src="<?=base_url().'uploads/'.$item->group.'/'.$item->url?>" alt="">
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
                <h1><?=_t(getPosts(46,'title'), LANG)?></h1>
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
                    <li class="breadcrumb-item" aria-current="page"><?=_t(getPosts(4,'title'), LANG)?></li>
                   <li class="breadcrumb-item"><a href="<?=site_url('gallery')?>"><?=_t(getPosts(46,'title'), LANG)?></a></li>
                </ol>
            </nav>
    
            <div class="pages-content">
                <div class="pages-title">
                    <h1><?= _t($title, LANG) ?></h1>
                </div>
                <div class="gallery">
                <div class="row">
                <? foreach ($gallery_all as $item): ?>
                    <?php $news_date = date_parse($item->created_on); ?>
                    <div class="col-lg-4 col-sm-6">
                        <div class="gallery-item">
                            <a href="<?= base_url('uploads/' . $item->group . '/' . $item->url) ?>" data-fancybox="gallery">
                                <img src="<?=base_url().'uploads/'.$item->group.'/'.$item->url?>" alt=""> 
                                <div class="card-full-image">
                                   
                                </div>
                            </a>
                        </div>
                    </div> 
                <? endforeach; ?>
                </div>
                </div>
                <div class="clearfix"></div>                       
            </div>
        
        </div>
    </div>
</section>

*/?>