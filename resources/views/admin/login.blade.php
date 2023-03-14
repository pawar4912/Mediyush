<!DOCTYPE html>
<html>

<head>
    <title>Mediyush</title>
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ session('error') }}</li>
                </ul>
            </div>
        @endif
        <div class="signup">
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" placeholder="Email" name="email">
                <input type="password" placeholder="Password" name="password">
                <button>Login</button>
            </form>
        </div>
    </div>
</body>

</html>
