<?php
/*
Name: Social Triggers
Author: Chris Pearson
Description: A high-converting Skin designed to grab&#8212;and hold&#8212;your audience&#8217;s attention.
Version: 1.0.1
Requires: 2.1.2
Class: thesis_social_triggers
License: DIYthemes Software Extensions License Agreement
License URI: http://diythemes.com/thesis/rtfm/software-extensions-license-agreement/

Copyright 2013 DIYthemes, LLC. Patent pending. All rights reserved.
DIYthemes, Thesis, and the Thesis Theme are registered trademarks of DIYthemes, LLC.
*/
class thesis_social_triggers extends thesis_skin {
	public $url = 'http://socialtriggers.com/';

	private $elements = array( // Display options with filter references
		'loop' => array( // 'loop' has been added as a programmatic ID to these Boxes
			'author' => 'thesis_post_author_loop',
			'avatar' => 'thesis_post_author_avatar_loop',
			'description' => 'thesis_post_author_description_loop',
			'twitter' => 'thesis_twitter_profile_loop',
			'wp_featured_image' => 'thesis_wp_featured_image_loop',
			'cats' => 'thesis_post_categories_loop',
			'tags' => 'thesis_post_tags_loop',
			'num_comments' => 'thesis_post_num_comments_loop',
			'image' => 'thesis_post_image_loop',
			'thumbnail' => 'thesis_post_thumbnail_loop'),
		'comments' => array( // 'comments' has been added as a programmatic ID to the date and avatar Boxes
			'post' => 'thesis_html_container_post_comments',
			'page' => 'thesis_html_container_page_comments',
			'date' => 'thesis_comment_date_comments',
			'avatar' => 'thesis_comment_avatar_comments'),
		'email' => array(
			'feature_box' => array(
				'thesis_aweber_form_email_feature_box',
				'thesis_mailchimp_form_email_feature_box'),
			'sidebar' => array(
				'thesis_aweber_form_email_sidebar',
				'thesis_mailchimp_form_email_sidebar'),
			'single' => array(
				'thesis_aweber_form_email_single',
				'thesis_mailchimp_form_email_single')),
		'sidebar' => array( // 'sidebar' is the hook name for 'sidebar' and the programmatic ID for text and widgets
			'sidebar' => 'thesis_html_container_sidebar',
			'text' => 'thesis_text_box_sidebar',
			'widgets' => 'thesis_wp_widgets_sidebar'),
		'misc' => array(
			'feature_box' => 'thesis_query_box_feature_box',
			'attribution' => 'thesis_attribution',
			'wp_admin' => 'thesis_wp_admin'));

	protected function construct() { // Skin API pseudo-constructor; place hooks and filters here
		// implement display options
		foreach ($this->elements as $element => $items)
			if (is_array($items))
				foreach ($items as $item => $filter)
					if (is_array($filter)) {
						foreach ($filter as $supported_box)
							if (empty($this->display[$element]['display'][$item]))
								add_filter("{$supported_box}_show", '__return_false');
					}
					elseif (empty($this->display[$element]['display'][$item]))
						add_filter("{$filter}_show", '__return_false');
		// the previous/next links (found on home, archive, and single templates) require special filtering based on page context
		add_filter('thesis_html_container_prev_next_show', array($this, 'prev_next'));
		add_filter('thesis_site_title', array($this, 'logo')); // add header image as a logo instead of a full-width header image
		add_action('thesis_html_body_class', array($this, 'feature_box'));
	}

	protected function display() { // Skin API method for initiating display options; return an array in Thesis Options API array format
		global $thesis;
		return array( // use an options object set for simplified display controls
			'display' => array(
				'type' => 'object_set',
				'select' => __('Select content to display:', 'thesis'),
				'objects' => array(
					'loop' => array(
						'type' => 'object',
						'label' => __('Post/Page Output', $this->_class),
						'fields' => array(
							'display' => array(
								'type' => 'checkbox',
								'options' => array(
									'author' => __('Author', $this->_class),
									'avatar' => __('Author avatar', $this->_class),
									'description' => __('Author description (single template)', $this->_class),
									'twitter' => __('Author Twitter profile link', $this->_class),
									'wp_featured_image' => __('WP featured image', $this->_class),
									'cats' => __('Categories', $this->_class),
									'tags' => __('Tags', $this->_class),
									'num_comments' => __('Number of comments (home and archive templates)', $this->_class),
									'image' => __('Thesis post image (single, page, and landing page templates)', $this->_class),
									'thumbnail' => __('Thesis thumbnail image (home template)', $this->_class)),
								'default' => array(
									'author' => true,
									'description' => true,
									'twitter' => true,
									'wp_featured_image' => true,
									'num_comments' => true)))),
					'comments' => array(
						'type' => 'object',
						'label' => __('Comments', $this->_class),
						'fields' => array(
							'display' => array(
								'type' => 'checkbox',
								'options' => array(
									'post' => __('Comments on posts', $this->_class),
									'page' => __('Comments on pages', $this->_class),
									'date' => __('Comment date', $this->_class),
									'avatar' => __('Comment avatar', $this->_class)),
								'default' => array(
									'post' => true,
									'avatar' => true)))),
					'email' => array(
						'type' => 'object',
						'label' => __('Email Forms', $this->_class),
						'fields' => array(
							'display' => array(
								'type' => 'checkbox',
								'options' => array(
									'feature_box' => __('Feature box', $this->_class),
									'sidebar' => __('Sidebar', $this->_class),
									'single' => __('After single posts', $this->_class)),
								'default' => array(
									'feature_box' => true,
									'sidebar' => true,
									'single' => true)))),
					'sidebar' => array(
						'type' => 'object',
						'label' => __('Sidebar', $this->_class),
						'fields' => array(
							'display' => array(
								'type' => 'checkbox',
								'options' => array(
									'sidebar' => __('Sidebar', $this->_class),
									'text' => __('Sidebar Text Box', $this->_class),
									'widgets' => __('Sidebar Widgets', $this->_class)),
								'default' => array(
									'sidebar' => true,
									'text' => true,
									'widgets' => true)))),
					'misc' => array(
						'type' => 'object',
						'label' => __('Miscellaneous', $this->_class),
						'fields' => array(
							'display' => array(
								'type' => 'checkbox',
								'options' => array(
									'feature_box' => __('Feature box', $this->_class),
									'prev_next' => __('Previous/next post links (single template)', $this->_class),
									'attribution' => __('Skin attribution', $this->_class),
									'wp_admin' => __('WP admin link in footer', $this->_class)),
								'default' => array(
									'feature_box' => true,
									'prev_next' => true,
									'attribution' => true,
									'wp_admin' => true)))))));
	}

	protected function design() { // Skin API method for initiating design options; return an array in Thesis Options API array format
		global $thesis;
		$css = $thesis->api->css->options; // shorthand for all options available in the CSS API
		$fsc = $sc = $nav = $thesis->api->css->font_size_color(); // the CSS API contains shorthand for font, size, and color options
		unset($sc['font-family']); // remove family control when there is a default
		unset($nav['color']); // remove nav text color control
		return array(
			'colors' => $this->color_scheme(array( // the Skin API contains a color_scheme() method for easy implementation
				'id' => 'colors',
				'colors' => array(
					'text1' => __('Primary Text', $this->_class),
					'text2' => __('Secondary Text', $this->_class),
					'color4' => __('Top Border, Footer <abbr title="background">BG</abbr>', $this->_class),
					'links' => __('Links', $this->_class),
					'color1' => __('Borders &amp; Highlights', $this->_class),
					'color2' => __('Interior <abbr title="background">BG</abbr>s', $this->_class),
					'color3' => __('Site <abbr title="background">BG</abbr>', $this->_class)),
				'default' => array(
					'text1' => '111111',
					'text2' => '888888',
					'color4' => '222222',
					'links' => '8800C4',
					'color1' => 'DDDDDD',
					'color2' => 'EEEEEE',
					'color3' => 'FFFFFF'),
				'scale' => array(
					'color4' => '222222',
					'links' => '888888',
					'color1' => 'DDDDDD',
					'color2' => 'EEEEEE',
					'color3' => 'FFFFFF'))),
			'elements' => array( // this is an object set containing all other design options for this Skin
				'type' => 'object_set',
				'label' => __('Layout, Fonts, Sizes, and Colors', $this->_class),
				'select' => __('Select a design element to edit:', $this->_class),
				'objects' => array(
					'layout' => array(
						'type' => 'object',
						'label' => __('Layout &amp; Dimensions', $this->_class),
						'fields' => array(
							'order' => array(
								'type' => 'radio',
								'options' => array(
									'' => __('Content on the left', $this->_class),
									'right' => __('Content on the right', $this->_class))),
							'width-content' => array(
								'type' => 'text',
								'width' => 'tiny',
								'label' => __('Content Width', $this->_class),
								'tooltip' => __('The default content column width is 585px.', $this->_class),
								'description' => 'px',
								'default' => 585),
							'width-sidebar' => array(
								'type' => 'text',
								'width' => 'tiny',
								'label' => __('Sidebar Width', $this->_class),
								'tooltip' => __('The default sidebar column width is 312px. The value you enter here is the entire width of the column, including the spacing between the content column and sidebar. The resulting width of your text in this column is based on your selected font and font size. We recommend using Chrome Developer Tools or Firebug for Firefox to inspect the text width if you need to achieve a precise value.', $this->_class),
								'description' => 'px',
								'default' => 312))),
					'font' => array(
						'type' => 'object',
						'label' => __('Font &amp; Size (Primary)', $this->_class),
						'fields' => array(
							'font-family' => array_merge($css['font']['fields']['font-family'], array('default' => 'georgia')),
							'size' => array_merge($css['font']['fields']['font-size'], array('default' => 16)))),
					'headline' => array(
						'type' => 'group',
						'label' => __('Headlines', $this->_class),
						'fields' => array_merge(array(
							'font-family' => array_merge($css['font']['fields']['font-family'], array('default' => 'helvetica'))), $sc)),
					'subhead' => array(
						'type' => 'group',
						'label' => __('Sub-headlines', $this->_class),
						'fields' => array_merge(array(
							'font-family' => array_merge($css['font']['fields']['font-family'], array('default' => 'helvetica'))), $sc)),
					'blockquote' => array(
						'type' => 'group',
						'label' => __('Blockquotes', $this->_class),
						'fields' => $fsc),
					'code' => array(
						'type' => 'group',
						'label' => __('Code: Inline &lt;code&gt;', $this->_class),
						'fields' => $fsc),
					'pre' => array(
						'type' => 'group',
						'label' => __('Code: Pre-formatted &lt;pre&gt;', $this->_class),
						'fields' => $fsc),
					'title' => array(
						'type' => 'object',
						'label' => __('Site Title', $this->_class),
						'fields' => array_merge(array(
							'font-family' => array_merge($css['font']['fields']['font-family'], array('default' => 'helvetica'))), $sc)),
					'menu' => array(
						'type' => 'object',
						'label' => __('Nav Menu', $this->_class),
						'fields' => $nav),
					'sidebar' => array(
						'type' => 'group',
						'label' => __('Sidebar', $this->_class),
						'fields' => $fsc),
					'sidebar_heading' => array(
						'type' => 'group',
						'label' => __('Sidebar Headings', $this->_class),
						'fields' => array_merge(array(
							'font-family' => array_merge($css['font']['fields']['font-family'], array('default' => 'helvetica'))), $sc)))));
	}

	public function css_variables() { // Skin API method for modifying CSS variables
		// return an array containing active variable references as keys (not all keys need be included) with their new values
		global $thesis;
		$order = !empty($this->design['layout']['order']) && $this->design['layout']['order'] == 'right' ? true : false;
		$px['w_content'] = !empty($this->design['layout']['width-content']) && is_numeric($this->design['layout']['width-content']) ?
			abs($this->design['layout']['width-content']) : 585;
		$px['w_sidebar'] = !empty($this->design['layout']['width-sidebar']) && is_numeric($this->design['layout']['width-sidebar']) ?
			abs($this->design['layout']['width-sidebar']) : 312;
		$px['w_total'] = $px['w_content'] + $px['w_sidebar'];
		$vars['font'] = $thesis->api->fonts->family($font = !empty($this->design['font']['font-family']) ? $this->design['font']['font-family'] : 'georgia');
		// Determine typographical scale and layout spacing based on primary font and font size
		$f['content'] = $thesis->api->typography->scale($s['content'] = !empty($this->design['font']['size']) ? $this->design['font']['size'] : 16);
		$x['content'] = $thesis->api->typography->space($h['content'] = $thesis->api->typography->height($s['content'], $px['w_content'], $font));
		// Determine sidebar font, size, typographical scale, and spacing
		$sidebar_font = !empty($this->design['sidebar']['font']) ? $this->design['sidebar']['font'] : $font;
		$f['sidebar'] = $thesis->api->typography->scale($s['sidebar'] = !empty($this->design['sidebar']['font-size']) ? $this->design['sidebar']['font-size'] : $f['content']['aux']);
		$x['sidebar'] = $thesis->api->typography->space($h['sidebar'] = $thesis->api->typography->height($s['sidebar'], ($w['sidebar'] = $px['w_sidebar'] - $x['content']['double']), $sidebar_font));
		// Set up an array containing numerical values that require a unit (px, in this case) for CSS output
		$px['f_text'] = $f['content']['text'];
		$px['f_aux'] = $f['content']['aux'];
		$px['f_subhead'] = $f['content']['subhead'];
		$px['h_text'] = round($h['content']);
		$px['h_aux'] = round($thesis->api->typography->height($f['content']['aux'], $px['w_content'], $font));
		foreach ($x['content'] as $dim => $value)
			$px["x_$dim"] = $value;
		foreach ($x['sidebar'] as $dim => $value)
			$px["s_x_$dim"] = $value;
		// Add the 'px' unit to the $px array constructed above by using the CSS API
		$vars = is_array($px) ? array_merge($vars, $thesis->api->css->unit($px)) : $vars;
		// Use the Colors API to set up proper CSS color references
		foreach (array('text1', 'text2', 'links', 'color1', 'color2', 'color3', 'color4') as $color)
			$vars[$color] = !empty($this->design[$color]) ? $thesis->api->colors->css($this->design[$color]) : false;
		// Set up a modification array for individual typograhical overrides
		$elements = array(
			'menu' => array(
				'font-family' => false,
				'font-size' => $f['content']['aux']),
			'title' => array(
				'font-family' => 'helvetica',
				'font-size' => $f['content']['title']),
			'headline' => array(
				'font-family' => 'helvetica',
				'font-size' => $f['content']['headline']),
			'subhead' => array(
				'font-family' => 'helvetica',
				'font-size' => $f['content']['subhead']),
			'blockquote' => array(
				'font-family' => false,
				'font-size' => false,
				'color' => !empty($vars['text2']) ? $vars['text2'] : false),
			'code' => array(
				'font-family' => 'consolas',
				'font-size' => false,
				'color' => false),
			'pre' => array(
				'font-family' => 'consolas',
				'font-size' => false,
				'color' => false),
			'sidebar' => array(
				'font-family' => false,
				'font-size' => $f['sidebar']['text'],
				'color' => false),
			'sidebar_heading' => array(
				'font-family' => 'helvetica',
				'font-size' => $f['sidebar']['subhead'],
				'color' => false));
		// Loop through the modification array to see if any fonts, sizes, or colors need to be overridden
		foreach ($elements as $name => $element) {
			foreach ($element as $p => $def)
				$e[$name][$p] = $p == 'font-family' ?
					(!empty($this->design[$name][$p]) ?
						"$p: ". $thesis->api->fonts->family($family[$name] = $this->design[$name][$p]). ';' : (!empty($def) ?
						"$p: ". $thesis->api->fonts->family($family[$name] = $def). ';' : false)) : ($p == 'font-size' ?
					(!empty($this->design[$name][$p]) && is_numeric($this->design[$name][$p]) ?
						"$p: ". ($size[$name] = $this->design[$name][$p]). "px;" : (!empty($def) ?
						"$p: ". ($size[$name] = $def). "px;" : false)) : ($p == 'color' ?
					(!empty($this->design[$name][$p]) ?
						"$p: ". $thesis->api->colors->css($this->design[$name][$p]). ';' : (!empty($def) ?
						"$p: $def;" : false)) : false));
			$e[$name] = array_filter($e[$name]);
		}
		foreach (array_filter($e) as $name => $element)
			$vars[$name] = implode("\n\t", $element);
		// Override content elements
		$menu_size = !empty($size['menu']) ? $size['menu'] : $px['f_aux'];
		$vars['submenu'] = ($menu_factor = 11). "em";
		$vars['menu'] .= "\n\tline-height: ". round($thesis->api->typography->height($menu_size, round($menu_size * $menu_factor), !empty($family['menu']) ? $family['menu'] : $font)). "px;";
		foreach (array('headline', 'subhead', 'blockquote', 'pre') as $name)
			if (!empty($size[$name]))
				$vars[$name] .= "\n\tline-height: ". ($line[$name] = round($thesis->api->typography->height($size[$name], $px['w_content'], !empty($family[$name]) ? $family[$name] : $font))). "px;";
		// Override sidebar elements
		foreach (array('sidebar', 'sidebar_heading') as $name)
			if (!empty($size[$name]))
				$vars[$name] .= "\n\tline-height: ". round($thesis->api->typography->height($size[$name], $w['sidebar'], !empty($family[$name]) ? $family[$name] : $sidebar_font)). "px;";
		// Determine multi-use color variables
		foreach (array('title', 'headline', 'subhead') as $name)
			$vars["{$name}_color"] = !empty($this->design[$name]['color']) ?
				$thesis->api->colors->css($this->design[$name]['color']) : (!empty($vars['text1']) ? $vars['text1'] : false);
		// Set up property-value variables, which, unlike the other variables above, contain more than just a CSS value
		$vars['column1'] = "float: ". ($order ? 'right' : 'left'). ";";
		$vars['column2'] =
			"float: ". ($order ? 'left' : 'right'). ";\n\t".
			"width: \$w_sidebar;\n\t".
			"padding-". ($order ? 'right' : 'left' ). ": \$x_double;";
		$vars['pullquote'] =
			"font-size: ". $f['content']['headline']. "px;\n\t".
			"line-height: ". round($thesis->api->typography->height($f['content']['headline'], round(0.45 * $px['w_content']), !empty($family['blockquote']) ? $family['blockquote'] : $font)). "px;";
		$vars['avatar'] =
			"width: ". ($avatar = $line['headline'] + $px['h_aux']). "px;\n\t".
			"height: {$avatar}px;";
		$vars['comment_avatar'] =
			"width: ". (2 * $px['h_text']). "px;\n\t".
			"height: ". (2 * $px['h_text']). "px;";
		foreach (array(2, 3, 4) as $factor)
			if (($bio_size = $factor * $px['h_text']) <= 96)
				$bio = $bio_size;
		$vars['bio_avatar'] =
			"width: {$bio}px;\n\t".
			"height: {$bio}px;";
		return array_filter($vars); // Filter the array to remove any null elements
	}

	public function meta_viewport() { // Skin API method for adding viewport meta to the HTML <head>
		return 'width=device-width';
	}

	protected function header_image() { // Skin API method; return the width of the header image container
		$content = !empty($this->design['layout']['width-content']) && is_numeric($this->design['layout']['width-content']) ?
			abs($this->design['layout']['width-content']) : 585;
		$sidebar = !empty($this->design['layout']['width-sidebar']) && is_numeric($this->design['layout']['width-sidebar']) ?
			abs($this->design['layout']['width-sidebar']) : 312;
		return round(($content + $sidebar) / 2);
	}

	public function logo($title) { // Custom method to replace the site title with a logo (if the user has supplied one)
		if (empty($this->header_image)) return $title;
		return "<img id=\"thesis_header_image\" src=\"". esc_url($this->header_image['src']). "\" alt=\"$title\" width=\"{$this->header_image['width']}\" height=\"{$this->header_image['height']}\" title=\"". __('click to go to the home page', 'thesis'). "\" />\n";
	}

	public function filter_css($css) { // Skin API method for filtering the CSS on each CSS rewrite
		return $css. (!empty($this->header_image) ? // Let's confine the title link to just the logo, if necessary
			"#site_title a {\n".
			"\tdisplay: inline-block;\n".
			"\tvertical-align: middle;\n".
			"}" : '');
	}

	/*---:[ custom Skin filters below this line ]:---*/

	public function feature_box($classes) {
		if (is_home() && !empty($this->display['misc']['display']['feature_box']))
			$classes['feature_box'] = 'has_feature_box';
		return $classes;
	}

	public function prev_next() {
		global $wp_query;
		return (($wp_query->is_home || $wp_query->is_archive || $wp_query->is_search) && $wp_query->max_num_pages > 1) || ($wp_query->is_single && !empty($this->display['misc']['display']['prev_next'])) ? true : false;
	}
}