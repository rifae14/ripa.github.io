<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package wedding_ceremony
 */

function wedding_ceremony_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	$classes[] = wedding_ceremony_sidebar_layout();

	return $classes;
}
add_filter( 'body_class', 'wedding_ceremony_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function wedding_ceremony_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'wedding_ceremony_pingback_header' );


/**
 * Get all posts for customizer Post content type.
 */
function wedding_ceremony_get_post_choices() {
	$wedding_ceremony_choices = array( '' => esc_html__( '--Select--', 'wedding-ceremony' ) );
	$wedding_ceremony_args    = array( 'numberposts' => -1 );
	$wedding_ceremony_posts   = get_posts( $wedding_ceremony_args );

	foreach ( $wedding_ceremony_posts as $post ) {
		$id             = $post->ID;
		$wedding_ceremony_title          = $post->post_title;
		$wedding_ceremony_choices[ $id ] = $wedding_ceremony_title;
	}

	return $wedding_ceremony_choices;
}

/**
 * Get all pages for customizer Page content type.
 */
function wedding_ceremony_get_page_choices() {
	$wedding_ceremony_choices = array( '' => esc_html__( '--Select--', 'wedding-ceremony' ) );
	$wedding_ceremony_pages   = get_pages();

	foreach ( $wedding_ceremony_pages as $page ) {
		$wedding_ceremony_choices[ $page->ID ] = $page->post_title;
	}

	return $wedding_ceremony_choices;
}

/**
 * Get all categories for customizer Category content type.
 */
function wedding_ceremony_get_post_cat_choices() {
	$wedding_ceremony_choices = array( '' => esc_html__( '--Select--', 'wedding-ceremony' ) );
	$wedding_ceremony_cats    = get_categories();

	foreach ( $wedding_ceremony_cats as $cat ) {
		$wedding_ceremony_choices[ $cat->term_id ] = $cat->name;
	}

	return $wedding_ceremony_choices;
}

/**
 * Get all donation forms for customizer form content type.
 */
function wedding_ceremony_get_post_donation_form_choices() {
	$wedding_ceremony_choices = array( '' => esc_html__( '--Select--', 'wedding-ceremony' ) );
	$wedding_ceremony_posts   = get_posts(
		array(
			'post_type'   => 'give_forms',
			'numberposts' => -1,
		)
	);
	foreach ( $wedding_ceremony_posts as $post ) {
		$wedding_ceremony_choices[ $post->ID ] = $post->post_title;
	}
	return $wedding_ceremony_choices;
}

if ( ! function_exists( 'wedding_ceremony_excerpt_length' ) ) :
	/**
	 * Excerpt length.
	 */
	function wedding_ceremony_excerpt_length( $wedding_ceremony_length ) {
		if ( is_admin() ) {
			return $wedding_ceremony_length;
		}

		return get_theme_mod( 'wedding_ceremony_excerpt_length', 20 );
	}
endif;
add_filter( 'excerpt_length', 'wedding_ceremony_excerpt_length', 999 );

if ( ! function_exists( 'wedding_ceremony_excerpt_more' ) ) :
	/**
	 * Excerpt more.
	 */
	function wedding_ceremony_excerpt_more( $wedding_ceremony_more ) {
		if ( is_admin() ) {
			return $wedding_ceremony_more;
		}

		return '&hellip;';
	}
endif;
add_filter( 'excerpt_more', 'wedding_ceremony_excerpt_more' );

if ( ! function_exists( 'wedding_ceremony_sidebar_layout' ) ) {
	/**
	 * Get sidebar layout.
	 */
	function wedding_ceremony_sidebar_layout() {
		$wedding_ceremony_sidebar_position      = get_theme_mod( 'wedding_ceremony_sidebar_position', 'right-sidebar' );
		$wedding_ceremony_sidebar_position_post = get_theme_mod( 'wedding_ceremony_post_sidebar_position', 'right-sidebar' );
		$wedding_ceremony_sidebar_position_page = get_theme_mod( 'wedding_ceremony_page_sidebar_position', 'right-sidebar' );

		if ( is_single() ) {
			$wedding_ceremony_sidebar_position = $wedding_ceremony_sidebar_position_post;
		} elseif ( is_page() ) {
			$wedding_ceremony_sidebar_position = $wedding_ceremony_sidebar_position_page;
		}

		return $wedding_ceremony_sidebar_position;
	}
}

if ( ! function_exists( 'wedding_ceremony_is_sidebar_enabled' ) ) {
	/**
	 * Check if sidebar is enabled.
	 */
	function wedding_ceremony_is_sidebar_enabled() {
		$wedding_ceremony_sidebar_position      = get_theme_mod( 'wedding_ceremony_sidebar_position', 'right-sidebar' );
		$wedding_ceremony_sidebar_position_post = get_theme_mod( 'wedding_ceremony_post_sidebar_position', 'right-sidebar' );
		$wedding_ceremony_sidebar_position_page = get_theme_mod( 'wedding_ceremony_page_sidebar_position', 'right-sidebar' );

		$wedding_ceremony_sidebar_enabled = true;
		if ( is_home() || is_archive() || is_search() ) {
			if ( 'no-sidebar' === $wedding_ceremony_sidebar_position ) {
				$wedding_ceremony_sidebar_enabled = false;
			}
		} elseif ( is_single() ) {
			if ( 'no-sidebar' === $wedding_ceremony_sidebar_position || 'no-sidebar' === $wedding_ceremony_sidebar_position_post ) {
				$wedding_ceremony_sidebar_enabled = false;
			}
		} elseif ( is_page() ) {
			if ( 'no-sidebar' === $wedding_ceremony_sidebar_position || 'no-sidebar' === $wedding_ceremony_sidebar_position_page ) {
				$wedding_ceremony_sidebar_enabled = false;
			}
		}
		return $wedding_ceremony_sidebar_enabled;
	}
}

if ( ! function_exists( 'wedding_ceremony_get_homepage_sections ' ) ) {
	/**
	 * Returns homepage sections.
	 */
	function wedding_ceremony_get_homepage_sections() {
		$wedding_ceremony_sections = array(
			'banner'  => esc_html__( 'Banner Section', 'wedding-ceremony' ),
			'about' => esc_html__( 'About Us Section', 'wedding-ceremony' ),
		);
		return $wedding_ceremony_sections;
	}
}

/**
 * Renders customizer section link
 */
function wedding_ceremony_section_link( $wedding_ceremony_section_id ) {
	$wedding_ceremony_section_name      = str_replace( 'wedding_ceremony_', ' ', $wedding_ceremony_section_id );
	$wedding_ceremony_section_name      = str_replace( '_', ' ', $wedding_ceremony_section_name );
	$wedding_ceremony_starting_notation = '#';
	?>
	<span class="section-link">
		<span class="section-link-title"><?php echo esc_html( $wedding_ceremony_section_name ); ?></span>
	</span>
	<style type="text/css">
		<?php echo $wedding_ceremony_starting_notation . $wedding_ceremony_section_id; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>:hover .section-link {
			visibility: visible;
		}
	</style>
	<?php
}

/**
 * Adds customizer section link css
 */
function wedding_ceremony_section_link_css() {
	if ( is_customize_preview() ) {
		?>
		<style type="text/css">
			.section-link {
				visibility: hidden;
				background-color: black;
				position: relative;
				top: 80px;
				z-index: 99;
				left: 40px;
				color: #fff;
				text-align: center;
				font-size: 20px;
				border-radius: 10px;
				padding: 20px 10px;
				text-transform: capitalize;
			}

			.section-link-title {
				padding: 0 10px;
			}

			.banner-section {
				position: relative;
			}

			.banner-section .section-link {
				position: absolute;
				top: 100px;
			}
		</style>
		<?php
	}
}
add_action( 'wp_head', 'wedding_ceremony_section_link_css' );

/**
 * Breadcrumb.
 */
function wedding_ceremony_breadcrumb( $wedding_ceremony_args = array() ) {
	if ( ! get_theme_mod( 'wedding_ceremony_enable_breadcrumb', true ) ) {
		return;
	}

	$wedding_ceremony_args = array(
		'show_on_front' => false,
		'show_title'    => true,
		'show_browse'   => false,
	);
	breadcrumb_trail( $wedding_ceremony_args );
}
add_action( 'wedding_ceremony_breadcrumb', 'wedding_ceremony_breadcrumb', 10 );

/**
 * Add separator for breadcrumb trail.
 */
function wedding_ceremony_breadcrumb_trail_print_styles() {
	$wedding_ceremony_breadcrumb_separator = get_theme_mod( 'wedding_ceremony_breadcrumb_separator', '/' );

	$style = '
		.trail-items li::after {
			content: "' . $wedding_ceremony_breadcrumb_separator . '";
		}'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	$style = apply_filters( 'wedding_ceremony_breadcrumb_trail_inline_style', trim( str_replace( array( "\r", "\n", "\t", '  ' ), '', $style ) ) );

	if ( $style ) {
		echo "\n" . '<style type="text/css" id="breadcrumb-trail-css">' . $style . '</style>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
add_action( 'wp_head', 'wedding_ceremony_breadcrumb_trail_print_styles' );

/**
 * Pagination for archive.
 */
function wedding_ceremony_render_posts_pagination() {
	$wedding_ceremony_is_pagination_enabled = get_theme_mod( 'wedding_ceremony_enable_pagination', true );
	if ( $wedding_ceremony_is_pagination_enabled ) {
		$wedding_ceremony_pagination_type = get_theme_mod( 'wedding_ceremony_pagination_type', 'default' );
		if ( 'default' === $wedding_ceremony_pagination_type ) :
			the_posts_navigation();
		else :
			the_posts_pagination();
		endif;
	}
}
add_action( 'wedding_ceremony_posts_pagination', 'wedding_ceremony_render_posts_pagination', 10 );

/**
 * Pagination for single post.
 */
function wedding_ceremony_render_post_navigation() {
	the_post_navigation(
		array(
			'prev_text' => '<span>&#10229;</span> <span class="nav-title">%title</span>',
			'next_text' => '<span class="nav-title">%title</span> <span>&#10230;</span>',
		)
	);
}
add_action( 'wedding_ceremony_post_navigation', 'wedding_ceremony_render_post_navigation' );

/**
 * Adds footer copyright text.
 */

function wedding_ceremony_output_footer_copyright_content() {
    $wedding_ceremony_theme_data = wp_get_theme();
    $wedding_ceremony_copyright_text = get_theme_mod('wedding_ceremony_footer_copyright_text');

    if (!empty($wedding_ceremony_copyright_text)) {
        $wedding_ceremony_text = $wedding_ceremony_copyright_text;
    } else {
    	$wedding_ceremony_default_text = '<a href="'. esc_url(__('https://asterthemes.com/products/free-wedding-ceremony-wordpress-theme','wedding-ceremony')) . '" target="_blank"> ' . esc_html($wedding_ceremony_theme_data->get('Name')) . '</a>' . '&nbsp;' . esc_html__('by', 'wedding-ceremony') . '&nbsp;<a target="_blank" href="' . esc_url($wedding_ceremony_theme_data->get('AuthorURI')) . '">' . esc_html(ucwords($wedding_ceremony_theme_data->get('Author'))) . '</a>';
		/* translators: %s: WordPress.org URL */
		$wedding_ceremony_default_text .= sprintf(esc_html__(' | Powered by %s', 'wedding-ceremony'), '<a href="' . esc_url(__('https://wordpress.org/', 'wedding-ceremony')) . '" target="_blank">WordPress</a>. ');
        $wedding_ceremony_text = $wedding_ceremony_default_text;
    }
    ?>
    <span><?php echo wp_kses_post($wedding_ceremony_text); ?></span>
    <?php
}
add_action('wedding_ceremony_footer_copyright', 'wedding_ceremony_output_footer_copyright_content');

if ( ! function_exists( 'wedding_ceremony_footer_widget' ) ) :
	function wedding_ceremony_footer_widget() {
		$wedding_ceremony_footer_widget_column = get_theme_mod('wedding_ceremony_footer_widget_column','4');

		$wedding_ceremony_column_class = '';
		if ($wedding_ceremony_footer_widget_column == '1') {
			$wedding_ceremony_column_class = 'one-column';
		} elseif ($wedding_ceremony_footer_widget_column == '2') {
			$wedding_ceremony_column_class = 'two-columns';
		} elseif ($wedding_ceremony_footer_widget_column == '3') {
			$wedding_ceremony_column_class = 'three-columns';
		} else {
			$wedding_ceremony_column_class = 'four-columns';
		}
	
		if($wedding_ceremony_footer_widget_column !== ''): 
		?>
		<div class="dt_footer-widgets <?php echo esc_attr($wedding_ceremony_column_class); ?>">
			<div class="footer-widgets-column">
				<?php
				$footer_widgets_active = false;

				// Loop to check if any footer widget is active
				for ($i = 1; $i <= $wedding_ceremony_footer_widget_column; $i++) {
					if (is_active_sidebar('wedding-ceremony-footer-widget-' . $i)) {
						$footer_widgets_active = true;
						break;
					}
				}

				if ($footer_widgets_active) {
					// Display active footer widgets
					for ($i = 1; $i <= $wedding_ceremony_footer_widget_column; $i++) {
						if (is_active_sidebar('wedding-ceremony-footer-widget-' . $i)) : ?>
							<div class="footer-one-column">
								<?php dynamic_sidebar('wedding-ceremony-footer-widget-' . $i); ?>
							</div>
						<?php endif;
					}
				} else {
				?>
				<div class="footer-one-column default-widgets">
					<aside id="search-2" class="widget widget_search default_footer_search">
						<div class="widget-header">
							<h4 class="widget-title"><?php esc_html_e('Search Here', 'wedding-ceremony'); ?></h4>
						</div>
						<?php get_search_form(); ?>
					</aside>
				</div>
				<div class="footer-one-column default-widgets">
					<aside id="recent-posts-2" class="widget widget_recent_entries">
						<h2 class="widget-title"><?php esc_html_e('Recent Posts', 'wedding-ceremony'); ?></h2>
						<ul>
							<?php
							$recent_posts = wp_get_recent_posts(array(
								'numberposts' => 5,
								'post_status' => 'publish',
							));
							foreach ($recent_posts as $post) {
								echo '<li><a href="' . esc_url(get_permalink($post['ID'])) . '">' . esc_html($post['post_title']) . '</a></li>';
							}
							wp_reset_query();
							?>
						</ul>
					</aside>
				</div>
				<div class="footer-one-column default-widgets">
					<aside id="recent-comments-2" class="widget widget_recent_comments">
						<h2 class="widget-title"><?php esc_html_e('Recent Comments', 'wedding-ceremony'); ?></h2>
						<ul>
							<?php
							$recent_comments = get_comments(array(
								'number' => 5,
								'status' => 'approve',
							));
							foreach ($recent_comments as $comment) {
								echo '<li><a href="' . esc_url(get_comment_link($comment)) . '">' .
									/* translators: %s: details. */
									sprintf(esc_html__('Comment on %s', 'wedding-ceremony'), get_the_title($comment->comment_post_ID)) .
									'</a></li>';
							}
							?>
						</ul>
					</aside>
				</div>
				<div class="footer-one-column default-widgets">
					<aside id="calendar-2" class="widget widget_calendar">
						<h2 class="widget-title"><?php esc_html_e('Calendar', 'wedding-ceremony'); ?></h2>
						<?php get_calendar(); ?>
					</aside>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php
		endif;
	}
	endif;
add_action( 'wedding_ceremony_footer_widget', 'wedding_ceremony_footer_widget' );

function wedding_ceremony_footer_text_transform_css() {
    $wedding_ceremony_footer_text_transform = get_theme_mod('footer_text_transform', 'none');
    ?>
    <style type="text/css">
        .site-footer h4,footer#colophon h2.wp-block-heading,footer#colophon .widgettitle,footer#colophon .widget-title {
            text-transform: <?php echo esc_html($wedding_ceremony_footer_text_transform); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'wedding_ceremony_footer_text_transform_css');

/**
 * GET START FUNCTION
 */

function wedding_ceremony_getpage_css($hook) {
	wp_enqueue_script( 'wedding-ceremony-admin-script', get_template_directory_uri() . '/resource/js/wedding-ceremony-admin-notice-script.js', array( 'jquery' ) );
    wp_localize_script( 'wedding-ceremony-admin-script', 'wedding_ceremony_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
    wp_enqueue_style( 'wedding-ceremony-notice-style', get_template_directory_uri() . '/resource/css/notice.css' );
}

add_action( 'admin_enqueue_scripts', 'wedding_ceremony_getpage_css' );


add_action('wp_ajax_wedding_ceremony_dismissable_notice', 'wedding_ceremony_dismissable_notice');
function wedding_ceremony_switch_theme() {
    delete_user_meta(get_current_user_id(), 'wedding_ceremony_dismissable_notice');
}
add_action('after_switch_theme', 'wedding_ceremony_switch_theme');
function wedding_ceremony_dismissable_notice() {
    update_user_meta(get_current_user_id(), 'wedding_ceremony_dismissable_notice', true);
    die();
}

function wedding_ceremony_deprecated_hook_admin_notice() {
    global $pagenow;
    
    // Check if the current page is the one where you don't want the notice to appear
    if ( $pagenow === 'themes.php' && isset( $_GET['page'] ) && $_GET['page'] === 'wedding-ceremony-getting-started' ) {
        return;
    }

    $dismissed = get_user_meta( get_current_user_id(), 'wedding_ceremony_dismissable_notice', true );
    if ( !$dismissed) { ?>
        <div class="getstrat updated notice notice-success is-dismissible notice-get-started-class">
            <div class="at-admin-content" >
                <h2><?php esc_html_e('Welcome to Wedding Ceremony', 'wedding-ceremony'); ?></h2>
                <p><?php _e('Explore the features of our Pro Theme and take your Dental journey to the next level.', 'wedding-ceremony'); ?></p>
                <p ><?php _e('Get Started With Theme By Clicking On Getting Started.', 'wedding-ceremony'); ?><p>
                <div style="display: flex; justify-content: center;">
                    <a class="admin-notice-btn button button-primary button-hero" href="<?php echo esc_url( admin_url( 'themes.php?page=wedding-ceremony-getting-started' )); ?>"><?php esc_html_e( 'Get started', 'wedding-ceremony' ) ?></a>
                    <a  class="admin-notice-btn button button-primary button-hero" target="_blank" href="https://demo.asterthemes.com/wedding-ceremony"><?php esc_html_e('View Demo', 'wedding-ceremony') ?></a>
                    <a  class="admin-notice-btn button button-primary button-hero" target="_blank" href="https://asterthemes.com/products/ceremony-wordpress-theme"><?php esc_html_e('Buy Now', 'wedding-ceremony') ?></a>
                    <a  class="admin-notice-btn button button-primary button-hero" target="_blank" href="https://demo.asterthemes.com/docs/wedding-ceremony-free/"><?php esc_html_e('Free Doc', 'wedding-ceremony') ?></a>
                </div>
            </div>
            <div class="at-admin-image">
                <img style="width: 100%;max-width: 320px;line-height: 40px;display: inline-block;vertical-align: top;border: 2px solid #ddd;border-radius: 4px;" src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/screenshot.png'; ?>" />
            </div>
        </div>
    <?php }
}

add_action( 'admin_notices', 'wedding_ceremony_deprecated_hook_admin_notice' );


//Admin Notice For Getstart
function wedding_ceremony_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}
