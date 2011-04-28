<?php
/*
Plugin Name: Facebook Send Button
Plugin URI: http://tracking.42dev.eu/projects/facebook-send-button
Description: Display Facebook Send Button on WordPress Posts and Pages
Version: 0.2
Author: Florian Beer
Author URI: http://blog.no-panic.at
*/

/*
    Copyright (c) 2011 Florian Beer - 42dev e. U. - http://42dev.eu

    This program is free software.

	You are free to:
	Share — to copy, distribute and transmit the work
	Remix — to adapt the work
	
	Under the following conditions:
	Noncommercial — You may not use this work for commercial purposes.
	Attribution — You must attribute the work in the manner
		specified by the author or licensor (but not in any way
		that suggests that they endorse you or your use of the work).
	Share Alike — If you alter, transform, or build upon this 
		work, you may distribute the resulting work only under the
		same or similar license to this one.

	http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY, without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

function facebook_send_button_output($content){
	global $post;
	
	// only on single posts or pages
	if(is_single() || is_page()){
		$send_btn = '<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:send href="'.get_permalink($post->id).'" font=""></fb:send>';
		return $content.$send_btn;
	} else {
		return $content;
	}
}

add_action('the_content', 'facebook_send_button_output');

function facebook_send_button_og() {
	global $post;
	
	// only on single posts or pages
	if(is_single() || is_page()){
		
		// get post thumbnail
		$post_thumbs = wp_get_attachment_image_src(get_post_thumbnail_id($post->id), 'large');
		$post_thumb = $post_thumbs[0];

		// if no thumb is specified, search post for images and display first one
		if($post_thumb[0] == ''){
				$out = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $match);
				if ( $out > 0 ){
					$post_thumb = $match[1][0];
				}
		}

?>
<!-- Facebook Open Graph Tags -->
<meta property="og:title" content="<?php the_title($post->id); ?>" />
<meta property="og:type" content="website" />
<meta property="og:image" content="<?php echo $post_thumb; ?>"/>
<meta property="og:url" content="<?php the_permalink($post->id); ?>" />
<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
<!-- Facebook Open Graph Tags end-->
<?php
	}
}

add_action('wp_head', 'facebook_send_button_og');

?>