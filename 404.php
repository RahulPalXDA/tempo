<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Red_Graphic_Cambridge
 */

get_header();
?>
<section class="error-404 not-found">
	<div class="custom-container">
		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'red-graphic-cambridge' ); ?></h1>
		</header>
		<div class="page-content">
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'red-graphic-cambridge' ); ?></p>
			<a href="<?php echo esc_url(site_url('/')); ?>" class="backToHome">Back to Home</a>
		</div>
	</div>
</section>
<?php
get_footer();
