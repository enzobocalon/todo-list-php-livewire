<div
    x-data="{
        message: null,
        type: 'info',

        handleNotification(message, type, hasVanisherTimer = true, customTimer = null) {
            this.message = message;
            this.type = type;
            if (hasVanisherTimer) {
                setTimeout(() => {
                    this.message = null;
                }, customTimer || 5000);
            }
        }
    }"
    x-init="
        @if(session('message'))
            handleNotification(
                @json(session('message')),
                @json(session('type', 'info')),
                @json(session('hasVanisherTimer', true)),
                @json(session('customTimer'))
            )
        @endif
    "
    x-show="message"
    x-cloak
    x-on:notify-{{ $channel }}.window="
        handleNotification(
            $event.detail.message,
            $event.detail.type || 'info',
            $event.detail.hasVanisherTimer ?? true,
            $event.detail.customTimer || 5000
        )
    "
    class="w-full py-4 px-6 mb-4 border-l-4 rounded-xl"
    :class="{
        'bg-green-100 border-green-500 text-green-700': type === 'success',
        'bg-yellow-100 border-yellow-500 text-yellow-700': type === 'warning',
        'bg-red-100 border-red-500 text-red-700': type === 'error',
        'bg-blue-100 border-blue-500 text-blue-700': type === 'info'
    }"
>
    <p class="font-bold">Atenção</p>
    <p x-text="message"></p>
</div>
