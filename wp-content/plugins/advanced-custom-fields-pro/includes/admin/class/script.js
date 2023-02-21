jQuery(document).ready(function($) { 



$('.rwmb-tab-nav li').click(function () {
	var panel=$(this).data("panel"); 
	$('.rwmb-tab-panel').css('display','none');
	$('.rwmb-tab-panel-'+panel).css('display','block');
	$('.rwmb-tab-nav li').removeClass('rwmb-tab-active');
	$(this).addClass('rwmb-tab-active');	
	var evs= $.Event("click");evs.stopPropagation();evs.preventDefault(); return false;
})

})