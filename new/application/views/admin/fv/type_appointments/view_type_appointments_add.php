<?
if (isset($id_ctype_appointments)) {
    $form_url = 'admin/fv/type_appointments_action/save/' . $id_ctype_appointments;
    //$delete_url = 'admin/fvv/type_appointments_action/delete/' . $id_ctype_appointments;
    $delete_url = '';
} else {
    $form_url = 'admin/fv/type_appointments_action/save/';
    //$delete_url = 'admin/fvv/type_appointments_action/type_appointments/delete/';
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
            if (isset($type_appointments_edit))
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
                            <input id="title" name="title[<?=$key?>]" class="input-xlarge focused" type="text" value="<?=set_value('title['.$key.']', _t(@$type_appointments_edit[0]['title'], $key))?>">
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
                    if (isset($type_appointments_edit[0]['c_name']))
                        echo $type_appointments_edit[0]['c_name'];
                    ?>" name="pname" size="60" />
                </div>
      
                <div class="clear"></div>
            </div>
            <!--<div class="row-form">
                
                <div class="span9" style="margin-left: 0;">
                <div class="span3" style="margin-left: 0;">
                   Родитель (идентификатор)
                </div>
                    <input type="text" readonly="readonly" value="<?
                    if (isset($type_appointments_edit[0]['c_parent']))
                        echo $type_appointments_edit[0]['c_parent'];
                    ?>" size="60" />
                </div>
                <div class="clear"></div>
            </div>-->
            <div class="row-form">
                
                <div class="span9" style="margin-left: 0;">
                <div class="span3" style="margin-left: 0;">
                   Изменить Родитель (идентификатор)
                </div>
                    <select name="pparent">
                        <option value="">Назначения</option>
                        <?php foreach($cappointments_list as $item){?>
                            
                            <option value="<?=$item["r_child"]?>" id="<?=$item["id_appointments"]?>" <?
                            if (isset($type_appointments_edit[0]['c_parent']) && $type_appointments_edit[0]['c_parent'] == $item["r_child"])
                                echo 'selected';
                            ?> ><?=$item["r_name"]?></option>
                        <?php }?>
                        
                    </select>
                </div>
                <div class="clear"></div>
            </div>
            <input type="hidden" value="<?
            // if (isset($type_appointments_edit[0]['c_visible']))
            // echo $type_appointments_edit[0]['c_visible'];
            ?>1" name="pvisible" size="60" />
          
            <div class="row-form">
                <div class="span3"></div>
                <div class="span9" style="margin-left: 0;">
                    <p>
                        <button type="submit" class="btn btn-primary">
                            <?
                            if (isset($type_appointments_edit))
                                echo $this -> lang -> line('button_save');
                            else
                                echo $this -> lang -> line('button_add');
                            ?>
                        </button>
                        <?
                        if (isset($type_appointments_edit)) {
                            $format = '<a class="btn btn-danger" href="%1$s" > %2$s </a>';
                            printf($format, $delete_url, $this -> lang -> line('button_delete'));
                        }
                        ?>
                    </p>
                </div>
                <div class="clear"></div>
            </div>
        </form>
    </div>
</div>