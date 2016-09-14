<!DOCTYPE html>
    <head >
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

    <body ng-app="app"  ng-controller='PageController'>
        
        <nav class="navbar navbar-default navbar-fixed-top menu">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Brand</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                {!! Menu::render('menu-left') !!}
              </ul>
              <form class="navbar-form navbar-right">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
              </form>
              <ul class="nav navbar-nav navbar-right">
                {!! Menu::render('menu-right') !!}
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>

        @yield('banner')
<!--############# -->
<!-- ALERTAS -->
        @if( session()->get('message') )
            @include('site.alert')
        @endif
<!--############# -->
<!--############# -->
        @yield('content')

        <nav class="nav nav-default navbar-fixed-bottom rodape">
            <div class="container">
                <div class="span2">@yield('footer')</div>
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
