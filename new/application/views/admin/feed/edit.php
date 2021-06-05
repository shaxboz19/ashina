<?=form_open_multipart('', array('class'=>'form-horizontal'))?>
     
    <div class="control-group">
        <label class="control-label" for="focusedInput">Имя:</label>
        <div class="controls">
            <input name="name" class="input-xlarge focused" type="text" value="<?=set_value('name', $feed->name)?>">
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="focusedInput">E-mail:</label>
        <div class="controls">
            <input name="email" class="input-xlarge focused" type="text" value="<?=set_value('email', $feed->email)?>">
        </div>
    </div>
    
  <div class="control-group">
        <label class="control-label" for="focusedInput">Телефон:</label>
        <div class="controls">
            <input name="phone" class="input-xlarge focused" type="text" value="<?=set_value('phone', $feed->phone)?>">
        </div>
    </div>
    
  <!--    <div class="control-group">
        <label class="control-label" for="focusedInput">Время:</label>
        <div class="controls">
            <input name="time" disabled="disabled" class="input-xlarge focused" type="text" value="<?=set_value('email', $feed->email)?>">
        </div>
    </div>
    
  <div class="control-group">
        <label class="control-label" for="focusedInput">Количество человек:</label>
        <div class="controls">
            <input name="people" disabled="disabled" class="input-xlarge focused" type="text" value="<?=set_value('phone', $feed->phone)?>">
        </div>
    </div>-->
    
    <div class="control-group">
        <label class="control-label" for="focusedInput">Сообщение:</label>
        <div class="controls">
            <textarea name="message" rows="10" style="width:100%;" class="moxiecut"><?=set_value('message', $feed->message)?></textarea>
        </div>
    </div>
    <?php if($feed->file){?>
    <div class="control-group" style="    margin-top: 5px;">
        <label class="control-label" for="focusedInput">Файл:</label>
        <div class="controls">
          <a href="<?=base_url('uploads/'.$feed->groups.'/'.$feed->file)?>" download>Скачать</a>
        </div>
    </div>
    <?php }?>
    
   <!-- <div class="control-group">
        <label class="control-label" for="focusedInput">Ip:</label>
        <div class="controls">
         <input disabled="disabled" type="text" value="<?=set_value('phone', $feed->ip)?>">      
        </div>
    </div>-->
    
    <div class="control-group">
         <label class="control-label" for="focusedInput"><?=lang('status')?>:</label>
         <div class="controls">
            <select name="status" class="input-xlarge focused">
                <option value="active" <?php echo $feed->status == 'active'?'selected="selected"':'';?>><?=lang('active')?></option>
                <option value="inactive" <?php echo $feed->status == 'inactive'?'selected="selected"':'';?>> <?=lang('inactive')?> </option>
            </select>
        </div>
    </div> 

    <div class="form-actions">
        <button type="reset" class="btn" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary"><?=lang('save')?></button>        
    </div>
    
    <?=msg()?>

</form>

<script src="<?=base_url()?>assets/admin/js/ckeditor/ckeditor.js"></script>
