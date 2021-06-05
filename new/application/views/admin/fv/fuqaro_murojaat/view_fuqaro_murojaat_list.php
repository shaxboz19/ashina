<div class="span4">
    <div class="head">
        <div class="isw-graph"></div>
        <?php
        $format_title = '<h1>%s</h1>';
        printf($format_title, $this->lang->line('label_list'));
        ?>
        <div class="clear"></div>
    </div>

    <div class="block">
        <ol type="square">
            <?php
            if (isset($cfuqaro_murojaat_list)) {
                $format = '<li><a href="' . $this->model_common->site_url('%s') . '"><b>%s</b></a></li>';
                foreach ($cfuqaro_murojaat_list as $value) {

                    $link_value = 'fuqaro_murojaat/edit/' . $value['id_fuqaro_murojaat'];
                    if (strlen($value['fm_name']) > 0)
                        printf($format, $link_value, $value['fm_name']);
                    else
                        printf($format, $link_value, $this->lang->line('menu_empty'));
                }
            }
            ?>
        </ol>

        <div class="row-form">

            <div class="span12">
                <p align="center">
                    <?php
                    $format = '<a class="btn btn-primary" href="%1$s" >%2$s</a>';
                    printf($format, $this->model_common->site_url('fuqaro_murojaat/add'), $this->lang->line('button_add'));
                    ?>
                </p>
            </div>

            <div class="clear"></div>
        </div>

    </div>
</div>
