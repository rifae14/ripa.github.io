<?php

/**
 * Template part for displaying Video Format
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wedding_ceremony
 */

?>
<?php $wedding_ceremony_readmore = get_theme_mod( 'wedding_ceremony_readmore_button_text','Read More');?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mag-post-single">
        <?php
			// Get the post ID
			$wedding_ceremony_post_id = get_the_ID();

			// Check if there are videos embedded in the post content
			$wedding_ceremony_post = get_post($wedding_ceremony_post_id);
			$wedding_ceremony_content = do_shortcode(apply_filters('the_content', $wedding_ceremony_post->post_content));
			$wedding_ceremony_embeds = get_media_embedded_in_content($wedding_ceremony_content);

			if (!empty($wedding_ceremony_embeds)) {
			    // Loop through embedded media and display videos
			    foreach ($wedding_ceremony_embeds as $wedding_ceremony_embed) {
			        // Check if the embed code contains a video tag or specific video providers like YouTube or Vimeo
			        if (strpos($wedding_ceremony_embed, 'video') !== false || strpos($wedding_ceremony_embed, 'youtube') !== false || strpos($wedding_ceremony_embed, 'vimeo') !== false || strpos($wedding_ceremony_embed, 'dailymotion') !== false || strpos($wedding_ceremony_embed, 'vine') !== false || strpos($wedding_ceremony_embed, 'wordPress.tv') !== false || strpos($wedding_ceremony_embed, 'hulu') !== false) {
			            ?>
			            <div class="custom-embedded-video">
			                <div class="video-container">
			                    <?php echo $wedding_ceremony_embed; ?>
			                </div>
			                <div class="video-comments">
			                    <?php
			                    // Add your comments section here
			                    comments_template(); // This will include the default WordPress comments template
			                    ?>
			                </div>
			            </div>
			            <?php
			        }
			    }
			}
	    ?>
		<div class="mag-post-detail">
			<div class="mag-post-category">
				<?php wedding_ceremony_categories_list(); ?>
			</div>
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title mag-post-title">', '</h1>' );
			else :
				if ( get_theme_mod( 'wedding_ceremony_post_hide_post_heading', true ) ) { 
					the_title( '<h2 class="entry-title mag-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			    }
			endif;
			?>
			<div class="mag-post-meta">
				<?php
				wedding_ceremony_posted_by();
				wedding_ceremony_posted_on();
				?>
			</div>
			<?php if ( get_theme_mod( 'wedding_ceremony_post_hide_post_content', true ) ) { ?>
				<div class="mag-post-excerpt">
					<?php the_excerpt(); ?>
				</div>
		    <?php } ?>
			<div class="mag-post-read-more">
				<a href="<?php the_permalink(); ?>" class="read-more-button">
					<?php esc_html_e( 'Read More', 'wedding-ceremony' ); ?>
					<span class="dashicons dashicons-arrow-right"></span>
				</a>
			</div>
			<?php if ( get_theme_mod( 'wedding_ceremony_post_readmore_button', true ) === true ) : ?>
				<div class="mag-post-read-more">
					<a href="<?php the_permalink(); ?>" class="read-more-button">
						<?php if ( ! empty( $wedding_ceremony_readmore ) ) { ?> <?php echo esc_html( $wedding_ceremony_readmore ); ?> <?php } ?>
						<i class="<?php echo esc_attr( get_theme_mod( 'wedding_ceremony_readmore_btn_icon', 'fas fa-chevron-right' ) ); ?>"></i>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->