<!-- This is your About section, you can edit this --!>
<p>You are currently viewing the theme dubbed Thunderbolt by Patrick Algrim from <a href="http://hellyeahdude.com">Hell Yeah Dude</a>. You can edit this about section by going into the WordPress back-end, going into the template file Sidebar, and there I will be! Put your about section here or any other section that you might want. <a href="<?php bloginfo('wpurl'); ?>/about/">Read More</a></p>
<div class="section_title">Discussion</div>
<?php if (function_exists('get_recent_comments')) { ?>
<ul><?php get_recent_comments(); ?></ul>
<?php } ?> 