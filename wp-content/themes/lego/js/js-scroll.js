jQuery(document).ready(function($) {	

	// Animation
	var controller = new ScrollMagic.Controller();
	$(function () {
	var revealElements = document.querySelector(".link_form-d");
				new ScrollMagic.Scene({
									triggerElement: revealElements, // y value not modified, so we can use element as trigger as well
									offset: 50,
									reverse:false												 // start a little later
								})
								.setClassToggle(revealElements, "v")
								.on("enter", function (e) {
									$(".link_form-d").trigger('click');
									$(".link_form-d").css({'display': 'none'})
								})
								 // add class toggle
								.addTo(controller)
								
	});

	// Aimation AND	
	
	$("html").on("click","#action_card .btt_action", function (event) {
        event.preventDefault();
		event.stopPropagation()
        let id  = $(this).attr('href'),
            top = $(id).offset().top-60;
        $('body,html').animate({scrollTop: top}, 1000);
    });

if($('#action_card').length){
	$(window).scroll(function() {
		let id  = $('#action_card .btt_action').attr('href');
		    let top = $(id).offset().top-60;
		  let height = $('#action_card').offset().top;
		if(height  >= top) {
			$('#action_card').css({'opacity': '0', 'visibility' : 'hidden'});
		}
		else{
			$('#action_card').css({'opacity': '1','visibility' : 'visible'});

		}
	});
}
jQuery('.last_news_slider').slick({slidesToShow: 3,slidesToScroll: 1,arrows: true,  dots: false, focusOnSelect: true,
	prevArrow: '<button type="button" data-role="none" class="slick-prev slick-arrow" aria-label="Previous" role="button" ><i class="fas fa-angle-left"></i></button>',
	nextArrow: '<button type="button" data-role="none" class="slick-next slick-arrow" aria-label="Next" role="button" ><i class="fas fa-angle-right"></i></button>',
	responsive: [{breakpoint: 991,settings: {slidesToShow: 2,}},{breakpoint: 640,settings: {slidesToShow: 1,arrows: true, dots: true}}]});

	var controller = new ScrollMagic.Controller();
	$(function () {
		var Elements = document.querySelector(".single_content");
		var card = document.querySelector("#action_card");
		new ScrollMagic.Scene({
			triggerElement: Elements, // y value not modified, so we can use element as trigger as well
			offset: 400,
														 // start a little later
		})
			.setClassToggle(card, "visible-card")
			// add class toggle
			.addTo(controller)

	});


})
