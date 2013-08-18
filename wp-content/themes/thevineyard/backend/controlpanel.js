jQuery(document).ready(function($){
	$(".cp_colorpicker").ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).val(hex);
			$(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
		}
	}).bind("keyup", function(){
		$(this).ColorPickerSetColor(this.value);
	});
	
	$(".item-general").css("display","block");
	$("#theme-menu").find(".menu-item").click(function(){
		$(this).parents('#theme-menu').find(".menu-item").removeClass("current-item");
		$(this).addClass("current-item");
		var item = $(this).attr("item");
		$(".rm_section").css("display","none");
		$("."+item).css("display","block");
		return false;
	});
	
	$('#add_sidebar_button').click(function(){
		var content = '<div class="rm_input rm_select"><label for="cp_sidebar_name[]">New sidebar name</label><input type="text" name="cp_sidebar_name[]" id="cp_sidebar_name[]" value="" /><small>The nickname of the sidebar. Please dont use special characters!</small><div class="clearfix"></div></div>';
		$('#customsidebars').append(content);
		return false;
	});
});