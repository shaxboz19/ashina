  <style>
  .table th, .table td{vertical-align: middle !important;}
  </style>
  
  <div class="tab-pane active" id="home">
  <table class="table table-striped table-bordered table-hover" id="list">
    <thead>
      <tr>
      <th width="1%"></th>
       <th width="1%">Номер заявки №</th>
        <th width="1%">Дата получения</th>
        <th width="7%">ФИО</th> 
        <th width="3%">Тип обращения</th>              
        <th width="2%"><?=lang('status')?></th>
        <th width="1%"></th>   
        <th width="1%"></th>          
      </tr>
    </thead>
    <tbody >
      <? foreach($posts as $post): ?>
      
            <tr id="item-<?=$post->id?>">
            <td></td>
            <td><?=$post->id?></td>
            <td><?=to_date("d.m.Y", $post->created_on)?></td>
            <td>
           <?=$post->last_name?>  <?=$post->first_name?>  <?=$post->middle_name?>
            </td>        
            <td>     
				<?=lang('v_'.$post->appeal_type)?>
            </td>            
            <td>     
				<?=lang('vs_'.$post->status)?>
            </td>
            <td>
             <div class="btn-group">
           <a href="<?=site_url("admin/virtual/save/".$post->id)?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i> Ред-ть</a>
              </div>
            </td>
            <td style="text-align: center;">
                
                <div class="btn-group">
                    <a href="<?=site_url('admin/virtual/delete/'.$post->id)?>" class="btn btn-small btn-danger delete"><i class="icon-trash icon-white"></i></a>
                </div>
               
            </td>
        </tr>
    <? endforeach ?>
    </tbody>
  </table>
</div>
<?php $this->load->view('admin/components/pagination'); ?>