<?php
/**
 *
 * Template name: Teplate page full
 * 
 */

get_header(); ?>

<div class="row-categorias container">
<?php get_template_part( 'template-parts/template-part', 'topnav' ); ?>
<?php bloglite_breadcrumb(); ?>
</div>

<div class="container-fluid interna">

<!-- start content container -->       
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>                          
				<div <?php post_class(); ?>>
					<div class="composer-main-content-page container">    
							<h1><?php the_title(); ?></h1>
							<?php the_content(); ?>                                                          
					</div>
				</div>        
			<?php endwhile; ?>        
		<?php else : ?>            
			<?php get_template_part( 'content', 'none' ); ?>        
		<?php endif; ?>    
<!-- end content container -->
<div class="container">
<h2>CONHEÇA TAMBÉM</h2>
<div class="colored-line-left"></div>
<div class="clear"></div>
<?php echo do_shortcode('[posts template="default-loop-post-conheca.php" posts_per_page="4" post_type="conheca" tax_term="5" order="asc"]'); ?>
</div>
<?php 
get_footer();

