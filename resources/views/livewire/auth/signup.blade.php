<main class="w-full flex-1 flex items-center justify-center">
    <div class="w-full max-w-lg p-4 bg-white rounded-lg shadow-md">
        <div>
            <x-alert channel="signup"/>
        </div>
        <h1 class="text-2xl font-bold mb-4">Cadastrar-se</h1>

        <form wire:submit.prevent="signup">
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nome</label>
                <input wire:model="name" type="text" id="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" />
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input wire:model="email" type="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" />
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Senha</label>
                <input wire:model="password" type="password" id="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" />
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Confirmar Senha</label>
                <input wire:model="password_confirmation" type="password" id="password_confirmation" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" />
                @error('password_confirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full cursor-pointer bg-indigo-500 text-white py-2 rounded-md hover:bg-indigo-600 transition duration-200">Cadastrar</button>

            <p class="text-center mt-2">Já possui conta? <a href="{{ route('auth.login') }}" class="text-indigo-500 hover:underline">Faça login</a></p>
        </form>
    </div>
</main>
