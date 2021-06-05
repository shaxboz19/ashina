<style>
    .comment-main {
        padding: 25px;
    }

    .comment-main ul {
        list-style: none;
    }

    .comment-main ul li {
        margin-top: 15px;
    }

    .comment-main ul li .comment-left {
        width: 40%;
        background-color: #d2d2d2;
        padding: 15px;
        border-radius: 5px;
    }

    .comment-main ul li .comment-left span {
        margin-right: 15px;
        background-color: #fff;
    }
    .comment-main ul li .comment-actions{
        text-align: right;
        margin-top: 15px;
    }
</style>
<?php  $us=$this->session->userdata('user_id');?>
<div class="comment-main">
    <h5><?= _t($project->title, 'ru') ?></h5>
    <ul>
        <?php foreach ($comments as $item) { ?>
            <li>
                <div class="comment-left" style="<?=($item->user_id == $us) ? 'float: right;' : '' ?>">
                    <span>
                        <?= getUserNameComment($item->user_id) ?>:
                    </span>
                    <?= $item->comment_text ?>
                    <div class="comment-actions">
                        <a href="<?=site_url("admin/comments/delete/{$item->comment_id}")?>" class="btn btn-danger btn-small">Удалить</a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </li>
        <?php } ?>
    </ul>
    <?= form_open(site_url("admin/comments/save/{$project->id}")) ?>
    <div class="form-group">
        <label for="comment">Comment:</label>
        <textarea class="form-control" rows="5" id="comment" name="comment_text"></textarea>
        <button class="btn btn-info pull-right mt-3" type="submit">Сохранить</button>
    </div>
    </form>
</div>
<div class="clearfix"></div>