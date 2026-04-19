@props(['episode', 'layout' => 'split'])

@if ($layout === 'split')
    <article class="officetalk-card group grid grid-cols-1 gap-s4 md:grid-cols-12 md:gap-s5">
        {{-- Still 7 cols --}}
        <a
            href="{{ route('officetalk.episodes.show', $episode) }}"
            class="relative block overflow-hidden rounded bg-surface md:col-span-7"
            aria-label="Episode ansehen: {{ $episode->title }}"
        >
            <img
                src="{{ $episode->still_landscape_url }}"
                alt="Walter Senk im Gespräch mit {{ $episode->guest->full_name }}, {{ $episode->guest->company }}"
                loading="lazy"
                class="officetalk-card__thumb aspect-video w-full object-cover"
            />
            {{-- Play-Overlay --}}
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="flex h-16 w-16 items-center justify-center rounded-full border border-white/70 bg-ink/30 backdrop-blur-sm">
                    <svg width="18" height="22" viewBox="0 0 18 22" fill="white" aria-hidden="true">
                        <path d="M 0 0 L 18 11 L 0 22 Z" />
                    </svg>
                </div>
            </div>
            {{-- Koffer-Signet --}}
            <div class="absolute bottom-s2 right-s2 text-accent">
                <x-officetalk::logo-mark :size="40" color="currentColor" />
            </div>
        </a>

        {{-- Meta 5 cols --}}
        <div class="flex flex-col justify-center md:col-span-5">
            <x-officetalk::eyebrow>
                {{ $episode->episode_label }} · {{ $episode->published_at?->translatedFormat('F Y') }}
            </x-officetalk::eyebrow>

            <h3 class="mt-s2 font-display text-h3 font-medium text-ink">
                <a href="{{ route('officetalk.episodes.show', $episode) }}" class="officetalk-link">
                    {{ $episode->title }}
                </a>
            </h3>

            <p class="mt-s2 font-sans text-body text-muted">
                <span class="text-ink">{{ $episode->guest->full_name }}</span>,
                {{ $episode->guest->role_line }}
            </p>

            <p class="mt-s3 font-sans text-body text-ink max-w-measure">
                {{ \Illuminate\Support\Str::limit($episode->abstract, 180) }}
            </p>

            <div class="mt-s4 flex items-center gap-s3 font-sans text-meta text-muted">
                @if ($episode->duration_minutes)
                    <span>{{ $episode->duration_minutes }} Min</span>
                    <span aria-hidden="true">·</span>
                @endif
                <a href="{{ route('officetalk.episodes.show', $episode) }}" class="officetalk-link text-ink font-medium">
                    Folge ansehen
                </a>
            </div>
        </div>
    </article>
@else
    {{-- Grid-Layout für Archiv --}}
    <article class="officetalk-card group">
        <a
            href="{{ route('officetalk.episodes.show', $episode) }}"
            class="relative block overflow-hidden rounded bg-surface"
        >
            <img
                src="{{ $episode->still_landscape_url }}"
                alt="Walter Senk im Gespräch mit {{ $episode->guest->full_name }}"
                loading="lazy"
                class="officetalk-card__thumb aspect-video w-full object-cover"
            />
            <div class="absolute bottom-s1 right-s1 text-accent">
                <x-officetalk::logo-mark :size="28" color="currentColor" />
            </div>
        </a>
        <div class="mt-s3">
            <x-officetalk::eyebrow>
                {{ $episode->episode_label }}
            </x-officetalk::eyebrow>
            <h3 class="mt-s1 font-display text-h4 font-medium text-ink">
                <a href="{{ route('officetalk.episodes.show', $episode) }}" class="officetalk-link">
                    {{ $episode->title }}
                </a>
            </h3>
            <p class="mt-s1 font-sans text-meta text-muted">
                {{ $episode->guest->full_name }}, {{ $episode->guest->company }}
            </p>
        </div>
    </article>
@endif
