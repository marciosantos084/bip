<?php get_header(); ?>

<div class="row-categorias container">
<?php get_template_part( 'template-parts/template-part', 'topnav' ); ?>

</div>

<?php echo do_shortcode('[posts template="default-loop-vitrine.php" post_type="vitrine" order="asc" orderby="title"]'); ?>

<?php get_template_part( 'template-parts/template-part', 'content' ); ?>
<div class="row row-interna">                            
<h1><?php the_title(); ?></h1>

<!-- start content container -->

<?php get_template_part( 'content', 'page' ); ?>
</div>
<!-- end content container -->
<h2>CONHEÇA TAMBÉM</h2>
<div class="colored-line-left"></div>
<div class="clear"></div>
<?php echo do_shortcode('[posts template="default-loop-post-conheca.php" posts_per_page="4" post_type="conheca" tax_term="5" order="asc"]'); ?>
<!-- end content container -->
<?php get_footer(); ?>
