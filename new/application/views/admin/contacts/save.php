<?=form_open('', array('class'=>'form-horizontal'))?>

    <?=msg()?>

    <fieldset>
        <legend>Edit Email</legend>
        <div class="control-group">
            <label class="control-label" for="focusedInput">Name</label>
            <div class="controls">
                <input name="name" class="span3 focused" type="text" disabled="" value="<?=set_value('name', $email->name)?>">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="focusedInput">Phone</label>
            <div class="controls">
                <input name="phone" class="span3 focused" type="text" value="<?=set_value('subject', $email->subject)?>">
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="focusedInput">From</label>
            <div class="controls">
                <input name="from_name" class="span3 focused" type="text" value="<?=set_value('from_name', $email->from_name)?>">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="focusedInput">Email</label>
            <div class="controls">
                <input name="from" class="span3 focused" type="text" value="<?=set_value('from', $email->from)?>">
            </div>
        </div> 

        <div class="control-group">
            <label class="control-label" for="focusedInput">Content</label>
            <div class="controls">
                <textarea name="content" class="ckeditor"><?=$email->content?></textarea>
            </div>
        </div>            

        <div class="form-actions">
            <button type="reset" class="btn" onclick="history.go(-1)">Cancel</button>
            <button type="submit" class="btn btn-primary">Save changes</button>        
        </div>
    </fieldset>
</form>

<script src="<?=base_url()?>assets/admin/js/ckeditor/ckeditor.js"></script>