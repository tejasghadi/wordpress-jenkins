
(function($){

	"use strict";

	var Osaka = {


      	// Bootstrap Carousels

      	carousel: function() {
      		try {  (function($) {				
		      		$('.carousel.slide').carousel({
		      			cycle: true
		      		}); 
		      	})(jQuery);
			} catch(e) { }
      	}, 

        magnificpopUp: function() {
      		try {  (function($) {
			        $('.popup-video').magnificPopup({
			           	type: 'iframe'
			        });

			        $('.image-popup').magnificPopup({
			           type: 'image',
			           gallery: {
			            enabled: true
			          },
			        });
		      	})(jQuery);
			} catch(e) { }

        },

		// Isotop Filters
		isotope: function() {
      		try {  (function($) {				
			
					//init Isotope
					var $grid = $('.portfolio-items').isotope({
					  itemSelector: '.item',
						layoutMode: 'masonry',
						transitionDuration: '0.6s',
						percentPosition: true,
						
						masonry: {
							columnWidth: '.item'
						}
					});

					// filter functions
					var filterFns = {
					  // show if number is greater than 50
					  numberGreaterThan50: function() {
					    var number = $(this).find('.number').text();
					    return parseInt( number, 10 ) > 50;
					  },
					  // show if name ends with -ium
					  ium: function() {
					    var name = $(this).find('.name').text();
					    return name.match( /ium$/ );
					  }
					};

					$('.filter').on( 'change', function() {
					  // get filter value from option value
					  var filterValue = this.value;
					  // use filterFn if matches value
					  filterValue = filterFns[ filterValue ] || filterValue;
					  $grid.isotope({ filter: filterValue });
					});
		      	})(jQuery);
			} catch(e) { }


		},

		// Images Loaded

		imagesloaded: function() {
      		try {  (function($) {				
					var $grid = $('.portfolio-items');
					$grid.imagesLoaded().progress( function() {
						$grid.isotope('layout');
					});  
		      	})(jQuery);
			} catch(e) { }					

		},

		// Google Map Functions

		googlemap: function() {

      		try {  (function($) {	

					function isMobile() {
						return ('ontouchstart' in document.documentElement);
					}
					function init_gmap() {
						if ( typeof google == 'undefined' ) return;
						var options = {
							center: {lat: -37.834812, lng: 144.963055},
							zoom: 15,
							mapTypeControl: true,
							mapTypeControlOptions: {
								style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
							},
							navigationControl: true,
							scrollwheel: false,
							streetViewControl: true,
							styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#faf8f8"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#faf8f8"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#cdcdcd"},{"visibility":"on"}]}]
						}
						if (isMobile()) {
							options.draggable = false;
						}
						$('#googleMaps').gmap3({
							map: {
								options: options
							},
				          marker: {
				           latLng: [-37.834811, 144.963054],
				           options: { icon: 'images/map-icon.png' }
				         }
		       			});
					}

					init_gmap();

		      	})(jQuery);
			} catch(e) { }


		},


		// Selectpicker 

		selectpicker: function() {
      		try {  (function($) {				
					$('.portfolio-filter .filter').selectpicker();
		      	})(jQuery);
			} catch(e) { }
		},

		bannerBG: function(){

      		try {  (function($) {				

					// Background Img
					$(".banner-background-bg").css('background-image', function () {
						var bg = ('url(' + $(this).data("image-src") + ')');
						return bg;
					});

		      	})(jQuery);
			} catch(e) { }

		}

		
	};

	$(document).ready(function() {
		"use strict";

		// var stickyheight = $('#wpadminbar').height();
		// $('.logged-in .masthead.sticky').css('top', (stickyheight) * 1);		

	    Osaka.bannerBG();
	    Osaka.carousel();
	    Osaka.isotope();
	    Osaka.imagesloaded();
	    Osaka.magnificpopUp();
	    Osaka.googlemap();
	    Osaka.selectpicker();
  });


})(jQuery);



jQuery( window ).on( 'scroll', function (){
  if ( jQuery( this ).scrollTop() > 100 ){
    jQuery( 'header.masthead' ).addClass( "sticky" );
  } else {
    jQuery( 'header.masthead' ).removeClass( "sticky" );
  }
});


