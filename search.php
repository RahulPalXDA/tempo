<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Red_Graphic_Cambridge
 */

get_header();
?>
<section class="search-result">
	<div class="custom-container">
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<h1 class="page-title">
					<?php printf( esc_html__( 'Search Results for: %s', 'red-graphic-cambridge' ), '<span>' . get_search_query() . '</span>' ); ?>
				</h1>
			</header>
			<div class="search-result-wrap">
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="search-item">
						<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                        <?php 
                        $snippet = red_graphic_cambridge_get_search_snippet( get_the_ID(), get_search_query() );
                        if ( $snippet ) : ?>
                            <div class="search-snippet"><?php echo $snippet; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
                        <?php endif; ?>
						<a href="<?php the_permalink(); ?>" class="view-page">View</a>
					</div>
				<?php endwhile; ?>
			</div>
		<?php else : ?>
			<p class="no-result-found">Nothing Found</p>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
