<?= form_open_multipart('', array('class' => 'form-horizontal my_form')) ?>

<div class="tabbable">
	<!-- Only required for left/right tabs -->
	<ul class="nav nav-tabs">
		<? $i = 1;
		foreach ($settings['languages']->value as $language) : ?>
			<li <?= ($i == 1) ? 'class="active"' : '' ?>><a href="#tab<?= $i ?>" data-toggle="tab"><?= $language ?></a></li>
		<? $i++;
		endforeach; ?>
		<!--<a href="#" class="btn btn-primary pull-right back"><i class="icon-arrow-left icon-white"></i> Назад</a>-->
	</ul>

	<div class="tab-content">
		<? $i = 1;
		foreach ($settings['languages']->value as $key => $val) : ?>
			<div class="tab-pane  <?= ($i == 1) ? 'active' : '' ?>" id="tab<?= $i ?>">

				<div class="control-group">
					<label class="control-label" for="focusedInput"><?= lang('title') ?></label>
					<div class="controls">
						<input id="title" name="title[<?= $key ?>]" class="input-xlarge focused" type="text" value="<?= set_value('title', _t(@$post->title, $key)) ?>">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="focusedInput">Категория</label>
					<div class="controls">
						<input name="category_title[<?= $key ?>]" class="input-xlarge focused" type="text" value="<?= set_value('category_title[' . $key . ']', _t(@$post->category_title, $key)) ?>">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="focusedInput"><?= lang('short_content') ?></label>
					<div class="controls">
						<textarea name="short_content[<?= $key ?>]" class="moxiecut"><?= set_value('short_content', _t(@$post->short_content, $key)) ?></textarea>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="focusedInput"><?= lang('content') ?></label>
					<div class="controls">
						<textarea name="content[<?= $key ?>]" class="moxiecut"><?= set_value('content', _t(@$post->content, $key)) ?></textarea>
					</div>
				</div>

			</div>
		<? $i++;
		endforeach; ?>
	</div>
</div>
<!--  <?php if ($post->category_id == 2) { ?>
  <div class="control-group">
		<label class="control-label" for="focusedInput">Цвет </label>
		<div class="controls">
			<input  name="option_2" class="jscolor span3" type="text" placeholder=" " value="<?= set_value('option_2', $post->option_2) ?>">
		</div>
	</div>
    <?php } ?>-->
<div class="control-group">
	<label class="control-label" for="focusedInput"><?= lang('category') ?></label>
	<div class="controls">
		<select id="category_id" name="category_id" class="input-xlarge focused" onchange="reload()">
			<option value=""><?= lang('no_category') ?></option>
			<? if (isset($categories)) : ?>
				<? //cat_sort($categories,$post->category_id);
					?>
				<? foreach ($categories as $category) : ?>
					<? if ($category->id !== $post->id) : ?>
						<option value="<?= $category->id ?>" <? if ($category->id == $post->category_id) echo ('selected="selected"'); ?>><?= _t($category->title) ?></option>
					<? endif; ?>
				<? endforeach ?>

			<? endif ?>
		</select>
	</div>
</div>

<div class="control-group" style="display: none;">
	<label class="control-label" for="focusedInput">Показать как меню</label>
	<div class="controls">
		<select name="as_menu" class="input-xlarge focused">
			<option value="1"><?= lang('active') ?></option>
			<option value="0" <?= ($post->as_menu == 0) ? 'selected' : '' ?>> <?= lang('inactive') ?> </option>
		</select>
	</div>
</div>
<div class="control-group" style="display: none;">
	<label class="control-label" for="focusedInput">Позиция меню</label>
	<div class="controls">
		<select name="position_menu" class="input-xlarge focused">
			<option>Нет</option>
			<option value="right" <?= ($post->position_menu == 'right') ? 'selected' : '' ?>>Справа</option>
			<option value="left" <?= ($post->position_menu == 'left') ? 'selected' : '' ?>> Слева </option>
		</select>
	</div>
</div>
<div class="control-group" style="display: none;">
	<label class="control-label" for="focusedInput">На главную страницу</label>
	<div class="controls">
		<select name="option" class="input-xlarge focused">
			<option value="yes" <?php echo @$post->option == 'yes' ? 'selected="selected"' : ''; ?>>Да</option>
			<option value="no" <?php echo @$post->option == 'no' ? 'selected="selected"' : ''; ?>> Нет </option>
		</select>
	</div>
</div>
<div class="control-group" style="display: none;">
	<label class="control-label" for="focusedInput">Статус на гл. стр</label>
	<div class="controls">
		<select name="spec" class="input-xlarge focused">
			<option value="active" <?php echo @$post->spec == 'active' ? 'selected="selected"' : ''; ?>>Да</option>
			<option value="inactive" <?php echo @$post->spec == 'inactive' ? 'selected="selected"' : ''; ?>> Нет </option>
		</select>
	</div>
</div>
<div class="control-group" style="display: none;">
	<label class="control-label" for="focusedInput">Позиция (цифры)</label>
	<div class="controls">
		<input id="sort_order" name="sort_order" class="span3" type="text" value="<?= set_value('sort_order', $post->sort_order) ?>">
	</div>
</div>

<div class="control-group">
	<label class="control-label" for="focusedInput">Настройки</label>
	<div class="controls">
		<input id="options" name="options" class="span3" type="text" value="<?= set_value('options', $post->options) ?>">
	</div>
</div>

<div class="control-group">
	<label class="control-label" for="focusedInput">Внешняя ссылка</label>
	<div class="controls">
		<input id="option_2" name="option_2" class="span3" type="text" value="<?= set_value('option_2', $post->option_2) ?>">
	</div>
</div>



<div class="control-group">
	<label class="control-label" for="focusedInput"><?= lang('status') ?></label>
	<div class="controls">
		<select name="status" class="input-xlarge focused">
			<option value="active"><?= lang('active') ?></option>
			<option value="inactive" <?= ($post->status == 'inactive') ? 'selected' : '' ?>> <?= lang('inactive') ?> </option>
		</select>
	</div>
</div>

<!--<div class="control-group">
		<label class="control-label" for="focusedInput">Ссылка на сайт</label>
		<div class="controls">
			<input id="option_1" name="option_1" class="span3" type="text" value="<?= set_value('option_1', $post->option_1) ?>">
		</div>
	</div>-->

<?php $this->load->view('admin/components/meta'); ?>
<div class="control-group">
	<label class="control-label" for="focusedInput">Alias</label>
	<div class="controls">
		<input <?php if(!$post->alias){?>id="alias"<?php }?> name="alias" class="validate[required,ajax[check_alias]] span3" type="text" value="<?= set_value('alias', $post->alias) ?>">
	</div>
</div>

<div class="control-group">
	<label class="control-label" for="focusedInput"></label>
	<div class="controls">
		<a href="#myModal" role="button" class="btn btn-info" data-toggle="modal"><i class="icon-file icon-white"></i> Media</a>
		 <a href="<?= site_url('admin/pages/index/docs/' . $post->id) ?>" target="_blank" class="btn btn-info"> Документы</a>
		<!--<a href="<?= site_url('admin/group/index/menugallery/' . $post->id) ?>" class="btn btn-info"> Галерея</a>-->
	</div>
</div>

<input type="hidden" id="post_id" name="post_id" value="<?= @$post->id ?>" />



<div class="form-actions">
	<button type="reset" class="btn" onclick="history.go(-1)"><?= lang('cancel') ?></button>
	<button type="submit" class="btn btn-primary"><?= lang('save') ?></button>
</div>

<?= msg() ?>

</form>

<script src="<?= base_url() ?>assets/admin/js/ckeditor/ckeditor.js"></script>

<script>
$('#category_id').selectize({
    sortField: 'text'
});
	$('.my_form').validationEngine();
</script>