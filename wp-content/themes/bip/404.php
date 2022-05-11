<?php get_header(); ?>
<?php get_template_part( 'template-parts/template-part', 'content' ); ?>
<div class="row-categorias container">
<?php get_template_part( 'template-parts/template-part', 'topnav' ); ?>

</div> 
<!-- start content container -->
<div class="row align-self-center">
	<div class="col-md-<?php bip_main_content_width_columns(); ?>">
		<div class="main-content-page">
			<div class="error-template text-center">
				<h1>404<br><?php esc_html_e( 'OPA! ESSA PÁGINA NÃO PODE SER ENCONTRADA.', 'bip' ); ?></h1>
				<p class="error-details">
					<?php esc_html_e( 'Parece que nada foi encontrado neste local. Quer tentar uma pesquisa?', 'bip' ); ?>
				</p>
				<div class="error-actions">
					<?php get_search_form(); ?>    
				</div>
			</div>
		</div>
	</div>

	<?php get_sidebar( 'right' ); ?>

</div>
<!-- end content container -->

<?php get_footer(); ?>
