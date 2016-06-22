		
								<!-- INICIO -->
						@forelse( $sign_petitions as $ptt)		
								<div class="list-item">
												<div class="row">
													
													<div class="col-sm-6 col-md-4 col-lg-3">
														<div class="overlay-container">
																	<img src="{{ ($ptt->petition->image) ? asset( 'uploads/'.$ptt->petition->image ) : asset( 'images/sem-imagem.jpg' ) }}" class="img-responsive">
																<div class="overlay">
																	<div class="overlay-links">
																		<a href="{{ url( 'petitions/'.$ptt->petition->id ) }}"><i class="fa fa-link"></i></a>
																		@if( $ptt->petition->image )
																				<a href="{{ asset( 'uploads/'.$ptt->petition->image ) }}" class="popup-img"><i class="fa fa-search-plus"></i></a>
																		@endif
																	</div>
																	<span>{{ $ptt->petition->title }}</span>
																</div>
														</div>
													</div>
													<div class="col-sm-6 col-md-8 col-lg-9">
														<div class="body">
															<h3 class="title"><a href="portfolio-item.html">{{ $ptt->petition->title }}</a></h3>
															<p class="small">
																<i class="icon-calendar"></i> {{ date('d/m/Y', strtotime($ptt->petition->created_at)) }} 
																<i class="pl-10 fa fa-tags"></i> {{ $ptt->petition->category_id }}</p>
															<p><i class="icon-calendar"></i> {{ trans('sign.signed') }}: {{ date('d/m/Y', strtotime($ptt->created_at)) }} </p>
															
															<a href="{{ url('petitions/'.$ptt->petition->id) }}" class="btn btn-default">{{ trans('layout.view') }}</a>
															<a href="{{ url('signature/'.$ptt->petition->id.'/find') }}" class="btn btn-default">{{ trans('sign.remove') }}</a>
														</div>
													</div>
									</div>
								</div>
						@empty
								<p class="center-block">{{ trans('layout.empty.search') }}</p>
						@endforelse
								<!-- FIM -->
		</div>


