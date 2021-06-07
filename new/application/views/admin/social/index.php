<h2>Соц. сети
    <a href="<?=site_url('admin/posts/save/'.$sel)?>" style="display: none;" class="btn btn-primary pull-right" type="button">
        <i class="icon-plus-sign icon-white"></i>
        <span>Добавить</span>
    </a>
</h2>

<?php 
/*
<!--<div class="control-group">
    <div class="controls">
        <select id="category" name="category_id" class="input-xlarge focused">
            <option value=""><?=lang('all_categories')?></option>
                <?=cat_sort($categories,$category_id);?>
        </select>
    </div>
</div>-->
*/

?>

<div class="tab-content">
  <div class="tab-pane active" id="home">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th width="1%">#</th>
        <th width="100"><?=lang('title')?></th>
        <!--<th width="190"><?=lang('category')?></th>
        <th width="1%"><?=lang('status')?></th>-->
        <th width="1%"></th>
      </tr>
    </thead>
    <tbody>
    	<? foreach($posts as $post): ?>
  	    <tr class="edit" url="<?=site_url("admin/posts/save/{$sel}/$post->id")?>">
  	        <td><?=$post->id?></td>
            <td><?=_t($post->title)?></td>
            <!--<td><?=_t($post->category,'ru')?></td>-->
           <!-- <td>
                <?php if($post->status == 'active'): ?>
                    <span class="label label-success"><?=lang('active')?></span>
                <?else:?>
                    <span class="label label-fail"><?=lang('inactive')?></span>
                <?endif?>
            </td>
            <td>
              <div class="btn-group">
                <a href="<?=site_url('admin/posts/delete/'.$post->id)?>" class="btn btn-small btn-danger delete"><i class="icon-trash icon-white"></i></a>
              </div>
            </td>-->
  	    </tr>
  	<? endforeach ?>
    </tbody>
  </table>

</div>
<?php $this->load->view('admin/components/pagination'); ?>
</div>