<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.5&appId=850857928366026";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="panel-group" id="accordion">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
					<i class="fa fa-bold"></i>Facebook
				</a>
			</h4>
		</div>
		<div id="collapseOne" class="panel-collapse collapse in">
			<div class="panel-body">
				<div class="col-md-2">{!! isset($petition->image) ? "<img src='".url("uploads/".$petition->image)."' class='img-responsive'\>" : "" !!}</div>
				<div class="col-md-8">{{ $petition->title or ' ' }}</div>
				<div class="col-md-2">
				<div class="fb-share-button" data-href="{{ url().$_SERVER['REQUEST_URI'] }}" data-layout="box_count"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">
					<i class="fa fa-leaf"></i>Twiiter
				</a>
			</h4>
		</div>
		<div id="collapseTwo" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="col-md-2">{!! isset($petition->image) ? "<img src='".url("uploads/".$petition->image)."' class='img-responsive'\>" : "" !!}</div>
				<div class="col-md-8">{{ $petition->title or ' ' }}</div>
				<div class="col-md-2">
						<a class="twitter-share-button" target="_blank" href="https://twitter.com/intent/tweet?text={{ trans('petition.share_msg') }}&url={{ url().$_SERVER['REQUEST_URI'] }}" data-size="large">Tweet</a>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">
					<i class="fa fa-html5"></i>Email
				</a>
			</h4>
		</div>
		<div id="collapseThree" class="panel-collapse collapse">
			<div class="panel-body">
				Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid.
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseFourth" class="collapsed">
					<i class="fa fa-life-saver"></i>Link
				</a>
			</h4>
		</div>
		<div id="collapseFourth" class="panel-collapse collapse">
			<div class="panel-body">
				Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid.
			</div>
		</div>
	</div>
</div>