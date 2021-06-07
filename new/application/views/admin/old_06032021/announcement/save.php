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
                    <div class="control-group" style="display: none">
                        <label class="control-label" for="focusedInput">Категория новости</label>
                        <div class="controls">
                            <input  name="category_title[<?=$key?>]" class="input-xlarge focused" type="text" value="<?=set_value('category_title['.$key.']', _t(@$post->category_title, $key))?>">
                        </div>
                    </div>
                  <!--<div class="control-group">
                        <label class="control-label" for="focusedInput"><?=lang('short_content')?></label>
                        <div class="controls">
                            <textarea name="short_content[<?=$key?>]" class="moxiecut"><?=set_value('short_content['.$key.']', _t(@$post->short_content, $key))?></textarea>
                        </div>
                    </div>-->

                    <div class="control-group">
                        <label class="control-label" for="focusedInput"><?=lang('content')?></label>
                        <div class="controls">
                            <textarea name="content[<?=$key?>]" class="moxiecut"><?=set_value('content['.$key.']', _t(@$post->content, $key))?></textarea>
                        </div>
                    </div>

                </div>
             <? $i++; endforeach; ?>
        </div>
    </div>
    <div class="control-group" style="display: none;">
		<label class="control-label" for="focusedInput">На главную страницу</label>
		<div class="controls">
			<select name="option" class="input-xlarge focused">
                <option value="yes" <?php echo @$post->option == 'yes'?'selected="selected"':'';?>>Да</option>
                <option value="no" <?php echo @$post->option == 'no'?'selected="selected"':'';?>> Нет </option>
            </select>
		</div>
    </div>
    <?php 
    /*
      <!-- <div class="control-group">
       <label class="control-label"  for="select-state">Теги:</label>
       <div class="controls">
          <select id="select-state7" name="tags[]"  class="demo-default" style="width:50%" multiple=''>
             <option value="">Выберите </option>
             <? 
                $tags  = array(); 
                $tags = $post->tags;            
                $tags_option = explode(',',  $tags);
                $tags_main = getOptionsData(array('group' => 'tags', 'status' => 'active'));
                $i = 0; foreach($tags_main as $item): ?>          
             <option value="<?=$item->id?>" ><?=_t($item->title)?></option>
             <?$i++; endforeach;?>
          </select>
       </div>
    </div>-->
   
         <!-- <div class="control-group">
		<label class="control-label" for="focusedInput">На главную страницу</label>
		<div class="controls">
			<select name="option" class="input-xlarge focused">
                <option value="yes" <?php echo @$post->option == 'yes'?'selected="selected"':'';?>>Да</option>
                <option value="no" <?php echo @$post->option == 'no'?'selected="selected"':'';?>> Нет </option>
            </select>
		</div>
    </div>-->
    */
    ?>
    
    	    <div class="control-group">
		<label class="control-label" for="focusedInput">Дата</label>
		<div class="controls">
			<input id="date" name="created_on" class="input-xlarge focused" type="text" value="<?=set_value('created_on', to_date("d.m.Y H:i", $post->created_on))?>">
		</div>
	</div>
    <script type="text/javascript">
	$(function(){
		$("#date").datetimepicker({ autoclose: true, todayHighlight: true,dateFormat: 'dd.mm.yy' });
    	$("#date1").datepicker({ autoclose: true, todayHighlight: true,dateFormat: 'dd/mm/yy' });
      $("#date2").datepicker({ autoclose: true, todayHighlight: true,dateFormat: 'dd/mm/yy' });
	});
</script>
      <div class="control-group" style="display: none">
		<label class="control-label" for="focusedInput">Отправить подписчикам?</label>
		<div class="controls">
			<select name="newsletter" class="input-xlarge focused">
                <option value="yes">Да</option>
                <option value="no" selected="selected"> Нет </option>
            </select>
		</div>
    

	</div>
    
    <div class="control-group">
		<label class="control-label" for="focusedInput">Alias</label>
		<div class="controls">
		
                <input id="alias" name="alias" class="validate[required,ajax[check_alias]] span3" type="text" value="<?=set_value('alias', $post->alias)?>">
     
		</div>
	</div>   
    
   <?php $this->load->view('admin/components/meta'); ?>

    <div class="control-group">
         <label class="control-label" for="focusedInput"><?=lang('status')?></label>
         <div class="controls">
            <select name="status" class="input-xlarge focused">
                <option value="active" <?php echo @$post->status == 'active'?'selected="selected"':'';?>><?=lang('active')?></option>
                <option value="inactive" <?php echo @$post->status == 'inactive'?'selected="selected"':'';?>> <?=lang('inactive')?> </option>
            </select>
        </div>
    </div>
    
    <!--<div class="control-group">
         <label class="control-label" for="focusedInput">Показать на гл.странице <br />(слайдер)</label>
         <div class="controls">
            <select name="spec" class="input-xlarge focused">
                <option value="active" <?php echo @$post->spec == 'active'?'selected="selected"':'';?>><?=lang('active')?></option>
                <option value="inactive" <?php echo @$post->spec == 'inactive'?'selected="selected"':'';?>> <?=lang('inactive')?> </option>
            </select>
        </div>
    </div>-->
    
    <div class="control-group">
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

<script src="<?=base_url()?>assets/admin/js/ckeditor/ckeditor.js"></script>
<script>
	$('.my_form').validationEngine();
</script>
