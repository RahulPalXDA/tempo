<?php 
/**
 * Template Name: Page Sections Template
 */
get_header(); ?>
<?php if( have_rows('content') ): ?>
    <?php while ( have_rows('content') ) : the_row(); ?>
        <?php 
            if( get_row_layout() == 'banner_section' ): 
                $background_image = get_sub_field('background_image');
                $text_1 = get_sub_field('text_1');
                $button = get_sub_field('button');
                $heading = get_sub_field('heading');
                $items = get_sub_field('items');
                $text_2 = get_sub_field('text_2');
        ?>
            <section class="hero-banner" style="background: url(<?php echo $background_image; ?>) no-repeat; background-size: cover; background-position: center;">
                <div class="custom-container">
                    <div class="hero-inner-banner">
                        <?php if(!empty($text_1) || !empty($button)): ?>
                        <div class="content-box">
                            <?php if(!empty($text_1)){ ?>
                            <div class="content-inner">
                                <?php echo $text_1; ?>
                            </div>
                            <?php } ?>
                            <?php 
                                if(!empty($button)){ 
                                    $button_url = $button['url'];
                                    $button_title = $button['title'];
                                    $button_target = $button['target'] ? $button['target'] : '_self';
                            ?>
                            <div class="hero-buttons">
                                <a href="<?php echo esc_url( $button_url ); ?>" target="<?php echo esc_attr( $button_target ); ?>" class="global-light-button"><span><i class="fa-solid fa-location-dot"></i> <?php echo esc_html( $button_title ); ?></span></a>
                            </div>
                            <?php } ?>
                        </div>
                        <?php endif; ?>
                        <?php
                            if (!$heading) $heading = get_field('garden_heading', 'option');
                            if (!$items)   $items   = get_field('garden_items', 'option');
                            if (!$text_2)  $text_2  = get_field('garden_text', 'option');
                            get_template_part(
                                'template-parts/garden-timing',
                                null,
                                [
                                    'heading' => $heading,
                                    'items'   => $items,
                                    'text_2'  => $text_2
                                ]
                            );
                        ?>
                    </div>
                </div>
            </section>
        <?php 
            elseif( get_row_layout() == 'zigzag_structure_1' ):
                $items = get_sub_field('items');
        ?>
            <section class="zigzac-image-content">
                <div class="custom-container">
                    <?php 
                        if(!empty($items)): 
                            foreach($items as $item): 
                                $image = $item['image'];
                                $title = $item['title'];
                                $content = $item['content'];
                    ?>
                    <div class="row">
                        <div class="col-xl-7 col-lg-7 col-md-8 col-sm-12">
                            <div class="content-box">
                                <?php echo !empty($title) ? '<h2>' . $title . '</h2>' : ''; ?>
                                <div class="devider">
                                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/leaf-icon.png" alt="Red Graphic Cambridge">
                                </div>
                                <?php echo !empty($content) ? '<p>' . $content . '</p>' : ''; ?>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-4 col-sm-12">
                            <?php 
                                if(!empty($image)){
                                    echo red_graphic_cambridge_get_acf_image([
                                        'acf' => $image,
                                        'wrapper_start' => '<div class="image-box">',
                                        'wrapper_end'   => '</div>',
                                    ]);
                                }
                            ?>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>                    
                </div>
            </section>
        <?php
            elseif( get_row_layout() == 'news_and_updates' ):
                $heading = get_sub_field('heading');
                $limit = get_sub_field('limit');
                $class = get_sub_field('class');
        ?>
            <section class="news-outer brder-top <?php echo $class; ?>">
                <div class="custom-container">
                    <?php if(!empty($heading)){ ?>
                    <div class="global-header">
                        <h2><?php echo $heading; ?></h2>
                    </div>
                    <?php } ?>
                    <?php 
                        $limit = isset($limit) && !empty($limit) ? intval($limit) : -1;
                        $posts = get_posts([
                            'post_type'      => 'post',
                            'posts_per_page' => $limit,
                            'orderby'        => 'date',
                            'order'          => 'DESC',
                        ]);
                    ?>
                    <div class="row">
                        <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                <a class="news-item" href="<?php the_permalink(); ?>">
                                    <?php 
                                        if ( has_post_thumbnail($post->ID) ) {
                                            $img_url = get_the_post_thumbnail_url($post->ID, 'medium');
                                            $thumb_id = get_post_thumbnail_id(get_the_ID());
                                            $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                                            echo '<img src="' . esc_url($img_url) . '" alt="' . $alt . '">';
                                        }

                                        $terms = get_the_terms( $post->ID, 'article-type' );
                                        $tag_name = !empty($terms) ? esc_html($terms[0]->name) : '';
                                        echo $tag_name ? '<span class="new-tag">' . $tag_name . '</span>' : '';
                                    ?>
                                    <div class="new-title">
                                        <h4><?php echo get_the_title(); ?></h4>
                                        <span>
                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/white-leaf.png" alt="Red Graphic Cambridge">
                                        </span>
                                    </div>
                                    <div class="overlay"></div>
                                </a>
                            </div>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                </div>
            </section>
        <?php
            elseif( get_row_layout() == 'content_box_full_width' ):
                $class = get_sub_field('class');
                $content = get_sub_field('content');
        ?>
            <section class="rgc_content_box_full_width <?php echo $class; ?>">
                <div class="custom-container">
                    <?php echo $content; ?>
                </div>
            </section>
        <?php
            elseif( get_row_layout() == 'content_box_left_right' ):
                $class = get_sub_field('class');
                $left_content = get_sub_field('left_content');
                $right_content = get_sub_field('right_content');
        ?>
            <section class="rgc_content_box_two_col <?php echo $class; ?>">
                <div class="custom-container">
                    <div class="lrContentWrap d-flex">
                        <?php 
                            echo !empty($left_content) ? '<div class="leftContent">' . $left_content . '</div>' : '';
                            echo !empty($right_content) ? '<div class="rightContent">' . $right_content . '</div>' : '';
                        ?>
                    </div>
                </div>
            </section>
        <?php
            elseif( get_row_layout() == 'image_box' ):
                $image = get_sub_field('image');
                $class = get_sub_field('class');
        ?>
            <section class="rgc_image_box <?php echo $class; ?>">
                <div class="custom-container">
                    <?php 
                        if(!empty($image)){
                            echo red_graphic_cambridge_get_acf_image([
                                'acf' => $image,
                            ]);
                        }
                    ?>
                </div>
            </section>
        <?php
            elseif( get_row_layout() == 'divider' ):
        ?>
<section class="rgc_divider">
                <div class="custom-container">
                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/leaf-icon.png" alt="Red Graphic Cambridge">
		    <span class="devider-border"></span>
                </div>
            </section>
        <?php
            elseif( get_row_layout() == 'blank_space' ):
                $margin = get_sub_field('margin');
        ?>
            <section class="rgc_blank_space" style="margin-bottom:<?php echo $margin ?>px;"></section>
        <?php
            elseif( get_row_layout() == 'image_gallery' ):
                $gallery_items = get_sub_field('gallery');
                $lightbox = get_sub_field('lightbox');
                $column = get_sub_field('column');
                $column_class = ($column == "4") ? "col-md-3" : "col-md-4";
                $class = get_sub_field('class');
        ?>
            <section class="rgc_gallery_lightbox <?php echo $class; ?>">
                <div class="custom-container">
                    <div class="row">
                        <?php $g=0; foreach($gallery_items as $image): ?>
                        <div class="<?php echo $column_class; ?>">
                            <div class="gallery-thumb<?php echo $lightbox ? ' rgcEnabledLightBox' : ''; ?>"<?php if($lightbox){ ?> data-bs-toggle="modal" data-bs-target="#lightboxModal" data-index="<?php echo $g; ?>"<?php } ?>>
                                <?php 
                                    if(!empty($image)){
                                        echo red_graphic_cambridge_get_acf_image([
                                            'acf' => $image,
                                            'class'   => 'img-fluid',
                                        ]);
                                    }
                                ?>
                            </div>
                        </div>
                        <?php $g++; endforeach; ?>
                    </div>
                </div>
            </section>
            <?php if($lightbox){ ?>
                <div class="modal fade" id="lightboxModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content bg-transparent border-0">
                            <div class="modal-body p-0 position-relative">
                                <button type="button" class="btn btn-sm btn-light position-absolute top-0 end-0 m-3 zindex-tooltip" data-bs-dismiss="modal" aria-label="Close">✕</button>
                                <div id="lightboxCarousel" class="carousel slide" data-bs-ride="false">
                                    <div class="carousel-inner">
                                        <?php $g1=1; foreach($gallery_items as $image): ?>
                                        <div class="carousel-item<?php echo ($g1 == 1) ? ' active' : ''; ?>">
                                            <?php 
                                                if(!empty($image)){
                                                    echo red_graphic_cambridge_get_acf_image([
                                                        'acf' => $image,
                                                        'class'   => 'd-block w-100',
                                                    ]);
                                                }
                                            ?>
                                        </div>
                                        <?php $g1++; endforeach; ?>
                                    </div>

                                    <!-- Controls -->
                                    <button class="carousel-control-prev" type="button" data-bs-target="#lightboxCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#lightboxCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>

<script>
jQuery(function($) {

    var $modalEl = $('#lightboxModal');
    var $carouselEl = $('#lightboxCarousel');
    var carouselInstance = null;

    // When modal opens
    $modalEl.on('shown.bs.modal', function(e) {

        // Create carousel instance if not yet created
        if (!carouselInstance) {
            carouselInstance = bootstrap.Carousel.getOrCreateInstance($carouselEl[0], {
                interval: false,
                keyboard: true,
                wrap: true
            });
        }

        // If clicked thumbnail has data-index, move to that slide
        var trigger = $(e.relatedTarget);
        if (trigger.length && trigger.data('index') !== undefined) {
            var idx = parseInt(trigger.data('index'), 10) || 0;
            carouselInstance.to(idx);
        }
    });

    // Clicking thumbnails (even when modal already open)
    $('.gallery-thumb').on('click', function() {
        var idx = parseInt($(this).data('index'), 10) || 0;

        // If modal open → just change slide
        if ($modalEl.hasClass('show')) {
            if (!carouselInstance) {
                carouselInstance = bootstrap.Carousel.getOrCreateInstance($carouselEl[0], {
                    interval: false
                });
            }
            carouselInstance.to(idx);
        }
        // If modal closed → normal Bootstrap modal trigger works
    });

    // Pause carousel when modal closes
    $modalEl.on('hidden.bs.modal', function() {
        if (carouselInstance) {
            carouselInstance.pause();
        }
    });

});
</script>

<?php get_footer(); ?>