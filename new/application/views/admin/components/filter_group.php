
   <div class="text-center">
            <div class="list-group list-group-horizontal"> 
<a href="?sort=DESC" class="list-group-item <?php if(@$_GET['sort'] == 'DESC'){?>active-list<?php }?>" >Сортировка по убыванию</a>
<a href="?sort=ASC" class="list-group-item <?php if(@$_GET['sort'] == 'ASC'){?>active-list<?php }?>" style="    margin-left: 6px;">Сортировка по возрастанию</a>
<?php if(@$_GET['sort']){?>
<a href="<?=site_url("admin/group/index/$category_group/$category_id/")?>" class="list-group-item" style="    margin-left: 6px;"> Очистить фильтр</a>
<?php }?>
            </div> 
        </div>