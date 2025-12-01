<?php
/**
 * Template part for displaying single post content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Red_Graphic_Cambridge
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post-article'); ?>>
	
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-featured-image">
			<?php the_post_thumbnail('large'); ?>
		</div>
	<?php endif; ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		
		<div class="post-meta">
			<span class="post-date">
				<i class="fa-regular fa-calendar"></i>
				<?php echo get_the_date(); ?>
			</span>
			
			<span class="post-author">
				<i class="fa-regular fa-user"></i>
				<?php echo get_the_author(); ?>
			</span>
			
			<?php if ( has_category() ) : ?>
				<span class="post-categories">
					<i class="fa-solid fa-folder"></i>
					<?php the_category( ', ' ); ?>
				</span>
			<?php endif; ?>
			
			<?php if ( comments_open() || get_comments_number() ) : ?>
				<span class="post-comments-count">
					<i class="fa-regular fa-comment"></i>
					<?php 
					printf( 
						esc_html( _n( '%s Comment', '%s Comments', get_comments_number(), 'red-graphic-cambridge' ) ),
						number_format_i18n( get_comments_number() )
					);
					?>
				</span>
			<?php endif; ?>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'red-graphic-cambridge' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php if ( has_tag() ) : ?>
		<footer class="entry-footer">
			<div class="post-tags">
				<i class="fa-solid fa-tags"></i>
				<?php the_tags( '', ', ', '' ); ?>
			</div>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
	
</article><!-- #post-<?php the_ID(); ?> -->
