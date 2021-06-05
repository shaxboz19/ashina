<?php
/**
 * Created by PhpStorm.
 * User: nugzar
 * Update: OSG
 * Date: 11/01/16
 * Time: 18:30
 */
?>

<style>
    .handbook-chapter.place {
        height: 32px;
    }

    .users .item:last-child {
        border-bottom: 1px solid #E4E8ED;
    }
    .users {
        padding-bottom: 0;
    }
    .handbook-sub-chapters {
        min-height: 32px;
    }
    .users .item {
    clear: both;
    border-bottom: 1px solid #E4E8ED;
    padding: 8px 10px;
    position: relative;
    cursor: pointer;
}
</style>
<?php /*
<script>
    console.log(<?= json_encode($chapters) ?>)
</script>
*/ ?>
<div class="">
    <div class="isw-list"></div>
    <h1><?= $this->lang->line('menu_handbook_sort') ?></h1>
    <div class="clear"></div>
</div>

<div class="block users">
    <button style="margin-left: 12px" class="btn btn-primary handbook-sort-save">
        <?= $this->lang->line('button_save') ?>
    </button>
    <div class="handbook-sort">
        <?php
        if (isset($chapters)) {
            foreach ($chapters as $chapter) {
                echo load_view('admin/fvv/handbook/handbook_sort_item', $chapter);
            }
        }
        ?>
    </div>
</div>


<script>
    $(function () {

        $('.handbook-sort')
            .on('click', '.handbook-chapter-title .arrow', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $(this)
                //                .find('.arrow')
                    .toggleClass('icon-plus icon-minus')
                    .parents('.handbook-chapter-title').next('.handbook-sub-chapters').toggle();

            })
            .sortable({
                handle: '.handle',
                placeholder: "handbook-chapter item place"
            })
            .disableSelection();

        $('.handbook-sub-chapters')
            .sortable({
                handle: '.handle',
                connectWith: '.handbook-sub-chapters',
                placeholder: "handbook-chapter item place"
            })
            .disableSelection()
            .hide();

        $('.handbook-sort-save').click(function (e) {
            e.preventDefault();
            var chapters = [];
            var sub_chapters = [];
            $('.handbook-sort .handbook-chapter').each(function (key, $chapter) {
                var chapter = {
                    'id': $($chapter).attr('data-id'),
                    'sort': key
                };

                chapters.push(chapter);

                $($chapter).find('.handbook-sub-chapters .item').each(function (key, $sub_chapter) {
                    var sub_chapter = {
                        'id': $($sub_chapter).attr('data-id'),
                        'chapter_id': chapter.id,
                        'sort': key
                    };

                    if (key == 0) {
                        chapter.href = $($sub_chapter).attr('data-href');
                    }

                    sub_chapters.push(sub_chapter);
                });

            });

            $.ajax({
                url: "<?=site_url('admin/handbook/handbook_sort_save')?>",
                type: 'POST',
                data: {'chapters': chapters, 'sub_chapters': sub_chapters},
                complete: function (response) {
                    console.log(response);
                    if (response.status == 200 && response.readyState == 4) {
                        $('#myModal .modal-body').text('success');
                        $('#myModal').modal();
                    } else {
                        $('#myModal .modal-body').text('error');
                        $('#myModal').modal();
                    }
                }
            });
        })
    })
</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Response</h4>
            </div>
            <div class="modal-body">
                error
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>