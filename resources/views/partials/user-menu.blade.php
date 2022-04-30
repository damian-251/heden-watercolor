<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container ">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{$userName}}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto ">
                <li class="nav-item"> <a class="nav-link" href="{{ route('user-control-panel') }}">{{ __('Home') }}</a> </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{__('View') }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('user-data')}}">{{__('My data')}}</a>
                        <a class="dropdown-item" href="{{route('user-addresses')}}">{{__('Addresses')}}</a>
                        <a class="dropdown-item" href="{{route('user-orders')}}">{{__('Orders')}}</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{__('Edit') }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('edit-tag')}}">{{__('User data')}}</a>
                        <a class="dropdown-item" href="{{route('edit-colour')}}">{{__('Addresses')}}</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <h1 class="text-center my-3">{{__('Welcome') . ' ' . $userName}}</h1>