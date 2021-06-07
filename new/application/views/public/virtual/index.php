<link rel="stylesheet" type="text/css" href="<?= get_resource_url() ?>virtual/form.css?v=<?=time()?>" />
<script src="<?= get_resource_url() ?>virtual/input.mask.js?v=0.1"></script>

<div class="pages-breadcrumb">
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="<?= site_url() ?>"><?= lang('home') ?></a></li>
          
                    <li class="breadcrumb-item active" aria-current="page"><span><?= $title ?></span></li>
        </ol>
    </nav>
</div>
</div>
<section class="pages">
    <div class="container">
          <div class="title inner_title">
                <h2><?= $title ?></h2>
            </div>
        <div class="pages-content">
            <div class="row">
                <div class="col-lg-9 col-md-8">
                    <div class="content" id="newsPrint" data-aos="fade-up">                    
                        <div class="content-body">
            <div class="virtual">
<ul class="nav nav-tabs" style="padding-left: 0;">
	<li class="nav-item">
		<a class="nav-link active" href="#form" data-toggle="tab"> <?=$title?> </a>
	</li>
	 
	<li class="nav-item">
		<a class="nav-link" href="#check" data-toggle="tab"> <?=lang('vir_check')?></a>
	</li>
 
</ul>
<div class="tab-content" id="tabContent">
  <div class="tab-pane fade show active" id="form" role="tabpanel" aria-labelledby="form-tab">
  	<? $this->load->view('public/virtual/form'); ?>
  </div>
  <div class="tab-pane fade" id="check" role="tabpanel" aria-labelledby="check-tab">
  <? $this->load->view('public/virtual/form_check'); ?>
  </div>
</div>
</div>
                          
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-12">
                    <div class="news-sidebar">
                    <h3><?= lang('last_news') ?></h3>
                     <div class="news-sidebar-md">
                    <?$i = 1; foreach($lastnews as $item): ?>
                    <?php $news_date = date_parse($item->created_on); ?>
                    <a href="<?= site_url('news/' . $item->alias) ?>" class="news-sidebar__item" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>" data-aos-duration="300">
                        <?php if ($item->url) { ?>
                            <div class="news-sidebar__imgBx">
                                <img src="<?= base_url('uploads/' . $item->group . '/' . $item->url) ?>" alt="">
                            </div>
                        <?php } ?>
                        <div class="news-sidebar__title">
                            <h4><?= _t($item->title, LANG) ?></h4>
                        </div>
                        <div class="news-sidebar__date"><span><?= $news_date['day'] ?> <?= getMonthName($item->created_on); ?> <?= $news_date['year'] ?>, <?= to_date('H:i', $item->created_on) ?></span></div>
                    </a>
                    <?$i++; endforeach; ?>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>

