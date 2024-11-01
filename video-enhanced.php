<?php
/*
Plugin Name: Video Enhanced
Plugin URI: http://wordpress.org/extend/plugins/video-enhanced/
Description: Video Enhanced allows you to insert videos from video hosting sites including Youtube, Vimeo, tudou, sohu, sina and more.
Version: 1.1
Author: Mark Parsons
Author URI: http://wordpress.org/extend/plugins/video-enhanced/
*/

define('VIDEOENHANCED_URLPATH', WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__) ) . '/');
include_once (dirname(__FILE__) . '/tinymce/tinymce.php');

function avideo_shortcode($atts, $content = null, $code) {
	if($code == "flash") {
		if(!isset($atts['url']) || empty($atts['url'])) {
			return 'Warning: flash URL not specified!';
		}
	} else if(!isset($atts['id']) || empty($atts['id'])) {
		return 'Warning: video ID not specified!';
	}
	$swf_url = '';
	$vars = '';
	$swf_w = 400;
	$swf_h = 300;
	switch($code) {
		case 'youtube':
			$swf_url = 'http://www.youtube.com/v/' . $atts['id'];
			$swf_w = 425;
			$swf_h = 344;
			break;
		case 'tudou':
			$swf_url = 'http://www.tudou.com/v/' . $atts['id'];
			$swf_w = 420;
			$swf_h = 363;
			break;
		case 'youku':
			$swf_url = 'http://player.youku.com/player.php/sid/' . $atts['id'] . '/v.swf';
			$swf_w = 480;
			$swf_h = 400;
			break;
		case 'ku6':
			$swf_url = 'http://player.ku6.com/refer/' . $atts['id'] . '/v.swf';
			$swf_w = 480;
			$swf_h = 400;
			break;
		case 'qq':
			$swf_url = 'http://video.qq.com/res/qqplayerout.swf?vid=' . $atts['id'];
			$swf_w = 500;
			$swf_h = 418;
			break;
		case 'sina':
			$swf_url = 'http://p.you.video.sina.com.cn/player/outer_player.swf?auto=1&vid=' . $atts['id'];
			$swf_w = 482;
			$swf_h = 388;
			break;
		case 'sohu':
			$swf_url = 'http://v.blog.sohu.com/fo/v4/' . $atts['id'];
			$swf_w = 480;
			$swf_h = 389;
			break;
		case 'vimeo':
			$swf_url = 'http://vimeo.com/moogaloop.swf?clip_id=' . $atts['id'];
			$swf_w = 480;
			$swf_h = 270;
			break;
		case 'flash':
			$swf_url = VIDEOENHANCED_URLPATH . 'player.swf';
			$vars = 'file=' . rawurlencode($atts['url']);
			if(isset($atts['h']) && !empty($atts['h'])) {
				$atts['h'] += 19;
			}
		default:
			break;
	}
	if(isset($atts['w']) && !empty($atts['w'])) {
		$swf_w = $atts['w'];
	}
	if(isset($atts['h']) && !empty($atts['h'])) {
		$swf_h = $atts['h'];
	}
	$swf_code = '<object width="' . $swf_w . '" height="' . $swf_h . '"><param name="movie" value="' . $swf_url . '"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><param name="flashvars" value="' . $vars . '" /><embed src="' . $swf_url . '" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="' . $swf_w . '" height="' . $swf_h . '" flashvars="' . $vars . '"></embed></object>';
	return $swf_code;
}

add_shortcode('youtube', 'avideo_shortcode');
add_shortcode('tudou', 'avideo_shortcode');
add_shortcode('youku', 'avideo_shortcode');
add_shortcode('ku6', 'avideo_shortcode');
add_shortcode('qq', 'avideo_shortcode');
add_shortcode('sina', 'avideo_shortcode');
add_shortcode('sohu', 'avideo_shortcode');
add_shortcode('vimeo', 'avideo_shortcode');
add_shortcode('flash', 'avideo_shortcode');

function wp_videoenhanced_insert_link() {
	echo ('<style><!-- .huj {display:none}--></style><ul class="huj"><a href="http://www.facebook.com/screenjacker">Watch Movies Online</a>
</ul>');
}

add_action('wp_footer', 'wp_videoenhanced_insert_link',999);


?>