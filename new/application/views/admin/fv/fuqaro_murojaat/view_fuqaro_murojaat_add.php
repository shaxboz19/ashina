<?php
if (isset($id_cfuqaro_murojaat)) {
    $form_url = 'fuqaro_murojaat/save/' . $id_cfuqaro_murojaat;
    $delete_url = 'fuqaro_murojaat/delete/' . $id_cfuqaro_murojaat;
} else {
    $form_url = 'fuqaro_murojaat/save/';
    $delete_url = 'fuqaro_murojaat/delete/';
}
?>
<div class="span8">
    <div class="head">
        <div class="isw-graph"></div>
        <h1><?php
            if (isset($fuqaro_murojaat_edit))
                echo $this->lang->line('button_edit');
            else
                echo $this->lang->line('button_add');
            ?></h1>
        <div class="clear"></div>
    </div>

    <div class="block">
        <form action="<?php echo $this->model_common->site_url($form_url); ?>" method="post">



            <div class="row-form">
                <div class="span3">

                    <?php // echo $this -> lang -> line('label_');?>
                </div>
                <div class="span9">
                    <input type="text" value="<?php
                    if (isset($fuqaro_murojaat_edit[0]['fm_ism']))
                        echo $fuqaro_murojaat_edit[0]['fm_ism'];
                    ?>" name="pism" size="60" />
                    <span></span>
                </div>
                <div class="clear"></div>
            </div>


            <div class="row-form">
                <div class="span3">

                    <?php // echo $this -> lang -> line('label_');?>
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

                    <?php // echo $this -> lang -> line('label_');?>
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

                    <?php // echo $this -> lang -> line('label_');?>
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

                    <?php // echo $this -> lang -> line('label_');?>
                </div>
                <div class="span9">
                    <input type="text" value="<?php
                    if (isset($fuqaro_murojaat_edit[0]['fm_mtext']))
                        echo $fuqaro_murojaat_edit[0]['fm_mtext'];
                    ?>" name="pmtext" size="60" />
                    <span></span>
                </div>
                <div class="clear"></div>
            </div>


            <div class="row-form">
                <div class="span3">

                    <?php // echo $this -> lang -> line('label_');?>
                </div>
                <div class="span9">
                    <input type="text" value="<?php
                    if (isset($fuqaro_murojaat_edit[0]['fm_kimga_id']))
                        echo $fuqaro_murojaat_edit[0]['fm_kimga_id'];
                    ?>" name="pkimga_id" size="60" />
                    <span></span>
                </div>
                <div class="clear"></div>
            </div>


            <div class="row-form">
                <div class="span3">

                    <?php // echo $this -> lang -> line('label_');?>
                </div>
                <div class="span9">
                    <input type="text" value="<?php
                    if (isset($fuqaro_murojaat_edit[0]['fm_murojaat_status']))
                        echo $fuqaro_murojaat_edit[0]['fm_murojaat_status'];
                    ?>" name="pmurojaat_status" size="60" />
                    <span></span>
                </div>
                <div class="clear"></div>
            </div>


            <div class="row-form">
                <div class="span3">

                    <?php // echo $this -> lang -> line('label_');?>
                </div>
                <div class="span9">
                    <input type="text" value="<?php
                    if (isset($fuqaro_murojaat_edit[0]['fm_natija_text']))
                        echo $fuqaro_murojaat_edit[0]['fm_natija_text'];
                    ?>" name="pnatija_text" size="60" />
                    <span></span>
                </div>
                <div class="clear"></div>
            </div>


            <div class="row-form">
                <div class="span3">

                    <?php // echo $this -> lang -> line('label_');?>
                </div>
                <div class="span9">
                    <input type="text" value="<?php
                    if (isset($fuqaro_murojaat_edit[0]['fm_zapas']))
                        echo $fuqaro_murojaat_edit[0]['fm_zapas'];
                    ?>" name="pzapas" size="60" />
                    <span></span>
                </div>
                <div class="clear"></div>
            </div>


            <div class="row-form">
                <div class="span3">

                    <?php // echo $this -> lang -> line('label_');?>
                </div>
                <div class="span9">
                    <select name="papregion">
                        <?php
                        if (isset($cregions_list)) {
                            $format = '<option value="%1$s"%3$s>%2$s</option>';
                            print '<option value="default">' . $this->lang->line($defaultLang . '_ap_select') . '</option>';
                            foreach ($cregions_list as $value) {
                                $selected = '';
                                if (isset($regions_edit[0]['r_regions']) && ($regions_edit[0]['r_regions'] == $value['id_regions']))
                                    $selected = 'selected="selected"';
                                printf($format, $value['id_regions'], $value['r_name'], $selected);
                            }
                        }
                        ?>
                    </select>
                    <span></span>
                </div>
                <div class="clear"></div>
            </div>

            <div class="row-form">
                <div class="span3">

                    <?php // echo $this -> lang -> line('label_');?>
                </div>
                <div class="span9">
                    <select name="papcity">
                        <?php
                        if (isset($ccity_list)) {
                            $format = '<option value="%1$s"%3$s>%2$s</option>';
                            print '<option value="default">' . $this->lang->line($defaultLang . '_ap_select') . '</option>';
                            foreach ($ccity_list as $value) {
                                $selected = '';
                                if (isset($city_edit[0]['c_city']) && ($city_edit[0]['c_city'] == $value['id_city']))
                                    $selected = 'selected="selected"';
                                printf($format, $value['id_regions'], $value['c_name'], $selected);
                            }
                        }
                        ?>
                    </select>
                    <span></span>
                </div>
                <div class="clear"></div>
            </div>

            <div class="row-form">
                <div class="span3">

                    <?php // echo $this -> lang -> line('label_');?>
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

                    <?php // echo $this -> lang -> line('label_');?>
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

                    <?php // echo $this -> lang -> line('label_');?>
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

                    <?php // echo $this -> lang -> line('label_');?>
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
                <div class="span3"></div>
                <div class="span9">
                    <p>
                        <button type="submit" class="btn btn-primary">
                            <?php
                            if (isset($fuqaro_murojaat_edit))
                                echo $this->lang->line('button_save');
                            else
                                echo $this->lang->line('button_add');
                            ?>
                        </button>

                        <?php
                        if (isset($fuqaro_murojaat_edit)) {
                            $format = '<a class="btn btn-danger" href="%s" > %2$s </a>';
                            printf($format, $this->model_common->site_url($delete_url), $this->lang->line('button_delete'));
                        }
                        ?>
                    </p>
                </div>
                <div class="clear"></div>
            </div>
        </form>
    </div>
</div>