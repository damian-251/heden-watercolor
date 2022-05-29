<nav class="navbar navbar-expand-md navbar-light shadow-sm hw-topmenu">
    <div class="navbar-collapse collpase">
        <ul class="navbar-nav ms-auto">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        

                        <a class="dropdown-item" href="{{ route('user-control-panel') }}">
                            {{ __('User settings') }} </a>

                        @if (Auth::user()->is_admin)
                            {{-- Mostramos el panel de administración a los administradores --}}
                            <a class="dropdown-item" href="{{ route('admin-cp') }}">
                                {{ __('Administration Panel') }} </a>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ __('Language') }}
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    @foreach (config('app.available_locales') as $locale_name => $available_locale)
                        <a class="dropdown-item"
                            href="language/{{ $available_locale }}">{{ $locale_name }}</a>
                    @endforeach
                </div>
            </li>
        </ul>
    </div>
</nav>