<?php
/**
 * Getting Started Page.
 *
 * @package wedding_ceremony
 */


if( ! function_exists( 'wedding_ceremony_getting_started_menu' ) ) :
/**
 * Adding Getting Started Page in admin menu
 */
function wedding_ceremony_getting_started_menu(){	
	add_theme_page(
		__( 'Getting Started', 'wedding-ceremony' ),
		__( 'Getting Started', 'wedding-ceremony' ),
		'manage_options',
		'wedding-ceremony-getting-started',
		'wedding_ceremony_getting_started_page'
	);
}
endif;
add_action( 'admin_menu', 'wedding_ceremony_getting_started_menu' );

if( ! function_exists( 'wedding_ceremony_getting_started_admin_scripts' ) ) :
/**
 * Load Getting Started styles in the admin
 */
function wedding_ceremony_getting_started_admin_scripts( $hook ){
	// Load styles only on our page
	if( 'appearance_page_wedding-ceremony-getting-started' != $hook ) return;

    wp_enqueue_style( 'wedding-ceremony-getting-started', get_template_directory_uri() . '/resource/css/getting-started.css', false, WEDDING_CEREMONY_THEME_VERSION );

    wp_enqueue_script( 'wedding-ceremony-getting-started', get_template_directory_uri() . '/resource/js/getting-started.js', array( 'jquery' ), WEDDING_CEREMONY_THEME_VERSION, true );
}
endif;
add_action( 'admin_enqueue_scripts', 'wedding_ceremony_getting_started_admin_scripts' );

if( ! function_exists( 'wedding_ceremony_getting_started_page' ) ) :
/**
 * Callback function for admin page.
*/
function wedding_ceremony_getting_started_page(){ 
	$wedding_ceremony_theme = wp_get_theme();?>
	<div class="wrap getting-started">
		<div class="intro-wrap">
			<div class="intro cointaner">
				<div class="intro-content">
					<h3><?php echo esc_html( 'Welcome to', 'wedding-ceremony' );?> <span class="theme-name"><?php echo esc_html( WEDDING_CEREMONY_THEME_NAME ); ?></span></h3>
					<p class="about-text">
						<?php
						// Remove last sentence of description.
						$wedding_ceremony_description = explode( '. ', $wedding_ceremony_theme->get( 'Description' ) );

						$wedding_ceremony_description = implode( '. ', $wedding_ceremony_description );

						echo esc_html( $wedding_ceremony_description . '' );
					?></p>
					<div class="btns-getstart">
						<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>"target="_blank" class="button button-primary"><?php esc_html_e( 'Customize', 'wedding-ceremony' ); ?></a>
						<a class="button button-primary" href="<?php echo esc_url( 'https://wordpress.org/support/theme/wedding-ceremony/reviews/#new-post' ); ?>" title="<?php esc_attr_e( 'Visit the Review', 'wedding-ceremony' ); ?>" target="_blank">
							<?php esc_html_e( 'Review', 'wedding-ceremony' ); ?>
						</a>
						<a class="button button-primary" href="<?php echo esc_url( 'https://wordpress.org/support/theme/wedding-ceremony' ); ?>" title="<?php esc_attr_e( 'Visit the Support', 'wedding-ceremony' ); ?>" target="_blank">
							<?php esc_html_e( 'Contact Support', 'wedding-ceremony' ); ?>
						</a>
					</div>
					<div class="btns-wizard">
						<a class="wizard" href="<?php echo esc_url( admin_url( 'themes.php?page=weddingceremony-wizard' ) ); ?>"target="_blank" class="button button-primary"><?php esc_html_e( 'One Click Demo Setup', 'wedding-ceremony' ); ?></a>
					</div>
				</div>
				<div class="intro-img">
					<img src="<?php echo esc_url(get_template_directory_uri()) .'/screenshot.png'; ?>" />
				</div>
				
			</div>
		</div>

		<div class="cointaner panels">
			<ul class="inline-list">
				<li class="current">
                    <a id="help" href="javascript:void(0);">
                        <?php esc_html_e( 'Getting Started', 'wedding-ceremony' ); ?>
                    </a>
                </li>
				<li>
                    <a id="free-pro-panel" href="javascript:void(0);">
                        <?php esc_html_e( 'Free Vs Pro', 'wedding-ceremony' ); ?>
                    </a>
                </li>
			</ul>
			<div id="panel" class="panel">
				<?php require get_template_directory() . '/theme-library/getting-started/tabs/help-panel.php'; ?>
				<?php require get_template_directory() . '/theme-library/getting-started/tabs/free-vs-pro-panel.php'; ?>
				<?php require get_template_directory() . '/theme-library/getting-started/tabs/link-panel.php'; ?>
			</div>
		</div>
	</div>
	<?php
}
endif;