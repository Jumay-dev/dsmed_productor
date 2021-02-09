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