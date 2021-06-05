  <div class="tab-pane active" id="home">
  <table class="table table-striped table-bordered table-hover" id="list">
    <thead>
      <tr>
        <th width="100"><?//=lang('title')?>Наименование</th>
        <th width="1%"></th>          
        <th width="1%"><?=lang('status')?></th>
        <th width="1%"></th>                       
      </tr>
    </thead>
    <tbody >
      <? foreach($posts as $post): ?>        
            <tr id="item-<?=$post->id?>">
            <td><?=$post->title?></td>
                 <td>
              <div class="btn-group">
           <a href="<?=site_url("admin/certification/save/$post->id")?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i> Ред-ть</a>
              </div>
            </td>
             <td>
                <?if ($post->status == 'active'):?>
                    <span class="label label-success"><?=lang('active')?></span>
                <?else:?>
                    <span class="label label-fail"><?=lang('inactive')?></span>
                <?endif?>
            </td>
            <td>
                <div class="btn-group">
                    <a href="<?=site_url('admin/certification/delete/'.$post->id)?>" class="btn btn-small btn-danger delete"><i class="icon-trash icon-white"></i></a>
                </div>
            </td>
        </tr>
    <? endforeach ?>
    </tbody>
  </table>
</div>
<?php $this->load->view('admin/components/pagination'); ?>