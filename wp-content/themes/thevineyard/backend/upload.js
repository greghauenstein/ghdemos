jQuery(document).ready(function($){
	window.formfield = '';
	window.imagefield = false;
	
	$('.upload_button').live('click', function() {
		window.formfield = $('.upload_field',$(this).parent().parent());
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		return false;
	});
	$('.upload_button_images').live('click', function() {
		window.imagefield = true;
		window.formfield = $('.upload_field',$(this).parent().parent());
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		return false;
	});
	
	window.original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html) {
		if (window.formfield != '' && window.imagefield == false) {
			imgurl = $('img',html).attr('src');
			window.formfield.val(imgurl);
			tb_remove();
		}
		else if (window.formfield != '' && window.imagefield == true) {
			imgurl = $('img',html).attr('src');
			if (window.formfield.val() != '') {
				window.formfield.val(window.formfield.val() + ',' + imgurl)
			} else {
				window.formfield.val(imgurl);
			}
			$('.image_list',window.formfield.parent()).html($('.image_list',window.formfield.parent()).html() + ' <img style="height:50px;width:auto;display:inline-block;padding:5px;" src="' + imgurl + '" />');
			tb_remove();
		}
		else {
			window.original_send_to_editor(html);
		}
		window.formfield = '';
		window.imagefield = false;
	}
	
	$('.image_list').find('img').live('click', function() {
		$(this).fadeOut(200).remove();

		image_list = '';
		$('.image_list').find('img').each(function(){
			if (image_list != '') {
				image_list += ',';
			}
			image_list += $(this).attr('src');
		});
		
		$('#images.upload_field').val(image_list);
	});
});