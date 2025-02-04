<?php

/**
 * The main template file
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wedding_ceremony
 */

get_header();

$wedding_ceremony_column = get_theme_mod( 'wedding_ceremony_archive_column_layout', 'column-1' );
?>
<main id="primary" class="site-main">

	<?php

	if ( have_posts() ) :

		if ( is_home() && ! is_front_page() ) :

		endif;
		?>

		<div class="wedding-ceremony-archive-layout grid-layout <?php echo esc_attr( $wedding_ceremony_column ); ?>">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/content', get_post_format() );

            endwhile;
			?>
		</div>
		<?php
		do_action( 'wedding_ceremony_posts_pagination' );

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

</main><!-- #main -->

<?php
if ( wedding_ceremony_is_sidebar_enabled() ) {
	get_sidebar();
}

get_footer();