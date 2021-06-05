<h2>Тип Назначение
    <a href="<?=site_url('admin/fv/type_appointments_action/add')?>" class="btn btn-primary pull-right" type="button">
        <i class="icon-plus-sign icon-white"></i>
        <span>Добавить</span>
    </a>
</h2>

<div class="tab-content">
  <div class="tab-pane active" id="home">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th width="1%">#</th>       
        <th width="100">Заголовок</th> 
        <!--<th width="50">Назначение</th>-->
        <!--<th width="1%"></th>-->
      </tr>
    </thead>
    <tbody>
    	<? foreach($ctype_appointments_list as $value): ?>
  	    <tr class="edit" url="<?=site_url("admin/fv/type_appointments_action/edit/".$value['id_type_appointments'])?>">
  	        <td><?=$value['id_type_appointments']?></td>    
            <td>
            <?php if(_t($value['title'])){?>
            <?=_t($value['title'])?>
            <?php } else {?>
            <?=$value['c_name']?>
            <?php }?>
            
            </td> 
            <!--<td></td>-->     
            
            
           <!-- <td>
              <div class="btn-group">
                <a href="" class="btn btn-small btn-danger delete" title="Удалить"><i class="icon-trash icon-white"></i></a>
              </div>
            </td>-->
  	    </tr>
  	<? endforeach ?>
    </tbody>
  </table>
<?//php $this->load->view('admin/components/pagination'); ?>
</div>

