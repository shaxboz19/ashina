<section class="banner">
    <div class="container">
        <div class="banner__info">
            <h1>Развиваем бизнес
                профессионально</h1>

            <p>Решение вопросов, обеспечение максимального
                роста и эффективности бизнеса и проектов клиентов</p>
            <a href="#!">
                <span>Подробнее</span>
                <i class="icon-circle-right"></i>

            </a>
        </div>
    </div>

</section>

<div class="gradient">

    <section class="about">
        <div class="container">
            <div class="about__main">
                <div class="about__main__image">
                    <div class="about__main__image__frame">
                        <img src="<?= get_resource_url() ?>/images/frame.png" alt>
                    </div>
                    <a href="<?= base_url('uploads/pages/' . mediaNotMain(10, 'url', '1')) ?>" data-fancybox="fancybox">
                        <img src="<?= base_url('uploads/pages/' . mediaNotMain(10, 'url', '1')) ?>" alt>
                    </a>
                </div>
                <div class="about__main__info">
                    <div class="about__main__info__title title">
                        <h2>О компании</h2>
                    </div>
                    <div class="about__main__info__text">
                        <p><?= strip_tags(_t(getPosts(10, 'short_content'), LANG)) ?></p>
                    </div>
                    <div class="about__main__info__menu">
                        <ul id="counter">
                            <? foreach($statistics as $item): ?>
                            <li>
                                <div class="top">
                                    <span class="counter-value" data-count="<?= $item->value_1 ?>"></span>
                                    <img src="<?= get_resource_url() ?>/images/logo-item.png" alt>
                                </div>
                                <p> <?= _t($item->title, LANG) ?></p>
                            </li>

                            <? endforeach;?>
                        </ul>
                    </div>

                </div>


            </div>
        </div>
        <script>
            $(document).ready(function() {
                var a = 0;
                $(window).scroll(function() {

                    var oTop = $('#counter').offset().top - window.innerHeight;
                    if (a == 0 && $(window).scrollTop() > oTop) {
                        $('.counter-value').each(function() {
                            var $this = $(this),
                                countTo = $this.attr('data-count');
                            $({
                                countNum: $this.text()
                            }).animate({
                                    countNum: countTo
                                },

                                {

                                    duration: 2000,
                                    easing: 'swing',
                                    step: function() {
                                        $this.text(Math.floor(this.countNum));
                                    },
                                    complete: function() {
                                        $this.text(this.countNum);
                                        //alert('finished');
                                    }

                                });
                        });
                        a = 1;
                    }

                });
            });
        </script>
    </section>
    <section class="specialists">
        <div class="container">
            <div class="specialists__main">
                <div class="specialists__main__title title">
                    <h2>Специализация</h2>
                </div>
                <div class="specialists__main__carousel owl-carousel owl-theme">
                    <?foreach($specialization as $item):?>
                    <div class="item">
                        <div class="specialists__main__carousel__item">
                            <img src="<?= base_url() . 'uploads/' . $item->group . '/' . $item->url ?>" alt>
                            <p><?= _t($item->title, LANG) ?>
                            </p>
                        </div>
                    </div>
                    <? endforeach; ?>


                </div>
            </div>
        </div>
    </section>
    <section class="services">
        <div class="container">
            <div class="services__main">
                <div class="services__main__carousel owl-carousel owl-theme">
                    <?foreach($services as $item): ?>
                    <div class="item">
                        <div class="services__main__carousel__item">
                            <div class="services__main__carousel__item__image">
                                <img src="<?= base_url() . 'uploads/' . $item->group . '/' . $item->url ?>" alt>
                                <div class="services__main__carousel__item__image__icon">
                                    <img src="<?= get_resource_url() ?>/images/service2.2.png" alt>
                                </div>
                                <div class="services__main__carousel__item__image__frame">
                                    <img src="<?= get_resource_url() ?>/images/frame.png" alt>
                                </div>
                            </div>
                            <div class="services__main__carousel__item__info">
                                <div class="services__main__carousel__item__info__title title">
                                    <h2>Услуги</h2>
                                </div>
                                <h3><?= _t($item->title, LANG) ?></h3>
                                <p><?= strip_tags(_t($item->short_content, LANG)) ?></p>
                                <div class="services__main__carousel__item__info__footer">
                                    <a href="#!">
                                        <span><?= lang('read_more') ?></span>
                                        <i class="icon-circle-right"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <?endforeach;?>

                </div>
            </div>
        </div>
    </section>


    <section class="stage">
        <div class="container">
            <div class="stage__main">
                <div class="stage__main__info">
                    <div class="title stage__main__info__title">
                        <h2>Этапы работы</h2>
                    </div>
                    <div class="stage__main__info__menu">
                        <ul>
                            <? $i=1; foreach($stages_work as $item): ?>
                            <li>
                                <span>0<?= $i ?></span>
                                <p><?= _t($item->title, LANG) ?></p>
                            </li>
                            <?$i++; endforeach; ?>

                        </ul>
                    </div>

                </div>
                <div class="stage__main__image">
                    <div class="stage__main__image__img1">
                        <img src="<?= get_resource_url() ?>/images/stage1.jpg" alt>
                    </div>
                    <div class="stage__main__image__img2">
                        <img src="<?= get_resource_url() ?>/images/stage2.jpg" alt>
                    </div>
                    <div class="stage__main__image__frame">
                        <img src="<?= get_resource_url() ?>/images/frame.png" alt>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="partners">
        <div class="container">
            <div class="partners__main">
                <div class="partners__main__title title">
                    <h2>Партнеры</h2>
                    <div class="owl-control">
                        <span class="partners__prev">
                            <i class="icon-left1"></i>
                        </span>
                        <span class="partners__next">
                            <i class="icon-right1"></i>
                        </span>
                    </div>
                </div>
                <div class="partners__main__wrapper">
                    <div class="partners__main__wrapper__carousel owl-carousel owl-theme">
                        <?foreach($usefuls as $item): ?>
                        <div class="item">
                            <a href="<?= $item->option_3 ?>" target="_blank" class="partners__main__wrapper__item">
                                <img src="<?= base_url() . 'uploads/' . $item->group . '/' . $item->url ?>" alt>
                            </a>
                        </div>

                        <?endforeach;?>
                    </div>


                </div>
            </div>

        </div>
    </section>
</div>

<script>
    $(document).ready(function() {
        $('.specialists__main__carousel').owlCarousel({
            items: 6,
            loop: true,
            nav: true,
            dots: false,
            navText: ['<i class="icon-left2"></i>', '<i class="icon-right2"></i>'],
            margin: 30
        })

        $('.services__main__carousel').owlCarousel({
            items: 1,
            loop: true,
            nav: true,
            dots: false,
            smartSpeed: 1000,
            autoplay: true,
            slideSpeed: 300,
            fluidSpeed: 500,
            paginationSpeed: 400,
            autoplayHoverPause: true,
            autoplayTimeout: 8000,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            // touchDrag: false,
            // mouseDrag: false,
            navText: ['<i class="icon-left1"></i>', '<i class="icon-right1"></i>']

        })
        var partners = $('.partners__main__wrapper__carousel')
        partners.owlCarousel({
            items: 4,
            margin: 200,
            dots: false,
            nav: false,
            loop: true,
            smartSpeed: 1000,
            autoplay: true,
            slideSpeed: 300,
            fluidSpeed: 500,
            paginationSpeed: 400,
        })
        $('.partners__prev').click(function() {
            partners.trigger('prev.owl.carousel')
        })
        $('.partners__next').click(function() {
            partners.trigger('next.owl.carousel')
        })
    });
</script>