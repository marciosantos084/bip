<div class="main-menu">
	<nav id="site-navigation" class="navbar navbar-default ">     
		<div class="container">   
			<div class="navbar-header">
				<?php if ( has_nav_menu( 'main_menu' ) ) : ?>
					<div id="main-menu-panel" class="open-panel" data-panel="main-menu-panel">
						<span></span>
						<span></span>
						<span></span>
					</div>
				<?php endif; ?>

			</div>  
			<?php
			wp_nav_menu( array(
				'theme_location'	 => 'main_menu',
				'depth'				 => 5,
				'container'			 => 'div',
				'container_class'	 => 'menu-container',
				'menu_class'		 => 'nav navbar navbar-left',
				'fallback_cb'		 => 'wp_bootstrap_navwalker::fallback',
				'walker'			 => new wp_bootstrap_navwalker(),
			) );
			?>
		</div>    
	</nav> 
</div>
<?php if ( has_header_image() && is_home() ) { ?>
	<div class="custom-header">

		<div class="custom-header-media">
			<?php the_custom_header_markup(); ?>
		</div>

		<div class="site-branding-text-header header-image-text">
			
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

			<?php
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) :
				?>
				<p class="site-description">
					<?php echo $description; ?>
				</p>
			<?php endif; ?>
			<?php do_action( 'bip_after_header_image_title' ); ?>
		</div><!-- .site-branding-text -->

	</div><!-- .custom-header -->
<?php } ?>