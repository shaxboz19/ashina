<div id="myjs">
    <link href="<?php echo base_url(); ?>assets/public/js/video-js/video-js.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/public/js/video-js/video.js"></script>
    <script>
        videojs.options.flash.swf = "<?php echo base_url(); ?>assets/public/js/video-js/video-js.swf";
    </script>
</div>
<div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Загрузить Медиа</h3>
    </div>

    
    <?=form_open_multipart('admin/media_poster/save', array('id'=>'media_form1'))?>
        <div class="modal-body">      
        <div class="alert alert-block"> 
        <div class="progress progress-info progress-striped">
                <div class="bar"></div >
                <div class="percent">0%</div >
            </div>   
            <span class="btn btn-success fileinput-button">
                <i class="icon-plus icon-white"></i>
                <span>Добавить</span>
                <input id="file1" type="file" name="userfile[]" multiple="">
            </span>
            <span class="btn btn-success fileinput-button delete_image1">
                <i class="icon-plus icon-white"></i>
                <span>Удалить все</span>                
            </span>
           
             <span class="btn btn-success fileinput-button delete_image_select1" >
                <i class="icon-plus icon-white"></i>
                <span>Удалить выбранные</span>                      
            </span>
            <input name="category" type="hidden" value="<?=@$sel?>" />
            <input name="post_id" type="hidden" value="<?=@$post->id?>" /> 
           
            <!--<button id="btnUpload" class="btn btn-primary"><i class="icon-upload icon-white"></i> Загрузить</button>-->
            
            
            </div>
            <div class="clearfix"></div>
               <div id="reset1">
            <ul class="thumbnails1" id="media_list1">
                 <?$i = 0; foreach ($media_files_poster as $mf): ?> 
                	<?php if($mf->category !== 'music') { ?>                           
                    <li class="thumb" data-id="<?=$mf->id?>">
                    <?php if($mf->category == 'video') {?>
                      
                        <a href="#" class="thumbnail tooltips video_src" data-value="<?=getPosts(getPostsMediaId($mf->id, 'post_id'), 'video_link')?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=@$mf->orig_name;?>">
                  
                          <i class="fa fa-play fa-6 icons-music-media"></i>
                       
                        </a>
                        <?php } else {?>
                          <a href="<?=base_url("uploads/{$mf->category}/{$mf->url}")?>" class="thumbnail fancybox tooltips" rel="group" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=@$mf->orig_name;?>">
                            <img src="<?=base_url("thumb/view/w/180/h/180/src/uploads/{$mf->category}/{$mf->url}")?>"/>
                        </a>
                        <?php }?>
                        <div class="btn-toolbar pull-right">
                            <div class="btn-group">
                                <a class="btn btn-mini move" href="#" title="Перемещать"><i class="fa fa-arrows"></i></a>
                                <a class="btn btn-mini <?=($mf->is_main) ? 'btn-info1' : ''?> ajax_set_main1" href="<?=base_url('admin/media_poster/set_main/'.$mf->id)?>" title="Сделать Главным"><i class="fa fa-arrow-up"></i></a>
                               <!--  <a class="btn btn-mini <?=($mf->lang ) ? 'lang_ru' : ''?> lang_ru" href="<?=base_url('admin/media_poster/lang_ru/'.$mf->id)?>" title="Русский">RU</a>
                                 
                                  <a class="btn btn-mini <?=($mf->lang) ? 'lang_oz' : ''?> lang_oz" href="<?=base_url('admin/media_poster/lang_oz/'.$mf->id)?>" title="O'zbekcha">OZ</a>-->
                                <a class="btn btn-mini btn-warning ajax_delete" href="<?=base_url('admin/media_poster/delete/'.$mf->id)?>" title="Удалить"><i class="fa fa-trash-o"></i></a>
                                <div class="btn btn-mini check">
                                                               <input type="checkbox"  value="<?=$mf->id;?>" id="<?=$mf->id;?>" name="img[]">
                                <label for='<?=$mf->id;?>'><span></span></label></div>                             
                        
                            </div>
                        </div>
                        
                    </li>
                    <?php  } else { ?>
                  
                              
                    <li class="thumb" data-id="<?=$mf->id?>">
                     <a href="" class="thumbnail tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=@$mf->orig_name;?>">
                  
                          <i class="fa fa-music fa-6 icons-music-media"></i>
           
                        </a>
                    <?//php echo $mf->url ?>
                    <div class="btn-toolbar pull-right">
                            <div class="btn-group">
                                <a class="btn btn-mini move" href="#" title="Перемещать"><i class="fa fa-arrows"></i></a>
                                <a class="btn btn-mini <?=($mf->is_main) ? 'btn-info1' : ''?> ajax_set_main1" href="<?=base_url('admin/media_poster/set_main/'.$mf->id)?>" title="Сделать Главным"><i class="fa fa-arrow-up"></i></a>
                                 <!--<a class="btn btn-mini <?=($mf->lang) ? 'lang_ru' : ''?> lang_ru" href="<?=base_url('admin/media_poster/lang_ru/'.$mf->id)?>" title="Русский"><i class="fa fa-arrow-up"></i></a>
                                 
                                  <a class="btn btn-mini <?=($mf->lang) ? 'lang_oz' : ''?> lang_oz" href="<?=base_url('admin/media_poster/lang_oz/'.$mf->id)?>" title="O'zbekcha"><i class="fa fa-arrow-up"></i></a>-->
                                <a class="btn btn-mini btn-warning ajax_delete" href="<?=base_url('admin/media_poster/delete/'.$mf->id)?>" title="Удалить"><i class="fa fa-trash-o"></i></a>
                                <div class="btn btn-mini check">
                                                               <input type="checkbox"  value="<?=$mf->id;?>" id="<?=$mf->id;?>" name="img[]">
                                <label for='<?=$mf->id;?>'><span></span></label></div>

                                
                            </div>
                        </div>
                        
                     </li>   
                    <?php } ?>                        
                <?$i++; endforeach; ?>
   
            </ul>
            </div>
        </div>
    </form>
</div>



<script>
(function() {
    
var bar1 = $('.bar');
var percent1 = $('.percent');
var status1 = $('#status');

$('#file1').change(function() { 
    $('#media_form1').submit(); 
});

$('#media_form1').ajaxForm({
    beforeSend: function() {
        status1.empty();
        var percentVal1 = '0%';
        bar1.width(percentVal1)
        percent1.html(percentVal1);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal1 = percentComplete + '%';
        bar1.width(percentVal1)        
        percent1.html(percentVal1);
        //console.log(percentVal, position, total);
    },
    success: function() {
        var percentVal1 = '100%';
        bar1.width(percentVal1)
        percent1.html(percentVal1);
    },
    complete: function(xhr) {
        var files1 = $.parseJSON( xhr.responseText );

        $.each(files1, function(i, val){
			if(typeof(val.error) == 'undefined' || val.error === null)
				$('ul.thumbnails1').prepend( template1(val.id, val.group, val.file) );
            else
				alert(val.error);
        })        
    }
}); 

})(); 
function template1(id, group, file, orig_name)
{
  <?php if(@$post->group == 'music') {?>
	if(group == 'music')
	{
		var temp1 = '<li class="thumb" data-id='+id+'><a href="" class="thumbnail tooltips" data-toggle="tooltip" data-placement="top" title="'+orig_name+'" data-original-title='+orig_name+'><i class="fa fa-music fa-6 icons-music-media"></i></a> \
			<div class="btn-toolbar pull-right"><div class="btn-group">       <a class="btn btn-mini move" href="#" title="Перемещать"><i class="fa fa-arrows"></i></a> \
					<a class="btn btn-mini ajax_set_main" href="<?=base_url("admin/media_poster/set_main/'+id+'")?>" title="Сделать Главным"><i class="fa fa-arrow-up"></i></a> \
					<a class="btn btn-mini btn-warning ajax_delete" href="<?=base_url("admin/media_poster/delete/'+id+'")?>" title="Удалить"><i class="fa fa-trash-o"></i></a> <div class="btn btn-mini check"><input type="checkbox"  value='+id+' id='+id+'  name="img[]"><label for='+id+'><span></span></label></div> \
			</div></li>';
	}
  <?php } else {?>
  	if(group == 'video')
	{
		var temp1 = '<li class="thumb" data-id='+id+'><a href="" class="thumbnail tooltips" data-toggle="tooltip" data-placement="top" title="'+orig_name+'" data-original-title='+orig_name+'><i class="fa fa-play fa-6 icons-music-media"></i></a> \
			<div class="btn-toolbar pull-right"><div class="btn-group"> <a class="btn btn-mini move" href="#" title="Перемещать"><i class="fa fa-arrows"></i></a> \
					<a class="btn btn-mini ajax_set_main" href="<?=base_url("admin/media_poster/set_main/'+id+'")?>" title="Сделать Главным"><i class="fa fa-arrow-up"></i></a> \
					<a class="btn btn-mini btn-warning ajax_delete" href="<?=base_url("admin/media_poster/delete/'+id+'")?>" title="Удалить"><i class="fa fa-trash-o"></i></a> <div class="btn btn-mini check"><input type="checkbox"  value='+id+' id='+id+'  name="img[]"><label for='+id+'><span></span></label></div> \
				</div> \
			</div></li>';
	}
  
  <?php }?>
	else
	{
		var temp1 = 
		'<li class="thumb" data-id='+id+'><a href="<?=base_url("uploads/'+group+'/'+file+'")?>" class="thumbnail fancybox tooltips" rel="group" data-toggle="tooltip" data-placement="top" title="'+orig_name+'" data-original-title='+orig_name+'> \
				<img src="<?=base_url("thumb/view/w/180/h/180/src/uploads/'+group+'/'+file+'")?>" /></a> \
			<div class="btn-toolbar pull-right"><div class="btn-group">       <a class="btn btn-mini move" href="#" title="Перемещать"><i class="fa fa-arrows"></i></a> \
					<a class="btn btn-mini ajax_set_main" href="<?=base_url("admin/media_poster/set_main/'+id+'")?>" title="Сделать Главным"><i class="fa fa-arrow-up"></i></a> \
					<a class="btn btn-mini btn-warning ajax_delete" href="<?=base_url("admin/media_poster/delete/'+id+'")?>" title="Удалить"><i class="fa fa-trash-o"></i></a> <div class="btn btn-mini check"><input type="checkbox"  value='+id+' id='+id+'  name="img[]"><label for='+id+'><span></span></label></div> \
				</div> \
			</div></li>';
	}	
    
	return temp1;
}

$("#media_list1")
    .sortable({
        handle: ".move",
        stop: function( event, ui ) {
            var thumbs1 = [];

            $('.thumb').each(function(i){
                var obj = {
                    id: $(this).attr('data-id'),
                    sort_order: i
                };

                thumbs1.push(obj);
            });

            $.post(base_url + 'admin/media_poster/sort', {media_files_poster: JSON.stringify(thumbs1)});
        }
    });
    /*.selectable({
        handle: ".thumbnail",
    });*/
  
$(document).on('click', '.delete_image1', function(){
		if (!confirm("Вы уверены ?")) {
	        return false;
	    }
	    else {
	    	$('#media_list1').html('<li  style="float: none;"><div class="loader" style="margin: 35px auto;width: 0;padding-bottom: 1px;"><div class="loader-inner ball-spin-fade-loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div></li>');
    $.ajax({
        type: 'post',
		<?php if(@$post->id){?>
        url: '<?=base_url()?>'+'admin/posts/delete_image1/<?=@$post->id?>',
		<?php }?>
        success: function(data){
         //$('#close').addClass('none');
           // $('.collapse').removeClass('in');
            $('#media_list1').html(data.result);
            $('#image1').delay(2000).fadeOut();
            
        },
        error: function(data){}
    });
    return true;      	
	    }
	});
$(document).on('click', '.delete_image_select1', function(){
  if ($('input:checkbox:checked').prop("checked")) {
		if (!confirm("Вы уверены ?")) {
	        return false;
	    }
      else {  
         var img = $('input:checkbox:checked').map(function() {return this.value;}).get();
    var post_id = $('#post_id').val();

    	    	$('#media_list1').html('<li style="float: none;"><div class="loader" style="margin: 35px auto;width: 0;padding-bottom: 1px;"><div class="loader-inner ball-spin-fade-loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div></li>');
  
    $.ajax({
        type: 'post',
        url: '<?=base_url()?>'+'admin/posts/delete_image_select1',
        data: { img:  img, post_id: post_id},
        success: function(data){
         //$('#close').addClass('none');
           // $('.collapse').removeClass('in');
          $('#media_list1').html(data.result);
          $(".move").addClass('none');
            $('#image1').delay(2000).fadeOut();
            $("#reset1").load(location.href + " #reset1");
             
             
          
        },
        error: function(data){}
    });
    return true; 
    }   
    } else {
      alert("Файлы не выбраны!");
    }
  
});

</script>