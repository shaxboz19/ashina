<h2>Партнеры
    <a href="<?=site_url('admin/posts_u/save/'.$sel)?>" class="btn btn-primary pull-right" type="button">
        <i class="icon-plus-sign icon-white"></i>
        <span>Добавить</span>
    </a>
</h2>
<!--<div class="control-group">
    <div class="controls">
        <select id="category" name="category_id" class="input-xlarge focused">
            <option value=""><?=lang('all_categories')?></option>
                <?=cat_sort($categories,$id);?>
        </select>
    </div>
</div>-->

<div class="tab-content">
  <div class="tab-pane active" id="home">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th width="1%">#</th>
        <th width="1%">Фото</th>
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
            <td><img src="<?=base_url("thumb/view/w/100/h/80/src/uploads/partners/{$post->url}")?>" /></td>
            <td><?=_t($post->title)?></td>
           <!-- <td><?=$post->category?></td>-->
            <td>
               <?php if($post->status == 'active'): ?>
                    <span class="label label-success"><?=lang('active')?></span>
                <?else:?>
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