<h2>Меню
    <a href="<?=site_url('admin/posts_u/save/'.$sel)?>" class="btn btn-primary pull-right" type="button">
        <i class="icon-plus-sign icon-white"></i>
        <span>Добавить</span>
    </a>
</h2>
<!--<div class="control-group">
    <div class="controls">
        <select id="category" name="category_id" class="input-xlarge focused">
            <option value=""><?=lang('all_categories')?></option>

                <?=cat_sort($categories,$category_id);?>
        </select>
    </div>
</div>-->

<div class="tab-content">
  <div class="tab-pane active" id="home">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th width="1%">#</th>
        <th width="1%">#</th>
        <th width="1%"></th>
        <th width="100"><?=lang('title')?></th>
         <th width="100"><?=lang('title')?> (eng)</th>
         <th width="100">Контент (eng)</th>
        <th width="190"><?=lang('category')?></th>
        <th width="1%">Под меню</th>
        
        <th width="1%"><?=lang('status')?></th>
        <th width="1%"></th>
      </tr>
    </thead>
    <tbody>
    	<? foreach($posts as $post): ?>
  	    <tr class="edit" url="<?=site_url("admin/posts_u/save/{$sel}/$post->id")?>">
  	        <td><?=$post->id?></td>
            <td><?=$post->sort_order?></td>
             <td style="text-align: center">
                <div class="btn-group">
                    <a href="<?=site_url('admin/category_u/index/'.$post->id)?>" class="btn btn-small btn-info">Под категории</a>
                </div>
            </td>
            <td><?=_t($post->title)?></td>
            <td><?php if (_t($post->title, 'en')){?> Есть <?php } else {?><strong>Нет</strong> <?php }?></td>
            <td><?php if (_t($post->content, 'en')){?> Есть <?php } else {?><strong>Нет</strong> <?php }?></td>
           <td><?=@$post->category_id?></td>
           
            <td> <?php if($post->as_menu == '1'): ?>
                    <span class="label label-success"><?=lang('active')?></span>
                <?else:?>
                    <span class="label label-fail"><?=lang('inactive')?></span>
                <?endif?></td>
          
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
<?php $this->load->view('admin/components/pagination'); ?>
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