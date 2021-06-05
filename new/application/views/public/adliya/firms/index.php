<?php 
if (!empty($_GET)) {
            $new_get = array_filter($_GET);
            if (count($new_get) < count($_GET)) {
                $request_uri = parse_url('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], PHP_URL_PATH);
                header('Location: ' . $request_uri . '?' . http_build_query($new_get));
                exit;
            }
        }
?>
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
                            <li class="breadcrumb-item active" aria-current="page"><span><?=_t($title, LANG)?></span></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
foreach($firms_list as $item){
    @$nl[$item->id] = $item;
}
?>

<section class="pages">
    <div class="container">
        <div class="pages-content">
            <div class="row">
                <div class="col-lg-9 col-md-8">
                    <div class="content" id="newsPrint" data-aos="fade-up">
                    
                        <div class="content-body">
                             <div class="filter-services">
                             <h4><?=lang('search_filter_title1')?></h4>
                            <form action="" method="GET">
                                <div class="row">
                                 
                                    <div class="col-md-6">
                                        <div class="form-group vi-nopart">                                      
                                            <select id="region_id" name="region_id" class="form-control vi-nopart">
                                                <option value="" class="vi-nopart"><?=lang('region_filter')?></option>
                                                <? foreach($region as $item): ?>
                                                <option value="<?=$item->id_regions?>" <?//=($this->input->get('region_id') == $item->id_regions) ? 'selected' : ''?> class="vi-nopart"><?=_t($item->title, LANG)?></option>
                                                <? endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group vi-nopart">                                        
                                            <select id="city_id" name="city_id" class="form-control vi-nopart">
                                                <option value="" class="vi-nopart"><?=lang('area_filter')?></option>
                                                <? foreach($city as $item): ?>
                                                <option value="<?=$item->id_city?>" class="hidden vi-nopart" data-region_id="<?=$item->region_id?>" <?//=($this->input->get('city_id') == $item->id_city) ? 'selected' : ''?> ><?=_t($item->title, LANG)?></option>
                                                <? endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                        <div class="form-group vi-nopart">
                                           
                                            <select id="category_id" name="category_id" class="form-control vi-nopart">
                                                <option value="" class="vi-nopart"><?=lang('institution_filter')?> (<?=lang('area_filter')?>)</option>
                                                <? foreach($firms_list as $item): ?>
                                                <option value="<?=$item->id?>" class="hidden vi-nopart" data-region_id="<?=$item->category_id?>" <?//=($this->input->get('category_id') == $item->id_regions) ? 'selected' : ''?> data-city_id="<?=$item->category_id2?>"><?=_t($item->title, LANG)?></option>
                                                <? endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group vi-nopart">                                        
                                            <input type="text" name="title" class="form-control vi-nopart" id="title" placeholder="<?=lang('name_filter')?>" autocomplete="off">
                                        </div>
                                    </div>
                                  
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary"><?=lang('filter_btn_f')?></button>
                                        <?php if($this->input->get()){?>
                                        <a href="<?=site_url('firms')?>" class="btn btn-primary"><?=lang('otmena_f')?></a>
                                        <?php }?>
                                    </div>
                                </div>
                            </form>
                        </div>   
                        
                            <? foreach($firms as $item): ?>
                            <div class="services-item-block">
                                <a data-toggle="modal" class="services-btn" href="#services-<?=$item->id?>" data-lat="<?=@$nl[$item->category_id]->value_1?>" data-lng="<?=@$nl[$item->category_id]->value_2?>" data-id="<?=$item->id?>"><h4><?=_t($item->title, LANG)?></h4></a>
                                <p><?=_t(@$nl[$item->category_id]->category_title, LANG)?></p>
                                <p><?=_t(@$nl[$item->category_id]->title, LANG)?></p>
                                
                                
                            </div>
                          
                            <? endforeach; ?>
                            <div class="clearfix"></div>
                            <div class="pagination-main">
                                <?= $pagination; ?>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-12">
                    <?php $this->load->view('public/companents/sidebar'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmxLGnGs_zCNGYrKYIx2LpkC4-7mE-arc"></script>
<? foreach($firms as $item): ?> 
<div class="modal services-modal fade vi-nopart" id="services-<?=$item->id?>">
<div class="modal-dialog vi-nopart">
<div class="modal-content vi-nopart">
<div class="modal-header vi-nopart">
    <h4 class="modal-title vi-nopart"><?=_t($item->title, LANG)?></h4>
    <button type="button" class="close vi-nopart" data-dismiss="modal" aria-hidden="true">&times;</button>
    
</div>
<div class="modal-body vi-nopart">
<p class="vi-nopart"><?=_t(@$nl[$item->category_id]->title, LANG)?></p>
    <div class="services-address vi-nopart">                           
    <p class="vi-nopart"><?=_t(@$nl[$item->category_id]->category_title, LANG)?></p></div>
    <div id="map-<?=$item->id?>" class="vi-nopart map-google" style="height: 400px;display:none">
    </div>
</div>
</div>
</div>
</div>
<? endforeach; ?>
<script>

$('.services-btn').click(function () {
var lat_services = $(this).data('lat');
var lng_services = $(this).data('lng');
var title_text = $(this).text();
var id = $(this).data('id');
if(lat_services && lng_services){
setTimeout(function () {
    var options = {
        zoom: 14,
        center: {lat: lat_services, lng: lng_services}
    };
    var map = new google.maps.Map(document.getElementById('map-'+id), options);
    var marker = new google.maps.Marker({
        position: {
            lat: lat_services,
            lng: lng_services
        },
        title: title_text,
        visible: true
    });
    marker.setMap(map);
    $('#map-'+id).show();
}, 300);
}
});

$("#region_id").change(function(){
    let region = $(this).val();
    //console.log(region);
    $("#city_id option").each(function( index ) {
        if(region == $(this).data("region_id")){
            $(this).addClass("show");
        }else{
            $(this).removeClass("show");
        }
    });
    /*$("#category_id option").each(function( index ) {
        if(region == $(this).data("region_id")){
            $(this).addClass("show");
        }else{
            $(this).removeClass("show");
        }
    });*/
});
$("#city_id").change(function(){
    let city = $(this).val();
    $("#category_id option").each(function( index ) {
        if(city == $(this).data("city_id")){
            $(this).addClass("show");
        }else{
            $(this).removeClass("show");
        }
    });
});
</script>