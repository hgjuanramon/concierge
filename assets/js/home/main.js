jQuery(document).ready(function(){
		jQuery('ul.sf-menu').superfish({
			animation: {height:'show'},	// slide-down effect without fade-in
			delay:		 100			// 1.2 second delay on mouseout
		});
	});
 


$(document).ready(function(){
	$("#mobnav-btn").click(function() {
	  $(".sf-menu").slideToggle( "slow" );
	});

	$('.mobnav-subarrow').click(

	function () {
    $(this).parent().toggleClass("xpopdrop");
	});

	$("#search-label").click(function() {
	  $(".search-bar").slideToggle( "slow" );
	});
});

 

/***************** Animate  on scroll   ******************/ 

var wow = new WOW(
  {
    boxClass:     'wow',      // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset:       50,          // distance to the element when triggering the animation (default is 0) 
    mobile:       false   
  }
);
wow.init();

  /***************** isotope   ******************/ 
 

		// Isotope Portfolio
		var $container = jQuery('.portfolio');
		$container.isotope({
			filter: '*',
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false
			},
			layoutMode: 'fitRows'
		});
		 
		jQuery('.port-filter li a').click(function(){
			jQuery('.port-filter li').removeClass('active');
			jQuery(this).parent().addClass('active');
	 
			var selector = jQuery(this).attr('data-filter');
			$container.isotope({
			filter: selector,
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false
			},
			layoutMode: 'fitRows'
		});
			return false;
		});

		
		
		jQuery(window).load(function() {
			$container.isotope('reLayout');
		});

/***************** OWl Slide  ******************/ 

$(document).ready(function() {
 
  $("#owl-demo").owlCarousel({
    autoPlay : 3000,
    stopOnHover : true,
    navigation:false,
    paginationSpeed : 1000,
    goToFirstSpeed : 2000,
    singleItem : true,
    autoHeight : true, 
  });
    

});

$(document).ready(function() {
 
  var owl = $("#owl-single-port");
 
  owl.owlCarousel({
      navigation : true, // Show next and prev buttons
      slideSpeed : 1000,
      autoPlay : 3000,
      paginationSpeed : 2000,
      singleItem:true,
       navigation : false,
  });
 
  // Custom Navigation Events
  $(".next").click(function(){
    owl.trigger('owl.next');
  })
  $(".prev").click(function(){
    owl.trigger('owl.prev');
  })
   
});
 
// Product slideshow

$(document).ready(function() {
 
  var owl = $("#product-slideshow");
 
  owl.owlCarousel({
      items : 4,
      itemsDesktop : [1000,4], //5 items between 1000px and 901px
      itemsDesktopSmall : [980,3], // betweem 900px and 601px
      itemsTablet: [600,2], //2 items between 600 and 0
      itemsMobile : [360,1], // itemsMobile disabled - inherit from itemsTablet option,
      pagination: false,
  });
  // Custom Navigation Events
  $(".slide-next").click(function(){
    owl.trigger('owl.next');
  })
  $(".slide-prev").click(function(){
    owl.trigger('owl.prev');
  })
});


// Product slideshow

$(document).ready(function() {
 
  var owl = $("#new-product-slideshow");
 
  owl.owlCarousel({
      items : 4,
      itemsDesktop : [1000,4], //5 items between 1000px and 901px
      itemsDesktopSmall : [980,3], // betweem 900px and 601px
      itemsTablet: [600,2], //2 items between 600 and 0
      itemsMobile : [360,1], // itemsMobile disabled - inherit from itemsTablet option,
      pagination: false,

  });
 
  // Custom Navigation Events
  $(".slide-next").click(function(){
    owl.trigger('owl.next');
  })
  $(".slide-prev").click(function(){
    owl.trigger('owl.prev');
  })
 
});


/***************** flickr photostream   ******************/ 

$(document).ready(function(){

	 
	
	$('#cbox').jflickrfeed({
		limit: 6,
		qstrings: {
			id: '21251150@N04'
		},
		itemTemplate: '<li>'+
						'<a rel="colorbox" href="{{image_b}}" title="{{title}}">' +
							'<img src="{{image_q}}" alt="{{title}}" />' +
						'</a>' +
					  '</li>'
	}, function(data) {
		$('#cbox a').colorbox();
	});
	 

});



/*****************Colorbox lightbox******************/

$(document).ready(function(){
				//masonry-portfolios of how to assign the Colorbox event to elements
				$(".colorlightbox").colorbox({
					rel:'colorlightbox',


opacity: 0.92,
scalePhotos: true,
maxHeight: "90%",
maxWidth: "90%",
title: function() {
var url = $(this).attr("attachment-link");
var title = $(this).attr("title");
var attachment_page = '<span id="image-info"><a href="'+url+'" title="Download This Image"><i class="icon-info-sign"></i> More Info & Comments</a></span>';
if(url == undefined) {
	return '<span id="cboxTitleLeft">'+title+'</span>';
} 
else {
	return '<span id="cboxTitleLeft">'+title+'</span>'+attachment_page; }
			}
				});
			});
 // Make ColorBox responsive
	jQuery.colorbox.settings.maxWidth  = '95%';
	jQuery.colorbox.settings.maxHeight = '95%';

	// ColorBox resize function
	var resizeTimer;
	function resizeColorBox()
	{
		if (resizeTimer) clearTimeout(resizeTimer);
		resizeTimer = setTimeout(function() {
				if (jQuery('#cboxOverlay').is(':visible')) {
						jQuery.colorbox.load(true);
				}
		}, 300);
	}

	// Resize ColorBox when resizing window or changing mobile device orientation
	jQuery(window).resize(resizeColorBox);
	window.addEventListener("orientationchange", resizeColorBox, false);

/***************** FitVids.js ******************/

 $(document).ready(function(){
    // Target your .container, .wrapper, .post, etc.
    $(".fit").fitVids();
  });

/***************** jquery-ui slider Initialization  ******************/ 

$(document).ready(function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 9000,
      values: [ 1240, 6000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
  });

/***************** Tabs  ******************/ 

$(function () {
  $('#myTab a:last').tab('show')
})


/***************** Tabs  ******************/ 


$(document).ready(function() {
 
  var owl = $("#client-list-slide");
 
  owl.owlCarousel({
      items : 5, //10 items above 1000px browser width
      itemsDesktop : [1000,5], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,3], // betweem 900px and 601px
      itemsTablet: [600,2], //2 items between 600 and 0
      pagination: false,
      itemsMobile : true // itemsMobile disabled - inherit from itemsTablet option
  });
 
  // Custom Navigation Events
  $(".next").click(function(){
    owl.trigger('owl.next');
  })
  $(".prev").click(function(){
    owl.trigger('owl.prev');
  })
   
});


$(window).load(function(){

  $('.fr-slider').fractionSlider({
    'fullWidth':      true,
    'slideTransition': 'fade',
    'slideTransitionSpeed' : 650, 
    'slideEndAnimation' : false,
    'controls':  false,
    'pager': true,
    'speedOut' : 2600,
    'timeout' : 6000,  
    'responsive': true,
    'increase': true,
    'dimensions': '1170 , 410',
  });
 
  var viewportWidth = $(window).width();
  var colWidth = $(".fraction-slider").width();
  var viewportHeight = $(window).height();
  var divideval = 2 ; 
  var marginslidebg = (viewportWidth - colWidth) / divideval + 2 ;

  $(".slide-bg").css({"width": viewportWidth,"max-width": viewportWidth,"margin-left":"-"+marginslidebg+"px",});
 
  $(window).resize(function(){
    $(".slide-bg").css({"width": viewportWidth,"max-width": viewportWidth,"margin-left":"-"+marginslidebg+"px",});
  });

});


/* El de range*/

    $('.nstSlider').nstSlider({
    "left_grip_selector": ".leftGrip",
    "right_grip_selector": ".rightGrip",
    "value_bar_selector": ".bar",
    "value_changed_callback": function(cause, leftValue, rightValue) {
    var $container = $(this).parent();
    $container.find('.leftLabel').text(leftValue);
    $container.find('.rightLabel').text(rightValue);
    },
    "highlight": {
    "grip_class": "gripHighlighted",
    "panel_selector": ".highlightPanel"
    }
    });
    $('#highlightRangeButton').click(function() {
    var highlightMin = Math.random() * 20,
    highlightMax = highlightMin + Math.random() * 80;
    $('.nstSlider').nstSlider('highlight_range', highlightMin, highlightMax);
    });
	
	/*----calendario-----*/
	
	$(function() {
		$('#dob').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '-100:+0'});
	});