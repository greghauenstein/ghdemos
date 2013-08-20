<?php
/*
Copyright 2013 DIYthemes, LLC. Patent pending. All rights reserved.
DIYthemes, Thesis, and the Thesis Theme are registered trademarks of DIYthemes, LLC.
License: DIYthemes Software License Agreement
License URI: http://diythemes.com/thesis/rtfm/software-license-agreement/
*/
class thesis_colors {
	private $v = array(
		'v1' => array(0, 1, 2),
		'v2' => array(0, 2, 1),
		'v3' => array(1, 0, 2),
		'v4' => array(2, 0, 1),
		'v5' => array(1, 2, 0),
		'v6' => array(2, 1, 0));
	private $wheel = array(
		array(3, 1), // red
		array(1, 1), // red-pink
		array(2, 3), // pink
		array(4, 3), // pink-purple
		array(2, 4), // purple
		array(1, 6), // purple-blue
		array(3, 5), // dark blue
		array(1, 5), // blue
		array(2, 2), // lighter blue
		array(4, 1), // turquoise
		array(2, 1), // sea green
		array(1, 3), // light green
		array(3, 3), // green
		array(1, 4), // green-olive
		array(2, 6), // olive
		array(4, 5), // yellow
		array(2, 5), // orange
		array(1, 2)); // orange-red
	private $complements = array(
		array('r', 'b', 'g'),
		array('b', 'r', 'g'),
		array('b', 'g', 'r'),
		array('g', 'r', 'b'),
		array('g', 'b', 'r'));
	private $tolerance = 40;
	public $conflict = array('bisque', 'indigo', 'maroon', 'orange', 'orchid', 'purple', 'red', 'salmon', 'sienna', 'silver', 'tan', 'tomato', 'violet', 'yellow');
	public $black = array(
		'r' => 0,
		'g' => 0,
		'b' => 0);
	public $white = array(
		'r' => 255,
		'g' => 255,
		'b' => 255);
	public $half = array(
		'r' => 127,
		'g' => 127,
		'b' => 127);

	public function css($color) {
		return (strlen($color) == 3 || strlen($color) == 6) && !in_array($color, $this->conflict) ? "#$color" : $color;
	}

	public function delta($dmin = 40, $dmax = 150, $interval = 10) {
		if (!is_numeric($dmin) || !is_numeric($dmax) || !is_numeric($interval)) return;
		$delta = array();
		for ($d = $dmin; $d <= $dmax; $d = $d + $interval)
			$delta[$d] = array(
				't1' => array($d * 0.8, -($d * 0.6), 0),
				't2' => array(-($d * 0.8), $d * 0.6, 0),
				't3' => array($m = round(sqrt(pow($d, 2) - 2 * pow($d * 0.4, 2)), 0), -($d * 0.4), -($d * 0.4)),
				't4' => array(-$m, $d * 0.4, $d * 0.4));
		return $delta;
	}

	public function rgb($hex) {
		if (empty($hex)) return false;
		$rgb = array();
		if (strlen($hex) == 6) {
			$rgb['r'] = hexdec($hex[0]. $hex[1]);
			$rgb['g'] = hexdec($hex[2]. $hex[3]);
			$rgb['b'] = hexdec($hex[4]. $hex[5]);
		}
		elseif (strlen($hex) == 3) {
			$rgb['r'] = hexdec($hex[0]. $hex[0]);
			$rgb['g'] = hexdec($hex[1]. $hex[1]);
			$rgb['b'] = hexdec($hex[2]. $hex[2]);
		}
		return $rgb;
	}

	public function hex($rgb) {
		if (!is_array($rgb)) return false;
		return sprintf('%02s', dechex($rgb['r'])). sprintf('%02s', dechex($rgb['g'])). sprintf('%02s', dechex($rgb['b']));
	}

	public function distance($rgb1, $rgb2) {
		if (!is_array($rgb1) || !is_array($rgb2)) return;
		return sqrt(pow($rgb1['r'] - $rgb2['r'], 2) + pow($rgb1['g'] - $rgb2['g'], 2) + pow($rgb1['b'] - $rgb2['b'], 2));
	}

	public function gray($color) {
		if (empty($color)) return;
		$channel = round(sqrt(pow($this->distance((is_array($color) ? $color : $this->rgb($color)), $this->black), 2) / 3), 0);
		$gray = array('r' => $channel, 'g' => $channel, 'b' => $channel);
		return array(
			'hex' => $this->hex($gray),
			'rgb' => $gray);
	}

	public function scheme($scheme, $values, $name) {
		if (!is_array($scheme) || !is_array($values) || empty($name) || empty($scheme['id']) || !is_array($scheme['colors'])) return;
		$inputs = $scale = '';
		$class = 'scheme'. (!empty($scheme['text']) ? '_text' : '');
		foreach ($scheme['colors'] as $id => $label)
			$inputs .=
				"\t\t<div class=\"scheme_color\">\n".
				"\t\t\t<input type=\"text\" class=\"$class color {required:false,adjust:false}\" id=\"{$scheme['id']}-$id\" name=\"{$name}[$id]\" value=\"". esc_attr(stripslashes($values[$id])). "\" />\n".
				"\t\t\t<span class=\"complement\" data-style=\"icon\" data-id=\"{$scheme['id']}-$id\" title=\"". __('complementary colors', 'thesis'). "\">&#128166;</span>\n".
				"\t\t\t<div class=\"complements\">\n".
				"\t\t\t</div>\n".
				"\t\t\t<label for=\"{$scheme['id']}-$id\">$label</label>\n".
				"\t\t</div>\n";
		if (!empty($scheme['scale']) && !empty($scheme['default']))
			$scale =
				"\t<div class=\"scheme_color_scale\">\n".
				"\t\t<button data-style=\"flat_button\" class=\"color_scale\">". __('Thesis ColorScale', 'thesis'). " <span data-style=\"icon\">&#59395;</span></button>\n".
				$this->scale_picker($scheme['id'], $scheme['scale'], $scheme['default']).
				"\t</div>\n";
		if (!empty($inputs))
			return
				"\t<div class=\"scheme_colors\">\n".
				$inputs.
				"\t</div>\n".
				$scale;
	}

	public function scale_picker($scheme, $colors, $defaults, $depth = false) {
		if (empty($scheme) || !is_array($colors) || !is_array($defaults)) return;
		$tab = str_repeat("\t", !empty($depth) && is_numeric($depth) ? $depth : 0);
		$scales = $swatches = array();
		$grays = $default_colors = '';
		foreach ($colors as $id => $hex)
			$scales[$id] = $this->transform($this->rgb($hex));
		foreach ($scales as $id => $deltas) {
			$grays .= "<input type=\"hidden\" class=\"grayscale\" data-scheme=\"$scheme\" data-id=\"$id\" data-value=\"{$colors[$id]}\" />";
			$default_colors .= "<input type=\"hidden\" class=\"defaults\" data-scheme=\"$scheme\" data-id=\"$id\" data-value=\"{$defaults[$id]}\" />";
		}
		$picker =
			"$tab\t<div class=\"default_row\">\n".
			(!empty($grays) ?
			"$tab\t\t<span class=\"control_swatch default_swatch\" title=\"". __('grayscale', 'thesis'). "\" data-value=\"grayscale\">". __('Grayscale', 'thesis'). "</span>\n".
			"$tab\t\t$grays\n" : '').
			"$tab\t\t<span class=\"default_swatch home_swatch\">". __('ColorScale', 'thesis'). "</span>\n".
			(!empty($default_colors) ?
			"$tab\t\t<span class=\"control_swatch default_swatch\" title=\"". __('defaults', 'thesis'). "\" data-value=\"defaults\">". __('Default Colors', 'thesis'). "</span>\n".
			"$tab\t\t$default_colors\n" : '').
			"$tab\t</div>\n";
		foreach (($swatches = $this->transform($this->half)) as $delta => $transforms) {
			$row = '';
			foreach ($this->wheel as $combo) {
				$inputs = '';
				foreach ($scales as $id => $deltas) {
					$v = $this->hex($deltas[$delta]["t{$combo[0]}"]["v{$combo[1]}"]);
					$inputs .= "<input type=\"hidden\" class=\"d{$delta}t{$combo[0]}v{$combo[1]}\" data-scheme=\"$scheme\" data-id=\"$id\" data-value=\"$v\" />";
				}
				$variant = $this->hex($swatches[$delta]["t{$combo[0]}"]["v{$combo[1]}"]);
				$row .=
					"$tab\t\t<span class=\"control_swatch color_swatch\" style=\"background: #$variant;\" title=\"$variant\" data-value=\"d{$delta}t{$combo[0]}v{$combo[1]}\"></span>\n".
					(!empty($inputs) ?
					"$tab\t\t$inputs\n" : '');
			}
			$picker .= !empty($row) ? "$tab\t<div class=\"color_row\">\n$row$tab\t</div>\n" : '';
		}
		if (!empty($picker))
			return
				"$tab<div class=\"color_picker\">\n".
				$picker.
				"$tab</div>\n";
	}

	private function transform($rgb) {
		if (empty($rgb)) return false;
		$new = array();
		foreach ($this->delta() as $delta => $transforms)
			foreach ($transforms as $t => $transform)
				if (is_array($add = $this->rgb_transform($rgb, $transform)) && !empty($add))
					$new[$delta][$t] = !empty($new[$delta][$t]) && is_array($new[$delta][$t]) ?
						array_merge($new[$delta][$t], $add) : $add;
		return $new;
	}

	private function rgb_transform($rgb, $transform) {
		if (!is_array($rgb) || !is_array($transform)) return false;
		$new = $unique = array();
		$count = count(array_filter($transform)) > 2 ? 1 : false;
		$f = 1 - (abs(($tune = sqrt(3 * pow(255, 2)) / 2) - ($db = $this->distance($rgb, $this->black))) / $tune);
		foreach ($this->v as $v => $variant) {
			foreach ($variant as $key => $index) {
				$channel = $key == 1 ? 'g' : ($key == 2 ? 'b' : 'r');
				$new[$v][$channel] = ($value = round($rgb[$channel] + $f * $transform[$index], 0)) > 255 ? 255 : ($value < 0 ? 0 : $value);
			}
			if (!empty($count)) {
				// If tolerance is being used, it should be added here
				if ($count % 2 == 0)
			 		unset($new[$v]);
				$count++;
			}
		}
		return $new;
	}

	public function complement($original) {
		global $thesis;
		if (empty($original) || !(strlen($original) == 3 || strlen($original) == 6) || !is_array($orgb = $this->rgb($original))) return false;
		$colors = $hexes = array();
		$swatches = '';
		$distance = 0;
		foreach ($this->complements as $k => $complement) {
			$rgb = array();
			foreach ($complement as $i => $channel) {
				$ch = $i == 1 ? 'g' : ($i == 2 ? 'b' : 'r');
				$rgb[$ch] = $orgb[$channel];
			}
			if (($d = $this->distance($orgb, $rgb)) > 0 && !in_array(($hex = $this->hex($rgb)), $hexes)) {
				$colors[$k] = array();
				$colors[$k]['rgb'] = $rgb;
				$colors[$k]['hex'] = $hexes[] = $hex;
				$colors[$k]['swatch'] = "<span class=\"color_swatch complement_swatch\" style=\"background: #{$colors[$k]['hex']};\" data-value=\"{$colors[$k]['hex']}\" title=\"color: {$colors[$k]['hex']}, distance: $d\"></span>\n";
				$distance = $distance + ($colors[$k]['distance'] = $d);
			}
		}
		if (empty($colors)) return false;
		$davg = $distance / count($colors);
		foreach ($colors as $k => $color)
			if ($color['distance'] >= $davg)
				$swatches .= $color['swatch'];
		return !empty($swatches) ? $swatches : false;
	}

	public function scheme_options($schemes, $default = false) {
		if (!is_array($schemes)) return;
		$options = array();
		foreach ($schemes as $id => $colors)
			if (is_array($colors))
				$options[$id] = implode('', array_map(array($this, 'wrap_color'), $colors));
		return $options;
	}

	private function wrap_color($color) {
		return sprintf('<span class="t_color_scheme" style="background: %1$s;" title="%1$s"></span>', $this->css($color));
	}
}