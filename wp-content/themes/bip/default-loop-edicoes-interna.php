<div class="row-interna">
	<div class="item">
		<ul class="content-edicoes">
		<?php if ( $posts->have_posts() ) : ?>

			<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>

			<li id="edicao-<?php the_ID(); ?>" class="loop-edicao">
				<div class="image-edicao">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="">
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
					</a>
				</div>
				<div class="content">
				
					<?php if( get_field('link_do_arquivo') ): ?>

						<a href="<?php the_field('link_do_arquivo'); ?>"  data-bind="attr: { href: Url }" download="" ><img src="/bip/wp-content/uploads/2018/10/bullet-download.png" alt="" width="30" height="30" class="float-left size-full wp-image-23" /></a>

					<?php endif; ?>
					
					<div class="footer">
						<h4><?php if( get_field('link_do_arquivo') ): ?><a href="<?php the_field('link_do_arquivo'); ?>" target="_blank"><?php the_title(); ?></a><?php endif; ?></h4>

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
</div>



