<?php

class Admin
{
    public function __construct() {
        add_action( 'woocommerce_product_options_advanced', 'product_form' );
        function product_form() {
            global $product, $post, $wpdb;
            $product_id = $post->ID;
            $prefix = $wpdb->get_blog_prefix();
            $table_name = $prefix . 'dsmed_productor';

            $product_value = $wpdb->get_row("SELECT * FROM $table_name WHERE product_id = $product_id");
            
            ?>

            <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", () => {
                let productId = document.getElementById('product_id').value
                let productInfoNode = document.getElementById('product_info')
                let submitter= document.getElementById('sumbitter')
                let deleter= document.getElementById('deleter')

                let productInfo = ''

                productInfoNode.addEventListener('change', event => productInfo = event.target.value)

                submitter.addEventListener('click', event => {
                    event.preventDefault()
                    if(productInfo !== "") {
                        fetch(`${window.location.origin}/?action=add_info&product_id=${productId}&product_info=${productInfo}`)
                    }
                })

                deleter.addEventListener('click', event => {
                    event.preventDefault()
                    fetch(`${window.location.origin}/?action=delete_info&product_id=${productId}`)
                    .then(res => window.location.reload())
                })
            })
            </script>
            
            <div style="padding: 5px;">
                <h3 style="margin-left: 10px;">DS.Med Productor</h3>
                <p style="margin-left: 10px; padding: 0px;">Формат ввода: Свойство 1; Свойство 2; Свойство 3</p>
                <div id="productor__form" style="display: flex; align-items: center; margin-top: 10px; margin-left: 10px;">
                    <input type="text" name="product_info" id="product_info" <?php if ($product_value != null) echo 'value="' . $product_value->info . '"'; ?>/>
                    <input type="hidden" name="product_id" value="<?= $product_id ?>" id="product_id"/>
                    <input type="submit" value="Сохранить" id="sumbitter" style="margin-left: 10px;">
                    <input type="submit" value="Удалить" id="deleter" style="margin-left: 10px;">
                </div>
            </div>
            
            <?php
        }
    }
}