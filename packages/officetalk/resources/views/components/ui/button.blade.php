@props(['href' => null, 'icon' => null, 'iconPosition' => 'left', 'arrow' => true])

@php
    $renderIcon = $icon !== null;
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes()]) }}>
        @if ($renderIcon && $iconPosition === 'left')
            <span class="flex shrink-0 self-stretch items-center">
                @if ($icon === 'koffer')
                    <x-officetalk::logo-mark
                        :size="20"
                        class="!h-full w-auto origin-center transition-transform duration-300 ease-editorial motion-safe:group-hover:rotate-[12deg]"
                    />
                @elseif ($icon === 'arrow')
                    <svg
                        viewBox="0 0 20 14"
                        class="!h-full w-auto transition-transform duration-300 ease-editorial motion-safe:group-hover:translate-x-1"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" aria-hidden="true"
                    >
                        <line x1="1" y1="7" x2="17" y2="7" />
                        <polyline points="12,2 18,7 12,12" />
                    </svg>
                @endif
            </span>
        @endif

        {{ $slot }}

        @if ($renderIcon && $iconPosition === 'right')
            <span class="flex shrink-0 self-stretch items-center">
                @if ($icon === 'koffer')
                    <x-officetalk::logo-mark
                        :size="20"
                        class="!h-full w-auto origin-center transition-transform duration-300 ease-editorial motion-safe:group-hover:rotate-[12deg]"
                    />
                @elseif ($icon === 'arrow')
                    <svg
                        viewBox="0 0 20 14"
                        class="!h-full w-auto transition-transform duration-300 ease-editorial motion-safe:group-hover:translate-x-1"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" aria-hidden="true"
                    >
                        <line x1="1" y1="7" x2="17" y2="7" />
                        <polyline points="12,2 18,7 12,12" />
                    </svg>
                @endif
            </span>
        @endif

        @if ($variant === 'primary' && $arrow && ! $renderIcon)
            <span aria-hidden="true" class="transition-transform group-hover:translate-x-1">→</span>
        @endif
    </a>
@else
    <button type="{{ $attributes->get('type', 'button') }}" {{ $attributes->merge(['class' => $classes()]) }}>
        @if ($renderIcon && $iconPosition === 'left')
            <span class="flex shrink-0 self-stretch items-center">
                @if ($icon === 'koffer')
                    <x-officetalk::logo-mark
                        :size="20"
                        class="!h-full w-auto origin-center transition-transform duration-300 ease-editorial motion-safe:group-hover:rotate-[12deg]"
                    />
                @elseif ($icon === 'arrow')
                    <svg
                        viewBox="0 0 20 14"
                        class="!h-full w-auto transition-transform duration-300 ease-editorial motion-safe:group-hover:translate-x-1"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" aria-hidden="true"
                    >
                        <line x1="1" y1="7" x2="17" y2="7" />
                        <polyline points="12,2 18,7 12,12" />
                    </svg>
                @endif
            </span>
        @endif

        {{ $slot }}

        @if ($renderIcon && $iconPosition === 'right')
            <span class="flex shrink-0 self-stretch items-center">
                @if ($icon === 'koffer')
                    <x-officetalk::logo-mark
                        :size="20"
                        class="!h-full w-auto origin-center transition-transform duration-300 ease-editorial motion-safe:group-hover:rotate-[12deg]"
                    />
                @elseif ($icon === 'arrow')
                    <svg
                        viewBox="0 0 20 14"
                        class="!h-full w-auto transition-transform duration-300 ease-editorial motion-safe:group-hover:translate-x-1"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" aria-hidden="true"
                    >
                        <line x1="1" y1="7" x2="17" y2="7" />
                        <polyline points="12,2 18,7 12,12" />
                    </svg>
                @endif
            </span>
        @endif

        @if ($variant === 'primary' && $arrow && ! $renderIcon)
            <span aria-hidden="true">→</span>
        @endif
    </button>
@endif
