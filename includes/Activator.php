<?php

class Activator 
{
    public static function activate() {
        defined('ABSPATH') or die('Абсолютного пути не существует(db)');

        global $wpdb;
        $pref = $wpdb->get_blog_prefix();
        $table_name = $pref . 'dsmed_productor';
        $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset COLLATE $wpdb->collate";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        $table_structure = "CREATE TABLE $table_name (
            id int(11) unsigned NOT NULL auto_increment,
            product_id int(11),
            info text(1000),
            PRIMARY KEY (id),
            KEY id (id)
            ) $charset_collate;";
        dbDelta( $keymaker_table );

        $query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) );
        if ( ! $wpdb->get_var( $query ) == $table_name ) {
            return TRUE;
        }
        return FALSE;
    }
}