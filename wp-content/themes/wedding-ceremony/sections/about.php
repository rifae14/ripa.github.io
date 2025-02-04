<?php

if ( ! get_theme_mod( 'wedding_ceremony_enable_about_section', true ) ) {
    return;
}

$wedding_ceremony_slider_content_ids  = array();
$wedding_ceremony_slider_content_type = get_theme_mod( 'wedding_ceremony_about_content_type', 'post' );

$wedding_ceremony_slider_content_ids[] = get_theme_mod( 'wedding_ceremony_about_content_' . $wedding_ceremony_slider_content_type . '_' );

// Modify query to fetch posts from a specific category
$wedding_ceremony_about_args = array(
    'post_type'           => $wedding_ceremony_slider_content_type,
    'post__in'            => array_filter( $wedding_ceremony_slider_content_ids ),
    'orderby'             => 'post__in',
    'posts_per_page'      => 1,
    'ignore_sticky_posts' => true,
);


$wedding_ceremony_about_args = apply_filters( 'wedding_ceremony_about_section_args', $wedding_ceremony_about_args );

wedding_ceremony_render_about_section( $wedding_ceremony_about_args );

/**
 * Render about Section.
 */
function wedding_ceremony_render_about_section( $wedding_ceremony_about_args ) { ?>

    <section id="wedding_ceremony_about_section" class="about-section about-style-1">
        <?php
        if ( is_customize_preview() ) :
            wedding_ceremony_section_link( 'wedding_ceremony_about_section' );
        endif;
        ?>
        <div class="asterthemes-wrapper">
            <?php
            $query = new WP_Query( $wedding_ceremony_about_args );
            if ( $query->have_posts() ) :
                while ( $query->have_posts() ) :
                    $query->the_post();
                    $wedding_ceremony_additional_text = get_theme_mod( 'wedding_ceremony_additional_text_');
                    $wedding_ceremony_button_label = get_theme_mod( 'wedding_ceremony_about_button_label_');
                    $wedding_ceremony_button_link  = get_theme_mod( 'wedding_ceremony_about_button_link_');
                    $wedding_ceremony_about_us_left_heading = get_theme_mod( 'wedding_ceremony_about_us_left_heading');
                    $wedding_ceremony_about_us_left_text  = get_theme_mod( 'wedding_ceremony_about_us_left_text');
                    $wedding_ceremony_button_link  = ! empty( $wedding_ceremony_button_link ) ? $wedding_ceremony_button_link : get_the_permalink();
                    $wedding_ceremony_custom_image_url_3 = get_theme_mod('wedding_ceremony_custom_image_setting_3');
                    $wedding_ceremony_custom_image_url_4 = get_theme_mod('wedding_ceremony_custom_image_setting_4'); 


                    $has_featured_image = has_post_thumbnail();

                    // Check if only the default image will be displayed
                    ?>
                    <div class="about-single">
                        <div class="about-img">
                            <div class="about-left">
                                <?php if ( ! empty( $wedding_ceremony_about_us_left_heading ) || ! empty( $wedding_ceremony_about_us_left_text ) ) { ?>
                                    <div class="about-boxs">
                                        <?php if ( ! empty( $wedding_ceremony_about_us_left_heading ) ) { ?>
                                            <h4><?php echo esc_html( $wedding_ceremony_about_us_left_heading ); ?></h4>
                                        <?php } ?>
                                        <?php if ( ! empty( $wedding_ceremony_about_us_left_text ) ) { ?>
                                            <p><?php echo esc_html( $wedding_ceremony_about_us_left_text ); ?></p>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                               <?php if ( has_post_thumbnail() ) { ?>
                                    <?php the_post_thumbnail( 'full' ); ?>
                                <?php } else { ?>
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/resource/img/about-1.png' ); ?>" alt="Default Image">
                                <?php } ?>
                            </div>
                            <div class="about-right">
                                <?php if ($wedding_ceremony_custom_image_url_3) { ?>
                                    <img class="right-1" src="<?php echo esc_url( $wedding_ceremony_custom_image_url_3 ); ?>" alt="Custom Image 1">
                                <?php } else { ?>
                                    <img class="right-1" src="<?php echo esc_url( get_template_directory_uri() . '/resource/img/about-2.png' ); ?>" alt="Default Image 1">
                                <?php } ?>
                                <?php if ($wedding_ceremony_custom_image_url_4) { ?>
                                    <img class="right-2" src="<?php echo esc_url( $wedding_ceremony_custom_image_url_4 ); ?>" alt="Custom Image 2">
                                <?php } else { ?>
                                    <img class="right-2" src="<?php echo esc_url( get_template_directory_uri() . '/resource/img/about-3.png' ); ?>" alt="Default Image 1">
                                <?php } ?>
                    
                            </div>
                        </div>
                        <div class="about-caption">
                            <h2><?php echo esc_html( $wedding_ceremony_additional_text ); ?></h2>
                            <h1 class="about-caption-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h1>
                            <div class="caption-description">
                                <p>
                                    <?php echo wp_kses_post( wp_trim_words( get_the_content(), 50 ) ); ?>
                                </p>
                            </div>
                            <?php if ( ! empty( $wedding_ceremony_button_label ) ) { ?>
                                <div class="about-slider-btn">
                                    <a href="<?php echo esc_url( $wedding_ceremony_button_link ); ?>" class="asterthemes-button"><?php echo esc_html( $wedding_ceremony_button_label ); ?></a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </section>

    <?php
}
?>