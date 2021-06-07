<?$months=array(
'1'=>'Jan',
'2'=>'Feb',
'3'=>'Mar',
'4'=>'Apr',
'5'=>'May',
'6'=>'Jun',
'7'=>'Jul',
'8'=>'Aug',
'9'=>'Sep',
'10'=>'Oct',
'11'=>'Nov',
'12'=>'Dec'
)?>

<? $chrome = 0; $firefox = 0; $opera = 0; $ie = 0; $safari=0; $other = 0;?>
<?foreach($users as $user):?>
    <?
        $br = explode(" ",$user->browser);
        if(!$user->mobile){
        switch($br[0]){
            case "Chrome": $chrome++; break;
            case "Firefox":
            case "Mozilla": $firefox++; break;
            case "Opera": $opera++; break;
            case "Internet": $ie++; break;
            case "Safari": $safari++;break;
            default: $other++; break;
        }
        }
    ?>

<?endforeach?>
<?php if($users){?>
<script src="<?=base_url().'assets/admin/js/chart/js/highcharts.js'?>"></script>
<script src="<?=base_url().'assets/admin/js/chart/js/highcharts-3d.js'?>"></script>
<script src="<?=base_url().'assets/admin/js/chart/js/modules/exporting.js'?>"></script>
<div class="charts_main" style="padding: 35px 0 35px;">

<div id="container_pie" class="col-md-6" style="height: 400px;"></div>
<script type="text/javascript">

    
            Highcharts.chart('container_pie', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Браузеры'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage}%</b>',
                percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(2) +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Browser share',
                data: [
                    ['Firefox',   <?=$firefox;?>],
                    ['IE',       <?=$ie?>],
                    {
                        name: 'Chrome',
                        y: <?=$chrome?>,
                        sliced: true,
                        selected: true
                    },
                    ['Safari',    <?=$safari?>],
                    ['Opera',     <?=$opera?>],
                    ['Others',   <?=$other?>]
                ]
            }]
        });
    


</script>
<?//php var_dump($users);?>
<?php //var_dump($mobile);

$result = $array= array_map("unserialize", array_unique( array_map("serialize", $mobile) ));

?>
<div id="container_1" class="col-md-6" style="height: 400px;"></div>

		<script type="text/javascript">
    

         Highcharts.chart('container_1', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: 'Мобильные устройства'
        },
   <?php if(!$mobile){?>
     subtitle: {
            text: 'Нет данных'
        },
        <?php }?>
        plotOptions: {
            pie: {
                 allowPointSelect: true,
                    cursor: 'pointer',
                innerSize: 100,
                depth: 45
            }
        },
        series: [{
                       
                name: "Количество",
                data: [
                  <?foreach($result as $user):?>
                <?php if($user->mobile) {?>    
                ['<?=$user->mobile;?>', <?=count_visitors_log($user->mobile, 'mobile')?>],
                  <?php }?>
            <? endforeach; ?> 
                ]   
          
            
        }]
    });

		</script>


<div class="clearfix"></div>


 
<!------- User activity --------------------------------------------------->

<div id="content">
    <div id="chart" style="min-width: 400px; height: 400px; margin: 35px auto"></div>
</div>

<script type="text/javascript">

      
           Highcharts.chart('chart', {  
            chart: {
                type: 'line',
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: 'Активность посетителей',
                x: -20 //center
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Количество посетителей'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
            series: [{
                name: 'Users',
                data: 
				[
				<?foreach($months as $month):?>
                <?$i=0?>
                <?foreach($users as $user):?>
				<?if ($month==date('M',strtotime($user->datetime))):?>

				<?$i++?>
				<?endif?>
				
				<?endforeach?>
				<?=$i?>,
				<?endforeach?>
				]
                
            }/*, {
                name: 'Users1',
                data: 
				[
				<?foreach($months as $month):?>
                <?$i=0?>
                <?foreach($users as $user):?>
				<?if ($month==date('M',strtotime($user->datetime))):?>

				<?$i++?>
				<?endif?>
				
				<?endforeach?>
				<?=$i?>,
				<?endforeach?>
				]
            }
            */
            ]
        });
   
</script>

</div><?php }?>