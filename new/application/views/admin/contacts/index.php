<h2><?=lang('manage_contacts')?> </h2>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th width="30">#</th>
      <th width="60">Дата</th>
      <th width="150">Имя</th>
      <th width="200" style="width: 15px;">Email</th>
      <!--<th width="200" style="width: 15px;">Телефон</th>-->
      <th width="350">Описание</th>
      <th width="200">Действие</th>
    </tr>
  </thead>
  <tbody>
  	<? foreach($contacts as $contact): ?>
	    <tr>
	      <td><?=$contact->contact_id?></td>
	      <td><?=date('d-m-Y', strtotime($contact->date))?></td>
        <td><?=$contact->name?></td>
        <td><?=$contact->email?></td>
        <!--<td><?=$contact->phone?></td>-->
        <td><?=character_limiter($contact->message, 50)?></td>
	      <td>
          <a href="<?=site_url('admin/contacts/view/'.$contact->contact_id)?>"><i class="icon-file"></i>смотреть</a> |
         <!-- <a href="<?=site_url('admin/contacts/reply/'.$contact->contact_id)?>"><i class="icon-share"></i>ответить</a> |-->
          <a href="<?=site_url('admin/contacts/delete/'.$contact->contact_id)?>" onclick="return cDelete()"><i class="icon-trash"></i>удалить</a>
        </td>
	    </tr>
	<? endforeach; ?>
  </tbody>
</table>
<?=form_close()?>