<html>
	<head>
		<title></title>
	</head>
	<body>
		<table align="center" border="0" cellpadding="1" cellspacing="1" style="width: 600px">
			<thead>
				<tr>
					<th scope="col" style="text-align: left; width:20%;">
						<img alt="" src="{{ url('images/logo-sm.png') }}" style="width: 106px; height: 50px; margin-top: 5px; margin-bottom: 5px; vertical-align: middle;" /></th>
					<th scope="col" style="width: 60%;">
						<samp><span style="text-align: -webkit-center;">{!! ( isset($title_lang) )? $title_lang:trans('email.notification') !!}</span></samp></th>
					<th scope="col" style="text-align: left; width:20%;">
						&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="3">
							<hr />
							<table border="0" cellpadding="1" cellspacing="1" style="width: 100%">
								<tbody>
									<tr>
										<td colspan="4">
											<p>{{ trans('email.hello') }} {{ $user->name }}</p>
											<p>{{ ( $message_lang )? $message_lang:trans('email.message') }}
											<br />{{ trans('email.newpetition.below') }}</p>
											<hr />
										</td>
									</tr>
									<tr>
										<td>{{ trans('petition.claim') }}:</td>
										<td colspan="3" rowspan="1">
											{{ $petition->title }}</td>
									</tr>
									<tr>
										<td colspan="4">
											{{ trans('petition.what_claim') }}: {{ $petition->declaration }}</td>
									</tr>
									<tr>
										<td>{{ trans('petition.with_who') }}:</td>
										<td>{{ $petition->sender }}</td>
										<td>{{ trans('petition.for_who') }}:</td>
										<td>{{ $petition->receiver }}</td>
									</tr>
									<tr>
										<td>{{ trans('petition.site') }}:</td>
										<td>{{ $petition->address }}</td>
										<td>{{ trans('petition.category') }}:</td>
										<td>{{ $petition->category->name }}</td>
									</tr>
									<tr>
										<td>{{ trans('petition.tags') }}</td>
										<td>{{ $petition->tags }}</td>
										<td>{{ trans('petition.created_at') }}:</td>
										<td>{{ date('m/d/Y', strtotime($petition->created_at)) }}</td>
									</tr>
									<tr>
										<td>{{ trans('petition.link') }}:</td>
										<td colspan="3" rowspan="1">{{ url('petition/'.$petition->id) }}</td>
									</tr>
								</tbody>
							</table>
					</td>
				</tr>
				<tr>
					<td colspan="3" style="text-align: center;">
						<hr />
						<samp><small>{{ trans('email.copyright') }} - {{ $_SERVER['HTTP_HOST'] }}</small></samp></td>
				</tr>
			</tbody>
		</table>
		<p>
			&nbsp;</p>
	</body>
</html>
