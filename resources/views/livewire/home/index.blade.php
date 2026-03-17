<div class="w-full my-4 max-w-360 m-auto"
    x-data="{open: false}"
>
    <x-alert channel="home"/>
    <div class="flex items-center justify-between mx-4 py-2">
        <p class="text-2xl font-bold">Suas Tarefas</p>
        <button x-on:click="open = true; $dispatch('create-todo')" class="text-sm px-3 py-1.5 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 transition cursor-pointer">
            <a>Criar</a>
        </button>
    </div>
    @foreach($todos as $todo)
        <x-card :todo="$todo" wire:key="todo-{{ $todo->id }}"/>
    @endforeach

    <x-modal />

    {{ $todos->links('pagination') }}
</div>
