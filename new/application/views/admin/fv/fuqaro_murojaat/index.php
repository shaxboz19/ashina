<style>
.green_stat {
    color: #468847;
    font-weight: bold;
}

.orange_stat {
    color: #f89406;
    font-weight: bold;
}

.red_stat {
    color: #f00;
    font-weight: bold;
}

.blue_stat {
    color: #3a87ad;
    font-weight: bold;
}
.block-stat{margin-bottom: 20px;margin-top: 20px;}
.block-stat ul{list-style: none;margin-left: 0; font-size: 16px;}
.block-stat ul li{display: inline-block;margin-right: 10px;}
.edit{cursor: pointer;}


</style>
<h2></h2>
<!--  <?php
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
        <div class="block-stat">
        <ul>
        <li>Статистика: </li>
        <li>Поступило : <span class="badge badge-info"><?php echo number_format($fstatus['W']); ?></span></li>
        <li>Принято : <span class="badge badge-warning"><?php echo number_format($fstatus['A']); ?></span></li>
        <li>Выполнено : <span class="badge badge-success"><?php echo number_format($fstatus['S']); ?></span></li>
        </ul>
      
        </div>-->
<table class="table table-striped table-bordered">
  <thead>
    <tr>
                        <th width="5%">№</th>
                        <th width="">Дата / 
                            Время</th>
                        <th width="">ФИО</th>
                      
                        <th width="">Телефон</th>
                       <!-- <th width="">Электронная почта</th>-->
                        <th width=""></th>
                        <th width="">Статус</th>
                        
                    </tr>
  </thead>
  <tbody >
  	    <? foreach($cfuqaro_murojaat_list as $value): 
                   $status = '< >';
                            $color = '';
                            switch ($value['fm_murojaat_status']) {
                                case 'W':
                                    $status = 'Поступило';
                                    $color = 'blue_stat';
                                    break;
                                case 'A':
                                    $status = 'На рассмотрении';
                                    $color = 'orange_stat';
                                    break;
                                case 'V':
                                    $status = 'На исполнении';
                                    $color = 'orange_stat';
                                    break;
                                    case 'T':
                                    $status = 'Ваш запрос был принят...';
                                    $color = 'orange_stat';
                                    break;
                                case 'С':
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
                                case 1 :$for_whom = 'Обращения Граждан';
                                    break;
                                case 2 :$for_whom = 'Обращение Министру';
                                    break;
                            }
                ?>
                <tr>
                    <td><?=$value['id_fuqaro_murojaat']?> <a href="<?=site_url("admin/fv/fuqaro_murojaat_action/edit/".$value['id_fuqaro_murojaat'])?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i> Ред-ть</a></td>
                    <td><?=date("d.m.Y H:i:s", strtotime($value['fm_reg_date']));?></td>
                    <td><?=$value['fm_ism']?> <?=$value['fm_fam']?> <?=$value['fm_sh']?></td>
                    
                    <td>+998 <?=$value['fm_telefon']?></td>
                   <!-- <td><?=$value['fm_email']?></td>-->
                   <td><?//=$for_whom?></td>
                    <td><div class="<?=$color?>"><?=$status ?></div></td>
                   
                </tr>
                <? endforeach; ?>
  </tbody>
</table>
<?php $this->load->view('admin/components/pagination'); ?>

