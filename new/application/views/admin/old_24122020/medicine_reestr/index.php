<h2>Реестры лекарственных средств
   <!-- <a href="<?=site_url('admin/medicine_reestr/save')?>" class="btn btn-primary pull-right" type="button">
        <i class="icon-plus-sign icon-white"></i> Добавить
    </a>-->
</h2>
<div class="pull-left" style="margin-top: 14px;">
<?php echo form_open_multipart('admin/medicine_reestr/save_date'); ?>
<label>Дата последнего изменения</label>
<input type="text" name="created_on" id="date1" style="float: left;line-height: 10px;margin-top: 6px;" value="<?=to_date('d.m.Y', $date_reestr->created_on)?>">
<?php echo form_submit('submit', 'Сохранить', 'class="btn btn-primary"') ?>
<?php echo form_close(); ?>
</div>
  <script type="text/javascript">
	$(function(){
		$("#date").datetimepicker({ autoclose: true, todayHighlight: true,dateFormat: 'dd.mm.yy' });
    	$("#date1").datepicker({ autoclose: true, todayHighlight: true,dateFormat: 'dd.mm.yy' });
      $("#date2").datepicker({ autoclose: true, todayHighlight: true,dateFormat: 'dd/mm/yy' });
	});
</script>
<div class="pull-left" style="margin-top: 14px;display:none">
    <?php echo form_open_multipart('admin/medicine_reestr/import_new/'); ?>
    <select name="category_id" class="form-control">
        <?php 
        $cat = getOptionsData(array('group' => 'medicine_category', 'media' => 'inactive', 'spec' => 'active', 'status' => 'active', 'order' => 'ASC'));
        foreach($cat as $item):
        $cat_title[$item->id] = _t($item->title);
        ?>        
        <option value="<?=$item->id?>"><?=_t($item->title)?></option>
        <? endforeach; ?>
    </select>
    <input type="file" name="userfile" style="float: left;line-height: 10px;margin-top: 6px;" value="">
    <?php echo form_submit('submit', 'Импорт', 'class="btn btn-primary"') ?>
    <?php echo form_close(); ?>
</div>
<div class="clearfix"></div>
<div class="tab-content" >
<div class="tab-pane active" id="home">
  <table class="table table-striped table-bordered table-hover" id="list">
    <thead>
      <tr>
        <th width="100"><?//=lang('title')?>Наименование</th>
         <th width="1%">Категория</th> 
        <th width="1%"></th> 
               
        <th width="1%"><?=lang('status')?></th>
        <th width="1%"></th>                       
      </tr>
    </thead>
    <tbody >
      <? foreach($posts as $post): ?>        
            <tr id="item-<?=$post->id?>">
            <td><?=$post->value_2?></td>
            <td>
             <?=$cat_title[$post->category_id]?>
             </td>
            <td>
             <!-- <div class="btn-group">
           <a href="<?=site_url("admin/medicine_reestr/save/$post->id")?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i> Ред-ть</a>
              </div>-->
            </td>
             
             <td>
                <?if ($post->status == 'active'):?>
                    <span class="label label-success"><?=lang('active')?></span>
                <?else:?>
                    <span class="label label-fail"><?=lang('inactive')?></span>
                <?endif?>
            </td>
            <td>
                <div class="btn-group" style="display: none;">
                    <a href="<?=site_url('admin/medicine_reestr/delete/'.$post->id)?>" class="btn btn-small btn-danger delete"><i class="icon-trash icon-white"></i></a>
                </div>
            </td>
        </tr>
    <? endforeach ?>
    </tbody>
  </table>
</div>
<?php $this->load->view('admin/components/pagination'); ?>
</div>