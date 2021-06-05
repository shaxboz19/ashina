<h2>Меню
    <a href="<?=site_url('admin/menu/save')?>" class="btn btn-primary pull-right" type="button">
        <i class="icon-plus-sign icon-white"></i>
        <span><?//=lang('add')?>Добавить</span>
    </a>
</h2>
<div id="message1"></div>
<?//php $this->load->view('admin/components/filter_posts'); ?>
<div class="clearfix"></div>
<div class="tab-content" id="ajax">
<?//php $this->load->view('admin/'.$sel.'/index_ajax'); ?>
<div id="catalog-menu" class="dd">
<?=$menu_admin;?>
</div>

</div>
<style>
#catalog-menu .action-menu .move{display: none;}
/*.ui-sortable-placeholder {
		border: 10px dashed #685ef2;
	background: #f6f9fa;
	color: #777620;
    visibility: visible !important;
}

.tooltip-inner {
    min-width: 100px;
    max-width: 100%; 
}
.onoffswitch-inner:before {
    content: "<?=lang('active')?>";
    padding-left: 10px;
    background-color: #468847; color: #FFFFFF;
}
.onoffswitch-inner:after {
    content: "<?=lang('inactive')?>";
    padding-right: 10px;
    background-color: #999;
    color: #fff;
    text-align: right;
}*/
</style>
<script>

      $('.onoffswitch-checkbox').change(function(){
        var mode= $(this).prop('checked');
      var postid = $(this).data('postid');
       var token = "<?php echo $this->security->get_csrf_hash(); ?>";
        // // submit the form 
        // $(#myForm).ajaxSubmit(); 
        // // return false to prevent normal browser submit and page navigation 
        // return false; 
           jQuery.ajax({
        type: 'post',
        url: '<?=site_url('admin/menu/status_ajax')?>',
        data: { status:  mode, postid:  postid, <?php echo $this->security->get_csrf_token_name(); ?>: token },
        success: function(data){         
           if(data.result){
            //jQuery('#message1').html(data.result);
           
            } else {
             //   jQuery('#message1').html(data.result_error);          
            }
            
        },
        error: function(data){}
    });
    return true; 
      });
  
$( document ).ready(function() {
   // $('#nestable').nestable();
$('#catalog-menu li.has-sub>a').on('click', function(){
		$(this).removeAttr('href');
       // $(this).toggleClass('openLink');
		var element = $(this).parent('li');
		if (element.hasClass('open')) {
		  element.removeClass('openLink');
			element.removeClass('open');
			element.find('li').removeClass('open');
			element.find('li').removeClass('openLink');
			element.find('ul').slideUp();          
		}
		else {
			element.addClass('open');
            element.addClass('openLink');
			element.children('ul').slideDown();
			element.siblings('li').children('ul').slideUp();
             	element.siblings('li').removeClass('openLink');
			element.siblings('li').removeClass('open');
             element.siblings('li').find('li').removeClass('openLink');
			element.siblings('li').find('li').removeClass('open');
			element.siblings('li').find('ul').slideUp();
		}
	});
	//$('#catalog-menu>ul>li.has-sub>a').append('<span class="holder"></span>');
    
     $( "#mainNav" ).sortable({
    //axis: 'x',
     handle: "button",
     cancel: '',
     //connectWith: "#mainNav ul",
       // items: "li",
        delay:100,
        containment: '.list_move',
        revert:'true',
     //  helper:'clone',
        //distance:50,
        //grid:[40,40],
        //placeholder: "ui-state-highlight",
     update: function(event, ui) {
        var list_sortable = $(this).sortable('serialize');
        $.ajax({
        type: "POST",
        async:true,
        url: '<?=base_url()?>'+'admin/posts/sort_order',
        data: list_sortable,
               success: function(data) {
                  //  updateIndex();
                },
        error: function(){
            alert("Ошибка");
            }  
        });                               
   }
  }).disableSelection();
     $( ".list_move" ).sortable({
    //axis: 'x',
     handle: "button",
     cancel: '',
     //connectWith: "#mainNav ul",
       // items: "li",
        delay:100,
        containment: '.list_move',
        revert:'true',
     //  helper:'clone',
        //distance:50,
        //grid:[40,40],
        //placeholder: "ui-state-highlight",
     update: function(event, ui) {
        var list_sortable = $(this).sortable('serialize');
        $.ajax({
        type: "POST",
        async:true,
        url: '<?=base_url()?>'+'admin/posts/sort_order',
        data: list_sortable,
               success: function(data) {
                  //  updateIndex();
                },
        error: function(){
            alert("Ошибка");
            }  
        });                               
   }
  }).disableSelection();
   $('[data-toggle="tooltip"]').tooltip(); 
  
   $('.sort-order_input').on('focus', function(){
    var sort_id = $(this).data('order_enter');
    $('#sort-order_enter-'+sort_id).css('display', 'block');
   
    
   });
    $('.sort-order_enter').css('display', 'none');
});

</script>

<script>
/* function updateIndex(){
    appendedContainer = $("#ajax");
    $.ajax({
        <?php if(@$_GET['sort']){?>
    url: '<?=base_url()?>'+'admin/posts/index_ajax/<?=$sel?>/?sort=<?=@$_GET['sort']?>',
    <?php } else {?>
      url: '<?=base_url()?>'+'admin/posts/index_ajax/<?=$sel?>/',
    <?php }?>
  type: "POST",
    complete : function( qXHR, textStatus ) {
        // attach error case
        if (textStatus === 'success') {
            var data = qXHR.responseText
            appendedContainer.html(data);
        }
      }
    });
 }*/
 </script>