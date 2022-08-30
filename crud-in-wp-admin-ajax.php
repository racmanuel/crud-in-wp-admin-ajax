<?php
/*
Plugin Name: System in WP Plugin
Plugin URI: 
Description: Plugin for make a System in WP.
Version: 1.0.0
Author: Manuel Ramirez Coronel
Author URI: https://github.com/racmanuel
License: GPLv2 or later
License URI:
 */

include_once 'vendor/autoload.php';

use Spatie\SimpleExcel\SimpleExcelWriter;

global $crud_db_version;
$crud_db_version = '1.0';

function crud_install()
{
    global $wpdb;
    global $crud_db_version;

    $charset_collate = $wpdb->get_charset_collate();


    $table_name_clientes = $wpdb->prefix . 'clientes';
    $wp_clientes = "CREATE TABLE $table_name_clientes (
        `ID` INT(11) NOT NULL AUTO_INCREMENT,
        `FECHA_REG` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        `NOMBRE` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
        `APELLIDO_MAT` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
        `APELLIDO_PAT` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
        `TELEFONO_1` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
        `TELEFONO_2` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
        `DIRECCION` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
        PRIMARY KEY (`ID`) USING BTREE
    )
    $charset_collate
    ENGINE=InnoDB
    AUTO_INCREMENT=13
    ;";
    
    $table_name_autos = $wpdb->prefix . 'autos';
    $wp_autos = "CREATE TABLE $table_name_autos (
    `ID` INT(11) NOT NULL AUTO_INCREMENT,
    `FECHA_REG` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `MARCA` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
    `MODELO` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
    `AÑO` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
    `PLACA` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
    `SERIE` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
    PRIMARY KEY (`ID`) USING BTREE
    )
    $charset_collate
    ENGINE=InnoDB
    AUTO_INCREMENT=13
    ;";

    $table_name_clientes_autos = $wpdb->prefix . 'clientes_autos';
    $wp_clientes_autos = "CREATE TABLE IF NOT EXISTS $table_name_clientes_autos (
    `ID` int(11) NOT NULL AUTO_INCREMENT,
    `ID_CLIENTE` int(11) NOT NULL,
    `ID_AUTO` int(11) NOT NULL,
    PRIMARY KEY (`ID`),
    KEY `ID_CLIENTE` (`ID_CLIENTE`),
    KEY `ID_AUTO` (`ID_AUTO`)
    ) 
    $charset_collate 
    ENGINE=InnoDB 
    AUTO_INCREMENT=6";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta(array($wp_clientes, $wp_autos, $wp_clientes_autos));

    add_option('crud_db_version', $crud_db_version);
}
register_activation_hook(__FILE__, 'crud_install');

function delete_plugin_database_tables(){
    global $wpdb;
    $tableArray = [   
      $wpdb->prefix . "clientes",
      $wpdb->prefix . "autos"
   ];

  foreach ($tableArray as $tablename) {
     $wpdb->query("DROP TABLE IF EXISTS $tablename");
  }
}
register_deactivation_hook(__FILE__,'delete_plugin_database_tables');
//register_uninstall_hook(__FILE__, 'delete_plugin_database_tables');

/**
 * Register a custom menu page.
 */
function crud_in_wp_admin_page_register()
{
    /** 
     * Clientes
     */
    add_menu_page(__('Clientes', 'text-domain'), 'Clientes', 'manage_options', 'registrar-clientes', 'registrar_clientes', 'dashicons-groups', 6);
    add_submenu_page('registrar-clientes', 'Ver Clientes', 'Ver Clientes', 'manage_options', 'ver-clientes', 'ver_clientes');

    /**
     * Autos
     */
    add_menu_page(__('Autos', 'text-domain'), 'Autos', 'manage_options', 'registrar-autos', 'registrar_autos', 'dashicons-car', 6);
    add_submenu_page('registrar-autos', 'Ver Autos', 'Ver Autos', 'manage_options', 'ver-autos', 'ver_autos');
}
add_action('admin_menu', 'crud_in_wp_admin_page_register');

/**
 * Display a custom menu page
 */
function ver_clientes()
{
    // Include vista de ver Clientes.
    include 'includes/ver-clientes.php';
}

function registrar_clientes()
{
    // Include vista de registrar Clientes.
    include 'includes/registrar-clientes.php';
}

function registrar_autos()
{
    // Include vista de registrar Clientes.
    include 'includes/registrar-autos.php';
}

function ver_autos(){
     // Include vista de registrar Clientes.
     include 'includes/ver-autos.php';
}

add_action('admin_enqueue_scripts', 'clientesscripts');
/**
 * Loads Scripts
 *
 * @return void
 */
function clientesscripts()
{
    /** Line to see the name of the page */
    //wp_die($hook);
    /*if ( 'toplevel_page_registrar-clientes' != $hook ) {
        return;
    }*/

    wp_register_style('bulma-css', 'https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css', '1.0.0', 'all');

    if($_GET['page'] == 'registrar-clientes'){
        wp_enqueue_script('clientes-js', plugins_url('/js/clientes.js', __FILE__), array('jquery'), '1.0.0', true);
        wp_localize_script('clientes-js', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
        wp_enqueue_style('bulma-css');
    }

    if($_GET['page'] == 'registrar-autos'){
        wp_enqueue_script('autos-js', plugins_url('/js/autos.js', __FILE__), array('jquery'), '1.0.0', true);
        wp_localize_script('autos-js', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
        wp_enqueue_style('bulma-css');
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
    $relation_table = $wpdb->prefix . 'clientes_autos';

    $nombre = $_POST['nombre'];
    $apellido_materno = $_POST['apellido_mat'];
    $apellido_paterno = $_POST['apellido_pat'];
    $telefono_1 = $_POST['telefono_1'];
    $telefono_2 = $_POST['telefono_2'];
    $direccion = $_POST['direccion'];
    $auto = $_POST['auto'];

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

    $last_updated_row = $wpdb->insert_id;
    
    $wpdb->insert(
        $relation_table,
        array(
            'ID_CLIENTE' => $last_updated_row,
            'ID_AUTO' => $auto
        )
    );

    //wp_redirect(site_url('/')); // <-- here goes address of site that user should be redirected after submitting that form
    wp_die();
}

add_action('wp_ajax_nopriv_my_save_custom_form', 'my_save_custom_form'); // Para usuarios no logueados
add_action('wp_ajax_my_save_custom_form', 'my_save_custom_form'); // Para usuarios logueados

/**
 * Funcion que captura los valores de una
 * petición POST o GET de HTTP.
 */
function registrar_auto_in_db()
{
    // Nuestro código de manipulación de los datos
    global $wpdb;

    $table_name = $wpdb->prefix . 'autos';

    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $año = $_POST['año'];
    $placa = $_POST['placa'];
    $serie = $_POST['serie'];

    $wpdb->insert(
        $table_name,
        array(
            'MARCA' => $marca,
            'MODELO' => $modelo,
            'AÑO' => $año,
            'PLACA' => $placa,
            'SERIE' => $serie
        )
    );

    //wp_redirect(site_url('/')); // <-- here goes address of site that user should be redirected after submitting that form
    wp_die();
}

add_action('wp_ajax_nopriv_registrar_auto_in_db', 'registrar_auto_in_db'); // Para usuarios no logueados
add_action('wp_ajax_registrar_auto_in_db', 'registrar_auto_in_db'); // Para usuarios logueados

add_action( 'plugins_loaded', function() {
    if ( isset( $_GET['download'] ) ) {
        // here you can create .xls file
        $data = array();
        global $wpdb;
        $table_name = $wpdb->prefix . 'clientes';
        $consulta = $wpdb->get_results("SELECT * FROM $table_name");

        foreach ($consulta as $value){ 
            $data[] = array(
                'id' => $value->ID,
                'nombres' => $value->NOMBRE,
                'apellido_mat' => $value->APELLIDO_MAT,
                'apellido_pat' => $value->APELLIDO_PAT,
                'telefono_1' => $value->TELEFONO_1,
                'telefono_2' => $value->TELEFONO_2,
                'direccion' =>$value->DIRECCION
            );
        }

        $writer = SimpleExcelWriter::streamDownload('your-export.xlsx')
        ->addRows($data)
       ->toBrowser();

        wp_die();      
    }
});