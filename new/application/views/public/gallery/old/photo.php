<section class="content-views">
<div class="photo-main container">
    <div class="floatRight photo-right"> 
        <div class="photo-content">
            <? // controllers -> home
                foreach($gallery_all as $item): ?>
                <div class="photo-item">
               <a href="<?=site_url('photo/'.$item->alias)?>">
               <div class="img-block">
                    
                    <img src="<?=get_resource_url()?>images/gallery.png" alt="" />
               </div>
          
               <div class="title">
              <h3> <?=_t($item->title, LANG)?></h3>
               </div>
               </a>
                </div>
            <? endforeach; ?>
        </div>
       <div class="clearfix"></div>
       <div class="pagination-main">
            <?= $pagination; ?>
       </div>
   </div> 
   <?php $this->load->view('public/zoo/floatLeft'); ?>      
</div>
<div class="clearfix"></div>
</section>


<?php 
/*
<section class="content-views">
<div class="photo-main container">
    <div class="floatRight photo-right"> 
        <div class="photo-content">
            <? // controllers -> home
                foreach($gallery_all as $item): ?>
                <div class="photo-item">
               <a href="<?=site_url('photo/'.$item->alias)?>">
               <div class="img-block">
                    <img src="<?= base_url("thumb/view/w/287/h/191/src/uploads/".$item->group."/" . $item->url) ?>" alt="" />
               </div>
          
               <div class="title">
              <h3> <?=_t($item->title, LANG)?></h3>
               </div>
               </a>
                </div>
            <? endforeach; ?>
        </div>
       <div class="clearfix"></div>
       <div class="pagination-main">
            <?= $pagination; ?>
       </div>
   </div> 
   <?php $this->load->view('public/zoo/floatLeft'); ?>      
</div>
<div class="clearfix"></div>
</section>

*/

?>