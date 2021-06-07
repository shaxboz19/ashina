<section class="pages-banner d-flex align-items-center" data-parallax="scroll" data-background="<?=get_resource_url()?>images/7777.jpg">
    <div class="container">
        <div class="pages-header__main">
            <div class="title">
                <h1><?=_t($title,LANG)?></h1>
            </div>
            <div class="info">
                <div class="pages-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?=site_url()?>"><?=lang('home')?></a></li>
                            <?php if($category_id_title){?><li class="breadcrumb-item" aria-current="page"><span><?=_t(getPosts($category_id_title,'title'), LANG)?></span></li><?php }?>
                            <li class="breadcrumb-item active" aria-current="page"><span><?=_t($title, LANG)?></span></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<link href="<?=get_resource_url()?>mapsvg/mapsvg.css" rel="stylesheet">
<link href="<?=get_resource_url()?>mapsvg/nanoscroller.css" rel="stylesheet">
<script src="<?=get_resource_url()?>mapsvg/jquery.mousewheel.min.js"></script>
<script src="<?=get_resource_url()?>mapsvg/jquery.nanoscroller.min.js"></script>
<script src="<?=get_resource_url()?>mapsvg/mapsvg.js?v=0.1"></script>
<section class="map">
    <div class="container">
        <div class="title">
            <h2><?=lang('territory')?></h2>
        </div>
        <div class="map-main">
            <div class="map-main__container">
			 <input type="hidden" id="map-current" value="UZ-<?=$inspections[0]->option_5?>" />
			            <style>
                                    #<?= $inspections[0]->option_5 ?> {
                                        display: block;
                                       /* fill: rgb(237, 210, 144) !important;*/
                                    }
                                    .mapsvg-marker {
                                        display: none;
                                    }
                                </style>
                        <div id="mapsvg"></div>
						      <script type="text/javascript">
jQuery(document).ready(function(){
    var maps_slider = $('#map-slider');
maps_slider.owlCarousel({
    loop:false,
    margin:0,
    items:1,
    autoplay: false,
    nav:true,
    dots:false,
    touchDrag: false,
     mouseDrag: false,
    navText : ["<i class='icon-right-arrow'></i>","<i class='icon-right-arrow'></i>"],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    },
}).on('changed.owl.carousel', function(event) { 
    var current = event.item.index;
var src = $(event.target).find(".owl-item").eq(current).find(".item").data('map');
var mapcurrent = $('#map-current').val();
//$('#' + mapcurrent).css('display', 'none');
//$('#' + mapcurrent).css('fill', 'rgb(237, 210, 144) !important');
//$('#' + src).css('display', 'block');
var mapcurrent = $('#map-current').val(src);
});
var MapRegions = jQuery("#mapsvg").mapSvg({
	markerLastID: 1,
	width: 626,
	height: 408,
	colors: {
		baseDefault: "#000000",
		background: "rgba(255,255,255,0)",
		selected: 0,
		hover: 20,
		directory: "#fafafa",
		status: {},
		base: "#0b0c66",
		stroke: "#ffffff"
	},
	regions: {
		'UZ-AS': {
			disabled: true
		},
            <? foreach($inspections as $item): 
        ?>
        "UZ-<?=$item->option_5?>": {"content": '<?=_t($item->title, 'ru')?>',"title": '<?=_t($item->title, LANG)?>', <?php if($item->status == 'inactive'){?>'disabled':'true','fill': 'rgba(234,234,234,0.05)'<?php }?>},
        <? endforeach; ?>
	},
	viewBox: [-0.283223137254879, 0, 793.0537462745098, 516.87848],
    cursor: "pointer",
   // selected:false,
 colors: {
                                                baseDefault: "#000000",
                                                background: "rgba(234,234,234,0)",
                                                selected: "#47579dd4",
                                                hover: "#47579dd4",
                                                directory: "#eaeaea",
                                                status: {},
                                                base: "#47579D",
                                                stroke: "#eaeaec"
                                            },
                                            cursor: "pointer",
                                            // selected:false,
                                            zoom: {
                                                on: false,
                                                limit: [0, 10],
                                                delta: 2,
                                                buttons: {
                                                    on: true,
                                                    location: "right"
                                                },
                                                mousewheel: true
                                            },
                                            scroll: {
                                                on: false,
                                                limit: false,
                                                background: false,
                                                spacebar: false
                                            },
                                                tooltips: {mode: function(){
                return '<b>'+this.title+'</b>';
            }, on: false, priority: "local"},
                                            popovers: {
                                                mode: "off",
                                                on: false,
                                                priority: "local",
                                                position: "top",
                                                centerOn: true,
                                                width: 300,
                                                maxWidth: 50,
                                                maxHeight: 50,
                                                resetViewboxOnClose: true
                                            },
                                            onClick: function(e, mapsvg) {
                                                var region = this;
                                                var active_r = localStorage.getItem('active_region');
var cur_map = (active_r) ? active_r : $('#region_current').val();                               
                                                 $('.regions_list_'+cur_map).removeClass('active_regions'); //alert(region);
                                                 $('#'+cur_map).css('fill','rgb(71, 87, 157)');
                                                var item_id = $('.item_' + this.id).val();
                                                 $('#region_current').val(this.id);
    $('.regions_list_'+this.id).addClass('active_regions');  
    localStorage.setItem('active_region', this.id);                                                                                          
                                                var mapcurrent = $('#map-current').val();
                                                maps_slider.trigger('to.owl.carousel', item_id, 300);
                                            },
                                            afterLoad: function(e, mapsvg){
                                                //var map_current = $('#map-current').val();
                                                //$('.'+ map_current).addClass('active_region');  
                                                // console.log(map_current);
                                               var mapsvg = this;    
                                                  var active_r = localStorage.getItem('active_region');
                                                if(active_r){
                                                    var item_id = $('.item_' + active_r).val();
                                                   maps_slider.trigger('to.owl.carousel', item_id, 300); 
                                                   mapsvg.selectRegion(active_r);
                                                }else{
                                                    localStorage.removeItem('active_region'); 
                                                    var map_current = $('#map-current').val();
                                                mapsvg.selectRegion(map_current);
                                                }
                                            },
                                            gauge: {
                                                on: false,
                                                labels: {
                                                    low: "low",
                                                    high: "high"
                                                },
                                                colors: {
                                                    lowRGB: {
                                                        r: 85,
                                                        g: 0,
                                                        b: 0,
                                                        a: 1
                                                    },
                                                    highRGB: {
                                                        r: 238,
                                                        g: 0,
                                                        b: 0,
                                                        a: 1
                                                    },
                                                    low: "#550000",
                                                    high: "#ee0000",
                                                    diffRGB: {
                                                        r: 153,
                                                        g: 0,
                                                        b: 0,
                                                        a: 0
                                                    }
                                                },
                                                min: 0,
                                                max: false
                                            },
	source: "<?=get_resource_url()?>mapsvg/uzbekistan.svg",
	title: "Uzbekistan",
    loadingText: "",
	/*markers: [
    <? foreach($inspections as $item): ?>
    {
		id: "UZ-<?=$item->option_5?>",
		attached: true,
		isLink: false,
		data: {},
		src: "<?=get_resource_url()?>images/map-marker2.png",
		width: 27,
		height: 37,
		geoCoords: [<?=$item->option_3?>]
	},
    <? endforeach; ?>
    ],*/
	responsive: true
});
});
<?php 
/*
// 40.984415, 71.116903 - UZ-NG - Namangan
// 40.492176, 71.214965 - UZ-FA - Farg‘ona
// 40.734107, 72.158803 - UZ-AN - Andijon
// 40.445551, 68.702148 - UZ-SI - Sirdaryo
// 40.436222, 67.513156 - UZ-JI - Jizzax
// 39.827064, 66.39771 - UZ-SA - Samarqand
// 38.879264, 66.262876 - UZ-QA - Qashqadaryo
// 38.029129, 67.527088 - UZ-SU - Surxondaryo
// 42.150151, 64.370036 - UZ-NW - Navoiy
// 40.269185, 63.585547 - UZ-BU - Buxoro
// 43.124004, 60.60694 - UZ-QR - Qoraqalpog‘iston Respublikasi
// 41.547525, 60.484363 - UZ-XO - Xorazm
*/
?>
</script>
            </div>
			<?$i = 0; foreach($inspections as $item): ?>             
              <input type="hidden" class="item_UZ-<?=$item->option_5?>" value="<?=$i?>" />
              <?$i++; endforeach; ?>
            <div class="map-main__info">
			 <div id="map-slider" class="owl-carousel owl-theme">
                <?$i = 0; foreach($inspections as $item): ?>
               <div class="item" data-map="UZ-<?=$item->option_5?>">       
                <div class="map-main__info__top">
                    <div class="map-info__title">
                        <h5>
                            <?=lang('t_manage')?> <?= _t($item->title, LANG)?>
                        </h5>
                    </div>
                    <div class="map-info__list">
                        <?php if(_t($item->option_4, LANG)){?>
                        <div class="map-list__item">
                            <div class="map-item__icon">
                                <i class="icon-pin"></i>
                            </div>
                            <div class="map-item__text">
                                <a><?= _t($item->option_4, LANG)?></a>
                            </div>
                        </div>
                        <?php }?>
                        <?php if($item->option_1 || $item->value_3){?>
                        <div class="map-list__item">
                            <div class="map-item__icon">
                                <i class="icon-telephone"></i>
                            </div>
                            <div class="map-item__text">
                             <?php if($item->option_1){?>
                                <a href="tel:<?=$item->option_1?>"><?=lang('tel')?>: <?=$item->option_1?></a>
                                <?php }?>
                                 <?php if($item->value_3){?>
                                <a href="tel:<?=$item->value_3?>"><?=lang('fax')?>: <?=$item->value_3?></a>
                                <?php }?>
                            </div>
                        </div>
                        <?php }?>
                         <?php if($item->option_2){?>
                        <div class="map-list__item">
                            <div class="map-item__icon">
                                <i class="icon-message"></i>
                            </div>
                            <div class="map-item__text">
                               
                                <a href="mailto:<?=$item->option_2?>"><?=$item->option_2?></a>
                            </div>
                        </div>
                        <?php }?>
                        <?php if($item->value_2){?>
                        <div class="map-list__item">
                            <div class="map-item__icon">
                                <i class="icon-global"></i>
                            </div>
                            <div class="map-item__text">
                            <!-- <?// $website = getPostsAll(24)?> -->
                            <a href="http://<?=$item->value_2?>" target="blank"><?= $item->value_2?></a>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
				</div>
				 <?$i++; endforeach; ?>
				 </div>
            
            </div>
        </div>
    </div>
</section>