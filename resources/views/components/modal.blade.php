<div x-cloak>
    <div
        x-show="open"
        x-transition.opacity
        class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center"
        x-on:click="open = false"
        x-on:close-modal.window="open = false"
    >
        <div x-on:click.stop class="contents">
           <livewire:layout.form />
        </div>
    </div>
</div>
