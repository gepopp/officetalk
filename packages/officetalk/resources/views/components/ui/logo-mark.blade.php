{{--
    OfficeTalk-Bildmarke · K1 final.
    Koffer mit integriertem Kamera-Objektiv.
    Geometrie: viewBox 140×84.
    variant="color" → Gehäuse in $color (Accent via currentColor), Rillen/Linse in Ink.
    variant="mono"  → alles in $color, Linse gefüllt, Reflex hell.
--}}
@php
    $height = (int) round($size * 84 / 140);
@endphp

<svg
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 140 84"
    width="{{ $size }}"
    height="{{ $height }}"
    aria-hidden="true"
    {{ $attributes }}
>
    @if ($variant === 'mono')
        {{-- Griff --}}
        <path d="M 54 14 L 54 6 L 86 6 L 86 14"
              stroke="{{ $color }}" stroke-width="4" fill="none" stroke-linecap="square" />

        {{-- Gehäuse --}}
        <rect x="12" y="16" width="116" height="60" rx="2" ry="2"
              stroke="{{ $color }}" stroke-width="4" fill="none" />

        {{-- Rillen --}}
        <line x1="42" y1="28" x2="98" y2="28" stroke="{{ $color }}" stroke-width="4" />
        <line x1="42" y1="64" x2="98" y2="64" stroke="{{ $color }}" stroke-width="4" />

        {{-- Objektiv --}}
        <circle cx="70" cy="46" r="11" fill="{{ $color }}" />

        {{-- Reflex --}}
        <ellipse cx="66.5" cy="43" rx="3.6" ry="1.8" fill="#FAFAF7" opacity="0.7"
                 transform="rotate(-30 66.5 43)" />
    @else
        {{-- Griff --}}
        <path d="M 54 14 L 54 6 L 86 6 L 86 14"
              stroke="{{ $color }}" stroke-width="4" fill="none" stroke-linecap="square" />

        {{-- Gehäuse --}}
        <rect x="12" y="16" width="116" height="60" rx="2" ry="2" fill="{{ $color }}" />

        {{-- Rillen — Ink im Light, Accent im Dark (via CSS-Variable) --}}
        <line x1="42" y1="28" x2="98" y2="28" stroke="var(--color-koffer-detail)" stroke-width="4" />
        <line x1="42" y1="64" x2="98" y2="64" stroke="var(--color-koffer-detail)" stroke-width="4" />

        {{-- Objektiv --}}
        <circle cx="70" cy="46" r="11" fill="var(--color-koffer-detail)" />

        {{-- Reflex --}}
        <ellipse cx="66.5" cy="43" rx="3.6" ry="1.8" fill="#FAFAF7" opacity="0.7"
                 transform="rotate(-30 66.5 43)" />
    @endif
</svg>
