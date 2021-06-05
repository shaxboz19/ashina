
<div class="pages-breadcrumb">
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="<?= site_url() ?>"><?= lang('home') ?></a></li>
                    <?php if ($category_id_title) { ?><li class="breadcrumb-item" aria-current="page"><span><?= _t(getPosts($category_id_title, 'title'), LANG) ?></span></li><?php } ?>
                    <li class="breadcrumb-item active" aria-current="page"><span><?= _t($title, LANG) ?></span></li>
        </ol>
    </nav>
</div>
</div>

<section class="pages">
    <div class="container">
          <div class="title inner_title">
                <h2><?= _t($title, LANG) ?></h2>
            </div>
        <div class="pages-content">
            <div class="row">
                <div class="col-lg-9 col-md-8">
                    <div class="content" id="newsPrint" data-aos="fade-up">
                        <?php 
                        /*
                          <div class="content-title">
                            <h2><?//= _t($title, LANG) ?></h2>
                            <!--<a href="#" id="btnPrint" class="printer"><i class="icon-printer"></i><span><?= lang('printer') ?></span></a>-->
                        </div>
                        */
                        ?>
                        <div class="content-body">
                            <?php
                            $tag = "<p><br><ul><ol><li><strong><i><a><em><img><table><tbody><td><tr><span><hr><video><iframe>";
                            ?>
                            <?= strip_tags(_t($post->short_content, LANG), $tag) ?>
                            <?= strip_tags(_t($post->content, LANG), $tag) ?>
                            <?//=_t($post->short_content,LANG)?>
                            <?//=_t($post->content,LANG)?>
                            <?php if (@$docs) { ?>
                                <div class="docs-list">
                                    <ul>
                                        <? foreach($docs as $item): 
                                            if($item->url){
                                                $langs = get_mediaLang($item->id, LANG, 1);
                                                    if(@$langs){
                                                        $group = @$langs[0]->category;
                                                        $url = @$langs[0]->url;
                                                        $file_type = @$langs[0]->file_type;
                                                    }else{
                                                        $group = @$item->group;
                                                        $url = @$item->url;
                                                        $file_type = @$item->file_type;
                                                    }
                                                    $link = base_url().'uploads/'.$group.'/'.$url;
                                                    $download = 'download';
                                            }else{
                                                $link = site_url('menu/'.$item->alias);
                                                $download = '';
                                            }
                                        ?>
                                        <li><a href="<?= $link ?>" <?= $download ?>><?= _t($item->title, LANG) ?></a></li>
                                        <? endforeach; ?>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                                <div class="pagination-main">
                                    <?= $pagination; ?>
                                </div>
                            <?php } ?>
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
<script>
$(document).ready(function() {
    $(".content-body a:has(img)").fancybox();
}); 

</script>
<?php /* 

<section class="pages">
    <div class="container">        
        <div class="pages-content">
            <div class="page-title">
                <h1><?=_t($title,LANG)?></h1>
            </div>    
            <div class="content">
                <?php 
                $tag = "<p><br><ul><ol><li><strong><i><a><em><img><table><tbody><td><tr><span><hr>";
                ?>
                <?=strip_tags(_t($post->short_content,LANG),$tag)?>
                <?=strip_tags(_t($post->content,LANG),$tag)?>
                <?php if($post->id == 38){?>
                <div class="content-url">
                    <a href="<?=site_url('newsletter')?>"><?=lang('e_newsletter')?></a>
                </div>
                <?php }?>
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
                                        }else{
                                            $group = @$item->group;
                                            $url = @$item->url;
                                            $file_type = @$item->file_type;
                                        }
                                        $link = base_url().'uploads/'.$group.'/'.$url;
                                        $download = 'download';
                                }else{
                                     $link = site_url('menu/'.$item->alias);
                                    $download = '';
                                }
                            ?>
                            <li><a href="<?=$link?>" <?=$download?> ><?=_t($item->title, LANG)?></a></li>
                            <? endforeach; ?>
                        </ul>
                        </div>
                    <?php }?>
            </div>
        </div>
    </div>
</section>
<!--<script src="<?= get_resource_url() ?>js/printThis.js"></script>-->
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
*/ ?>