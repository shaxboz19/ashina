<?php
$link_ru = ($sel == 'home') ? base_url('ru') : $this->lang->switch_uri(base_url('ru'));
$link_en = ($sel == 'home') ? base_url('en') : $this->lang->switch_uri(base_url('en'));
$link_uz = ($sel == 'home') ? base_url('uz') : $this->lang->switch_uri(base_url('uz'));
$link_oz = ($sel == 'home') ? base_url('oz') : $this->lang->switch_uri(base_url('oz'));
if (LANG == 'ru') {
  $lang_title = "Ру";
} elseif (LANG == 'uz') {
  $lang_title = "Ўз";
} elseif (LANG == 'oz') {
  $lang_title = "O'z";
} else {
  $lang_title = "En";
}
?>


<header class="header <?= ($sel == 'home') ? '' : 'pages-header' ?>">
  <div class="container">
    <div class="header__main">
      <div class="header__main__logo">
        <a href="<?= site_url() ?>">
          <img src="<?= get_resource_url() ?>/images/ashina-logo.png" alt>
        </a>
      </div>
      <div class="header__main__menu">
        <ul>
          <? foreach($menu as $item):
                        $target = '';
                        if($item->options) {
                            $link = site_url($item->options);
                        }elseif ($item->option_2){
                            $link = $item->option_2;
                            $target = 'target="_blank"';
                        } else {
                            $link = site_url('menu/'.$item->alias);
                        }
                        ?>
          <li><a href="<?= $link ?>" <?= $target ?>><span class="original"><?= char_lim(_t($item->title, LANG), 90) ?></span><span class="hover-menu"><?= char_lim(_t($item->title, LANG), 90) ?></span></a>
          </li>
          <? endforeach;?>
        </ul>
      </div>
      <div class="header__main__number">
        <?php
        $tel = strip_tags(_t(getPosts(29, 'content_html')), LANG);
        ?>
        <a href="tel:<?= $tel ?>">
          <i class="icon-telephone"></i>
          <span><?= $tel ?></span>
        </a>
      </div>
      <div class="header__main__social">
        <ul>
          <li><a href="#!" class="icon-facebook"></a></li>
          <li><a href="#!" class="icon-instagram"></a></li>
        </ul>
      </div>
      <div class="header__main__lang">
        <!-- <button>Ру<i class="fa fa-angle-down"></i></button> -->
        <div class="dropdown">
          <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?= $lang_title ?><i class="fa fa-angle-down" aria-hidden="true"></i>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <?php if (LANG != 'ru') { ?>
              <a class="dropdown-item" href="<?= $link_ru ?>">
                <span>Ру</span>
              </a>
            <?php } ?>
            <?php if (LANG != 'uz') { ?>
              <a class="dropdown-item" href="<?= $link_uz ?>">
                <span>Ўз</span>
              </a>
            <?php } ?>
            <?php if (LANG != 'en') { ?>
              <a class="dropdown-item" href="<?= $link_en ?>">
                <span>En</span>
              </a>
            <?php } ?>


          </div>
        </div>
      </div>
    </div>
  </div>


</header>