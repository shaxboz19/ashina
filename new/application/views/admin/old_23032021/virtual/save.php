<style>
.virtual .control-label{font-weight: bold;margin-bottom: 15px;padding-top: 0;}
.virtual .controls{}
.virtual .control-group{margin-bottom: 20px;}
</style>
<div>
<?=form_open_multipart('', array('class'=>'virtual form-horizontal my_form'))?>
<br />
<?=msg()?>

    <div class="control-group">
        <label class="control-label" for="focusedInput">Фамилия</label>
        <div class="controls">
            <?=@$post->last_name?>
            <!--<input name="last_name" class="input-xlarge focused" type="text" value="<?=set_value('last_name', @$post->last_name)?>" required="">-->
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="focusedInput">Имя</label>
        <div class="controls">
            <?=@$post->first_name?>
            <!--<input name="first_name" class="input-xlarge focused" type="text" value="<?=set_value('first_name', @$post->first_name)?>" required="">-->
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="focusedInput">Отчество</label>
        <div class="controls">
            <?=@$post->middle_name?>
            <!--<input name="middle_name" class="input-xlarge focused" type="text" value="<?=set_value('middle_name', @$post->middle_name)?>" required="">-->
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="focusedInput">Область</label>
        <div class="controls">
            <?=_t(getRegionInfo($post->region_id,'title'),'ru')?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="focusedInput">Город (Регион)</label>
        <div class="controls">
            <?=_t(getCityInfo($post->city_id,'title'),'ru')?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="focusedInput">Почтовый индекс</label>
        <div class="controls">
            <?=@$post->postcode?>
            <!--<input name="postcode" class="input-xlarge focused" type="text" value="<?=set_value('postcode', @$post->postcode)?>" required="">-->
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="focusedInput">Адрес</label>
        <div class="controls">
            <?=@$post->address?>
            <!--<input name="address" class="input-xlarge focused" type="text" value="<?=set_value('address', @$post->address)?>" required="">-->
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="focusedInput">Данные паспорта</label>
        <div class="controls">
            <?=@$post->passport?>
            <!--<input name="passport" class="input-xlarge focused" type="text" value="<?=set_value('passport', @$post->passport)?>" required="">-->
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="focusedInput">Телефон</label>
        <div class="controls">
            <?=@$post->phone?>
            <!--<input name="phone" class="input-xlarge focused" type="text" value="<?=set_value('phone', @$post->phone)?>" required="">-->
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="focusedInput">Электронная почта</label>
        <div class="controls">
            <?=@$post->email?>
            <!--<input name="email" class="input-xlarge focused" type="text" value="<?=set_value('email', @$post->email)?>" required="">-->
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="focusedInput">Тип лица</label>
        <div class="controls">
            <?php if($post->face_type == 1){?>
            Физическое лицо
            <?php }?>
             <?php if($post->face_type == 2){?>
            Юридическое лицо
            <?php }?>
            
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="focusedInput">Пол</label>
        <div class="controls">
            <?php if($post->gender == 1){?>
            Мужской
            <?php }?>
             <?php if($post->gender == 2){?>
            Женский
            <?php }?>
            
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="focusedInput">День рождения</label>
        <div class="controls">
            <?=to_date('d.m.Y', @$post->birthday)?>            
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="focusedInput">Тип обращения</label>
        <div class="controls">
            <?=lang('v_'.@$post->appeal_type)?>            
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="focusedInput">Текст обращения</label>
        <div class="controls">
            <?=@$post->message?>
        </div>
    </div>
    <?php if($post->file){?>
     <div class="control-group">
        <label class="control-label" for="focusedInput">Файл</label>
        <div class="controls">
            <a href="<?=base_url('uploads/virtual/'.@$post->file)?>" download>Скачать</a>
        </div>
    </div>
    <?php }?>
    <div class="control-group">
    	<label class="control-label" for="focusedInput"><?= lang('status') ?></label>
    	<div class="controls">
    		<select name="status" class="input-xlarge focused">
    			<option value="pending" <?= ($post->status == 'pending') ? 'selected' : '' ?>>На рассмотрении</option>
                <option value="received" <?= ($post->status == 'received') ? 'selected' : '' ?>>Поступило</option>
                <option value="done" <?= ($post->status == 'done') ? 'selected' : '' ?>>Выполнено</option>
                <option value="denied" <?= ($post->status == 'denied') ? 'selected' : '' ?>>Отказано</option>
                <option value="execution" <?= ($post->status == 'execution') ? 'selected' : '' ?>>На исполнении</option>
                <option value="accepted" <?= ($post->status == 'accepted') ? 'selected' : '' ?>>Ваш запрос был принят</option>
    		</select>
    	</div>
    </div>
     <div class="form-actions">
        <button type="reset" class="btn" onclick="history.go(-1)"><?=lang('cancel')?></button>
        <button type="submit" class="btn btn-primary"><?=lang('save')?></button>
         
    </div>
</form>
</div>