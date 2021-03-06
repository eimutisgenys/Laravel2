<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body> 

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Write Comment</a>
                        <a  class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                        <a href="{{ route('contact') }}">Contact</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Comments
                </div>

                <div>
                    @foreach ($comments as $comment)
                    <tr>
                        <p><strong>{{ $comment->CommentText }}</strong>
                            @auth - <a href="/deletecomment/{{$comment->CommentId}}"><button class="btn">Delete</button></a>@endauth
                        </p>   
                
                    @endforeach
                </div>

                @auth
                    <form action="/writecomment" method="post">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input class="form-control" type="text" name="comment">
                        <input class="btn" type="submit" value="Submit">
                    </form>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}">Login to write comment</a>
                @endauth


            </div>

        </div>

        @include('includes.footer')
    </body>
</html>
