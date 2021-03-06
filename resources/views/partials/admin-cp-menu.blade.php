<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{__('Administration Control Panel')}}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContentAdmin" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContentAdmin">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item"> <a class="nav-link" href="#">{{ __('Home') }}</a> </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{__('Create') }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('create-tag')}}">{{__('Tag')}}</a>
                        <a class="dropdown-item" href="{{route('create-colour')}}">{{__('Colour')}}</a>
                        <a class="dropdown-item" href="{{route('create-location')}}">{{__('Location')}}</a>
                        <a class="dropdown-item" href="{{route('create-product')}}">{{__('Product')}}</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{__('Edit') }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('edit-tag')}}">{{__('Tag')}}</a>
                        <a class="dropdown-item" href="{{route('edit-colour')}}">{{__('Colour')}}</a>
                        <a class="dropdown-item" href="{{route('edit-location')}}">{{__('Location')}}</a>
                        <a class="dropdown-item" href="{{route('portfolio')}}">{{__('Product')}}</a>
                    </div>
                </li>
                <li class="nav-item"> <a class="nav-link" href="{{route('modify-special')}}">{{ __('Modify special section') }}</a> </li>
                <li class="nav-item"> <a class="nav-link" href="{{route('order-sent')}}">{{ __('Mark order as sent') }}</a> </li>
            </ul>
        </div>
    </div>
</nav>