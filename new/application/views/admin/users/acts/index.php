<h2>Нормативно-правовые акты
    <a href="<?=site_url('admin/posts_u/save/'.$sel)?>" class="btn btn-primary pull-right" type="button">
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
        <!--<th width="1%"></th>-->
        <th width="100"><?=lang('title')?></th>
        <!--<th width="190"><?=lang('category')?></th>-->
        
        <th width="1%"><?=lang('status')?></th>
        <th width="1%"></th>
      </tr>
    </thead>
    <tbody>
    	<? foreach($posts as $post): ?>
  	    <tr class="edit" url="<?=site_url("admin/posts_u/save/{$sel}/$post->id")?>">
  	        <td><?=$post->id?></td>
             <!--<td style="text-align: center">
                <div class="btn-group">
                    <a href="<?=site_url('admin/category/index/'.$post->id)?>" class="btn btn-small btn-info">Под категории</a>
                </div>
            </td>-->
            <td><?=char_lim(_t($post->title), 150)?></td>
           <!--<td><?=@$post->category_id?></td>-->
          
            <td>
               <?php if($post->status == 'active'): ?>
                    <span class="label label-success"><?=lang('active')?></span>
                <?else:?>
                    <span class="label label-fail"><?=lang('inactive')?></span>
                <?endif?>
            </td>
            <td>
              <div class="btn-group">
                <a href="<?=site_url('admin/posts_u/delete/'.$post->id)?>" class="btn btn-small btn-danger delete" title="Удалить"><i class="icon-trash icon-white"></i></a>
              </div>
            </td>
  	    </tr>
  	<? endforeach ?>
    </tbody>
  </table>

</div>