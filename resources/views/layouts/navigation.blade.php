<!-- Settings Dropdown -->
<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <button
            class="inline-flex items-center py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent"">
            <div>{{ Str::ucfirst(Auth::user()->first_name) . ' ' . Auth::user()->last_name }}</div>

            <div class="ms-1">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </div>
        </button>
    </x-slot>

    <x-slot name="content">
        <x-dropdown-link :href="route('usuario.editar-perfil')">
            {{ __('Profile') }}
        </x-dropdown-link>

        @if(Auth::user()->admin)
            
        <x-dropdown-link :href="route('admin.dashboard')">
            {{ __('Panel de administración') }}
        </x-dropdown-link>
        @elseif(Auth::user()->trabajador && Auth::user()->paciente)
        <x-dropdown-link :href="route('usuario.elegir-perfil')">
            {{ __('Elegir perfil') }}
        </x-dropdown-link>
        @elseif(Auth::user()->paciente)
        <x-dropdown-link :href="route('user.dashboard')">
            {{ __('Panel de usuario') }}
        </x-dropdown-link>
        @elseif($Auth::user()->trabajador)
        <x-dropdown-link :href="route('worker.dashboard')">
            {{ __('Panel de trabajador') }}
        </x-dropdown-link>

        @endif

        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link :href="route('logout')"
                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-dropdown-link>
        </form>
    </x-slot>
</x-dropdown>
