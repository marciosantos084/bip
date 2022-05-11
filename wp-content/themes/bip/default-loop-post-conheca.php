<div class="row-conheca">

	<?php if ( $posts->have_posts() ) : ?>

		<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>

		<div id="post-<?php the_ID(); ?>" class="item-lista">

			<div class="image-post bloco-foto">
				<?php 
				if ( has_post_thumbnail() ) {
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
					$link_externo = get_field('link_externo');
					if ( ! empty( $large_image_url[0] ) ) {
						echo '<a href="' . esc_url( $link_externo['url'] ) . '" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '" target="_blank">';
						echo get_the_post_thumbnail( $post->ID, 'thumbnail' ); 
						echo '</a>';
					} 
				}
				?>
			</div>
			<div class="loop-content">
				<h5 class="title-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>">
				<?php 

					$link_externo = get_field('link_externo');

					if( $link_externo ): ?>
						
										
				<a  class="title-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>" href="<?php echo $link_externo['url']; ?>" target="<?php echo $link_externo['target']; ?>">
					<?php the_title(); ?>
				</a>
				<?php endif; ?>	
				
				
				
				
				</h5>
				<div class="summary">
					<p>
						<?php
							$conteudo = get_the_excerpt();
							$limite_conteudo = wp_trim_words( $conteudo, 40);
							echo $limite_conteudo;
						?>
					</p>
				</div>
					
				<?php 

					$link_externo = get_field('link_externo');

					if( $link_externo ): ?>
						
										
				<a  class="saiba-mais-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>" href="<?php echo $link_externo['url']; ?>" target="<?php echo $link_externo['target']; ?>">
					<svg version="1.1" id="layer-<?php the_ID(); ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		 viewBox="0 0 11.8 21.1" style="enable-background:new 0 0 11.8 21.1;" xml:space="preserve">

					<path class="saiba-mais-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>" d="M1.8,1.6L10,9.8c0.4,0.4,0.4,1.1,0,1.5l-8.2,8.3"/>
					</svg> Saiba mais
				</a>
				<?php endif; ?>					
				
				
			</div>
		</div>
		<?php endwhile; ?>
		<?php else : ?>
			<h4><?php _e( 'Posts not found', 'shortcodes-ultimate' ); ?></h4>
		<?php endif; ?>

</div>
