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

        <div class="tab-content">
            <? $i=1; foreach ($settings['languages']->value as $key => $val): ?>
                <div class="tab-pane  <?=($i==1) ? 'active' : ''?>" id="tab<?=$i?>">

                    <div class="control-group">
                        <label class="control-label" for="focusedInput"><?//=lang('title')?> Короткое название</label>
                        <div class="controls">
                            <input id="title" name="title[<?=$key?>]" class="input-xlarge focused titles" type="text" value="<?=set_value('title['.$key.']', _t(@$post->title, $key))?>">
                        </div>
                    </div>                   
<div class="control-group">
                        <label class="control-label" for="focusedInput">Полное название</label>
                        <div class="controls">
                            <input  name="category_title[<?=$key?>]" class="input-xlarge focused" type="text" value="<?=set_value('category_title['.$key.']', _t(@$post->category_title, $key))?>">
                        </div>
                    </div>
                </div>
             <? $i++; endforeach; ?>
        </div>
    </div>
	<?php 
	/*
	 <!--  <div class="control-group">
		<label class="control-label" for="focusedInput"><?=lang('category')?></label>
		<div class="controls">
			<select id="category_id" name="category_id" class="input-xlarge focused" onchange="reload()">
				<option value=""><?=lang('no_category')?></option>
					
						<?//cat_sort($categories,$post->category_id);?>
                        <?foreach($idea as $category):?>
                           
                                <option value="<?=$category->id?>" <?if($category->id == $post->category_id) echo('selected="selected"');?>><?=_t($category->title)?></option>
                           
                        <?endforeach?>

			</select>
		</div>
	</div>-->
	*/
	?>
    <div class="control-group" style="display:none;">
		<label class="control-label" for="focusedInput">Alias</label>
		<div class="controls">
			<input id="alias" name="alias" class="span3" type="text" value="<?=set_value('alias', @$post->id)?>" >
		</div>
	</div> 
     <div class="control-group">
		<label class="control-label" for="focusedInput">Буквенный код (Альфа-2)</label>
		<div class="controls">
			<input id="option_1" name="option_1" class="span3" type="text" value="<?=set_value('option_1', $post->option_1)?>">
		</div>
	</div>
 <div class="control-group">
		<label class="control-label" for="focusedInput">Буквенный код (Альфа-3)</label>
		<div class="controls">
			<input id="option_2" name="option_2" class="span3" type="text" value="<?=set_value('option_2', $post->option_2)?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="focusedInput"> Цифр. код</label>
		<div class="controls">
			<input id="option_3" name="option_3" class="span3" type="text" value="<?=set_value('option_3', $post->option_3)?>">
		</div>
	</div>
   
    

    <div class="control-group">
         <label class="control-label" for="focusedInput"><?=lang('status')?></label>
         <div class="controls">
            <select name="status" class="input-xlarge focused">
                <option value="active" <?php echo @$post->status == 'active'?'selected="selected"':'';?>><?=lang('active')?></option>
                <option value="inactive" <?php echo @$post->status == 'inactive'?'selected="selected"':'';?>> <?=lang('inactive')?> </option>
            </select>
        </div>
    </div>
    
    
    
    <div class="control-group">
        <label class="control-label" for="focusedInput"></label>
        <div class="controls">
          <!--  <a href="#myModalPosts" role="button" class="btn btn-info" data-toggle="modal"><i class="icon-file icon-white"></i> Медиа</a>-->
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
	//$('.my_form').validationEngine();
</script>


</script>