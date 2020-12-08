<?php
/**
 * @package Ivan
 */
/*
Plugin Name: custom-button
Plugin URI: 
Description: 
Version: 1.0
Author: 
Author URI: 
License:
Text Domain: 
*/

// Проверяем права пользователя
add_action('admin_head', 'add_custom_button');
function add_custom_button() {
	
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return; 
	}
    
    // Проверяем включен ли редактор постов
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'custom_button_script' );
		add_filter( 'mce_buttons', 'register_custom_button' );
	}
}

// Регистрируем кнопку в редакторе постов
function register_custom_button( $buttons ) {
	$buttons[] = 'custom_button';
	return $buttons;
}

// Указываем ссылку на JS-файл кнопки
function custom_button_script($plugin_array) {
    $plugin_array['custom_button'] = get_stylesheet_directory_uri() .'/custom_button.js';
	return $plugin_array;
}	

// Добавляем шорткод
add_shortcode( 'tooltip', 'tooltip_func' );
function tooltip_func( $atts, $content ){
	 return "<span style='color:red' data-toggle='tooltip' data-placement='top' title='" . $atts['title'] . "'>". $content . "</span>";
}
