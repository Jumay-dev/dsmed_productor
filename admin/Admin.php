<?php

class Admin
{
    public function __construct() {
        add_action( 'woocommerce_product_options_advanced', 'product_form' );
        function product_form() {
            global $product, $post;
            $product_id = $post->ID;
            
            ?>

            <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", () => {
                let productId = document.getElementById('product_id').value
                let productInfoNode = document.getElementById('product_info')
                let submitter= document.getElementById('sumbitter')

                let productInfo = ''

                productInfoNode.addEventListener('change', event => productInfo = event.target.value)

                submitter.addEventListener('click', event => {
                    event.preventDefault()
                    console.log('clicked')
                    console.log(productId)
                    console.log(productInfo)
                    if(productInfo !== "") {
                        fetch(`${window.location.origin}/?action=add_info&product_id=${productId}&product_info=${productInfo}`)
                    }
                })
            })
            </script>

            <form action="" id="productor_form">
                <input type="text" name="product_info" id="product_info" value=""/>
                <input type="hidden" name="product_id" value="<?= $product_id ?>" id="product_id"/>
                <input type="hidden" name="action" value="add_info" />
                <input type="submit" value="Сохранить" id="sumbitter">
            </form>
            
            <?php
        }
    }
}