<?php
class ControlPanel {

//http://www.google.com/webfonts#UsePlace:use/Collection:Puritan|Droid+Sans|Lato|Neuton|PT+Sans|Tinos|Arimo|Ubuntu|Droid+Sans+Mono|Josefin+Sans|Kreon|Cantarell|Cousine|EB+Garamond|Droid+Serif|Terminal+Dosis|Quattrocento|Cuprum|Goudy+Bookletter+1911|Raleway:100|Allerta|Yanone+Kaffeesatz|Vollkorn|Anonymous+Pro|Nobile|Inconsolata|Molengo|Crimson+Text|Cardo
	var $fontList = array(
		'Helvetica, Arial, Sans-serif'            => array(),
		'Allerta'                  => array("type" => "sans-serif"),
		'Anonymous Pro'            => array("type" => "sans-serif"),
		'Arimo'                    => array("type" => "sans-serif"),
		'Cantarell'                => array("type" => "sans-serif"),
		'Cardo'                    => array("type" => "serif"),
		'Cousine'                  => array("type" => "sans-serif"),
		'Crimson Text'             => array("type" => "serif"),
		'Cuprum'                   => array("type" => "sans-serif"),
		'Droid Sans'               => array("type" => "sans-serif"),
		'Droid Sans Mono'          => array("type" => "sans-serif"),
		'Droid Serif'              => array("type" => "serif"),
		'EB Garamond'              => array("type" => "serif"),
		'Goudy Bookletter 1911'    => array("type" => "serif"),
		'Inconsolata'              => array("type" => "sans-serif"),
		'Josefin Sans'             => array("type" => "sans-serif"),
		'Kreon'                    => array("type" => "serif"),
		'Lato'                     => array("type" => "sans-serif"),
		'Molengo'                  => array("type" => "sans-serif"),
		'Neuton'                   => array("type" => "serif"),
		'Nobile'                   => array("type" => "sans-serif"),
		'Open Sans'                => array("type" => "sans-serif"),
		'PT Sans'                  => array("type" => "sans-serif"),
		'Puritan'                  => array("type" => "sans-serif"),
		'Quattrocento'             => array("type" => "serif"),
		'Raleway'                  => array("type" => "cursive"),
		'Terminal Dosis'           => array("type" => "sans-serif"),
		'Tinos'                    => array("type" => "serif"),
		'Ubuntu'                   => array("type" => "sans-serif"),
		'Vollkorn'                 => array("type" => "serif"),
		'Yanone Kaffeesatz'        => array("type" => "sans-serif"),
	);
	
	var $overlays;
	var $backgrounds;
		
	var $optionlist;
	var $options;
  
	function setDefaults() {
		$default_settings = array();
		foreach($this->optionlist as $menuitem) {
			foreach($menuitem['options'] as $theme_option) {
				if ($theme_option['default']) $default_settings[$theme_option['id']] = $theme_option['default'];
			}
		}
		return $default_settings;
	}
	
	function ControlPanel() {
		global $theme_name;
		
		$overlay_files = @scandir(TEMPLATEPATH."/images/overlays");
		if($overlay_files) {
		foreach($overlay_files as $file) {
			if(substr($file, 0,1) != ".") {
				$name = substr(ucfirst($file), 0, -4);
				$file = get_template_directory_uri()."/images/overlays/".$file;
				$overlay[$file] = $name;
			}
		}
		$this->overlays = $overlay;
		}
	
		

	
			
		$this->options = get_option($theme_name);
		
		$optionlist = Array(
			array(
				'id' => 'general',
				'name' => 'General',
				'first' => true,
				'options' => array(
					array(
						'name' => 'General',
						'type' => 'title'
					),
					array(
						'id' => 'cp_bloglogo',
						'name' => 'Website logo',
						'type' => 'upload'
					),
					array(
						'id' => 'cp_favicon',
						'name' => 'Favicon',
						'type' => 'upload'
					),

					array(
						'id' => 'cp_callout_section',
						'name' => 'Frontpage Callout',
						'type' => 'wp_dropdown',
						'function'=> 'wp_dropdown_pages',
						'args' => 'show_option_none=Don\'t display section&name=cp_callout_section&selected='.$this->options["cp_callout_section"],
						'desc' => 'The page to be displayed in the first box under the main contents'
					),
					array(
						'id' => 'cp_trackingcode',
						'name' => 'Google analytics',
						'type' => 'text',
						'desc' => 'Insert your google analytics tracking number'
					),
					array(
						'id' => 'cp_sidebar_position',
						'name' => 'Sidebar position',
						'type' => 'dropdown',
						'options' => array(
							'left' => 'Left',
							'right' => 'Right'
						),
						'default' => 'left',
						'desc' => 'The position of the sidebar'
					),
					array(
						'id' => 'cp_latest_title',
						'name' => 'Latest products title',
						'type' => 'text',
						'desc' => 'Latest products title'
					),

					array(
						'id' => 'cp_error_title',
						'name' => '404 error title',
						'type' => 'text',
						'default' => 'Oh No - There\'s nothing here!',
						'desc' => 'The title displayed on a 404 error page'
					),
					array(
						'id' => 'cp_error',
						'name' => '404 error message',
						'type' => 'textarea',
						'desc' => 'The text displayed on a 404 error page'
					)
				)
			),
	
			array(
				'id' => 'design',
				'name' => 'Design',
				'options' => array(
					array(
						'name' => 'Design',
						'type' => 'title'
					),
					array(
						'id' => 'cp_primary_color',
						'name' => 'Theme primary color',
						'type' => 'colorpicker',
						'default' => '521d81',
						'desc' => 'The color used in the theme'
					),
					array(
						'id' => 'cp_bg_color',
						'name' => 'Background Color',
						'type' => 'colorpicker',
						'default' => 'ffffff',
						'desc' => 'The color used as the background'
					),
					array(
						'id' => 'cp_bg_image',
						'name' => 'Background Image',
						'type' => 'upload',
						'default' => '',
						'desc' => 'The image used as the background (background color will be overwritten). Upload all files to the images/background directory in your theme'
					),
					array(
						'id' => 'cp_slider_background',
						'name' => 'Slider Background',
						'type' => 'upload',
						'desc' => 'The background of the slider in the header'

					),
					array(
						'id' => 'cp_slider_fade',
						'name' => 'Slider Fade In Time',
						'type' => 'text',
						'desc' => 'Time in miliseconds for the initial fade-in effect (eg: 800)'
					),
					array(
						'id' => 'cp_slider_speed',
						'name' => 'Slider Slide Speed',
						'type' => 'text',
						'desc' => 'Time in miliseconds for slide-away effect between slides (eg: 600)'
					),
					array(
						'id' => 'cp_slider_pause',
						'name' => 'Slider Slide Pause',
						'type' => 'text',
						'desc' => 'Time to pause for each slide'
					),
					array(
						'id' => 'cp_title_font',
						'name' => 'Title font',
						'type' => 'dropdown',
						'options' => array_keys($this->fontList),
						'default' => 'Open Sans',
						'desc' => 'The font used for headings'
					),
					array(
						'id' => 'cp_body_font',
						'name' => 'Body font',
						'type' => 'dropdown',
						'options' => array_keys($this->fontList),
						'default' => 'Droid Sans',
						'desc' => 'The font used for text'
					)
				)
			),
	
			array(
				'id' => 'social',
				'name' => 'Social sharing',
				'options' => array(
					array(
						'name' => 'Social sharing',
						'type' => 'title'
					),
					array(
						'id' => 'cp_share_twitter',
						'name' => 'Enable sharing on twitter',
						'type' => 'checkbox',
						'default' => '1',
						'desc' => 'This will display a link under your posts to let visitors share the post on twitter'
					),
					array(
						'id' => 'cp_share_fb',
						'name' => 'Enable sharing on facebook',
						'type' => 'checkbox',
						'default' => '1',
						'desc' => 'This will display a link under your posts to let visitors share the post on facebook'
					),
					array(
						'id' => 'cp_share_google',
						'name' => 'Enable sharing on google+',
						'type' => 'checkbox',
						'default' => '1',
						'desc' => 'This will display a link under your posts to let visitors share the post on google'
					),
				)
			),
			array(
				'id' => 'sidebars',
				'name' => 'Custom sidebars',
				'options' => array(
					array(
						'name' => 'Custom sidebars (will be added to the widget page)',
						'type' => 'title'
					),
					array(
						'id' => 'cp_sidebar_name',
						'type' => 'sidebars'
					),
				)
			)
		);
		
		add_action('admin_menu', array(&$this, 'admin_menu'));
		if (!is_array(get_option($theme_name))) {
			$default_settings = $this->setDefaults();
			add_option($theme_name, $default_settings);
			$this->options = get_option($theme_name);
		}
				
		$this->optionlist = $optionlist;
		
	}
	
	function admin_menu() {
	  	add_theme_page('theme settings', 'Theme settings', 'edit_themes', "theme_settings", array(&$this, 'optionsmenu'));
	}
	
	function optionsmenu() {
		global $theme_name;
		
		// Save the settings
		if ($_POST['ss_action'] == 'save') {
		  foreach($this->optionlist as $menuitem) {
			  foreach($menuitem['options'] as $theme_option) {
				  if ($theme_option['type'] == 'sidebars') {
					  $this->options[$theme_option['id'].'[]'] = $_POST[$theme_option['id']];
				  } else {
					  $this->options[$theme_option['id']] = $_POST[$theme_option['id']];
				  }
			  }
		  }
		  update_option($theme_name, $this->options);
		  echo '<div class="updated fade" id="message" style="background-color: rgb(255, 251, 204); width: 300px; margin-left: 20px"><p>Settings <strong>saved</strong>.</p></div>';
		} 
		
		?>
		
		<div class="wrap rm_wrap">
			<h2>Theme settings</h2>
			<p>To easily use the theme, use the options below.</p>
			<div id="theme-menu">
				<?php foreach($this->optionlist as $menuitem) { ?>
				<div class="menu-item <?php if ($menuitem['first']) { echo 'current-item'; } ?>" item="item-<?php echo $menuitem['id']; ?>"><?php echo $menuitem['name']; ?></div>
				<?php } ?>
			</div>
			<div class="rm_opts">
				<form action="" method="post" class="themeform">
					<input type="hidden" id="ss_action" name="ss_action" value="save">
					<?php foreach($this->optionlist as $menuitem) { ?>
					<div class="rm_section item-<?php echo $menuitem['id']; ?>">
						<?php foreach($menuitem['options'] as $theme_option) {
							switch($theme_option['type']) {
								case 'title': ?>
									<div class="rm_title">
										<h3><?php echo $theme_option['name']; ?></h3>
										<span class="submit">
											<input type="submit" value="Save Changes" name="cp_save"/>
										</span>
										<div class="clearfix"></div>
									</div>
									<?php break;
								case 'upload': ?>
									<div class="rm_input rm_text">
										<label for="<?php echo $theme_option['id']; ?>"><?php echo $theme_option['name']; ?></label>
										<input type="text" name="<?php echo $theme_option['id']; ?>" id="<?php echo $theme_option['id']; ?>" class="upload_field" value="<?php echo $this->options[$theme_option['id']]; ?>" />
										<small><input class="upload_button" type="button" value="Browse" /></small><div class="clearfix"></div>
									</div>
									<?php break;
								case 'dropdown': ?>
									<div class="rm_input rm_select">
										<label for="<?php echo $theme_option['id']; ?>"><?php echo $theme_option['name']; ?></label>
										<select name="<?php echo $theme_option['id']; ?>" id="<?php echo $theme_option['id']; ?>">
											<?php foreach($theme_option['options'] as $key => $value) { 
											if (is_numeric($key)) $key = $value; ?>
											<option <?php if ($this->options[$theme_option['id']] == $key) { ?>selected="selected"<?php } ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
											<?php } ?>
										</select>
										<small><?php echo $theme_option['desc']; ?></small><div class="clearfix"></div>
									</div>
									<?php
									break;
									case "categories": 
									
									// Category list
									echo '<div class="rm_input">';
									echo '<label for="'.$theme_option['id'].'">'.$theme_option['name'].'</label>';
                                   
									echo '<div class="sortable-list" style="overflow:auto;width:280px;height:200px;border: 1px solid #DFDFDF;display:inline-block;">';
									$category_array = get_post_meta( $post->ID, $this->prefix . $customField['name'], true );
									$temp_array = array();
									if ($category_array) {
										$temp_array = explode(',',$category_array);
										foreach ($temp_array as $catid) {
											echo '<div class="sortable">';
											echo '<input type="checkbox" checked name="'.$theme_option['id'].'[]" id="' . $this->prefix . $customField['name'] . '" value="' . $catid .'" />' . get_cat_name($catid);
											echo '</div>';
										}
									}
									$categories = get_categories('order_by=name&order=asc&hide_empty=0');
									foreach ($categories as $cat) {
										$array = (!empty($this->options[$theme_option['id']]) AND is_array($this->options[$theme_option['id']])) ? $this->options[$theme_option['id']] : array();
										$checked = (in_array($cat->term_id, $array)) ? "checked = 'checked' " : "";										
										if ($cat->category_parent == 0 && !in_array($cat->term_id, $temp_array)) {
											echo '<div class="sortable">';
											echo '<input type="checkbox" '.$checked.' name="'.$theme_option['id'].'[]" id="' . $this->prefix . $customField['name'] . '" value="' . $cat->term_id .'" />' . $cat->name;
											echo '</div>';
										}
									}
									echo '</div>';
									echo '<small>'.$theme_option['desc'].'</small><div class="clearfix"></div>';
									echo "</div>";
									
									 break;
								case 'wp_dropdown': ?>
									<div class="rm_input rm_select">
										<label for="<?php echo $theme_option['id']; ?>"><?php echo $theme_option['name']; ?></label>
										<?php call_user_func($theme_option['function'], $theme_option['args']) ?>
										<small><?php echo $theme_option['desc']; ?></small><div class="clearfix"></div>
									</div>
									<?php break;
								case 'checkbox': ?>
									<div class="rm_input rm_text">
										<label for="<?php echo $theme_option['id']; ?>"><?php echo $theme_option['name']; ?></label>
										<input type="checkbox" <?php if ($this->options[$theme_option['id']] == '1') { echo 'checked'; } ?>  name="<?php echo $theme_option['id']; ?>" id="<?php echo $theme_option['id']; ?>" value="1" />
										<small><?php echo $theme_option['desc']; ?></small><div class="clearfix"></div>
									</div>
									<?php break;
								case 'textarea': ?>
									<div class="rm_input rm_text">
										<label for="<?php echo $theme_option['id']; ?>"><?php echo $theme_option['name']; ?></label>
										<textarea rows="5" cols="50" name="<?php echo $theme_option['id']; ?>" id="<?php echo $theme_option['id']; ?>"><?php echo stripslashes(htmlspecialchars($this->options[$theme_option['id']])); ?></textarea>
										<small><?php echo $theme_option['desc']; ?></small><div class="clearfix"></div>
									</div>
									<?php break;
								case 'colorpicker': ?>
									<div class="rm_input rm_text">
										<label for="<?php echo $theme_option['id']; ?>"><?php echo $theme_option['name']; ?></label>
										<input type="text" name="<?php echo $theme_option['id']; ?>" id="<?php echo $theme_option['id']; ?>" class="cp_colorpicker" value="<?php echo $this->options[$theme_option['id']]; ?>" />
										<small><?php echo $theme_option['desc']; ?></small><div class="clearfix"></div>
									</div>
									<?php break;
								case 'patterns': ?>
									<div class="rm_input rm_text">
										<label for="<?php echo $theme_option['id']; ?>"><?php echo $theme_option['name']; ?></label>
										<div style="display:inline-block;width:280px;position:relative;">
											<?php foreach ($theme_option['options'] as $pattern) { ?>
												<div style="display:inline-block;background:#eee;padding:5px;margin:0 5px 5px 0;vertical-align:middle;float:left;position:relative;">
												  <div class="pattern_preview" style="background:url('<?php echo get_template_directory_uri(); ?>/images/<?php echo $pattern; ?>.png');height:50px;width:50px;display:inline-block;vertical-align:middle;"></div>
												  <input style="vertical-align:middle;" type="radio" <?php if ($this->options[$theme_option['id']] == $pattern) { echo 'CHECKED'; } ?> name="<?php echo $theme_option['id']; ?>" value="<?php echo $pattern; ?>">
												</div>
											<?php } ?>
										</div>
									</div>
									<?php break;
								case 'sidebars': ?>
									<div id="customsidebars">
									<?php if ($this->options["cp_sidebar_name[]"]) {
										$count = 1;
										foreach ($this->options["cp_sidebar_name[]"] as $i=>$value) {
											if ($value) { ?>
												<div class="rm_input rm_select">
													<label for="cp_sidebar_name[<?php echo $i; ?>]">Sidebar #<?php echo $count; ?> name</label>
													<input type="text" name="cp_sidebar_name[<?php echo $i; ?>]" id="cp_sidebar_name[<?php echo $i; ?>]" value="<?php echo $this->options["cp_sidebar_name[]"][$i]; ?>" />
													<small>The nickname of the sidebar. Please don't use special characters or spaces! Single words are recommended!</small><div class="clearfix"></div>
												</div>
											<?php $count++;
											}
										}
									} ?>
									</div>
									<div class="rm_input rm_select">
										<input id="add_sidebar_button" type="button" value="Add new sidebar" />
										<small></small><div class="clearfix"></div>
									</div>
									<?php break;
								default: ?>
									<div class="rm_input rm_text">
										<label for="<?php echo $theme_option['id']; ?>"><?php echo $theme_option['name']; ?></label>
										<input type="text" name="<?php echo $theme_option['id']; ?>" id="<?php echo $theme_option['id']; ?>" value="<?php echo $this->options[$theme_option['id']]; ?>" />
										<small><?php echo $theme_option['desc']; ?></small><div class="clearfix"></div>
									</div>
									<?php break;
							}
						} ?>
					</div>
					<?php } ?>
				</form>
			</div>
		</div>
		<?php
	}
}
?>