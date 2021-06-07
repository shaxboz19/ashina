<section class="pages-banner d-flex align-items-center" data-parallax="scroll" data-background="<?=get_resource_url()?>images/7777.jpg">
    <div class="container">
        <div class="pages-header__main">
            <div class="title">
                <h1><?=$title?></h1>
            </div>
            <div class="info">
                <div class="pages-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?=site_url()?>"><?=lang('home')?></a></li>
                           
                            <li class="breadcrumb-item active" aria-current="page"><span><?=$title?></span></li>
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
                          <div class="sidebar-polls">
        <? 
        
        foreach($polls as $item): ?>
        <div class="first-quiz">
            <p><?=_t($item->title, LANG)?></p>
            <div class="quiz-buttons" id="quiz-<?=$item->id?>">
                <a href="#" class="polls_btn" data-type="yes" data-id="<?=$item->id?>"><?=lang('polls_yes')?></a>
                <a href="#" class="polls_btn" data-type="no" data-id="<?=$item->id?>"><?=lang('polls_no')?></a>
            </div>
            
        </div>
        <? endforeach; ?>
      
      
    </div>
 <div class="clearfix"></div>
                    <div class="pagination-main">
                        <?= $pagination; ?>
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
                jQuery('#quiz-'+id).html(data);
            },
            error: function(data) {}
        });
    });
</script>
                    </div>
                </div>


                <div class="col-xl-3 col-lg-3 col-md-12">
                    <?php $this->load->view('public/companents/sidebar'); ?>
                </div>

            </div>
        </div>
    </div>
</section>

