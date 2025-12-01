<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Red_Graphic_Cambridge
 */

get_header();
?>

<section class="single-post-wrapper">
	<div class="custom-container">
		<main id="primary" class="site-main">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'single' );

				// Post navigation
				?>
				<div class="post-navigation-wrapper">
					<?php
					the_post_navigation(
						array(
							'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous Post', 'red-graphic-cambridge' ) . '</span> <span class="nav-title">%title</span>',
							'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next Post', 'red-graphic-cambridge' ) . '</span> <span class="nav-title">%title</span>',
						)
					);
					?>
				</div>
				<?php

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div>
</section>

<?php
get_footer();
