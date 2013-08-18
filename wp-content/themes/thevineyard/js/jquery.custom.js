/* <![CDATA[ */


jQuery(document).load(function($){

	if( $('#portfolio').length > 0) {
		tallest = 0;
		portfolioItems.each(function(){
			if($(this).height() > tallest) {
				tallest = $(this).outerHeight()
			}
		})

		portfolioItems.height(tallest)
	}
	})
	
	
jQuery(document).ready(function($){

	if($("#searchform #s").val() == '') {
		$("#searchform #s").val('search')
	}
	
	$("#searchform #s").focus(function() {
		if($(this).val() == "search") {
			$(this).val("")
		}
	})
	
	$("#searchform #s").blur(function() {
		if($(this).val() == "") {
			$(this).val("search")
		}
	})
	
	
	if($("#header-search #hs").val() == '') {
		$("#header-search #hs").val('Search')
	}
	
	$("#header-search #hs").focus(function() {
		if($(this).val() == "Search") {
			$(this).val("")
		}
	})
	
	$("#header-search #hs").blur(function() {
		if($(this).val() == "") {
			$(this).val("Search")
		}
	})
		


	
	// Navigation menu animation
	$('#site-nav ul').superfish({
		delay: 200,
		animation: {opacity:'show', height:'show'},
		speed: 'fast',
		autoArrows: false,
		dropShadows: false
	});
	
	
	
	// Slider animation
	var startSlide = 1;
	if (window.location.hash) {
		startSlide = window.location.hash.replace('#','');
	}
	
	sSpeed = parseInt($("#slides").attr("data-speed")) 	
	sPause = parseInt($("#slides").attr("data-pause")) 	
	sFade = parseInt($("#slides").attr("data-fade")) 	

	if(sSpeed == '' || sSpeed == 0 || isNaN(sSpeed)) {
		sSpeed = 1000
	}

	if(sPause == '' || sPause == 0 || isNaN(sPause)) {
		sPause = 4000
	}
	
	if(sFade == '' || sFade == 0 || isNaN(sFade)) {
		sFade = 500
	}	
	
	
	$('#slides').slides({
		preload: true,
		generatePagination: true,
		generateNextPrev: false,
		play: sPause,
		pause: 4000,
		slideSpeed: sSpeed,
		fadeSpeed: sFade,
		hoverPause: true,
		start: startSlide,
		paginationClass: 'slides-nav',
	});
	
	// Ensure proper width
	jQuery("#slides .slide").css("width", jQuery(document).width()+"px");
	
	// Place prev and next properly
	indent_prev = (jQuery(document).width() - 940 )/2 + 25 + 32
	indent_next = (jQuery(document).width() - 940 )/2 + 25 
	jQuery("#slides .prev").css("right", indent_prev+"px")
	jQuery("#slides .next").css("right", indent_next+"px")
	
	// Resize images on window resize
	
	jQuery(window).resize( function() {
		jQuery(".slide").css("width", jQuery(window).width()+"px")
	})
	
	jQuery("#slides").live({
		mouseenter:
			function() {
				jQuery(this).find("a.prev, a.next").fadeIn(300);
			},
		mouseleave:
			function() {
				jQuery(this).find("a.prev, a.next").fadeOut(100);
			}
	   }
	);
	
	
	
	// Portfolio filter
	var portfolioItems = $('#portfolio').find('li.portfolio-item');
	var portfolioHeight = 0;

	
	$('#site-container').find('ul.portfolio-filter a.readmore_button').click(function(){
		$('ul.portfolio-filter a.readmore_button').removeClass("current")
		$(this).addClass('current')
		var selectedClass = $(this).attr('rel');
		cols = $(".portfolio-items").attr("data-cols")
		i=1;
		portfolioItems.each(function(){
			$(this).removeClass("first last")		
			if ($(this).hasClass(selectedClass)) {
				$(this).show(400);   				
   				if(i % cols == 0) {
             		$(this).addClass("last");
             	}
             	else if( (i - 1) % cols == 0 || i == 1) {
             		$(this).addClass("first");
             	}				
				i = i+1;
			} else {
				$(this).hide(400);
			}
		});		
		
		return false;
	});
	
	
	
	// Style all submit buttons
	$('form:not(.searchform) input[type="submit"]').each(function() {
		$(this).wrap('<div class="readmore_button submit"></div>');
	});


	
	// Image hover animation
	$('.hoverfade').hover(
		function () {
			$(this).find('img').stop().animate({
				opacity: 0.50
			}, 300);
		},
		function () {
			$(this).find('img').stop().animate({
				opacity: 1.0
			}, 100);
		}
	);

	
	
	// Toggle shortcode animation
	$('div.toggle.fold').children('div.toggle-content').hide();
	$('div.toggle').children('h4.title').click(function() {
		var parent = $(this).parent();
		parent.toggleClass('fold');
		parent.children('div.toggle-content').slideToggle(300);
	});
	
	
	
	
});

/* ]]> */