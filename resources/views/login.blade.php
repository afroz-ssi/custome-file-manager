<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 mt-5" style="margin-top:20px;">
                <form method="post" action="{{ route('login_check') }}"
                    style="box-shadow: 5px 4px 12px 0px #cccc;padding: 20px;">
                    @csrf
                    <h2 class="text-center">User Login</h2>
                    @if (Session::has('error'))
                        <p class="text-danger">{{ Session::get('error') }}</p>
                    @endif
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email"
                            name="email">
                        @error('email')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" id="pwd" placeholder="Enter password"
                            name="password">
                        @error('password')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="remember"> Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
            <div class="col-md-3"></div>

        </div>

    </div>

</body>

</html>
