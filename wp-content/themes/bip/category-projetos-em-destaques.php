<?php get_header(); ?> 

<div class="row-categorias container">
<?php get_template_part( 'template-parts/template-part', 'topnav' ); ?>

</div>
<?php echo do_shortcode('[posts template="default-loop-vitrine-interna.php" post_type="vitrine-interna" tax_term="8" order="asc"]'); ?>

<?php get_template_part( 'template-parts/template-part', 'content' ); ?>
<!-- start content container -->
<div class="row row-interna">

	<div class="col-md-<?php bip_main_content_width_columns(); ?> row-postlist">
		<?php
		if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				get_template_part( 'content', get_post_format() );

			endwhile;

			//the_posts_pagination();

		else :

			get_template_part( 'content', 'none' );

		endif;
		?>
		
	</div>

	<?php get_sidebar( 'right' ); ?>

</div>
<h2>CONHEÇA TAMBÉM</h2>
<div class="colored-line-left"></div>
<div class="clear"></div>
<?php echo do_shortcode('[posts template="default-loop-post-conheca.php" posts_per_page="4" post_type="conheca" tax_term="5" order="asc"]'); ?>
<!-- end content container -->

<?php get_footer(); ?>
