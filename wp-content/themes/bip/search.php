<?php get_header(); ?>
<?php bloglite_breadcrumb(); ?>
<div class="row-categorias container">
<?php get_template_part( 'template-parts/template-part', 'topnav' ); ?>

</div>
<?php echo do_shortcode('[posts template="default-loop-vitrine.php" post_type="vitrine" order="asc" orderby="title"]'); ?>
<?php get_template_part( 'template-parts/template-part', 'content' ); ?>
<!-- start content container -->
<div class="row">

    <div class="col-md-<?php bip_main_content_width_columns(); ?>">
		<?php
		// if this was a search we display a page header with the results count. If there were no results we display the search form.
		if ( is_search() ) :
			/* Translators: %s: Search result */ 
			echo "<h3>" . sprintf( esc_html__( 'Search Results for: %s', 'bip' ), get_search_query() ) . "</h3>";
			
		endif;

		if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				get_template_part( 'content', get_post_format() );


			endwhile;

			the_posts_pagination();

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
