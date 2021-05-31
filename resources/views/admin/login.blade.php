

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-6 offset-3">
                        @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                            @foreach($errors->all() as $error)
                                <li><p>{{ $error}}</p></li>
                            @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="card text-center">
                            <div class="card-body">
                                <h4>Admin Login</h4>
                            <form class="form" method="POST" action="{{ route('admin.login') }}">
                                    <div class="form-group">
                                        <label class="label" for="email">
                                            Email Address
                                        </label>
                                        <input type="email" class="form-control" name="email" id="email">
                                    </div>

                                    <div class="form-group">
                                        <label class="label" for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password">
                                    </div>

                                    @csrf
                                    <button class="btn btn-primary btn-block" type="submit">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

