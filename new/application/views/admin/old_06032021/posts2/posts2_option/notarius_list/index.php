<h2>Нотариальные конторы (<?=_t(getRegionInfo($category_id, 'title'))?>)
    <a href="<?=site_url('admin/posts2_option/save/'.$category_group.'/'.$category_id)?>" class="btn btn-primary pull-right" type="button">
        <i class="icon-plus-sign icon-white"></i> Добавить
    </a>
</h2>
<a href="<?//=site_url("admin/posts2_option/index/$category_group/$category_id/region")?><?=site_url('admin/posts2/regions/notarius_list')?>">Назад</a>
<?php 
/*
<!--<div class="pull-left" style="margin-top: 14px;">
    <?php echo form_open_multipart('admin/posts2/import_new2'); ?>
    <input type="file" name="userfile" style="float: left;line-height: 10px;margin-top: 6px;" value="">
    <?php echo form_submit('submit', 'Импорт', 'class="btn btn-primary"') ?>
    <?php echo form_close(); ?>
</div>-->
*/
?>
<?//php $this->load->view('admin/components/filter_posts'); ?>
<div class="clearfix"></div>
<div class="tab-content" id="ajax">
<?php $this->load->view('admin/posts2/posts2_option/'.$sel.'/index_ajax'); ?>
</div>