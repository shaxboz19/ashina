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
                        <div class="content-body">
                                 <div class="services-list">
                        <ul class="list-group list-group-flush">
                            <? foreach($news as $item):  ?>
                            <li class="list-group-item">
                                <a href="<?=site_url($links.'/'.$item->alias)?>"><?=_t($item->title, LANG)?></a>
                            </li>
                            <? endforeach; ?>                          
                        </ul>    
                    </div>
                     <div class="pagination-main">
                        <?= $pagination; ?>
                    </div>                        
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3">
                    <?php $this->load->view('public/companents/sidebar'); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
/*
<!--<script src="<?= get_resource_url() ?>js/printThis.js"></script>
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
</script>-->
*/
?>
