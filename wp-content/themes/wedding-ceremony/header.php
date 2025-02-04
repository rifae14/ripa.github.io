<?php

/**
 * The header for our theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wedding_ceremony
 */
$wedding_ceremony_menu_text_transform = get_theme_mod( 'menu_text_transform', 'capitalize' );
$wedding_ceremony_menu_text_transform_css = ( $wedding_ceremony_menu_text_transform !== 'capitalize' ) ? 'text-transform: ' . $wedding_ceremony_menu_text_transform . ';' : '';
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(get_theme_mod('wedding_ceremony_website_layout', false) ? 'site-boxed--layout' : ''); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site asterthemes-site-wrapper">
<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'wedding-ceremony' ); ?></a>
<?php if (get_theme_mod('wedding_ceremony_enable_preloader', false)) : ?>
    <div id="loader" class="<?php echo esc_attr(get_theme_mod('wedding_ceremony_preloader_style', 'style1')); ?>">
        <div class="loader-container">
            <div id="preloader">
                <?php 
                $preloader_style = get_theme_mod('wedding_ceremony_preloader_style', 'style1');
                if ($preloader_style === 'style1') : ?>
                    <!-- STYLE 1 -->
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/resource/loader.gif'); ?>" alt="<?php esc_attr_e('Loading...', 'wedding-ceremony'); ?>">
                <?php elseif ($preloader_style === 'style2') : ?>
                    <!-- STYLE 2 -->
                    <div class="dot"></div>
                <?php elseif ($preloader_style === 'style3') : ?>
                    <!-- STYLE 3 -->
                    <div class="bars">
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<header id="masthead" class="site-header">
           <div class="header-main-wrapper">
                <?php if ( get_theme_mod( 'wedding_ceremony_enable_topbar', false ) === true ) {
                    $wedding_ceremony_phone_topbar_number = get_theme_mod( 'wedding_ceremony_phone_topbar_number', '' );
                    $wedding_ceremony_email_topbar_address = get_theme_mod( 'wedding_ceremony_email_topbar_address', '' );

                    $wedding_ceremony_facebook_topbar_link = get_theme_mod( 'wedding_ceremony_facebook_topbar_link', '' );
                    $wedding_ceremony_twitter_topbar_link = get_theme_mod( 'wedding_ceremony_twitter_topbar_link', '' );
                    $wedding_ceremony_pintrest_topbar_link = get_theme_mod( 'wedding_ceremony_pintrest_topbar_link', '' );
                    $wedding_ceremony_youtube_topbar_link = get_theme_mod( 'wedding_ceremony_youtube_topbar_link', '' );
                    $wedding_ceremony_instagram_topbar_link = get_theme_mod( 'wedding_ceremony_instagram_topbar_link', '' );

                    $wedding_ceremony_wishlist_button_link  = get_theme_mod( 'wedding_ceremony_wishlist_button_link_');

                ?>
            <div class="top-header-part">
                <div class="asterthemes-wrapper">
                    <div class="bottom-header-part-wrapper">
                        <div class="header-contact-inner">
                            <?php if ( ! empty( $wedding_ceremony_phone_topbar_number ) ) { ?>
                                <span><i class="<?php echo esc_attr(get_theme_mod('wedding_ceremony_Call_header_icon','fas fa-phone')); ?>"></i><?php echo esc_html( substr( $wedding_ceremony_phone_topbar_number, 0, 21 ) ); ?></span>
                            <?php } ?>
                            <?php if ( ! empty( $wedding_ceremony_email_topbar_address ) ) { ?>
                                <span><i class="<?php echo esc_attr(get_theme_mod('wedding_ceremony_address_icon','fas fa-envelope')); ?>"></i><?php echo esc_html( $wedding_ceremony_email_topbar_address ); ?></span>
                            <?php } ?>
                        </div>

                        <?php if ( get_theme_mod( 'wedding_ceremony_enable_social', true ) === true ) { ?>
                            <div class="header-social-inner">
                                <?php if ( ! empty( $wedding_ceremony_facebook_topbar_link ) ) { ?>
                                    <a href="<?php echo esc_url( $wedding_ceremony_facebook_topbar_link ); ?>"><i class="<?php echo esc_attr(get_theme_mod('wedding_ceremony_facebook_icon','fab fa-facebook-f')); ?>"></i></a>
                                <?php } ?>
                                <?php if ( ! empty( $wedding_ceremony_twitter_topbar_link ) ) { ?>
                                    <a href="<?php echo esc_url( $wedding_ceremony_twitter_topbar_link ); ?>"><i class="<?php echo esc_attr(get_theme_mod('wedding_ceremony_twitter_icon','fab fa-twitter')); ?>"></i></a>
                                <?php } ?>
                                <?php if ( ! empty( $wedding_ceremony_pintrest_topbar_link ) ) { ?>
                                    <a href="<?php echo esc_url( $wedding_ceremony_pintrest_topbar_link ); ?>"><i class="<?php echo esc_attr(get_theme_mod('wedding_ceremony_pintrest_icon','fab fa-pinterest-p')); ?>"></i></a>
                                <?php } ?>
                                <?php if ( ! empty( $wedding_ceremony_youtube_topbar_link ) ) { ?>
                                    <a href="<?php echo esc_url( $wedding_ceremony_youtube_topbar_link ); ?>"><i class="<?php echo esc_attr(get_theme_mod('wedding_ceremony_youtube_icon','fab fa-youtube')); ?>"></i></a>
                                <?php } ?>
                                <?php if ( ! empty( $wedding_ceremony_instagram_topbar_link ) ) { ?>
                                    <a href="<?php echo esc_url( $wedding_ceremony_instagram_topbar_link ); ?>"><i class="<?php echo esc_attr(get_theme_mod('wedding_ceremony_instagram_icon','fab fa-instagram')); ?>"></i></a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="bottom-header-outer-wrapper">
            <div class="bottom-header-part">
                <div class="asterthemes-wrapper">
                    <div class="bottom-header-part-wrapper hello <?php echo esc_attr( get_theme_mod( 'wedding_ceremony_enable_sticky_header', false ) ? 'sticky-header' : '' ); ?>">
                        <div class="bottom-header-left-part">
                            <div class="site-branding">
                                <?php
                                // Check if the 'Enable Site Logo' setting is true.
                                if ( get_theme_mod( 'wedding_ceremony_enable_site_logo', true ) ) {
                                    if ( has_custom_logo() ) { ?>
                                        <div class="site-logo">
                                            <?php the_custom_logo(); ?>
                                        </div>
                                    <?php } 
                                } ?>
                                <div class="site-identity">
                                    <?php
                                    $wedding_ceremony_site_title_size = get_theme_mod('wedding_ceremony_site_title_size', 30);

                                    if (get_theme_mod('wedding_ceremony_enable_site_title_setting', true)) {
                                        if (is_front_page() && is_home()) : ?>
                                            <h1 class="site-title" style="font-size: <?php echo esc_attr($wedding_ceremony_site_title_size); ?>px;">
                                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                                            </h1>
                                        <?php else : ?>
                                            <p class="site-title" style="font-size: <?php echo esc_attr($wedding_ceremony_site_title_size); ?>px;">
                                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                                            </p>
                                        <?php endif;
                                    }

                                    if (get_theme_mod('wedding_ceremony_enable_tagline_setting', false)) :
                                        $wedding_ceremony_description = get_bloginfo('description', 'display');
                                        if ($wedding_ceremony_description || is_customize_preview()) : ?>
                                            <p class="site-description"><?php echo esc_html($wedding_ceremony_description); ?></p>
                                        <?php endif;
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="navigation-menus">
                            <div class="asterthemes-wrapper">
                                <div class="navigation-part">
                                    <nav id="site-navigation" class="main-navigation">
                                        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </button>
                                        <div class="main-navigation-links" style="<?php echo esc_attr( $wedding_ceremony_menu_text_transform_css ); ?>">
                                            <?php
                                                wp_nav_menu(
                                                    array(
                                                        'theme_location' => 'primary',
                                                    )
                                                );
                                            ?>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <?php if ( get_theme_mod( 'wedding_ceremony_enable_search', false ) === true ) { ?>
                            <div class="bottom-header-middle-part">
                                <?php if(class_exists('woocommerce')){ ?>
                                    <form method="get" class="woocommerce-product-search woo-pro-search" action="<?php echo esc_url(home_url('/')); ?>">
                                        <label class="screen-reader-text" for="woocommerce-product-search-field"><?php esc_html_e('Search for:', 'wedding-ceremony'); ?></label>
                                        <input type="search" id="woocommerce-product-search-field" class="search-field " placeholder="<?php echo esc_attr('Search Here','wedding-ceremony'); ?>" value="<?php echo get_search_query(); ?>" name="s"/>
                                        <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
                                        <input type="hidden" name="post_type" value="product"/>
                                    </form>
                                <?php }?>
                            </div>
                        <?php }?>
                        <div class="bottom-header-right-part nav-box">
                            <?php if(class_exists('woocommerce')){ ?>
                                <div class="user-account">
                                    <?php if ( is_user_logged_in() ) { ?>
                                        <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('My Account','wedding-ceremony'); ?>"><i class="fas fa-sign-out-alt"></i></a>
                                    <?php } 
                                    else { ?>
                                        <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('Login / Register','wedding-ceremony'); ?>"><i class="fas fa-user"></i></a>
                                    <?php } ?>
                                </div>
                            <?php }?>
                             <?php if ( ! empty( $wedding_ceremony_wishlist_button_link ) ) { ?>
                                <a href="<?php echo esc_url( $wedding_ceremony_wishlist_button_link ); ?>"><i class="<?php echo esc_attr(get_theme_mod('wedding_ceremony_wishlist_button_icon','fas fa-heart')); ?>"></i></a>
                            <?php }?>
                            <?php if ( class_exists( 'woocommerce' ) ) {?>
                                <a class="cart-customlocation" href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>" title="<?php esc_attr_e( 'View Shopping Cart','wedding-ceremony' ); ?>"><i class="fas fa-shopping-basket mr-2"></i></a>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>      
    </div>
</header>
    <?php
    if ( ! is_front_page() || is_home() ) {
	if ( is_front_page() ) {
		require get_template_directory() . '/sections/sections.php';
		wedding_ceremony_homepage_sections();
	}
	?>
    <?php
        if (!is_front_page() || is_home()) {
            get_template_part('page-header');
        }
    ?>
	<div id="content" class="site-content">
		<div class="asterthemes-wrapper">
			<div class="asterthemes-page">
			<?php } ?>
