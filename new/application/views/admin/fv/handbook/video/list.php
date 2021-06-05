<div class="span12">
    <div class="">
        <div class="isw-graph"></div>
        <h1><?php // echo $this->lang->line('label_list'); ?> Видео <a class="btn btn-primary" href="<?=site_url('admin/handbook/handbook_video/add')?>" ><?php echo $this->lang->line('button_add'); ?></a></h1>
        <div class="clear"></div>
    </div>

    <div class="block">
        <ol type="square">
            <?php if(isset($cvideo_list)): ?>
                <?php foreach ($cvideo_list as $value): ?>
                    <?php if(strlen($value['v_name']) > 0): ?>
                        <li>
                            <a href="<?=site_url('admin/handbook/handbook_video/edit/'. $value['id_video'])?>">
                                <b><?php echo $value['v_name'] ?></b>
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a>
                                <a href="<?=site_url('admin/handbook/handbook_video/edit/'. $value['id_video'])?>">
                                    <b><?php echo $this->lang->line('menu_empty') ?></b>
                                </a>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </ol>

    </div>
</div>
