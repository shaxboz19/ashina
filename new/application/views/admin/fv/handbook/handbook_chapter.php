<?php
/**
 * Created by PhpStorm.
 * User: nugzar
 * Update: OSG
 * Date: 11/01/16
 * Time: 18:33
 */
?>


<div class="row-fluid">
    <div class="span5">
        <div class="head">
            <div class="isw-list"></div>
            <h1><?= $this->lang->line('menu_handbook_chapters') ?> <a class="btn btn-primary"
                           href="<?=site_url('admin/handbook/handbook_chapter')?>"><?= $this->lang->line('button_add') ?></a></h1>
            <div class="clear"></div>
             

        </div>
        <div class="block-fluid table-sorting clearfix">
            <table cellpadding="0" cellspacing="0" width="100%" class="table tSortable3">
                <thead>
                <tr>
                    <th width="5%">id</th>
                    <th width="">Иконка&nbsp;&nbsp;</th>
                    <th width="">Заголовок</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($chapters as $item) { ?>
                    <tr>
                        <td>
                            <a href="<?=site_url('admin/handbook/handbook_chapter/'. $item['id'])?>"><?= $item['id'] ?></a>
                        </td>
                        <td>
                            <span class="hidden"><?= $item['icon'] ?></span>
                            <a href="<?=site_url('admin/handbook/handbook_chapter/'. $item['id'])?>">
                                <img style="background: #335A85; border-radius: 50%;"
                                     src="<?=base_url()?><?= $item['icon'] ?>"></a>
                            </a>
                        </td>
                        <td>
                            <a href="<?=site_url('admin/handbook/handbook_chapter/'. $item['id'])?>"><?= $item['title_ru'] ?></a>
                        </td>

                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="clear"></div>


       

        </div>
    </div>
    <div class="span6">
        <div class="head">
            <div class="isw-folder"></div>
            <h1><?= $this->lang->line('menu_handbook_chapter') ?></h1>
            <div class="clear"></div>
        </div>
        <div class="block">
            <form method="post">
                <input type="hidden" name="id" value="<?php if (isset($chapter['id'])) echo $chapter['id'] ?>">
                <div class="row-form">
                    <div class="span3">
                        Заголовок (RU) <span style="color: red">*</span>
                    </div>
                    <div class="span9">
                        <input type="text" name="title_ru" required
                               value="<?php if (isset($chapter['title_ru'])) echo $chapter['title_ru'] ?>">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3">
                        Заголовок (UZ) <span style="color: red">*</span>
                    </div>
                    <div class="span9">
                        <input type="text" name="title_uz" required
                               value="<?php if (isset($chapter['title_uz'])) echo $chapter['title_uz'] ?>">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3">
                        Иконка <span style="color: red">*</span>
                    </div>
                    <div class="span9">
                        <input type="text" name="icon" required
                               value="<?php if (isset($chapter['icon'])) echo $chapter['icon'] ?>">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3"></div>
                    <div class="span9">
                        <button type="submit" class="btn btn-primary handbook-chapter-save">
                            <?php
                            if (isset($chapter['id'])) {
                                echo $this->lang->line('button_save');
                            } else {
                                echo $this->lang->line('button_add');
                            }
                            ?>
                        </button>
                        <?php if (isset($chapter['id'])) { ?>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                                <?= $this->lang->line('button_delete') ?>
                            </button>
                        <?php } ?>
                    </div>
                    <div class="clear"></div>
                </div>
            </form>

        </div>
    </div>
    <div class="clear"></div>
</div>
<?php if(@$chapter['id']){?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Внимание!</h4>
            </div>
            <div class="modal-body">
                Данная операция удалит <strong>текущий раздел и все страницы</strong>, с ним связанные, без возможности восстановления.<br>
                Перед тем как продолжить убедитесь, что вы переместили все нужные страницы в другие разделы и сохранили всю необхадимую информацию.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <a href="<?=site_url('admin/handbook/handbook_chapter_delete/'. $chapter['id'])?>" class="btn btn-danger" id="modal-do">Удалить</a>
            </div>
        </div>
    </div>
</div>
<?php }?>