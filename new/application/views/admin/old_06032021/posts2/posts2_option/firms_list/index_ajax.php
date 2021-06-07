  <div class="tab-pane active" id="home">
  <table class="table table-striped table-bordered table-hover" id="list">
    <thead>
      <tr>
        <th width="1%">#</th>
        <th width="1%"></th>
        <th width="1%"></th>
		 <th width="1%"></th>
        <th width="100"><?=lang('title')?></th>
        <th width="1%"></th>
                 
        <th width="1%"><?=lang('status')?></th>
        <th width="1%"></th>                       
      </tr>
    </thead>
    <tbody >
      <? foreach($posts as $post): ?>        

            <tr id="item-<?=$post->id?>">
    
			<td></td>
            <td><?=$post->id?></td>
                 <td>

              <div class="btn-group">

                <form action="<?=site_url("admin/posts2/sort_order_posts")?>" method="post" style="margin-bottom: -10px;">

                <input type="text" name="sort_order" style="width: 45px;" value="<?=set_value('sort_order', $post->sort_order)?>" /> 

                <input type="hidden" name="id" value="<?=$post->id;?>" /> 

                      <button type="submit" class="btn" style="margin-top: -11px;
">Сохранить</button>          

                </form>

              </div>

            </td>
			<td>
				<div class="btn-group">
           <a href="<?=site_url("admin/posts2_option/index/firms/$post->id")?>" class="btn btn-small btn-info"> Сотрудники</a>
              </div>
			</td>
            <?php /*if(_t($post->title, 'uz')){
                    $lang = 'uz';
                }elseif(_t($post->title, 'ru')){*/
                    $lang = 'ru';
               /* }elseif(_t($post->title, 'oz')){
                    $lang = 'oz';
                }elseif(_t($post->title, 'en')){
                    $lang = 'en';
                }else{
                  $lang = 'uz';  
                }*/
                ?>
            <td><?=char_lim(_t($post->title, $lang), 90)?></td>
                 <td>
              <div class="btn-group">
               
		<?php if(isset($_GET['page'])){
            $page = $_GET['page'];            
        ?>  	
                <a href="<?=site_url("admin/posts2_option/save/$category_group/$category_id/$post->id/$page")?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i> Ред-ть</a>
                <?php } else {?>
           <a href="<?=site_url("admin/posts2_option/save/$category_group/$category_id/$post->id")?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i> Ред-ть</a>
        <?php }?>
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
                            <!--<div class="btn-group">
                                <a href="<?=site_url('admin/posts2/delete/'.$post->id)?>" class="btn btn-small btn-danger delete"><i class="icon-trash icon-white"></i></a>
                            </div>-->
                        </td>
        </tr>
    <? endforeach ?>
    </tbody>
  </table>
</div>
<?php $this->load->view('admin/components/pagination'); ?>
