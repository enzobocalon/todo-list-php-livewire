<form
    x-data="{ isLoading: false, todoId: $wire.entangle('id') }"
    x-on:end-loading.window="isLoading = false"
    x-on:start-loading.window="isLoading = true"
    x-on:create-todo.window="
        $wire.set('id', null)
        $wire.set('title', '')
        $wire.set('content', '')
        $wire.set('completed', false)
    "
    wire:submit="submit"
    class="w-full max-w-xl bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-4">

    <h2 class="text-lg font-semibold text-gray-800" x-text="$wire.id ? 'Editar Tarefa' : 'Nova Tarefa'"></h2>

    {{-- Skeleton --}}
    <template x-if="isLoading">
        <div class="space-y-4 animate-pulse">
            <div>
                <div class="h-4 w-16 bg-gray-200 rounded mb-1"></div>
                <div class="h-10 bg-gray-200 rounded-lg"></div>
            </div>
            <div>
                <div class="h-4 w-20 bg-gray-200 rounded mb-1"></div>
                <div class="h-28 bg-gray-200 rounded-lg"></div>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-gray-200 rounded"></div>
                <div class="h-4 w-36 bg-gray-200 rounded"></div>
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <div class="h-9 w-20 bg-gray-200 rounded-lg"></div>
                <div class="h-9 w-16 bg-gray-200 rounded-lg"></div>
            </div>
        </div>
    </template>

    {{-- Form real --}}
    <div x-show="!isLoading" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
            <input
                type="text"
                name="title"
                wire:model="title"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-200"
                placeholder="Digite o título da tarefa"
            />
            @error('title')
                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
            <textarea
                name="content"
                wire:model="content"
                rows="4"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-200"
                placeholder="Descrição da tarefa (opcional)"
            ></textarea>
            @error('content')
                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center gap-2">
            <input
                type="checkbox"
                name="completed"
                wire:model="completed"
                id="completed"
                class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-200"
            />
            <label for="completed" class="text-sm text-gray-700">Marcar como concluída</label>
            @error('completed')
                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-between items-center gap-2 pt-2">
    <div>
        <button
            x-show="todoId !== null"
            type="button"
            class="px-4 py-2 text-sm bg-red-100 text-red-600 rounded-lg hover:bg-red-200 cursor-pointer"
            wire:click="delete"
            wire:confirm="Tem certeza que deseja excluir esta tarefa?"
        >
            Excluir
        </button>
    </div>

    <div class="flex gap-2">
        <button
            type="button"
            class="px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 cursor-pointer"
            x-on:click="open = false"
        >
            Cancelar
        </button>
        <button
            type="submit"
            class="px-4 py-2 text-sm bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 cursor-pointer"
        >
            Salvar
        </button>
    </div>
</div>
    </div>

</form>
