<?php

function thesis_social_triggers_defaults() {
	return array (
  'css' => '/*---:[ general styles and layout structure ]:---*/
body {
	font-family: $font;
	font-size: $f_text;
	line-height: $h_text;
	color: $text1;
	border-top: 5px solid $color4;
	background-color: $color3;
}
a {
	color: $links;
	text-decoration: none;
}
p a {
	text-decoration: underline;
}
.container {
	width: $w_total;
	margin: 0 auto;
}
.landing .container {
	width: $w_content;
}
.full_width {
	min-width: $w_total;
}
.columns, .columns > .content, .columns > .sidebar {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
.columns > .content {
	width: $w_content;
	$column1
}
.columns > .sidebar {
	$column2
}
/*---:[ nav menu ]:---*/
.menu {
	position: relative;
	float: right;
	z-index: 50;
	list-style: none;
}
.menu li {
	position: relative;
	float: left;
}
.menu .sub-menu {
	position: absolute;
	display: none;
	list-style: none;
	z-index: 110;
}
.menu .sub-menu .sub-menu {
	top: 0;
	left: $submenu;
}
.menu li:hover > .sub-menu {
	display: block;
}
.menu .sub-menu li {
	width: $submenu;
	clear: both;
}
.menu a, .menu_control {
	display: block;
	$menu
	text-transform: uppercase;
	letter-spacing: 1px;
	color: $color1;
	background-color: $color4;
	padding: 0.6em 1em;
}
.menu a:hover {
	color: $color3;
	background-color: $links;
}
.menu_control {
	display: none;
	color: $color1;
	background-color: $color4;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}
.menu .current-menu-item > a {
	color: $color2;
	background-color: $links;
	cursor: text;
}
/*---:[ site title ]:---*/
#site_title {
	$title
	line-height: 1.32em;
	font-weight: bold;
	color: $title_color;
	border-bottom: 1px solid $color1;
	margin-bottom: $x_single;
	padding: $x_3over2 0;
}
.has_feature_box #site_title {
	border-bottom: 0;
	margin-bottom: 0;
}
.landing #site_title {
	text-align: center;
}
.landing #site_title img {
	margin: 0 auto;
}
#site_title a {
	color: $title_color;
}
#site_title a:hover {
	color: $links;
}
/*---:[ golden ratio typography with spaced paragraphs ]:---*/
.grt, .grt h3 {
	font-size: $f_text;
	line-height: $h_text;
}
.grt .headline {
	$headline
	margin: 0;
}
.grt h2 {
	$subhead
	margin-top: $x_3over2;
	margin-bottom: $x_half;
}
.grt .small, .grt .caption {
	font-size: $f_aux;
	line-height: $h_aux;
}
.grt .drop_cap {
	font-size: $x_double;
	line-height: 1em;
	margin-right: 0.15em;
	float: left;
}
.grt p, .grt ul, .grt ol, .grt blockquote, .grt pre, .grt dl, .grt dd, .grt .center, .grt .block, .grt .caption, .grt .aligncenter, .grt .alignnone, .grt .left, .grt .alignleft, .grt .right, .grt .alignright, .grt .post_image, .grt .post_image_box, .grt .wp-caption, .grt .wp-post-image, .grt .alert, .grt .note, .headline_area, .post_list, .archive_intro .headline, .prev_next {
	margin-bottom: $x_single;
}
.grt ul, .grt ol, .grt .right, .grt .alignright, .grt .stack {
	margin-left: $x_single;
}
.grt .wp-caption img, .grt .post_image_box .post_image, .grt .thumb, .grt blockquote.right, .grt blockquote.left, .post_list li {
	margin-bottom: $x_half;
}
.grt ul ul, .grt ul ol, .grt ol ul, .grt ol ol, .wp-caption p, .grt .alert p:last-child, .grt .note p:last-child, .grt blockquote.right p, .grt blockquote.left p {
	margin-bottom: 0;
}
.grt .left, .grt .alignleft {
	margin-right: $x_single;
}
.grt .caption {
	margin-top: -$x_half;
	color: $text2;
}
/*---:[ golden ratio pullquotes ]:---*/
.grt blockquote.right, .grt blockquote.left {
	$pullquote
	width: 45%;
}
.grt blockquote.right, .grt blockquote.left { 
	padding-left: 0;
	border: 0;
}
/*---:[ button styles ]:---*/
.post_edit, .previous_posts a, .next_posts a, .comment_footer a, .comment_nav a, .input_submit, #cancel-comment-reply-link {
	display: inline-block;
	line-height: 1em;
	color: $text2;
	border: 2px solid $color2;
	background-color: $color3;
	padding: 0.5em;
	-webkit-border-radius: 1em;
	-moz-border-radius: 1em;
	border-radius: 1em;
}
.post_edit:hover, .previous_posts a:hover, .next_posts a:hover, .comment_footer a:hover, .comment_nav a:hover, .input_submit:hover, #cancel-comment-reply-link:hover {
	color: $links;
	border-color: $links;
	-webkit-transition: border-color 0.4s;
	-moz-transition: border-color 0.4s;
	transition: border-color 0.4s;
}
/*---:[ post box styles ]:---*/
.post_box {
	position: relative;
	margin-bottom: $x_single;
}
.headline_area {
	color: $text2;
}
.headline, .headline a {
	color: $headline_color;
}
.headline a:hover, .post_list .headline a {
	color: $links;
	text-decoration: none;
}
.post_edit {
	position: absolute;
	top: 0.5em;
	left: -$x_double;
	font-size: $f_aux;
}
.twitter_profile:before {
	content: \\\'| \\\';
}
.full_page .post_content {
	max-width: $w_content;
}
.post_author a:hover, .post_content a, .post_cats a:hover, .post_tags a:hover, .twitter_profile a:hover, .post_list .headline a:hover {
	text-decoration: underline;
}
.post_box h2, .post_box h3 {
	color: $subhead_color;
}
.post_box h3, .post_box dt {
	font-weight: bold;
}
.post_box ul {
	list-style-type: square;
}
.post_box blockquote {
	$blockquote
	padding-left: $x_single;
	border-left: 1px solid $color1;
}
.post_box code {
	$code
}
.post_box pre {
	$pre
	background-color: $color2;
	padding: $x_half;
	-webkit-tab-size: 4;
	-moz-tab-size: 4;
	tab-size: 4;
}
.post_box .frame, .post_box .post_image_box, .post_box .wp-caption {
	border: 1px solid $color1;
	background-color: $color2;
	padding: $x_half;
}
.wp-caption.aligncenter img {
	margin-right: auto;
	margin-left: auto;
}
.wp-caption .wp-caption-text .wp-smiley {
	display: inline;
	margin-bottom: 0;
}
.post_box .wp-caption p {
	font-size: $f_aux;
	line-height: $h_aux;
}
.post_box .author_description {
	border-top: 1px dotted $color1;
	padding-top: $x_single;
}
.post_box .author_description_intro {
	font-weight: bold;
}
.post_box .avatar {
	float: right;
	clear: both;
	$avatar
	margin-left: $x_half;
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%;
	border-radius: 50%;
}
.post_box .author_description .avatar {
	float: left;
	$bio_avatar
	margin-right: $x_half;
	margin-left: 0;
}
.post_box .post_cats, .post_box .post_tags {
	color: $text2;
}
.post_box .alert, .post_box .note {
	padding: $x_half;
}
.post_box .alert {
	background-color: #ff9;
	border: 1px solid #e6e68a;
}
.post_box .note {
	background-color: $color2;
	border: 1px solid $color1;
}
.post_list {
	position: relative;
	list-style-type: none;
}
.post_list .num_comments {
	display: inline-block;
	margin-left: $x_half;
	line-height: 0.5em;
}
.post_list .post_edit {
	top: -0.35em;
	margin-top: 0.25em;
}
.landing .headline_area, .landing .signup {
	text-align: center;
}
.post_box .signup {
	border: 1px dotted $color1;
	border-width: 1px 0 0 0;
	margin: $x_single 0;
	padding: $x_single 0 0;
}
.landing .signup {
	border: 0;
	margin: 0 0 $x_single;
	padding: 0;
}
.post_box .signup p {
	font-weight: bold;
	margin-bottom: $x_half;
}
.post_box .signup .input_text {
	width: 40%;
}
.post_box .signup .input_submit {
	font-size: $f_text;
	margin-left: $x_half;
}
/*---:[ other post box styles ]:---*/
.post_box .num_comments_link {
	display: inline-block;
	color: $text2;
	text-decoration: none;
	margin-bottom: $x_single;
}
.post_box .num_comments_link:hover {
	text-decoration: underline;
}
.num_comments {
	font-size: $x_single;
	color: $text1;
}
/*---:[ feature box ]:---*/
.feature_box {
	position: relative;
	border: 2px solid $color1;
	border-width: 2px 0;
	margin: 0 -$x_single $x_3over2;
	padding: $x_single $x_single 0 $x_single;
}
.feature_box .headline {
	font-weight: bold;
	border-bottom: 1px solid $color1;
	background-color: $color2;
	margin: -$x_single -$x_single $x_single;
	padding: $x_half $x_single;
}
.feature_box .post_edit {
	top: 1.5em;
	left: -3.5em;
}
.feature_box .post_content {
	max-width: $w_content;
}
.feature_box .thesis_email_form {
	margin-bottom: $x_single;
}
.feature_box .input_text {
	width: 25%;
	padding: 0.75em;
}
.feature_box .input_submit {
	margin-left: $x_half;
	vertical-align: -11%;
}
/*---:[ misc. content elements ]:---*/
.archive_intro {
	border-bottom: 1px dotted $color1;
}
.prev_next {
	clear: both;
	color: $text2;
}
.prev_next .next_posts {
	float: right;
}
.previous_posts, .next_posts {
	display: block;
}
/*---:[ comments ]:---*/
#comments {
	margin-top: $x_double;
}
.comments_intro {
	color: $text2;
	margin-bottom: $x_half;
}
.comments_closed {
	font-size: $f_aux;
	line-height: $h_aux;
	color: $text2;
	margin-bottom: $x_single;
}
.comment_list {
	list-style-type: none;
	margin-bottom: $x_double;
	border-top: 1px dotted $color1;
}
.comment {
	border-bottom: 1px dotted $color1;
	padding: $x_single 0;
}
.children .comment {
	list-style-type: none;
	margin-top: $x_single;
	border-left: 1px solid $color1;
	border-bottom: 0;
	padding: 0 0 0 $x_single;
}
.children .bypostauthor {
	background-color: transparent;
	border-color: $links;
}
.comment .comment_head {
	margin-bottom: $x_half;
}
.children .comment_head {
	margin-bottom: 0;
}
.comment .comment_author {
	font-weight: bold;
}
.comment_date {
	font-size: $f_aux;
	margin-left: $x_half;
	color: $text2;
}
.comment_date a {
	color: $text2;
}
.comment_footer {
	font-size: $f_aux;
	line-height: $h_aux;
	text-align: right;
}
.comment_head a:hover {
	text-decoration: underline;
}
.comment_footer a {
	margin-left: $x_half;
}
.comment .avatar {
	$comment_avatar
	float: right;
	margin-left: $x_half;
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%;
	border-radius: 50%;
}
.comment_nav {
	padding: $x_half 0 $x_single;
}
.comment_nav_bottom {
	margin: -$x_3over2 0 $x_double;
}
.next_comments {
	float: right;
}
/*---:[ inputs ]:---*/
.input_text {
	font-size: inherit;
	line-height: 1em;
	font-family: inherit;
	font-weight: inherit;
	color: $text1;
	border: 1px solid $color1;
	background-color: $color2;
	padding: 0.35em;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
.input_text:focus {
	border-color: $color2;
	background-color: $color3;
}
textarea.input_text {
	line-height: $h_text;
}
.input_submit {
	font-size: $f_subhead;
	font-family: inherit;
	font-weight: bold;
	cursor: pointer;
	overflow: visible;
}
/*---:[ comment form ]:---*/
#commentform {
	margin: $x_double 0;
}
.comment #commentform {
	margin-top: 0;
}
.comment_form_title {
	$subhead
	color: $subhead_color;
	border-bottom: 1px dotted $color1;
	padding-bottom: $x_half;
}
#commentform label {
	display: block;
}
#commentform p {
	margin-bottom: $x_half;
}
#commentform p .required {
	color: #d00;
}
.comment_moderated {
	font-weight: bold;
}
#commentform .input_text {
	width: 50%;
}
#commentform textarea.input_text {
	width: 100%;
}
#cancel-comment-reply-link {
	float: right;
	font-size: $f_aux;
}
.login_alert {
	font-weight: bold;
	border: 1px solid $color1;
	background-color: $color2;
}
/*---:[ sidebar ]:---*/
.sidebar {
	$sidebar
}
.sidebar .headline, .sidebar .email_form_title, .sidebar .widget_title {
	$sidebar_heading
}
.sidebar .email_form_title, .sidebar .widget_title {
	margin-bottom: $s_x_half;
}
.sidebar .input_submit {
	font-size: inherit;
	margin-bottom: $s_x_single;
}
.sidebar p, .sidebar ul, .sidebar ol, .sidebar blockquote, .sidebar pre, .sidebar dl, .sidebar dd, .sidebar .headline, .sidebar .left, .sidebar .alignleft, .sidebar .right, .sidebar .alignright, .sidebar .center, .sidebar .aligncenter, .sidebar .block, .sidebar .alignnone {
	margin-bottom: $s_x_single;
}
.sidebar .left, .sidebar .alignleft {
	margin-right: $s_x_single;
}
.sidebar ul ul, .sidebar ul ol, .sidebar ol ul, .sidebar ol ol, .sidebar .right, .sidebar .alignright, .sidebar .stack {
	margin-left: $s_x_single;
}
.sidebar .widget, .sidebar .text_box, .sidebar .thesis_email_form, .sidebar .query_box {
	margin-bottom: $s_x_double;
}
.sidebar .thesis_email_form .input_text, .sidebar .widget li {
	margin-bottom: $s_x_half;
}
.sidebar .post_content, .sidebar .widget li ul, .sidebar .widget li ol {
	margin-top: $s_x_half;
}
.sidebar ul ul, .sidebar ul ol, .sidebar ol ul, .sidebar ol ol, .wp-caption p, .sidebar .post_excerpt p {
	margin-bottom: 0;
}
.sidebar .search-form .input_text, .sidebar .thesis_email_form .input_text {
	width: 100%;
}
.sidebar .query_box .post_author, .sidebar .query_box .post_date {
	color: $text2;
}
.widget ul {
	list-style-type: none;
}
.widget li a:hover {
	text-decoration: underline;
}
.sidebar .widget, .sidebar .text_box, .sidebar .thesis_email_form, .sidebar .query_box {
	border-bottom: 1px dotted $color1;
}
.sidebar .widget:last-child, .sidebar .text_box:last-child, .sidebar .thesis_email_form:last-child, .sidebar .query_box:last-child {
	border-bottom: 0;
}
/*---:[ footer ]:---*/
#footer {
	border-top: 1px solid $color1;
}
.footer {
	font-size: $f_aux;
	line-height: $h_aux;
	color: $text2;
	text-align: center;
	padding: $x_half 0;
}
.footer a {
	color: $text2;
}
.footer a:hover {
	color: $text1;
}
/*---:[ media queries ]:---*/
@media all and (max-width: $w_total) {
	.container, .landing .container {
		width: auto;
		max-width: $w_content;
	}
	.columns > .content {
		float: none;
		width: auto;
	}
	.columns > .sidebar {
		float: none;
		width: auto;
		border-top: 1px solid $color1;
		padding: $x_single 0 0 0;
	}
	.columns > .sidebar > * {
		max-width: $w_sidebar;
	}
	.full_width {
		min-width: $w_content;
	}
	.menu_control {
		display: block;
		cursor: pointer;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
	}
	.menu_control, .menu {
		margin: 0 -$x_single;
	}
	.menu_control, .menu a {
		padding: 0.8em $x_single;
	}
	.menu {
		display: none;
		float: none;
	}
	.show_menu {
		display: block;
	}
	.menu .sub-menu {
		position: static;
		display: block;
		padding-left: $x_single;
	}
	.menu li {
		float: none;
	}
	.menu .sub-menu li {
		width: auto;
	}
	.feature_box .alignright, .feature_box .alignleft {
		float: none;
		margin-right: 0;
		margin-left: 0;
	}
	.feature_box .input_text {
		width: 50%;
	}
}
@media all and (max-width: $w_content) {
	.full_width {
		min-width: 0;
	}
	#site_title, .feature_box, .columns > .sidebar, .post_box, .post_list, .prev_next, #comments, .footer {
		padding-right: $x_single;
		padding-left: $x_single;
	}
	.menu_control, .menu, .feature_box {
		margin-right: 0;
		margin-left: 0;
	}
	.frame, .post_image_box, .wp-caption {
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
	}
}
@media all and (max-width: 450px) {
	.menu_control, .menu a, #site_title, .feature_box, .feature_box .headline, .columns > .sidebar, .post_box, .post_list, .prev_next, #comments, .footer {
		padding-right: $x_half;
		padding-left: $x_half;
	}
	#site_title {
		padding-top: $x_single;
		padding-bottom: $x_single;
	}
	.feature_box .input_text {
		width: 100%;
	}
	.feature_box .input_submit {
		display: block;
		margin: $x_half 0 0 0;
	}
	.menu .sub-menu, .post_box blockquote, .children .comment {
		padding-left: $x_half;
	}
	.comments_closed, .login_alert {
		margin-right: $x_half;
		margin-left: $x_half;
	}
	.feature_box .headline {
		margin-right: -$x_half;
		margin-left: -$x_half;
	}
	.right, .alignright, img[align=\\"right\\"], .left, .alignleft, img[align=\\"left\\"] {
		float: none;
	}
	.grt .right, .grt .left, .grt .alignright, .grt .alignleft, .grt blockquote.right, .grt blockquote.left {
		margin-right: 0;
		margin-left: 0;
	}
	.post_author:after {
		content: \\\'\\\\a\\\';
		height: 0;
		white-space: pre;
		display: block;
	}
	.twitter_profile:before {
		content: \\\'\\\';
	}
	.grt blockquote.right, .grt blockquote.left, #commentform .input_text, .sidebar .search-form .input_text, .post_box .signup .input_text, .sidebar .thesis_email_form .input_text {
		width: 100%;
	}
	.post_box .signup .input_text {
		margin-bottom: $x_half;
	}
	.post_box .signup .input_submit {
		margin-left: 0;
	}
	.comment_date {
		display: none;
	}
}
/*---:[ clearfix ]:---*/
.columns:after, .menu:after, .post_box:after, .content .post_content:after, .author_description:after, .sidebar:after, .query_box:after, .prev_next:after, .comment_text:after, .comment_nav:after {
	$z_clearfix
}',
  'boxes' => 
  array (
    'thesis_html_container' => 
    array (
      'thesis_html_container_1348009571' => 
      array (
        'class' => 'columns',
        '_admin' => 
        array (
          'open' => true,
        ),
        '_id' => 'columns',
        '_name' => 'Columns',
      ),
      'thesis_html_container_1348009575' => 
      array (
        'class' => 'footer container',
        '_id' => 'footer',
        '_name' => 'Footer',
      ),
      'thesis_html_container_1348010954' => 
      array (
        'class' => 'content',
        '_admin' => 
        array (
          'open' => true,
        ),
        '_id' => 'content',
        '_name' => 'Content Column',
      ),
      'thesis_html_container_1348010964' => 
      array (
        'class' => 'sidebar',
        '_id' => 'sidebar',
        '_name' => 'Sidebar',
      ),
      'thesis_html_container_1348093642' => 
      array (
        'class' => 'container',
        '_admin' => 
        array (
          'open' => true,
        ),
        '_id' => 'container',
        '_name' => 'Container',
      ),
      'thesis_html_container_1348165494' => 
      array (
        'class' => 'byline small',
        '_name' => 'Byline',
      ),
      'thesis_html_container_1348608649' => 
      array (
        'class' => 'archive_intro post_box grt top',
        '_name' => 'Archive Intro',
      ),
      'thesis_html_container_1348701154' => 
      array (
        'class' => 'prev_next',
        '_id' => 'prev_next',
        '_name' => 'Prev/Next',
      ),
      'thesis_html_container_1348841704' => 
      array (
        'class' => 'comment_head',
        '_name' => 'Comment Head',
      ),
      'thesis_html_container_1348886177' => 
      array (
        'class' => 'headline_area small',
        '_name' => 'Headline Area',
      ),
      'thesis_html_container_1365640887' => 
      array (
        'id' => 'comments',
        '_id' => 'post_comments',
        '_name' => 'Post Comments',
      ),
      'thesis_html_container_1365640949' => 
      array (
        'id' => 'comments',
        '_id' => 'page_comments',
        '_name' => 'Page Comments',
      ),
      'thesis_html_container_1366209424' => 
      array (
        'class' => 'comment_footer',
        '_name' => 'Comment Footer',
      ),
      'thesis_html_container_1371744962' => 
      array (
        'id' => 'footer',
        'class' => 'full_width',
        '_name' => 'Full Width',
      ),
    ),
    'thesis_wp_nav_menu' => 
    array (
      'thesis_wp_nav_menu_1348009742' => 
      array (
        'control' => 
        array (
          'yes' => true,
        ),
        '_name' => 'Nav Menu',
      ),
    ),
    'thesis_post_box' => 
    array (
      'thesis_post_box_1348010947' => 
      array (
        'class' => 'grt',
        'schema' => 'article',
        '_admin' => 
        array (
          'open' => true,
        ),
        '_name' => 'Home Post Box',
      ),
      'thesis_post_box_1348607689' => 
      array (
        'class' => 'grt',
        'schema' => 'article',
        '_admin' => 
        array (
          'open' => true,
        ),
        '_name' => 'Post/Page Post Box',
      ),
    ),
    'thesis_post_headline' => 
    array (
      'thesis_post_box_1348010947_thesis_post_headline' => 
      array (
        'html' => 'h2',
        'link' => 
        array (
          'on' => true,
        ),
        '_parent' => 'thesis_post_box_1348010947',
      ),
      'thesis_query_box_1371571252_thesis_post_headline' => 
      array (
        'html' => 'h2',
        '_parent' => 'thesis_query_box_1371571252',
      ),
      'thesis_post_list_1371755385_thesis_post_headline' => 
      array (
        'html' => 'span',
        'link' => 
        array (
          'on' => true,
        ),
        '_parent' => 'thesis_post_list_1371755385',
      ),
    ),
    'thesis_wp_widgets' => 
    array (
      'thesis_wp_widgets_1348079687' => 
      array (
        '_id' => 'sidebar',
        '_name' => 'Sidebar Widgets',
      ),
    ),
    'thesis_post_author' => 
    array (
      'thesis_post_box_1348010947_thesis_post_author' => 
      array (
        'intro' => 'by',
        '_id' => 'loop',
        '_parent' => 'thesis_post_box_1348010947',
      ),
      'thesis_post_box_1348607689_thesis_post_author' => 
      array (
        'intro' => 'by',
        '_id' => 'loop',
        '_parent' => 'thesis_post_box_1348607689',
      ),
    ),
    'thesis_post_date' => 
    array (
      'thesis_post_box_1348010947_thesis_post_date' => 
      array (
        'intro' => 'on',
        'schema' => 
        array (
          'only' => true,
        ),
        '_id' => 'loop',
        '_parent' => 'thesis_post_box_1348010947',
      ),
      'thesis_post_box_1348607689_thesis_post_date' => 
      array (
        'intro' => 'on',
        'schema' => 
        array (
          'only' => true,
        ),
        '_id' => 'loop',
        '_parent' => 'thesis_post_box_1348607689',
      ),
      'thesis_post_list_1371755385_thesis_post_date' => 
      array (
        'schema' => 
        array (
          'only' => true,
        ),
        '_parent' => 'thesis_post_list_1371755385',
      ),
    ),
    'thesis_comments' => 
    array (
      'thesis_comments_1348716667' => 
      array (
        '_name' => 'Comments',
      ),
    ),
    'thesis_comment_form' => 
    array (
      'thesis_comment_form_1348843091' => 
      array (
        '_name' => 'Comment Form',
      ),
    ),
    'thesis_post_categories' => 
    array (
      'thesis_post_box_1348010947_thesis_post_categories' => 
      array (
        'html' => 'div',
        'intro' => 'in',
        'separator' => ',',
        '_id' => 'loop',
        '_parent' => 'thesis_post_box_1348010947',
      ),
      'thesis_post_box_1348607689_thesis_post_categories' => 
      array (
        'html' => 'div',
        'intro' => 'in',
        'separator' => ',',
        '_id' => 'loop',
        '_parent' => 'thesis_post_box_1348607689',
      ),
    ),
    'thesis_post_tags' => 
    array (
      'thesis_post_box_1348010947_thesis_post_tags' => 
      array (
        'html' => 'div',
        'intro' => 'tags:',
        'separator' => ',',
        '_id' => 'loop',
        '_parent' => 'thesis_post_box_1348010947',
      ),
      'thesis_post_box_1348607689_thesis_post_tags' => 
      array (
        'html' => 'div',
        'intro' => 'tags:',
        'separator' => ',',
        '_id' => 'loop',
        '_parent' => 'thesis_post_box_1348607689',
      ),
    ),
    'thesis_previous_post_link' => 
    array (
      'thesis_previous_post_link' => 
      array (
        'html' => 'p',
        'intro' => 'Previous post:',
      ),
    ),
    'thesis_next_post_link' => 
    array (
      'thesis_next_post_link' => 
      array (
        'html' => 'p',
        'intro' => 'Next post:',
      ),
    ),
    'thesis_text_box' => 
    array (
      'thesis_text_box_1350230891' => 
      array (
        '_id' => 'sidebar',
        '_name' => 'Sidebar Text Box',
      ),
    ),
    'thesis_comment_text' => 
    array (
      'thesis_comments_1348716667_thesis_comment_text' => 
      array (
        'class' => 'grt',
        '_parent' => 'thesis_comments_1348716667',
      ),
    ),
    'thesis_comments_nav' => 
    array (
      'thesis_comments_nav_1366218263' => 
      array (
        'class' => 'comment_nav_top',
        '_name' => 'Comment Nav Top',
      ),
      'thesis_comments_nav_1366218280' => 
      array (
        'class' => 'comment_nav_bottom',
        '_name' => 'Comment Nav Bottom',
      ),
    ),
    'thesis_wp_featured_image' => 
    array (
      'thesis_post_box_1348607689_thesis_wp_featured_image' => 
      array (
        'link' => 
        array (
          'link' => false,
        ),
        '_id' => 'loop',
        '_parent' => 'thesis_post_box_1348607689',
      ),
      'thesis_post_box_1348010947_thesis_wp_featured_image' => 
      array (
        '_id' => 'loop',
        '_parent' => 'thesis_post_box_1348010947',
      ),
      'thesis_query_box_1371571252_thesis_wp_featured_image' => 
      array (
        'alignment' => 'right',
        'link' => 
        array (
          'link' => false,
        ),
        '_parent' => 'thesis_query_box_1371571252',
      ),
    ),
    'thesis_post_thumbnail' => 
    array (
      'thesis_post_box_1348010947_thesis_post_thumbnail' => 
      array (
        'alignment' => 'left',
        '_id' => 'loop',
        '_parent' => 'thesis_post_box_1348010947',
      ),
      'thesis_post_box_1348607689_thesis_post_thumbnail' => 
      array (
        '_id' => 'loop',
        '_parent' => 'thesis_post_box_1348607689',
      ),
    ),
    'thesis_post_image' => 
    array (
      'thesis_post_box_1348607689_thesis_post_image' => 
      array (
        'link' => 
        array (
          'link' => false,
        ),
        '_id' => 'loop',
        '_parent' => 'thesis_post_box_1348607689',
      ),
      'thesis_post_box_1348010947_thesis_post_image' => 
      array (
        '_id' => 'loop',
        '_parent' => 'thesis_post_box_1348010947',
      ),
    ),
    'thesis_post_author_avatar' => 
    array (
      'thesis_post_box_1348010947_thesis_post_author_avatar' => 
      array (
        '_id' => 'loop',
        '_parent' => 'thesis_post_box_1348010947',
      ),
      'thesis_post_box_1348607689_thesis_post_author_avatar' => 
      array (
        '_id' => 'loop',
        '_parent' => 'thesis_post_box_1348607689',
      ),
    ),
    'thesis_post_author_description' => 
    array (
      'thesis_post_box_1348010947_thesis_post_author_description' => 
      array (
        '_id' => 'loop',
        '_parent' => 'thesis_post_box_1348010947',
      ),
      'thesis_post_box_1348607689_thesis_post_author_description' => 
      array (
        '_id' => 'loop',
        '_parent' => 'thesis_post_box_1348607689',
      ),
    ),
    'thesis_post_num_comments' => 
    array (
      'thesis_post_box_1348010947_thesis_post_num_comments' => 
      array (
        '_id' => 'loop',
        '_parent' => 'thesis_post_box_1348010947',
      ),
      'thesis_post_box_1348607689_thesis_post_num_comments' => 
      array (
        '_id' => 'loop',
        '_parent' => 'thesis_post_box_1348607689',
      ),
      'thesis_post_list_1371755385_thesis_post_num_comments' => 
      array (
        'display' => 
        array (
          'term' => false,
        ),
        '_id' => 'loop',
        '_parent' => 'thesis_post_list_1371755385',
      ),
    ),
    'thesis_comment_avatar' => 
    array (
      'thesis_comments_1348716667_thesis_comment_avatar' => 
      array (
        '_id' => 'comments',
        '_parent' => 'thesis_comments_1348716667',
      ),
    ),
    'thesis_comment_date' => 
    array (
      'thesis_comments_1348716667_thesis_comment_date' => 
      array (
        '_id' => 'comments',
        '_parent' => 'thesis_comments_1348716667',
      ),
    ),
    'thesis_query_box' => 
    array (
      'thesis_query_box_1371571252' => 
      array (
        'post_type' => 'page',
        'page' => '1321',
        'class' => 'feature_box grt',
        '_id' => 'feature_box',
        '_name' => 'Feature Box',
      ),
    ),
    'thesis_post_list' => 
    array (
      'thesis_post_list_1371755385' => 
      array (
        'schema' => 'article',
        '_name' => 'Archive Post List',
      ),
    ),
    'thesis_twitter_profile' => 
    array (
      'thesis_post_box_1348010947_thesis_twitter_profile' => 
      array (
        'display' => 'text',
        '_id' => 'loop',
        '_parent' => 'thesis_post_box_1348010947',
      ),
      'thesis_post_box_1348607689_thesis_twitter_profile' => 
      array (
        'display' => 'text',
        '_id' => 'loop',
        '_parent' => 'thesis_post_box_1348607689',
      ),
    ),
    'thesis_comment_form_cancel' => 
    array (
      'thesis_comment_form_1348843091_thesis_comment_form_cancel' => 
      array (
        'text' => 'Cancel',
        '_parent' => 'thesis_comment_form_1348843091',
      ),
    ),
    'thesis_mailchimp_form' => 
    array (
      'thesis_mailchimp_form_1376691300' => 
      array (
        '_id' => 'email_feature_box',
        '_name' => 'Feature Box Email Signup',
      ),
      'thesis_mailchimp_form_1376691695' => 
      array (
        'title' => 'Get Updates (Free)',
        'intro' => 'This is the Sidebar Email Signup. Put some persuasive text here to encourage people to sign up to your email list.',
        '_id' => 'email_sidebar',
        '_name' => 'Sidebar Email Signup',
      ),
      'thesis_mailchimp_form_1376691939' => 
      array (
        'intro' => 'If you enjoyed this article, sign up for free updates:',
        'class' => 'signup',
        '_id' => 'email_single',
        '_name' => 'Single Post Email Signup',
      ),
      'thesis_mailchimp_form_1376692054' => 
      array (
        'class' => 'signup',
        '_id' => 'email_signup',
        '_name' => 'Signup Template Email Signup',
      ),
    ),
    'thesis_mailchimp_email' => 
    array (
      'thesis_mailchimp_form_1376691300_thesis_mailchimp_email' => 
      array (
        'placeholder' => 'Enter your email here',
        '_parent' => 'thesis_mailchimp_form_1376691300',
      ),
      'thesis_mailchimp_form_1376691695_thesis_mailchimp_email' => 
      array (
        'placeholder' => 'Enter your email here',
        '_parent' => 'thesis_mailchimp_form_1376691695',
      ),
      'thesis_mailchimp_form_1376691939_thesis_mailchimp_email' => 
      array (
        'placeholder' => 'Enter your email here',
        '_parent' => 'thesis_mailchimp_form_1376691939',
      ),
      'thesis_mailchimp_form_1376692054_thesis_mailchimp_email' => 
      array (
        'placeholder' => 'Enter your email here',
        '_parent' => 'thesis_mailchimp_form_1376692054',
      ),
    ),
  ),
  'vars' => 
  array (
    'var_1349039554' => 
    array (
      'name' => 'Spacing: Single',
      'ref' => 'x_single',
      'css' => '26px',
    ),
    'var_1349039577' => 
    array (
      'name' => 'Spacing: Half',
      'ref' => 'x_half',
      'css' => '13px',
    ),
    'var_1349039585' => 
    array (
      'name' => 'Spacing: Double',
      'ref' => 'x_double',
      'css' => '52px',
    ),
    'var_1349039761' => 
    array (
      'name' => 'Links',
      'ref' => 'links',
      'css' => '#8800C4',
    ),
    'var_1351010515' => 
    array (
      'name' => 'Clearfix',
      'ref' => 'z_clearfix',
      'css' => 'content: \\".\\"; display: block; height: 0; clear: both; visibility: hidden;',
    ),
    'var_1360768628' => 
    array (
      'name' => 'Primary Text Color',
      'ref' => 'text1',
      'css' => '#111111',
    ),
    'var_1360768650' => 
    array (
      'name' => 'Secondary Text Color',
      'ref' => 'text2',
      'css' => '#888888',
    ),
    'var_1360768659' => 
    array (
      'name' => 'Color 1',
      'ref' => 'color1',
      'css' => '#DDDDDD',
    ),
    'var_1360768669' => 
    array (
      'name' => 'Color 2',
      'ref' => 'color2',
      'css' => '#EEEEEE',
    ),
    'var_1360768678' => 
    array (
      'name' => 'Color 3',
      'ref' => 'color3',
      'css' => '#FFFFFF',
    ),
    'var_1362537256' => 
    array (
      'name' => 'Font Size: Sub-headline',
      'ref' => 'f_subhead',
      'css' => '20px',
    ),
    'var_1362537274' => 
    array (
      'name' => 'Font Size: Text',
      'ref' => 'f_text',
      'css' => '16px',
    ),
    'var_1362537289' => 
    array (
      'name' => 'Font Size: Auxiliary',
      'ref' => 'f_aux',
      'css' => '13px',
    ),
    'var_1362580685' => 
    array (
      'name' => 'Line Height: Text',
      'ref' => 'h_text',
      'css' => '26px',
    ),
    'var_1362580697' => 
    array (
      'name' => 'Line Height: Auxiliary Text',
      'ref' => 'h_aux',
      'css' => '22px',
    ),
    'var_1362588614' => 
    array (
      'name' => 'Spacing: 1.5',
      'ref' => 'x_3over2',
      'css' => '39px',
    ),
    'var_1362696253' => 
    array (
      'name' => 'Width: Content',
      'ref' => 'w_content',
      'css' => '585px',
    ),
    'var_1362696268' => 
    array (
      'name' => 'Width: Sidebar',
      'ref' => 'w_sidebar',
      'css' => '312px',
    ),
    'var_1362697011' => 
    array (
      'name' => 'Width: Total',
      'ref' => 'w_total',
      'css' => '897px',
    ),
    'var_1362757553' => 
    array (
      'name' => 'Font: Primary',
      'ref' => 'font',
      'css' => 'Georgia, "Times New Roman", Times, serif',
    ),
    'var_1362767543' => 
    array (
      'name' => 'Sidebar Spacing: Half',
      'ref' => 's_x_half',
      'css' => '10px',
    ),
    'var_1362767589' => 
    array (
      'name' => 'Sidebar Spacing: Single',
      'ref' => 's_x_single',
      'css' => '19px',
    ),
    'var_1362767601' => 
    array (
      'name' => 'Sidebar Spacing: 1.5',
      'ref' => 's_x_3over2',
      'css' => '29px',
    ),
    'var_1362768690' => 
    array (
      'name' => 'Sidebar Spacing: Double',
      'ref' => 's_x_double',
      'css' => '38px',
    ),
    'var_1363019458' => 
    array (
      'name' => 'Site Title Color',
      'ref' => 'title_color',
      'css' => '#111111',
    ),
    'var_1363458877' => 
    array (
      'name' => 'Site Title',
      'ref' => 'title',
      'css' => 'font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size: 42px;',
    ),
    'var_1363459110' => 
    array (
      'name' => 'Tagline',
      'ref' => 'tagline',
      'css' => 'font-size: 16px;
	color: #888;',
    ),
    'var_1363467168' => 
    array (
      'name' => 'Nav Menu',
      'ref' => 'menu',
      'css' => 'font-size: 13px;
	line-height: 18px;',
    ),
    'var_1363467273' => 
    array (
      'name' => 'Sub-headline',
      'ref' => 'subhead',
      'css' => 'font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size: 20px;
	line-height: 32px;',
    ),
    'var_1363467831' => 
    array (
      'name' => 'Headline',
      'ref' => 'headline',
      'css' => 'font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size: 26px;
	line-height: 39px;',
    ),
    'var_1363537291' => 
    array (
      'name' => 'Sidebar',
      'ref' => 'sidebar',
      'css' => 'font-size: 13px;
	line-height: 19px;',
    ),
    'var_1363621601' => 
    array (
      'name' => 'Blockquote',
      'ref' => 'blockquote',
      'css' => 'color: #888888;',
    ),
    'var_1363621659' => 
    array (
      'name' => 'Code',
      'ref' => 'code',
      'css' => 'font-family: Consolas, Monaco, Menlo, Courier, Verdana, sans-serif;',
    ),
    'var_1363621686' => 
    array (
      'name' => 'Pre-formatted Code',
      'ref' => 'pre',
      'css' => 'font-family: Consolas, Monaco, Menlo, Courier, Verdana, sans-serif;',
    ),
    'var_1363621701' => 
    array (
      'name' => 'Sidebar Heading',
      'ref' => 'sidebar_heading',
      'css' => 'font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size: 17px;
	line-height: 25px;',
    ),
    'var_1363633021' => 
    array (
      'name' => 'Headline Color',
      'ref' => 'headline_color',
      'css' => '#111111',
    ),
    'var_1363633037' => 
    array (
      'name' => 'Sub-headline Color',
      'ref' => 'subhead_color',
      'css' => '#111111',
    ),
    'var_1363989059' => 
    array (
      'name' => 'Author Avatar',
      'ref' => 'avatar',
      'css' => 'width: 61px;
	height: 61px;',
    ),
    'var_1364573035' => 
    array (
      'name' => 'Comment Avatar',
      'ref' => 'comment_avatar',
      'css' => 'width: 52px;
	height: 52px;',
    ),
    'var_1364921879' => 
    array (
      'name' => 'Author Description Avatar',
      'ref' => 'bio_avatar',
      'css' => 'width: 78px;
	height: 78px;',
    ),
    'var_1364931901' => 
    array (
      'name' => 'Pullquote',
      'ref' => 'pullquote',
      'css' => 'font-size: 26px;
	line-height: 36px;',
    ),
    'var_1366555361' => 
    array (
      'name' => 'Navigation Submenu',
      'ref' => 'submenu',
      'css' => '11em',
    ),
    'var_1367605257' => 
    array (
      'name' => 'Content Column',
      'ref' => 'column1',
      'css' => 'float: left;',
    ),
    'var_1367605279' => 
    array (
      'name' => 'Sidebar Column',
      'ref' => 'column2',
      'css' => 'float: right;
	width: $w_sidebar;
	padding-left: $x_double;',
    ),
    'var_1371565848' => 
    array (
      'name' => 'Color 4',
      'ref' => 'color4',
      'css' => '#222222',
    ),
  ),
  'templates' => 
  array (
    'home' => 
    array (
      'boxes' => 
      array (
        'thesis_html_body' => 
        array (
          0 => 'thesis_html_container_1348093642',
          1 => 'thesis_html_container_1371744962',
        ),
        'thesis_html_container_1348093642' => 
        array (
          0 => 'thesis_wp_nav_menu_1348009742',
          1 => 'thesis_site_title',
          2 => 'thesis_query_box_1371571252',
          3 => 'thesis_html_container_1348009571',
        ),
        'thesis_query_box_1371571252' => 
        array (
          0 => 'thesis_query_box_1371571252_thesis_post_edit',
          1 => 'thesis_query_box_1371571252_thesis_post_headline',
          2 => 'thesis_query_box_1371571252_thesis_wp_featured_image',
          3 => 'thesis_query_box_1371571252_thesis_post_content',
          4 => 'thesis_mailchimp_form_1376691300',
        ),
        'thesis_mailchimp_form_1376691300' => 
        array (
          0 => 'thesis_mailchimp_form_1376691300_thesis_mailchimp_email',
          1 => 'thesis_mailchimp_form_1376691300_thesis_mailchimp_submit',
        ),
        'thesis_html_container_1348009571' => 
        array (
          0 => 'thesis_html_container_1348010954',
          1 => 'thesis_html_container_1348010964',
        ),
        'thesis_html_container_1348010954' => 
        array (
          0 => 'thesis_wp_loop',
          1 => 'thesis_html_container_1348701154',
        ),
        'thesis_wp_loop' => 
        array (
          0 => 'thesis_post_box_1348010947',
        ),
        'thesis_post_box_1348010947' => 
        array (
          0 => 'thesis_html_container_1348886177',
          1 => 'thesis_post_box_1348010947_thesis_wp_featured_image',
          2 => 'thesis_post_box_1348010947_thesis_post_thumbnail',
          3 => 'thesis_post_box_1348010947_thesis_post_content',
          4 => 'thesis_post_box_1348010947_thesis_post_num_comments',
        ),
        'thesis_html_container_1348886177' => 
        array (
          0 => 'thesis_post_box_1348010947_thesis_post_author_avatar',
          1 => 'thesis_post_box_1348010947_thesis_post_headline',
          2 => 'thesis_post_box_1348010947_thesis_post_author',
          3 => 'thesis_post_box_1348010947_thesis_twitter_profile',
          4 => 'thesis_post_box_1348010947_thesis_post_date',
          5 => 'thesis_post_box_1348010947_thesis_post_categories',
          6 => 'thesis_post_box_1348010947_thesis_post_tags',
          7 => 'thesis_post_box_1348010947_thesis_post_edit',
        ),
        'thesis_html_container_1348701154' => 
        array (
          0 => 'thesis_next_posts_link',
          1 => 'thesis_previous_posts_link',
        ),
        'thesis_html_container_1348010964' => 
        array (
          0 => 'thesis_mailchimp_form_1376691695',
          1 => 'thesis_text_box_1350230891',
          2 => 'thesis_wp_widgets_1348079687',
        ),
        'thesis_mailchimp_form_1376691695' => 
        array (
          0 => 'thesis_mailchimp_form_1376691695_thesis_mailchimp_email',
          1 => 'thesis_mailchimp_form_1376691695_thesis_mailchimp_submit',
        ),
        'thesis_html_container_1371744962' => 
        array (
          0 => 'thesis_html_container_1348009575',
        ),
        'thesis_html_container_1348009575' => 
        array (
          0 => 'thesis_attribution',
          1 => 'thesis_wp_admin',
        ),
      ),
    ),
    'archive' => 
    array (
      'boxes' => 
      array (
        'thesis_html_body' => 
        array (
          0 => 'thesis_html_container_1348093642',
          1 => 'thesis_html_container_1371744962',
        ),
        'thesis_html_container_1348093642' => 
        array (
          0 => 'thesis_wp_nav_menu_1348009742',
          1 => 'thesis_site_title',
          2 => 'thesis_html_container_1348009571',
        ),
        'thesis_html_container_1348009571' => 
        array (
          0 => 'thesis_html_container_1348010954',
          1 => 'thesis_html_container_1348010964',
        ),
        'thesis_html_container_1348010954' => 
        array (
          0 => 'thesis_html_container_1348608649',
          1 => 'thesis_wp_loop',
          2 => 'thesis_html_container_1348701154',
        ),
        'thesis_html_container_1348608649' => 
        array (
          0 => 'thesis_archive_title',
          1 => 'thesis_archive_content',
        ),
        'thesis_wp_loop' => 
        array (
          0 => 'thesis_post_list_1371755385',
        ),
        'thesis_post_list_1371755385' => 
        array (
          0 => 'thesis_post_list_1371755385_thesis_post_edit',
          1 => 'thesis_post_list_1371755385_thesis_post_headline',
          2 => 'thesis_post_list_1371755385_thesis_post_date',
          3 => 'thesis_post_list_1371755385_thesis_post_num_comments',
        ),
        'thesis_html_container_1348701154' => 
        array (
          0 => 'thesis_next_posts_link',
          1 => 'thesis_previous_posts_link',
        ),
        'thesis_html_container_1348010964' => 
        array (
          1 => 'thesis_text_box_1350230891',
          2 => 'thesis_wp_widgets_1348079687',
        ),
        'thesis_html_container_1371744962' => 
        array (
          0 => 'thesis_html_container_1348009575',
        ),
        'thesis_html_container_1348009575' => 
        array (
          0 => 'thesis_attribution',
          1 => 'thesis_wp_admin',
        ),
      ),
    ),
    'custom_1348591137' => 
    array (
      'title' => 'Landing Page',
      'options' => 
      array (
        'thesis_html_body' => 
        array (
          'class' => 'landing',
        ),
      ),
      'boxes' => 
      array (
        'thesis_html_body' => 
        array (
          0 => 'thesis_html_container_1348093642',
          1 => 'thesis_html_container_1371744962',
        ),
        'thesis_html_container_1348093642' => 
        array (
          0 => 'thesis_site_title',
          1 => 'thesis_html_container_1348010954',
        ),
        'thesis_html_container_1348010954' => 
        array (
          0 => 'thesis_wp_loop',
        ),
        'thesis_wp_loop' => 
        array (
          0 => 'thesis_post_box_1348607689',
        ),
        'thesis_post_box_1348607689' => 
        array (
          0 => 'thesis_html_container_1348886177',
          1 => 'thesis_post_box_1348607689_thesis_wp_featured_image',
          2 => 'thesis_post_box_1348607689_thesis_post_image',
          3 => 'thesis_post_box_1348607689_thesis_post_content',
        ),
        'thesis_html_container_1348886177' => 
        array (
          0 => 'thesis_post_box_1348607689_thesis_post_headline',
          1 => 'thesis_post_box_1348607689_thesis_post_edit',
          2 => 'thesis_post_box_1348607689_thesis_post_date',
        ),
        'thesis_html_container_1371744962' => 
        array (
          0 => 'thesis_html_container_1348009575',
        ),
        'thesis_html_container_1348009575' => 
        array (
          0 => 'thesis_attribution',
          1 => 'thesis_wp_admin',
        ),
      ),
    ),
    'single' => 
    array (
      'boxes' => 
      array (
        'thesis_html_body' => 
        array (
          0 => 'thesis_html_container_1348093642',
          1 => 'thesis_html_container_1371744962',
        ),
        'thesis_html_container_1348093642' => 
        array (
          0 => 'thesis_wp_nav_menu_1348009742',
          1 => 'thesis_site_title',
          2 => 'thesis_html_container_1348009571',
        ),
        'thesis_html_container_1348009571' => 
        array (
          0 => 'thesis_html_container_1348010954',
          1 => 'thesis_html_container_1348010964',
        ),
        'thesis_html_container_1348010954' => 
        array (
          0 => 'thesis_wp_loop',
          1 => 'thesis_html_container_1348701154',
        ),
        'thesis_wp_loop' => 
        array (
          0 => 'thesis_post_box_1348607689',
          1 => 'thesis_html_container_1365640887',
        ),
        'thesis_post_box_1348607689' => 
        array (
          0 => 'thesis_html_container_1348886177',
          1 => 'thesis_post_box_1348607689_thesis_wp_featured_image',
          2 => 'thesis_post_box_1348607689_thesis_post_image',
          3 => 'thesis_post_box_1348607689_thesis_post_content',
          4 => 'thesis_mailchimp_form_1376691939',
          5 => 'thesis_post_box_1348607689_thesis_post_author_description',
        ),
        'thesis_html_container_1348886177' => 
        array (
          0 => 'thesis_post_box_1348607689_thesis_post_author_avatar',
          1 => 'thesis_post_box_1348607689_thesis_post_headline',
          2 => 'thesis_post_box_1348607689_thesis_post_author',
          3 => 'thesis_post_box_1348607689_thesis_twitter_profile',
          4 => 'thesis_post_box_1348607689_thesis_post_date',
          5 => 'thesis_post_box_1348607689_thesis_post_categories',
          6 => 'thesis_post_box_1348607689_thesis_post_tags',
          7 => 'thesis_post_box_1348607689_thesis_post_edit',
        ),
        'thesis_mailchimp_form_1376691939' => 
        array (
          0 => 'thesis_mailchimp_form_1376691939_thesis_mailchimp_email',
          1 => 'thesis_mailchimp_form_1376691939_thesis_mailchimp_submit',
        ),
        'thesis_html_container_1365640887' => 
        array (
          0 => 'thesis_comments_intro',
          1 => 'thesis_comments_nav_1366218263',
          2 => 'thesis_comments_1348716667',
          3 => 'thesis_comments_nav_1366218280',
          4 => 'thesis_comment_form_1348843091',
        ),
        'thesis_comments_1348716667' => 
        array (
          0 => 'thesis_html_container_1348841704',
          1 => 'thesis_comments_1348716667_thesis_comment_text',
          2 => 'thesis_html_container_1366209424',
        ),
        'thesis_html_container_1348841704' => 
        array (
          0 => 'thesis_comments_1348716667_thesis_comment_avatar',
          1 => 'thesis_comments_1348716667_thesis_comment_author',
          2 => 'thesis_comments_1348716667_thesis_comment_date',
        ),
        'thesis_html_container_1366209424' => 
        array (
          0 => 'thesis_comments_1348716667_thesis_comment_reply',
          1 => 'thesis_comments_1348716667_thesis_comment_permalink',
          2 => 'thesis_comments_1348716667_thesis_comment_edit',
        ),
        'thesis_comment_form_1348843091' => 
        array (
          0 => 'thesis_comment_form_1348843091_thesis_comment_form_cancel',
          1 => 'thesis_comment_form_1348843091_thesis_comment_form_title',
          2 => 'thesis_comment_form_1348843091_thesis_comment_form_name',
          3 => 'thesis_comment_form_1348843091_thesis_comment_form_email',
          4 => 'thesis_comment_form_1348843091_thesis_comment_form_url',
          5 => 'thesis_comment_form_1348843091_thesis_comment_form_comment',
          6 => 'thesis_comment_form_1348843091_thesis_comment_form_submit',
        ),
        'thesis_html_container_1348701154' => 
        array (
          0 => 'thesis_next_post_link',
          1 => 'thesis_previous_post_link',
        ),
        'thesis_html_container_1348010964' => 
        array (
          1 => 'thesis_text_box_1350230891',
          2 => 'thesis_wp_widgets_1348079687',
        ),
        'thesis_html_container_1371744962' => 
        array (
          0 => 'thesis_html_container_1348009575',
        ),
        'thesis_html_container_1348009575' => 
        array (
          0 => 'thesis_attribution',
          1 => 'thesis_wp_admin',
        ),
      ),
    ),
    'page' => 
    array (
      'boxes' => 
      array (
        'thesis_html_body' => 
        array (
          0 => 'thesis_html_container_1348093642',
          1 => 'thesis_html_container_1371744962',
        ),
        'thesis_html_container_1348093642' => 
        array (
          0 => 'thesis_wp_nav_menu_1348009742',
          1 => 'thesis_site_title',
          2 => 'thesis_html_container_1348009571',
        ),
        'thesis_html_container_1348009571' => 
        array (
          0 => 'thesis_html_container_1348010954',
          1 => 'thesis_html_container_1348010964',
        ),
        'thesis_html_container_1348010954' => 
        array (
          0 => 'thesis_wp_loop',
        ),
        'thesis_wp_loop' => 
        array (
          0 => 'thesis_post_box_1348607689',
          1 => 'thesis_html_container_1365640949',
        ),
        'thesis_post_box_1348607689' => 
        array (
          0 => 'thesis_html_container_1348886177',
          1 => 'thesis_post_box_1348607689_thesis_wp_featured_image',
          2 => 'thesis_post_box_1348607689_thesis_post_image',
          3 => 'thesis_post_box_1348607689_thesis_post_content',
        ),
        'thesis_html_container_1348886177' => 
        array (
          0 => 'thesis_post_box_1348607689_thesis_post_author_avatar',
          1 => 'thesis_post_box_1348607689_thesis_post_headline',
          2 => 'thesis_post_box_1348607689_thesis_post_author',
          3 => 'thesis_post_box_1348607689_thesis_twitter_profile',
          4 => 'thesis_post_box_1348607689_thesis_post_date',
          5 => 'thesis_post_box_1348607689_thesis_post_edit',
        ),
        'thesis_html_container_1365640949' => 
        array (
          0 => 'thesis_comments_intro',
          1 => 'thesis_comments_nav_1366218263',
          2 => 'thesis_comments_1348716667',
          3 => 'thesis_comments_nav_1366218280',
          4 => 'thesis_comment_form_1348843091',
        ),
        'thesis_comments_1348716667' => 
        array (
          0 => 'thesis_html_container_1348841704',
          1 => 'thesis_comments_1348716667_thesis_comment_text',
          2 => 'thesis_html_container_1366209424',
        ),
        'thesis_html_container_1348841704' => 
        array (
          0 => 'thesis_comments_1348716667_thesis_comment_avatar',
          1 => 'thesis_comments_1348716667_thesis_comment_author',
          2 => 'thesis_comments_1348716667_thesis_comment_date',
        ),
        'thesis_html_container_1366209424' => 
        array (
          0 => 'thesis_comments_1348716667_thesis_comment_reply',
          1 => 'thesis_comments_1348716667_thesis_comment_permalink',
          2 => 'thesis_comments_1348716667_thesis_comment_edit',
        ),
        'thesis_comment_form_1348843091' => 
        array (
          0 => 'thesis_comment_form_1348843091_thesis_comment_form_cancel',
          1 => 'thesis_comment_form_1348843091_thesis_comment_form_title',
          2 => 'thesis_comment_form_1348843091_thesis_comment_form_name',
          3 => 'thesis_comment_form_1348843091_thesis_comment_form_email',
          4 => 'thesis_comment_form_1348843091_thesis_comment_form_url',
          5 => 'thesis_comment_form_1348843091_thesis_comment_form_comment',
          6 => 'thesis_comment_form_1348843091_thesis_comment_form_submit',
        ),
        'thesis_html_container_1348010964' => 
        array (
          0 => 'thesis_text_box_1350230891',
          1 => 'thesis_wp_widgets_1348079687',
        ),
        'thesis_html_container_1371744962' => 
        array (
          0 => 'thesis_html_container_1348009575',
        ),
        'thesis_html_container_1348009575' => 
        array (
          0 => 'thesis_attribution',
          1 => 'thesis_wp_admin',
        ),
      ),
    ),
    'custom_1376088748' => 
    array (
      'title' => 'Signup',
      'options' => 
      array (
        'thesis_html_body' => 
        array (
          'class' => 'landing',
        ),
      ),
      'boxes' => 
      array (
        'thesis_html_body' => 
        array (
          0 => 'thesis_html_container_1348093642',
          1 => 'thesis_html_container_1371744962',
        ),
        'thesis_html_container_1348093642' => 
        array (
          0 => 'thesis_site_title',
          1 => 'thesis_html_container_1348010954',
        ),
        'thesis_html_container_1348010954' => 
        array (
          0 => 'thesis_wp_loop',
        ),
        'thesis_wp_loop' => 
        array (
          0 => 'thesis_post_box_1348607689',
        ),
        'thesis_post_box_1348607689' => 
        array (
          0 => 'thesis_html_container_1348886177',
          1 => 'thesis_post_box_1348607689_thesis_wp_featured_image',
          2 => 'thesis_post_box_1348607689_thesis_post_image',
          3 => 'thesis_post_box_1348607689_thesis_post_content',
          4 => 'thesis_mailchimp_form_1376692054',
        ),
        'thesis_html_container_1348886177' => 
        array (
          0 => 'thesis_post_box_1348607689_thesis_post_headline',
          1 => 'thesis_post_box_1348607689_thesis_post_edit',
          2 => 'thesis_post_box_1348607689_thesis_post_date',
        ),
        'thesis_mailchimp_form_1376692054' => 
        array (
          0 => 'thesis_mailchimp_form_1376692054_thesis_mailchimp_email',
          1 => 'thesis_mailchimp_form_1376692054_thesis_mailchimp_submit',
        ),
        'thesis_html_container_1371744962' => 
        array (
          0 => 'thesis_html_container_1348009575',
        ),
        'thesis_html_container_1348009575' => 
        array (
          0 => 'thesis_attribution',
          1 => 'thesis_wp_admin',
        ),
      ),
    ),
    'custom_1376329826' => 
    array (
      'title' => 'Full Page, No Sidebars',
      'options' => 
      array (
        'thesis_html_body' => 
        array (
          'class' => 'full_page',
        ),
      ),
      'boxes' => 
      array (
        'thesis_html_body' => 
        array (
          0 => 'thesis_html_container_1348093642',
          1 => 'thesis_html_container_1371744962',
        ),
        'thesis_html_container_1348093642' => 
        array (
          0 => 'thesis_wp_nav_menu_1348009742',
          1 => 'thesis_site_title',
          2 => 'thesis_html_container_1348010954',
        ),
        'thesis_html_container_1348010954' => 
        array (
          0 => 'thesis_wp_loop',
        ),
        'thesis_wp_loop' => 
        array (
          0 => 'thesis_post_box_1348607689',
        ),
        'thesis_post_box_1348607689' => 
        array (
          0 => 'thesis_html_container_1348886177',
          1 => 'thesis_post_box_1348607689_thesis_wp_featured_image',
          2 => 'thesis_post_box_1348607689_thesis_post_image',
          3 => 'thesis_post_box_1348607689_thesis_post_content',
        ),
        'thesis_html_container_1348886177' => 
        array (
          0 => 'thesis_post_box_1348607689_thesis_post_headline',
          1 => 'thesis_post_box_1348607689_thesis_post_edit',
          2 => 'thesis_post_box_1348607689_thesis_post_date',
        ),
        'thesis_html_container_1371744962' => 
        array (
          0 => 'thesis_html_container_1348009575',
        ),
        'thesis_html_container_1348009575' => 
        array (
          0 => 'thesis_attribution',
          1 => 'thesis_wp_admin',
        ),
      ),
    ),
  ),
);
}
