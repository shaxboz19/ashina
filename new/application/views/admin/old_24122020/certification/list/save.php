<?=form_open_multipart('', array('class'=>'form-horizontal my_form'))?>
<br />
    <?=msg()?>
<div class="control-group">
<label class="control-label" for="focusedInput">Наименование</label>
<div class="controls">
    <input name="title" class="input-xlarge focused" type="text" value="<?=set_value('title', @$post->title)?>" required="">
</div>
</div>
<div class="control-group">
<label class="control-label" for="focusedInput">Номер регистрации</label>
<div class="controls">
    <input name="value_1" class="input-xlarge focused" type="text" value="<?=set_value('value_1', @$post->value_1)?>" required="">
</div>
</div>
<div class="control-group">
<label class="control-label" for="focusedInput">Форма выпуска</label>
<div class="controls">
    <input name="value_2" class="input-xlarge focused" type="text" value="<?=set_value('value_2', @$post->value_2)?>" required="">
</div>
</div>
<div class="control-group">
<label class="control-label" for="focusedInput">Страна производитель</label>
<div class="controls">
    <input name="value_3" class="input-xlarge focused" type="text" value="<?=set_value('value_3', @$post->value_3)?>" required="">
</div>
</div>
<div class="control-group">
<label class="control-label" for="focusedInput">Фирма производитель</label>
<div class="controls">
    <input name="value_4" class="input-xlarge focused" type="text" value="<?=set_value('value_4', @$post->value_4)?>" required="">
</div>
</div>
<div class="control-group">
<label class="control-label" for="focusedInput">Заявитель</label>
<div class="controls">
    <input name="value_5" class="input-xlarge focused" type="text" value="<?=set_value('value_5', @$post->value_5)?>" required="">
</div>
</div>
<div class="control-group">
<label class="control-label" for="focusedInput">Разрешительное письмо</label>
<div class="controls">
    <input name="value_6" class="input-xlarge focused" type="text" value="<?=set_value('value_6', @$post->value_6)?>" required="">
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
    

    <div class="form-actions">
        <button type="reset" class="btn" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary"><?=lang('save')?></button>
    </div>



</form>

<script>
	$('.my_form').validationEngine();
</script>