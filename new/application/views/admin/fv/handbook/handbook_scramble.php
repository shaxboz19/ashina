<?php
/**
 * Created by PhpStorm.
 * User: nugzar
 * Date: 11/01/16
 * Time: 18:34
 */
?>


<div class="row-fluid">
    <div class="span7">
        <div class="head">
            <div class="isw-list"></div>
            <h1><?= $this->lang->line('menu_handbook_list') ?> <a class="btn btn-primary"
                           href="<?=site_url('admin/handbook/handbook_scramble')?>"><?= $this->lang->line('button_add') ?></a></h1>
            <div class="clear"></div>
        </div>
        <div class="block-fluid table-sorting clearfix">
            <table cellpadding="0" cellspacing="0" width="100%" class="table tSortable3">
                <thead>
                <tr>
                    <th width="5%">№</th>
                    <th width="">Заголовок</th>
                    <th class="hidden"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($words as $item) { ?>
                    <tr>
                        <td>
                            <a href="<?=site_url('admin/handbook/handbook_scramble/'. $item['id'])?>"><?= $item['id'] ?></a>
                        </td>
                        <td>
                            <a href="<?=site_url('admin/handbook/handbook_scramble/'. $item['id'])?>">
                                <?php
                                if (isset($item['title_ru'])) {
                                    echo $item['title_ru'];
                                } else {
                                    echo $this->lang->line('menu_empty');
                                }
                                ?>
                            </a>
                        </td>
                        <td class="hidden">a</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="clear"></div>

        </div>
    </div>
    <div class="span5">
        <div class="head">
            <span class="isw-" style="color: white; font-size: 22px; padding: 9px 0 13px 1px; width: 15px;">A</span>
            <h1><?= $this->lang->line('menu_handbook_scramble_data') ?></h1>
            <div class="clear"></div>
        </div>
        <div class="block">
            <form method="post">
                <input type="hidden" name="id" value="<?php if (isset($word['id'])) echo $word['id'] ?>">

                <div class="row-form">
                    <div class="span3">
                        Заголовок (RU) <span style="color: red">*</span>
                    </div>
                    <div class="span9">
                        <input type="text" name="title_ru" required
                               value="<?php if (isset($word['title_ru'])) echo $word['title_ru'] ?>">
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="row-form">
                    <div class="span3">
                        Заголовок (UZ) <span style="color: red">*</span>
                    </div>
                    <div class="span9">
                        <input type="text" name="title_uz" required
                               value="<?php if (isset($word['title_uz'])) echo $word['title_uz'] ?>">
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="row-form">
                    <div class="span3"></div>
                    <div class="span9">
                        <button type="submit" class="btn btn-primary handbook-chapter-save">
                            <?php
                            if (isset($word['id'])) {
                                echo $this->lang->line('button_save');
                            } else {
                                echo $this->lang->line('button_add');
                            }
                            ?>
                        </button>
                        <?php if (isset($word['id'])) { ?>
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
<?php if(@$word['id']){?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Внимание!</h4>
            </div>
            <div class="modal-body">
                Данная операция удалит текущий ответ, без возможности восстановления.<br>
                Перед тем как продолжить убедитесь, что вы сохранили всю необхадимую информацию.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <a href="<?=site_url('admin/handbook/handbook_scramble_delete/'. $word['id'])?>" class="btn btn-danger" id="modal-do">Удалить</a>
            </div>
        </div>
    </div>
</div>
<?php }?>