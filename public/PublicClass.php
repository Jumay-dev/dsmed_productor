<?php

class PublicClass
{
    public function __construct() {
        if( ! function_exists( 'woodmart_hover_image' ) ) {
            add_action("mu_plugin_loaded", "woodmart_hover_image");

            function woodmart_hover_image() {
                global $product, $wpdb;
                $product_id = $product->get_id();
                $prefix = $wpdb->get_blog_prefix();
                $table_name = $prefix . 'dsmed_productor';

                $res = $wpdb->get_row("SELECT info FROM $table_name WHERE product_id = $product_id");

                $sentences = array();

                if ($res) {
                    $sentences = explode(';', $res->info);
                }

                $hover_image = '';
        
                if( $hover_image != '' && woodmart_get_opt( 'hover_image' ) ): ?>
                    <div class="hover-img">
                        <a href="<?php echo esc_url( get_permalink() ); ?>">
                            <?php echo woodmart_get_product_thumbnail( 'woocommerce_thumbnail', $attachment_ids[0] ); ?>
                        </a>
                    </div>
                <?php endif;

                if( $hover_image == '' && $res): ?>
                    <div class="hover-img" id="hover-container" style="transition: none !important">
                        <a  href="<?php echo esc_url( get_permalink() ); ?>">
                            <div id="plank__container">
                                <?php
                                foreach($sentences as $one) {
                                    ?>
                                        <div class="plank">
                                            <?= $one ?>
                                        </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </a>
                    </div>
                <?php endif;
            }
        }

        add_action( 'wp_enqueue_scripts', 'switchOffPlanksIfTooSmall' );

        function switchOffPlanksIfTooSmall() {
            ?>
                <script>
                    document.addEventListener("DOMContentLoaded",() => {
                        let containers = document.getElementsByClassName('hover-img')
                        for (let nodeIndex = 0; nodeIndex < containers.length; nodeIndex++) {
                            let currentStyles = getComputedStyle(containers[nodeIndex])
                            let width = currentStyles.width
                            let realWidth = +width.replace('px', "")
                            console.log(realWidth)
                            if (realWidth < 200) {
                                containers[nodeIndex].style.display = "none"
                            }
                        }
                    })
                </script>
            <?php
        }
    }
}