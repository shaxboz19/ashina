<?=form_open_multipart('', array('class'=>'form-horizontal'))?>

    <div class="tabbable"> <!-- Only required for left/right tabs -->
        <ul class="nav nav-tabs">
            <? $i=1; foreach ($settings['languages']->value as $language): ?>
                <li <?=($i==1) ? 'class="active"' : ''?> ><a href="#tab<?=$i?>" data-toggle="tab"><?=$language?></a></li>
            <? $i++; endforeach; ?>
            <a href="#" class="btn btn-primary pull-right back"><i class="icon-arrow-left icon-white"></i> Назад</a>
        </ul>

       <div class="tab-content">
            <? $i=1; foreach ($settings['languages']->value as $key => $val): ?>
                <div class="tab-pane  <?=($i==1) ? 'active' : ''?>" id="tab<?=$i?>">

                    <div class="control-group">
                        <label class="control-label" for="focusedInput"><?=lang('title')?></label>
                        <div class="controls">
                            <input name="title[<?=$key?>]" class="input-xlarge focused" type="text" value="<?=set_value('title', _t(@$post->title, $key))?>">
                        </div>
                    </div>

                    <!--<div class="control-group">
                        <label class="control-label" for="focusedInput"><?=lang('content')?></label>
                        <div class="controls">
                            <textarea name="content[<?=$key?>]" class="ckeditor"><?=set_value('content', _t(@$post->content, $key))?></textarea>
                        </div>
                    </div>-->

                </div>
             <? $i++; endforeach; ?>
        </div>
    </div>
    <div class="control-group">
		<label class="control-label" for="focusedInput">Ссылка на сайт<br /> (без http://)</label>
		<div class="controls">
			<input id="option_1" name="option_1" class="span3" type="text" value="<?=set_value('option_1', $post->option_1)?>">
		</div>
	</div>

   <!-- <div class="control-group">
        <label class="control-label" for="focusedInput"><?=lang('category')?></label>
        <div class="controls">
            <select id="category_id" name="category" class="input-xlarge focused" onchange="reload()">
                <option value=""><?=lang('no_category')?></option>
                    <?if (isset($categories)):?>
                        <?cat_sort($categories);?>
                    <?endif?>
            </select>
        </div>
    </div>-->

    <div class="control-group">
         <label class="control-label" for="focusedInput"><?=lang('status')?></label>
         <div class="controls">
            <select name="status" class="input-xlarge focused">
                <option value="active" selected="selected"><?=lang('active')?></option>
                <option value="inactive" <?=($post->status=='inactive')?'selected':''?>> <?=lang('inactive')?> </option>
            </select>
        </div>
    </div>
    
     <!--<?php $this->load->view('admin/components/meta'); ?> -->

    <div class="control-group">
        <label class="control-label" for="focusedInput"></label>
        <div class="controls">
            <a href="#myModal" role="button" class="btn btn-info" data-toggle="modal"><i class="icon-file icon-white"></i> Media</a>
        </div>
    </div>

    <div class="form-actions">
        <button type="reset" class="btn" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary"><?=lang('save')?></button>
    </div>

    <?=msg()?>

</form>

<script src="<?=base_url()?>assets/admin/js/ckeditor/ckeditor.js"></script>
