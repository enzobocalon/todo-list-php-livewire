<nav class="w-full bg-white shadow-md px-6 py-3 flex items-center justify-between">
    <a href="{{ route('home.index') }}" class="text-xl font-bold text-indigo-600 hover:text-indigo-700 transition duration-200">
        TODO LIST
    </a>

    @auth
<div
        x-data="{open: false}"
        class="relative"
        x-on:click.outside="open = false"
        >
        <button class="flex items-center gap-4 cursor-pointer" x-on:click="open = !open">
            <div>
                <span class="text-sm font-medium">Olá,
                    <span class="text-indigo-600">{{ auth()->user()->name }}</span>!</span>
            </div>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-4 h-4 transition-transform duration-200"
                :class="open ? 'rotate-180' : ''"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div x-show="open" x-transition class="absolute p-2 z-50 bg-white top-8 w-full border border-gray-100 shadow-md rounded-md transition-all duration-200 ">
            <ul>
                <li>
                    <a href="#" class="block w-full text-red-500 hover:bg-red-50 px-3 py-2 transition-all duration-200 rounded">Sair</a>
                </li>
            </ul>
        </div>
    </div>
    @endauth

    @guest
        <div class="flex gap-4 items-center">
            <a href="{{ route('auth.login') }}" class="block nav-link">
                Entrar
            </a>
            <a href="{{ route('auth.signup') }}" class="block nav-link">
                Registrar
            </a>
        </div>
    @endguest
</nav>
