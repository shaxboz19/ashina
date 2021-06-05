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
        <div class="">
            <div class="isw-list"></div>
            <h1><?= $this->lang->line('menu_handbook_test') ?> <a class="btn btn-primary"
                           href="<?=site_url('admin/handbook/handbook_test')?>"><?= $this->lang->line('button_add') ?></a></h1>
            <div class="clear"></div>
        </div>
        <div class="block-fluid table-sorting clearfix">
            <table cellpadding="0" cellspacing="0" width="100%" class="table tSortable3">
                <thead>
                <tr>
                    <th width="8%">id</th>
                    <th width="">Заголовок</th>
                    <th >id Раздела</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tests as $item) { ?>
                    <tr>
                        <td>
                            <a href="<?=site_url('admin/handbook/handbook_test/'. $item['id'])?>"><?= $item['id'] ?></a>
                        </td>
                        <td>
                            <a href="<?=site_url('admin/handbook/handbook_test/'. $item['id'])?>">
                                <?php
                                if (isset($item['title_ru'])) {
                                    echo $item['title_ru'];
                                } else {
                                    echo $this->lang->line('menu_empty');
                                }
                                ?>
                            </a>
                        </td>
                        <td><?= $item['chapter_id'] ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="clear"></div>



        </div>
    </div>
    <div class="span5">
        <div>
            
            <h1><?= $this->lang->line('menu_handbook_test_data') ?></h1>
            <div class="clear"></div>
        </div>
        <div class="block">
            <form method="post">
                <input type="hidden" name="id" value="<?php if (isset($test['id'])) echo $test['id'] ?>">

                <div class="row-form">
                    <div class="span3">
                        Заголовок (RU)
                    </div>
                    <div class="span9">
                        <input type="text" name="title_ru"
                               value="<?php if (isset($test['title_ru'])) echo $test['title_ru'] ?>">
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="row-form">
                    <div class="span3">
                        Заголовок (UZ)
                    </div>
                    <div class="span9">
                        <input type="text" name="title_uz"
                               value="<?php if (isset($test['title_uz'])) echo $test['title_uz'] ?>">
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="row-form">
                    <div class="span3">
                        Раздел <span style="color: red">*</span>
                    </div>
                    <div class="span9">
                        <select name="chapter_id" required>
                            <?php foreach ($chapters as $chapter) { ?>
                                <option value="<?= $chapter['id'] ?>"
                                    <?php if (isset($test['chapter_id'])) {
                                        if ($test['chapter_id'] == $chapter['id']) echo 'selected';
                                    }?>
                                ><?= $chapter['title_ru'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="row-form">
                    <div class="span3">
                        Изображение
                    </div>
                    <div class="span9">
                        <input type="text" name="image"
                               value="<?php if (isset($test['image'])) echo $test['image'] ?>">
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
                Данная операция удалит <strong>текущий тест и все ответы</strong>, с ним связанные, без возможности восстановления.<br>
                Перед тем как продолжить убедитесь, что вы переместили все нужные ответы в другие тесты и сохранили всю необхадимую информацию.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <a href="<?=site_url('admin/handbook/handbook_test_delete/'. $chapter['id'])?>" class="btn btn-danger" id="modal-do">Удалить</a>
            </div>
        </div>
    </div>
</div>
<?php }?>