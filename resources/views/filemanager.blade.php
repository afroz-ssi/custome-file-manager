<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>File Manage</title>
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css">
    <link href="{{ asset('vendor/file-manager/css/file-manager.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('css/app.css') }}" />

</head>

<body>
    <div class="container-sub">
        <div class="row">
            <div class="col-md-3">
                <form method="post" action="{{ route('file_upload') }}" enctype="multipart/form-data"
                    style="box-shadow: 5px 4px 12px 0px #cccc;padding: 20px;">
                    @csrf
                    <h4 class="text-center">File Upload</h4>
                    @if (Session::has('error'))
                        <p class="text-danger">{{ Session::get('error') }}</p>
                    @endif
                    <div class="form-group">
                        <label for="email">File :</label>
                        <input type="file" class="form-control" id="file" placeholder="Enter file"
                            name="file">
                        @error('file')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    @foreach ($files as $key => $f)
                        {{$key}} - {{$f}} <br>
                    @endforeach
                    <button type="submit" class="btn btn-default">Upload</button>
                </form>
            </div>
        {{-- </div> --}}
        <div class="col-md-9">


            <div style="display:flex;justify-content:space-between;">
                <h1>FILE EXPPLORER</h1>
                <strong>
                    Welcome : {{ Auth::user()->name }} <a href="{{ route('sign_out') }}">Sign Out</a>
                </strong>
            </div>
            <div class="row">
                <div class="col-md-12" id="fm-main-block">
                    <div id="fm"></div>
                </div>
            </div>
        </div>
      </div>

    </div>
    <!-- File manager -->
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('fm-main-block').setAttribute('style', 'height:' + window.innerHeight + 'px');
            fm.$store.commit('fm/setFileCallBack', function(fileUrl) {
                console.log(fileUrl);
                window.opener.fmSetLink(fileUrl);
                window.close();
            });
        });
    </script>
</body>

</html>
