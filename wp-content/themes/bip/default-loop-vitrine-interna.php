<div class="slide-topo">
	<div class="item">            
		<div class="clearfix">
			<ul id="slides-vitrine-interna" class="gallery list-unstyled cS-hidden">
				<?php if ( $posts->have_posts() ) : ?>
					<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
<li class="item-slide-topo categoria-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>" id="slide-<?php the_ID(); ?>" >	
						
							<div class="content">
								<div class="descricao-cor-branco">
									<div class="categoria-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>">
										<?php $categories = get_the_category();
										if ( ! empty( $categories ) ) {
											echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '"><span>' . esc_html( $categories[0]->name ) . '</span></a>';
										}?>
										<!-- Print a link to this category -->
									</div>
									<h2><?php 

										$link = get_field('link');

										if( $link ): ?>
											
											<a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php the_title(); ?></a><?php endif; ?></h2>
									<div class="colored-line-left"></div>
									<div class="clear"></div>
									<p>
										<?php 

											$link = get_field('link');

											if( $link ): ?>
												
												<a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
										<?php

											$conteudo = get_the_excerpt();
											$limite_conteudo = wp_trim_words( $conteudo, 30);
											echo $limite_conteudo;

										?>
										</a><?php endif; ?>
									</p>
								</div>
								<div class="image-slide">
								
									
									<?php 

										$link = get_field('link');

										if( $link ): ?>
											
											<a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">

									<?php endif; ?>

									<?php 

									$image = get_field('imagem_da_vitrine');

									if( !empty($image) ): ?>

										<img src="<?php echo $image['url']; ?>" />
									<?php echo '</a>'; ?>
									<?php endif; ?>
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
</div>
