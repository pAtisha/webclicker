<nav class="navbar navbar-expand-md navbar-light">
    <div class="container">
        <a class="navbar-brand text-white" href="{{ url('/') }}">
            {{ config('app.name', 'WebClicker') }}
        </a>
        <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon text-white"></span>
        </button>

        <div class="collapse navbar-collapse text-white" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            @auth
            <ul class="navbar-nav me-auto">
            @if(Auth::user()->isStudent())

                <li class="nav-item"><a class="nav-link fw-bold text-white" href="/student/courses">Kursevi</a></li>

            @endif

            @if(Auth::user()->isProfessor())

                <li class="nav-item"><a href="/professor/courses" class="nav-link fw-bold">Moji kursevi</a></li>

            @endif
            @if(Auth::user()->isAdmin())
                <li class="nav-item"><a class="nav-link fw-bold" href="/admin/users">Korisnici</a></li>

            @endif

            </ul>

            @endauth

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->

                @auth
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                            <a href="{{url(Request::route()->getPrefix().'/user/edit', \Illuminate\Support\Facades\Auth::id())}}" class="dropdown-item">Izmeni profil</a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Odjavi se
                            </a>



                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
