<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>OSG Администраторская панель</title>
    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="shortcut icon" href="<?php echo base_url() ?>assets/admin/img/favicon.ico" />
    <!--Mobile first-->
   <!-- <meta name="viewport" content="width=device-width, initial-scale=1" />-->
    <!-- Bootstrap -->
     <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/lib/bootstrap/css/bootstrap.min.css" />
       <link href="<?= base_url() ?>assets/admin/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/admin/css/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/admin/css/jquery/jquery.min.css" rel="stylesheet" />
    <?//php if($sel != 'calendar'){?>
    <link href="<?= base_url() ?>assets/admin/css/mystyle.css?v=0.2" rel="stylesheet" />
    <?//php }?>
      <!--<link href="<?= base_url() ?>assets/admin/lib/datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
       <link href="<?= base_url() ?>assets/admin/css/bootstrap-datetimepicker.css" rel="stylesheet" />-->
    <script>
        site_url = '<?= site_url() ?>';
        base_url = '<?= base_url() ?>';
        upload_file = '';        
    </script>
    
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/lib/font-awesome/css/font-awesome.min.css" />
    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/main.min.css">
    <!-- Metis Theme stylesheet -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url() ?>assets/admin/lib/html5shiv/html5shiv.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/lib/respond/respond.min.js"></script>
    <![endif]-->
     <!-- Add jQuery library -->
        <script src='<?= base_url() ?>assets/admin/js/moment.min.js'></script>
    <script src="<?= base_url() ?>assets/admin/js/jquery/jquery.min.js" type="text/javascript" ></script>
    <script src="<?= base_url() ?>assets/admin/js/jquery/jquery-ui.min.js" type="text/javascript" ></script>
    <script src="<?= base_url() ?>assets/admin/js/jquery.form.js" type="text/javascript" ></script>
    <script src="<?= base_url() ?>assets/admin/js/jquery.synctranslit.min.js" type="text/javascript" ></script>
    <script src="<?= base_url() ?>assets/admin/js/main.js?v=0.2" type="text/javascript" ></script>
    <script src="<?= base_url() ?>assets/admin/js/jscolor.js" type="text/javascript" ></script>
    <link href="<?= base_url() ?>assets/admin/css/switcher.min.css" rel="stylesheet" type="text/css" />
    <script src="<?= base_url() ?>assets/admin/js/switcher.min.js" type="text/javascript" ></script>
 
<script src="<?= base_url() ?>assets/admin/js/bootstrap-datetimepicker.js" type="text/javascript" ></script>
    <!-- Add fancyBox -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/admin/css/fancybox/jquery.fancybox.css?v=2.1.4" type="text/css" media="screen" />
    <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/fancybox/jquery.fancybox.pack.js?v=2.1.4"></script>
    <!-- Jquery Validation Engine -->
    <link href="<?= base_url() ?>assets/admin/css/validationEngine.css" rel="stylesheet" type="text/css" />
    <script src="<?= base_url() ?>assets/admin/js/languages/jquery.validationEngine-ru.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/admin/js/jquery.validationEngine.js" type="text/javascript"></script>
    <!-- JQuery Timepicker -->
    <link href="<?= base_url() ?>assets/admin/jquery/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css" />
    <script src="<?= base_url() ?>assets/admin/jquery/timepicker/jquery-ui-timepicker-addon.js" type="text/javascript" ></script>
    <script src="<?= base_url() ?>assets/admin/jquery/timepicker/languages/jquery-ui-timepicker-ru.js" type="text/javascript" ></script>
      <!-- Tinymce moxiecut -->
    <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/tinymce4_moxiecut/tinymce/all.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/tinymce4_moxiecut/tinymce/plugins/moxiecut/plugin.min.js"></script>
 <link href="<?= base_url() ?>assets/admin/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/admin/datatables/datatables.tabletools.css" rel="stylesheet" type="text/css" />
<script type='text/javascript' src='<?= base_url() ?>assets/admin/datatables/jquery.datatables.min.js'></script>
        <script type='text/javascript' src='<?= base_url() ?>assets/admin/datatables/datatables.tabletools.min.js'></script>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--For Development Only. Not required -->
    <script>
        /*less = {
            env: "development",
            relativeUrls: false,
            rootpath: "<?php echo base_url() ?>assets/admin"
        };*/
    </script>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/style-switcher.css" />
    <link rel="stylesheet/less" type="text/css" href="<?php echo base_url() ?>assets/admin/css/less/theme.less" />
    <script src="<?php echo base_url() ?>assets/admin/lib/less/less-1.7.3.min.js"></script>
    <!--Modernizr 2.8.2-->
    <script src="<?php echo base_url() ?>assets/admin/lib/modernizr/modernizr.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/selectize/js/standalone/selectize.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/selectize/css/selectize.default.css">

<script src="<?= base_url() ?>assets/admin/js/bootstrap/bootstrap-transition.js"></script>
<script src="<?= base_url() ?>assets/admin/js/bootstrap/bootstrap-alert.js"></script>
<script src="<?= base_url() ?>assets/admin/js/bootstrap/bootstrap-modal.js"></script>
<script src="<?= base_url() ?>assets/admin/js/bootstrap/bootstrap-dropdown.js"></script>
<script src="<?= base_url() ?>assets/admin/js/bootstrap/bootstrap-scrollspy.js"></script>
<script src="<?= base_url() ?>assets/admin/js/bootstrap/bootstrap-tab.js"></script>
<script src="<?= base_url() ?>assets/admin/js/bootstrap/bootstrap-tooltip.js"></script>
<script src="<?= base_url() ?>assets/admin/js/bootstrap/bootstrap-popover.js"></script>
<script src="<?= base_url() ?>assets/admin/js/bootstrap/bootstrap-button.js"></script>
<script src="<?= base_url() ?>assets/admin/js/bootstrap/bootstrap-collapse.js"></script>
<script src="<?= base_url() ?>assets/admin/js/bootstrap/bootstrap-carousel.js"></script>
<script src="<?= base_url() ?>assets/admin/js/bootstrap/bootstrap-typeahead.js"></script>
<script src="<?= base_url() ?>assets/admin/js/stacktable.js"></script>

<!-- Screenfull -->
<script src="<?php echo base_url() ?>assets/admin/lib/screenfull/screenfull.js"></script>
<!-- Metis core scripts -->
<script src="<?php echo base_url() ?>assets/admin/js/core.js"></script>
<!-- Metis demo scripts -->
<script src="<?php echo base_url() ?>assets/admin/js/app.min.js"></script>
<!--<script src="<?php echo base_url() ?>assets/admin/js/style-switcher.js"></script>-->
</head>
<body>
<script type="text/javascript" src="<?= base_url() ?>assets/admin/js/tinymce4_moxiecut/tinymce/tinymce.js"></script>
<script type="text/javascript">
var moxiecutUrl = '<?=base_url()?>admin/moxiecut';
   tinymce.PluginManager.load('moxiecut', '<?= base_url() ?>assets/admin/js/tinymce4_moxiecut/tinymce/plugins/moxiecut/plugin.min.js');
            tinymce.init({
                selector: ".moxiecut",
                language: 'ru',
                theme: "modern",
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste moxiecut",
                    "textcolor colorpicker"
                ],
                toolbar: "undo redo | styleselect | bold italic fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link insertfile image media | forecolor backcolor",
                autosave_ask_before_unload: false,
                height: 500,
                relative_urls: false,
                valid_elements: "*[*]",
                entity_encoding : 'raw'
            });
    $(function () {
        var switcherEl = $('.switcher input#my-switcher-1').switcher({
            style: "default"
        });
        var switcherEl = $('.switcher input#my-switcher-2').switcher({
            style: "default"
        });
        var switcherEl = $('.switcher input#my-switcher-3').switcher({
            style: "default"
        });
    switcherEl.switcher('setLanguage', {
            ru: {
                yes: "да",
                no: "нет"
            }
        });
    });
    /*$('.price_is_disabled').on('click', function(){
        document.getElementById("price").disabled = !document.getElementById("price").disabled;
    });
    var checkbox = document.getElementById("price_is_disabled");
    if ("onpropertychange" in checkbox) {
        checkbox.onpropertychange = function() {
          if (event.propertyName == "checked") {
            $("price").attr('readonly','readonly');
          }
          else
            $("price").attr('readonly','');
        };
    } else {
        checkbox.onchange = function() {
          $("price").attr('readonly','readonly');
        };
    }*/
      var checkbox = $("input");
        checkbox.onchange = function() {
          if (event.propertyName == "checked") {
            $("#price").attr('readonly','readonly');
          }
          else
            $("#price").attr('readonly','');
        };
          jQuery(document).ready(function(){
        $('.table-striped').stacktable();
       if ($(".tSortable3").length > 0) {
        $(".tSortable3").dataTable({
//		 dom: 'T<"clear">lfrtip',
//            tableTools: {
//                "sSwfPath": "/static/swf/copy_csv_xls_pdf.swf"
//            },
            "iDisplayLength": 10, 
            "aLengthMenu": [5, 10, 25, 50, 100], 
            "sPaginationType": "full_numbers",
            // "aoColumns": [null, null, null]
            });
    }

        });
      
        
    
</script>
<style>
html .inner {
   background-color: #eee !important;
}
#content{    white-space: normal;}
#ajax td:first-child, #ajax thead tr th:first-child {
    display: none;
}
</style>
<div class="bg-dark dk" id="wrap">
<div id="top">
    <!-- .navbar -->
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <header class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?php echo base_url('admin') ?>" class="navbar-brand">
                    <img src="<?php echo base_url() ?>assets/admin/img/admlogo.png" alt="" />
                </a>
            </header>
            <div class="topnav">
              <ul class="tel" style="display: none;">
                <li>Телефоны для справок: <a href="tel:+998711470008">+998 (71) 147-00-08</a> &nbsp; / &nbsp; <a href="tel:+998983090008">+998 (98) 309-00-08</a></li>
                </ul>
            <div class="btn-group">
                    <ul id="menu" >
        <!-- ------------------------------------------- -->
       
           <?php if ($user_type == 'admin') { ?>
 
        <?php 
        /*
             <!--  <li class="" style="display: none;">         
                <span class="link-title"> <a data-placement="bottom" data-original-title="У вас <?= $count_msg ?> уведомлений" href="#" data-toggle="tooltip"
                       class="btn-default btn-sm" style="background: none;border: 0;">
                        <i class="fa fa-comments"></i>
                        <?php if ($count_msg) { ?> 
                        <span class="label label-danger"><?= $count_msg ?></span>
                        <?php 
                    } else { ?>
                                 <i class="fa fa-ok"></i>
                        <?php 
                    } ?>
                    </a></span>
            <ul style="position: absolute;top: 33px;box-shadow: none;width: 100%;min-width: 260px;z-index: 1;right: 0px !important;left: -130px;padding: 10px; display: none;">
            <? foreach ($get_faq as $item) : ?>
               <li> <a href="<?= site_url('admin/faq/edit/' . $item->id) ?>">id | <?= $item->id ?> | Имя <?= $item->name ?> | Посмотреть</a></li>
               <? endforeach; ?>
               <li><a href="<?= site_url('admin/faq') ?>">Посмотреть все</a></li>
            </ul>
        </li>-->
        */
        ?>
        <?php 
    } ?>
        </ul>
                </div>
                  <div class="btn-group">
                    <a href="<?= site_url('auth/logout_admin') ?>" data-toggle="tooltip" data-original-title="Выйти"
                       data-placement="bottom"
                       class="btn btn-metis-1 btn-sm">
                        <i class="fa fa-power-off"></i>
                    </a>
                </div>
                <div class="btn-group">
                    <a data-placement="bottom" data-original-title="Полный экран" data-toggle="tooltip"
                       class="btn btn-default btn-sm" id="toggleFullScreen">
                        <i class="glyphicon glyphicon-fullscreen"></i>
                    </a>
                </div>
                <!--
                <div class="btn-group">
                    <a data-placement="bottom" data-original-title="E-mail" data-toggle="tooltip"
                       class="btn btn-default btn-sm">
                        <i class="fa fa-envelope"></i>
                        <span class="label label-warning">5</span>
                    </a>
                    <a data-placement="bottom" data-original-title="Messages" href="#" data-toggle="tooltip"
                       class="btn btn-default btn-sm">
                        <i class="fa fa-comments"></i>
                        <span class="label label-danger">4</span>
                    </a>
                    <a data-toggle="modal" data-original-title="Help" data-placement="bottom"
                       class="btn btn-default btn-sm" href="#helpModal">
                        <i class="fa fa-question"></i>
                    </a>
                </div> -->
                <div class="btn-group">
                    <a data-placement="bottom" data-original-title="Показать / Спрятать Левое меню" data-toggle="tooltip"
                       class="btn btn-primary btn-sm toggle-left" id="menu-toggle">
                        <i class="fa fa-bars"></i>
                    </a>                   
                </div>
                <div class="btn-group">
                 <a data-placement="bottom" data-original-title="Показать / Спрятать Правое меню" data-toggle="tooltip"
                       class="btn btn-default btn-sm toggle-right"> <span class="glyphicon glyphicon-comment"></span>
                    </a>
                </div>             
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse" >
                <!-- .nav -->
                <ul class="nav navbar-nav">
                <?php if ($user_type == 'admin') { ?>
                   <li><a href="<?php echo base_url('admin'); ?>">Админ панель</a></li>                  
                   
                   <?php 
                } ?>
                   <?php if ($user_type == 'admin') { ?>
                    <li><a href="<?= site_url('admin/site/save/site_settings/1') ?>">Настройки сайта</a></li>
                    <?php 
                } ?>
                    <li><a href="<?= base_url() ?>" target="_blank">Перейти на сайт</a></li>
                     <?//php if (getUserOption($this->session->userdata('user_id'), 'user_type') == 'admin') { ?>
                    <!--<li><a href="<?= site_url('admin/posts/index/google') ?>">Карта Google</a></li>
                    <li><a href="<?= site_url('admin/posts/index/weather') ?>">Погода</a></li>-->
                   <!--  <li><a href="<?= site_url('admin/posts/index/counter') ?>">Счетчик</a></li>
                   <li><a href="<?= site_url('admin/main/stat') ?>">Статистика</a></li>-->
                    <?//php } ?>
                     
                    <!--<li><a href="file.html">File Manager</a></li>
                    <li class='dropdown '>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Form Elements
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="form-general.html">General</a></li>
                            <li><a href="form-validation.html">Validation</a></li>
                            <li><a href="form-wysiwyg.html">WYSIWYG</a></li>
                            <li><a href="form-wizard.html">Wizard &amp; File Upload</a></li>
                        </ul>
                    </li>-->
                </ul>
              
                <!-- /.nav -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>
    <!-- /.navbar -->
    <header class="head">
       <!-- <div class="search-bar">
            <form class="main-search" action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Live Search ...">
                <span class="input-group-btn">
            <button class="btn btn-primary btn-sm text-muted" type="button">
                <i class="fa fa-search"></i>
            </button>
        </span>
                </div>
            </form>
        </div>-->
        <div class="main-bar">
          <!--  <h3>
                <i class="fa fa-home"></i>&nbsp;
            </h3>-->
        </div>
    </header>
    <!-- /.head -->
</div>
<!-- /#top -->
<div id="left">
    <div class="media user-media bg-dark dker">
        <div class="user-media-toggleHover">
            <span class="fa fa-user"></span>
        </div>
     
    </div>
    <!-- ---------------------------- #menu ------------------------------------>
    <ul id="menu" class="bg-blue dker">
        <li class="nav-header">Меню</li>
        <li class="nav-divider"></li>
      <?php if ($user_type == 'admin') { ?>
      <?php $this->load->view('admin/menu_admin'); ?> 
      <?php 
    } ?>
      <?php if ($user_type == 'region') { ?>
      <?php $this->load->view('admin/menu_region'); ?> 
      <?php 
    } ?>
      <?php if ($user_type == 'moderator') { ?>
      <?php $this->load->view('admin/menu_moderator'); ?> 
      <?php 
    } ?>
    <?php if ($user_type == 'moderator_main') { ?>
      <?php $this->load->view('admin/menu_moderator_main'); ?> 
      <?php 
    } ?>
    
      <!--
        <!-- ------------------------------------------- -->
       <!-- <li>
            <a href="javascript:;">
                <i class="fa fa-code"></i>
              <span class="link-title">
    	Unlimited Level Menu 
    	</span>
                <span class="fa arrow"></span>
            </a>
            <ul>
                <li>
                    <a href="javascript:;">Level 1 <span class="fa arrow"></span> </a>
                    <ul>
                        <li><a href="javascript:;">Level 2</a></li>
                        <li><a href="javascript:;">Level 2</a></li>
                        <li>
                            <a href="javascript:;">Level 2 <span class="fa arrow"></span> </a>
                            <ul>
                                <li><a href="javascript:;">Level 3</a></li>
                                <li><a href="javascript:;">Level 3</a></li>
                                <li>
                                    <a href="javascript:;">Level 3 <span class="fa arrow"></span> </a>
                                    <ul>
                                        <li><a href="javascript:;">Level 4</a></li>
                                        <li><a href="javascript:;">Level 4</a></li>
                                        <li>
                                            <a href="javascript:;">Level 4 <span class="fa arrow"></span> </a>
                                            <ul>
                                                <li><a href="javascript:;">Level 5</a></li>
                                                <li><a href="javascript:;">Level 5</a></li>
                                                <li><a href="javascript:;">Level 5</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="javascript:;">Level 4</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:;">Level 2</a></li>
                    </ul>
                </li>
                <li><a href="javascript:;">Level 1</a></li>
                <li>
                    <a href="javascript:;">Level 1 <span class="fa arrow"></span> </a>
                    <ul>
                        <li><a href="javascript:;">Level 2</a></li>
                        <li><a href="javascript:;">Level 2</a></li>
                        <li><a href="javascript:;">Level 2</a></li>
                    </ul>
                </li>
            </ul>
        </li>-->
        <li class="nav-divider"></li>
    </ul>
    <!-- /#menu tamom ------------------------------------------------>
</div>
<!-- /#left -->
<div id="content">
    <div class="outer">
        <div class="inner bg-light lter" >
            <div class="col-lg-12">
                <!-- Main content here -->
                <?php $this->load->view($body) ?>
            </div>
        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->
</div>
<!-- /#content -->
<div id="right" class="bg-light lter">
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Warning!</strong> Best check yo self, you're not looking too good.
    </div>
    <!-- .well well-small -->
    <div class="well well-small dark">
        <ul class="list-unstyled">
            <li>Visitor <span class="inlinesparkline pull-right">1,4,4,7,5,9,10</span>
            </li>
            <li>Online Visitor <span class="dynamicsparkline pull-right">Loading..</span>
            </li>
            <li>Popularity <span class="dynamicbar pull-right">Loading..</span>
            </li>
            <li>New Users <span class="inlinebar pull-right">1,3,4,5,3,5</span>
            </li>
        </ul>
    </div>
    <!-- /.well well-small -->
    <!-- .well well-small -->
    <div class="well well-small dark">
        <button class="btn btn-block">Default</button>
        <button class="btn btn-primary btn-block">Primary</button>
        <button class="btn btn-info btn-block">Info</button>
        <button class="btn btn-success btn-block">Success</button>
        <button class="btn btn-danger btn-block">Danger</button>
        <button class="btn btn-warning btn-block">Warning</button>
        <button class="btn btn-inverse btn-block">Inverse</button>
        <button class="btn btn-metis-1 btn-block">btn-metis-1</button>
        <button class="btn btn-metis-2 btn-block">btn-metis-2</button>
        <button class="btn btn-metis-3 btn-block">btn-metis-3</button>
        <button class="btn btn-metis-4 btn-block">btn-metis-4</button>
        <button class="btn btn-metis-5 btn-block">btn-metis-5</button>
        <button class="btn btn-metis-6 btn-block">btn-metis-6</button>
    </div>
    <!-- /.well well-small -->
    <!-- .well well-small -->
    <div class="well well-small dark">
        <span>Default</span> <span class="pull-right"><small>20%</small> </span>
        <div class="progress xs">
            <div class="progress-bar progress-bar-info" style="width: 20%"></div>
        </div>
        <span>Success</span> <span class="pull-right"><small>40%</small> </span>
        <div class="progress xs">
            <div class="progress-bar progress-bar-success" style="width: 40%"></div>
        </div>
        <span>warning</span> <span class="pull-right"><small>60%</small> </span>
        <div class="progress xs">
            <div class="progress-bar progress-bar-warning" style="width: 60%"></div>
        </div>
        <span>Danger</span> <span class="pull-right"><small>80%</small> </span>
        <div class="progress xs">
            <div class="progress-bar progress-bar-danger" style="width: 80%"></div>
        </div>
    </div>
</div>
<!-- /#right -->
</div>
<!-- /#wrap -->
<footer class="Footer bg-dark dker">
    <p><?= date('Y') ?> &copy; Online Service Group</p>
</footer>
<!-- /#footer -->

</body>
</html>
<?php if(@$sel_users == 'posts2'){?>
<?php $this->load->view('admin/media/posts2_media') ?>
<?php }?>
<?php if ($sel != 'calendar') { ?>
<?php if (@$sel_media == 'users_media') { ?>
<?php $this->load->view('admin/media/media') ?>
<?php 
} else { ?>
<?php $this->load->view('admin/media/index') ?>
<?php 
} ?>
<?php if (@$sel == 'product' or @$sel == 'events' or @$sel == 'specialization' or @$sel == 'catalog' or @$sel == 'video' or @$sel == 'services') { ?>
<?php $this->load->view('admin/media/media_poster') ?>
<?php 
} ?>
<?php 
} ?>
<?php if ($sel == 'calendar') { ?>
<?php 
} ?>