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
                            <? foreach ($gallery_all as $item): ?>
                                <?php $news_date = date_parse($item->created_on); ?>
                                <div class="col-lg-4 col-sm-6">    
                                    <a href="<?=site_url('gallery/'.$item->alias)?>" class="gallery-item">
                                        <div class="gallery-item__image">
                                            <img src="<?=base_url().'uploads/'.$item->group.'/'.$item->url?>" alt="">
                                        </div> 
                                        <div class="gallery-item__info">
                                            <span class="date"><?=$news_date['day']?> <?=getMonthName($item->created_on);?> <?=$news_date['year']?> </span> 
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