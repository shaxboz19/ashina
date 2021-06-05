<h2>
	<?=lang('manage_users')?> 
	<a href="<?=site_url('admin/users/save')?>" class="btn btn-primary pull-right" type="button">
		<i class="icon-plus-sign icon-white"></i> 
		<?=lang('add_user')?>
	</a>
</h2>
<style type="text/css">
.red {background-color: #FE5A5A !important; }
.red i, .no-red i {margin-top: 2px;}
.no-red {background: green !important;}
</style>
<ul class="nav nav-tabs" style="display: none;">
 <!-- <li class="<?=($sub_sel=='user')?'active':''?>"><a href="<?=site_url('admin/users')?>"><?=lang('users')?></a></li>-->
  <!--<li class="<?=($sub_sel=='admin')?'active':''?>"><a href="<?=site_url('admin/users/index/admin')?>"><?=lang('admins')?></a></li>

<li class="<?=($sub_sel=='moderator_main')?'active':''?>"><a href="<?=site_url('admin/users/index/moderator_main')?>">Главный модератор</a></li>
  <li class="<?=($sub_sel=='moderator')?'active':''?>"><a href="<?=site_url('admin/users/index/moderator')?>">Модератор</a></li>
  <li class="<?=($sub_sel=='region')?'active':''?>"><a href="<?=site_url('admin/users/index/region')?>">Пользователь (Область)</a></li>-->
  <?php 
  /*
   <!-- <li class="<?=($sub_sel=='insubscriber')?'active':''?>"><a href="<?=site_url('admin/users/index/insubscriber')?>">Подписчик</a></li>
  <li class="<?=($sub_sel=='fb_user')?'active':''?>"><a href="<?=site_url('admin/users/index/fb_user')?>">Facebook</a></li>
  <li class="<?=($sub_sel=='google_user')?'active':''?>"><a href="<?=site_url('admin/users/index/google_user')?>">Google+</a></li>-->
  <!--<li class="<?=($sub_sel=='informer')?'active':''?>"><a href="<?=site_url('admin/users/index/informer')?>">Модератор заявок</a></li>
  <li class="<?=($sub_sel=='press_informer')?'active':''?>"><a href="<?=site_url('admin/users/index/press_informer')?>">Пресс информер</a></li>-->
  <!--<li class="<?=($sub_sel=='resident')?'active':''?>"><a href="<?=site_url('admin/users/index/resident')?>">resident</a></li>
  <li class="<?=($sub_sel=='respondent')?'active':''?>"><a href="<?=site_url('admin/users/index/respondent')?>">Регион</a></li>-->
  */
  ?>
</ul>
<?/*php if($sub_sel == 'region'){
  $region = getOptionsData(array('group' => 'regions','limit'=>'14','status' => 'active'));
  foreach($region as $item){
    $reg[$item->id] = _t($item->title,'ru');
  }   
} */   
?>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th width="1%">ID</th>
    <!--  <th width="30"></th>-->
      <th width="65%"><?//=lang('name')?>ФИО</th>
      <th>Логин</th>
      <!--<th>Фамилия</th>
      <th><?=lang('email')?></th>
          <th>Логин</th>
          <th width="30">Подверждение email</th>
           <th width="1%">Подверждение телефона</th>-->
           <?php if($sub_sel == 'region'){?><th width="15%">Область</th><?php }?>
      <th width="10"><?=lang('status')?></th>
      <th><?=lang('actions')?></th>
    </tr>
  </thead>
  <tbody>
  	<? foreach($users as $user): ?>
	    <tr>
	      <td><?=$user->user_id?></td>
          
         <!-- <td><?php if($this->session->userdata('user_id') !== $user->user_id and $sub_sel !== 'insubscriber'){?><a href="<?=site_url('admin/chat/redirect/'.$this->session->userdata('user_id').'/'.$user->user_id)?>" class="btn btn-small">Начать чат</a><?php }?></td>-->
          
	    <!--  <td><?=$user->first_name?></td>-->
          <td><?=$user->fio?></td>
          <td><?=$user->username?></td>
	      <!--<td><?=$user->last_name?></td>
	      <td><?=$user->email?></td>
        <td><?=$user->username?></td>
       <td style="text-align: center;" <? if ($user->email_verified == '0'){ ?> class="red" <?php } else {?> class="no-red"<?php }?> ><? if ($user->email_verified == '0'){ ?><a style="text-align: center;" data-original-title="Не подвержден" data-placement="top" data-toggle="tooltip"><i class="icon icon-remove"></i></a>  <?php } else {?><a style="text-align: center;" data-placement="top" data-toggle="tooltip" data-original-title="Подвержден"> <i class="icon icon-ok"></i></a> <?php }?></td>
       <td style="text-align: center;" <? if ($user->phone_verified == '0'){ ?> class="red" <?php } else {?> class="no-red"<?php }?> ><? if ($user->phone_verified == '0'){ ?><a style="text-align: center;" data-original-title="Не подвержден" data-placement="top" data-toggle="tooltip"><i class="icon icon-remove"></i></a>  <?php } else {?><a style="text-align: center;" data-placement="top" data-toggle="tooltip" data-original-title="Подвержден"> <i class="icon icon-ok"></i></a> <?php }?></td>-->
       <?php if($sub_sel == 'region'){?><td><?=$reg[$user->region_id]?></td><?php }?>
	      <td>
			<? if($user->active == '1'): ?>
				<span class="label label-success"><?=lang('active')?></span>
			<? else: ?>
				<span class="label label-warning"><?=lang('inactive')?></span>
			<? endif; ?>
	      </td>
          
	      <td>
	      	<a href="<?=site_url('admin/users/save/'.$user->user_id)?>"><i class="icon-edit"></i><?=lang('edit')?></a> 
            <!--<?php if($user->user_type != 'admin'){?>| 
	      	<a href="<?=site_url('admin/users/delete/'.$user->user_id.'/'.$user->picture)?>" onclick="return cDelete();"><i class="icon-trash"></i><?=lang('delete')?></a>
        <?php }?>-->
	      </td>
	    </tr>
	<? endforeach; ?>
  </tbody>  
</table>
<?=form_close()?>