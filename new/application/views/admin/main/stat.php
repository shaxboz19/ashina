<script src="<?=base_url().'assets/admin/js/chart/js/highcharts.js'?>"></script>
<script src="<?=base_url().'assets/admin/js/chart/js/highcharts-3d.js'?>"></script>
<script src="<?=base_url().'assets/admin/js/chart/js/modules/exporting.js'?>"></script>


<div id="container_pie" class="col-md-12"></div>


      <script>
                        Highcharts.chart('container_pie', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45
        },
        backgroundColor: null
    },
    <?php $all_count_pie = $news_c + $img + $doc_all + $menu_s + $pages_count + $stats_s + $laws_s + $opendata_s + $media_c + $advert_s + $faq_s;?>
    title: {
        text: 'Общая статистика (<?=$all_count_pie;?>)'
    },
    subtitle: {
       // text: '3D donut in Highcharts'
    },
    exporting: {
         enabled: false
},    
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            innerSize: 100,
            depth: 45,
            dataLabels: {
            enabled: true,           
            style: { fontFamily: '\'OpenSans\', sans-serif', lineHeight: '18px', fontSize: '17px' }
        }
        }
    },
    /*colors:[
       '#02a2dc',
        '#fcbf4a',
        '#808080',
        '#ff0000',
       '#58b182'
    ],*/
    series: [{
        name: 'Статистика',        
        data: [
            ['Новости: <?php print $news_c; ?>',  <?php print $news_c; ?>],
            ['Картинки: <?php print $img;?>', <?=$img ?>],
            ['Документы (pdf,doc): <?php print $doc_all; ?>', <?php print $doc_all; ?>],
            ['Меню: <?php print $menu_s; ?>', <?php print $menu_s; ?>],
            ['Страницы: <?php print $pages_count; ?>', <?php print $pages_count; ?>], 
            ['Статистика (меню): <?php print $stats_s; ?>', <?php print $stats_s; ?>], 
            ['Законодательство (меню): <?php print $laws_s; ?>', <?php print $laws_s; ?>],
            ['Открытые данные: <?php print $opendata_s; ?>', <?php print $opendata_s; ?>],
            ['Медиа: <?php print $media_c; ?>', <?php print $media_c; ?>],
            ['Объявления: <?php print $advert_s; ?>', <?php print $advert_s; ?>],
            ['Вопросы и ответы: <?php print $faq_s; ?>', <?php print $faq_s; ?>],
                       
        ]
    }]
});
                        </script>