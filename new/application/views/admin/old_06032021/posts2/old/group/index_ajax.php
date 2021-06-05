  <style>
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
      padding: 8px;
      line-height: 1.42857143;
      vertical-align: middle;
      border-top: 1px solid #ddd;
    }
  </style>
  <div class="tab-pane active" id="home">
    <table class="table table-striped table-bordered table-hover" id="list">
      <thead>
        <tr>
          <th width="1%">#</th>
          <?php if ($sel != 'docs') { ?>
            <th width="5%"></th>
          <?php } ?>
          <th width="1%"></th>
          <th width="1%"></th>

          <?php
          if ($sel == 'docs') { ?>
            <th width="2%">Язык</th>
          <?php } ?>
          <?php
          // Города
          if ($sel == 'specialties') { ?>
            <th width="1%"></th>
          <?php } ?>
          <?php if ($sel == 'projects_cat') { ?>
            <th width="1%"><!--Комментарии--></th>
          <?php } ?>
          <th width="100"><?= lang('title') ?></th>
          <th width="1%"></th>
          <th width="1%"><?= lang('status') ?></th>
          <th width="1%"></th>

        </tr>
      </thead>
      <tbody>
        <? foreach ($posts as $post) : ?>

          <tr id="item-<?= $post->id ?>">


            <td><?= $post->id ?></td>
            <?php if ($sel != 'docs') { ?>
              <td style="text-align: center;"><?php if ($post->url) { ?><a href="<?= base_url("uploads/{$post->group}/{$post->url}") ?>" class="fancybox" rel="gallery"><img src="<?= base_url("thumb/view/w/50/h/50/src/uploads/{$post->group}/{$post->url}") ?>" /></a><?php } else { ?> Нет фото<?php } ?></td>
            <?php } ?>
            <td><a class="btn btn-mini move" href="#" title="Перемещать"><i class="fa fa-arrows"></i></a></td>
            <td>

              <div class="btn-group">

                <form action="<?= site_url("admin/posts2/sort_order_posts") ?>" method="post" style="margin-bottom: -10px;">

                  <input type="text" name="sort_order" style="width: 45px;" value="<?= set_value('sort_order', $post->sort_order) ?>" />

                  <input type="hidden" name="id" value="<?= $post->id; ?>" />

                  <button type="submit" class="btn" style="margin-left: 6px;margin-top: -11px;">Сохранить</button>

                </form>

              </div>
              <? if ($post->status_meta == 'active') : ?>
                <div class="btn-group">
                  <a href="<?= site_url('admin/post_meta/index/' . $category_group . '/' . $post->id) ?>" class="btn btn-small btn-info"> Опции</a>
                </div>
              <? endif; ?>

            </td>
            <?php if ($sel == 'projects_cat') { ?>
              <td><!--<a class="btn btn-small btn-info" href="<?= site_url("admin/comments/show/{$post->id}/{$post->category_id}") ?>"><i class="fa fa-comments"></i>Комментарии</a>--></td>
            <?php } ?>
            <?php
              if ($sel == 'docs') { ?>
              <td style="text-align: center">

                <?= $post->lang_status; ?>

              </td>
            <?php } ?>

            <?php
              // Города
              if ($sel == 'specialties') { ?>
              <td style="text-align: center">
                <div class="btn-group">
                  <a href="<?= site_url('admin/group2/index/specialists/' . $post->id) ?>" class="btn btn-small btn-info"> Врачи</a>
                </div>
              </td>
            <?php } ?>
            <td><?= char_lim(_t($post->title), 90) ?></td>
            <td>
              <div class="btn-group">
                <?php if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    ?>
                  <a href="<?= site_url("admin/group2/save/$category_group/$category_id/$post->id/$page") ?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i> Ред-ть</a>

                <?php } else { ?>
                  <a href="<?= site_url("admin/group2/save/$category_group/$category_id/$post->id") ?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i> Ред-ть</a>
                <?php } ?>
              </div>
            </td>
            <!-- <td>
            <a href="<? //=base_url('admin/posts/save/quick_calls/'.$this->posts->get_id("{$post->alias}-quick-calls").'?country='.$post->alias)
                        ?>">Quick call</a>
              <a href="<? //=base_url('admin/posts/save/maps/'.$this->posts->get_id("{$post->alias}-full-map").'?country='.$post->alias)
                          ?>">Full map</a>
            
            </td>  -->
            <?php if ($sel == 'product_cat'  or  $sel == 'product_cat1') { ?>
              <td>
                <? if ($post->status_cat == 'active') : ?>
                  <span class="label label-success"><?= lang('active') ?></span>
                <? else : ?>
                  <span class="label label-fail"><?= lang('inactive') ?></span>
                <? endif ?>
              </td>
            <?php } ?>
            <td>
              <? if ($post->status == 'active') : ?>
                <span class="label label-success"><?= lang('active') ?></span>
              <? else : ?>
                <span class="label label-fail"><?= lang('inactive') ?></span>
              <? endif ?>
            </td>


            <td>
              <div class="btn-group">
                <a href="<?= site_url('admin/posts2/delete/' . $post->id) ?>" class="btn btn-small btn-danger delete"><i class="icon-trash icon-white"></i></a>
              </div>
            </td>
          </tr>
        <? endforeach ?>
      </tbody>
    </table>
  </div>
  <?php $this->load->view('admin/components/pagination'); ?>
  <script>
    $(function() {
      $("#list tbody").sortable({
        axis: 'y',
        handle: ".move",
        update: function(event, ui) {
          var list_sortable = $(this).sortable('serialize');
          $.ajax({
            type: "POST",
            async: true,
            url: '<?= base_url() ?>' + 'admin/posts/sort_order',
            data: list_sortable,
            success: function(data) {
              updateIndex();
            },
            error: function() {
              alert("Ошибка");
            }


          });
        }
      });
      // $( "#list" ).disableSelection();
    });

    function updateIndex() {
      appendedContainer = $("#ajax");
      $.ajax({
        <?php if (@$_GET['sort']) { ?>
          url: '<?= base_url() ?>' + 'admin/group2/index_ajax/<?= $category_group ?>/<?= $category_id; ?>/?sort=<?= @$_GET['sort'] ?>',
        <?php } else { ?>
          url: '<?= base_url() ?>' + 'admin/group2/index_ajax/<?= $category_group ?>/<?= $category_id; ?>/',
        <?php } ?>
        type: "POST",
        complete: function(qXHR, textStatus) {
          // attach error case
          if (textStatus === 'success') {
            var data = qXHR.responseText
            appendedContainer.html(data);
          }
        }
      });
    }
  </script>