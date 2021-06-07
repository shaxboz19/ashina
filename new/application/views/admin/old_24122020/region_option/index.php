<h2>Регионы        

    <a href="<?=site_url('admin/posts/save/'.$sel)?>" class="btn btn-primary pull-right" type="button">
        <i class="icon-plus-sign icon-white"></i> Добавить
    </a>
</h2>
<?php $this->load->view('admin/components/filter_posts'); ?>
<div class="clearfix"></div>
<div class="tab-content" id="ajax">
<?php $this->load->view('admin/'.$sel.'/index_ajax'); ?>
</div>