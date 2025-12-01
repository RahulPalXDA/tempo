<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Red_Graphic_Cambridge
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<!-- Top bar start-->
<section class="top-bar-sec">
	<div class="custom-container">
		<?php 
			$header_button = get_field('header_button', 'option');
			$header_logo = get_field('header_logo', 'option');
			$header_social_links = get_field('header_social_links', 'option');			
		?>
		<?php 
			if ( !empty($header_button) ) {
				echo red_graphic_cambridge_get_link_button([
					'acf'     => $header_button,
					'class'   => 'global-dark-button',
					'wrapper' => '<span>',
				]);
			}
		?>
		<div class="top-bar-wrapper">
			<?php echo !empty($header_logo) ? '<div class="tp-logo-part"><a href="' . site_url('/') . '">' . red_graphic_cambridge_get_acf_image(["acf" => $header_logo]) . '</a></div>' : ''; ?>
			<ul>
				<li>
					<form role="search" action="<?php echo site_url('/'); ?>" method="get">
						<div class="header-search-box" style="position:relative;">
							<input type="search" 
								id="header-search-input"
								class="form-control"
								placeholder="<?php echo esc_attr__('Search...', 'textdomain'); ?>" 
								name="s"
								autocomplete="off"
								value="<?php echo get_search_query(); ?>">

							<button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>

							<!-- Autocomplete suggestions -->
							<div id="search-suggestions" 
								style="position:absolute; top:100%; left:0; right:0; background:#fff; border:1px solid #ddd; z-index:999; display:none;">
							</div>
						</div>
					</form>
				</li>
				<?php 
					if(!empty($header_social_links)){
						render_social_links( $header_social_links );
					}
				?>
			</ul>
		</div>
	</div>
</section>
<!-- Top bar end-->
<!-- top navbar start -->
<nav class="top-navbar navbar navbar-expand-lg" id="topNavBar">
	<div class="custom-container">
		<?php echo !empty($header_logo) ? '<a class="navbar-brand top-logo-part" href="' . site_url('/') . '">' . red_graphic_cambridge_get_acf_image(["acf" => $header_logo]) . '</a>' : ''; ?>
		<button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
			data-bs-target="#navbar-content">
			<div class="hamburger-toggle">
				<div class="hamburger">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>
		</button>
		<div class="collapse navbar-collapse" id="navbar-content">
			<div class="only_mobile_view">
				<?php echo !empty($header_logo) ? '<div class="mobile_logo"><a href="' . site_url('/') . '">' . red_graphic_cambridge_get_acf_image(["acf" => $header_logo]) . '</a></div>' : ''; ?>
				<button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
					data-bs-target="#navbar-content">
					<div class="hamburger-toggle">
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/close-btn.png" alt="Red Graphic Cambridge">
					</div>
				</button>
			</div>
			<?php
				wp_nav_menu( array(
					'theme_location'  => 'menu-1',
					'container'       => false,
					'menu_class'      => 'navbar-nav',
					'fallback_cb'     => false,
					'walker'          => new Custom_Menu_Walker(),
				) );
			?>
		</div>
	</div>
</nav>
<!-- top navbar end -->