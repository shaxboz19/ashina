$(document).ready(function(){
    
    $(window).resize(function(){
    
    		$('.csuz').css({
    			position:'absolute',
    			left: ($(window).width() - $('.csuz').outerWidth())/2,
    			top: ($(window).height() - $('.csuz').outerHeight())/2
    		});
    		
    	});
    	// To initially run the function:
    	$(window).resize();
     
    var infoClass = $(".info").attr("do");
    
    if (infoClass == "ok") {
        $('.csuz').hide();
        $('.login_form').show();
        
        $(window).resize(function(){
            $('.info').css({
                position:'absolute',
                left: (($(window).width() - $('.login_form').outerWidth())/2)+90,
                top: (($(window).height() - $('.login_form').outerHeight())/2)-50
            });		
        });
        $(window).resize();
        $(".info").slideDown();
    }
    
    $(".csuz").click(function() {
        $(".login_form").fadeIn("slow");
    });
  $('#sana').datepicker({
        changeMonth: true,
        changeYear: true,
		dateFormat: 'dd-m-yy'
    }); //Sanani chop etish
    $('#tabs').tabs();
    $('#album').hide();
    $('#gallery').hide();
});