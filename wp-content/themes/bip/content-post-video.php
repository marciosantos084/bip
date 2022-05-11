<div class="case-destaque video">
	<div class="image-post">
		<?php 
			$file = get_field('video_post');
			if( $file ): ?>
			<div class=Video ><a onclick="VideoHome()"><img src="<?php the_field('capa_do_video'); ?>" video="<?php echo $file['url']; ?>"></a></div>
			
		<?php endif; ?>
		
		
		<div class="categoria-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>">
			<?php $categories = get_the_category();
			if ( ! empty( $categories ) ) {
				echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '"><span>' . esc_html( $categories[0]->name ) . '</span></a>';
			}?>
			<!-- Print a link to this category -->
		</div>
	</div>
	<div class="loop-content">
		<h4>                                
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" class="title-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>">
				<?php the_title(); ?>
			</a>                            
		</h4>
		<!-- .single-entry-summary -->
		<div class="content-inner">                                                      
			<div class="content-summary">
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
