<?php
if (isset($id_cvideo)) {
    $form_url = 'admin/handbook/handbook_video/save/' . $id_cvideo;
    $delete_url = 'admin/handbook/handbook_video/delete/' . $id_cvideo;
} else {
    $form_url = 'admin/handbook/handbook_video/save/';
    $delete_url = 'admin/handbook/handbook_video/delete/';
}

$img_path = '/handbook/video/';
// Get file list
$file_list = array();
$map = directory_map($fc_path . $img_path);
if (is_array($map)) {
    foreach ($map as $key => $value) {
        if (is_string($value)) {
            $file_list[] = $value;
        } else if (is_array($value)) {
            foreach ($value as $key2 => $img) {
                $file_list[] = $key . '/' . $img;
            }
        }
    }
}
?>
<div class="span8">
    <div class="head">
        <div class="isw-graph"></div>
        <h1>
            <?php if(isset($video_edit)): ?>
                <?php echo $this->lang->line('button_edit'); ?>
            <?php else: ?>
                <?php echo $this->lang->line('button_add'); ?>
            <?php endif; ?>
        </h1>
        <div class="clear"></div>
    </div>

    <div class="block">
       
        <?=form_open_multipart($form_url)?>
            <div class="row-form">
                <div class="span3">
                    Введите название видео:*
                </div>
                <div class="span9">
                    <input type="text"
                        <?php if(isset($video_edit['v_name'])):?>
                           value="<?php echo $video_edit['v_name']; ?>"
                        <?php endif ?>
                        name="pname" size="60" />
                </div>
                <div class="clear"></div>
            </div>

            <div class="row-form">
                <div class="span3">
                    Описания видео:
                </div>
                <div class="span9">
                    <textarea name="pabout"><?php if(isset($video_edit['v_about'])): ?><?php echo $video_edit['v_about']; ?><?php endif; ?></textarea>
                </div>
                <div class="clear"></div>
            </div>

            <div class="row-form">
                <div class="span3">
                    Язык:
                </div>
                <div class="span9">
                    <select name="plang">
                        <option value="ru" <?php if(isset($video_edit) && $video_edit['v_lang'] == 'ru'):?>selected="selected"<?php endif; ?>>Russian</option>
                        <option value="uz" <?php if(isset($video_edit) && $video_edit['v_lang'] == 'uz'):?>selected="selected"<?php endif; ?>>Uzbek</option>
                    </select>
                </div>
                <div class="clear"></div>
            </div>

            <div class="row-form">
                <div class="span3">
                    Продолжительность видео:*
                </div>
                <div class="span9">
                    <input type="text"
                        <?php if (isset($video_edit['v_duration'])): ?>
                            value="<? echo $video_edit['v_duration']; ?>"
                        <?php endif; ?> name="pduration" size="60" />
                    <span>Например: 03:32</span>
                </div>
                <div class="clear"></div>
            </div>


            <div class="row-form">
                <div class="span3">
                    Введите ссылку к видео:*
                </div>
                <div class="span9">
                    <select name="ppath" id="photo-select">
                        <option value=""></option>
                        <?php foreach($file_list as $key => $value): ?>
                                <?php $value_link = $img_path . $value ?>
                            <?php if (isset($video_edit['v_path']) && ($video_edit['v_path'] == $value_link)): ?>
                                <option value="<?php echo $value_link ?>" selected="selected"><?php echo $value ?></option>
                            <?php else: ?>
                                <option value="<?php echo $value_link ?>"><?php echo $value ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="clear"></div>
            </div>

            <?php if (isset($video_edit['v_time'])): ?>
            <div class="row-form">
                <div class="span3">
                    <?php echo $this->lang->line('label_time'); ?>
                </div>
                <div class="span9">
                    <?php echo $video_edit['v_time']; ?>
                </div>
                <div class="clear"></div>
            </div>
            <?php endif; ?>

            <div class="row-form">
                <div class="span3"></div>
                <div class="span9">
                    <p>
                        <button type="submit" class="btn btn-primary">
                            <?php if(isset($video_edit)): ?>
                                <?php echo $this->lang->line('button_save'); ?>
                            <?php else: ?>
                                <?php echo $this->lang->line('button_add'); ?>
                            <?php endif; ?>
                        </button>

                        <?php if(isset($video_edit)): ?>
                            <a class="btn btn-danger" href="<?=site_url($delete_url)?>">
                                <?php echo $this->lang->line('button_delete') ?>
                            </a>
                        <?php endif; ?>
                    </p>
                </div>
                <div class="clear"></div>
            </div>
        </form>
    </div>
</div>