<?
if (isset($id_ccity)) {
    $form_url = 'admin/fv/city_action/save/' . $id_ccity;
    //$delete_url = 'admin/fvv/city_action/delete/' . $id_ccity;
    $delete_url = '';
} else {
    $form_url = 'admin/fv/city_action/save/';
    //$delete_url = 'admin/fvv/city_action/city/delete/';
    $delete_url = '';
}
?>
<style>
.row-form .span9{
    padding-bottom: 15px;
}
</style>
<div class="col-md-12">
    <div class="">
        <div class="isw-graph"></div>
        <h3><?
            if (isset($city_edit))
                echo $this -> lang -> line('button_edit');
            else
                echo $this -> lang -> line('button_add');
            ?></h3>
        <div class="clear"></div>
    </div>
    <div class="block">
        <?=form_open_multipart($form_url, array('class'=>'form-horizontal my_form'))?>
                  <div class="tabbable"> <!-- Only required for left/right tabs -->
        <ul class="nav nav-tabs">
            <? $i=1; foreach ($settings['languages']->value as $language): ?>
                <li <?=($i==1) ? 'class="active"' : ''?> ><a href="#tab<?=$i?>" data-toggle="tab"><?=$language?></a></li>
            <? $i++; endforeach; ?>
        </ul>
        <div class="tab-content">
            <? $i=1; foreach ($settings['languages']->value as $key => $val): ?>
                <div class="tab-pane  <?=($i==1) ? 'active' : ''?>" id="tab<?=$i?>">
                    <div class="control-group">
                        <label class="control-label" style="width: 0;" for="focusedInput"><? echo $this -> lang -> line('label_name');?> (перевод)</label>
                        <div class="controls">
                            <input id="title" name="title[<?=$key?>]" class="input-xlarge focused" type="text" value="<?=set_value('title['.$key.']', _t(@$city_edit[0]['title'], $key))?>">
                        </div>
                    </div>                 

                </div>
             <? $i++; endforeach; ?>
        </div>
    </div>
    <div class="control-group">
	<label class="control-label" for="focusedInput"><? echo $this -> lang -> line('label_name');?></label>
	<div class="controls">
	
        <input type="text" value="<?
                    if (isset($city_edit[0]['c_name']))
                        echo $city_edit[0]['c_name'];
                    ?>" name="pname" class="span3" size="60" />
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="focusedInput">Регион<?//= lang('category') ?></label>
	<div class="controls">
		<select id="region_id" name="region_id" class="input-xlarge focused" onchange="reload()">
			<? if (isset($cregions_list)) : ?>
				<? //cat_sort($categories,$post->category_id);
					?>
				<? foreach ($cregions_list as $category) : ?>
						<option value="<?= $category['id_regions'] ?>" <? if ($category['id_regions'] == @$city_edit[0]['region_id']) echo ('selected="selected"'); ?>><?= _t($category['title']) ?></option>
				
				<? endforeach ?>

			<? endif ?>
		</select>
	</div>
</div>
  <div class="control-group" style="display: none;">
	<label class="control-label" for="focusedInput">идентификатор</label>
	<div class="controls">
	<input type="text" value="<?
                    if (isset($city_edit[0]['c_parent']))
                        echo $city_edit[0]['c_parent'];
                    ?>" name="pparent" size="60" />
	</div>
</div>
          
          <div class="form-actions">
 <p>
                        <button type="submit" class="btn btn-primary">
                            <?
                            if (isset($city_edit))
                                echo $this -> lang -> line('button_save');
                            else
                                echo $this -> lang -> line('button_add');
                            ?>
                        </button>
                        <?
                        if (isset($city_edit)) {
                            $format = '<a class="btn btn-danger" href="%1$s" > %2$s </a>';
                           // printf($format, $delete_url, $this -> lang -> line('button_delete'));
                        }
                        ?>
                    </p>
</div>
            <input type="hidden" value="<?
            // if (isset($city_edit[0]['c_visible']))
            // echo $city_edit[0]['c_visible'];
            ?>1" name="pvisible" size="60" />
          
        </form>
    </div>
</div>