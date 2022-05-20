@if (session('message'))
        <div class="chollo-editado alert alert-success m-4 text-center" role="alert">
            {{ session('message') }}
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