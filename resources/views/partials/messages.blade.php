@if (session('message'))
    <div class="alert alert-success m-4 text-center" role="alert">
        {{ session('message') }}
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning m-4 text-center" role="alert">
        {{ session('warning') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger m-4 text-center" role="alert">
        {{ session('error') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger m-4 text-center" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
