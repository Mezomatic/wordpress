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

add_action('admin_head', 'add_custom_button');
function add_custom_button() {
	
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return; 
	}
	
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'custom_button_script' );
		add_filter( 'mce_buttons', 'register_custom_button' );
	}
}

function register_custom_button( $buttons ) {
	$buttons[] = 'custom_button';
	return $buttons;
}

function custom_button_script($plugin_array) {
    $plugin_array['custom_button'] = get_stylesheet_directory_uri() .'/custom_button.js';
	return $plugin_array;
}	

add_shortcode( 'tooltip', 'tooltip_func' );
function tooltip_func( $atts, $content ){
	 return "<span style='color:red' data-toggle='tooltip' data-placement='top' title='" . $atts['title'] . "'>". $content . "</span>";
}
/*function true_add_mce_button() {
	// проверяем права пользователя - может ли он редактировать посты и страницы
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return; // если не может, то и кнопка ему не понадобится, в этом случае выходим из функции
	}
	// проверяем, включен ли визуальный редактор у пользователя в настройках (если нет, то и кнопку подключать незачем)
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'true_add_tinymce_script' );
		add_filter( 'mce_buttons', 'true_register_mce_button' );
	}
}
add_action('admin_head', 'true_add_mce_button');
 
// В этом функции указываем ссылку на JavaScript-файл кнопки
function true_add_tinymce_script( $plugin_array ) {
	$plugin_array['true_mce_button'] = get_stylesheet_directory_uri() .'/custom_button.js'; // true_mce_button - идентификатор кнопки
	return $plugin_array;
}
 
// Регистрируем кнопку в редакторе
function true_register_mce_button( $buttons ) {
	array_push( $buttons, 'true_mce_button' ); // true_mce_button - идентификатор кнопки
	return $buttons;
}

function true_url_external( $atts ) {
	$params = shortcode_atts( array( // в массиве укажите значения параметров по умолчанию
		'anchor' => 'Миша Рудрастых', // параметр 1
		'url' => 'https://misha.agency', // параметр 2
	), $atts );
	return "<a href='{$params['url']}' target='_blank'>{$params['anchor']}</a>";
}
add_shortcode( 'trueurl', 'true_url_external' );*/