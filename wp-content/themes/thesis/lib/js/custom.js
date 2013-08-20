/*
Copyright 2013 DIYthemes, LLC. Patent pending. All rights reserved.
DIYthemes, Thesis, and the Thesis Theme are registered trademarks of DIYthemes, LLC.
License: DIYthemes Software License Agreement
License URI: http://diythemes.com/thesis/rtfm/software-license-agreement/
*/
(function($){
thesis_custom = {
	init: function() {
		thesis_custom.codeMirror = CodeMirror.fromTextArea(document.getElementById("t_css_custom"), {
			lineNumbers: true,
			indentUnit: 4,
			lineWrapping: true,
			indentWithTabs: true
		});
		thesis_custom.height();
		$(window).resize(function(){
			thesis_custom.height();
		});
		thesis_custom.set_flyout_width();
		$('.t_edit_item').on('mouseover', function() {
			var w = 300, position = $(this).offset();
			$('#t_flyout p').text($(this).attr('data-tooltip'));
			$('#t_flyout').css({
				top: (position.top - ($(this).parent('li').outerHeight() / 2) - $(document).scrollTop()) + 'px',
				right: $('.slideout').outerWidth() + 18 + 'px',
				display: 'block'
			});
		}).on('mouseout', function() {
			$('#t_flyout').hide();
		}).click(function(){
			thesis_custom.codeMirror.replaceSelection($(this).data('value'));
		});
		$('.slideout_toggle').click(function(){
			thesis_custom.slideout(this);
		});
		$('#t_save_css').click(function(){
			thesis_custom.save();
			return false;
		});
	},
	height: function() {
		var adjustment = ($(document).outerHeight() - $(window).outerHeight()) > 65 ? 65 : 0;
		$('.CodeMirror, .slideout').outerHeight($(window).height() - 229 + adjustment + 'px');
	},
	slideout: function(toggle) {
		var slideout = $(toggle).siblings('.slideout');
		if ($(slideout).hasClass('active')) {
			$(toggle).html('&#43;').animate({ right: 0 }, 100);
			$(slideout).removeClass('active').animate({ width: 0 }, 100);
		}
		else {
			$(toggle).html('&#8722;').animate({ right: thesis_custom.flyout_width }, 100);
			$(slideout).addClass('active').animate({ width: thesis_custom.flyout_width }, 100);
		}
	},
	save: function() {
		$('#t_save_css').prop('disabled', true);
		$.post(ajaxurl, { action: 'save_css', custom: thesis_custom.codeMirror.getValue(), nonce: $('#nonce').val() }, function(saved) {
			$('#t_save_css').prop('disabled', false);
			if (saved) {
				$('#t_canvas').append(saved);
				$('#css_saved').css({'right': $('#t_save_css').outerWidth()+35+'px'});
				$('#css_saved').fadeOut(3000, function() { $(this).remove(); });
			}
		});
	},
	set_flyout_width: function() {
		var widest = false;
		$('.t_item_list li code').each(function(){
			var width = $(this).outerWidth();
			if (widest == false || width > widest)
				widest = width;
		});
		thesis_custom.flyout_width = widest + 54;
	}
};
$(document).ready(function(){ thesis_custom.init(); });
})(jQuery);