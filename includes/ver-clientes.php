<?php
// WP_List_Table is not loaded automatically so we need to load it in our application
if (!class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * Create a new table class that will extend the WP_List_Table
 */
class Clientes_List_Table extends WP_List_Table
{
    /**
     * Prepare the items for the table to process
     *
     * @return Void
     */
    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();

        $data = $this->table_data();
        usort($data, array(&$this, 'sort_data'));

        $perPage = 25;
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);

        $this->set_pagination_args(array(
            'total_items' => $totalItems,
            'per_page' => $perPage,
        ));

        $data = array_slice($data, (($currentPage - 1) * $perPage), $perPage);

        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
    }

    /**
     * Override the parent columns method. Defines the columns to use in your listing table
     *
     * @return Array
     */
    public function get_columns()
    {
        $columns = array(
            'id' => 'ID',
            'nombres' => 'Nombre(s)',
            'apellido_mat' => 'Apellido Materno',
            'apellido_pat' => 'Apellido Paterno',
            'telefono_1' => 'Teléfono 1',
            'telefono_2' => 'Teléfono 2',
            'direccion' => 'Dirección'
        );

        return $columns;
    }

    /**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns()
    {
        return array();
    }

    /**
     * Define the sortable columns
     *
     * @return Array
     */
    public function get_sortable_columns()
    {
        return array('title' => array('title', false));
    }

    /**
     * Get the table data
     *
     * @return Array
     */
    private function table_data()
    {
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

        return $data;
    }

    /**
     * Define what data to show on each column of the table
     *
     * @param  Array $item        Data
     * @param  String $column_name - Current column name
     *
     * @return Mixed
     */
    public function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'id':
            case 'nombres':
            case 'apellido_mat':
            case 'apellido_pat':
            case 'telefono_1':
            case 'telefono_2':
            case 'direccion':
                return $item[$column_name];

            default:
                return print_r($item, true);
        }
    }

    /**
     * Allows you to sort the data by the variables set in the $_GET
     *
     * @return Mixed
     */
    private function sort_data($a, $b)
    {
        // Set defaults
        $orderby = 'id';
        $order = 'asc';

        // If orderby is set, use this as the sort column
        if (!empty($_GET['orderby'])) {
            $orderby = $_GET['orderby'];
        }

        // If order is set use this as the order
        if (!empty($_GET['order'])) {
            $order = $_GET['order'];
        }

        $result = strcmp($a[$orderby], $b[$orderby]);

        if ($order === 'asc') {
            return $result;
        }

        return -$result;
    }
}

$Clientes_List_Table = new Clientes_List_Table();
$Clientes_List_Table->prepare_items();
?>

<div class="wrap">
    <h1><?php esc_html_e('Ver Clientes', 'textdomain');?></h1>
    <?php $Clientes_List_Table->display();?>
</div>