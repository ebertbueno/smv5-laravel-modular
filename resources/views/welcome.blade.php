@extends( Config::get('themes.frontend') )

@section('css')
         <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
                color: #ccc;
            }
        </style>
@endsection

@section('content')
       
        <div class="container">
            <div class="content">
                <div class="title">Laravel 5</div>
               
            </div>
        </div>

@endsection
