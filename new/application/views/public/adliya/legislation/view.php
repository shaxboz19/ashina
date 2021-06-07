<section class="pages-banner d-flex align-items-center" data-parallax="scroll" data-background="<?=get_resource_url()?>images/7777.jpg">
<?php 
$t = _t(getPosts($title_id, 'title'),LANG);
?>
    <div class="container">
        <div class="pages-header__main">
            <div class="title">
                <h1><?=$t?></h1>
            </div>
            <div class="info">
                <div class="pages-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="<?=site_url()?>"><?=lang('home')?></a></li>
                <?php if($category_id_title){?><li class="breadcrumb-item" aria-current="page"><a><?=_t(getPosts($category_id_title,'title'), LANG)?></a></li><?php }?>
                <li class="breadcrumb-item"><a href="<?=site_url($links)?>"><?=$t?></a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
        <?php 
$news_date = date_parse(@$post->created_on);
?>
    <section class="news_view">
        <div class="container">
            <div class="news-wrapper">
                <div class="row">
                    <div class="col-xl-9 col-lg-9 col-md-12">
                        <div class="news-main">
                            <div class="news-view-top">
                                <div class="news-view-top-left">
                                <div class="news-view-left">
                                   <i class="icon-view"></i>
                                   <?=$post->views?>
                                </div>
                                <div class="news-view-data">
                                <i class="icon-calendar-2"></i><small><?=$news_date['day']?> <?=getMonthName($post->created_on);?> <?=$news_date['year']?></small>
                            </div>
                        </div>
                            <div class="news-view-title">
                                <p><?=_t($post->title, LANG)?></p>
                                </div>
                            </div>
                            <div class="news-view-imgBx">
                            <div class="owl-carousel owl-theme" id="news-carousel">
                                <? foreach($all_images as $item): ?>
                                <div class="item">
                                    <div class="portfolio-inner-item">
                                        <a href="<?=base_url('uploads/'.$item->category.'/'.$item->url)?>" data-fancybox="gallery">
                                        <img src="<?=base_url('uploads/'.$item->category.'/'.$item->url)?>" alt=""></a>
                                    </div>
                                </div>
                                <? endforeach; ?>
                                </div>
                            </div>
                            <div class="news-view-content">
                            <?=_t($post->content, LANG)?>
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

    <script>
    $(document).ready(function(){
        $("#news-carousel").owlCarousel({
        items: 1,
        slideSpeed: 300,
        paginationSpeed: 400,
        loop: <?=(count($all_images) > 1) ? 'true' : 'false'?>,
        nav: true,
        dots: false,
        // margin: 20,
        // animateIn: 'fadeIn',
        // animateOut: 'fadeOut',
        autoplay: false,
        autoplayTimeout: 7500,
        smartSpeed: 1500,
        navText: ['<i class="icon-left fa-2x"></i>', '<i class="icon-right fa-2x"></i>'],
      });
    });
</script>
<script>
jQuery(document).ready(function(){
//print page
 jQuery('#btnPrint').click(function(e){
    e.preventDefault();
    $('#newsPrint').printThis({
        debug: false,            
importCSS: false,            
importStyle: false,       
printContainer: true,       
loadCSS: "<?=get_resource_url()?>css/print.css?v=<?=time()?>",  
pageTitle: "",              
removeInline: false,        
printDelay: 333,            
header: null,             
footer: null,              
base: false ,               
formValues: true,         
canvas: false,              
doctypeString: "",       
removeScripts: false        
    });
});
});
</script>