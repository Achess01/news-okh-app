<div class="d-flex flex-column flex-shrink-0 p-3 pt-0 my-2 w-100">
    @auth
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="/" class="nav-link link-dark">
                    {{__('Home')}}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('notifications.index')}}" class="nav-link link-dark">
                    Notificaciones
                </a>
            </li>
            @can('create post')
                <li>
                    <a href="{{ route('posts.my_posts') }}" class="nav-link link-dark">
                        Mis publicaciones
                    </a>
                </li>
            @endcan
            @role('admin')
            <li>
                <a href="{{route('posts.reported_posts')}}" class="nav-link link-dark">
                    {{__('ReportedPosts')}}
                </a>
            </li>
            @endrole
            @role('admin')
            <li>
                <a href="{{route('posts.review')}}" class="nav-link link-dark">
                    Publicaciones pendientes de revisión
                </a>
            </li>
            @endrole
            @role('admin')
            <li>
                <a href="{{route('reports.postReports')}}" class="nav-link link-dark">
                    Reportes a publicaciones
                </a>
            </li>
            @endrole
            @role('admin')
            <li>
                <a href="{{route('reports.postStatus')}}" class="nav-link link-dark">
                    Estados de publicaciones
                </a>
            </li>
            @endrole
        </ul>
        <hr>
    @endauth
    <ul class="nav nav-pills flex-column mb-auto">
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
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->email }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
</div>
