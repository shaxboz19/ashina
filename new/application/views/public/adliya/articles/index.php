<section class="pages-banner d-flex align-items-center" data-parallax="scroll" data-background="<?=get_resource_url()?>images/7777.jpg">
    <div class="container">
        <div class="pages-header__main">
            <div class="title">
                <h1><?=_t($title,LANG)?></h1>
            </div>
            <div class="info">
                <div class="pages-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?=site_url()?>"><?=lang('home')?></a></li>
                            <?php if($category_id_title){?><li class="breadcrumb-item" aria-current="page"><span><?=_t(getPosts($category_id_title,'title'), LANG)?></span></li><?php }?>
                            <li class="breadcrumb-item active" aria-current="page"><span><?=_t($title, LANG)?></span></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="leadership">
    <div class="container">
        <div class="leadership-wrapper">
            <div class="row">
                <div class="col-xl-9">
                <? $i=1; foreach($news as $item): ?>
                <?php $news_date = date_parse($item->created_on); ?>
                    <a href="<?=site_url('articles/'.$item->alias)?>" class="news-item"  data-aos="fade-right" data-aos-delay="<?=$i*100?>" data-aos-duration="350">
                        <?php if($item->url){?>
                        <div class="news-item-imgBx">
                            <img src="<?= base_url('uploads/'.$item->group.'/'.$item->url)?>" alt="">
                        </div>
                        <?php }?>
                        <div class="news-item-content" <?=($item->url) ? '' : 'style="padding-left: 0;"'?> >
                            <div class="news-item-top">
                                <div class="news-item-data"><i class="icon-calendar-2"></i><small><?=$news_date['day']?> <?=getMonthName($item->created_on);?> <?=$news_date['year']?></small>
                                </div>
                                <!--<div class="news-item-content-right"> <span><?//=lang('attention')?></span></div>-->
                            </div>
                            <div class="news-item-info">
                                <div class="news-item-title">
                                    <span><?=removeTags(_t($item->title, LANG))?></span>
                                </div>
                                <div class="news-item-paragraph">
                                    <!--<p><?//=removeTags(_t($item->short_content, LANG))?></p>-->
                                </div>
                            </div>
                        </div>
                    </a>
                    <? $i++; endforeach;?>
                    <div class="clearfix"></div>
                    <div class="pagination-main">
                        <?= $pagination; ?>
                    </div> 
                </div>
                <div class="col-xl-3 col-lg-3 col-md-12">
                    <?php $this->load->view('public/companents/sidebar'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
