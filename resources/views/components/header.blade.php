<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">ЭкоТовары</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Товары</a>
                </li>
                @auth
                    @if (Auth::user()->is_admin == 1)
                        <li class="nav-item">
                            <a class="btn btn-outline-danger" href="/admin">Админ-панель</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="#">Здраствуй, {{ Auth::user()->name }}</a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Выход</a>
                    </li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="btn btn-outline-success" href="/signUp">Регистрация</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-warning" href="/signIn">Авторизация </a>
                    </li>
                @endguest

            </ul>
        </div>
    </div>
</nav>
