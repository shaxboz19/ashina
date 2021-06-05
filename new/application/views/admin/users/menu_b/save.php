<?=form_open_multipart('', array('class'=>'form-horizontal my_form'))?>

	<div class="tabbable"> <!-- Only required for left/right tabs -->
		<ul class="nav nav-tabs">
			<? $i=1; foreach ($settings['languages']->value as $language): ?>
				<li <?=($i==1) ? 'class="active"' : ''?> ><a href="#tab<?=$i?>" data-toggle="tab"><?=$language?></a></li>
			<? $i++; endforeach; ?>
			<!--<a href="#" class="btn btn-primary pull-right back"><i class="icon-arrow-left icon-white"></i> Назад</a>-->
		</ul>

		<div class="tab-content">
			<? $i=1; foreach ($settings['languages']->value as $key => $val): ?>
				<div class="tab-pane  <?=($i==1) ? 'active' : ''?>" id="tab<?=$i?>">

					<div class="control-group">
						<label class="control-label" for="focusedInput"><?=lang('title')?></label>
						<div class="controls">
							<input id="title" name="title[<?=$key?>]" class="input-xlarge focused" type="text" value="<?=set_value('title', _t(@$post->title, $key))?>">
						</div>
					</div>

	     <div class="control-group">
                <label class="control-label" for="focusedInput"><?=lang('short_content')?></label>
                <div class="controls">
                    <textarea name="short_content[<?=$key?>]" class="ckeditor"><?=set_value('short_content', _t(@$post->short_content, $key))?></textarea>
                </div>
            </div>

					<div class="control-group">
						<label class="control-label" for="focusedInput"><?=lang('content')?></label>
						<div class="controls">
							<textarea name="content[<?=$key?>]" class="ckeditor"><?=set_value('content', _t(@$post->content, $key))?></textarea>
						</div>
					</div>

				</div>
			 <? $i++; endforeach; ?>
		</div>
	</div>

   <!--<div class="control-group">
		<label class="control-label" for="focusedInput">Иконка для меню</label>
		<div class="controls">
			<input id="option_1" name="option_1" class="span3" type="text" value="<?=set_value('option_1', $post->option_1)?>">
		</div>
    		<div class="controls">
<div class="spoiler">
    <div class="spoiler-btn">Иконки</div>
    <div class="spoiler-body collapse">
        <iframe width="1200" height="600" src="//fontello.com/" frameborder="0" allowfullscreen></iframe>
    </div>
</div>
	</div>
	</div>
  <style>
  .spoiler {
    display: table;
    position: relative;
	background-color: #f9fafa;
	border: 1px solid #ddd;
	margin-bottom: 10px;
}

.spoiler-btn {
	padding: 2px 6px;
	cursor: pointer;
}

.spoiler-body {
	padding: 6px;
}
  </style>
<script>
$.fn.ready(function() {
    // Spoiler
    $(document).on('click', '.spoiler-btn', function (e) {
        e.preventDefault()
        $(this).parent().children('.spoiler-body').collapse('toggle')
    });
});
</script>-->
  <div class="control-group">
		<label class="control-label" for="focusedInput">Позиция (цифры)</label>
		<div class="controls">
			<input id="sort_order" name="sort_order" class="span3" type="text" value="<?=set_value('sort_order', $post->sort_order)?>">
		</div>
	</div>
  
   <div class="control-group">
		<label class="control-label" for="focusedInput">Настройки (другой линк)</label>
		<div class="controls">
			<input id="options" name="options" class="span3" type="text" value="<?=set_value('options', $post->options)?>">
		</div>
	</div>

	<div class="control-group">
		 <label class="control-label" for="focusedInput"><?=lang('status')?></label>
		 <div class="controls">
			<select name="status" class="input-xlarge focused">
				<option value="active"><?=lang('active')?></option>
				<option value="inactive" <?=($post->status=='inactive')?'selected':''?>> <?=lang('inactive')?> </option>
			</select>
		</div>
	</div>
    
     <?php $this->load->view('admin/components/meta'); ?>

	<div class="control-group">
		<label class="control-label" for="focusedInput">Alias</label>
		<div class="controls">
			<input id="alias" name="alias" class="validate[required,ajax[ajaxAliasCall]] span3" type="text" value="<?=set_value('alias', $post->alias)?>">
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

<script>
	$('.my_form').validationEngine();
</script>