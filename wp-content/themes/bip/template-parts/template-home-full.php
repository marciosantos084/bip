<?php
/**
 *
 * Template name: Teplate Home
 * 
 */

get_header(); ?>

<div class="row-categorias container">
<?php get_template_part( 'template-parts/template-part', 'topnav' ); ?>

</div>
<?php echo do_shortcode('[posts template="default-loop-vitrine.php" post_type="vitrine" order="asc" orderby="title"]'); ?>
<div class="container-fluid">
<!-- start content container -->       
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>                          
				<div <?php post_class(); ?>>
					<div class="composer-main-content-page container">                                                         
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

