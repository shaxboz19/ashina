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
                     
                            <li class="breadcrumb-item active" aria-current="page"><span><?=_t($title, LANG)?></span></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="pages">
    <div class="container">
        <div class="pages-content">
            <div class="row">
                <div class="col-lg-9 col-md-8">
                    <div class="content" id="newsPrint" data-aos="fade-up">
                        <div class="content-title">
                            <h2><?=_t($title,LANG)?></h2>
                           
                           
                        </div>
                        <!-- <div class="content-images">
    
                            </div> -->
                        <div class="content-body">
                            <?php 
                            $tag = "<p><br><ul><ol><li><strong><i><a><em><img><table><tbody><td><tr><span><hr><video><iframe>";
                            ?>
                            <?=strip_tags(_t($post->short_content,LANG),$tag)?>
                            <?=strip_tags(_t($post->content,LANG),$tag)?>
                            <?//=_t($post->short_content,LANG)?>
                            <?//=_t($post->content,LANG)?>
                         
                            <?php if(@$docs){?>
                                 <div class="docs-list">
                                    <ul>
                                               <? foreach($docs as $item): 
                                            if($item->url){
                                                $langs = get_mediaLang($item->id, LANG, 1);
                                                    if(@$langs){
                                                        $group = @$langs[0]->category;
                                                        $url = @$langs[0]->url;
                                                        $file_type = @$langs[0]->file_type;
                                                        $file_size = @$langs[0]->file_size;
                                                    }else{
                                                        $group = @$item->group;
                                                        $url = @$item->url;
                                                        $file_type = @$item->file_type;
                                                        $file_size = @$item->file_size;
                                                    }
                                                    $link = base_url().'uploads/'.$group.'/'.$url;
                                                    $download = 'download';
                                                    // $type = 'download';
                                            }else{
                                                $link = ''; //site_url('menu/'.$item->alias);
                                                $download = '';
                                                $type = 'link';
                                            }
                                        ?>
                                        <li><a href="<?=$link?>" <?=$download?> ><i class="fa fa-download<?//=fileTypes($file_type)?>" aria-hidden="true"></i> <?=_t($item->title, LANG)?> <?//=changeType(@$file_size,'KB','MB')?></a></li>
                                        <? endforeach; ?>
                                    </ul>
                                </div>
                                    <div class="clearfix"></div>
                    <div class="pagination-main">
                        <?= $pagination; ?>
                    </div> 
                                <?php }?>
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
