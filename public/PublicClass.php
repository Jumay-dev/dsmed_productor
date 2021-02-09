<?php

class PublicClass
{
    public function __construct() {
        if( ! function_exists( 'woodmart_hover_image' ) ) {
            add_action("mu_plugin_loaded", "woodmart_hover_image");

            function woodmart_hover_image() {
                global $product;
            
                // $attachment_ids = $product->get_gallery_image_ids();
        
                $hover_image = '';
        
                // if ( ! empty( $attachment_ids[0] ) ) {
                //     $hover_image = woodmart_get_product_thumbnail( 'woocommerce_thumbnail', $attachment_ids[0] );
                // }
        
                if( $hover_image != '' && woodmart_get_opt( 'hover_image' ) ): ?>
                    <div class="hover-img">
                        <a href="<?php echo esc_url( get_permalink() ); ?>">
                            <?php echo woodmart_get_product_thumbnail( 'woocommerce_thumbnail', $attachment_ids[0] ); ?>
                        </a>
                    </div>
                <?php endif;

                if( $hover_image == ''): ?>
                    <div class="hover-img">
                        <a href="<?php echo esc_url( get_permalink() ); ?>">
                            <table>
                                <tr>
                                    <td>Длина: </td>
                                    <td>100</td>
                                </tr>
                                <tr>
                                    <td>Ширина: </td>
                                    <td>200</td>
                                </tr>
                                <tr>
                                    <td>Высота: </td>
                                    <td>300</td>
                                </tr>
                            </table>
                        </a>
                    </div>
                <?php endif;
            }
        }
    }
}