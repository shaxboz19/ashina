<?=form_open_multipart('', array('class'=>'form-horizontal my_form'))?>
	<div class="tabbable"> <!-- Only required for left/right tabs -->
		<ul class="nav nav-tabs">
			<? $i=1; foreach ($settings['languages']->value as $language): ?>
				<li <?=($i==1) ? 'class="active"' : ''?> ><a href="#tab<?=$i?>" data-toggle="tab"><?=$language?></a></li>
			<? $i++; endforeach; ?>
	
      <!--<button type="reset" class="btn btn-primary pull-right back" onclick="history.go(-1)">Назад</button>-->
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
          
             <?php if($sel == 'meduchrej') {?> 
   <div class="control-group">
		<label class="control-label" for="focusedInput">Режим работы</label>
		<div class="controls">
			<input id="option_4" name="option_4[<?=$key?>]" class="span3" type="text" value="<?=set_value('option_4', _t(@$post->option_4, $key))?>">
		</div>
	</div>  
  <?php }?>
        				
          <?php if($sel == 'product' or $sel == 'product_cat2') {?>
          <div class="control-group">
                        <label class="control-label" for="focusedInput">Категория</label>
                        <div class="controls">
                            <input  name="category_title[<?=$key?>]" class="input-xlarge focused" type="text" value="<?=set_value('category_title['.$key.']', _t(@$category_sub->title, $key))?>">
                        </div>
                    </div>
                    <?php } else {?>
                    
                     <div class="control-group">
                        <label class="control-label" for="focusedInput">Категория</label>
                        <div class="controls">
                            <input  name="category_title[<?=$key?>]" class="input-xlarge focused" type="text" value="<?=set_value('category_title['.$key.']', _t(@$post->category_title, $key))?>" >
                        </div>
                    </div>
                    <?php }?>
         <?php if($sel == 'specialists' or $sel == 'meduchrej') {?>
	     <div class="control-group">
                <label class="control-label" for="focusedInput">Адрес</label>
                <div class="controls">
                    <textarea name="short_content[<?=$key?>]" class="moxiecut"><?=set_value('short_content', _t(@$post->short_content, $key))?></textarea>
                </div>
            </div>
            <?php }?>
            <?php if($sel == 'manage'){?>
            		 <div class="control-group">
                <label class="control-label" for="focusedInput">Основные</label>
                <div class="controls">
                    <textarea name="short_content[<?=$key?>]" class="moxiecut"><?=set_value('short_content', _t(@$post->short_content, $key))?></textarea>
                </div>
            </div>
               <div class="control-group">
						<label class="control-label" for="focusedInput">Биография</label>
						<div class="controls">
							<textarea name="option_4[<?=$key?>]" class="moxiecut"><?=set_value('option_4', _t(@$post->option_4, $key))?></textarea>
						</div>
					</div>
            <div class="control-group">
						<label class="control-label" for="focusedInput">Обязанности</label>
						<div class="controls">
							<textarea name="content[<?=$key?>]" class="moxiecut"><?=set_value('content', _t(@$post->content, $key))?></textarea>
						</div>
					</div>
                    
            <?php }else {?>
              <?php if($sel == 'news' || $cat_id == 9) {?>
					 <div class="control-group" <?php if($sel == 'list' or $sel == 'docs' or $sel == 'release' or $sel == 'region' or $sel == 'doc') {?>style="display: none;"<?php }?>>
                <label class="control-label" for="focusedInput">Короткое содержание</label>
                <div class="controls">
                    <textarea name="short_content[<?=$key?>]" class="moxiecut"><?=set_value('short_content', _t(@$post->short_content, $key))?></textarea>
                </div>
            </div>
            <?php }?>
            <?php if($sel != 'ssl') {?>
					<div class="control-group" <?php if($sel == 'docs' or $sel == 'release' or $sel == 'doc') {?>style="display: none;"<?php }?>>
						<label class="control-label" for="focusedInput"><?=lang('content')?></label>
						<div class="controls">
							<textarea name="content[<?=$key?>]" class="moxiecut"><?=set_value('content', _t(@$post->content, $key))?></textarea>
						</div>
					</div>
             <?php } ?>
             <?php }?>
				</div>            
			 <? $i++; endforeach; ?>
		</div>
	</div>
    <?php if($sel == 'calendar') {?>
    <div class="control-group">
		<label class="control-label" for="focusedInput">Цвет <br />(Код цвета, только цифры, без #)</label>
		<div class="controls">
			<input id="color" name="option_2" class="jscolor span3" type="text" placeholder="Например: 000000 " value="<?=set_value('color', $post->option_2)?>">
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="focusedInput">Дата</label>
		<div class="controls">
			<input id="date" name="created_on" class="input-xlarge focused" type="text" value="<?=set_value('created_on', to_date("d.m.Y", $post->created_on))?>">
		</div>
	</div>
    <script type="text/javascript">
	$(function(){
		$("#date").datepicker({ autoclose: true, todayHighlight: true,dateFormat: 'dd.mm.yy' });
    	$("#date1").datepicker({ autoclose: true, todayHighlight: true,dateFormat: 'dd/mm/yy' });
      $("#date2").datepicker({ autoclose: true, todayHighlight: true,dateFormat: 'dd/mm/yy' });
	});
</script>
  <?php }?>
  <!--<?php if($sel == 'tariff_hosting' || $sel == 'ssl' || $sel == 'tariff_email' || $sel == 'tariff_1c' || $sel == 'tariff_builder') {?>
  <div class="control-group">
        <label class="control-label" for="price">Цена</label>
        <div class="controls price">
            <input name="price" id="price" class="span3" type="text" value="<?=set_value('price', @$post->price)?>" />            
        </div>
    </div> 
    <?php }?>-->
      <?php if($post->category_id == 2){?>
  <div class="control-group">
		<label class="control-label" for="focusedInput">Цвет </label>
		<div class="controls">
			<input  name="option_2" class="jscolor span3" type="text" placeholder=" " value="<?=set_value('option_2', $post->option_2)?>">
		</div>
	</div>
    <?php }?>
  
    <?php if($sel == 'news') {?>
    <div class="control-group">
		<label class="control-label" for="focusedInput">Дата</label>
		<div class="controls">
			<input id="date" name="created_on" class="input-xlarge focused" type="text" value="<?=set_value('created_on', to_date("d.m.Y H:i", $post->created_on))?>">
		</div>
	</div>
     <div class="control-group">
         <label class="control-label" for="focusedInput">Yangiliklarda ko'rsatish</label>
         <div class="controls">
            <select name="status1" class="input-xlarge focused">
                <option value="yes" <?php echo @$post->status1 == 'yes'?'selected="selected"':'';?>><?=lang('active')?></option>
                <option value="no" <?php echo @$post->status1 == 'no'?'selected="selected"':'';?>> <?=lang('inactive')?> </option>
            </select>
        </div>
    </div>
     <div class="control-group">
		<label class="control-label" for="focusedInput">Отправить подписчикам?</label>
		<div class="controls">
			<select name="newsletter" class="input-xlarge focused">
                <option value="yes">Да</option>
                <option value="no" selected="selected"> Нет </option>
            </select>
		</div>
    

	</div>
    <script type="text/javascript">
	$(function(){
		$("#date").datetimepicker({ autoclose: true, todayHighlight: true,dateFormat: 'dd.mm.yy' });
    	$("#date1").datepicker({ autoclose: true, todayHighlight: true,dateFormat: 'dd/mm/yy' });
      $("#date2").datepicker({ autoclose: true, todayHighlight: true,dateFormat: 'dd/mm/yy' });
	});
</script>
  <?php }?>
  <?php if($sel == 'p_option') {?>
            <!-- <div class="control-group">
		<label class="control-label" for="focusedInput">Процент</label>
		<div class="controls">
			<input id="option_2" name="option_2" class="span3" type="text" value="<?=set_value('option_2', $post->option_2)?>">
		</div>
	</div>-->
    <div class="control-group">
		<label class="control-label" for="options">Настройки</label>
		<div class="controls">
			<input id="options" name="options" id="options" class="span3" type="text" value="<?=set_value('options', $post->options)?>">
		</div>
	</div>
  
  <?php }?>
    <?php if($sel == 'region') {?>
      
    <div class="control-group">
		<label class="control-label" for="options">Ссылка <br /> (без http:// и https://)</label>
		<div class="controls">
			<input id="options" name="options" id="options" class="span3" type="text" value="<?=set_value('options', $post->options)?>">
		</div>
	</div>
  
  <?php }?>

   <?php if($sel == 'product' || $sel == 'catalog') {?> 
  <div class="control-group">
		<label class="control-label" for="focusedInput">Цена</label>
		<div class="controls">
			<input id="option_2" name="option_2" class="span3" type="text" value="<?=set_value('option_2', $post->option_2)?>">
		</div>
	</div>
  <div class="control-group">
         <label class="control-label" for="focusedInput">Популярный</label>
         <div class="controls">
            <select name="status1" class="input-xlarge focused">
                <option value="yes" <?php echo @$post->status1 == 'yes'?'selected="selected"':'';?>><?=lang('active')?></option>
                <option value="no" <?php echo @$post->status1 == 'no'?'selected="selected"':'';?>> <?=lang('inactive')?> </option>
            </select>
        </div>
    </div>
  <!-- <div class="control-group">
			<label class="control-label" for="select-state7">Категории:</label>
          	<div class="controls">
					<select id="select-state7" name="cat_id[]"  class="demo-default" style="width:50%" multiple=''>
						<option value="">Выберите </option>
            
            <? 
            $size_ft1  = array(); 
            $size_ft1 = $post->cat_id;            
            $size_ft_option = explode(',',  $size_ft1);
          
            $i = 0; foreach($cat_id as $item): ?>          
					<option value="<?=$item->id?>" ><?=_t($item->title)?></option>          
          <?$i++; endforeach;?>
					</select>
          </div>
				</div> -->
   <!-- <div class="control-group">
		<label class="control-label" for="focusedInput">Популярный (компьютер) </label>
		<div class="controls">
			<select name="status1" class="input-xlarge focused">
                <option value="yes" <?php echo @$post->status1 == 'yes'?'selected="selected"':'';?>>Да</option>
                <option value="no" <?php echo @$post->status1 == 'no'?'selected="selected"':'';?>> Нет </option>
            </select>
		</div>
	</div>
  <div class="control-group">
		<label class="control-label" for="focusedInput">Популярный (перифирия) </label>
		<div class="controls">
			<select name="status2" class="input-xlarge focused">
                <option value="yes" <?php echo @$post->status2 == 'yes'?'selected="selected"':'';?>>Да</option>
                <option value="no" <?php echo @$post->status2 == 'no'?'selected="selected"':'';?>> Нет </option>
            </select>
		</div>
	</div>
  <div class="control-group">
		<label class="control-label" for="focusedInput">Популярный <br /> </label>
		<div class="controls">
			<select name="status3" class="input-xlarge focused">
                <option value="yes" <?php echo @$post->status3 == 'yes'?'selected="selected"':'';?>>Да</option>
                <option value="no" <?php echo @$post->status3 == 'no'?'selected="selected"':'';?>> Нет </option>
            </select>
		</div>
	</div>-->
   <!--<div class="control-group">
		<label class="control-label" for="focusedInput">Мобильный</label>
		<div class="controls">
			<input id="option_3" name="option_3" class="span3" type="text" value="<?=set_value('option_3', $post->option_3)?>">
		</div>
	</div>  -->
  <?php }?>
   
  
 
  <div <?php if($sel == 'docs' or $sel == 'release' or $sel == 'doc') {?>style="display: none;"<?php }?>>
  <?php $this->load->view('admin/components/meta'); ?>
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
    <?php if($sel == 'docs' || $sel == 'doc'){?>
   <!-- <div class="control-group">
		 <label class="control-label" for="focusedInput">Язык документа</label>
		 <div class="controls">
			<select name="lang_status" class="input-xlarge focused">
				 
                <option value="uz" <?php echo @$post->lang_status == 'uz'?'selected="selected"':'';?>> Узбекский </option>
                 <option value="ru" <?php echo @$post->lang_status == 'ru'?'selected="selected"':'';?>>Русский</option>
                 <option value="en" <?php echo @$post->lang_status == 'en'?'selected="selected"':'';?>>English</option>
			</select>
		</div>
	</div>-->
    <?php }?>
    
    
    <div class="control-group" style="display: none;">
		 <label class="control-label" for="focusedInput">Включить опции</label>
		 <div class="controls">
			<select name="status_meta" class="input-xlarge focused">
				  <option value="active" <?php echo @$post->status_meta == 'active'?'selected="selected"':'';?>><?=lang('active')?></option>
                <option value="inactive" <?php echo @$post->status_meta == 'inactive'?'selected="selected"':'';?>> <?=lang('inactive')?> </option>
			</select>
		</div>
	</div>  
  
   
	<!--<div class="control-group">
		<label class="control-label" for="focusedInput">Flag</label>
		<div class="controls">
			<input id="flag" name="meta[flag]" class=" span3" type="text" value="<?=set_value('meta[flag]', @$post->flag)?>">
		</div>
	</div>-->
  <?php if($sel == 'p_option') {?>
<div class="control-group">
		<label class="control-label" for="focusedInput">Alias</label>
		<div class="controls">
			<input id="alias" name="alias" class="span3" type="text" value="<?=set_value('alias', $post->alias)?>">
		</div>
	</div>
  	<div class="control-group">
		<label class="control-label" for="focusedInput"></label>
		<div class="controls">            
			<a href="#myModal" role="button" class="btn btn-info" data-toggle="modal"><i class="icon-file icon-white"></i> Media</a>
		</div>
	</div>
  <?php } else {?>
  	<div class="control-group" <?php if($sel == 'docs' or $sel == 'release' or $sel == 'doc') {?>style="display: none;"<?php }?>>
		 <label class="control-label" for="focusedInput">Категория</label>
		 <div class="controls">
			<select name="status_cat" class="input-xlarge focused">
				  <option value="active" <?php echo @$post->status_cat == 'active'?'selected="selected"':'';?>>Включено</option>
                <option value="inactive" <?php echo @$post->status_cat == 'inactive'?'selected="selected"':'';?>> Отключить </option>
			</select>
		</div>
	</div> 
  
  
  <div class="control-group">
		<label class="control-label" for="focusedInput">Alias</label>
		<div class="controls">
			<input id="alias" name="alias" class="validate[required,ajax[check_alias]] span3" type="text" value="<?=set_value('alias', $post->alias)?>">
		</div>
	</div>
  
	<div class="control-group">
		<label class="control-label" for="focusedInput"></label>
		<div class="controls">            
			<a href="#myModal" role="button" class="btn btn-info" data-toggle="modal"><i class="icon-file icon-white"></i> Media</a>
            <?php if($sel == 'manage' || $sel == 'comparative_list') {?>
              <a href="<?=site_url('admin/group/index/docs/'.$post->id)?>" class="btn btn-info"> Документы</a>
            <?php }?>
              <?php if($sel == 'manage' || $sel == 'comparative_list') {?>
            	 <a href="<?=site_url('admin/group/index/doc/'.$post->id)?>" class="btn btn-info"> Файлы</a>
                   <?php }?>
		</div>
	</div><?php }?>
  
            
		
    

	<input type="hidden" id="post_id" name="post_id" value="<?=@$post->id?>"/>
  
  <input type="hidden" id="option_1" name="option_1" value="<?=set_value('option_1', @$category->alias)?>"/>
  
  

<?//php if($post->map_img): ?>
   <!-- <div class="control-group">
        <label class="control-label" for="focusedInput">Карта</label>
        <div class="controls">
            <img src="<?=base_url("thumb/view/w/151/h/158/src/uploads/city_map/".$post->map_img)?>"  />
        </div>
    </div>
<?//php endif; ?>
<div class="control-group">
    <div class="controls">
        <input type="file" name="userfile">
    </div>
</div>-->
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
<script>
	$('.my_form').validationEngine();
  $('#one').on('change',function(e){
    var delimiter = ',';
    if($('#two').val()==''){
        delimiter='';
    }
    $('#two').val($('#two').val()+delimiter+$(this).val());
    $(this).val('');
})
/*$(function() {
	var $wrapper = $('#wrapper');

	// theme switcher
	var theme_match = String(window.location).match(/[?&]theme=([a-z0-9]+)/);
	var theme = (theme_match && theme_match[1]) || 'default';
	var themes = ['default','legacy','bootstrap2','bootstrap3'];
	$('head').append('<link rel="stylesheet" href="../dist/css/selectize.' + theme + '.css">');

	var $themes = $('<div>').addClass('theme-selector').insertAfter('h1');
	for (var i = 0; i < themes.length; i++) {
		$themes.append('<a href="?theme=' + themes[i] + '"' + (themes[i] === theme ? ' class="active"' : '') + '>' + themes[i] + '</a>');
	}

	// display scripts on the page
	$('script', $wrapper).each(function() {
		var code = this.text;
		if (code && code.length) {
			var lines = code.split('\n');
			var indent = null;

			for (var i = 0; i < lines.length; i++) {
				if (/^[	 ]*$/.test(lines[i])) continue;
				if (!indent) {
					var lineindent = lines[i].match(/^([ 	]+)/);
					if (!lineindent) break;
					indent = lineindent[1];
				}
				lines[i] = lines[i].replace(new RegExp('^' + indent), '');
			}

			var code = $.trim(lines.join('\n')).replace(/	/g, '    ');
			var $pre = $('<pre>').addClass('js').text(code);
			$pre.insertAfter(this);
		}
	});

	// show current input values
	$('select.selectized,input.selectized', $wrapper).each(function() {
		var $container = $('<div>').addClass('value').html('Выбранные опции: ');
		var $value = $('<span>').appendTo($container);
		var $input = $(this);
		var update = function(e) { $value.text(JSON.stringify($input.val())); }

		$(this).on('change', update);
		update();

		$container.insertAfter($input);
	});
});*/
  
  var eventHandler = function(name) {
					return function() {
						console.log(name, arguments);
						$('#log').append('<div><span class="name">' + name + '</span></div>');
					};
				};
    
  
             var $select7 = $('#select-state7').selectize({
				plugins: ['remove_button'],
         
					create          : false,
					onChange        : eventHandler('onChange'),
					onItemAdd       : eventHandler('onItemAdd'),
					onItemRemove    : eventHandler('onItemRemove'),
					onOptionAdd     : eventHandler('onOptionAdd'),
					onOptionRemove  : eventHandler('onOptionRemove'),
					onDropdownOpen  : eventHandler('onDropdownOpen'),
					onDropdownClose : eventHandler('onDropdownClose'),
					onFocus         : eventHandler('onFocus'),
					onBlur          : eventHandler('onBlur'),
					onInitialize    : eventHandler('onInitialize'),
          
        
				});
        var control7 = $select7[0].selectize;   
        <?php if(@$size_ft_option) {?>     
         control7.setValue([<? foreach($size_ft_option as $item7):  ?> <?=$item7;?>, <? endforeach ?>]);
         <?php }?>

        
</script>