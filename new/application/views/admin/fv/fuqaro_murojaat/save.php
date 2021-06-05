<?php
if (isset($id_cfuqaro_murojaat)) {
    $form_url = 'admin/fv/fuqaro_murojaat_action/save/' . $id_cfuqaro_murojaat;
    $delete_url = 'admin/fv/fuqaro_murojaat_action/delete/' . $id_cfuqaro_murojaat;
    $new_add = 'admin/fv/fuqaro_murojaat_action/save/' . $id_cfuqaro_murojaat;
    $pdf_filename_uz = 'fuqaro_murojaat_uz-' . $id_cfuqaro_murojaat . '.doc';
    $pdf_filename_ru = 'fuqaro_murojaat_ru-' . $id_cfuqaro_murojaat . '.doc';
} else {
    $form_url = 'admin/fv/fuqaro_murojaat_action/save/';
    $delete_url = 'admin/fv/fuqaro_murojaat_action/delete/';
    $new_add = 'admin/fv/fuqaro_murojaat_action/save/';
    $pdf_filename = 'fuqaro_murojaat.doc';
}
?>
<style>
#content input{
    margin-bottom: 20px;
}
select, textarea {
    margin-bottom: 20px !important;
}
@media print {
    #print_uz, #print_ru{display: block !important;}
    table td{font-size: 20px; padding-bottom: 10px;}
}
textarea{width:99%;height: 200px;}
</style>
<div class="row-fluid">
    <div class="span12">
        <div class="head">
            <div class="isw-graph"></div>
            <h1><?//php echo $this->lang->line('button_edit'); ?></h1>
            <div class="clear"></div>
        </div>
        <div class="block" id="print_area">
<?=form_open_multipart($form_url, array('class'=>'form-horizontal my_form'))?>
    <br />
    <?php if($fuqaro_murojaat_edit[0]['post_id']){?>
                <div class="row-form">
                    <div class="span3">
                        Кому обращение
                    </div>
                    <div class="span9">
                       <?=_t(getPosts($fuqaro_murojaat_edit[0]['post_id'],'title'),'ru')?>
                   
                        <span></span>
                    </div>
                    <div class="clear"></div>
                </div>
                    <br />    <br />
                    <?php }?>
                <div class="row-form">
                    <div class="span3">
                        <?php echo $this->lang->line('ru_name'); ?>
                    </div>
                    <div class="span9">
                        <input type="text" value="<?php
                        if (isset($fuqaro_murojaat_edit[0]['fm_ism'])) {
                            echo $fuqaro_murojaat_edit[0]['fm_ism'];
                        }
                        ?>" name="pism" size="60" />
                        <span></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3">
                        <?php echo $this->lang->line('ru_surname'); ?>
                    </div>
                    <div class="span9">
                        <input type="text" value="<?php
                        if (isset($fuqaro_murojaat_edit[0]['fm_fam']))
                            echo $fuqaro_murojaat_edit[0]['fm_fam'];
                        ?>" name="pfam" size="60" />
                        <span></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3">
                        <?//php echo $this->lang->line('ru_middle'); ?> Отчество
                    </div>
                    <div class="span9">
                        <input type="text" value="<?php
                        if (isset($fuqaro_murojaat_edit[0]['fm_sh']))
                            echo $fuqaro_murojaat_edit[0]['fm_sh'];
                        ?>" name="" size="60" />
                        <span></span>
                    </div>
                    <div class="clear"></div>
                </div>
                 <div class="row-form">
                    <div class="span3">
                        <?//php echo $this->lang->line('ru_middle'); ?> Пол
                    </div>
                    <div class="span9">
                        <select>
                            <option value="1" <?=($fuqaro_murojaat_edit[0]['fm_sex'] == '1') ? 'selected' : ''?>>Мужской</option>
                            <option value="2" <?=($fuqaro_murojaat_edit[0]['fm_sex'] == '2') ? 'selected' : ''?>>Женский</option>
                        </select>
                        <span></span>
                    </div>
                    <div class="clear"></div>
                </div>
                 <div class="row-form">
                    <div class="span3">
                        <?//php echo $this->lang->line('ru_middle'); ?> Тип
                    </div>
                    <div class="span9">
                        <select>
                            <option value="1" <?=($fuqaro_murojaat_edit[0]['ptype'] == '1') ? 'selected' : ''?>>Физическое лицо</option>
                            <option value="2" <?=($fuqaro_murojaat_edit[0]['ptype'] == '2') ? 'selected' : ''?>>Юридическое лицо</option>
                        </select>
                        <span></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3">
                        <?//php echo $this->lang->line('ru_middle'); ?> Занятость
                    </div>
                    <div class="span9">
                        <select>
                            <option value="1" <?=($fuqaro_murojaat_edit[0]['ptypes'] == '1') ? 'selected' : ''?>>Трудоустроен(а)</option>
                            <option value="2" <?=($fuqaro_murojaat_edit[0]['ptypes'] == '2') ? 'selected' : ''?>>Не трудоустроен(а)</option>
                            <option value="3" <?=($fuqaro_murojaat_edit[0]['ptypes'] == '3') ? 'selected' : ''?>>Пенсионер</option>
                            <option value="4" <?=($fuqaro_murojaat_edit[0]['ptypes'] == '4') ? 'selected' : ''?>>Студент</option>
                        </select>
                        <span></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3">
                        <?php echo $this->lang->line('ru_email'); ?>
                    </div>
                    <div class="span9">
                        <input type="text" value="<?php
                        if (isset($fuqaro_murojaat_edit[0]['fm_email']))
                            echo $fuqaro_murojaat_edit[0]['fm_email'];
                        ?>" name="pemail" size="60" />
                        <span></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3">
                        <?php echo $this->lang->line('ru_phone'); ?>
                    </div>
                    <div class="span9">
                        <input type="text" value="<?php
                        if (isset($fuqaro_murojaat_edit[0]['fm_telefon']))
                            echo $fuqaro_murojaat_edit[0]['fm_telefon'];
                        ?>" name="ptelefon" size="60" />
                        <span></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3">
                        <?php echo $this->lang->line('ru_adres'); ?>
                    </div>
                    <div class="span9">
                        <textarea ><?php
                            if (isset($fuqaro_murojaat_edit[0]['fm_adres']))
                                echo $fuqaro_murojaat_edit[0]['fm_adres'];
                            ?></textarea>
                        <span></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form" style="display: none;">
                    <div class="span3">
                        <?//php echo $this->lang->line('ru_middle'); ?> Номер паспорта
                    </div>
                    <div class="span9">
                        <input type="text" value="<?php
                        if (isset($fuqaro_murojaat_edit[0]['nomer_passporta']))
                            echo $fuqaro_murojaat_edit[0]['nomer_passporta'];
                        ?>" name="nomer_passporta" size="60" />
                        <span></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3">
                        Регионы
                    </div>
                    <div class="span9">
                        <select name="pregions">
                            <?php
                            if (isset($cregions_list)) {
                                $format = '<option value="%1$s"%3$s>%2$s</option>';
                                foreach ($cregions_list as $value) {
                                    $selected = '';
                                    if (isset($fuqaro_murojaat_edit[0]['fm_regions']) && ($fuqaro_murojaat_edit[0]['fm_regions'] == $value['id_page_type']))
                                        $selected = 'selected="selected"';
                                    printf($format, $value['id_regions'], $value['r_name'], $selected);
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3">
                        Район (город)
                    </div>
                    <div class="span9">
                        <select name="pcity">
                            <?php
                            if (isset($ccity_list)) {
                                $format = '<option value="%1$s"%3$s>%2$s</option>';
                                foreach ($ccity_list as $value) {
                                    $selected = '';
                                    if (isset($fuqaro_murojaat_edit[0]['fm_city']) && ($fuqaro_murojaat_edit[0]['fm_city'] == $value['id_city']))
                                        $selected = 'selected="selected"';
                                    printf($format, $value['id_city'], $value['c_name'], $selected);
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form" style="display: none;">
                    <div class="span3">
                        Статус обращающегося
                    </div>
                    <div class="span9">
                        <input type="text" value="<?php
                        if (isset($fuqaro_murojaat_edit[0]['fm_ustatus']))
                            echo $fuqaro_murojaat_edit[0]['fm_ustatus'];
                        ?>" name="pustatus" size="60" />
                        <span></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form" style="display: none;">
                    <div class="span3">
                        Год рождения
                    </div>
                    <div class="span9">
                        <input type="text" value="<?php
                        if (isset($fuqaro_murojaat_edit[0]['fm_bdate']))
                            echo $fuqaro_murojaat_edit[0]['fm_bdate'];
                        ?>" name="pbyear" size="60" />
                        <span></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form" style="display: none;">
                    <div class="span3">
                        Тип обращения
                    </div>
                    <div class="span9">
                        <input type="text" value="<?php
                        if (isset($fuqaro_murojaat_edit[0]['fm_ap_type']))
                            echo $fuqaro_murojaat_edit[0]['fm_ap_type'];
                        ?>" name="paptype" size="60" />
                        <span></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form" style="display: none;">
                    <div class="span3">
                        Пол
                    </div>
                    <div class="span9">
                        <input type="text" value="<?php
                        if (isset($fuqaro_murojaat_edit[0]['fm_sex']))
                            echo $fuqaro_murojaat_edit[0]['fm_sex'];
                        ?>" name="ppol" size="60" />
                        <span></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3">
                        <?php echo $this->lang->line('ru_obraweniye'); ?>
                    </div>
                    <div class="span9">
                        <textarea ><?php
                            if (isset($fuqaro_murojaat_edit[0]['fm_mtext']))
                                echo $fuqaro_murojaat_edit[0]['fm_mtext'];
                            ?></textarea>
                        <span></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3">
                        Файл
                    </div>
                    <div class="span9">
                        <a target="_blank" href="<?php
                        if (isset($fuqaro_murojaat_edit[0]['fm_file']))
                            echo base_url() . 'appeal_files/' . $fuqaro_murojaat_edit[0]['fm_file'];
                        ?>">
                            <?php
                            if (isset($fuqaro_murojaat_edit[0]['fm_file']))
                                echo $fuqaro_murojaat_edit[0]['fm_file'];
                            ?></a>
                    </div>
                    <div class="clear"></div>
                </div>
                <!--<div class="row-form">
                    <div class="span3">
                        Разрешить публикацию моего вопроса
                    </div>
                    <div class="span9">
                        <input type="checkbox" value="1" <?php
                        if (isset($fuqaro_murojaat_edit[0]['fm_allow_publ']) && $fuqaro_murojaat_edit[0]['fm_allow_publ'] == 1) {
                            echo 'checked="checked"';
                        } else {
                            print '';
                        } ?> name="ap_allow"/>
                        <span></span>
                    </div>
                    <div class="clear"></div>
                </div>-->
               <!-- <div class="row-form">
                    <div class="span3">
                        <?php echo $this->lang->line('label_for_whom'); ?>
                    </div>
                    <div class="span9">
                        <input type="text" value="<?php
                        $for_whom = '< >';
                        if (isset($fuqaro_murojaat_edit[0]['fm_kimga_id'])) {
                            switch ($fuqaro_murojaat_edit[0]['fm_kimga_id']) {
                                case 1 :$for_whom = $this->lang->line('citizen_call_ru');
                                    break;
                                case 2 :$for_whom = $this->lang->line('ru_obraweniye_vazir');
                                    break;
                            }
                        }
                        echo $for_whom;
                        ?>" name="pkimga_id" size="60" />
                        <span></span>
                    </div>
                    <div class="clear"></div>
                </div>-->
                <div class="row-form">
                    <div class="span3">
                        <?php echo $this->lang->line('label_status'); ?>
                    </div>
                    <div class="span9">
                        <?php
                        $status_id = 'W';
                        if (isset($fuqaro_murojaat_edit[0]['fm_murojaat_status']))
                            $status_id = $fuqaro_murojaat_edit[0]['fm_murojaat_status'];
                        ?>
                        <select name="pmurojaat_status">
                              <option value="W" <?php echo ($status_id == 'W') ? 'selected' : ''; ?>>Поступило</option>   
                              <option value="T" <?php echo ($status_id == 'T') ? 'selected' : ''; ?>>Ваш запрос был принят...</option>    
                            <option value="A" <?php echo ($status_id == 'A') ? 'selected' : ''; ?>>На рассмотрении</option>    
                            <option value="V" <?php echo ($status_id == 'V') ? 'selected' : ''; ?>>На исполнении</option>    
                       
                            <option value="S" <?php echo ($status_id == 'S') ? 'selected' : ''; ?>>Выполнено</option>    
                            <option value="С" <?php echo ($status_id == 'С') ? 'selected' : ''; ?>>Отказано</option>    
                        </select>
                    </div>
                    <div class="clear"></div>
                </div>
              <!--  <div class="row-form">
                    <div class="span3">
                        <?php echo $this->lang->line('label_comment'); ?>
                    </div>
                    <div class="span9">
                        <textarea name="pnatija_text"><?php
                            if (isset($fuqaro_murojaat_edit[0]['fm_natija_text']))
                                echo $fuqaro_murojaat_edit[0]['fm_natija_text'];
                            ?></textarea> 
                        <span></span>
                    </div>
                    <div class="clear"></div>
                </div>-->
               <!-- <div class="row-form">
                    <div class="span3">
                        <?php echo $this->lang->line('menu_operator'); ?>
                    </div>
                    <div class="span9"><?php
                        if (isset($fuqaro_murojaat_edit[0]['username']))
                            echo $fuqaro_murojaat_edit[0]['username'];
                        ?>
                        <span></span>
                    </div>
                    <div class="clear"></div>
                </div>-->
                <!--
                            <div class="row-form">
                                <div class="span3">
                <?php // echo $this -> lang -> line('label_'); ?>
                                </div>
                                <div class="span9">
                                    <input type="text" value="<?php
//            if (isset($fuqaro_murojaat_edit[0]['fm_zapas']))
//                echo $fuqaro_murojaat_edit[0]['fm_zapas'];
                ?>" name="pzapas" size="60" />
                                    <span></span>
                                </div>
                                <div class="clear"></div>
                            </div>-->
                <div class="row-form">
                    <div class="span3"></div>
                    <div class="span9">
                        <p>
                          <a href="<?=base_url('admin/fv/fuqaro_murojaat')?>" class="btn btn-primary">Назад</a>
                            <button type="submit" class="btn btn-primary">
                                <?php
                                echo $this->lang->line('button_save');
                                ?>
                            </button>
                           
                             <!-- <a href="#" id="print_all_ru" class="btn btn-success">
                                <?php echo $this->lang->line('print_ru'); ?> 
                            </a>
                            <a href="#" id="print_all_uz" class="btn btn-success">
                                <?php echo $this->lang->line('print_ru'); ?> (O'z)
                            </a>
                          
                            <a  href="javascript:void(0)" id="export_pdf" class="btn btn-success"> MS Word (O'z)</a>
                            <a  href="javascript:void(0)" id="export_pdf1" class="btn btn-success"> MS Word (Ru)</a>-->
                        </p>
                    </div>
                    <div class="clear"></div>
                </div>
            </form>
            <div class="row-form">
                    <div class="span3"></div>
                    <div class="span9">
                     
                    </div>
                    <div class="clear"></div>
                </div>
            
        </div>
    </div>
	<?php 
	/*  <p style="color: #2f5496;font-size: 26px;">Ganiev Elyor Majidovich</p>*/
	?>
</div><div class="dr"><span></span></div>
<div style="width: 100%; display: none;" id="for_word">
    <table align="center" style="width: 70%">
        <tr>
        <td style="margin-right: 10px;display: block;width: 119px;">
                
            </td>
            <td>
                <h2 style="float:left;width: 50%;">
                </h2>              
            </td>
        </tr>
    </table>
    <br /><br />
    <table style="width: 70%;float: none;clear: both;margin-top: 50px;" border="1" align="center" cellpadding="5" cellspacing="5">
        <tr>            
            <td>Murojaat tartib raqami #:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['id_fuqaro_murojaat']; ?></td>
        </tr>
        <tr>
            <td>Murojaat tushgan sana va vaqt</td>
            <td><?//php print $fuqaro_murojaat_edit[0]['fm_reg_date']; ?> <?=to_date("d.m.Y", $fuqaro_murojaat_edit[0]['fm_reg_date']);?>; <?=to_date("H:s", $fuqaro_murojaat_edit[0]['fm_reg_date']);?></td>
        </tr>
        <tr>          
            <td>Murojaat mualiffi F.I.SH:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_ism'] . ' ' . $fuqaro_murojaat_edit[0]['fm_fam'] . ' ' . $fuqaro_murojaat_edit[0]['middle_name']; ?> </td>
        </tr>
        <tr>            
            <td>Elektron manzil:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_email']; ?></td>
        </tr>
          <tr>           
            <td>Manzil:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_adres']; ?></td>
        </tr>
        <?php if(@$fuqaro_murojaat_edit[0]['nomer_passporta']){?>
         <tr>       
            <td>Passport ma’lumotlari:</td>
            <td><?//php print @$fuqaro_murojaat_edit[0]['ser_passporta']; ?> <?php print @$fuqaro_murojaat_edit[0]['nomer_passporta']; ?></td>
        </tr>
        <?php }?>
        <tr>       
            <td>Telefon raqami:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_telefon']; ?></td>
        </tr>
        <tr>       
            <td>Murojaat turi:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_ap_type']; ?></td>
        </tr>
        <!--<tr>            
            <td>Раҳбарият топшириғи</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_natija_text']; ?></td>
        </tr>-->
        <tr>            
            <td colspan="2">Murojaatning qisqacha mazmuni: <br /><br /> <?php print $fuqaro_murojaat_edit[0]['fm_mtext']; ?></td>
        </tr>
    </table>
</div>

<div style="width: 100%; display: none;" id="for_word1">
    <table align="center" style="width: 70%">
        <tr>
        <td style="margin-right: 10px;display: block;width: 119px;">
                
            </td>
            <td>
               
               
            </td>
        </tr>
    </table>
    <br /><br />
    <table style="width: 70%;float: none;clear: both;margin-top: 25px;" border="1" align="center" cellpadding="5" cellspacing="5">
        <tr>            
            <td>Номер #:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['id_fuqaro_murojaat']; ?></td>
        </tr>
        <tr>
            <td>Дата обращения:</td>
            <td><?//php print $fuqaro_murojaat_edit[0]['fm_reg_date']; ?> <?=to_date("d.m.Y", $fuqaro_murojaat_edit[0]['fm_reg_date']);?>; <?=to_date("H:s", $fuqaro_murojaat_edit[0]['fm_reg_date']);?></td>
        </tr>
        <tr>          
            <td>ФИО:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_ism'] . ' ' . $fuqaro_murojaat_edit[0]['fm_fam'] . ' ' . $fuqaro_murojaat_edit[0]['middle_name']; ?> </td>
        </tr>
        <tr>            
            <td>E-mail:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_email']; ?></td>
        </tr>
          <tr>           
            <td>Адрес:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_adres']; ?></td>
        </tr>
        <?php if(@$fuqaro_murojaat_edit[0]['nomer_passporta']){?>
         <tr>       
            <td>Паспортные данные:</td>
            <td><?//php print @$fuqaro_murojaat_edit[0]['ser_passporta']; ?> <?php print @$fuqaro_murojaat_edit[0]['nomer_passporta']; ?></td>
        </tr>
        <?php }?>
        <tr>       
            <td>Телефон:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_telefon']; ?></td>
        </tr>
        <tr>       
            <td>Тип обращения:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_ap_type']; ?></td>
        </tr>
        <!--<tr>            
            <td>Раҳбарият топшириғи</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_natija_text']; ?></td>
        </tr>-->
        <tr>            
            <td colspan="2">Сообщение: <br /><br /><?php print $fuqaro_murojaat_edit[0]['fm_mtext']; ?></td>
        </tr>
    </table>
</div>
<!-- Print block -->
<div style="width: 100%; display: none;" id="print_uz">
    <div style="text-align: center;margin-bottom: 20px;">
               
    </div>
    <table style="width: 100%; font-size: 16px; line-height: 20px;" border="0" align="center" cellpadding="5" cellspacing="5">
        <tr>            
            <td>Murojaat tartib raqami #:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['id_fuqaro_murojaat']; ?></td>
        </tr>
        <tr>
            <td>Murojaat tushgan sana va vaqt</td>
            <td><?//php print $fuqaro_murojaat_edit[0]['fm_reg_date']; ?> <?=to_date("d.m.Y", $fuqaro_murojaat_edit[0]['fm_reg_date']);?>; <?=to_date("H:s", $fuqaro_murojaat_edit[0]['fm_reg_date']);?></td>
        </tr>
        <tr>          
            <td>Murojaat mualiffi F.I.SH:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_ism'] . ' ' . $fuqaro_murojaat_edit[0]['fm_fam'] . ' ' . $fuqaro_murojaat_edit[0]['middle_name']; ?> </td>
        </tr>
        <tr>            
            <td>Elektron manzil:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_email']; ?></td>
        </tr>
          <tr>           
            <td>Manzil:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_adres']; ?></td>
        </tr>
        <?php if(@$fuqaro_murojaat_edit[0]['nomer_passporta']){?>
         <tr>       
            <td>Passport ma’lumotlari:</td>
            <td><?//php print @$fuqaro_murojaat_edit[0]['ser_passporta']; ?> <?php print @$fuqaro_murojaat_edit[0]['nomer_passporta']; ?></td>
        </tr>
        <?php }?>
        <tr>       
            <td>Telefon raqami:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_telefon']; ?></td>
        </tr>
        <tr>       
            <td>Murojaat turi:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_ap_type']; ?></td>
        </tr>
        <!--<tr>            
            <td>Раҳбарият топшириғи</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_natija_text']; ?></td>
        </tr>-->
        <tr>            
            <td colspan="2">Murojaatning qisqacha mazmuni: <br /> <?php print $fuqaro_murojaat_edit[0]['fm_mtext']; ?></td>
        </tr>
    </table>
</div>
<div style="width: 100%; display: none;" id="print_ru">
    <div style="text-align: center;margin-bottom: 20px;">
             <h2>
                </h2>                
    </div>
    <table style="width: 100%; font-size: 16px; line-height: 20px;" border="0" align="center" cellpadding="5" cellspacing="5">
        <tr>            
            <td>Номер #:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['id_fuqaro_murojaat']; ?></td>
        </tr>
        <tr>
            <td>Дата обращения:</td>
            <td><?//php print $fuqaro_murojaat_edit[0]['fm_reg_date']; ?> <?=to_date("d.m.Y", $fuqaro_murojaat_edit[0]['fm_reg_date']);?>; <?=to_date("H:s", $fuqaro_murojaat_edit[0]['fm_reg_date']);?></td>
        </tr>
        <tr>          
            <td>ФИО:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_ism'] . ' ' . $fuqaro_murojaat_edit[0]['fm_fam'] . ' ' . $fuqaro_murojaat_edit[0]['middle_name']; ?> </td>
        </tr>
        <tr>            
            <td>E-mail:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_email']; ?></td>
        </tr>
          <tr>           
            <td>Адрес:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_adres']; ?></td>
        </tr>
        <?php if(@$fuqaro_murojaat_edit[0]['nomer_passporta']){?>
         <tr>       
            <td>Паспортные данные:</td>
            <td><?//php print @$fuqaro_murojaat_edit[0]['ser_passporta']; ?> <?php print @$fuqaro_murojaat_edit[0]['nomer_passporta']; ?></td>
        </tr>
        <?php }?>
        <tr>       
            <td>Телефон:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_telefon']; ?></td>
        </tr>
      <!--  <tr>       
            <td>Тип обращения:</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_ap_type']; ?></td>
        </tr>-->
        <!--<tr>            
            <td>Раҳбарият топшириғи</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_natija_text']; ?></td>
        </tr>-->
        <tr>            
            <td colspan="2">Сообщение: <br /> <?php print $fuqaro_murojaat_edit[0]['fm_mtext']; ?></td>
        </tr>
    </table>
</div>
<!--- -->
<div id="editor"></div>
<script src="<?=base_url()?>assets/admin/js/jQuery.print.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin/js/jspdf.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
 /*jQuery('#print_all').click(function(){
        $('#print_area').printThis({
            debug: false,            
    importCSS: false,            
    importStyle: false,       
    printContainer: true,       
    loadCSS: "<?= get_resource_url() ?>css/print.css",  
    pageTitle: "",              
    removeInline: false,        
    printDelay: 333,            
    header: null,             
    footer: null,              
    base: false ,               
    formValues: true,         
    canvas: false,              
    doctypeString: "",       
    removeScripts: false        
        });
    });*/
        // Hook up the print link.
        $("#print_all_uz")
                .attr("href", "javascript:void(0)")
                .click(function() {
                    // Print the DIV.
                    $("#print_uz").print();
                    //$("#print_area").print();
                    // Cancel click event.
                    return(false);
                }
                );
          $("#print_all_ru")
                .attr("href", "javascript:void(0)")
                .click(function() {
                    // Print the DIV.
                    $("#print_ru").print();
                    //$("#print_area").print();
                    // Cancel click event.
                    return(false);
                }
                );
        $('#export_pdf').click(function() {
            var fileName = '<?php echo $pdf_filename_uz; ?>'; // You can use the .txt extension if you want
            downloadInnerHtml(fileName, 'for_word', 'application/msword');
        });
        $('#export_pdf1').click(function() {
            var fileName = '<?php echo $pdf_filename_ru; ?>'; // You can use the .txt extension if you want
            downloadInnerHtml(fileName, 'for_word1', 'application/msword');
        });
    });
    function downloadInnerHtml(filename, elId, mimeType) {
        var elHtml = document.getElementById(elId).innerHTML;
        elHtml = '<html><head><meta http-equiv=Content-Type content="text/html; charset=utf-8">' +
                '<meta name=Generator content="Microsoft Word 15 (filtered)"></head><body lang=RU>' +
                elHtml;
        var link = document.createElement('a');
        mimeType = mimeType || 'text/plain';
        link.setAttribute('download', filename);
        link.setAttribute('href', 'data:' + mimeType + ';charset=utf-8,' + encodeURIComponent(elHtml));
        link.click();
    }
</script>