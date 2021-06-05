<div class="pages__banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url() ?>"><?= lang('home') ?></a></li>
                <?php if ($category_id_title) { ?><li class="breadcrumb-item" aria-current="page"><span><?= _t(getPosts($category_id_title, 'title'), LANG) ?></span></li><?php } ?>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?= site_url('news') ?>"><?= _t($title, LANG) ?></a></li>
            </ol>
        </nav>
    </div>
</div>

<section class="press">
    <div class="container">
        <div class="press__main">
            <div class="press__main__title title">
                <h2><?=_t($title, LANG)?></h2>
            </div>
            <div class="row">
                <div class="col-lg-9 col-md-8">
                    <div class="press__main__wrapper">
                        <div class="row">

                            <?foreach($news as $item): ?>
                            <?php $news_date = date_parse($item->created_on); ?>
                            <div class="col-lg-4 col-md-6">
                                <a href="<?= site_url('news/' . $item->alias) ?>" class="press__main__wrapper__item">
                                    <div class="press__main__wrapper__item__image">
                                        <?php $img = ($item->url) ? base_url('uploads/' . $item->group . '/' . $item->url) : get_resource_url() . 'images/news_default.png'; ?>
                                        <img src="<?= $img ?>" alt="">
                                        <div class="date">
                                            <span><?= $news_date['day'] ?> <?= getMonthName($item->created_on); ?> <?= $news_date['year'] ?></span>
                                        </div>
                                    </div>
                                    <div class="press__main__wrapper__item__text">
                                        <p><?= char_lim(_t($item->title, LANG), 150) ?></p>
                                    </div>
                                    <div class="press__main__wrapper__item__footer">
                                        <ul>
                                            <li><i class="icon-view"></i><span><?= $item->views ?></span></li>
                                            <li><span><?= lang('read_more') ?></span><i class="icon-next"></i></li>
                                        </ul>
                                    </div>

                                </a>
                            </div>
                            <?endforeach;?>


                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <?php $this->load->view('public/companents/sidebar'); ?>
                 

                </div>

            </div>
        </div>
    </div>
</section>

<!-- <section class="news_page">
        <div class="container">
            <div class="title">
                <h2><?= _t($title, LANG) ?></h2>
            </div>
            <div class="row">
                <div class="col-xl-9">
                <? $i=1; foreach($news as $item): ?>
                <?php $news_date = date_parse($item->created_on); ?>
                    <a href="<?= site_url('news/' . $item->alias) ?>" class="news-item" data-aos="fade-right" data-aos-delay="<?= $i * 100 ?>" data-aos-duration="350">
                        <?php $img = ($item->url) ? base_url('uploads/' . $item->group . '/' . $item->url) : get_resource_url() . 'images/news_default.png'; ?>
                        <div class="news-item-imgBx">
                            <img src="<?= $img ?>" alt="">
                        </div>
                      
                        <div class="news-item-content">
                            <div class="news-item-info">
                                <div class="news-item-title">
                                    <h3><?= _t($item->title, LANG) ?></h3>
                                </div>
                                <div class="news-item-paragraph">
                                    <p><?= char_lim(removeTags(_t($item->content, LANG)), 200) ?></p>
                                </div>
                                <div class="news-item-bottom">
                                    <div class="news-item-data"><small><?= $news_date['day'] ?> <?= getMonthName($item->created_on); ?> <?= $news_date['year'] ?>, <?= to_date('H:i', $item->created_on) ?></small>
                                    </div>
                                    <div class="news-item-content-right"><span><?= lang('read_more') ?></span></div>
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
                <div class="col-xl-3">
                   <?php $this->load->view('public/companents/sidebar'); ?>
                   <div class="sidebar">
                            <ul class="list-unstyled">
                                <?php
                                $news_category = getOptionsData(array('group' => 'news_category', 'order' => 'ASC', 'status' => 'active', 'media' => 'inactive'));

                                ?>
                                <li class="<?= ($sel == 'news') ? 'active' : 'noactive' ?>"><a href="<?= site_url('news') ?>"><?= lang('all_news') ?></a></li>
                                <? foreach($news_category as $item): ?>
                                <li class="<?= (@$sel_menu == $item->alias) ? 'active' : 'noactive' ?>"><a href="<?= site_url('news/category/' . $item->alias) ?>"><?= _t($item->title, LANG) ?></a></li>
                                <? endforeach; ?>
                            </ul>
                     
                   </div>
                </div>
            </div>
        </div>

    </section> -->