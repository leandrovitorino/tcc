<nav class="navbar navbar-expand-lg menu mb-3">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" style="max-width: 80px;" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @auth
                <ul class="navbar-nav mr-auto">
                    @can('Question Management')
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Perguntas
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('subject.index') }}">
                                    {{ __('Gerenciar Assuntos') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('question.index') }}">
                                    {{ __('Gerenciar Questões') }}
                                </a>
                            </div>
                        </li>
                    @endcan
                    @can('Team')
                        <li>
                            <a href="{{ route('team.index') }}" class="nav-link">Turmas</a>
                        </li>
                        <li>
                            <a href="{{ route('test.index') }}" class="nav-link">Testes</a>
                        </li>
                    @endcan
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.index') }}">
                                {{ __('Gerenciar Usuarios') }}
                            </a>
                            @can('Role Management')
                                <a class="dropdown-item" href="{{ route('role.index') }}">
                                    {{ __('Gerenciar Níveis de Acesso') }}
                                </a>
                            @endcan
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
                </ul>
            @else
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            @endauth
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">Sobre</a>
                    </li>
                </ul>
        </div>
    </div>
</nav>
