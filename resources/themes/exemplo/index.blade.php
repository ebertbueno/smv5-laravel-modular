<!DOCTYPE html>
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title> 

        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <base href="{{ url() }}" >
		<!--basic styles-->
        
		<style>
			body{
				padding-top: 70px;	
			}
		</style>
        <link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
        <!-- Font Awesome CSS -->
        <link href="{{ asset('fonts/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
        
        @yield('css')
        

    <body>
        <!--  SIDEBAR TOPO ESQUERDO -->
        <nav class="navbar navbar-default navbar-fixed-top menu" role="navigation" >
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- You'll want to use a responsive image option so this logo looks good on devices - I recommend using something like retina.js (do a quick Google search for it and you'll find it) -->
                   
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-left">
                        {!! Menu::render('backend') !!}
                    </ul>

                    <form class="navbar-form navbar-right form-inline" role="form">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Buscar">
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-default">
                                <span class="glyphicon glyphicon-search"></span></button>
                        </div>
                    </form>
                </div>
            </div><!-- /.container -->
        </nav> 
        @yield('banner')
<!--############# -->
<!-- ALERTAS -->
        @if( session()->get('message') )
            @include('default.theme.alert')
        @endif
<!--############# -->
<!--############# -->
        @yield('content')

        <nav class="nav nav-default navbar-fixed-bottom rodape">
            <div class="container">
                <div class="span2">@yield('foooter')</div>
                <div class="autor"></div>
            </div>
        </nav>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    @section('modal')
                        <p>Vazio</p>
                    @show
                </div>
            </div>
        </div>

        <!--  SCRIPTS  -->
        <!-- Jquery and Bootstap core js files -->
        <script type="text/javascript" src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/system.class.js') }}"></script>
        <!-- Modernizr javascript -->
        <script type="text/javascript" src="{{ asset('plugins/modernizr.js') }}"></script>
        @yield('js')
        <script type="text/javascript" src="{{ asset('themes/exemplo/js/functions.js') }}"></script>

        <script type="text/javascript">
            @yield('script')
        </script>
    </body>
</html>
