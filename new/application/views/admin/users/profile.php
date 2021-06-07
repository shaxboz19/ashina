<h2>Профиль</h2>
	<?php if(@$user->user_id){?>
<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th><?=lang('name')?></th>
      <th>Фамилия</th>
      <th><?=lang('email')?></th>
      <th>Телефон</th>
     <!-- <th>Картинка профиля</th>-->
      <th><?=lang('status')?></th>
      <th width="180"><?=lang('actions')?></th>
    </tr>
  </thead>
  
  <tbody>
  
	    <tr>
      
	      <td><?=$user->user_id?></td>
	      <td><?=$user->first_name?></td>
	      <td><?=$user->last_name?></td>
	      <td><?=$user->email?></td>
         <td><?=$user->phone?></td>
       <!--  <?php if($user->picture){?>
           <td class="cnt"><img src="<?=base_url("thumb/view/w/50/h/50/src/uploads/profile/$user->picture")?>"/></td>
        <?php } else {?>
        <td>Нет фото</td>
        <?php }?>-->
	      <td>
			<? if($user->active == '1'): ?>
				<span class="label label-success"><?=lang('active')?></span>
			<? else: ?>
				<span class="label label-warning"><?=lang('inactive')?></span>
			<? endif; ?>
	      </td>
	      <td>
	      	<a href="<?=site_url('admin/users/save/'.$user->user_id)?>"><i class="icon-edit"></i><?=lang('edit')?></a> | 
	      	<a href="<?=site_url('admin/users/delete/'.$user->user_id)?>" onclick="return cDelete();"><i class="icon-trash"></i><?=lang('delete')?></a>

	      </td>

	    </tr>

  </tbody>
 

</table>
 <?php } else {?>
 <p style="text-align: center; padding: 20px; font-size: 18px;">Пользователь не найден</p>
<?php }?>
<?=form_close()?>