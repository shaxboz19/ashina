<h2>Семейное положение
    <a href="<?=site_url('admin/resume/save/'.$sel)?>" class="btn btn-primary pull-right" type="button">
        <i class="icon-plus-sign icon-white"></i> Добавить
    </a>
</h2>
<?//php $this->load->view('admin/components/filter_posts'); ?>
<div class="clearfix"></div>
<div class="tab-content" id="ajax">
<?php $this->load->view('admin/resume/'.$sel.'/index_ajax'); ?>
</div>