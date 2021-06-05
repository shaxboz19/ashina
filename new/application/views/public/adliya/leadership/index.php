<section class="pages-banner d-flex align-items-center" data-parallax="scroll" data-background="<?= get_resource_url() ?>images/7777.jpg">
    <div class="container">
        <div class="pages-header__main">
            <div class="title">
                <h1><?= _t($title, LANG) ?></h1>
            </div>
            <div class="info">
                <div class="pages-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url() ?>"><?= lang('home') ?></a></li>
                            <?php if ($category_id_title) { ?><li class="breadcrumb-item" aria-current="page"><span><?= _t(getPosts($category_id_title, 'title'), LANG) ?></span></li><?php } ?>
                            <li class="breadcrumb-item active" aria-current="page"><span><?= _t($title, LANG) ?></span></li>
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
                    <div class="leadership-main">
                        <? foreach($leadership as $item):?>
                        <div class="leadership-item">
                            <div class="leadership-item__image">
                                <?php if ($item->url) { ?>
                                    <a href="<?= base_url('uploads/' . $item->group . '/' . $item->url) ?>" class="leadership-imgBx" data-fancybox="">
                                        <img src="<?= base_url('uploads/' . $item->group . '/' . $item->url) ?>" alt="">
                                    </a>
                                <?php } else { ?>
                                    <img src="<?= get_resource_url(); ?>images/avatar.png" alt="">
                                <?php } ?>
                            </div>
                            <div class="leadership-item__info">
                                <div class="leadership-info__job">
                                    <h2><?= _t($item->title, LANG) ?></h2>
                                </div>
                                <div class="leadership-info__name">
                                    <h4><?= _t($item->category_title, LANG) ?></h4>
                                </div>
                                <div class="leadership-info__contacts">
                                    <?php if($item->value_1){?>
                                    <div class="leadership-contacts__item">
                                        <span><?= lang('telephone_u') ?>: </span>
                                        <a href="tel:<?= $item->value_1 ?>"><?= $item->value_1 ?></a>
                                    </div>
                                    <?php }?>
                                    <?php if(_t($item->content_1, LANG)){?>
                                    <div class="leadership-contacts__item">
                                        <span><?= lang('reception') ?></span>
                                        <small>
                                            <?= _t($item->content_1, LANG) ?>
                                        </small>
                                    </div>
                                    <?php }?>
                                </div>
                                <div class="leadership-info__tab">
                                    <nav class="leadership-tab__nav">
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link" id="nav-bio-tab<?= $item->id ?>" data-toggle="tab" href="#nav-bio<?= $item->id ?>" role="tab" aria-controls="nav-bio" aria-selected="true"><?= lang('bio_short') ?>
                                            </a>
                                            <a class="nav-item nav-link" id="nav-main-tab<?= $item->id ?>" data-toggle="tab" href="#nav-main<?= $item->id ?>" role="tab" aria-controls="nav-main" aria-selected="false"><?= lang('duties') ?></a>
                                        </div>
                                    </nav>
                                    <div class="tab-content leadership-tab__content" id="nav-tabContent">
                                        <div class="tab-pane fade" id="nav-bio<?= $item->id ?>" role="tabpanel" aria-labelledby="nav-bio-tab">
                                            <?= _t($item->content, LANG) ?>
                                        </div>
                                        <div class="tab-pane fade" id="nav-main<?= $item->id ?>" role="tabpanel" aria-labelledby="nav-main-tab">
                                            <?= _t($item->short_content, LANG) ?>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsam nihil illum sed beatae ipsum totam.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <? endforeach; ?>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-12">
                    <?php $this->load->view('public/companents/sidebar'); ?>
                </div>
            </div>
        </div>
    </div>
</section>