<h2> Список действующих адвокатских бюро, коллегий, фирм и адвокатов (Регионы)
</h2>

<?php 
/*
<!--<div class="pull-left" style="margin-top: 14px;">
    <?php echo form_open_multipart('admin/posts2/import_new2'); ?>
    <input type="file" name="userfile" style="float: left;line-height: 10px;margin-top: 6px;" value="">
    <?php echo form_submit('submit', 'Импорт', 'class="btn btn-primary"') ?>
    <?php echo form_close(); ?>
</div>-->
*/
?>
<?//php $this->load->view('admin/components/filter_posts'); ?>
<div class="clearfix"></div>
<div class="tab-content" id="ajax">
  <div class="tab-pane active" id="home">
  <table class="table table-striped table-bordered table-hover" id="list">
    <thead>
      <tr>
        <th width="1%"></th> 
         <th width="1%"></th>  
        <th width="100"><?//=lang('title')?>Регион</th>
                     
      </tr>
    </thead>
    <tbody >
      <? foreach($posts as $post): ?>        
            <tr>
            <td></td>
            <td>
              <div class="btn-group">
           <a href="<?=site_url("admin/posts2_option/index/$sel_group/$post->id_regions/region")?>" class="btn btn-small btn-info"> Список</a>
              </div>
            </td>
            <td><?=_t($post->title)?></td>
           
        </tr>
    <? endforeach ?>
    </tbody>
  </table>
</div>
</div>