<div>
    @isset($logo)
        <div class="text-center mb-3">
            {{ $logo }}
        </div>
    @endisset

    {{ $slot }}
</div>
