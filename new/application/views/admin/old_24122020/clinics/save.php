<?=form_open_multipart('', array('class'=>'form-horizontal my_form'))?>
<br />
    <?=msg()?>
<div class="control-group">
<label class="control-label" for="focusedInput">Наименование</label>
<div class="controls">
    <input name="org_name" class="input-xlarge focused" type="text" value="<?=set_value('org_name', @$post->org_name)?>" required="">
</div>
</div>
<div class="control-group">
<label class="control-label" for="focusedInput">Район/Город</label>
<div class="controls">
    <input name="region_name" class="input-xlarge focused" type="text" value="<?=set_value('region_name', @$post->region_name)?>">
</div>
</div>
<div class="control-group">
<label class="control-label" for="focusedInput">Адрес</label>
<div class="controls">
    <input name="location_address" class="input-xlarge focused" type="text" value="<?=set_value('location_address', @$post->location_address)?>">
</div>
</div>
<div class="control-group">
<label class="control-label" for="focusedInput">Номера телефонов</label>
<div class="controls">
    <input name="phones" class="input-xlarge focused" type="text" value="<?=set_value('phones', @$post->phones)?>">
</div>
</div>
<div class="control-group">
<label class="control-label" for="focusedInput">Номер лицензии</label>
<div class="controls">
    <input name="lic_num" class="input-xlarge focused" type="text" value="<?=set_value('lic_num', @$post->lic_num)?>">
</div>
</div>
<div class="control-group">
<label class="control-label" for="focusedInput">Номер лицензии по реестру</label>
<div class="controls">
    <input name="lic_num_reg" class="input-xlarge focused" type="text" value="<?=set_value('lic_num_reg', @$post->lic_num_reg)?>">
</div>
</div>
<div class="control-group">
<label class="control-label" for="focusedInput">Организационно-правовая форма</label>
<div class="controls">
    <input name="legal_form" class="input-xlarge focused" type="text" value="<?=set_value('legal_form', @$post->legal_form)?>">
</div>
</div>
<div class="control-group">
<label class="control-label" for="focusedInput">ИНН</label>
<div class="controls">
    <input name="inn" class="input-xlarge focused" type="text" value="<?=set_value('inn', @$post->inn)?>">
</div>
</div>
<div class="control-group">
<label class="control-label" for="focusedInput">ФИО руководителя</label>
<div class="controls">
    <input name="chief" class="input-xlarge focused" type="text" value="<?=set_value('chief', @$post->chief)?>">
</div>
</div>
<div class="control-group">
<label class="control-label" for="focusedInput">Направления деятельности</label>
<div class="controls">
    <input name="activity" class="input-xlarge focused" type="text" value="<?=set_value('activity', @$post->activity)?>">
</div>
</div>
<div class="control-group">
<label class="control-label" for="focusedInput">Информация о прекращении деятельности</label>
<div class="controls">
    <input name="inf_termination" class="input-xlarge focused" type="text" value="<?=set_value('inf_termination', @$post->inf_termination)?>">
</div>
</div>

    <?php 
    /*
      <!--<div class="tabbable"> 
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
                            <input id="title" name="title[<?=$key?>]" class="input-xlarge focused" type="text" value="<?=set_value('title['.$key.']', _t(@$post->title, $key))?>">
                        </div>
                    </div>
                 
                     <div class="control-group">
                        <label class="control-label" for="focusedInput"><?=lang('content')?></label>
                        <div class="controls">
                            <textarea name="content[<?=$key?>]" class="moxiecut"><?=set_value('content['.$key.']', _t(@$post->content, $key))?></textarea>
                        </div>
                    </div>
                  

                </div>
             <? $i++; endforeach; ?>
        </div>
    </div>--->
    */
    ?>
   <div class="control-group">
	<label class="control-label" for="focusedInput">Регион</label>
	<div class="controls">
		<select id="region_id" name="region_id" class="input-xlarge focused" onchange="reload()">
			<option value="">Нет</option>
				<?php 
				$region = getOptionsData(array('group' => 'region_option','status' => 'active','media'=>'inactive'));
				?>
				<? foreach($region as $item): ?>
				<option value="<?= $item->id ?>" <? if ($item->id == @$post->region_id) echo ('selected="selected"'); ?>><?= _t($item->title) ?></option>
				<? endforeach; ?>
		</select>
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
    

    <div class="form-actions">
        <button type="reset" class="btn" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary"><?=lang('save')?></button>
    </div>



</form>

<script src="<?=base_url()?>assets/admin/js/ckeditor/ckeditor.js"></script>
<script>
	$('.my_form').validationEngine();
</script>