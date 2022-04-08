@if (session('message'))
        <div class="chollo-editado alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif
    
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif