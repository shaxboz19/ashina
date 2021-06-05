<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Загрузить Медиа</h3>
    </div>

    
    <?=form_open_multipart('admin/media/save', array('id'=>'media_form'))?>
        <div class="modal-body">      
        <div class="alert alert-block"> 
        <div class="progress progress-info progress-striped">
                <div class="bar"></div >
                <div class="percent">0%</div >
            </div>   
            <span class="btn btn-success fileinput-button">
                <i class="icon-plus icon-white"></i>
                <span>Добавить</span>
                <input id="file" type="file" name="userfile[]" multiple="">
            </span>
            <span class="btn btn-success fileinput-button delete_image">
                <i class="icon-plus icon-white"></i>
                <span>Удалить все</span>                
            </span>
           
             <span class="btn btn-success fileinput-button delete_image_select" >
                <i class="icon-plus icon-white"></i>
                <span>Удалить выбранные</span>                      
            </span>
            <input name="category" type="hidden" value="<?=@$sel?>" />
            <input name="post_id" type="hidden" value="<?=@$post->id?>" /> 
           
            <!--<button id="btnUpload" class="btn btn-primary"><i class="icon-upload icon-white"></i> Загрузить</button>-->
            
            
            </div>
            <div class="clearfix"></div>
               <div id="reset">
            <ul class="thumbnails" id="media_list">
                 <?$i = 0; foreach ($media_files as $mf): ?> 
                	<?php if($mf->category !== 'music') { ?>                           
                    <li class="thumb" data-id="<?=$mf->id?>">
                    <?php if($mf->category == 'video') {?>
                      
                        <a href="" class="thumbnail tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=@$mf->orig_name;?>">
                  
                          <i class="fa fa-play fa-6 icons-music-media"></i>
                       
                        </a>
                        <?php } else {?>
                          <a href="<?=base_url("uploads/{$mf->category}/{$mf->url}")?>" class="thumbnail fancybox tooltips" rel="group" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?//=@$mf->orig_name;?>">
                            <img src="<?=base_url("thumb/view/w/180/h/180/src/uploads/{$mf->category}/{$mf->url}")?>"/>
                        </a>
                        <?php }?>
                        <div class="btn-toolbar pull-right">
                        <?php if($sel == 'banner_1' || $sel == 'gazeta' || $sel == 'banner' || $sel == 'partners' || $sel == 'fact' || $sel == 'documents_file' || $sel == 'business_plan' || $sel == 'regulations' || $sel == 'docs' || $sel == 'documentation1' || $sel == 'manufacturers'){?>
                         <select name="lang" id="lang_status" data-imgid="<?=$mf->id;?>">
                            <option>Язык</option>
                 <option value="ru" <?= ($mf->lang == 'ru') ? 'selected' : '' ?>>Ru</option>
                <option value="uz" <?= ($mf->lang  == 'uz') ? 'selected' : '' ?>>Uz</option>
                <option value="oz" <?= ($mf->lang  == 'oz') ? 'selected' : '' ?>>O'z</option>
                <option value="en" <?= ($mf->lang  == 'en') ? 'selected' : '' ?>>En</option>
                            </select>
                            <?php }?>
                            <div class="btn-group">    
                                <a class="btn btn-mini move" href="#" title="Перемещать"><i class="fa fa-arrows"></i></a>
                                <a class="btn btn-mini <?=($mf->is_main) ? 'btn-info' : ''?> ajax_set_main" href="<?=base_url('admin/media/set_main/'.$mf->id)?>" title="Сделать Главным"><i class="fa fa-arrow-up"></i></a>
                                <a class="btn btn-mini btn-warning ajax_delete" href="<?=base_url('admin/media/delete/'.$mf->id)?>" title="Удалить"><i class="fa fa-trash-o"></i></a>
                                <div class="btn btn-mini check">
                                                               <input type="checkbox"  value="<?=$mf->id;?>" id="<?=$mf->id;?>" name="img[]">
                                <label for='<?=$mf->id;?>'><span></span></label></div>                             
                        
                            </div>
                        </div>
                        
                    </li>
                    <?php  } else { ?>
                  
                              
                    <li class="thumb" data-id="<?=$mf->id?>">
                     <a href="" class="thumbnail tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?//=@$mf->orig_name;?>">
                  
                          <i class="fa fa-music fa-6 icons-music-media"></i>
           
                        </a>
                    <?//php echo $mf->url ?>
                    <div class="btn-toolbar pull-right">
                       <?php if($sel == 'banner_1' || $sel == 'banner' || $sel == 'gazeta' || $sel == 'partners' || $sel == 'fact' || $sel == 'documents_file' || $sel == 'business_plan' || $sel == 'regulations' || $sel == 'docs' || $sel == 'documentation1' || $sel == 'manufacturers'){?>
                         <select name="lang" id="lang_status" data-imgid="<?=$mf->id;?>">
                         <option>Язык</option>
                            <option value="ru" <?= ($mf->lang == 'ru') ? 'selected' : '' ?>>Ru</option>
                            <option value="uz" <?= ($mf->lang  == 'uz') ? 'selected' : '' ?>>Uz</option>
                            <option value="oz" <?= ($mf->lang  == 'oz') ? 'selected' : '' ?>>O'z</option>
                            <option value="en" <?= ($mf->lang  == 'en') ? 'selected' : '' ?>>En</option>
                            </select>
                            <?php }?>
                            <div class="btn-group">
                                <a class="btn btn-mini move" href="#" title="Перемещать"><i class="fa fa-arrows"></i></a>
                                <a class="btn btn-mini <?=($mf->is_main) ? 'btn-info' : ''?> ajax_set_main" href="<?=base_url('admin/media/set_main/'.$mf->id)?>" title="Сделать Главным"><i class="fa fa-arrow-up"></i></a>
                                <a class="btn btn-mini btn-warning ajax_delete" href="<?=base_url('admin/media/delete/'.$mf->id)?>" title="Удалить"><i class="fa fa-trash-o"></i></a>
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
    
var bar = $('.bar');
var percent = $('.percent');
var status = $('#status');

$('#file').change(function() { 
    $('#media_form').submit(); 
});

$('#media_form').ajaxForm({
    beforeSend: function() {
        status.empty();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)        
        percent.html(percentVal);
        //console.log(percentVal, position, total);
    },
    success: function() {
        var percentVal = '100%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    complete: function(xhr) {
        var files = $.parseJSON( xhr.responseText );

        $.each(files, function(i, val){
			if(typeof(val.error) == 'undefined' || val.error === null)
				$('ul.thumbnails').prepend( template(val.id, val.group, val.file) );
            else
				alert(val.error);
        })        
    }
}); 

})(); 

function template(id, group, file, orig_name)
{
  <?php if(@$post->group == 'music') {?>
	if(group == 'music')
	{
		var temp = '<li class="thumb" data-id='+id+'><a href="" class="thumbnail tooltips" data-toggle="tooltip" data-placement="top" title="'+orig_name+'" data-original-title='+orig_name+'><i class="fa fa-music fa-6 icons-music-media"></i></a> \
			<div class="btn-toolbar pull-right"><div class="btn-group">       <a class="btn btn-mini move" href="#" title="Перемещать"><i class="fa fa-arrows"></i></a> \
					<a class="btn btn-mini ajax_set_main" href="<?=base_url("admin/media/set_main/'+id+'")?>" title="Сделать Главным"><i class="fa fa-arrow-up"></i></a> \
					<a class="btn btn-mini btn-warning ajax_delete" href="<?=base_url("admin/media/delete/'+id+'")?>" title="Удалить"><i class="fa fa-trash-o"></i></a> <div class="btn btn-mini check"><input type="checkbox"  value='+id+' id='+id+'  name="img[]"><label for='+id+'><span></span></label></div> \
			</div></li>';
	}
  <?php } else {?>
  	if(group == 'video')
	{
		var temp = '<li class="thumb" data-id='+id+'><a href="" class="thumbnail tooltips" data-toggle="tooltip" data-placement="top" title="'+orig_name+'" data-original-title='+orig_name+'><i class="fa fa-play fa-6 icons-music-media"></i></a> \
			<div class="btn-toolbar pull-right"><div class="btn-group"> <a class="btn btn-mini move" href="#" title="Перемещать"><i class="fa fa-arrows"></i></a> \
					<a class="btn btn-mini ajax_set_main" href="<?=base_url("admin/media/set_main/'+id+'")?>" title="Сделать Главным"><i class="fa fa-arrow-up"></i></a> \
					<a class="btn btn-mini btn-warning ajax_delete" href="<?=base_url("admin/media/delete/'+id+'")?>" title="Удалить"><i class="fa fa-trash-o"></i></a> <div class="btn btn-mini check"><input type="checkbox"  value='+id+' id='+id+'  name="img[]"><label for='+id+'><span></span></label></div> \
				</div> \
			</div></li>';
	}
  
  <?php }?>
	else
	{
	   <?php if(@$post->group == 'music') {?>
       // +orig_name+
		var temp = 
		'<li class="thumb" data-id='+id+'><a href="<?=base_url("uploads/'+group+'/'+file+'")?>" class="thumbnail fancybox tooltips" rel="group" data-toggle="tooltip" data-placement="top" title="'+orig_name+'" data-original-title=""> \
				<img src="<?=base_url("thumb/view/w/180/h/180/src/uploads/'+group+'/'+file+'")?>" /></a> \
			<div class="btn-toolbar pull-right"> <div class="btn-group">       <a class="btn btn-mini move" href="#" title="Перемещать"><i class="fa fa-arrows"></i></a> \
					<a class="btn btn-mini ajax_set_main" href="<?=base_url("admin/media/set_main/'+id+'")?>" title="Сделать Главным"><i class="fa fa-arrow-up"></i></a> \
					<a class="btn btn-mini btn-warning ajax_delete" href="<?=base_url("admin/media/delete/'+id+'")?>" title="Удалить"><i class="fa fa-trash-o"></i></a> <div class="btn btn-mini check"><input type="checkbox"  value='+id+' id='+id+'  name="img[]"><label for='+id+'><span></span></label></div> \
				</div> \
			</div></li>';
            <?php } else {?>
            <?php if($sel == 'banner_1' || $sel == 'banner' || $sel == 'gazeta' || $sel == 'partners' || $sel == 'fact' || $sel == 'documents_file' || $sel == 'business_plan' || $sel == 'regulations' || $sel == 'docs' || $sel == 'documentation1' || $sel == 'manufacturers'){?>
            	var temp = 
		'<li class="thumb" data-id='+id+'><a href="<?=base_url("uploads/'+group+'/'+file+'")?>" class="thumbnail fancybox tooltips" rel="group" data-toggle="tooltip" data-placement="top" title="'+orig_name+'" data-original-title=""> \
				<img src="<?=base_url("thumb/view/w/180/h/180/src/uploads/'+group+'/'+file+'")?>" /></a> \
			<div class="btn-toolbar pull-right"><select name="lang" id="lang_status" data-imgid='+id+'><option>Язык</option><option value="ru">Ru</option><option value="uz">Uz</option><option value="oz">O\'z</option><option value="en">En</option></select> <div class="btn-group">       <a class="btn btn-mini move" href="#" title="Перемещать"><i class="fa fa-arrows"></i></a> \
					<a class="btn btn-mini ajax_set_main" href="<?=base_url("admin/media/set_main/'+id+'")?>" title="Сделать Главным"><i class="fa fa-arrow-up"></i></a> \
					<a class="btn btn-mini btn-warning ajax_delete" href="<?=base_url("admin/media/delete/'+id+'")?>" title="Удалить"><i class="fa fa-trash-o"></i></a> <div class="btn btn-mini check"><input type="checkbox"  value='+id+' id='+id+'  name="img[]"><label for='+id+'><span></span></label></div> \
				</div> \
			</div></li>';
            <?php } else {?>
            	var temp = 
		'<li class="thumb" data-id='+id+'><a href="<?=base_url("uploads/'+group+'/'+file+'")?>" class="thumbnail fancybox tooltips" rel="group" data-toggle="tooltip" data-placement="top" title="'+orig_name+'" data-original-title=""> \
				<img src="<?=base_url("thumb/view/w/180/h/180/src/uploads/'+group+'/'+file+'")?>" /></a> \
			<div class="btn-toolbar pull-right"> <div class="btn-group">       <a class="btn btn-mini move" href="#" title="Перемещать"><i class="fa fa-arrows"></i></a> \
					<a class="btn btn-mini ajax_set_main" href="<?=base_url("admin/media/set_main/'+id+'")?>" title="Сделать Главным"><i class="fa fa-arrow-up"></i></a> \
					<a class="btn btn-mini btn-warning ajax_delete" href="<?=base_url("admin/media/delete/'+id+'")?>" title="Удалить"><i class="fa fa-trash-o"></i></a> <div class="btn btn-mini check"><input type="checkbox"  value='+id+' id='+id+'  name="img[]"><label for='+id+'><span></span></label></div> \
				</div> \
			</div></li>';
            <?php }?>
            <?php }?>
	}	
    
	return temp;
}

$("#media_list")
    .sortable({
        handle: ".move",
        stop: function( event, ui ) {
            var thumbs = [];

            $('.thumb').each(function(i){
                var obj = {
                    id: $(this).attr('data-id'),
                    sort_order: i
                };

                thumbs.push(obj);
            });

            $.post(base_url + 'admin/media/sort', {media_files: JSON.stringify(thumbs)});
        }
    });
    /*.selectable({
        handle: ".thumbnail",
    });*/
  
$(document).on('click', '.delete_image', function(){
		if (!confirm("Вы уверены ?")) {
	        return false;
	    }
	    else {
	    	$('#media_list').html('<li  style="float: none;"><div class="loader" style="margin: 35px auto;width: 0;padding-bottom: 1px;"><div class="loader-inner ball-spin-fade-loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div></li>');
    $.ajax({
        type: 'post',
        url: '<?=base_url()?>'+'admin/posts/delete_image/<?=@$post->id?>',
        success: function(data){
         //$('#close').addClass('none');
           // $('.collapse').removeClass('in');
            $('#media_list').html(data.result);
            $('#image').delay(2000).fadeOut();
            
        },
        error: function(data){}
    });
    return true;      	
	    }
	});
$(document).on('click', '.delete_image_select', function(){
  if ($('input:checkbox:checked').prop("checked")) {
		if (!confirm("Вы уверены ?")) {
	        return false;
	    }
      else {  
         var img = $('input:checkbox:checked').map(function() {return this.value;}).get();
    var post_id = $('#post_id').val();

    	    	$('#media_list').html('<li style="float: none;"><div class="loader" style="margin: 35px auto;width: 0;padding-bottom: 1px;"><div class="loader-inner ball-spin-fade-loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div></li>');
  
    $.ajax({
        type: 'post',
        url: '<?=base_url()?>'+'admin/posts/delete_image_select',
        data: { img:  img, post_id: post_id},
        success: function(data){
         //$('#close').addClass('none');
           // $('.collapse').removeClass('in');
          $('#media_list').html(data.result);
          $(".move").addClass('none');
            $('#image').delay(2000).fadeOut();
            $("#reset").load(location.href + " #reset");
             
             
          
        },
        error: function(data){}
    });
    return true; 
    }   
    } else {
      alert("Файлы не выбраны!");
    }
});

    $(document).on('change', '#lang_status', function(){
    var img_id = $(this).data('imgid');
     var token1 = "<?php echo $this->security->get_csrf_hash(); ?>";
    $.ajax({
        url: "<?=base_url('admin/posts/mediaImgLang')?>",
        data: { "value": $(this).val(), "img_id": img_id, <?php echo $this->security->get_csrf_token_name(); ?>: token1, },        
        type: "post",
        success: function(data){
           $(this).addClass('upd');
        }
    });
});
</script>