// $(document).ready(function () {
//     var banner = $('.banner__carousel')
//     $(banner).owlCarousel({
//         items: 1,
//         loop: true,
//         dots: false,
//         nav: false,
//         animateIn: 'fadeIn',
//         animateOut: 'fadeOut',
//         autoplay: false,
//         autoplayTimeout: 5000,
//         smartSpeed: 800,
//         touchDrag: false,
//         mouseDrag: false,
//     })
//     $('.banner__next').click(function () {
//         banner.trigger('next.owl.carousel');
//     });
//     $('.banner__prev').click(function () {
//         banner.trigger('prev.owl.carousel');
//     });
//     var help = $('.help__main__carousel')
//     $(help).owlCarousel({
//         items: 6,
//         loop: true,
//         lazyLoad: true,
//         margin: 30,
//         dots: false,
//         nav: false,
//         autoplay: true,
//         slideTransition: 'linear',
//         autoplaySpeed: 1500,
//         smartSpeed: 800,
//         autoplayHoverPause: true,

//     })
//     $('.help__next').click(function () {
//         help.trigger('next.owl.carousel');
//     });
//     $('.help__prev').click(function () {
//         help.trigger('prev.owl.carousel');
//     });

//     var links = $('.links__main__carousel')
//     $(links).owlCarousel({
//         loop: true,
//         lazyLoad: true,
//         margin: 30,
//         dots: false,
//         nav: false,
//         autoplay: true,
//         animateIn: 'fadeIn',
//         animateOut: 'fadeOut',
//         slideTransition: 'linear',
//         autoplaySpeed: 500,
//         smartSpeed: 800,
//         autoplayHoverPause: true,
//         items: 3,
//         responsive: {
//             0: {
//                 items: 1,
//                 margin: 15
//             },
//             768: {
//                 items: 2,
//                 margin: 20
//             },
//             1071: {
//                 items: 3,
//                 margin: 20
//             },
//             1480: {
//                 margin: 25
//             }
//         }
//     })
//     $('.links__prev').click(function () {
//         links.trigger('next.owl.carousel');
//     });
//     $('.links__next').click(function () {
//         links.trigger('prev.owl.carousel');
//     });

// });