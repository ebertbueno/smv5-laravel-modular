			
			<!-- banner start -->
			<!-- ================ -->
			<div class="banner">

				<!-- slideshow start -->
				<!-- ================ -->
				<div class="slideshow white-bg">
					
					<!-- slider revolution start -->
					<!-- ================ -->
					<div class="slider-banner-container">
						<div class="slider-banner-2 bullets-with-bg">
							<ul>

         @foreach( $petitions as $ptt )      

								@if( $ptt->image )
								<!-- slide 1 start -->
								<li data-transition="fade" data-slotamount="7" data-masterspeed="1000" data-saveperformance="on" data-title="Slide 1">
								
								<!-- main image -->
								<img src="{{ url('uploads/'.$ptt->image) }}"  alt="slidebg1" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
								<!-- Translucent background -->
								<div class="tp-caption dark-translucent-bg"
									data-x="center"
									data-y="bottom"
									data-speed="800"
									data-start="0"
									style="background-color:rgba(0,0,0,0.5);">
								</div>

								<!-- LAYER NR. 1 -->
								<div class="tp-caption very_large_text sfl tp-resizeme"
									data-x="center"
									data-y="70" 
									data-speed="600"
									data-start="0"
									data-end="10000"
									data-endspeed="600">{{ $ptt->title }}
								</div>

								<!-- LAYER NR. 2 -->
								<div class="tp-caption small_thin_white sfr text-center"
									data-x="center"
									data-y="170" 
									data-speed="600"
									data-start="0"
									data-end="10000"
									data-endspeed="600"
									style="max-width:900px;word-wrap: break-word;"	 
										 >{{ $ptt->declaration }}
								</div>

								<!-- LAYER NR. 3 -->
								<div class="tp-caption tp-resizeme sfl"
									data-x="center"
									data-y="300" 
									data-speed="600"
									data-start="0"
									data-end="10000"
									data-endspeed="600">
											<a href="{{ url('petitions/'.$ptt->id.'/'.$ptt->slug ) }}" class="btn btn-default btn-lg">
													{{ trans('layout.readmore') }} 
													<i class="fa fa-angle-double-right pl-10"></i>
											</a>
								</div>

								</li>
								@endif
								<!-- slide 1 end -->
          @endforeach


							</ul>
						</div>
					</div>
					<!-- slider revolution end -->

				</div>
				<!-- slideshow end -->

			</div>
			<!-- banner end -->
