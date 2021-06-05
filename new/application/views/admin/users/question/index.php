<h2>Вопросы  
    <a href="<?=site_url('admin/posts_u/save/'.$sel_users)?>" class="btn btn-primary pull-right" type="button">
        <i class="icon-plus-sign icon-white"></i> 
        <span>Добавить</span>
    </a>
</h2>
<p>Непроверенных вопросов: <?=count_question_inactive();?></p>
<div class="tab-content">
  <div class="tab-pane active" id="home">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
      <th width="8%" class="cnt">#</th>
        <th width="8%" class="cnt">ID User</th>
        <th width="190"><?=lang('title')?></th>       
        <th width="8%" class="cnt"><?=lang('status')?></th>
        <th width="8%" class="cnt"></th>       
        <th width="8%" class="cnt">Одобрено</th>
        <th width="8%" class="cnt">Просмотрено</th>        
        <th width="1%"></th>
      </tr>
    </thead>
    <tbody>
    	<? foreach($posts as $post): ?>
  	    <tr class="edit" url="<?=site_url("admin/posts_u/save/{$sel_users}/$post->id")?>">
        <td class="cnt"><?=$post->id?></td>
            <td class="cnt">
            <div class="btn-group">
                <a href="<?=site_url('admin/users/profile/'.$post->user_id)?>" class="btn btn-small">Профиль</a>
              </div> 
            </td>
            <td><?=char_lim(_t($post->title), 100)?></td>          
            <td class="cnt">
                <?php if($post->status == 'active'): ?>
                    <span class="label label-success"><?=lang('active')?></span>
                <?else:?>
                    <span class="label label-fail"><?=lang('inactive')?></span>
                <?endif?>
            </td>
            <td class="cnt">
            <div class="btn-group">
                <a href="<?=site_url('admin/comments/view/'.$post->id)?>" class="btn btn-small" title="Непроверенных: <?=count_comments_inactive($post->id)?> ">Комментарии</a>
              </div> 
            </td>
            
            <td class="cnt">
                <?php if($post->approved == 'active'): ?>
                    <span class="label label-success"><?=lang('active')?></span>
                <?else:?>
                    <span class="label label-fail"><?=lang('inactive')?></span>
                <?endif?>
            </td>
            <td class="cnt">
                <?php if($post->new_add == 'yes'): ?>
                   
                     <span class="label label-fail">Нет</span>
                <?else:?>
                    <span class="label label-success">Да</span>
                <?endif?>
            </td>
            
            <td>
              <div class="btn-group">
                <a href="<?=site_url('admin/posts_u/delete/'.$post->id)?>" class="btn btn-small btn-danger delete"><i class="icon-trash icon-white"></i></a>
              </div> 
              
            </td>
  	    </tr>
  	<? endforeach ?>
    </tbody>
  </table>
<?php $this->load->view('admin/components/pagination'); ?>
</div>