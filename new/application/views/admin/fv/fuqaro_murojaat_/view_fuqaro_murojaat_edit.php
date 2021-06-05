<?php
if (isset($id_cfuqaro_murojaat)) {
    $form_url = 'fuqaro_murojaat/save/' . $id_cfuqaro_murojaat;
    $delete_url = 'fuqaro_murojaat/delete/' . $id_cfuqaro_murojaat;
    $new_add = 'fuqaro_murojaat/save/' . $id_cfuqaro_murojaat;
    $pdf_filename = 'fuqaro_murojaat-' . $id_cfuqaro_murojaat . '.doc';
} else {
    $form_url = 'fuqaro_murojaat/save/';
    $delete_url = 'fuqaro_murojaat/delete/';
    $new_add = 'fuqaro_murojaat/save/';
    $pdf_filename = 'fuqaro_murojaat.doc';
}
?>
<div class="row-fluid">
    <div class="span12">
        <div class="head">
            <div class="isw-graph"></div>
            <h1><?php echo $this->lang->line('button_edit'); ?></h1>
            <div class="clear"></div>
        </div>

        <div class="block" id="print_area">
            <form action="<?php echo $this->model_common->site_url($form_url); ?>" method="post">

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
                        Города
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

                <div class="row-form">
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

                <div class="row-form">
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

                <div class="row-form">
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

                <div class="row-form">
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

                <div class="row-form">
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
                </div>

                <div class="row-form">
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
                </div>


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
                            <option value="A" <?php echo ($status_id == 'A') ? 'selected' : ''; ?>>Принято</option>    
                            <option value="S" <?php echo ($status_id == 'S') ? 'selected' : ''; ?>>Выполнено</option>    
                        </select>
                    </div>
                    <div class="clear"></div>
                </div>


                <div class="row-form">
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
                </div>

                <div class="row-form">
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
                </div>

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
                            <button type="submit" class="btn btn-primary">
                                <?php
                                echo $this->lang->line('button_save');
                                ?>
                            </button>

                            <a href="#" id="print_all" class="btn btn-success">
                                <?php echo $this->lang->line('print_ru'); ?>
                            </a>
                            <a href="#" id="export_pdf" class="btn btn-success"> MS Word </a>
                        </p>
                    </div>
                    <div class="clear"></div>
                </div>
            </form>
        </div>
    </div>
</div><div class="dr"><span></span></div>

<div style="width: 100%; display: none;" id="for_word">
    <table align="center" style="width: 70%">
        <tr>
            <td>
                <h2 style="float:left;width: 50%;">Ўзбекистон Республикаси
                    Фавқулодда вазиятлар вазирининг
                    виртуал қабулхонасига келиб тушган мурожаат
                </h2>
            </td>
            <td>
                <img src="http://mchs.dst.uz/theme/fvv/new_mark_up/img/logo_small.png" />
            </td>
        </tr>
    </table>
    <table style="width: 70%;float: none;clear: both;" border="1" align="center" cellpadding="5" cellspacing="5">
        <tr>
            <td>1</td>
            <td>Мурожаат тартиб рақами</td>
            <td><?php print $fuqaro_murojaat_edit[0]['id_fuqaro_murojaat']; ?></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Мурожаат тушган сана ва вақт</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_reg_date']; ?></td>
        </tr>
        <tr>
            <td>3</td>
            <td>Мурожаат муаллифи Ф.И.О.</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_ism'] . ' ' . $fuqaro_murojaat_edit[0]['fm_fam']; ?></td>
        </tr>
        <tr>
            <td>4</td>
            <td>Телефон рақами</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_telefon']; ?></td>
        </tr>
        <tr>
            <td>5</td>
            <td>Электрон манзили</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_email']; ?></td>
        </tr>
        <tr>
            <td>6</td>
            <td>Жисмоний ёки юридик шахснинг манзили</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_adres']; ?></td>
        </tr>
        <tr>
            <td>7</td>
            <td>Муддат</td>
            <td></td>
        </tr>
        <tr>
            <td>8</td>
            <td>Раҳбарият топшириғи</td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_natija_text']; ?></td>
        </tr>
        <tr>
            <td>9</td>
            <td><b>Мурожаатнинг қисқача мазмуни</b></td>
            <td><?php print $fuqaro_murojaat_edit[0]['fm_mtext']; ?></td>
        </tr>
    </table>
</div>

<div id="editor"></div>

<script src="/theme/fvv/js/jQuery.print.js" type="text/javascript"></script>
<script src="/theme/fvv/js/jspdf.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {

        // Hook up the print link.
        $("#print_all")
                .attr("href", "javascript:void(0)")
                .click(function() {
                    // Print the DIV.
                    $("#print_area").print();

                    // Cancel click event.
                    return(false);
                }
                );


        $('#export_pdf').click(function() {


            var fileName = '<?php echo $pdf_filename; ?>'; // You can use the .txt extension if you want
            downloadInnerHtml(fileName, 'for_word', 'application/msword');


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
