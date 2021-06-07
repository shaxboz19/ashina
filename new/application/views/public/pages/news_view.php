<script src="<?= get_resource_url() ?>js/printThis.js"></script>
<div class="pages__banner">
    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url() ?>"><?= lang('home') ?></a></li>
                <?php if ($category_id_title) { ?><li class="breadcrumb-item" aria-current="page"><span><?= _t(getPosts($category_id_title, 'title'), LANG) ?></span></li><?php } ?>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?= site_url($links) ?>"><?= _t(getPosts($title_id, 'title'), LANG) ?></a></li>
            </ol>
        </nav>
    </div>
</div>

<?php
$news_date = date_parse(@$post->created_on);
?>
<section class="news_view">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8">
                <div class="news-view__main" data-aos="fade-right" data-aos-delay="0" data-aos-duration="300" id="newsPrint">
                    <div class="news-view__top news-view__date">
                    
                            <?php if ($post->category_id > 0) {
                                $news_category = getPostsAll($post->category_id);
                            ?>
                                <span><a href="<?= site_url('news/category/' . $news_category->alias) ?>"><?= _t($news_category->title, LANG) ?></a></span>
                            <?php } ?>
                            <span><i class="fa fa-clock-o" aria-hidden="true"></i> <?= $news_date['day'] ?> <?= getMonthName($post->created_on); ?> <?= $news_date['year'] ?>,<?= to_date('H:i', $post->created_on) ?></span>
                            <span><i class="fa fa-eye"></i> <?= $post->views ?></span>
                       
                        
                    </div>
                    <div class="news-view__title">
                        <h3><?= _t($post->title, LANG) ?></h3>
                    </div>
                    <?php if ($all_images) { ?>
                        <div class="news-view-imgBx">
                            <div class="owl-carousel owl-theme" id="news-carousel">
                                <? foreach($all_images as $item): ?>
                                <div class="item">
                                    <div class="portfolio-inner-item">
                                        <a href="<?= base_url('uploads/' . $item->category . '/' . $item->url) ?>" data-fancybox="gallery">
                                            <img src="<?= base_url('uploads/' . $item->category . '/' . $item->url) ?>" alt=""></a>
                                    </div>
                                </div>
                                <? endforeach; ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="news-view-content">
                        <?= _t($post->content, LANG) ?>
                    </div>
                    <div class="news_footer">
                        <div class="share">
                            <p><?=lang('share')?></p>
                            <script src="https://yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-curtain data-shape="round" data-services="vkontakte,facebook,odnoklassniki,telegram,twitter"></div>
                        </div>
                        <a href="#" id="btnPrint" class="news-view__print">
                            <i class="fa fa-print"></i>

                            <span><?= lang('printer') ?></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <?php $this->load->view('public/companents/sidebar'); ?>
            </div>
        </div>
    </div>
</section>
<?php if ($all_images) { ?>
    <script>
        $(document).ready(function() {
            $("#news-carousel").owlCarousel({
                items: 1,
                slideSpeed: 300,
                paginationSpeed: 400,
                loop: <?= (count($all_images) > 1) ? 'true' : 'false' ?>,
                nav: false,
                dots: true,
                // margin: 20,
                // animateIn: 'fadeIn',
                // animateOut: 'fadeOut',
                autoplay: true,
                autoplayTimeout: 7500,
                smartSpeed: 800,
                navText: ['<img src="' + resource + 'images/left.svg">', '<img src="' + resource + 'images/right.svg">'],
            });
        });
    </script>
<?php } ?>
<script>
    jQuery(document).ready(function() {
        //print page
        jQuery('#btnPrint').click(function(e) {
            e.preventDefault();
            $('#newsPrint').printThis({
                debug: false,
                importCSS: false,
                importStyle: false,
                printContainer: true,
                loadCSS: "<?= get_resource_url() ?>css/print.css?v=<?= time() ?>",
                pageTitle: "",
                removeInline: false,
                printDelay: 333,
                header: null,
                footer: null,
                base: false,
                formValues: true,
                canvas: false,
                doctypeString: "",
                removeScripts: false
            });
        });
    });
</script>