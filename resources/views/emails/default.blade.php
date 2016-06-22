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
						<p>{!! ( $message_lang )? $message_lang:trans('email.message') !!}</p>
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
