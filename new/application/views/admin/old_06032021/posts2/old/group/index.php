<h2><?=_t($category_o['title']);?>
    <a href="<?=site_url('admin/group2/save/'.$category_group.'/'.$category_id)?>" class="btn btn-primary pull-right" type="button">
        <i class="icon-plus-sign icon-white"></i> 
        <span>Добавить</span>
    </a>
       
</h2>

<?php $this->load->view('admin/components/filter_group'); ?>
<div class="clearfix"></div>
<div class="tab-content" id="ajax">
<?php $this->load->view('admin/posts2/group/index_ajax'); ?>
</div>