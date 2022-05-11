<?php get_header(); ?>

<div class="row-categorias container">
<?php get_template_part( 'template-parts/template-part', 'topnav' ); ?>

</div>


<?php get_template_part( 'template-parts/template-part', 'content' ); ?>

<?php get_template_part( 'content', 'single' ); ?>

<?php get_footer(); ?>
