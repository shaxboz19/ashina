 <?php 
 $img = ($post->url) ? base_url('uploads/'.$post->group.'/'.$post->url) : get_resource_url().'/images/page_default.jpg';
 ?>
 <section class="second_banner" data-background="<?=$img?>">
        <div class="container-fluid">
            <div class="site-map-title">
                <h1><?=_t($title,LANG)?></h1>
            </div>
        </div>
        </section>

    <section class="banner-links bannerLinksPage">
        <div class="container">
            <ul class="banner-ul">
                <li class="breadcrumb-item"><a href="<?=site_url()?>"><?=lang('home')?></a></li>
                  
                    <li class="breadcrumb-item active" aria-current="page"><a><?=_t($title, LANG)?></a></li>
            </ul>
        </div>
    </section>
 <section class="about_view">
        <div class="container">
            <div class="title">
                <h3><?=_t($title,LANG)?></h3>
            </div>
            <div class="portfolio-main">
                <div class="row">

                    <div class="col-xl-9 col-md-8">
                        <div class="portfolio-inner-content">
                            <?php 
                                $tag = "<p><br><ul><ol><li><strong><i><a><em><img><table><tbody><td><tr><span><hr>";
                            ?>
                            <?=strip_tags(_t($post->short_content,LANG),$tag)?>
                            <?=strip_tags(_t($post->content,LANG),$tag)?>
                        
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-4">
                         <div class="sidebar">
     <?php if(@$list){?>
        <div class="sidebar-menu">
            <div class="sidebar-title">
             <h2><?//=_t(getPosts($category_id_title, 'title'), LANG)?></h2>
            </div>           
             <ul class="list-unstyled main-collapse">           
                <? foreach ($list as $item): 
                   
                ?>
                <? 
                
                    if($item->options) { 
                        $link = site_url($item->options); 
                        $active =  $item->options;
                    }elseif($item->option_2){
                        $link = $item->option_2;
                        $active =  $item->option_2;
                    } else {
                        $link = site_url('pages/'.$item->alias);  $active =  $item->alias; 
                    }     
                
                ?>
               
                    <li class="<?= ($active == $sel || $active == @$sel_menu) ? 'active' : 'no-active'; ?>"><a href="<?=$link?>" ><?=_t($item->title, LANG)?></a></li>
               
                
                <? endforeach; ?>
            </ul>
    </div>
<?php }?>

</div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

