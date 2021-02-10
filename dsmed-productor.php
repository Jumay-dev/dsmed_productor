<?php
/**
 * @link              http://ds-med.ru
 * @since             1.0.0
 * @package           DS.med productor
 *
 * @wordpress-plugin
 * Plugin Name:       DS.Med productor
 * Plugin URI:        https://ds-med.ru/
 * Description:       Строит таблицу с ключевыми характеристиками по событию hover на карточке товара
 * Version:           0.0.1
 * Author:            Jumay-dev (DS.Med)
 * Author URI:        http://ds-med.ru/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       plugin-name
 * Domain Path:       /languages
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}
wp_enqueue_script("jquery");

add_action( 'wp_enqueue_scripts', 'add_productor_style' );

function add_productor_style() {
	wp_enqueue_style( 'myStyle', plugins_url( 'style.css', __FILE__ ), false );
}

function activate_dsmed_productor() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/Activator.php';
    Activator::activate();
}

register_activation_hook( __FILE__, 'activate_dsmed_productor' );

require_once plugin_dir_path( __FILE__ ) . 'includes/Productor.php';

function run_productor() {
	$plugin = new Productor();
	$plugin->run();
}
run_productor();