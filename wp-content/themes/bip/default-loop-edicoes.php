<div class="row-carousel">
	<div class="item">
		<div class="content-carousel">
			<ul id="content-edicoes" class="content-slider">
			<?php if ( $posts->have_posts() ) : ?>
				<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
				<li id="edicao-<?php the_ID(); ?>" class="loop-edicao">
					<div class="image-post image-edicao">
						<?php 
						if ( has_post_thumbnail() ) {
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
							$file = get_field('link_do_arquivo');
							if ( ! empty( $large_image_url[0] ) ) {
								echo '<a href="' . esc_url( $file ) . '" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '" target="_blank">';
								echo get_the_post_thumbnail( $post->ID, 'full' ); 
								echo '</a>';
							}
						}
						?>				
					</div>
					<div class="content">		
						<?php if( get_field('link_do_arquivo') ): ?>
							<a href="<?php the_field('link_do_arquivo'); ?>" download="" ><img src="/bip/wp-content/uploads/2018/10/bullet-download.png" alt="" width="30" height="30" class="float-left size-full wp-image-23" /></a>
						<?php endif; ?>
					<div class="footer">
							<h5><?php if( get_field('link_do_arquivo') ): ?><a href="<?php the_field('link_do_arquivo'); ?>" target="_blank"><?php the_title(); ?></a><?php endif; ?></h5>

							<div class="excerpt">
							<p>
								<?php

									$conteudo = get_the_excerpt();
									$limite_conteudo = wp_trim_words( $conteudo, 40);
									echo $limite_conteudo;

								?>
							</p>
							</div>
						</div>
					</div>
				</li>
				<?php endwhile; ?>
				<?php else : ?>
					<h4><?php _e( 'Posts not found', 'shortcodes-ultimate' ); ?></h4>
				<?php endif; ?>
			</ul>
		</div>
	<div class="lSAction">
		<a  id="goToPrevSlide" class="lSPrev"></a>
		<a  id="goToNextSlide" class="lSNext"></a>
	</div>
	</div>
	
</div>



