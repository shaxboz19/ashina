<?php if(@$list and $category_id_title){?>
<div class="sidebar">
    <?php if (@$list and $category_id_title) { ?>
        <div class="sidebar-menu">
            <div class="sidebar-title">
                <h3><?= _t(getPosts($category_id_title, 'title'), LANG) ?></h3>
            </div>
            <ul class="list-unstyled main-collapse">
                <? foreach ($list as $item): 
                    $sub = getOptionsData(array('group' => 'menu', 'order' => 'ASC', 'media' => 'inactive', 'category_id' => $item->id, 'status' => 'active'));
                ?>
                <? 
                    $target = '';
                    if($item->options) { 
                        $link = site_url($item->options); 
                        $active =  $item->options;
                    }elseif($item->option_2){
                        $link = $item->option_2;
                        $active =  $item->option_2;
                        $target = 'target="_blank"';
                    } else {
                            if(@$sel_menu == 'services'){
                               $link = site_url('services/'.$item->alias);  $active =  $item->alias; 
                                $active =  $item->alias; 
                            }else{
                                $link = site_url('menu/'.$item->alias);  $active =  $item->alias; 
                        }
                    }     
                
                ?>
                <?php if ($sub) { ?>
                    <li class="<?= ($active == $sel || $active == @$sel_menu || @$sub_menu == $item->id) ? 'active' : 'no-active'; ?>">
                        <a href="#item-<?= $item->id ?>" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?= _t($item->title, LANG) ?></a>

                        <ul class="collapse sub-menu-sidebar list-unstyled <?= (@$sub_menu == $item->id) ? 'show' : '' ?>" id="item-<?= $item->id ?>">
                            <? foreach($sub as $item1): 
                             if($item1->options) { 
                                $link1 = site_url($item1->options); 
                                $active1 =  $item1->options;
                            }elseif($item1->option_2){
                                $link1 = $item1->option_2;
                                $active1 =  $item1->option_2;
                            } else {
                                 if(@$sel_menu == 'services'){
                                 $link1 = site_url('services/'.$item1->alias);  $active1 =  $item1->alias; 
                                 }else{
                                $link1 = site_url('menu/'.$item1->alias);  $active1 =  $item1->alias; 
                                }
                            }
                        ?>
                            <li>
                                <a href="<?= $link1 ?>"><?= _t($item1->title, LANG) ?></a>
                            </li>
                            <? endforeach; ?>
                        </ul>

                    </li>
                <?php } else { ?>
                    <li class="<?= ($active == $sel || $active == @$sel_menu) ? 'active' : 'no-active'; ?>"><a href="<?= $link ?>" <?= $target ?>><?= _t($item->title, LANG) ?></a></li>
                <?php } ?>

                <? endforeach; ?>
            </ul>
        </div>
    <?php } ?>
     

    <?php
  //  $banner1 = getOptionsData(array('group' => 'banner1', 'limit' => '10', 'order' => 'ASC', 'status' => 'active'));
    
    /*
     <!--  <div class="sidebar-rec">
        <div class="owl-carousel owl-theme" id="rec-carousel">
            <? foreach($banner1 as $item): 
                $link = ($item->option_2) ? $item->option_2 : '#';
                $target = ($item->option_2) ? 'target="_blank"' : '';
            ?>
            <div class="item">
                <a href="<?= $link ?>" class="sidebar-rec-item" <?= $target ?>>
                    <img src="<?= base_url('uploads/' . $item->group . '/' . $item->url) ?>" alt="">
                </a>
            </div>
            <? endforeach; ?>
        </div>
    </div>-->
    
    
<script>
    $(document).ready(function() {
        $("#rec-carousel").owlCarousel({
            items: 1,
            slideSpeed: 300,
            paginationSpeed: 400,
            nav: true,
            dots: false,
            loop: <?= (count($banner1) > 1) ? 'true' : 'false' ?>,
            // margin: 20,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            autoplay: <?= (count($banner1) > 1) ? 'true' : 'false' ?>,
            autoplayTimeout: 7500,
            smartSpeed: 1500,
            navText: ['<i class="icon-left fa-2x"></i>', '<i class="icon-right fa-2x"></i>'],
        });
    });
</script>
    */
    ?>
 

<?php 
/*

 <!--   <?php if ($sel != 'polls') { ?>
        <?php
        $polls2 = get_polls2(array('limit' => '3', 'status' => 'active'));
        ?>
        <?php if ($polls2) { ?>
            <div class="sidebar-quiz">
                <h4><?= lang('polls_title') ?></h4>
                <? 
        
        foreach($polls2 as $item): ?>
                <div class="first-quiz">
                    <p><?= _t($item->title, LANG) ?></p>
                    <div class="quiz-buttons" id="quiz-<?= $item->id ?>">
                        <a href="#" class="polls_btn" data-type="yes" data-id="<?= $item->id ?>"><?= lang('polls_yes') ?></a>
                        <a href="#" class="polls_btn" data-type="no" data-id="<?= $item->id ?>"><?= lang('polls_no') ?></a>
                    </div>

                </div>
                <? endforeach; ?>

                <a href="<?= site_url('polls') ?>" class="view_results"><?= lang('polls_res') ?></a>

            </div>

            <script>
                jQuery('.polls_btn').click(function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    var type_id = $(this).data('type');
                    //console.log('id:'+ id);
                    //console.log('type:'+ type_id);
                    jQuery.ajax({
                        type: 'post',
                        url: '<?= site_url('form/polls') ?>',
                        data: {
                            type: type_id,
                            id: id
                        },
                        success: function(data) {
                            jQuery('#quiz-' + id).html(data);
                        },
                        error: function(data) {}
                    });
                });
            </script>
        <?php } ?>
    <?php } ?>-->
*/
?>
    <?php
    /*
        <?php if($sel != 'news'){?>
<?php 
 $news_sidebar = getOptionsData(array('group'=>'news','status_lang_'.LANG => 'active','limit'=>'3','status'=>'active'));
?> 
<?php if($news_sidebar){?>
  <div class="sidebar-news" style="display: none;">
            <div class="sidebar-title">
                <h2><?=lang('last_news')?></h2>
            </div> 
            <? foreach($news_sidebar as $item): ?>    
             <?php $news_date = date_parse($item->created_on); ?>           
            <a href="<?=site_url('news/'.$item->alias)?>" class="sidebar-news__item">
                
                <div class="sidebar-news__image">
                    <?php if($item->url){?>
                        <img src="<?=base_url('uploads/'.$item->group.'/'.$item->url)?>" alt="">
                    <?php } else { ?>
                        <img src="<?= get_resource_url()?>images/news_default.jpg" alt="">
                    <?php } ?>
                </div>
                <div class="sidebar-news__info">
                    <h2><?=char_lim(_t($item->title, LANG),100)?></h2>
                    <div class="sidebar-news__date">
                        <span><?=$news_date['day']?> <?=getMonthName($item->created_on);?> <?=$news_date['year']?></span>
                        <span><i class="fa fa-eye"></i> <?=$item->views?></span>
                    </div>
                </div>
            </a>  
            <? endforeach; ?>          
                                                       
        </div>
        <?php }?>
        <?php }?>
        */
    /*
         <!--<div class="sidebar-banner">

                            <?php 
 $banner_1 = getOptionsData(array('group'=>'banner_1','limit'=>'1','order' => 'ASC','status'=>'active'));
?> 
<?php if($banner_1){?>

  <div  class="banner-slider">
        <div class="bottom-banners">
   
<div class="news-list">
    <? foreach($banner_1 as $item): ?>
    <?php $langs = get_mediaLang($item->id, LANG, 1)?>
    <?php if($langs){?>
    <? foreach($langs as $item1): ?>
            <div class="img-wrapper">
            <a href='<?=($item->option_1) ? $item->option_1 : '#'?>' target="_blank">            
            <img class="preview_picture" src="<?=base_url().'uploads/'.$item1->category.'/'.$item1->url?>"  />
            </a>        </div>
            <? endforeach; ?>
            <?php } else {?>
             <div class="img-wrapper">
            <a href='<?=($item->option_1) ? $item->option_1 : '#'?>' target="_blank"> 
            <?php if(mediaNotMain($item->id, 'url', '1')){?>           
            <img class="preview_picture" src="<?=base_url().'uploads/'.$item->group.'/'.mediaNotMain($item->id, 'url', '1')?>" />
            <?php } else {?>
            <img class="preview_picture" src="<?=base_url().'uploads/'.$item->group.'/'.mediaNotMain($item->id, 'url', '0')?>"  />
            <?php }?>
            </a>        </div>
            <?php }?>
            <? endforeach; ?>            
    </div>
    
    </div></div>
<?php }?>
                        </div>-->
        */
    ?>

</div>
<?php }?>
 <div class="sidebar__downloads">
                        <div class="sidebar__downloads__item" data-aos="fade-down" data-aos-delay="300" data-aos-duration="300">
                            <div class="sidebar__downloads__item__header">
                                <div class="sidebar__downloads__item__header__image">
                                    <img src="<?=get_resource_url()?>images/download1.png" alt>
                                </div>
                                <div class="sidebar__downloads__item__header__href">
                                    <a href="#!">
                                        <small><i class="icon-downloading"></i></small>
                                        <span>скачать файл (1.8 mb)</span>
                                    </a>
                                </div>
                            </div>
                            <div class="sidebar__downloads__item__footer">
                                <p>Очередное информационное
                                    издание «Бюджет для граждан»,
                                    посвященное проекту бюджета на
                                    2021 годa</p>

                            </div>
                        </div>
                        <div class="sidebar__downloads__item" data-aos="fade-down" data-aos-delay="400" data-aos-duration="300">
                            <div class="sidebar__downloads__item__header">
                                <div class="sidebar__downloads__item__header__image">
                                    <img src="<?=get_resource_url()?>images/download2.png" alt>
                                </div>
                                <div class="sidebar__downloads__item__header__href">
                                    <a href="#!">
                                        <small><i class="icon-downloading"></i></small>
                                        <span>скачать файл (1.4 mb)</span>
                                    </a>
                                </div>
                            </div>
                            <div class="sidebar__downloads__item__footer">
                                <p>Обзор состояния и динамики
                                    государственного долга
                                    Республики Узбекистан</p>

                            </div>
                        </div>
                        <div class="sidebar__downloads__item" data-aos="fade-down" data-aos-delay="500" data-aos-duration="300">
                            <div class="sidebar__downloads__item__header">
                                <div class="sidebar__downloads__item__header__image">
                                    <img src="<?=get_resource_url()?>images/download3.png" alt>
                                </div>
                                <div class="sidebar__downloads__item__header__href">
                                    <a href="#!">
                                        <small><i class="icon-downloading"></i></small>
                                        <span>скачать файл (1.8 mb)</span>
                                    </a>
                                </div>
                            </div>
                            <div class="sidebar__downloads__item__footer">
                                <p>Доходы Государственного бюджета
                                    Республики Узбекистан за 9
                                    месяцев 2020 года составили 94,5
                                    трлн. сум, или
                                    на 15,3 трлн. сум...</p>

                            </div>
                        </div>

                    </div>
