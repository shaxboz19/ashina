<h2>Новости
    <a href="<?=site_url('admin/posts_u/save/'.$sel)?>" class="btn btn-primary pull-right" type="button">
        <i class="icon-plus-sign icon-white"></i> Добавить
    </a>
</h2>

<div class="tab-content">
  <div class="tab-pane active" id="home">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th width="1%">#</th>
        <th width="85%"><?=lang('title')?></th>
       <!-- <th width="12%" class="cnt">Дата создания</th>-->
        <th width="1%"><?=lang('status')?></th>
        <th width="1%"></th>
      </tr>
    </thead>
    <tbody>
    	<? foreach($posts as $post): ?>
  	    <tr class="edit" url="<?=site_url("admin/posts_u/save/{$sel}/$post->id")?>">
  	        <td><?=$post->id?></td>
            <td><?=_t($post->title)?></td>
            <!--<td class="cnt"><?=to_date('d/m/Y', $post->created_on)?></td>-->
           <!--<td style="text-align: center">
                <div class="btn-group">
                    <a href="<?=site_url('admin/category/index/'.$post->id)?>" class="btn btn-small btn-info"> Ракат</a>
                </div>
            </td>  -->          
            <td>
                <? if ($post->status == 'active'): ?>
                    <span class="label label-success"><?=lang('active')?></span>
                <? else: ?>
                    <span class="label label-fail"><?=lang('inactive')?></span>
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

</div>
<?php $this->load->view('admin/components/pagination'); ?>
<script type="text/javascript">

$('#category').change(function(){
      location.href = '<?=base_url()?>admin/news/index/' + $(this).val();
});

$('#img').change(function(){
var news_id = $('#img').attr('newsId');
$("#img_form").ajaxSubmit({
  url: 'news/imageUpload/'+news_id,
  type: 'post'
})

});

</script>