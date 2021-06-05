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
                            <input id="title" name="title[<?=$key?>]" class="validate[required] input-xlarge focused" type="text" value="<?=set_value('title['.$key.']', _t(@$post->title, $key))?>">
                        </div>
                    </div>
                    <!--	<div class="control-group">
						<label class="control-label" for="focusedInput"><?=lang('content')?></label>
						<div class="controls">
							<textarea name="content[<?=$key?>]" class="moxiecut"><?=set_value('content', _t(@$post->content, $key))?></textarea>
						</div>
					</div>-->

                </div>            
             <? $i++; endforeach; ?>
        </div>
    </div>

    <!-- <input name="category"  id="category" type="hidden" value="<?=$post->category_id ?>"> -->
    
     <!--<div class="control-group">
        <label class="control-label" for="focusedInput">Meta Ключевые слова (keywords)</label>
        <div class="controls">
            <textarea name="keywords" style="width: 255px; height: 180px;"><?=set_value('keywords', $post->keywords)?></textarea>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="focusedInput">Meta Описание (description)</label>
        <div class="controls">
            <textarea name="description" style="width: 255px; height: 180px;"><?=set_value('description', $post->description)?></textarea>
        </div>
    </div> -->

    <div class="control-group">
         <label class="control-label" for="focusedInput"><?=lang('status')?></label>
         <div class="controls">
            <select name="status" class="input-xlarge focused">
                <option value="active"  <?php echo @$post->status == 'active'?'selected="selected"':'';?>><?=lang('active')?></option>
                <option value="inactive" <?php echo @$post->status == 'inactive'?'selected="selected"':'';?>> <?=lang('inactive')?> </option>
            </select>
        </div>
    </div>
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
    <?php if($post->video_img): ?>
    <div class="control-group">
    <label class="control-label" for="focusedInput">Текущая обложка</label>
    <div class="controls">
    	<img src="<?=base_url("thumb/view/w/151/h/158/src/uploads/video/".$post->video_img)?>"  />
    </div>
    </div>  
	<?php endif; ?>

    <div class="control-group">
    <label class="control-label" for="focusedInput">Обложка</label>
    <div class="controls">
    	<input type="file" name="userfile">
    </div>
    </div> 
    <div class="control-group">
		<label class="control-label" for="focusedInput">Alias</label>
		<div class="controls">
			<input id="alias" name="alias" class="validate[required,ajax[check_alias]] span3" type="text" value="<?=set_value('alias', @$post->alias)?>" />
		</div>
	</div>   
 

     <div class="control-group">
        <label class="control-label" for="focusedInput">Видео</label>
        <div class="controls">
            <select id="video_type" name="video_type" class="input-xlarge focused" onchange="showDiv(this)">
               <option value="0" <?=($post->video_type == '0') ? 'selected="selected"':''?> >Выберите тип</option>
                <option value="1" <?=($post->video_type == '1') ? 'selected="selected"':''?> >Youtube</option>
                <option value="2" <?=($post->video_type == '2') ? 'selected="selected"':''?> >Mover</option>
                <option value="3" <?=($post->video_type == '3') ? 'selected="selected"':''?> >Загрузка на сервер</option>
            </select>
          
              <p><input id="video" name="video" class="span3" placeholder="Вставить код например: 0AtTZPJ5HOL" type="text" value="<?=set_value('video', $post->video_code)?>"></p>
            <!--  <p>Русский <br /><input id="value_1" name="value_1" class="span3" placeholder="Вставить код например: 0AtTZPJ5HOL" type="text" value="<?=set_value('value_1', $post->value_1)?>">
            </p>
             <p>Ўзбекча <br /><input id="value_2" name="value_2" class="span3" placeholder="Вставить код например: 0AtTZPJ5HOL" type="text" value="<?=set_value('value_2', $post->value_2)?>">
            </p>-->

        </div>
    </div>
    
    <!--<div class="control-group">
        <label class="control-label" for="focusedInput">Видео</label>
        <div class="controls">
            <select id="video_type" name="video_type" class="input-xlarge focused">
                <option value="1">Youtube</option>
                <option value="2" <?=(strstr($post->video_link,'mover'))?'selected':''?>>Mover</option>
                <option value="3" <?=($post->category_id == '999') ? 'selected':''?>>Файл</option>
            </select>
            <input id="video" name="video" class="span3" type="text" value="<?=set_value('video', $post->video_code)?>">
        </div>
    </div>-->
    
    <input type="hidden" id="post_id" name="post_id" value="<?=@$post->id?>"/>    

        
    <div class="control-group" id="server"  <?=($post->video_type == '3') ? 'style="display: block;"':'style="display: none;"'?>>
        <label class="control-label" for="focusedInput"></label>
        <div class="controls">
            <a href="#myModal" role="button" class="btn btn-info" data-toggle="modal"><i class="icon-file icon-white"></i> Выберите файл</a>
        </div>
    </div>

    <div class="form-actions">
     <button type="reset" class="btn" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary"><?=lang('save')?></button>        
    </div>
    
    <?=msg()?>
    
    <?php if(!empty($error)): ?>
    	<div class="alert alert-error"><?php echo $error; ?></div>
	<?php endif; ?>

</form>

<script src="<?=base_url()?>assets/admin/js/ckeditor/ckeditor.js"></script>

<script>
    $('.my_form').validationEngine();
    $('#category').change(function(){
        var id = ($('#category option:selected').val());
        $('#category_id').show();
        $('#category_id option').each(function()
        {
            $(this).hide();
            if($(this).attr('parent')== id)
            {
                $(this).show();
            };
        })
        
    })
function showDiv(elem){
   if(elem.value == 3){
      document.getElementById('server').style.display = "block";
      //document.getElementById('video').style.display = "none";
    }else{
      ///  document.getElementById('video').style.display = "block";
        document.getElementById('server').style.display = "none";
    }
    }
    $('select.main').change(function(){
        $('select.sub-select').removeAttr('name').hide();
        $('select.'+$(this).val()).show().attr('name','sub_select_name');
    });



</script>