<?php
/*
Name: MailChimp Signup Form
Author: Matt Gross — DIYthemes
Description: Seamless MailChimp integration and easy opt-in forms help you focus on building your audience instead of technical details.
Version: 1.1
Class: thesis_mailchimp_form
License: DIYthemes Software Extensions License Agreement
License URI: http://diythemes.com/thesis/rtfm/software-extensions-license-agreement/

Copyright 2013 DIYthemes, LLC. All rights reserved.
DIYthemes, Thesis, and the Thesis Theme are registered trademarks of DIYthemes, LLC.
*/
class thesis_mailchimp_form extends thesis_box {
	public $type = 'rotator';
	public $dependents = array(
		'thesis_mailchimp_name',
		'thesis_mailchimp_email',
		'thesis_mailchimp_submit');
	public $children = array(
		'thesis_mailchimp_email',
		'thesis_mailchimp_submit');
	private $app_url = 'http://admin.mailchimp.com/account/api-key-popup';
	private $key = array();
	private $data = array();

	public function translate() {
		$this->name = $this->title = __('MailChimp', $this->_class);
	}

	public function construct() {
		$this->key = get_option(__CLASS__ . '_key');
		$this->data = get_option(__CLASS__ . '_data');
	}

	public function admin_init() {
		wp_enqueue_style('thesis-options');
		add_action('admin_head', array($this, 'admin_css'));
		add_action('admin_head', array($this, 'admin_js'));
	}

	public function admin_ajax() {
		add_action('wp_ajax_connect_mailchimp', array($this, 'connect'));
		add_action('wp_ajax_disconnect_mailchimp', array($this, 'disconnect'));
		add_action('wp_ajax_save_mailchimp', array($this, 'save'));
	}

	public function admin_css() {
		echo
			"<style>\n",
			"#thesis_mailchimp { max-width: 600px; }\n",
			"#thesis_mailchimp p { margin-bottom: 25px; }\n",
			"#thesis_mailchimp h4 { font: bold 20px/30px \"Helvetica Neue\", Helvetica, Arial, sans-serif; margin: 38px 0 13px 0; }\n",
			"#thesis_mailchimp ol { margin-left: 25px; }\n",
			"#thesis_mailchimp li a { text-decoration: underline; }\n",
			"#thesis_mailchimp kbd { font-size: 14px; font-weight: normal; padding: 4px 6px; background: #fff; border: 1px solid #999; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; -webkit-box-shadow: 0 0 1px rgba(0,0,0,0.5); -moz-box-shadow: 0 0 1px rgba(0,0,0,0.5); box-shadow: 0 0 1px rgba(0,0,0,0.5); }\n",
			"</style>\n";
	}

	public function admin() {
		global $thesis;
		$form = '';
		$title = __('MailChimp Box Default Settings', $this->_class);
		if (empty($this->key)) {
			$title = __('Connect to MailChimp', $this->_class);
			$api_key = $thesis->api->form->fields(array(
				'api_key' => array(
					'type' => 'text',
					'width' => 'long',
					'label' => __('MailChimp API Key', $this->_class))), array(), false, false, 1, 3);
			$form =
				"\t\t\t<p>". __('Before we can get information about your account, we need to connect to MailChimp. You will be asked to log in to MailChimp, and you will be given an API key.', $this->_class). "</p>\n".
				"\t\t\t<p><a data-style=\"button action\" target=\"_blank\" href=\"$this->app_url\">". __('Click here to get your API key', $this->_class). "</a></p>\n".
				"\t\t\t<p>". __('Once you have received your API key, paste it into the box below and click Connect to MailChimp.', $this->_class). "</p>\n".
				$api_key['output'].
				"\t\t\t<p><input type=\"submit\" data-style=\"button save\" id=\"connect_mailchimp\" name=\"connect_mailchimp\" value=\"". __('Connect to MailChimp', $this->_class). "\" /></p>\n";
		}
		else {
			include_once(dirname(__FILE__) . '/MCAPI.class.php');
			$chimp = new MCAPI($this->key);
			$get_lists = $chimp->lists();
			$lists = $cache = $dropdown = array();
			foreach ($get_lists['data'] as $list) {
				$id = esc_attr($list['id']);
				$name = esc_attr($list['name']);
				$lists[$id] = $name;
				$cache[$id] = array(
					'name' => $name,
					'url' => esc_url_raw($list['subscribe_url_long']));
			}
			update_option(__CLASS__ . '_cache', $cache);
			wp_cache_flush();
			$select_list = $thesis->api->form->fields(array(
				'list' => array(
					'type' => 'select',
					'label' => __('Default List', $this->_class),
					'tooltip' =>__('The list you select here will appear as the default list every time you deploy a MailChimp Box.', $this->_class),
					'options' => array('' => __('Select an email list:', $this->_class)) + $lists)), !empty($this->data) ? $this->data : array(), 'mailchimp_', false, 10, 3);
			$form =
				$select_list['output'].
				"\t\t\t<h4>". __('How to Add MailChimp to a Template', $this->_class). "</h4>\n".
				"\t\t\t<ol class=\"step_list\">\n".
				"\t\t\t\t<li>". sprintf(__('Head over to the <a href="%1$s" target="_blank">Thesis Skin Editor</a>, and navigate to a template where you&#8217;d like to add a MailChimp email signup form.', $this->_class), home_url('?thesis_editor=1')). "</li>\n".
				"\t\t\t\t<li>". sprintf(__('In the %1$s Editor, click the dropdown list that says <strong>Select a Box to add</strong>, choose <strong>MailChimp Box</strong>, and then click the <strong>Add Box</strong> button.', $this->_class), $thesis->api->base['html']). "</li>\n".
				"\t\t\t\t<li>". __('<kbd>shift</kbd> + drag the newly created box to the location on your template where you want it to appear.', $this->_class). "</li>\n".
				"\t\t\t</ol>\n".
				"\t\t\t<h4>". __('Disconnect MailChimp', $this->_class). "</h4>\n".
				"\t\t\t<p>". __('If you wish to disconnect MailChimp from this site, just click the button below.', $this->_class). "</p>\n".
				"\t\t\t<p><input type=\"submit\" data-style=\"button delete\" id=\"disconnect_mailchimp\" name=\"disconnect_mailchimp\" value=\"". __('Disconnect MailChimp', $this->_class). "\" /></p>\n".
				"\t\t\t<input type=\"submit\" data-style=\"button save\" class=\"t_save\" id=\"save_mailchimp\" name=\"save_mailchimp\" value=\"". __('Save Options', $this->_class). "\" />\n";
		}
		echo
			"\t\t<h3>$title</h3>\n",
			"\t\t<form id=\"thesis_mailchimp\" method=\"post\" action=\"\">\n",
			$form,
			"\t\t\t", wp_nonce_field('thesis-mailchimp', '_wpnonce-mailchimp', true, false), "\n",
			"\t\t</form>\n";
	}

	public function options() {
		global $thesis;
		$lists = array('' => __('Select a list:', $this->_class));
		if (is_array($cache = get_option(__CLASS__ . '_cache')))
			foreach ($cache as $id => $data)
				$lists[$id] = $data['name'];
		else return;
		return array_merge(array(
			'list' => array(
				'type' => 'select',
				'label' => __('List Name', $this->_class),
				'tooltip' => __('Select a list from your MailChimp account.', $this->_class),
				'options' => $lists,
				'default' => !empty($this->data['list']) ? $this->data['list'] : false),
			'content_options' => array(
				'type' => 'group',
				'label' => __('Content Options', 'thesis'),
				'fields' => array(
					'title' => array(
						'type' => 'text',
						'width' => 'full',
						'label' => __('Title', 'thesis')),
					'intro' => array(
						'type' => 'textarea',
						'rows' => 2,
						'label' => __('Intro Text', 'thesis'))))));
	}

	public function html_options() {
		return $GLOBALS['thesis']->api->html_options();
	}

	public function html($args = false) {
		global $thesis;
		extract($args = is_array($args) ? $args : array());
		$list = !empty($this->options['list']) ?
			$this->options['list'] : (!empty($this->data['list']) ?
			$this->data['list'] : false);
		if (empty($list) || !is_array($cache = get_option(__CLASS__ . '_cache'))) return;
		$tab = str_repeat("\t", $depth = !empty($depth) ? $depth : 0);
		$_id = !empty($this->options['id']) ? ' id="'. trim($thesis->api->esc($this->options['id'])) .'"' : '';
		$class = !empty($this->options['class']) ? ' ' . trim($thesis->api->esc($this->options['class'])) : '';
		$get_list = parse_url($cache[$list]['url']);
		parse_str($get_list['query']);
		$url = $get_list['scheme'] . '://' . $get_list['host'] . '/subscribe/post';
		echo
			"$tab<form$_id class=\"thesis_email_form$class\" method=\"post\" action=\"$url\">\n",
			(!empty($this->options['title']) ?
			"$tab\t<". (($html = !empty($this->options['title_html']) ? $thesis->api->esc($this->options['title_html']) : 'p')). ' class="email_form_title'. (!empty($this->options['title_class']) ? ' '. trim($thesis->api->esc($this->options['title_class'])) : ''). '">'. $thesis->api->allow_html(stripslashes($this->options['title'])). "</$html>\n" : ''),
			(!empty($this->options['intro']) ?
			"$tab\t<p class=\"email_form_intro\">". $thesis->api->allow_html(stripslashes($this->options['intro'])). "</p>\n" : '');
			$this->rotator(array('depth' => $depth + 1));
		echo
			"$tab\t<input type=\"hidden\" name=\"u\" value=\"", esc_attr($u), "\">\n",
			"$tab\t<input type=\"hidden\" name=\"id\" value=\"", esc_attr($id), "\">\n",
			"$tab</form>\n";
	}

	public function connect() {
		global $thesis;
		$form = $this->check();
		if (!empty($form['api_key'])) {
			$this->key = esc_attr($form['api_key']);
			update_option(__CLASS__ . '_key', $this->key);
			wp_cache_flush();
		}
		$this->admin();
		if ($thesis->environment == 'ajax') die();
	}

	public function disconnect() {
		global $thesis;
		$this->check();
		delete_option(__CLASS__ . '_key');
		delete_option(__CLASS__ . '_cache');
		delete_option(__CLASS__ . '_data');
		wp_cache_flush();
		$this->key = array();
		$this->admin();
		if ($thesis->environment == 'ajax') die();
	}

	public function save() {
		global $thesis;
		$form = $this->check();
		$save = array();
		if (!empty($form['list']))
			$save['list'] = $form['list'];
		if (!empty($save))
			update_option("{$this->_class}_data", $save);
		else
			delete_option("{$this->_class}_data");
		wp_cache_flush();
		echo $thesis->api->alert(__('MailChimp options saved!', $this->_class), 'mailchimp_saved', true);
		if ($thesis->environment == 'ajax') die();
	}

	public function check() {
		global $thesis;
		$thesis->wp->check('edit_theme_options');
		parse_str(stripslashes($_POST['form']), $form);
		$thesis->wp->nonce($form['_wpnonce-mailchimp'], 'thesis-mailchimp');
		return $form;
	}

	public function admin_js() {
?>
<script type="text/javascript">
var thesis_mailchimp;
(function($) {
thesis_mailchimp = {
	init: function() {
		$('.option_field label .toggle_tooltip').on('click', function() {
			$(this).parents('label').parents('p').siblings('.tooltip:first').toggle();
			return false;
		});
		$('.tooltip').on('mouseleave', function() { $(this).hide(); });
		$('#connect_mailchimp').on('click', function() {
			thesis_mailchimp.connect();
			return false;
		});
		$('#disconnect_mailchimp').on('click', function() {
			thesis_mailchimp.disconnect();
			return false;
		});
		$('#save_mailchimp').on('click', function() {
			thesis_mailchimp.save();
			return false;
		});
	},
	connect: function() {
		$('#connect_aweber').prop('disabled', true);
		$.post(ajaxurl, { action: 'connect_mailchimp', form: $('#thesis_mailchimp').serialize() }, function(connected) {
			$('#t_canvas').html(connected);
			thesis_mailchimp.init();
		});
	},
	disconnect: function () {
		if (!confirm('<?php esc_html_e('Are you sure you want to disconnect your MailChimp account from Thesis?', $this->_class); ?>')) return;
		$('#disconnect_mailchimp').prop('disabled', true);
		$.post(ajaxurl, { action: 'disconnect_mailchimp', form: $('#thesis_mailchimp').serialize() }, function(disconnect) {
			$('#t_canvas').html(disconnect);
			thesis_mailchimp.init();
		});
	},
	save: function() {
		$('#save_mailchimp').prop('disabled', true);
		$.post(ajaxurl, { action: 'save_mailchimp', form: $('#thesis_mailchimp').serialize() }, function(saved) {
			$('#save_mailchimp').prop('disabled', false);
			$('#t_canvas').append(saved);
			$('#mailchimp_saved').css({'right': $('#save_mailchimp').outerWidth()+35+'px'});
			$('#mailchimp_saved').fadeOut(3000, function() { $(this).remove(); });
		});
	}
};
$(document).ready(function($){ thesis_mailchimp.init(); });
})(jQuery);
</script>
<?php
	}
}

class thesis_mailchimp_name extends thesis_box {
	public function translate() {
		$this->title = __('Name Input', $this->_class);
	}

	public function html_options() {
		return array(
			'placeholder' => array(
				'type' => 'text',
				'width' => 'medium',
				'label' => __('Placeholder Text', $this->_class),
				'tooltip' => __('Placeholder text for the name field. This text will appear when the user has not entered anything into the input field.', $this->_class)),
			'label' => array(
				'type' => 'checkbox',
				'label' => __('Input Label', $this->_class),
				'options' => array(
					'show' => __('Show name label', $this->_class)),
				'tooltip' => __('Selecting this option will display this field&#8217;s label. The label will appear before the input in the markup.', $this->_class),
				'dependents' => array('show')),
			'label_text' => array(
				'type' => 'text',
				'width' => 'medium',
				'label' => __('Label Text', $this->_class),
				'tooltip' => __('This will be the text output for the label.', $this->_class),
				'placeholder' => __('Name', $this->_class),
				'parent' => array('label' => 'show')));
	}

	public function html($args = false) {
		global $thesis;
		extract($args = is_array($args) ? $args : array());
		$tab = str_repeat("\t", !empty($depth) ? $depth : 0);
		$text = !empty($this->options['placeholder']) ? esc_js($this->options['placeholder']) : '';
		$placeholder = $text ? " onfocus=\"if (this.value == '$text') {this.value = '';}\" onblur=\"if (this.value == '') {this.value = '$text';}\"" : '';
		echo (!empty($this->options['label']) ?
			"$tab<label class=\"thesis_email_form_name_label\">". (!empty($this->options['label_text']) ? $thesis->api->esc($this->options['label_text']) : 'Name'). "</label>\n" : ''),
			"$tab<input type=\"text\" class=\"thesis_email_form_name input_text\" name=\"MERGE1\" value=\"", ($text ? $thesis->api->esc($this->options['placeholder']) : ''), "\"$placeholder />\n";
	}
}

class thesis_mailchimp_email extends thesis_box {
	public function translate() {
		$this->title = __('Email Input', $this->_class);
	}

	public function html_options() {
		return array(
			'placeholder' => array(
				'type' => 'text',
				'width' => 'medium',
				'label' => __('Placeholder Text', $this->_class),
				'tooltip' => __('Placeholder text for the email field. This text will appear when the user has not entered anything into the input field.', $this->_class)),
			'label' => array(
				'type' => 'checkbox',
				'label' => __('Input Label', $this->_class),
				'options' => array(
					'show' => __('Show email label', $this->_class)),
				'tooltip' => __('Selecting this option will display this field&#8217;s label. The label will appear before the input in the markup.', $this->_class),
				'dependents' => array('show')),
			'label_text' => array(
				'type' => 'text',
				'width' => 'medium',
				'label' => __('Label Text', $this->_class),
				'tooltip' => __('This will be the text output for the label.', $this->_class),
				'placeholder' => __('Email', $this->_class),
				'parent' => array('label' => 'show')));
	}

	public function html($args = false) {
		global $thesis;
		extract($args = is_array($args) ? $args : array());
		$tab = str_repeat("\t", !empty($depth) ? $depth : 0);
		$text = !empty($this->options['placeholder']) ? esc_js($this->options['placeholder']) : '';
		$placeholder = $text ? " onfocus=\"if (this.value == '$text') {this.value = '';}\" onblur=\"if (this.value == '') {this.value = '$text';}\"" : '';
		echo (!empty($this->options['label']) ?
			"$tab<label class=\"thesis_email_form_email_label\">". (!empty($this->options['label_text']) ? $thesis->api->esc($this->options['label_text']) : 'Email'). "</label>\n" : ''),
			"$tab<input type=\"text\" class=\"thesis_email_form_email input_text\" name=\"MERGE0\" value=\"", ($text ? $thesis->api->esc($this->options['placeholder']) : ''), "\"$placeholder />\n";
	}
}

class thesis_mailchimp_submit extends thesis_box {
	public function translate() {
		$this->title = __('Submit Button', $this->_class);
	}

	public function html_options() {
		return array(
			'submit' => array(
				'type' => 'text',
				'width' => 'medium',
				'label' => __('Submit Button Text', $this->_class),
				'placeholder' => __('Get Updates!', $this->_class)));
	}

	public function html($args = false) {
		global $thesis;
		extract($args = is_array($args) ? $args : array());
		echo str_repeat("\t", !empty($depth) ? $depth : 0),
			"<input type=\"submit\" class=\"thesis_email_form_submit input_submit\" name=\"submit\" value=\"", (!empty($this->options['submit']) ? $thesis->api->esc($this->options['submit']) : __('Get Updates!', $this->_class)), "\" />\n";
	}
}