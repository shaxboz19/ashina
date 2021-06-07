<?=form_open('', array('class'=>'form-horizontal'))?>

    <?=msg()?>

    <fieldset>
        <legend>Ответить</legend>
        <div class="control-group">
            <label class="control-label" for="focusedInput">Email</label>
            <div class="controls">
                <input name="email" class="span3 focused" type="text" readonly="" value="<?=set_value('email', $contact->email)?>">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="focusedInput">Имя</label>
            <div class="controls">
                <input name="name" class="span3 focused" type="text" value="<?=set_value('name', $contact->name)?>">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="focusedInput">Сообщение</label>
            <div class="controls">
                <textarea name="message" class="ckeditor"></textarea>
            </div>
        </div>            

        <div class="form-actions">
            <button type="reset" class="btn" onclick="history.go(-1)">Отмена</button>
            <button type="submit" class="btn btn-primary">Отправить</button>        
        </div>
    </fieldset>
</form>

<script src="<?=base_url()?>assets/admin/js/ckeditor/ckeditor.js"></script>