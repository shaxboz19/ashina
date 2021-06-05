<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin panel</title>

    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="<?php echo base_url() ?>assets/admin/img/favicon.ico" />
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/lib/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/lib/font-awesome/css/font-awesome.min.css">

    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/main.min.css">

    <!-- Metis Theme stylesheet -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>
    <script src="<?php echo base_url()?>assets/admin/lib/html5shiv/html5shiv.js"></script>
    <script src="<?php echo base_url()?>assets/admin/lib/respond/respond.min.js"></script>
    <![endif]-->

    <!--jQuery 2.1.1 -->
    <script src="<?php echo base_url() ?>assets/admin/lib/jquery/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/admin/js/jquery-ui.min.js" type="text/javascript" ></script>
    <script src="<?=base_url()?>assets/admin/old/js/jquery.form.js" type="text/javascript" ></script>
    <script src="<?=base_url()?>assets/admin/js/main.js" type="text/javascript" ></script>
    <!-- Tinymce moxiecut -->
    <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/tinymce4_moxiecut/tinymce/all.min.js"></script>
    <script type="text/javascript"
            src="<?= base_url() ?>assets/admin/js/tinymce4_moxiecut/tinymce/plugins/moxiecut/plugin.min.js"></script>

    <!--For Development Only. Not required -->
    <script>
        less = {
            env: "development",
            relativeUrls: false,
            rootpath: "<?php echo base_url()?>assets/admin"
        };
    </script>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/style-switcher.css">
    <link rel="stylesheet/less" type="text/css" href="<?php echo base_url() ?>assets/admin/css/less/theme.less">
    <script src="<?php echo base_url() ?>assets/admin/lib/less/less-1.7.3.min.js"></script>

    <!--Modernizr 2.8.2-->
    <script src="<?php echo base_url() ?>assets/admin/lib/modernizr/modernizr.min.js"></script>
</head>

<body class=" ">

<script type="text/javascript" src="<?= base_url() ?>assets/admin/js/tinymce4_moxiecut/tinymce/tinymce.js"></script>
<script type="text/javascript">
    tinymce.PluginManager.load('moxiecut', '<?=base_url()?>assets/admin/js/tinymce4_moxiecut/tinymce/plugins/moxiecut/plugin.min.js');
    tinymce.init({
        selector: ".moxiecut",
        theme: "modern",
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste moxiecut"
        ],
        toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link insertfile image media",
        autosave_ask_before_unload: false,
        height: 500,
        relative_urls: false
    });
</script>
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
                    <img src="<?php echo base_url() ?>assets/admin/img/logo.png" alt="" width="115" />
                </a>
            </header>
            <div class="topnav">
                <div class="btn-group">
                    <a data-placement="bottom" data-original-title="Fullscreen" data-toggle="tooltip"
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
                    <a href="<?= site_url('auth/logout') ?>" data-toggle="tooltip" data-original-title="Logout"
                       data-placement="bottom"
                       class="btn btn-metis-1 btn-sm">
                        <i class="fa fa-power-off"></i>
                    </a>
                </div>
                <div class="btn-group">
                    <a data-placement="bottom" data-original-title="Show / Hide Left" data-toggle="tooltip"
                       class="btn btn-primary btn-sm toggle-left" id="menu-toggle">
                        <i class="fa fa-bars"></i>
                    </a>
                    <a data-placement="bottom" data-original-title="Show / Hide Right" data-toggle="tooltip"
                       class="btn btn-default btn-sm toggle-right"> <span class="glyphicon glyphicon-comment"></span>
                    </a>
                </div>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">

                <!-- .nav -->
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo base_url('admin'); ?>">Dashboard</a></li>
                    <li><a href="table.html">Tables</a></li>
                    <li><a href="file.html">File Manager</a></li>
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
                    </li>
                </ul>
                <!-- /.nav -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>
    <!-- /.navbar -->
    <header class="head">
        <div class="search-bar">
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
            <!-- /.main-search -->
        </div>
        <!-- /.search-bar -->
        <div class="main-bar">
            <h3>
                <i class="fa fa-home"></i>&nbsp;
            </h3>
        </div>
        <!-- /.main-bar -->
    </header>
    <!-- /.head -->
</div>
<!-- /#top -->
<div id="left">
    <div class="media user-media bg-dark dker">
        <div class="user-media-toggleHover">
            <span class="fa fa-user"></span>
        </div>
        <div class="user-wrapper bg-dark">
            <a class="user-link" href="">
                <img class="media-object img-thumbnail user-img" alt="User Picture"
                     src="<?php echo base_url() ?>assets/admin/img/user.gif">
                <span class="label label-danger user-label">16</span>
            </a>

            <div class="media-body">
                <h5 class="media-heading">Archie</h5>
                <ul class="list-unstyled user-info">
                    <li><a href="">Administrator</a></li>
                    <li>Last Access :
                        <br>
                        <small>
                            <i class="fa fa-calendar"></i>&nbsp;16 Mar 16:32
                        </small>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- ---------------------------- #menu ------------------------------------>
    <ul id="menu" class="bg-blue dker">
        <li class="nav-header">Menu</li>
        <li class="nav-divider"></li>
        <!-- ------------------------------------------- -->
        <li class="<?= ($sel == 'users') ? 'active' : '' ?>">
            <a href="javascript:;">
                <i class="fa fa-user"></i>
                <span class="link-title">&nbsp;Пользователь</span>
                <span class="fa arrow"></span>
            </a>
            <ul>
                <li><a href="<?= site_url('admin/users/save') ?>"><i class="fa fa-angle-right"></i>&nbsp; Добавить</a>
                </li>
                <li><a href="<?= site_url('admin/users') ?>"><i class="fa fa-angle-right"></i>&nbsp; Список</a></li>
            </ul>
        </li>
        <!-- ------------------------------------------- -->
        <li class="<?= ($sel == 'albums') ? 'active' : '' ?>">
            <a href="javascript:;">
                <i class="fa fa-folder-open"></i>
                <span class="link-title">Альбомы</span>
                <span class="fa arrow"></span>
            </a>
            <ul>
                <li><a href="<?= site_url('admin/albums/save') ?>"><i class="fa fa-angle-right"></i>&nbsp; Добавить</a></li>
                <li><a href="<?= site_url('admin/albums') ?>"><i class="fa fa-angle-right"></i>&nbsp; Список</a></li>
            </ul>
        </li>
        <!-- ------------------------------------------- -->
        <li class="<?= ($sel == 'music') ? 'active' : '' ?>">
            <a href="javascript:;">
                <i class="fa fa-music"></i>
                <span class="link-title">Музыка</span>
                <span class="fa arrow"></span>
            </a>
            <ul>
                <li><a href="<?= site_url('admin/music/save') ?>"><i class="fa fa-angle-right"></i>&nbsp; Добавить</a>
                </li>
                <li><a href="<?= site_url('admin/music') ?>"><i class="fa fa-angle-right"></i>&nbsp; Список</a></li>
            </ul>
        </li>
        <!-- ------------------------------------------- -->
        <li class="<?= ($sel == 'pages') ? 'active' : '' ?>">
            <a href="javascript:;">
                <i class="fa fa-list"></i>
                <span class="link-title">Страницы</span>
                <span class="fa arrow"></span>
            </a>
            <ul>
                <li><a href="<?= site_url('admin/posts/save/pages') ?>"><i class="fa fa-angle-right"></i>&nbsp; Добавить</a>
                </li>
                <li><a href="<?= site_url('admin/posts/index/pages') ?>"><i class="fa fa-angle-right"></i>&nbsp; Список</a>
                </li>
            </ul>
        </li>
        <!-- ------------------------------------------- -->
        <li class="<?= ($sel == 'video') ? 'active' : '' ?>">
            <a href="javascript:;">
                <i class="fa fa-film"></i>
                <span class="link-title">Видео</span>
                <span class="fa arrow"></span>
            </a>
            <ul>
                <li><a href="<?= site_url('admin/posts/save/video') ?>"><i class="fa fa-angle-right"></i>&nbsp; Добавить</a>
                </li>
                <li><a href="<?= site_url('admin/posts/index/video') ?>"><i class="fa fa-angle-right"></i>&nbsp; Список</a>
                </li>
            </ul>
        </li>
        <!-- ------------------------------------------- -->
        <li class="<?= ($sel == 'gallery') ? 'active' : '' ?>">
            <a href="javascript:;">
                <i class="fa fa-th"></i>
                <span class="link-title">Галерея</span>
                <span class="fa arrow"></span>
            </a>
            <ul>
                <li><a href="<?= site_url('admin/posts/save/gallery') ?>"><i class="fa fa-angle-right"></i>&nbsp;
                        Добавить</a></li>
                <li><a href="<?= site_url('admin/posts/index/gallery') ?>"><i class="fa fa-angle-right"></i>&nbsp;
                        Список</a></li>
            </ul>
        </li>
        <!-- ------------------------------------------- -->
        <li class="<?= ($sel == 'news') ? 'active' : '' ?>">
            <a href="javascript:;">
                <i class="fa fa-share-alt"></i>
                <span class="link-title">Новости</span>
                <span class="fa arrow"></span>
            </a>
            <ul>
                <li><a href="<?= site_url('admin/posts/save/news') ?>"><i class="fa fa-angle-right"></i>&nbsp; Добавить</a>
                </li>
                <li><a href="<?= site_url('admin/posts/index/news') ?>"><i class="fa fa-angle-right"></i>&nbsp;
                        Список</a></li>
            </ul>
        </li>
        <!-- ------------------------------------------- -->

        <li>
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
        </li>
        <li class="nav-divider"></li>

    </ul>
    <!-- /#menu tamom ------------------------------------------------>
</div>
<!-- /#left -->
<div id="content">
    <div class="outer">
        <div class="inner bg-light lter">
            <div class="col-lg-12">


                <!-- Main content here -->
                <? $this->load->view($body) ?>


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
    <p>2014 &copy; Online Service Group - Admin panel</p>
</footer>
<!-- /#footer -->

<!-- #MediaModal -->
<? $this->load->view('admin/media/index') ?>


<!--Bootstrap -->
<script src="<?php echo base_url() ?>assets/admin/lib/bootstrap/js/bootstrap.min.js"></script>

<!-- Screenfull -->
<script src="<?php echo base_url() ?>assets/admin/lib/screenfull/screenfull.js"></script>

<!-- Metis core scripts -->
<script src="<?php echo base_url() ?>assets/admin/js/core.js"></script>

<!-- Metis demo scripts -->
<script src="<?php echo base_url() ?>assets/admin/js/app.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/style-switcher.js"></script>
</body>
</html>