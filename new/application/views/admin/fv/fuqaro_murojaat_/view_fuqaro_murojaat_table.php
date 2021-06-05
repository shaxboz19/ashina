<div class="row-fluid">
    <div class="span12">
        <div class="head">
            <div class="isw-graph"></div>
            <h1><?php echo $this->lang->line('menu_statistics'); ?></h1>
            <div class="clear"></div>
        </div>
        <?php
        $fstatus = array();
        $fstatus['W'] = 0;
        $fstatus['A'] = 0;
        $fstatus['S'] = 0;
        if (isset($cfm_statistics)) {
            foreach ($cfm_statistics as $key => $value) {
                if (isset($value['fstatus']) && isset($value['cou']))
                    $fstatus[$value['fstatus']] = $value['cou'];
            }
        }
        ?>
        <div class="block">
            <div class="span3"><p>Поступило : <span class="badge badge-info"><?php echo number_format($fstatus['W']); ?></span></div>
            <div class="span3"><p>Принято : <span class="badge badge-warning"><?php echo number_format($fstatus['A']); ?></span></div>
            <div class="span3"><p>Выполнено : <span class="badge badge-success"><?php echo number_format($fstatus['S']); ?></span></div>
            <div class="clear"></div>
        </div>
    </div>
</div><div class="dr"><span></span></div>

<div class="row-fluid">
    <div class="span12">
        <div class="head">
            <div class="isw-graph"></div>

            <div class="clear"></div>
        </div>

        <div class="block-fluid table-sorting clearfix">

            <table cellpadding="0" cellspacing="0" width="100%" class="table tSortable8">
                <thead>
                    <tr>
                        <th width="5%">№</th>
                        <th width=""><?php echo $this->lang->line('label_sana'); ?> / 
                            <?php echo $this->lang->line('label_time'); ?></th>
                        <th width=""><?php echo $this->lang->line('ru_name'); ?></th>
                        <th width=""><?php echo $this->lang->line('ru_surname'); ?></th>
                        <th width=""><?php echo $this->lang->line('ru_phone'); ?></th>
                        <th width=""><?php echo $this->lang->line('ru_email'); ?></th>
                        <th width=""><?php echo $this->lang->line('label_for_whom'); ?></th>
                        <th width=""><?php echo $this->lang->line('label_status'); ?></th>
                        <th width=""><?php echo $this->lang->line('menu_operator'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($cfuqaro_murojaat_list)) {
                        $format = '<tr><td><a href="' . $this->model_common->site_url('%1$s') . '">%2$s</a></td>'
                                . '<td><a href="' . $this->model_common->site_url('%1$s') . '"><b>%3$s</b></a></td>'
                                . '<td><a href="' . $this->model_common->site_url('%1$s') . '">%4$s</a></td>'
                                . '<td><a href="' . $this->model_common->site_url('%1$s') . '">%5$s</a></td>'
                                . '<td><a href="' . $this->model_common->site_url('%1$s') . '">%6$s</a></td>'
                                . '<td><a href="' . $this->model_common->site_url('%1$s') . '">%7$s</a></td>'
                                . '<td><a href="' . $this->model_common->site_url('%1$s') . '">%9$s</a></td>'
                                . '<td><a class="%11$s" href="' . $this->model_common->site_url('%1$s') . '">%8$s</a></td>'
                                . '<td><a href="' . $this->model_common->site_url('%1$s') . '">%12$s</a></td></tr>';
                        $k = 0;
                        foreach ($cfuqaro_murojaat_list as $value) {
                            $k++;
                            $link_value = 'fuqaro_murojaat/edit/' . $value['id_fuqaro_murojaat'];
                            $sana = date("d.m.Y H:i:s", strtotime($value['fm_reg_date']));
                            $status = '< >';
                            $color = '';
                            switch ($value['fm_murojaat_status']) {
                                case 'W':
                                    $status = 'Поступило';
                                    $color = 'blue_stat';
                                    break;
                                case 'A':
                                    $status = 'Принято';
                                    $color = 'orange_stat';
                                    break;
                                case 'C':
                                    $status = 'Отказано';
                                    $color = 'red_stat';
                                    break;
                                case 'S':
                                    $status = 'Выполнено';
                                    $color = 'green_stat';
                                    break;
                            }
                            $for_whom = '< >';
                            switch ($value['fm_kimga_id']) {
                                case 1 :$for_whom = $this->lang->line('citizen_call_ru');
                                    break;
                                case 2 :$for_whom = $this->lang->line('ru_obraweniye_vazir');
                                    break;
                            }

                            printf($format, $link_value, // 1
                                    $value['id_fuqaro_murojaat'], // 2
                                    $sana, // 3
                                    $value['fm_ism'], // 4
                                    $value['fm_fam'], // 5
                                    $value['fm_telefon'], // 6
                                    $value['fm_email'], // 7
                                    $status, // 8
                                    $for_whom, // 9
                                    $status, // 10
                                    $color,
                                    (isset($value['username'])) ? $value['username'] : ''); // 11
                        }
                    }
                    ?>
                </tbody>
            </table>



        </div>
    </div>
</div><div class="dr"><span></span></div>
