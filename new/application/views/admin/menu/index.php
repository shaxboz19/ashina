<h2>Меню
    <a href="<?=site_url('admin/posts/save/'.$sel)?>" class="btn btn-primary pull-right" type="button">
        <i class="icon-plus-sign icon-white"></i>
        <span>Добавить</span>
    </a>
</h2>

<?php
/*
<!--<div class="control-group">
    <div class="controls">
        <select id="category" name="category_id" class="input-xlarge focused">
            <option value=""><?=lang('all_categories')?></option>

                <?=cat_sort($categories,$category_id);?>
        </select>
    </div>
</div>-->
*/
?>
<?php $this->load->view('admin/components/filter_posts'); ?>
<div class="clearfix"></div>
<div class="tab-content" id="ajax">
<?php $this->load->view('admin/'.$sel.'/index_ajax'); ?>
</div>