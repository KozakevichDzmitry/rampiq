function new_map( $el , snazzystyles) {
	var $markers = $el.find('.marker');
	var args = {
		zoom		: zooms,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP,
		styles: snazzystyles
	};
	var map = new google.maps.Map( $el[0], args);
	map.markers = [];
	$markers.each(function(){
		add_marker( jQuery(this), map );
	});
	center_map( map );
	return map;
}

function add_marker( $marker, map ) {
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
	var infowindow = new google.maps.InfoWindow({
		content		: $marker.html()
	});
	var pinColor = "176883";
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map,
	});
	marker.setIcon(pinImage);
	// add to array
	map.markers.push( marker );
	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
		// create info window
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});

		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {

			infowindow.open( map, marker );

		});
	}

}


function center_map( map ) {
	var bounds = new google.maps.LatLngBounds();
	jQuery.each( map.markers, function( i, marker ){
		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
		bounds.extend( latlng );
	});
	if( map.markers.length == 1 )
	{
		map.setCenter( bounds.getCenter() );
		map.setZoom(zooms);
	}
	else
	{
		map.fitBounds( bounds );
	}
}

function header_fix() {
	if (jQuery(window).scrollTop()>=93){
		var wd=jQuery(window).width();
		jQuery('header').addClass('active');
	} else {
		jQuery('header').removeClass('active');
	}
}

jQuery(document).ready(function($) {

	header_fix();
	$(window).scroll(function() {header_fix();})
	
 $("html").on("click",".anchor_link", function (event) {
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top-190;
        $('body,html').animate({scrollTop: top}, 1000);
		
    });
	
$('#hamburger_header').click(function(){	
    if ( $(this).hasClass('is-active'))
     {
        $('.bg').removeClass('active');
		$('.mobile_menu').removeClass('active'); 
        $('#hamburger_header').removeClass('is-active');
        $('body').css('overflow','auto'); 
		$('header').removeClass('pos_inherit');
		 $('main').removeClass('mob_main');
    } else {
		$('.bg').addClass('active');
		$('.mobile_menu').addClass('active'); 
        $('#hamburger_header').addClass('is-active');
        $('body').css('overflow','hidden');
		$('header').addClass('pos_inherit');
		$('main').addClass('mob_main');
	}
});

 
 $('.bg').click(function(){
	if ($(this).hasClass('active'))
	{
		 $('.bg').removeClass('active');
		$('.mobile_menu').removeClass('active'); 
        $('#hamburger_header').removeClass('is-active');
        $('body').css('overflow','auto'); 
		$('header').removeClass('pos_inherit');
		$('main').removeClass('mob_main');
	}
})	
 $('.header_menu_mob .show_sub_menu').click(function(){ 
 var ids=$(this).data('from');
 if ($(this).hasClass('active')) {
	$('#'+ids).removeClass('focus');
	$(this).removeClass('active');
	$('#'+ids+ ' ul').css('display','none');
 }
 else {
	$('#'+ids).addClass('focus');
	$(this).addClass('active');
	$('#'+ids+ ' ul').css('display','block');
	$('#'+ids+ ' ul ul').css('display','none');
 }
 })

	if ($('.slider_clients_feedback').length) {
		$('.slider_clients_feedback').slick({dots: false,arrows:true,infinite: false,speed: 300 ,slidesToShow: 2,slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 991,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]})
	}
	if ($('.single_client_slider').length) {
		$('.single_client_slider').slick({dots: false,arrows:false,infinite: true,speed: 300, autoplay: true, slidesToShow: 1,slidesToScroll: 1,
			})
	}

	if ($('.contacts_logos').length) {
		$('.contacts_logos').slick({dots: true,arrows:false,infinite: false,speed: 300, slidesToShow: 6,slidesToScroll: 6,
			responsive: [
				{
					breakpoint: 1200,
					settings: {
						slidesToShow: 5,
						slidesToScroll: 5
					}
				},
				{
					breakpoint: 991,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 4
					}
				}
				,
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3
					}
				},
				{
					breakpoint: 640,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				}
			]})
	}
	
	
	 $('.rampiq_team_slider').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        swipeToSlide: true,
        centerMode:true,
        arrows: false,
        dots: false,
		infinite: true,
        responsive: [
			 {
                breakpoint: 1500,
                settings: {
                    slidesToShow: 5,
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 880,
                settings: {
                    slidesToShow: 3,
                    centerMode:false
                }
            },
            {
                breakpoint: 500,
                settings: {
                    slidesToShow: 2,
                    centerMode:false
                }
            }
        ]
    });
	(function($) {
		$(function() {
			$("ul.tabs_caption").on("click", "li:not(.active)", function() {
				$(this)
					.addClass("active")
					.siblings()
					.removeClass("active")
					.closest("div.container")
					.find("div.client_tabs_content")
					.removeClass("active")
					.eq($(this).index())
					.addClass("active");
			});
		});
	})(jQuery);


			$("ul.tabs_caption_structure").on("click", "li:not(.active)", function() {
				$(this)
					.addClass("active")
					.siblings()
					.removeClass("active")
					.closest("div.container")
					.find("div.client_tabs_content")
					.removeClass("active")
					.eq($(this).index())
					.addClass("active");
			});
	


	//Scroll tabs
	var sections = $('.services_row')
	var nav = $('nav')
	var bar = $('.height_100')
	var nav_height = bar.outerHeight();
	var services_section = $('.services_section')
	$(window).on('scroll', function () {
		var cur_pos = $(this).scrollTop();

		sections.each(function() {
			var top = $(this).offset().top - nav_height,
				bottom = top + $(this).outerHeight();

			if (cur_pos >= top && cur_pos <= bottom) {
				nav.find('a').removeClass('active');
				sections.removeClass('active');

				$(this).addClass('active');
				nav.find('a[href="#'+$(this).attr('id')+'"]').addClass('active');
			}
		});
	});

	nav.find('a').on('click', function () {
		var $el = $(this)
		var id = $el.attr('href');

		$('html, body').animate({
			scrollTop: $(id).offset().top - nav_height
		}, 500);

		return false;
	});


	( function () {
		$.extend($.expr[':'], {
			'off-top': function (el) {
				return $(el).offset().top < $(window).scrollTop() -1;
			},
			'off-top-200': function (el) {
				return $(el).offset().top > $(window).scrollTop()-2;
			},
			'off-top-500': function (el) {
			return $(el).offset().top > $(window).scrollTop()+500;
		    },
			'off-top-height': function (el) {
				return ($(el).offset().top + $(el).outerHeight()) < $(window).scrollTop()+950;
			},
			'off-top-height-full': function (el) {
				return ($(el).offset().top + $(el).outerHeight()) < $(window).scrollTop();
			}
		});
	})(jQuery);

	$(document).scroll(function () {
		if($('.first_section_slider').is(":off-top")){
			$('.services_menu').addClass('active')
		}
		if($('.first_section_slider').is(":off-top-200")){
			$('.services_menu').removeClass('active')
		}
		if($('.services_we_work').is(":off-top-height")){
			$('.services_menu').removeClass('active')
		}})

	
	$('.home_top_slider .vc_column-inner>.wpb_wrapper').slick({dots: true,arrows:false,infinite: true,speed: 300 ,slidesToShow: 3,slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 1200,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 991,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 670,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]})
})


    jQuery(document).ready(function($){
			if($(document).width() <= 800){
				// Animation
			
					var controller = new ScrollMagic.Controller();
					$(function () {
					var revealElements = document.getElementsByClassName("items-hover");
							for (var i=0; i<revealElements.length; i++) { // create a scene for each element
								new ScrollMagic.Scene({
													triggerElement: revealElements[i], // y value not modified, so we can use element as trigger as well
													offset: 10,												 // start a little later
												})
												.setClassToggle(revealElements[i], "visible")
												 // add class toggle
												.addTo(controller)
												
							}
					});	
					// Aimation AND	
					
				 
	
			}
			else{
				return false;
			}	
		
		(function($) {
			$(function() {
				$("ul.tabs_caption_jobs").on("click", "li:not(.active)", function() {
					$(this)
						.addClass("active")
						.siblings()
						.removeClass("active")
						.closest("div.jobs_tabs_section")
						.find("div.jobs_tabs")
						.removeClass("active")
						.eq($(this).index())
						.addClass("active");
				});
			});
		})(jQuery);	
		
        jQuery(document).on('gform_confirmation_loaded', function(event, formId){
            if(formId == 1) {
             window.dataLayer = window.dataLayer || [];
dataLayer.push({
'event':'custom-event',
'event-category': 'Contact Us',
'event-action': 'Form Submit',
'event-label':'Complete'
});
				console.log(dataLayer);
            } else if(formId == 2) {
				var www_confirmations=$('#www_confirmations').html();
				
           
dataLayer.push({ 
 'event': 'custom-event',
 'event-category': 'Quiz-Details',
 'event-action': 'Step 4',
 'event-label': www_confirmations // Company website from form field
});
		
  console.log(dataLayer);
            }
        });
		
		
		
	 $('.current_openings_block .link_button_additional').click(function(){ 
		 
		 window.dataLayer = window.dataLayer || [];
dataLayer.push({
'event': 'custom-event',
'event-category': 'Current openings',
'event-action': 'PPC specialist', //'Senior data analyst', SEO specialist'
'event-label': 'Apply now'});
		 console.log(dataLayer);
  }) 
		
    })
 

function data_add() {
	
	console.log('data')
	 var val=jQuery('#gform_source_page_number_2').val();
	window.dataLayer = window.dataLayer || [];
	
	if (val == 1) {
		jQuery( "#input_2_12 input" ).each(function( index ) {
   if (jQuery(this).prop('checked')) {
	  dataLayer.push({ 
 'event': 'custom-event',
 'event-category': 'Quiz-Main',
 'event-action': 'Step 1',
 'event-label': jQuery(this).val()  
});
   }
});
	}
	if (val == 2) {
		jQuery( "#input_2_13 input" ).each(function( index ) {
   if (jQuery(this).prop('checked')) {
	  dataLayer.push({ 
 'event': 'custom-event',
 'event-category': 'Quiz-Details',
 'event-action': 'Step 2',
 'event-label': jQuery(this).val()  
});
   }
});
	}		
	if (val == 3) {
		
	jQuery( "#input_2_15 input" ).each(function( index ) {
   if (jQuery(this).prop('checked')) {
	  dataLayer.push({ 
 'event': 'custom-event',
 'event-category': 'Quiz-Details',
 'event-action': 'Step 3',
 'event-label': jQuery(this).val()  
});
   }
});
	}
}

