<div class="flex w-full items-center gap-4 p-4 mt-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-all duration-200">

    <div class="flex items-center justify-center w-10 h-10 rounded-full cursor-pointer border-2 {{ $todo->completed_at ? 'bg-green-100 border-green-500' : 'bg-white border-gray-300' }}">
        @if($todo->completed_at)
            <svg class="w-5 h-5 text-green-600" viewBox="0 0 24 24" fill="none">
                <path d="M19 7L10.25 17L5 12.4545"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"/>
            </svg>
        @endif
    </div>

    <div class="flex-1">
        <p class="font-semibold text-gray-800">
            {{ $todo->title }}
        </p>

        <p class="text-sm text-gray-500">
            {{ $todo->content }}
        </p>
    </div>

    <button
    x-on:click="
        $dispatch('start-loading');
        open = true;
        $dispatch('edit-todo', { id: {{ $todo->id }} })
    "
    class="text-sm px-3 py-1.5 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 cursor-pointer transition-all duration-200">
        Editar
    </button>

</div>
