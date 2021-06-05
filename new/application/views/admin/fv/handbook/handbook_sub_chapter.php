<?php
/**
 * Created by PhpStorm.
 * User: nugzar
 * Date: 11/01/16
 * Time: 18:34
 */
?>

<div class="row-fluid">
    <div class="span5">
        <div class="head">
            <div class="isw-list"></div>
            <h1><?= $this->lang->line('menu_handbook_sub_chapters') ?> <a class="btn btn-primary"
                           href="<?=site_url('admin/handbook/handbook_sub_chapter')?>"><?= $this->lang->line('button_add') ?></a></h1>
            <div class="clear"></div>
        </div>
        <div class="block-fluid table-sorting clearfix">
            <table cellpadding="0" cellspacing="0" width="100%" class="table tSortable3">
                <thead>
                <tr>
                    <th width="1%">id</th>
                    <th width="5%">Заголовок</th>
                    
                </tr>
                </thead>
                <tbody>
                <?php foreach ($sub_chapters as $item) { ?>
                    <tr>
                        <td>
                            <a href="<?=site_url('admin/handbook/handbook_sub_chapter/'. $item['id'])?>"><?= $item['id'] ?></a>
                        </td>
                        <td>
                            <a href="<?=site_url('admin/handbook/handbook_sub_chapter/'. $item['id'])?>">
                                <?php
                                if (isset($item['title_ru'])) {
                                    echo $item['title_ru'];
                                } else {
                                    echo $this->lang->line('menu_empty');
                                }
                                ?>
                            </a>
                        </td>
                        
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="clear"></div>


            <div class="row-form">
                <div class="span12">
                    <p align="center">
                        
                    </p>
                </div>

                <div class="clear"></div>
            </div>

        </div>
    </div>
    <div class="span6">
        <div class="head">
            <div class="isw-text_document"></div>
            <h1><?= $this->lang->line('menu_handbook_sub_chapter') ?></h1>
            <div class="clear"></div>
        </div>
        <div class="block">
            <form method="post">
                <input type="hidden" name="id" value="<?php if (isset($sub_chapter['id'])) echo $sub_chapter['id'] ?>">
                <input type="hidden" name="chapter_id" value="<?php if (isset($sub_chapter['chapter_id'])) echo $sub_chapter['chapter_id'] ?>">
                <input type="hidden" name="sort" value="<?php if (isset($sub_chapter['sort'])) echo $sub_chapter['sort'] ?>">
                <div class="row-form">
                    <div class="span3">
                        Ссылка <span style="color: red">*</span>
                    </div>
                    <div class="span9">
                        <input type="text" name="href" required
                               value="<?php if (isset($sub_chapter['href'])) echo $sub_chapter['href'] ?>">
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
                                    <?php if (isset($sub_chapter['chapter_id'])) {
                                        if ($sub_chapter['chapter_id'] == $chapter['id']) echo 'selected';
                                    }?>
                                ><?= $chapter['title_ru'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="row-form">
                    <div class="span3">
                        Заголовок (RU) <span style="color: red">*</span>
                    </div>
                    <div class="span9">
                        <input type="text" name="title_ru" required
                               value="<?php if (isset($sub_chapter['title_ru'])) echo $sub_chapter['title_ru'] ?>">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3">
                        Заголовок (UZ) <span style="color: red">*</span>
                    </div>
                    <div class="span9">
                        <input type="text" name="title_uz" required
                               value="<?php if (isset($sub_chapter['title_uz'])) echo $sub_chapter['title_uz'] ?>">
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3">
                        Контент (RU) <span style="color: red">*</span>
                    </div>
                    <div class="span9">
                        <textarea class="moxiecut" name="content_ru" required
                                  style="height: 600px;"><?php if (isset($sub_chapter['content_ru'])) echo $sub_chapter['content_ru'] ?></textarea>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3">
                        Контент (UZ) <span style="color: red">*</span>
                    </div>
                    <div class="span9">
                        <textarea class="moxiecut" name="content_uz" required
                                  style="height: 600px;"><?php if (isset($sub_chapter['content_uz'])) echo $sub_chapter['content_uz'] ?></textarea>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row-form">
                    <div class="span3"></div>
                    <div class="span9">
                        <button type="submit" class="btn btn-primary handbook-sub-chapter-save">
                            <?php
                            if (isset($sub_chapter['id'])) {
                                echo $this->lang->line('button_save');
                            } else {
                                echo $this->lang->line('button_add');
                            }
                            ?>
                        </button>
                        <?php if (isset($sub_chapter['id'])) { ?>
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
<?php if(@$sub_chapter['id']){?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Внимание!</h4>
            </div>
            <div class="modal-body">
                Данная операция удалит текущию страницу, без возможности восстановления.<br>
                Перед тем как продолжить убедитесь, что вы сохранили всю необхадимую информацию.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <a href="<?=site_url('admin/handbook/handbook_sub_chapter_delete/'. $sub_chapter['id'])?>" class="btn btn-danger" id="modal-do">Удалить</a>
            </div>
        </div>
    </div>
</div>
<?php }?>