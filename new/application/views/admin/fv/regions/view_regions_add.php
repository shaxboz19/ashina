<?
if (isset($id_cregions)) {
    $form_url = 'admin/fv/regions_action/save/' . $id_cregions;
    //$delete_url = 'admin/fvv/regions_action/delete/' . $id_cregions;
    $delete_url = '';
} else {
    $form_url = 'admin/fv/regions_action/save/';
   // $delete_url = 'admin/fvv/regions_action/delete/';
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
            if (isset($regions_edit))
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
                            <input id="title" name="title[<?=$key?>]" class="input-xlarge focused" type="text" value="<?=set_value('title['.$key.']', _t(@$regions_edit[0]['title'], $key))?>">
                        </div>
                    </div>                 

                </div>
             <? $i++; endforeach; ?>
        </div>
    </div>
            <div class="row-form">
                
                <div class="span9" style="margin-left: 0;">
                <div class="span3" style="margin-left: 0;">
                    <? echo $this -> lang -> line('label_name');?>
                </div>
                    <input type="text" value="<?
                    if (isset($regions_edit[0]['r_name']))
                        echo $regions_edit[0]['r_name'];
                    ?>" name="pname" size="60" />
                </div>
                <div class="clearfix"></div>
            </div>
           
            <div class="row-form">
               
                <div class="span9" style="margin-left: 0;">
                 <div class="span3" style="margin-left: 0;">
                    идентификатор
                </div>
                    <input type="text" value="<?
                    if (isset($regions_edit[0]['r_child']))
                        echo $regions_edit[0]['r_child'];
                    ?>" name="pchild" size="60" />
                </div>
                
                
                
            </div>
           <!--   <div class="row-form">
         <label for="focusedInput"><?=lang('status')?></label>
         <div>
            <select name="status">
                <option value="active" <?php echo @$regions_edit[0]['status'] == 'active'?'selected="selected"':'';?>><?=lang('active')?></option>
                <option value="inactive" <?php echo @$regions_edit[0]['status'] == 'inactive'?'selected="selected"':'';?>> <?=lang('inactive')?> </option>
            </select>
        </div>
        <div class="clearfix"></div>
    </div>-->
            <input type="hidden" value="<?
            // if (isset($regions_edit[0]['c_visible']))
            // echo $regions_edit[0]['c_visible'];
            ?>1" name="pvisible" size="60" />
            
            <div class="row-form">
                <div class="span3"></div>
                <div class="span9" style="margin-left: 0;">
                    <p>
                        <button type="submit" class="btn btn-primary">
                            <?
                            if (isset($regions_edit))
                                echo $this -> lang -> line('button_save');
                            else
                                echo $this -> lang -> line('button_add');
                            ?>
                        </button>
                        <?
                        if (isset($regions_edit)) {
                           // $format = '<a class="btn btn-danger" href="%1$s" > %2$s </a>';
                          //  printf($format, $delete_url, $this -> lang -> line('button_delete'));
                        }
                        ?>
                    </p>
                </div>
                <div class="clearfix"></div>
            </div>
        </form>
    </div>
</div>