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

    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE `wp_clientes` (
        `ID` INT(11) NOT NULL AUTO_INCREMENT,
        `NOMBRE` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
        `APELLIDO_MAT` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
        `APELLIDO_PAT` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
        `TELEFONO_1` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
        `TELEFONO_2` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
        `DIRECCION` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
        PRIMARY KEY (`ID`) USING BTREE
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
    if($_GET['page'] == 'registrar-clientes'){
        wp_enqueue_style('bulma-css', 'https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css', '1.0.0', 'all');
    }
}

/**
 * Funcion que captura los valores de una
 * petición POST o GET de HTTP.
 */
function my_save_custom_form()
{
    // Nuestro código de manipulación de los datos
    global $wpdb;

    $table_name = $wpdb->prefix . 'clientes';

    $nombre = $_POST['nombre'];
    $apellido_materno = $_POST['apellido_mat'];
    $apellido_paterno = $_POST['apellido_pat'];
    $telefono_1 = $_POST['telefono_1'];
    $telefono_2 = $_POST['telefono_2'];
    $direccion = $_POST['direccion'];

    $wpdb->insert(
        $table_name,
        array(
            'NOMBRE' => $nombre,
            'APELLIDO_MAT' => $apellido_materno,
            'APELLIDO_PAT' => $apellido_paterno,
            'TELEFONO_1' => $telefono_1,
            'TELEFONO_2' => $telefono_2,
            'DIRECCION' => $direccion,
        )
    );

    //wp_redirect(site_url('/')); // <-- here goes address of site that user should be redirected after submitting that form
    wp_die();
}

add_action('wp_ajax_nopriv_my_save_custom_form', 'my_save_custom_form'); // Para usuarios no logueados
add_action('wp_ajax_my_save_custom_form', 'my_save_custom_form'); // Para usuarios logueados