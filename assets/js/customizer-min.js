/**
 * Customizer JS
 *
 * @package  CsStarter
 * @subpackage csstarter/assets/js
 * @author   Chip Sheppard
 * @since    1.0.0
 * @license  GPL-2.0+
 */
!function(e){wp.customize("blogname",function(t){t.bind(function(t){e(".site-title a").text(t)})}),wp.customize("blogdescription",function(t){t.bind(function(t){e(".site-description").text(t)})}),wp.customize("header_textcolor",function(t){t.bind(function(t){"blank"===t?e(".site-title, .site-description").css({clip:"rect(1px, 1px, 1px, 1px)",position:"absolute"}):(e(".site-title, .site-description").css({clip:"auto",position:"relative"}),e(".site-title a, .site-description").css({color:t}))})}),wp.customize("csstarter_settings[header_layout]",function(t){t.bind(function(t){"headernormal"===t&&e("body").removeClass("headercentered"),"headercentered"===t&&e("body").addClass("headercentered")})})}(jQuery);