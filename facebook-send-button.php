<?php
/*
Plugin Name: Facebook Send Button
Plugin URI: http://tracking.42dev.eu/projects/facebook-send-button
Description: Display Facebook Send Button on WordPress Posts
Version: 0.1
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
	$html = '<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:send href="'.get_permalink($post->id).'" font=""></fb:send>';
	return $content.$html;
}

add_action('the_content', 'facebook_send_button_output');

?>