<h2><?=lang($group)?></h2>

<table class="table table-striped table-bordered" id="ajax">
  <thead>
    <tr>
      <th width="30">#</th>
      <th width="60">Дата</th>
      <th width="150">Имя</th>
     <!-- <th width="200">Email</th>-->
      <!--<th width="200">Телефон</th>-->
       <!--<th width="200">Время заказа</th>
      <th width="220">Кол-во</th>
      <th width="300">Описание</th>-->
      <th width="8%"><?=lang('status')?></th>
      <th width="200">Действие</th>
    </tr>
  </thead>
  <tbody>
  	<? foreach($feed as $row): ?>
	    <tr>
          <td><?=$row->id?></td>
          <td><?=date('d-m-Y H:m:s', strtotime($row->date))?></td>
          <td><?=$row->name?></td>
        <!--  <td><?=$row->email?></td>
          <td><?=$row->phone?></td>-->
          <!-- <td><?=$row->time?></td>
          <td><?=$row->people?></td>-->
          <!--<td><?=character_limiter($row->message, 50)?></td>-->
          <td>
            <? if ($row->status == 'active'): ?>
                <span class="label label-success"><?=lang('active')?></span>
            <? else: ?>
                <span class="label label-fail"><?=lang('inactive')?></span>
            <?endif?>
          </td>
          <td>
              <a href="<?=site_url('admin/feed/edit/'.$row->groups.'/'.$row->id)?>"><i class="icon-file"></i>Посмотреть</a> |
              <a href="<?=site_url('admin/feed/delete/'.$row->id)?>" class="delete"><i class="icon-trash"></i>Удалить</a>
          </td>
	    </tr>
	<? endforeach; ?>
  </tbody>
</table>
<?php $this->load->view('admin/components/pagination'); ?>