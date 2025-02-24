<div class="menu relative">
    <div class="absolute menu-img">
        @if (Route::has('login'))
            <div class="menu-list">
                <a href="{{ route('main') }}">Главная</a>
                <a href="{{ route('afisha') }}">Афиша</a>
                <a href="{{ route('about') }}">О нас</a>
                <a href="{{ route('contacts') }}">Контакты</a>
                <a href="{{ route('buy-tickets') }}">Купить билеты</a>
                @auth
                    <a href="{{ url('/dashboard') }}">Админка</a>
                @endauth
            </div>
        @endif
    </div>
</div>
