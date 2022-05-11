<div class="su-posts su-posts-single-post">
	<?php
		// Prepare marker to show only one post
		$first = true;
		// Posts are found
		if ( $posts->have_posts() ) {
			while ( $posts->have_posts() ) :
				$posts->the_post();
				global $post;

				// Show oly first post
				if ( $first ) {
					$first = false;
					?>
					<div id="post-<?php the_ID(); ?>" class="post-destaque">
						<div class="destaque">
							<div class="image-post">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="">
								<?php 
								if ( has_post_thumbnail() ) {
									$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
									if ( ! empty( $large_image_url[0] ) ) {
										//echo '<a href="' . esc_url( $large_image_url[0] ) . '" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '">';
										echo get_the_post_thumbnail( $post->ID, 'medium' ); 
										echo '</a>';
									}
								}
								?>
								</a>
								
							</div>
							<div class="content-post">
								<h3>                                
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
										<?php the_title(); ?>
									</a>                            
								</h3>
								<!-- .single-entry-summary -->
								<div class="content-inner">                                                      
									<a class="saiba-mais" href="<?php the_permalink(); ?>" > 
										<span>> </span><?php esc_html_e( 'Saiba mais', 'bip' ) ?>
									</a>
								</div>                                                             
							</div>  
						</div>
					<?php
				}
			endwhile;
		}
		// Posts not found
		else {
			echo '<h4>' . __( 'Posts not found', 'shortcodes-ultimate' ) . '</h4>';
			}
		?>
			</div>
</div>