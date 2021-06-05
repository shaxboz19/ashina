<h2>Опросы 
<a href="<?=site_url('admin/polls2/edit')?>" class="btn btn-primary pull-right" type="button" style="margin-right:10px ;">
        <i class="icon-plus-sign icon-white"></i>
        <span>Добавить</span>
    </a>
</h2>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th width="30">#</th>      
      <th width="400">Вопрос</th>
      <th width="400">Ответ Да</th>
      <th width="400">Ответ Нет</th>
      <th width="8%"><?=lang('status')?></th>
      <th width="150">Действие</th>
    </tr>
  </thead>
  <tbody>
  	<? foreach($posts as $row): ?>
	    <tr>
	      <td><?=$row->id?></td>	      
        <td><?=character_limiter(_t($row->title), 30)?></td>
         <td><?=$row->count_1;?></td>
         <td><?=$row->count_2;?></td>
        <td>
            <? if ($row->status == 'active'): ?>
                <span class="label label-success"><?=lang('active')?></span>
            <? else: ?>
                <span class="label label-fail"><?=lang('inactive')?></span>
            <?endif?>
        </td>
        <td>
          <a href="<?=site_url('admin/polls2/edit/'.$row->id)?>"><i class="icon-file"></i>ред-ть</a> |
          <a href="<?=site_url('admin/polls2/delete/'.$row->id)?>" class="delete"><i class="icon-trash"></i>удалить</a>
        </td>
	    </tr>
	<? endforeach; ?>
  </tbody>
</table>
<?php $this->load->view('admin/components/pagination'); ?>