<header class="bg-blue-900 text-white p-4" x-data="{open: false}">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-semibold">
            <a href="{{ url('/') }}">Jobs Dream - Работа твоей мечты</a>
        </h1>
        <nav class="hidden md:flex items-center space-x-4">
            <x-nav-link url="/" :active="request()->is('/')">Главная</x-nav-link>
            <x-nav-link url="/jobs" :active="request()->is('jobs')" icon="bars">Все работы</x-nav-link>
            @auth
            <x-nav-link url="/bookmarks" :active="request()->is('bookmarks')" icon="bell">Cохранить Работу</x-nav-link>
            <x-logout-button />
            <div class="flex items-center space-x-3">
                    <a href="{{ route('dashboard') }}">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                            alt="{{ Auth::user()->name }}"
                            class="w-10 h-10 rounded-full">
                        @else
                        <img src="{{ asset('storage/avatars/default-avatar.png')}}" 
                        alt="{{ Auth::user()->name }}"
                        class="w-10 h-10 rounded-full">
                        @endif
                    </a>
            </div>
            <x-button-link url='/jobs/create' icon='edit'>Разместить вакансию</x-button-link>
            @else            
            <x-nav-link url="/login" :active="request()->is('login')" icon="user">Логин</x-nav-link>
            <x-nav-link url="/register" :active="request()->is('register')">Регистрация</x-nav-link>
            @endauth

        </nav>
        <button @click="open  = !open" id="hamburger" class="text-white md:hidden flex items-center">
            <i class="fa fa-bars text-2xl"></i>
        </button>
    </div>
    <!-- Mobile Menu -->
    <nav x-show="open" @click.away="open = false" id="mobile-menu" class="md:hidden bg-blue-900 text-white mt-5 pb-4 space-y-2">
    <x-nav-link url="/jobs" :active="request()->is('jobs')" icon="bars" :mobile="true">Все работы</x-nav-link>
    @auth
    <x-nav-link url="/bookmarks" :active="request()->is('bookmarks')" icon="bell" :mobile="true">Cохранить Работу</x-nav-link>
    <x-nav-link url="/dashboard" :active="request()->is('dashboard')" icon="gauge" :mobile="true">Доска</x-nav-link>
    <x-logout-button />
    <div class="flex items-center space-x-3">
        <a href="{{ route('dashboard') }}">
            @if(Auth::user()->avatar)
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                alt="{{ Auth::user()->name }}"
                class="w-10 h-10 rounded-full">
            @else
            <img src="{{ asset('storage/avatars/default-avatar.png')}}" 
            alt="{{ Auth::user()->name }}"
            class="w-10 h-10 rounded-full">
            @endif
        </a>
    </div>
    <x-button-link url="/jobs/create" icon='edit' :block="true">Создать Работу</x-button-link>
    @else
    <x-nav-link url="/login" :active="request()->is('login')" icon="user" :mobile="true">Логин</x-nav-link>
    <x-nav-link url="/register" :active="request()->is('register')" :mobile="true">Регистрация</x-nav-link>
    @endauth
    </nav>
</header>