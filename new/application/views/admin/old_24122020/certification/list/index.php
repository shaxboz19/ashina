<h2>Список БАД к пище, прошедших экспертизу
    <a href="<?=site_url('admin/certification/save')?>" class="btn btn-primary pull-right" type="button">
        <i class="icon-plus-sign icon-white"></i> Добавить
    </a>
</h2>
<!--<div class="pull-left" style="margin-top: 14px;">
    <?php echo form_open_multipart('admin/certification/import_new/'); ?>
    <input type="file" name="userfile" style="float: left;line-height: 10px;margin-top: 6px;" value="">
    <?php echo form_submit('submit', 'Импорт', 'class="btn btn-primary"') ?>
    <?php echo form_close(); ?>
</div>-->
<div class="clearfix"></div>
<div class="tab-content" >
<?php $this->load->view('admin/certification/list/index_ajax'); ?>
</div>