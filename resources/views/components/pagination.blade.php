@if ($paginator->hasPages())
    <div class="flex flex-col items-center gap-3 mt-6">

        {{-- Total --}}
        <p class="text-xs text-gray-400">
            {{ $paginator->total() }} itens &middot; página {{ $paginator->currentPage() }} de {{ $paginator->lastPage() }}
        </p>

        {{-- Controles --}}
        <div class="flex items-center gap-1">

            {{-- Anterior --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-1.5 text-sm text-gray-300 cursor-not-allowed select-none">← Anterior</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="px-3 py-1.5 text-sm text-gray-500 hover:text-indigo-600 transition-colors">
                    ← Anterior
                </a>
            @endif

            {{-- Divisor --}}
            <span class="w-px h-4 bg-gray-200 mx-1"></span>

            {{-- Páginas --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-2 py-1.5 text-sm text-gray-300 select-none">{{ $element }}</span>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="w-8 h-8 flex items-center justify-center text-sm font-medium border border-indigo-600 text-indigo-600 bg-indigo-50 rounded-md">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="w-8 h-8 flex items-center justify-center text-sm border border-gray-100 text-gray-500 hover:text-indigo-600 hover:bg-gray-50 rounded-md transition-colors hover:border-indigo-600">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Divisor --}}
            <span class="w-px h-4 bg-gray-200 mx-1"></span>

            {{-- Próxima --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="px-3 py-1.5 text-sm text-gray-500 hover:text-indigo-600 transition-colors">
                    Próxima →
                </a>
            @else
                <span class="px-3 py-1.5 text-sm text-gray-300 cursor-not-allowed select-none">Próxima →</span>
            @endif

        </div>
    </div>
@endif
