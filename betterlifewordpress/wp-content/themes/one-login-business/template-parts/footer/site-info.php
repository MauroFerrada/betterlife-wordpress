<?php
/**
 * Displays footer site info
 *
 * @subpackage One Login Business
 * @since 1.0
 * @version 1.4
 */

?>
<div class="site-info">
    <?php
        echo esc_html( get_theme_mod( 'one_login_business_footer_copy' ) );
        printf(
            /* translators: %s: Business WordPress Theme. */
            '<a target="_blank" href="' . esc_attr__( 'https://www.ovationthemes.com/products/free-wordpress-business-theme/', 'one-login-business' ) . '"> %s</a>',
            esc_html__( 'Business WordPress Theme', 'one-login-business' )
        );
    ?>
</div>
