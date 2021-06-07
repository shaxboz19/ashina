<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="author" content="Online Service Group" />
  <link rel="shortcut icon" href="<?= get_resource_url() ?>images/favicon.png?v=0.2" />
  <title><?php $this->load->view('public/companents/title'); ?></title>
  <?php
  //$ogimage = "<meta property='og:image' content='".get_resource_url()."images/logo2/logo_".LANG.".png' />";
  $ogimage = "<meta property='og:image' content='" . get_resource_url() . "images/fb.png?v=0.1' />";
  //$ogimage = "";
  ?>
  <?php if ($sel == 'home') { ?>
    <?php if ($keywords_glob) { ?>
      <meta name="keywords" content="<?= removeAll(@$keywords_glob) ?>" /><?php } ?>
    <?php if ($description_glob) { ?>
      <meta name="description" content="<?= removeAll(@$description_glob) ?>" /><?php } ?>
    <!--<meta property="og:site_name" content="<?= trim(removeAll(removeTags(_t(@$meta_title_glob, LANG)))) ?>" />-->
    <meta property="og:title" content="<?= trim(removeAll(removeTags(_t(@$meta_title_glob, LANG)))) ?>" />
    <?php if ($description_glob) { ?>
      <meta property="og:description" content="<?= removeAll(removeTags(@$description_glob)) ?>" />
    <?php
    } ?>
    <meta property="og:url" content="<?= base_url() ?>" />
    <meta property="og:type" content="website" />
    <?= $ogimage; ?>
  <?php
  } elseif (@$sel_news == 'news') { ?>
    <meta name="keywords" content="<?= removeAll(@$post->keywords) ?>" />
    <meta name="description" content="<?= removeAll(@$post->description) ?>" />
    <meta property="og:site_name" content="" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?= _t(@$post->title, LANG) ?>" />
    <meta property="og:url" content="<?= site_url("$group/$post->alias") ?>" />
    <?php if ($post->url) { ?>
      <meta property="og:image" content="<?= base_url("thumb/view/w/200/h/200/src/uploads/" . $post->group . "/" . $post->url . "?ver=2") ?>" />
    <?php
    } else { ?>
      <?= $ogimage; ?>
    <?php
    } ?>
  <?php
  } elseif (@$sel_news == 'category') { ?>
    <meta name="keywords" content="<?= @$post->keywords ?>" />
    <meta name="description" content="<?= @$post->description ?>" />
    <meta property="og:site_name" content="" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?= _t(@$post->title, LANG) ?>" />
    <meta property="og:url" content="<?= site_url("$group/view/$post->alias") ?>" />
    <meta property="og:image" content="<?= base_url("thumb/view/w/200/h/200/src/uploads/" . $post->group . "/" . $post->url . "?ver=2") ?>" />
  <?php
  } else { ?>
    <?php if (@$keywords) { ?>
      <meta name="keywords" content="<?= @$keywords ?>" /><?php } ?>
    <?php if (@$description) { ?>
      <meta name="description" content="<?= @$description ?>" /><?php } ?>
    <meta property="og:title" content="<?= trim(removeAll(removeTags(_t(@$meta_title_glob, @LANG)))) ?>" />
    <?php if ($description_glob) { ?>
      <meta property="og:description" content="<?= removeAll(removeTags(@$description_glob)) ?>" />
    <?php
    } ?>
    <meta property="og:url" content="<?= base_url() ?>" />
    <meta property="og:type" content="website" />
    <?= $ogimage; ?>
  <?php
  } ?>
  <meta property="og:image:width" content="200" />
  <meta property="og:image:height" content="200" />
  <meta name="robots" content="index, follow" />
  <script>
    site_url = '<?= site_url() ?>';
    base_url = '<?= base_url() ?>';
    resource = '<?= get_resource_url() ?>';
    mobile_menu = '<?= lang('menu') ?>';
    lang = '<?= @LANG ?>';
    sel = '<?= @$sel ?>';
  </script>


  <link rel="stylesheet" href="<?= get_resource_url() ?>fonts/quarion/stylesheet.css">
  <link rel="stylesheet" href="<?= get_resource_url() ?>fonts/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="<?= get_resource_url() ?>fonts/icomoon/style.css?v=0.1">
  <link rel="stylesheet" href="<?= get_resource_url() ?>bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= get_resource_url() ?>bootstrap/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="<?= get_resource_url() ?>css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?= get_resource_url() ?>css/owl.theme.default.min.css">
  <link rel='stylesheet' href='<?= get_resource_url() ?>fancybox-master/dist/jquery.fancybox.min.css' type='text/css' />
  <link rel="stylesheet" href="<?= get_resource_url() ?>magnific-popup/magnific-popup.css?v=0.2" />
  <link rel="stylesheet" href="<?= get_resource_url() ?>css/animate.css">
  <link rel="stylesheet" href="<?= get_resource_url() ?>css/aos.css">
  <link rel="stylesheet" href="<?= get_resource_url() ?>css/search.css?v=<?= time() ?>">


  <link href="<?= get_resource_url() ?>js/spec/special_view.css?ver=<?= time() ?>" rel="stylesheet" />
  <link href="<?= get_resource_url() ?>js/spec/site.min.css?v=<?= time() ?>" rel="stylesheet" />

  <link rel="stylesheet" href="<?= get_resource_url() ?>menu/mmenu_new.css?v=<?= time() ?>" media="screen" />

  <link rel="stylesheet" href="<?= get_resource_url() ?>menu/smartmenus.bootstrap-4.css?v=<?= time() ?>" type="text/css">

  <link rel="stylesheet" href="<?= get_resource_url() ?>css/main.css?v=<?= time() ?>">
  <link rel="stylesheet" href="<?= get_resource_url() ?>css/media.css?v=<?= time() ?>">


  <link rel="stylesheet" type="text/css" href="<?= get_resource_url() ?>gs/gspeech.css?v=0.2" />
  <link rel="stylesheet" type="text/css" href="<?= get_resource_url() ?>gs/the-tooltip.css?v=0.2" />


  <link rel="stylesheet" href="<?= get_resource_url() ?>stacktable/stacktable.css?v=<?= time() ?>">

  <script src="<?= get_resource_url() ?>js/jquery-3.5.1.min.js"></script>
  <script src="<?= get_resource_url() ?>js/owl.carousel.min.js"></script>
  <script src="<?= get_resource_url() ?>js/aos.js"></script>
  <script src="<?= get_resource_url() ?>magnific-popup/jquery.magnific-popup.js"></script>



</head>