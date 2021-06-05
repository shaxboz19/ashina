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
                        <label class="control-label" for="focusedInput"><?=lang('title')?></label>
                        <div class="controls">
                            <input id="title" name="title[<?=$key?>]" class="input-xlarge focused titles" type="text" value="<?=set_value('title['.$key.']', _t(@$post->title, $key))?>">
                        </div>
                    </div>
					<!--  <div class="control-group">
                        <label class="control-label" for="focusedInput">Под заголовок</label>
                        <div class="controls">
                            <input  name="category_title[<?=$key?>]" class="input-xlarge focused" type="text" value="<?=set_value('category_title['.$key.']', _t(@$post->category_title, $key))?>">
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
    <?php 
    $category = getOptionsData(array('group' => 'docs_category','status' => 'active','category_id' => $cat_id, 'media' => 'inactive'));
    ?>
    <?php if($category){?>
    <div class="control-group">
	<label class="control-label" for="focusedInput"><?= lang('category') ?></label>
	<div class="controls">
		<select id="category_id2" name="category_id2" class="input-xlarge focused" onchange="reload()">
			<option value=""><?= lang('no_category') ?></option>
		
				<? foreach ($category as $item) : ?>
				
						<option value="<?= $item->id ?>" <? if ($item->id == $post->category_id2) echo ('selected="selected"'); ?>><?= _t($item->title) ?></option>
			
				<? endforeach ?>

		
		</select>
	</div>
</div>
<?php }?>
<div class="control-group">
		<label class="control-label" for="focusedInput">Дата</label>
		<div class="controls">
			<input id="date" name="created_on" class="input-xlarge focused" type="text" value="<?=set_value('created_on', to_date("d.m.Y H:i", $post->created_on))?>">
		</div>
	</div>
	
	<div class="control-group">
    <label class="control-label" for="focusedInput">Номер документа</label>
    <div class="controls">
        <input id="value_1" name="value_1" class="span3" type="text" value="<?= set_value('value_1', $post->value_1) ?>">
    </div>
</div>
	
	<div class="control-group">
		<label class="control-label" for="focusedInput">Дата принятия</label>
		<div class="controls">
			<input id="date1" name="date1" class="input-xlarge focused" type="text" value="<?=set_value('date1', ($post->date1 != '0000-00-00') ? to_date("d.m.Y", $post->date1) : '')?>">
		</div>
	</div>
	
    <script type="text/javascript">
	$(function(){
		$("#date").datetimepicker({ autoclose: true, todayHighlight: true,dateFormat: 'dd.mm.yy' });
    	$("#date1").datepicker({ autoclose: true, todayHighlight: true,dateFormat: 'dd.mm.yy' });
      $("#date2").datepicker({ autoclose: true, todayHighlight: true,dateFormat: 'dd/mm/yy' });
	});
</script>
    
    <div class="control-group">
		<label class="control-label" for="focusedInput">Alias</label>
		<div class="controls">
		<?php 
        /*
        validate[required,ajax[check_alias]]
        */
        ?>
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
        
    <div class="control-group">
        <label class="control-label" for="focusedInput"></label>
        <div class="controls">
            <a href="#myModal" role="button" class="btn btn-info" data-toggle="modal"><i class="icon-file icon-white"></i> Файл</a>
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
$('#category_id2').selectize({
    sortField: 'text'
});
	$('.my_form').validationEngine();
</script>
