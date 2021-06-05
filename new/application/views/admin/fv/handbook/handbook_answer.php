<?php
/**
 * Created by PhpStorm.
 * User: nugzar
 * Date: 11/01/16
 * Time: 18:34
 */
?>

<script>
    if (!window.unicef) {
        window.unicef = {}
    }
    //    window.unicef.chapters = <?//= json_encode($chapters) ?>//;
    //    window.unicef.tests = <?//= $tests ?>//;
    //    window.unicef.answer = <?//= $answer ?>//;

    $(function () {
        $('#chapter').on('change', function (e) {
            var chapterId = $(this).val();

            $('#test_id').prop("selectedIndex", 0)
                .find('option[data-chapter-id]').hide().removeAttr("selected")
                .filter('[data-chapter-id=' + chapterId + ']').show();
        })
    })
</script>

<div class="row-fluid">
    <div class="span7">
        <div class="">
            <h1><?= $this->lang->line('menu_handbook_answer') ?> <a class="btn btn-primary"
                           href="<?=site_url('admin/handbook/handbook_answer')?>"><?= $this->lang->line('button_add') ?></a></h1>
            <div class="clear"></div>
        </div>
        <div class="block-fluid table-sorting clearfix">
            <table cellpadding="0" cellspacing="0" width="100%" class="table tSortable3">
                <thead>
                <tr>
                    <th width="5%">id</th>
                    <th >Заголовок</th>
                    <th>id Теста</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($answers as $item) { ?>
                    <tr>
                        <td>
                            <a href="<?=site_url('admin/handbook/handbook_answer/'. $item['id'])?>"><?= $item['id'] ?></a>
                        </td>
                        <td>
                            <a href="<?=site_url('admin/handbook/handbook_answer/'. $item['id'])?>">
                                <?php
                                if (isset($item['title_ru'])) {
                                    echo $item['title_ru'];
                                } else {
                                    echo $this->lang->line('menu_empty');
                                }
                                ?>
                            </a>
                        </td>
                        <td>
                            <?= $item['test_id'] ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="clear"></div>
        </div>
    </div>
    <div class="span5">
        <div class="head">
            <span class="isw-" style="color: white; font-size: 22px; padding: 9px 0 13px 1px; width: 15px;">?</span>
            <h1><?= $this->lang->line('menu_handbook_answer_data') ?></h1>
            <div class="clear"></div>
        </div>
        <div class="block">
            <form method="post">
                <input type="hidden" name="id" value="<?php if (isset($answer['id'])) echo $answer['id'] ?>">

                <div class="row-form">
                    <div class="span3">
                        Заголовок (RU)
                    </div>
                    <div class="span9">
                        <input type="text" name="title_ru"
                               value="<?php if (isset($answer['title_ru'])) echo $answer['title_ru'] ?>">
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="row-form">
                    <div class="span3">
                        Заголовок (UZ)
                    </div>
                    <div class="span9">
                        <input type="text" name="title_uz"
                               value="<?php if (isset($answer['title_uz'])) echo $answer['title_uz'] ?>">
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="row-form">
                    <div class="span3">
                        Раздел <span style="color: red">*</span>
                    </div>
                    <div class="span9">
                        <select id="chapter" required>
                            <option value="">Выберите Раздел</option>
                            <?php foreach ($chapters as $chapter) { ?>
                                <option value="<?= $chapter['id'] ?>"
                                    <?php if (isset($test['chapter_id'])) {
                                        if ($test['chapter_id'] == $chapter['id']) echo 'selected';
                                    } ?>
                                ><?= $chapter['title_ru'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="row-form">
                    <div class="span3">
                        Тест <span style="color: red">*</span>
                    </div>
                    <div class="span9">
                        <select name="test_id" id="test_id" required>
                            <option value="">Выберите тест</option>
                            <?php foreach ($tests as $test_item) { ?>
                                <option value="<?= $test_item['id'] ?>"
                                        data-chapter-id="<?= $test_item['chapter_id'] ?>"
                                    <?php if (
                                        !isset($test_item['chapter_id']) ||
                                        !isset($test['chapter_id']) ||
                                        $test_item['chapter_id'] != $test['chapter_id']
                                    ) { ?>
                                        style="display: none;"
                                    <?php } ?>
                                    <?php if (isset($answer['test_id'])) {
                                        if ($answer['test_id'] == $test_item['id']) echo 'selected';
                                    } ?>
                                ><?= $test_item['title_ru'] ?></option>
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
                               value="<?php if (isset($answer['image'])) echo $answer['image'] ?>">
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="row-form">
                    <div class="span3">
                        Верный
                    </div>
                    <div class="span9">
                        <input type="checkbox"
                               name="correct" <?php if (isset($answer['correct']) && $answer['correct']) echo 'checked' ?>>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="row-form">
                    <div class="span3"></div>
                    <div class="span9">
                        <button type="submit" class="btn btn-primary handbook-chapter-save">
                            <?php
                            if (isset($answer['id'])) {
                                echo $this->lang->line('button_save');
                            } else {
                                echo $this->lang->line('button_add');
                            }
                            ?>
                        </button>
                        <?php if (isset($answer['id'])) { ?>
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
<?php if(@$answer['id']){?>
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
                <a href="<?=site_url('admin/handbook/handbook_answer_delete/'. $answer['id'])?>"
                   class="btn btn-danger" id="modal-do">Удалить</a>
            </div>
        </div>
    </div>
</div>
<?php }?>