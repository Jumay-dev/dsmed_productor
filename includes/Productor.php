<?php

class Productor 
{
    protected $plugin_name;
    protected $plugin_version;

    public function __construct() {
        if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->plugin_version = PLUGIN_NAME_VERSION;
		} else {
			$this->plugin_version = '0.0.1';
        }
        $this->plugin_name = "DS.Med Productor";
        
        $this->load_depedences();
        $this->load_hooks();
    }

    public function run() {
        global $wpdb;
        $prefix = $wpdb->get_blog_prefix();
        $table_name = $prefix . 'dsmed_productor';
        $dbname = $wpdb->dbname;

        if($_SERVER['REQUEST_METHOD'] === "GET") {
            if($_GET['action'] === 'add_info') {
                if (isset($_GET['product_id']) && isset($_GET['product_info'])) {
                    $product_id = $_GET['product_id'];
                    $product_info = $_GET['product_info'];

                    $check = $wpdb->get_row("SELECT * FROM $table_name WHERE product_id = '$product_id'");

                    $res;

                    if ($check) {
                        $res = $wpdb->update($table_name, array(
                            'info' => $product_info
                        ), array('product_id' => $product_id));
                    } else {
                        $res = $wpdb->insert($table_name, array(
                            'product_id' => $product_id,
                            'product_info' => $product_info
                        )); 
                    }

                    if($res) {
                        $ans['success'] = true;
                        $ans['content'] = $wpdb->get_results("SELECT * FROM $table_name WHERE product_id = $product_id", ARRAY_A);
                        die(json_encode($ans));
                    } else {
                        $ans['success'] = false;
                        $ans['content'] = null;
                        die(json_encode($ans));
                    }
                }
            }
            if($_GET['action'] === 'get_info') {
                if (isset($_GET['product_id'])) {
                    $res = $wpdb->get_row("SELECT * FROM $table_name WHERE product_id = '$product_id'", ARRAY_A);
                }

                if($res) {
                    $ans['success'] = true;
                    $ans['content'] = $res;
                    die(json_encode($ans));
                } else {
                    $ans['success'] = false;
                    $ans['content'] = null;
                    die(json_encode($ans));
                }
            }
        }
    }

    private function load_depedences() {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/Admin.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/PublicClass.php';
    }

    public function load_hooks() {
        $plugin_admin = new Admin();
        $plugin_public = new PublicClass();
    }
}