<?=form_open_multipart('', array('class'=>'form-horizontal my_form'))?>

    <div class="tabbable"> <!-- Only required for left/right tabs -->
        <ul class="nav nav-tabs">
            <? $i=1; foreach ($settings['languages']->value as $language): ?>
                <li <?=($i==1) ? 'class="active"' : ''?> ><a href="#tab<?=$i?>" data-toggle="tab"><?=$language?></a></li>
            <? $i++; endforeach; ?>
        </ul>

        <div class="tab-content">
            <? $i=1; foreach ($settings['languages']->value as $key => $val): ?>
                <div class="tab-pane  <?=($i==1) ? 'active' : ''?>" id="tab<?=$i?>">

                    <div class="control-group">
                        <label class="control-label" for="focusedInput"><?=lang('title')?></label>
                        <div class="controls">
                            <input name="title[<?=$key?>]" class="input-xlarge focused" type="text" value="<?=set_value('title['.$key.']', _t(@$post->title, @$key))?>" readonly="readonly">
                        </div>
                    </div>
                    
                     <div class="control-group" style="display:none;">
                        <label class="control-label" for="focusedInput">Логотип (заголовок)</label>
                        <div class="controls">
                            <textarea name="content[<?=@$key?>]" style="width: 100%; height: 300px;" ><?=set_value('content', _t(@$post->content, @$key))?></textarea>
                        </div>
                    </div>
                    
                    <div class="control-group">
        <label class="control-label" for="focusedInput">Meta Ключевые слова<br /> (title)</label>
        <div class="controls">
            <textarea name="meta_title[<?=@$key?>]" style="width: 255px; height: 180px;"><?=set_value('meta_title['.$key.']', _t(@$post->meta_title, @$key))?></textarea>
        </div>
    </div>
                    

                </div>
             <? $i++; endforeach; ?>
        </div>
    </div>
    
    <div class="control-group">
		<label class="control-label" for="focusedInput">Alias</label>
		<div class="controls">
			<input id="alias" name="alias" class="span3" type="text" value="<?=set_value('alias', $post->alias)?>" readonly="readonly"/>
		</div>
	</div>  
      <div class="control-group">
		<label class="control-label" for="focusedInput">E-mail (системный)</label>
		<div class="controls">
			<input id="link" name="link" class="span3" type="text" value="<?=set_value('link', $post->link)?>" />
		</div>
	</div>
<?php $this->load->view('admin/components/meta'); ?>
    <div class="control-group">
		<label class="control-label" for="focusedInput">Выключить сайт:</label>
		<div class="controls">
			<select name="site_off" class="input-xlarge focused">
                <option value="yes" <?php echo @$post->site_off == 'yes'?'selected="selected"':'';?>>Да</option>
                <option value="no" <?php echo @$post->site_off == 'no'?'selected="selected"':'';?>> Нет </option>
            </select>
		</div>
	</div>
<div class="control-group" style="display: none;">
         <label class="control-label" for="focusedInput">Кнопка Click</label>
         <div class="controls">
            <select name="status_click" class="input-xlarge focused">
                <option value="active" <?php echo @$post->status_click == 'active'?'selected="selected"':'';?>><?=lang('active')?></option>
                <option value="inactive" <?php echo @$post->status_click == 'inactive'?'selected="selected"':'';?>> <?=lang('inactive')?> </option>
            </select>
        </div>
    </div>
    <div class="control-group" style="display:none;">
         <label class="control-label" for="focusedInput"><?=lang('status')?></label>
         <div class="controls">
            <select name="status" class="input-xlarge focused">
                <option value="active" <?php echo @$post->status == 'active'?'selected="selected"':'';?>><?=lang('active')?></option>
                <option value="inactive" <?php echo @$post->status == 'inactive'?'selected="selected"':'';?>> <?=lang('inactive')?> </option>
            </select>
        </div>
    </div>
     <div class="control-group" style="display: none;">
         <label class="control-label" for="focusedInput">Язык сайта <br /> (по умолчанию <?=LangDefault();?>)</label>
         <div class="controls">
            <select name="lang_site" class="input-xlarge focused">
            <?php foreach($lang_site as $item){?>
            
                        <option value="<?=$item->id?>" <?php echo @$item->default == '1'?'selected="selected"':'';?>><?=$item->name?></option>
                        
            <?php }?>
               
            </select>
        </div>
    </div>
   <!-- <div class="control-group">
        <label class="control-label" for="focusedInput"></label>
        <div class="controls">
            <a href="#myModal" role="button" class="btn btn-info" data-toggle="modal"><i class="icon-file icon-white"></i> Media</a>
        </div>
    </div>-->

    <input type="hidden" id="post_id" name="post_id" value="<?=@$post->id?>"/>

    <div class="form-actions">
        <button type="reset" class="btn" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary"><?=lang('save')?></button>
    </div>

    <?=msg()?>

</form>

<script src="<?=base_url()?>assets/admin/js/ckeditor/ckeditor.js"></script>
