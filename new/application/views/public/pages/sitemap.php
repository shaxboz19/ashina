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
    <section class="site-links">
        <div class="site-map-main">
            <div class="container">
                <div class="row">
                    <? foreach($menu as $item): 
                    if($item->category_id == 0){
                        $sub = getOptionsData(array('group' => 'menu', 'category_id' => $item->id, 'status' => 'active', 'order' => 'ASC', 'status_lang_'.LANG => 'active'));
                    ?>
                    
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="site-map-item">
                            <ul class="site-ul">
                                <li><a href="#"><?=_t($item->title, LANG)?></a>
                                    <?php if($sub){?>
                                    <ul class="site-submenu">
                                        <? foreach($sub as $item1): 
                                            if($item1->options){
                                                $link1 = site_url($item1->options);
                                            }elseif($item1->option_2){
                                                $link1 = $item1->option_2;
                                                $target1 = 'target="_blank"';
                                            }else {
                                                $link1 = site_url('menu/'.$item1->alias);
                                            } 
                                        ?>
                                        <li><a href="<?=$link1?>"><?=_t($item1->title, LANG)?></a></li>
                                        <? endforeach; ?>
                                    </ul>
                                    <?php }?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <? } endforeach; ?>
                        <? foreach($footer_menu as $item1): 
                                     if($item1->options){
                                                $link1 = site_url($item1->options);
                                            }elseif($item1->option_2){
                                                $link1 = $item1->option_2;
                                                $target1 = 'target="_blank"';
                                            }else {
                                                $link1 = site_url('pages/'.$item1->alias);
                                            } 
                    ?>
                    
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="site-map-item" style="margin-bottom: 20px;">
                            <ul class="site-ul">
                                <li><a href="<?=$link1?>" <?=@$target1?>><?=_t($item1->title, LANG)?></a>
                                  
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?  endforeach; ?>
                </div>
            </div>
        </div>
    </section>