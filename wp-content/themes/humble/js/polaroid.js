var current = false;
var nb_thumbs;
var start = false;

function getdeg() {
	var deg = Math.floor(Math.random()* 41)-20 + 'deg';
	return deg;
}

function autoPlay() {
	if (current == false)
		var tmp = 't0';
	else 
		var tmp = current;
	tmp = tmp.replace('t', '');
	tmp = parseInt(tmp);
	if (tmp == nb_thumbs) {
		tmp = 0;
	}
	tmp++;
	$('.thumb#t'+tmp).click();
}

$(document).ready(function() { 
	
	var ie = false;
	if ($.browser.msie) {
		ie = true;
	}
	
	var p_width = 650;
	$('#thumbs').fadeIn(500);
	nb_thumbs = $('#thumbs').find('.thumb').length;
	var i = 0;
	
	//show everything
	$('#thumbs').find('.thumb').each(function(){
		i++;
		var space = p_width / (nb_thumbs + 1);
		var left = (space * i) - 50; //50 = half image width
		$(this).stop().animate({'left':left+'px'}, 700, function(){
			$(this).unbind('click')
				   .bind('click', showImage)
				   .unbind('mouseenter')
				   .bind('mouseenter', upThumb)
				   .unbind('mouseleave')
				   .bind('mouseleave', downThumb);
		}).find('img').stop().animate({'rotate': getdeg()}, 300);
		
		$.preLoadImages($(this).find('img').attr('alt'));
		
	});
	
	start = setTimeout(function(){
		autoPlay();
		start = setInterval(function(){autoPlay();}, polaroid_pause);
		return start;
	},1000);
	
	$('#thumbs .thumb img').click(function () { //reset timer
		clearInterval(start);
		start = setInterval(function(){autoPlay();}, polaroid_pause);
	});

	
	function upThumb(){
		$(this).stop().animate({
			'marginTop'	: '-50px'
		}, 400, 'easeOutBack').find('img').stop().animate({'rotate': '0deg'}, 400);
	}
	
	function downThumb(){
		$(this).stop().animate({
			'marginTop' : '0px'
		}, 400, 'easeOutBack').find('img').stop().animate({'rotate': getdeg()}, 400);
	}
	
	function hideThumb(id){
		if (current != false) $('#thumbs #'+current).animate({'top': '0px'}, 400, 'easeOutBack');
		$('#thumbs #'+id).animate({'top': '120px'}, 400, 'easeInBack');
	}
	
	function showImage() {
		var img = $(this).find('img').attr('alt');
		hideThumb($(this).attr('id'));
		current = $(this).attr('id');
		var big = $('#big').css('backgroundImage');
		
		//opacity de altern -> 1
		$('#altern').css('opacity', 1);		
		//image de big -> altern
		$('#altern').css('backgroundImage', big);
		//nouvelle image -> #big
		$('#big').css('backgroundImage', 'url('+img+')');
		//altern -> opacity 0
		$('#altern').animate({'opacity': 0}, 1500);

	}
	
});


