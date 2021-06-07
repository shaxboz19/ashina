<?=form_open_multipart('', array('class'=>'form-horizontal my_form'))?>

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
                            <input id="title" name="title[<?=$key?>]" class="input-xlarge focused" type="text" value="<?=set_value('title['.$key.']', _t(@$post->title, $key))?>">
                        </div>
                    </div>
                    
                   <!-- <div class="control-group">
                        <label class="control-label" for="focusedInput"><?=lang('content')?></label>
                        <div class="controls">
                            <textarea name="content[<?=$key?>]" class="moxiecut"><?=set_value('content', _t(@$post->content, $key))?></textarea>
                        </div>
                    </div>-->

                </div>            
             <? $i++; endforeach; ?>
        </div>
    </div>
<?php 
/*
    <!--<div class="control-group">
        <label class="control-label" for="focusedInput"><?=lang('category')?></label>
        <div class="controls">
            <select id="category_id" name="category_id" class="input-xlarge focused" onchange="reload()">
                <option value=""><?=lang('no_category')?></option>
                <? foreach($gallery_category as $item): ?>
                <option value="<?=$item->id?>" <?php echo @$item->id == $post->category_id ?'selected="selected"':'';?>><?=_t($item->title)?></option>
                <? endforeach; ?>
                
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
    
    <?//php $this->load->view('admin/components/meta'); ?>
    
    <!-- <div class="control-group">
		<label class="control-label" for="focusedInput">Код видео (youtube)</label>
		<div class="controls">
			<input name="iframe_youtube" class="span3" type="text" value="<?=set_value('iframe_youtube', @$post->iframe_youtube)?>" />
		</div>
	</div> 
  
  <div class="control-group">
		<label class="control-label" for="focusedInput">Код видео (mover.uz)</label>
		<div class="controls">
			<input name="iframe_mover" class="span3" type="text" value="<?=set_value('iframe_mover', @$post->iframe_mover)?>" />
		</div>
	</div> -->
    
    <div class="control-group">
		<label class="control-label" for="focusedInput">Alias</label>
		<div class="controls">
			<input id="alias" name="alias" class="validate[required,ajax[check_alias]] span3" type="text" value="<?=set_value('alias', @$post->alias)?>" />
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
            <a href="#myModal" role="button" class="btn btn-info" data-toggle="modal"><i class="icon-file icon-white"></i> Media</a>
        </div>
    </div>
    
    <input type="hidden" id="post_id" name="post_id" value="<?=@$post->id?>"/>

    <div class="form-actions">
        <button type="reset" class="btn" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary"><?=lang('save')?></button>        
    </div>
    
    <?=msg()?>

</form>

<script src="<?=base_url()?>assets/admin/js/ckeditor/ckeditor.js"></script>