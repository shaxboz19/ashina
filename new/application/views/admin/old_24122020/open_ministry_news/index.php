<h2>  
<p style="font-size:16px;font-weignt:normal"><?=_t($category_o['title']);?> (Новости)</p>
<a href="<?=site_url('admin/pages/save/'.$category_group.'/'.$category_id)?>" class="btn btn-primary pull-right" type="button">
        <i class="icon-plus-sign icon-white"></i> 
        <span>Добавить</span>
    </a>
       
</h2>

<div class="clearfix"></div>
<div class="tab-content" id="ajax">
<?php $this->load->view('admin/'.$category_group.'/index_ajax'); ?>
</div>