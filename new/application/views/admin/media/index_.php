<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Загрузить Медиа</h3>
    </div>

    
    <?=form_open_multipart('admin/media/save', array('id'=>'media_form'))?>
        <div class="modal-body">      
        <div class="alert alert-block">    
            <span class="btn btn-success fileinput-button">
                <i class="icon-plus icon-white"></i>
                <span>Добавить</span>
                <input id="file" type="file" name="userfile[]" multiple="">
            </span>
            <input name="category" type="hidden" value="<?=@$sel?>" />
            <input name="post_id" type="hidden" value="<?=@$post->id?>" /> 
           
            <!--<button id="btnUpload" class="btn btn-primary"><i class="icon-upload icon-white"></i> Загрузить</button>-->
            
            <div class="progress progress-info progress-striped">
                <div class="bar"></div >
                <div class="percent">0%</div >
            </div>
            </div>
            <div class="clearfix"></div>
            
            <ul class="thumbnails" id="media_list">
                <? foreach ($media_files as $mf): ?> 
                	<?php if($mf->category !== 'music'): ?>                           
                    <li class="thumb" data-id="<?=$mf->id?>">
                        <a href="<?=base_url("uploads/{$mf->category}/{$mf->url}")?>" class="thumbnail fancybox" rel="group">
                            <img src="<?=base_url("thumb/view/w/120/h/100/src/uploads/{$mf->category}/{$mf->url}")?>"/>
                        </a>
                        <div class="btn-toolbar pull-right">
                            <div class="btn-group">
                                <a class="btn btn-mini move" href="#" title="Перемещать"><i class="icon-move"></i></a>
                                <a class="btn btn-mini <?=($mf->is_main) ? 'btn-info' : ''?> ajax_set_main" href="<?=base_url('admin/media/set_main/'.$mf->id)?>" title="Сделать Главным"><i class="icon-circle-arrow-up"></i></a>
                                <a class="btn btn-mini btn-warning ajax_delete" href="<?=base_url('admin/media/delete/'.$mf->id)?>" title="Удалить"><i class="icon-trash"></i></a>
                            </div>
                        </div>
                    </li>
                    <?php else: ?>
                  
                              
                    <li>
                    <?php echo $mf->url ?>
                     <a class="btn btn-mini btn-warning ajax_delete" href="<?=base_url('admin/media/delete/'.$mf->id)?>" title="Удалить"><i class="icon-trash"></i></a>
                     <a class="btn btn-mini <?=($mf->is_main) ? 'btn-info' : ''?> ajax_set_main" href="<?=base_url('admin/media/set_main/'.$mf->id)?>" title="Сделать Главным"><i class="icon-circle-arrow-up"></i></a>
                     </li>   
                    <?php endif; ?>                        
                <? endforeach; ?>
            </ul>
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

function template(id, group, file)
{
	if(group == 'music')
	{
		var temp = '<li>'+ file +' <a class="btn btn-mini btn-warning ajax_delete" href="<?=base_url("admin/media/delete/'+id+'")?>" title="Удалить"><i class="icon-trash"></i></a><a class="btn btn-mini ajax_set_main" href="<?=base_url("admin/media/set_main/'+id+'")?>" title="Сделать Главным"><i class="icon-circle-arrow-up"></i></li>';
	}
	else
	{
		var temp = 
		'<li class="thumb"><a href="<?=base_url("uploads/'+group+'/'+file+'")?>" class="thumbnail fancybox" rel="group"> \
				<img src="<?=base_url("thumb/view/w/120/h/100/src/uploads/'+group+'/'+file+'")?>" /></a> \
			<div class="btn-toolbar pull-right"><div class="btn-group"> \
					<a class="btn btn-mini ajax_set_main" href="<?=base_url("admin/media/set_main/'+id+'")?>" title="Сделать Главным"><i class="icon-circle-arrow-up"></i></a> \
					<a class="btn btn-mini btn-warning ajax_delete" href="<?=base_url("admin/media/delete/'+id+'")?>" title="Удалить"><i class="icon-trash"></i></a> \
				</div> \
			</div></li>';
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
</script>