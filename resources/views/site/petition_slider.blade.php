		<div class="owl-carousel carousel">
								<!-- INICIO -->
						@forelse( $petitions as $ptt)		
								<div class="image-box">
									<div class="overlay-container img-fill" style="height:180px;overflow:hidden">
										
											<img src="{{ ($ptt->image) ? asset( 'uploads/'.$ptt->image ) : asset( 'images/sem-imagem.jpg' ) }}" alt="">
										<div class="overlay">
											<div class="overlay-links">
												<a href="{{ url( 'petitions/'.$ptt->id ) }}"><i class="fa fa-link"></i></a>
												@if( $ptt->image )
														<a href="{{ asset( 'uploads/'.$ptt->image ) }}" class="popup-img"><i class="fa fa-search-plus"></i></a>
												@endif
											</div>
										</div>
									</div>
									<div class="image-box-body">
										<!--<h3 class="title"><a href="portfolio-item.html"> {{ $ptt->title }}  </a></h3>-->
										<p> {{ $ptt->title }} </p>
										<a href="{{ url( 'petitions/'.$ptt->id ) }}" class="link"><span>{{ trans('sign.signature') }}</span></a>
									</div>
								</div>
						@empty
								<p class="center-block">{{ trans('layout.empty.search') }}</p>
						@endforelse
								<!-- FIM -->
		</div>


