@props([
    'vimeoId' => null,
    'title' => null,
    'posterUrl' => null,
    'posterAlt' => '',
    'eager' => false,
])

@php
    $posterUrl ??= 'https://vumbnail.com/'.$vimeoId.'.jpg';
@endphp

<div
    x-data="officetalkVideoClip({ vimeoId: '{{ $vimeoId }}', title: @js($title) })"
    {{ $attributes->class(['officetalk-video-player relative aspect-video w-full overflow-hidden rounded-sm bg-surface-strong ring-1 ring-line']) }}
>
    {{-- Poster + zentraler Play-Button · bis zum ersten Klick --}}
    <button
        type="button"
        @click="start"
        x-show="!playing"
        class="group/play absolute inset-0 h-full w-full cursor-pointer text-left transition-opacity duration-300 focus-visible:outline focus-visible:outline-3 focus-visible:outline-offset-[-3px] focus-visible:outline-accent"
        aria-label="Video abspielen: {{ $title }}"
    >
        <img
            src="{{ $posterUrl }}"
            alt="{{ $posterAlt }}"
            loading="{{ $eager ? 'eager' : 'lazy' }}"
            class="absolute inset-0 h-full w-full object-cover transition-transform duration-[1200ms] ease-editorial group-hover/play:scale-[1.04]"
        />
        <span aria-hidden="true" class="absolute inset-0 bg-gradient-to-t from-ink/70 via-ink/10 to-transparent"></span>
        <span
            aria-hidden="true"
            class="absolute left-1/2 top-1/2 flex h-20 w-20 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full border-2 border-bg/90 bg-ink/30 backdrop-blur-md transition-all duration-500 ease-editorial group-hover/play:h-24 group-hover/play:w-24 group-hover/play:border-accent group-hover/play:bg-accent md:h-24 md:w-24 md:group-hover/play:h-28 md:group-hover/play:w-28"
        >
            <svg width="24" height="26" viewBox="0 0 18 22" fill="currentColor" class="ml-1 text-bg transition-colors duration-500 group-hover/play:text-ink" aria-hidden="true">
                <path d="M 0 0 L 18 11 L 0 22 Z" />
            </svg>
        </span>
    </button>

    {{-- Vimeo-Iframe · lädt erst nach Klick, controls=0 — unsere Overlay-Controls übernehmen --}}
    <template x-if="playing">
        <iframe
            :src="`https://player.vimeo.com/video/${vimeoId}?autoplay=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;controls=0&amp;dnt=1`"
            class="absolute inset-0 h-full w-full"
            title="{{ $title }}"
            frameborder="0"
            allow="autoplay; fullscreen; picture-in-picture"
            allowfullscreen
            @load="attachPlayer($el)"
        ></iframe>
    </template>

    {{-- Custom Controls · Play/Pause · Mute/Unmute · Fullscreen → Lightbox --}}
    <div
        x-show="playing && ready"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="pointer-events-auto absolute bottom-s3 left-s3 right-s3 flex items-center justify-between"
    >
        <div class="flex items-center gap-s1 rounded-full bg-ink/85 p-1 text-bg backdrop-blur-sm">
            <button
                type="button"
                @click="togglePlay()"
                class="flex h-10 w-10 items-center justify-center rounded-full transition-colors duration-180 hover:bg-accent hover:text-ink focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
                :aria-label="isPlaying ? 'Pause' : 'Wiedergabe'"
            >
                <svg x-show="isPlaying" width="14" height="16" viewBox="0 0 14 16" fill="currentColor" aria-hidden="true">
                    <rect x="1" y="1" width="4" height="14" />
                    <rect x="9" y="1" width="4" height="14" />
                </svg>
                <svg x-show="!isPlaying" x-cloak width="14" height="16" viewBox="0 0 14 16" fill="currentColor" aria-hidden="true">
                    <path d="M 1 1 L 13 8 L 1 15 Z" />
                </svg>
            </button>

            <button
                type="button"
                @click="toggleMute()"
                class="flex h-10 w-10 items-center justify-center rounded-full transition-colors duration-180 hover:bg-accent hover:text-ink focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
                :aria-label="isMuted ? 'Ton einschalten' : 'Stummschalten'"
            >
                <svg x-show="!isMuted" width="18" height="16" viewBox="0 0 18 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M 1 6 L 1 10 L 4 10 L 8 13 L 8 3 L 4 6 Z" fill="currentColor" />
                    <path d="M 11 5.5 C 12.5 6.5 12.5 9.5 11 10.5" />
                    <path d="M 13.5 3.5 C 16 5 16 11 13.5 12.5" />
                </svg>
                <svg x-show="isMuted" x-cloak width="18" height="16" viewBox="0 0 18 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M 1 6 L 1 10 L 4 10 L 8 13 L 8 3 L 4 6 Z" fill="currentColor" />
                    <line x1="12" y1="5" x2="17" y2="11" />
                    <line x1="17" y1="5" x2="12" y2="11" />
                </svg>
            </button>
        </div>

        {{-- Fullscreen → öffnet globalen Lightbox im 720p-Player-Modus --}}
        <button
            type="button"
            @click="openFullscreen()"
            class="flex h-10 w-10 items-center justify-center rounded-full bg-ink/85 text-bg backdrop-blur-sm transition-colors duration-180 hover:bg-accent hover:text-ink focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent"
            aria-label="Im Fokus-Modus ansehen"
        >
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M 2 6 L 2 2 L 6 2" />
                <path d="M 14 6 L 14 2 L 10 2" />
                <path d="M 2 10 L 2 14 L 6 14" />
                <path d="M 14 10 L 14 14 L 10 14" />
            </svg>
        </button>
    </div>
</div>
