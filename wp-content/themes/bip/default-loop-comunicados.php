        
<div class="panel panel-default">
<div class="float-left titulo-area">
<h3>COMUNICADOS</h3>
<div class="colored-line-left"></div>
</div>
<div class="panel-footer"> </div>
<div class="clear"></div>
		<div class="panel-body">
		<ul id="listacomunicado" class="comunicados">

			<?php if ( $posts->have_posts() ) : ?>

				<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>

					<li id="su-post-<?php the_ID(); ?>" class="news-item">
						<span class="post-date">
							<?php the_time( get_option( 'date_format' ) ); ?>
						</span>
						<h5><a href="<?php the_permalink(); ?>" class="title-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>"><?php the_title(); ?></a></h5>

						<div class="su-post-excerpt">
							<p>
								<?php

									$conteudo = get_the_excerpt();
									$limite_conteudo = wp_trim_words( $conteudo, 40);
									echo $limite_conteudo;

								?>
							</p>
						</div>
						<a  class="saiba-mais-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>" href="<?php the_permalink(); ?>">
				<svg version="1.1" id="layer-<?php the_ID(); ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 11.8 21.1" style="enable-background:new 0 0 11.8 21.1;" xml:space="preserve">

				<path class="saiba-mais-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>" d="M1.8,1.6L10,9.8c0.4,0.4,0.4,1.1,0,1.5l-8.2,8.3"/>
				</svg> Saiba mais
			</a>
					</li>

				<?php endwhile; ?>

			<?php else : ?>
				<h4><?php _e( 'Posts not found', 'shortcodes-ultimate' ); ?></h4>
			<?php endif; ?>

		</ul>
</div>
</div>