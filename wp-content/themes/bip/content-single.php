<!-- start content container -->
<?php bloglite_breadcrumb(); ?>
<div class="row">      
	<article class="col-md-<?php bip_main_content_width_columns(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="">
				<?php the_post_thumbnail( 'full' ); ?>
			</div>
		<?php endif; ?>
		<header class="container">

			<div class="categoria-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>">
				<?php $categories = get_the_category();
				if ( ! empty( $categories ) ) {
					echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '"><span>' . esc_html( $categories[0]->name ) . '</span></a>';
				}?>
				<!-- Print a link to this category -->

			</div>
			<h1>                                
				<?php the_title(); ?>                          
			</h1>
			<?php do_action( 'bip_after_post_meta' ); ?>
		</header>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>                         
			<div <?php post_class(); ?>>
				<div class="single-content"> 
					<div class="single-entry-summary">
						<?php the_content(); ?> 
					</div><!-- .single-entry-summary -->
					<?php wp_link_pages(); ?>                                                           
				</div>
				<div class="single-footer row">
					<div class="">
						<?php comments_template(); ?> 
					</div>
				</div>
			</div>        
			<?php endwhile; ?>        
			<?php else : ?>            
			<?php get_template_part( 'content', 'none' ); ?>        
		<?php endif; ?>   
		<div class="content-bottom-post">
			<div class="float-left tag-style"><?php the_tags(); ?></div>
			<div class="float-right"><label class="shared">Share: </label><?php echo do_shortcode( '[addthis tool = "addthis_inline_share_toolbox_x6np"]' ); ?></div>	
		</div>
		<div class="clear"></div>

		<?php the_post_navigation( array(
			'prev_text' => __( '<svg version="1.1" id="nav-prev-post" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
				 y="0px" viewBox="0 0 5.8 10.6" style="enable-background:new 0 0 5.8 10.6;height: 15px;position: relative;top: 2px;" xml:space="preserve">
			<style type="text/css">
				.nav-prev{fill:none;stroke:#ffffff;stroke-width:1.2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
			</style>
			<path class="nav-prev" d="M5.1,9.9L0.9,5.7c-0.2-0.2-0.2-0.6,0-0.8l4.2-4.2"/>
			</svg> publicação mais recente' ),
						'next_text' => __( 'publicação anterior <svg version="1.1" id="nav-prev-post" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 viewBox="0 0 11.8 21.1" style="enable-background:new 0 0 11.8 21.1;height: 15px;position: relative;top: 3px;" xml:space="preserve">
			<style type="text/css">
				.nav-next{fill:none;stroke:#ffffff;stroke-width:2.4;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
			</style>
				<path class="nav-next" d="M1.8,1.6L10,9.8c0.4,0.4,0.4,1.1,0,1.5l-8.2,8.3"/>
				</svg>' ),
		) ); ?>	
		<div class="clear"></div>
		<div class="content-relacionados">
			<div class="loop-relacionados">

			
			<!-- conheça tbm cases -->
 
        <?php
        // get the custom post type's taxonomy terms
          
        $custom_taxterms = wp_get_object_terms( $post->ID, 'category', array('fields' => 'ids') );
 
        $args = array(
            'post_type' => 'case',
            'post_status' => 'publish',
            'posts_per_page' => 3, // you may edit this number
            'orderby' => 'rand',
            'post__not_in' => array ( $post->ID ),
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'id',
                    'terms' => $custom_taxterms
                )
            )
        );
		
		
        $related_items = new WP_Query( $args );
        // loop over query
        if ( $related_items->have_posts() ) : ?>
 
            <h4>Você também pode gostar</h4>
			<div class="colored-line-left"></div>
			<div class="clear"></div>
				<div class="loop-post-relacionados">
 
            <?php while ( $related_items->have_posts() ) : $related_items->the_post(); ?>
             
                <div id="su-post-<?php the_ID(); ?>" class="item">
				<div  class="bloco-foto">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php 
						if ( has_post_thumbnail() ) {
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
							if ( ! empty( $large_image_url[0] ) ) {
								//echo '<a href="' . esc_url( $large_image_url[0] ) . '" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '">';
								echo get_the_post_thumbnail( $post->ID, 'thumbnail' ); 
								echo '</a>';
							} 
						}
						?>
					</a>
				</div>
				<div class="categoria-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>">
					<?php $categories = get_the_category();
					if ( ! empty( $categories ) ) {
						echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '"><span>' . esc_html( $categories[0]->name ) . '</span></a>';
					}?>
					<!-- Print a link to this category -->
				</div>
				<div class="loop-content">
					<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
					<a  class="saiba-mais-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>" href="<?php the_permalink(); ?>">
				<svg version="1.1" id="layer-<?php the_ID(); ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 11.8 21.1" style="enable-background:new 0 0 11.8 21.1;" xml:space="preserve">

				<path class="saiba-mais-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>" d="M1.8,1.6L10,9.8c0.4,0.4,0.4,1.1,0,1.5l-8.2,8.3"/>
				</svg> Saiba mais
			</a>
				</div>

			</div>
 
            <?php endwhile; ?>

 
        <?php endif;
        // Reset Post Data
        wp_reset_postdata();
        ?> 
  
  <!-- conheça tbm conheca -->
  <?php
        // get the custom post type's taxonomy terms
          
        $custom_taxterms = wp_get_object_terms( $post->ID, 'category', array('fields' => 'ids') );
 
        $args = array(
            'post_type' => 'conheca',
            'post_status' => 'publish',
            'posts_per_page' => 3, // you may edit this number
            'orderby' => 'rand',
            'post__not_in' => array ( $post->ID ),
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'id',
                    'terms' => $custom_taxterms
                )
            )
        );
		
		
        $related_items = new WP_Query( $args );
        // loop over query
        if ( $related_items->have_posts() ) : ?>
 
            <h4>Você também pode gostar</h4>
			<div class="colored-line-left"></div>
			<div class="clear"></div>
				<div class="loop-post-relacionados">
 
            <?php while ( $related_items->have_posts() ) : $related_items->the_post(); ?>
             
                <div id="su-post-<?php the_ID(); ?>" class="item">
				<div  class="bloco-foto">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php 
						if ( has_post_thumbnail() ) {
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
							if ( ! empty( $large_image_url[0] ) ) {
								//echo '<a href="' . esc_url( $large_image_url[0] ) . '" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '">';
								echo get_the_post_thumbnail( $post->ID, 'thumbnail' ); 
								echo '</a>';
							} 
						}
						?>
					</a>
				</div>
				<div class="categoria-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>">
					<?php $categories = get_the_category();
					if ( ! empty( $categories ) ) {
						echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '"><span>' . esc_html( $categories[0]->name ) . '</span></a>';
					}?>
					<!-- Print a link to this category -->
				</div>
				<div class="loop-content">
					<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
					<a  class="saiba-mais-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>" href="<?php the_permalink(); ?>">
				<svg version="1.1" id="layer-<?php the_ID(); ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 11.8 21.1" style="enable-background:new 0 0 11.8 21.1;" xml:space="preserve">

				<path class="saiba-mais-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>" d="M1.8,1.6L10,9.8c0.4,0.4,0.4,1.1,0,1.5l-8.2,8.3"/>
				</svg> Saiba mais
			</a>
				</div>

			</div>
 
            <?php endwhile; ?>

 
        <?php endif;
        // Reset Post Data
        wp_reset_postdata();
        ?> 
		<!-- conheça tbm comunicado -->
		
		<?php
        // get the custom post type's taxonomy terms
          
        $custom_taxterms = wp_get_object_terms( $post->ID, 'category', array('fields' => 'ids') );
 
        $args = array(
            'post_type' => 'comunicado',
            'post_status' => 'publish',
            'posts_per_page' => 3, // you may edit this number
            'orderby' => 'rand',
            'post__not_in' => array ( $post->ID ),
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'id',
                    'terms' => $custom_taxterms
                )
            )
        );
		
		
        $related_items = new WP_Query( $args );
        // loop over query
        if ( $related_items->have_posts() ) : ?>
 
            <h4>Você também pode gostar</h4>
			<div class="colored-line-left"></div>
			<div class="clear"></div>
				<div class="loop-post-relacionados">
 
            <?php while ( $related_items->have_posts() ) : $related_items->the_post(); ?>
             
                <div id="su-post-<?php the_ID(); ?>" class="item">
				<div  class="bloco-foto">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php 
						if ( has_post_thumbnail() ) {
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
							if ( ! empty( $large_image_url[0] ) ) {
								//echo '<a href="' . esc_url( $large_image_url[0] ) . '" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '">';
								echo get_the_post_thumbnail( $post->ID, 'thumbnail' ); 
								echo '</a>';
							} 
						}
						?>
					</a>
				</div>
				<div class="categoria-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>">
					<?php $categories = get_the_category();
					if ( ! empty( $categories ) ) {
						echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '"><span>' . esc_html( $categories[0]->name ) . '</span></a>';
					}?>
					<!-- Print a link to this category -->
				</div>
				<div class="loop-content">
					<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
					<a  class="saiba-mais-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>" href="<?php the_permalink(); ?>">
				<svg version="1.1" id="layer-<?php the_ID(); ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 11.8 21.1" style="enable-background:new 0 0 11.8 21.1;" xml:space="preserve">

				<path class="saiba-mais-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>" d="M1.8,1.6L10,9.8c0.4,0.4,0.4,1.1,0,1.5l-8.2,8.3"/>
				</svg> Saiba mais
			</a>
				</div>

			</div>
 
            <?php endwhile; ?>

 
        <?php endif;
        // Reset Post Data
        wp_reset_postdata();
        ?> 
		<!-- conheça tbm post -->
		
		<?php
        // get the custom post type's taxonomy terms
          
        $custom_taxterms = wp_get_object_terms( $post->ID, 'category', array('fields' => 'ids') );
 
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 3, // you may edit this number
            'orderby' => 'rand',
            'post__not_in' => array ( $post->ID ),
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'id',
                    'terms' => $custom_taxterms
                )
            )
        );
		
		
        $related_items = new WP_Query( $args );
        // loop over query
        if ( $related_items->have_posts() ) : ?>
 
            <h4>Você também pode gostar</h4>
			<div class="colored-line-left"></div>
			<div class="clear"></div>
				<div class="loop-post-relacionados">
 
            <?php while ( $related_items->have_posts() ) : $related_items->the_post(); ?>
             
                <div id="su-post-<?php the_ID(); ?>" class="item">
				<div  class="bloco-foto">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php 
						if ( has_post_thumbnail() ) {
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
							if ( ! empty( $large_image_url[0] ) ) {
								//echo '<a href="' . esc_url( $large_image_url[0] ) . '" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '">';
								echo get_the_post_thumbnail( $post->ID, 'thumbnail' ); 
								echo '</a>';
							} 
						}
						?>
					</a>
				</div>
				<div class="categoria-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>">
					<?php $categories = get_the_category();
					if ( ! empty( $categories ) ) {
						echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '"><span>' . esc_html( $categories[0]->name ) . '</span></a>';
					}?>
					<!-- Print a link to this category -->
				</div>
				<div class="loop-content">
					<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
					<a  class="saiba-mais-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>" href="<?php the_permalink(); ?>">
				<svg version="1.1" id="layer-<?php the_ID(); ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 11.8 21.1" style="enable-background:new 0 0 11.8 21.1;" xml:space="preserve">

				<path class="saiba-mais-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>" d="M1.8,1.6L10,9.8c0.4,0.4,0.4,1.1,0,1.5l-8.2,8.3"/>
				</svg> Saiba mais
			</a>
				</div>

			</div>
 
            <?php endwhile; ?>

 
        <?php endif;
        // Reset Post Data
        wp_reset_postdata();
        ?> 
<!-- end custom related loop, isa -->
			</div>
		</div>
		</div>
	</article> 

	<?php get_sidebar( 'right' ); ?>
</div>
<!-- end content container -->
