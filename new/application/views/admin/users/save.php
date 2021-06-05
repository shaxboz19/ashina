<?=form_open_multipart('', array('class'=>'form-horizontal'))?>

    <?=msg()?>

    <fieldset>
        <legend><?=lang('save_user')?></legend>
        
        <div class="control-group">
            <label class="control-label" for="focusedInput">ФИО</label>
            <div class="controls">
                <input name="fio" class="input-xlarge focused" type="text" required="" value="<?=set_value('fio', isset($user)?$user->fio:'')?>">
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="focusedInput">Описание</label>
            <div class="controls">
                
                <input name="description" class="input-xlarge focused" type="text" value="<?=set_value('description', isset($user)?$user->description:'')?>">
            </div>
        </div>
          <div class="control-group">
		<label class="control-label" for="focusedInput">Область</label>
		<div class="controls">
			<select name="region_id" class="input-xlarge focused" required="">
            <option value="0">Выбрать</option>
            <? 
            $region = getOptionsData(array('group' => 'regions','limit'=>'14','status' => 'active'));
            foreach($region as $item): ?>
                <option value="<?=$item->id?>" <?php echo @$user->region_id == $item->id?'selected="selected"':'';?>><?=_t($item->title,'ru')?></option>
                <? endforeach; ?>
            </select>
		</div>
    </div>
        <div class="control-group" style="display: none;">
            <label class="control-label" for="focusedInput"><?=lang('first_name')?></label>
            <div class="controls">
                <input name="first_name" class="input-xlarge focused" type="text" value="<?=set_value('first_name', isset($user)?$user->first_name:'')?>">
            </div>
        </div>
        
        <div class="control-group" style="display: none;">
            <label class="control-label" for="focusedInput"><?=lang('last_name')?></label>
            <div class="controls">
                <input name="last_name" class="input-xlarge focused" type="text" value="<?=set_value('last_name', isset($user)?$user->last_name:'')?>">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="focusedInput"><?=lang('username')?></label>
            <div class="controls">
            <?php if(!@$user->user_id) {?>
                <input name="username" class="validate[required,ajax[ajaxNameCall]] input-xlarge focused" id="username" type="text" value="<?=set_value('username', isset($user)?$user->username:'')?>">
            <?php } else {?>
            <input name="username" class="input-xlarge focused" required="" id="username" type="text" value="<?=set_value('username', isset($user)?$user->username:'')?>">
            <?php }?>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="focusedInput"><?=lang('email')?></label>
            <div class="controls">
                <input name="email" class="input-xlarge focused" type="text" value="<?=set_value('email', isset($user)?$user->email:'')?>">
            </div>
        </div>
      
        <div class="control-group">
            <label class="control-label" for="focusedInput">Телефон</label>
            <div class="controls">
                <input name="phone" class="input-xlarge focused" type="text" value="<?=set_value('phone', isset($user)?$user->phone:'')?>">
            </div>
        </div>
        

        <div class="control-group">
            <label class="control-label" for="focusedInput"><?=lang('password')?></label>
            <div class="controls">
                <input name="password" class="input-xlarge focused" type="password" value="<?=set_value('password', isset($user)?0:'')?>">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="focusedInput"><?=lang('confirm_password')?></label>
            <div class="controls">
                <input name="c_password" class="input-xlarge focused" type="password" value="<?=set_value('c_password', isset($user)?0:'')?>">
            </div>
        </div>
         <div class="control-group" style="display: none;">
		 <label class="control-label" for="focusedInput">Активировать телефон</label>
		 <div class="controls">
			<select name="phone_verified" class="input-xlarge focused">
				<option value="0">Нет</option>
				<option value="1" <?=($user->phone_verified=='1')?'selected':''?>> Да </option>
			</select>
		</div>
	</div> 
         <div class="control-group" style="display: none;">
		 <label class="control-label" for="focusedInput">Заблокировать <br /> пользователя</label>
		 <div class="controls">
			<select name="ban" class="input-xlarge focused">
				<option value="no">Нет</option>
				<option value="yes" <?=($user->ban=='yes')?'selected':''?>> Да </option>
			</select>
		</div>
	</div>
        <div class="control-group">
            <label class="control-label" for="selectError"><?=lang('user_type')?></label>
            <div class="controls">
                <select name="user_type" id="selectError">
                    <? foreach($user_types as $user_type): ?>
                        <option value="<?=$user_type?>" <?=set_select('user_type', $user_type, isset($user)?$user_type == $user->user_type:'')?> ><?=lang($user_type)?></option>
                    <? endforeach ?>
                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="optionsCheckbox2"><?=lang('active')?></label>
            <div class="controls">
                <label class="checkbox">
                    <input name="active" type="checkbox" value="1" <?=set_checkbox('active', 1, isset($user)?$user->active == '1':TRUE)?> />
                </label>
            </div>
        </div>      
        
            
        <div class="control-group" style="display: none;">
          <label class="control-label" for="focusedInput">Аватар</label>
          <div class="controls">
          	<input type="file" name="userfile" />
          </div>        
        </div>
        
       <!-- <?php if(@$user->img) {?>
        <div class="control-group">
          <label class="control-label" for="focusedInput">Текущее фото</label>
          <div class="controls">
            <img src="<?=base_url("thumb/view/w/150/h/150/src/uploads/admin/$user->img")?>"/>
            	<a href="<?=site_url('admin/users/delete_img/'.$user->img.'/'.$user->user_id)?>" onclick="return cDelete();"><i class="icon-trash"></i><?=lang('delete')?></a>
          </div>
        </div>
        <?php }?>  -->
        <?php if(@$user->picture) {?>
        <div class="control-group" style="display: none;">
          <label class="control-label" for="focusedInput">Фото профиля</label>
          <div class="controls">
            <img src="<?=base_url("thumb/view/w/150/h/150/src/uploads/profile/$user->picture")?>"/>
            	<a href="<?=site_url('admin/users/delete_profile_img/'.$user->picture.'/'.$user->user_id)?>" onclick="return cDelete();"><i class="icon-trash"></i><?=lang('delete')?></a>
          </div>
        </div>
        <?php }?>  
       	<input   type="hidden" id="post_id" name="post_id" value="<?=set_value('user_id', isset($user)?$user->user_id:'')?>" />
  
        <div class="form-actions">
            <button type="reset" class="btn" onclick="history.go(-1)"><?=lang('cancel')?></button>
            <button type="submit" class="btn btn-primary"><?=lang('save')?></button>        
        </div>
    </fieldset>
</form>
 <script>
              $('.form-horizontal').validationEngine();
            
              </script>