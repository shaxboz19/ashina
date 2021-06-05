<?php
/**
 * Created by PhpStorm.
 * User: nugzar
 * Update: OSG
 * Date: 11/01/16
 * Time: 18:58
 */
?>
<div class="handbook-chapter" data-id="<?= $id ?>">
    <div class="item handbook-chapter-title">
        <div class="info" style="padding-left: 12px">
            <div class="icon-move handle"></div>
            <div class="arrow icon-plus"></div>
            <a href="<?=site_url('admin/handbook/handbook_chapter/'. $id)?>"><?= $title_ru ?></a>
        </div>
    </div>
    <div class="handbook-sub-chapters">
        <?php
        foreach ($sub_chapters as $sub_chapter) {
            ?>
            <div class="item" data-id="<?= $sub_chapter['id'] ?>" data-href="<?= $sub_chapter['href'] ?>">
                <div class="info">
                    <div class="icon-move handle"></div>
                    <a href="<?=site_url('admin/handbook/handbook_sub_chapter/'. $sub_chapter['id'])?>"><?= $sub_chapter['title_ru'] ?></a>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>