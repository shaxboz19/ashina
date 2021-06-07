   <?php if ($user_type == 'admin') { ?>
       <!-- ------------------------------------------- -->
       <li class="<?= ($sel == 'users') ? 'active' : '' ?>">
           <a href="javascript:;">
               <i class="fa fa-user"></i>
               <span class="link-title">&nbsp;Пользователь</span>
               <span class="fa arrow"></span>
           </a>
           <ul>
               <!-- <li><a href="<?= site_url('admin/users/save') ?>"><i class="fa fa-angle-right"></i>&nbsp; Добавить</a>
               </li>-->
               <!--<li><a href="<?= site_url('admin/users') ?>"><i class="fa fa-angle-right"></i>&nbsp; Список</a></li>-->
               <li><a href="<?= site_url('admin/users/index/admin') ?>"><i class="fa fa-angle-right"></i>&nbsp; Список</a></li>
           </ul>
       </li>

       <li class="<?= ($sel == 'menu' || $sel == 'footer_menu') ? 'active' : '' ?>">
           <a href="javascript:;">
               <i class="fa fa-home"></i>
               <span class="link-title">Меню</span>
               <span class="fa arrow"></span>
           </a>
           <ul>
               <li><a href="<?= site_url('admin/menu') ?>"><i class="fa fa-angle-right"></i>&nbsp; Список</a></li>
               <!--<li><a href="<?= site_url('admin/posts/index/footer_menu') ?>"><i class="fa fa-angle-right"></i>&nbsp; Футер</a></li>-->
           </ul>
       </li>

       <style>
           #menu li>ul.ul-menu {
               min-width: 400px;
           }

           #menu li.active>ul.ul-menu {
               min-width: inherit;
           }
       </style>







       <li class="<?= ($sel == 'statistics') ? 'active' : '' ?>">
           <a href="javascript:;">
               <i class="fa fa-sliders"></i>
               <span class="link-title">Показатели</span>
               <span class="fa arrow"></span>
           </a>
           <ul>

               <li>
                   <a href="<?= site_url('admin/posts/index/statistics') ?>">
                       <i class="fa fa-angle-right"></i>&nbsp; Список
                   </a>
               </li>

           </ul>
       </li>

       <li class="<?= ($sel == 'services') ? 'active' : '' ?>">
           <a href="javascript:;">
               <i class="fa fa-th"></i>
               <span class="link-title">Услуги</span>
               <span class="fa arrow"></span>
           </a>
           <ul>
               <li><a href="<?= site_url('admin/posts/index/services') ?>"><i class="fa fa-angle-right"></i>&nbsp;
                       Список</a></li>

           </ul>
       </li>

       <li class="<?= ($sel == 'news') ? 'active' : '' ?>">
           <a href="javascript:;">
               <i class="fa fa-retweet"></i>
               <span class="link-title">Новости</span>
               <span class="fa arrow"></span>
           </a>
           <ul>
               <li><a href="<?= site_url('admin/posts/index/news') ?>"><i class="fa fa-angle-right"></i>&nbsp;
                       Список</a></li>

           </ul>
       </li>


       <li class="<?= ($sel == 'stages_work') ? 'active' : '' ?>">
           <a href="javascript:;">
               <i class="fa fa-sliders"></i>
               <span class="link-title">Этапы работы</span>
               <span class="fa arrow"></span>
           </a>
           <ul>
               <li><a href="<?= site_url('admin/posts/index/stages_work') ?>"><i class="fa fa-angle-right"></i>&nbsp;
                       Список</a></li>


           </ul>
       </li>


       <li class="<?= ($sel == 'specialization') ? 'active' : '' ?>">
           <a href="javascript:;">
               <i class="fa fa-th"></i>
               <span class="link-title">Специализация</span>
               <span class="fa arrow"></span>
           </a>
           <ul>
               <li><a href="<?= site_url('admin/posts/index/specialization') ?>"><i class="fa fa-angle-right"></i>&nbsp;
                       Список</a></li>
           </ul>
       </li>


       <li class="<?= ($sel == 'usefuls') ? 'active' : '' ?>">
           <a href="javascript:;">
               <i class="fa fa-handshake-o" aria-hidden="true"></i>
               <span class="link-title">Партнеры</span>
               <span class="fa arrow"></span>
           </a>
           <ul>
               <li><a href="<?= site_url('admin/posts/index/usefuls') ?>"><i class="fa fa-angle-right"></i>&nbsp;
                       Список</a></li>
           </ul>
       </li>




       <li class="<?= ($sel == 'contacts') ? 'active' : '' ?>">
           <a href="javascript:;">

               <i class="fa fa-comments-o"></i>
               <span class="link-title">Обратная связь</span>
               <span class="fa arrow"></span>
           </a>
           <ul>
               <li><a href="<?//= site_url('admin/feed/index/feedback') ?><?= site_url('admin/contacts') ?>"><i class="fa fa-angle-right"></i>&nbsp; Список</a>
               </li>
           </ul>
       </li>
       <!--<li class="<?= ($sel == 'virtual') ? 'active' : '' ?>">
            <a href="javascript:;">
                
                <i class="fa fa-comments-o"></i>
                <span class="link-title">Виртуальная приемная</span>
                <span class="fa arrow"></span>
            </a>
            <ul>
        <li><a href="<?= site_url('admin/virtual') ?>"><i class="fa fa-angle-right"></i>&nbsp; Список</a>
        </li>
            </ul>
        </li>-->



       <!--
        <li class="<?= ($sel == 'reviews') ? 'active' : '' ?>">
            <a href="javascript:;">
                <i class="fa fa-th"></i>
                <span class="link-title">Отзывы</span>
                <span class="fa arrow"></span>
            </a>
            <ul>
                <li><a href="<?= site_url('admin/reviews') ?>"><i class="fa fa-angle-right"></i>&nbsp;
                        Список</a></li>
            </ul>
        </li>-->
       <!--  <li class="<?= ($sel == 'slides') ? 'active' : '' ?>">
            <a href="javascript:;">
                <i class="fa fa-sliders"></i>
                <span class="link-title">Слайдер</span>
                <span class="fa arrow"></span>
            </a>
            <ul>
                <li><a href="<?= site_url('admin/posts/index/slides') ?>"><i class="fa fa-angle-right"></i>&nbsp;
                        Список</a></li>
            </ul>
        </li>-->

       <!--<li class="<?= ($sel == 'partners') ? 'active' : '' ?>">
            <a href="javascript:;">
                <i class="fa fa-sliders"></i>
                <span class="link-title">Партнеры</span>
                <span class="fa arrow"></span>
            </a>
            <ul>
                <li><a href="<?= site_url('admin/posts/index/partners') ?>"><i class="fa fa-angle-right"></i>&nbsp;
                        Список</a></li>
            </ul>
        </li>
        <li class="<?= ($sel == 'advantages') ? 'active' : '' ?>">
            <a href="javascript:;">
                <i class="fa fa-sliders"></i>
                <span class="link-title">Преимущества</span>
                <span class="fa arrow"></span>
            </a>
            <ul>
                <li><a href="<?= site_url('admin/posts/index/advantages') ?>"><i class="fa fa-angle-right"></i>&nbsp;
                        Список</a></li>
            </ul>
        </li>
        -->
       <!--  <li class="<?= ($sel == 'video' || $sel == 'banner' || $sel == 'banner_1' || $sel == 'gallery') ? 'active' : '' ?>">
           <a href="javascript:;">
               <i class="fa fa-th"></i>
               <span class="link-title">Медиа</span>
               <span class="fa arrow"></span>
           </a>
           <ul>
                <li>
                   <a href="<?= site_url('admin/posts/index/gallery') ?>">
                       <i class="fa fa-angle-right"></i>&nbsp; Галерея
                   </a>
                </li>
                <li>
                   <a href="<?= site_url('admin/posts/index/video') ?>"><i class="fa fa-angle-right"></i>&nbsp; Видео</a>
                </li>
                <li>
                    <a href="<?= site_url('admin/posts/index/banner_1') ?>">
                        <i class="fa fa-angle-right"></i>&nbsp; Баннер
                    </a>
                </li>
           </ul>
        </li>
        -->
       <li class="<?= ($sel == 'pages') ? 'active' : '' ?>">
           <a href="javascript:;">
               <i class="fa fa-comments-o"></i>
               <span class="link-title">Настройки</span>
               <span class="fa arrow"></span>
           </a>
           <ul>
               <li>
                   <a href="<?= site_url('admin/posts/index/pages') ?>">
                       <i class="fa fa-angle-right"></i>&nbsp; Список
                   </a>
               </li>
               <!--<li><a href="<?= site_url('admin/posts/index/social') ?>"><i class="fa fa-angle-right"></i>&nbsp;
                       Соц. сети</a></li>-->
               <!-- <li>
                   <a href="<?= site_url('admin/posts/index/region_option') ?>">
                       <i class="fa fa-angle-right"></i>&nbsp; Регионы
                   </a>
               </li>
               -->

               <!-- <li><a href="<?= site_url('admin/fv/regions') ?>"><i class="fa fa-angle-right"></i>&nbsp;
                    Регионы</a></li>
            <li><a href="<?= site_url('admin/fv/city') ?>"><i class="fa fa-angle-right"></i>&nbsp;
                    Города, районы</a></li>-->
           </ul>
       </li>

       <!--<li class="<?= ($sel == 'question') ? 'active' : '' ?>">
            <a href="javascript:;">
                <i class="fa fa-retweet"></i>
                <span class="link-title">FAQ</span>
                <span class="fa arrow"></span>
            </a>
            <ul>
				<li><a href="<?= site_url('admin/posts/index/question') ?>"><i class="fa fa-angle-right"></i>&nbsp; Список</a></li>
            </ul>
        </li>-->

       <!-- <li class="<?= ($sel == 'contacts') ? 'active' : '' ?>">
           <a href="javascript:;">
               <i class="fa fa-comments-o"></i>
               <span class="link-title">Обратная связь</span>
               <span class="fa arrow"></span>
           </a>
           <ul>
               <li>
                   <a href="<?= site_url('admin/contacts') ?>">
                       <i class="fa fa-angle-right"></i>&nbsp; Список
                   </a>
               </li>
           </ul>
       </li> -->






   <?php
    } ?>