<?php
/**
 * The template for displaying the footer
 * 
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wedding_ceremony
 */

// Get the footer background color/image settings from customizer
$wedding_ceremony_footer_background_color = get_theme_mod('footer_background_color_setting'); // Default to white if not set
$wedding_ceremony_footer_background_image = get_theme_mod('footer_background_image_setting');

if (!is_front_page() || is_home()) {
    ?>
    </div>
    </div>
</div>
<?php } ?>

<footer id="colophon" class="site-footer" style="background-color: <?php echo esc_attr($wedding_ceremony_footer_background_color); ?>; <?php echo ($wedding_ceremony_footer_background_image) ? 'background-image: url(' . esc_url($wedding_ceremony_footer_background_image) . ');' : ''; ?>">
    <div class="site-footer-top">
        <div class="asterthemes-wrapper">
            <div class="footer-widgets-wrapper">

                <?php
                // Footer Widget
                do_action('wedding_ceremony_footer_widget');
                ?>

            </div>
        </div>
    </div>
    <div class="site-footer-bottom">
        <div class="asterthemes-wrapper">
            <div class="site-footer-bottom-wrapper">
                <div class="site-info">
                    <?php
                    do_action('wedding_ceremony_footer_copyright');
                    ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php
$wedding_ceremony_is_scroll_top_active = get_theme_mod( 'wedding_ceremony_scroll_top', true );
if ( $wedding_ceremony_is_scroll_top_active ) :
    $wedding_ceremony_scroll_shape = esc_attr( get_theme_mod( 'wedding_ceremony_scroll_top_shape', 'box' ) );
    $wedding_ceremony_scroll_position = esc_attr( get_theme_mod( 'wedding_ceremony_scroll_top_position', 'bottom-right' ) );
    $wedding_ceremony_scroll_btn_icon = esc_attr( get_theme_mod( 'wedding_ceremony_scroll_btn_icon', 'fas fa-chevron-up' ) );
    ?>
    <style>
        #scroll-to-top {
            position: fixed;
            <?php
            switch ( $wedding_ceremony_scroll_position ) {
                case 'bottom-left':
                    echo esc_attr( 'bottom: 25px; left: 20px;' );
                    break;
                case 'bottom-center':
                    echo esc_attr( 'bottom: 25px; left: 50%; transform: translateX(-50%);' );
                    break;
                default: // 'bottom-right'
                    echo esc_attr( 'bottom: 25px; right: 90px;' );
            }
            ?>
        }
    </style>
    <a href="#" id="scroll-to-top" class="wedding-ceremony-scroll-to-top <?php echo $wedding_ceremony_scroll_shape; ?>">
        <i class="<?php echo $wedding_ceremony_scroll_btn_icon; ?>"></i>
    </a>
<?php
endif;
?>
</div>
<?php wp_footer(); ?>

</body>

</html>