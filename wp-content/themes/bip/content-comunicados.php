<div class="loop-comunicados">
	<div <?php post_class(); ?>>                    
		<div class="content">
			<time class="post-time posted-on published" datetime="<?php the_time( 'c' ); ?>" itemprop="datePublished">
				<?php the_time( get_option( 'date_format' ) ); ?>
			</time>
			<h4>                                
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>                            
			</h4>
			<div class="content-inner">                                                      
				<div class="single-entry-summary">
				<p>
					<?php

						$conteudo = get_the_excerpt();
						$limite_conteudo = wp_trim_words( $conteudo, 40);
						echo $limite_conteudo;

					?>
				</p>
				</div><!-- .single-entry-summary -->
			<a  class="saiba-mais-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>" href="<?php the_permalink(); ?>">
				<svg version="1.1" id="layer-<?php the_ID(); ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 11.8 21.1" style="enable-background:new 0 0 11.8 21.1;" xml:space="preserve">

				<path class="saiba-mais-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>" d="M1.8,1.6L10,9.8c0.4,0.4,0.4,1.1,0,1.5l-8.2,8.3"/>
				</svg> Saiba mais
			</a>
			</div>                                                             
		</div>                   
	</div>
</div>
