<?php
/**
 * The template for displaying all single posts
 *
 * @package Wedding Elegance
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php
while ( have_posts() ) :
	the_post();
	?>

<main <?php post_class( 'site-main' ); ?> role="main" id="main_content">
	<header class="page-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
	<div class="page-content">
		<?php the_content(); ?>
		<div class="post-tags">
			<?php the_tags( '<span class="tag-links">' . __( 'Tagged ', 'wedding-elegance' ), null, '</span>' ); ?>
		</div>
		<?php wp_link_pages(); ?>
	</div>

	<?php comments_template(); ?>
</main>

	<?php
endwhile;
