<?php

class Admin
{
    public function __construct() {
        add_action( 'woocommerce_product_options_advanced', 'art_woo_add_custom_fields' );
        function art_woo_add_custom_fields() {
            global $product, $post;
            print_r($post->ID);
            echo '<div class="options_group">';// Группировка полей 
                woocommerce_wp_text_input( array(
                    'id'                => '_text_field',
                    'label'             => __( 'Контент таблицы характеристик', 'woocommerce' ),
                    'placeholder'       => 'Длина: 100; Ширина: 200; Вес: 30',
                    'desc_tip'          => 'true',
                    'custom_attributes' => array( 'required' => 'required' ),
                    'description'       => __( 'Данные, которые отобразятся в таблице', 'woocommerce' ),
                ) );
            echo "<button>ssdf</button>";
            echo "<button>Удалить</button>";
            echo '</div>';
        }
    }
}