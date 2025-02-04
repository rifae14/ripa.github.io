<?php
if ( ! get_theme_mod( 'wedding_ceremony_enable_banner_section', true ) ) {
	return;
}

$wedding_ceremony_slider_content_ids  = array();
$wedding_ceremony_slider_content_type = get_theme_mod( 'wedding_ceremony_banner_slider_content_type', 'post' );

for ( $wedding_ceremony_i = 1; $wedding_ceremony_i <= 3; $wedding_ceremony_i++ ) {
	$wedding_ceremony_slider_content_ids[] = get_theme_mod( 'wedding_ceremony_banner_slider_content_' . $wedding_ceremony_slider_content_type . '_' . $wedding_ceremony_i );
}

// Modify query to fetch posts from a specific category
$wedding_ceremony_banner_slider_args = array(
	'post_type'           => $wedding_ceremony_slider_content_type,
	'post__in'            => array_filter( $wedding_ceremony_slider_content_ids ),
	'orderby'             => 'post__in',
	'posts_per_page'      => absint(3),
	'ignore_sticky_posts' => true,
);


$wedding_ceremony_banner_slider_args = apply_filters( 'wedding_ceremony_banner_section_args', $wedding_ceremony_banner_slider_args );

wedding_ceremony_render_banner_section( $wedding_ceremony_banner_slider_args );

/**
 * Render Banner Section.
 */
function wedding_ceremony_render_banner_section( $wedding_ceremony_banner_slider_args ) {     ?>

	<section id="wedding_ceremony_banner_section" class="banner-section banner-style-1">
		<?php
		if ( is_customize_preview() ) :
			wedding_ceremony_section_link( 'wedding_ceremony_banner_section' );
		endif;
		?>
		<div class="banner-section-wrapper">
			<?php
			$query = new WP_Query( $wedding_ceremony_banner_slider_args );
			if ( $query->have_posts() ) :
				?>
				<div class="asterthemes-banner-wrapper banner-slider wedding-ceremony-carousel-navigation" data-slick='{"autoplay": false }'>
					<?php
					$wedding_ceremony_i = 1;
					while ( $query->have_posts() ) :
						$query->the_post();
						$wedding_ceremony_banner_section_custom_image_1 = get_theme_mod( 'wedding_ceremony_banner_section_custom_image_1'.$wedding_ceremony_i);
						$wedding_ceremony_banner_section_custom_image_2  = get_theme_mod( 'wedding_ceremony_banner_section_custom_image_2'.$wedding_ceremony_i);
						$wedding_ceremony_button_label = get_theme_mod( 'wedding_ceremony_banner_button_label_'.$wedding_ceremony_i);
						$wedding_ceremony_button_link  = get_theme_mod( 'wedding_ceremony_banner_button_link_'.$wedding_ceremony_i);
						$wedding_ceremony_button_link  = ! empty( $wedding_ceremony_button_link ) ? $wedding_ceremony_button_link : get_the_permalink();
						?>
						<div class="banner-single-outer">
							<div class="banner-single asterthemes-wrapper">
								<div class="banner-caption">
									<div class="asterthemes-wrapper">
										<div class="banner-catption-main">
											<h1 class="banner-caption-title">
												<?php the_title(); ?>
											</h1>
											<div class="caption-description">
												<p>
													<?php echo wp_kses_post( wp_trim_words( get_the_content(), 25 ) ); ?>
												</p>
											</div>
											<?php if ( ! empty( $wedding_ceremony_button_label ) ) { ?>
												<div class="banner-slider-btn">
													<a href="<?php echo esc_url( $wedding_ceremony_button_link ); ?>" class="asterthemes-button"><?php echo esc_html( $wedding_ceremony_button_label ); ?></a>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
								<div class="banner-img">
									<div class="left-image">
										<div class="left-img-box">
										    <?php if ($wedding_ceremony_banner_section_custom_image_1) { ?>
										        <img src="<?php echo esc_url( $wedding_ceremony_banner_section_custom_image_1 ); ?>" alt="Custom Image 1">
										    <?php } else { ?>
										        <img src="<?php echo esc_url( get_template_directory_uri() . '/resource/img/slide-left-1.png' ); ?>" alt="Default Image 1">
										    <?php } ?>

										    <?php if ($wedding_ceremony_banner_section_custom_image_2) { ?>
										        <img src="<?php echo esc_url( $wedding_ceremony_banner_section_custom_image_2 ); ?>" alt="Custom Image 2">
										    <?php } else { ?>
										        <img src="<?php echo esc_url( get_template_directory_uri() . '/resource/img/slide-left-2.png' ); ?>" alt="Default Image 2">
										    <?php } ?>
										</div>
									</div>
									<div class="right-image">
										<?php if ( has_post_thumbnail() ) { ?>
										    <?php the_post_thumbnail( 'full' ); ?>
										<?php } else { ?>
										    <img src="<?php echo esc_url( get_template_directory_uri() . '/resource/img/default.png' ); ?>" alt="Default Image">
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
						<?php
						$wedding_ceremony_i++;
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<?php
			endif;
			?>
		</div>
	</section>

	<?php
}