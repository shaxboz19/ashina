<?=form_open_multipart('', array('class'=>'form-horizontal my_form'))?>

    <div class="tabbable"> <!-- Only required for left/right tabs -->
        <ul class="nav nav-tabs">
            <? $i=1; foreach ($settings['languages']->value as $language): ?>
                <li <?=($i==1) ? 'class="active"' : ''?> ><a href="#tab<?=$i?>" data-toggle="tab"><?=$language?></a></li>
            <? $i++; endforeach; ?>
        </ul>
		<style>
		#title{width: 50%}
		</style>
	<!--	<div class="control-group">
		<label class="control-label" for="focusedInput">На главную страницу</label>
		<div class="controls">
		
			<select name="category_status" class="input-xlarge focused">
				<option value="3" >Нет категории</option>
                <option value="1" <?php echo @$post->category_status == '1'?'selected="selected"':'';?>>Объявление</option>
                <option value="2" <?php echo @$post->category_status == '2'?'selected="selected"':'';?>> Актуальная новость </option>
            </select>
		</div>
    </div>-->
        <div class="tab-content">
            <? $i=1; foreach ($settings['languages']->value as $key => $val): ?>
                <div class="tab-pane  <?=($i==1) ? 'active' : ''?>" id="tab<?=$i?>">

                    <div class="control-group">
                        <label class="control-label" for="focusedInput"><?=lang('title')?></label>
                        <div class="controls">
                            <input id="title" name="title[<?=$key?>]" class="input-xlarge focused titles" type="text" value="<?=set_value('title['.$key.']', _t(@$post->title, $key))?>">
                        </div>
                    </div>
					  <div class="control-group">
					<label class="control-label" for="focusedInput">Внешняя ссылка (для языков)</label>
					<div class="controls">
						<input name="category_title[<?= $key ?>]" class="input-xlarge focused" type="text" value="<?= set_value('category_title[' . $key . ']', _t(@$post->category_title, $key)) ?>">
					</div>
				</div>
                   
                  <!-- <div class="control-group">
                        <label class="control-label" for="focusedInput"><?=lang('short_content')?></label>
                        <div class="controls">
                            <textarea name="short_content[<?=$key?>]" class="moxiecut"><?=set_value('short_content['.$key.']', _t(@$post->short_content, $key))?></textarea>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="focusedInput"><?=lang('content')?></label>
                        <div class="controls">
                            <textarea name="content[<?=$key?>]" class="moxiecut"><?=set_value('content['.$key.']', _t(@$post->content, $key))?></textarea>
                        </div>
                    </div>-->

                </div>
             <? $i++; endforeach; ?>
        </div>
    </div>
      <div class="control-group">
		<label class="control-label" for="focusedInput">Внешняя ссылка</label>
		<div class="controls">
		
                <input id="value_1" name="value_1" class="span3" type="text" value="<?=set_value('value_1', $post->value_1)?>">
     
		</div>
	</div>  
    
    <div class="control-group">
		<label class="control-label" for="focusedInput">Alias</label>
		<div class="controls">
		
                <input id="alias" name="alias" class="validate[required,ajax[check_alias]] span3" type="text" value="<?=set_value('alias', $post->alias)?>">
     
		</div>
	</div>   
    
   <?//php $this->load->view('admin/components/meta'); ?>

    <div class="control-group">
         <label class="control-label" for="focusedInput"><?=lang('status')?></label>
         <div class="controls">
            <select name="status" class="input-xlarge focused">
                <option value="active" <?php echo @$post->status == 'active'?'selected="selected"':'';?>><?=lang('active')?></option>
                <option value="inactive" <?php echo @$post->status == 'inactive'?'selected="selected"':'';?>> <?=lang('inactive')?> </option>
            </select>
        </div>
    </div>
    
   
    <div class="control-group" style="display:none;">
        <label class="control-label" for="focusedInput"></label>
        <div class="controls">
            <a href="#myModal" role="button" class="btn btn-info" data-toggle="modal"><i class="icon-file icon-white"></i> Фото</a>
            <!--<a href="<?=site_url('admin/group/index/docs/'.$post->id)?>" class="btn btn-info"> Документы</a>-->
        </div>
    </div>

    <input type="hidden" id="post_id" name="post_id" value="<?=@$post->id?>"/>
    <input type="hidden" id="post_id" name="category_id" value="<?=@$post->category_id?>"/>

    <div class="form-actions">
        <button type="reset" class="btn" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary"><?=lang('save')?></button>
    </div>

    <?=msg()?>

</form>

<script>
	$('.my_form').validationEngine();
</script>
