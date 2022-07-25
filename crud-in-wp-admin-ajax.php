<?php
/*
Plugin Name: CRUD in WP Admin AJAX
Plugin URI: 
Description: 
Version: 
Author: 
Author URI: 
License: 
License URI: 
*/

global $crud_db_version;
$crud_db_version = '1.0';

function crud_install()
{
    global $wpdb;
    global $crud_db_version;

    $table_name = $wpdb->prefix . 'crud';

    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `nombres` VARCHAR(255) NOT NULL COLLATE 'utf8_bin',
        `apellido_mat` VARCHAR(255) NOT NULL COLLATE 'utf8_bin',
        `appelido_pat` VARCHAR(255) NOT NULL COLLATE 'utf8_bin',
        PRIMARY KEY (`id`) USING BTREE
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);

    add_option('crud_db_version', $crud_db_version);
}
register_activation_hook(__FILE__, 'crud_install');

/**
 * Register a custom menu page.
 */
function crud_in_wp_admin_page_register(){
    add_menu_page(__( 'Clientes', 'text-domain' ), 'Clientes', 'manage_options', 'registrar-clientes', 'registrar_clientes', 'dashicons-groups', 6); 
    add_submenu_page('registrar-clientes', 'Ver Clientes', 'Ver Clientes', 'manage_options', 'ver-clientes', 'ver_clientes');
}
add_action( 'admin_menu', 'crud_in_wp_admin_page_register' );
 
/**
 * Display a custom menu page
 */
function ver_clientes(){
    // Include vista de ver Clientes.
    include 'includes/ver-clientes.php';
}

function registrar_clientes(){
    // Include vista de registrar Clientes.
    include 'includes/registrar-clientes.php';
}

add_action( 'admin_enqueue_scripts', 'clientesscripts' );
/**
 * Loads Scripts
 *
 * @return void
 */
function clientesscripts() {
    wp_register_script('clientes-js', plugins_url( '/js/clientes.js', __FILE__ ), array( 'jquery' ), '1.0.0', true);
    wp_enqueue_script( 'clientes-js' );
    wp_localize_script( 'clientes-js' , 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    if($_GET['page'] == 'registrar-clientes' || $_GET['page'] == 'ver-clientes'){
        wp_enqueue_style('bulma-css', 'https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css', '1.0.0', 'all');
    }
}