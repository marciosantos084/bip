<div class="loop-case">
	<div <?php post_class(); ?>>                    
		<div class="main-content">
			<h4>                                
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" class="title-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>">
					<?php the_title(); ?>
				</a>                            
			</h4>
			<div class="content">                                                      
				<div class="summary">
				<p>
					<?php

						$conteudo = get_the_excerpt();
						$limite_conteudo = wp_trim_words( $conteudo, 30);
						echo $limite_conteudo;

					?>
				</p>
				</div><!-- .single-entry-summary -->
				<footer>
				<a  class="saiba-mais-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>" href="<?php the_permalink(); ?>">
					<svg version="1.1" id="layer-<?php the_ID(); ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 11.8 21.1" style="enable-background:new 0 0 11.8 21.1;" xml:space="preserve">
					<path class="saiba-mais-<?php foreach((get_the_category()) as $category){echo $category->slug;}?>" d="M1.8,1.6L10,9.8c0.4,0.4,0.4,1.1,0,1.5l-8.2,8.3"/>
					</svg> Ver case
				</a>
				<a class="vervideo popup-modal" href="#linkcase-<?php echo the_ID(); ?>">
						<svg version="1.1" id="player-video" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 102" style="enable-background:new 0 0 100 102;" xml:space="preserve">
							<path class="vervideo" d="M40.6,74.6L40.6,74.6c35.4-21,35.4-21,35.4-21c1-1.1,2.1-2.1,2.1-3.1c0-1-1-2.1-2.1-2.1
						c-35.4-21-35.4-21-35.4-21c-1-1.1-2.1-1.1-3.1,0c-1,0-2.1,1-2.1,3.1c0,29.4,0,29.4,0,29.4c0,2.1,2.1,4.2,4.2,4.2
						c1,0,3.1-2.1,3.1-4.2c0-24.1,0-24.1,0-24.1c26,14.7,26,14.7,26,14.7C37.5,68.3,37.5,68.3,37.5,68.3c-1,1.1-2.1,3.2-1,5.3 c0,1,2.1,1,3.1,1H40.6z M50,6.3L50,6.3c-23.9,0-43.7,20-43.7,44.2c0,24.2,19.8,44.2,43.7,44.2s43.7-20,43.7-44.2
						C93.7,26.3,73.9,6.3,50,6.3z M50,102L50,102C22.9,102,0,78.8,0,50.5C0,23.2,22.9,0,50,0c28.1,0,50,23.2,50,50.5
						C100,78.8,78.1,102,50,102z"/>
						</svg> Ver vídeo</a>

						<div class="white-popup-block mfp-hide" id="linkcase-<?php echo the_ID(); ?>" class="hentry CaseLupa SemMargem">
							<a class="popup-modal-dismiss" href="#"><svg width="37px" height="37px" viewBox="0 0 37 37" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
									<!-- Generator: Sketch 52.3 (67297) - http://www.bohemiancoding.com/sketch -->
									<title>fechar</title>
									<desc>Created with Sketch.</desc>
									<g id="Home-v5" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<g id="01f_Home_Logada_Busca_op1" transform="translate(-1370.000000, -11.000000)">
											<g id="busca">
												<g id="fechar" transform="translate(1370.000000, 11.000000)">
													<circle id="Oval" fill="#244C9D" fill-rule="nonzero" cx="18.5" cy="18.5" r="18.5"></circle>
													<g id="Group-2" transform="translate(11.000000, 11.000000)" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
														<path d="M15.8578689,-7.10542736e-15 L0.000161668167,15.859809" id="Stroke-1"></path>
														<path d="M-7.10542736e-15,-7.10542736e-15 L15.8577072,15.859809" id="Stroke-3"></path>
													</g>
												</g>
											</g>
										</g>
									</g>
								</svg>
								</a>
							<?php 
								$file = get_field('video_case');
								if( $file ): ?>
									<video controls autoplay>
										<source src="<?php echo $file['url']; ?>" type="video/mp4">
									</video>
								<?php endif; ?>
						</div>
					
				</footer>
			</div>                                                             
		</div>                   
	</div>
</div>
