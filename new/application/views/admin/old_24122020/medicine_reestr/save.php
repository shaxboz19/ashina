<?=form_open_multipart('', array('class'=>'form-horizontal my_form'))?>
<br />
    <?=msg()?>
<?php for($i = 1; $i <= 14; $i++){
$value = 'value_'.$i;    
?>
<div class="control-group">
<label class="control-label" for="focusedInput"><?=lang('m_'.$value)?></label>
<div class="controls">
    <input name="<?=$value?>" class="input-xlarge focused" type="text" value="<?=set_value($value, @$post->$value)?>" required="">
</div>
</div>
<?php }?>



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