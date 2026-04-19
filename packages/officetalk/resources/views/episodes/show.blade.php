@php
    $schema = json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'VideoObject',
        'name' => $episode->title,
        'description' => $episode->abstract,
        'thumbnailUrl' => $episode->still_landscape_url,
        'uploadDate' => $episode->published_at?->toIso8601String(),
        'duration' => $episode->duration_minutes ? "PT{$episode->duration_minutes}M" : null,
        'embedUrl' => $episode->vimeoEmbedUrl(),
        'publisher' => [
            '@type' => 'Organization',
            'name' => config('officetalk.redaktion.publisher'),
            'url' => config('officetalk.redaktion.publisher_url'),
        ],
        'interviewer' => [
            '@type' => 'Person',
            'name' => config('officetalk.redaktion.interviewer'),
            'url' => config('officetalk.redaktion.interviewer_url'),
        ],
        'about' => [
            '@type' => 'Person',
            'name' => $episode->guest->full_name,
            'jobTitle' => $episode->guest->role,
            'worksFor' => [
                '@type' => 'Organization',
                'name' => $episode->guest->company,
            ],
        ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
@endphp

<x-officetalk::layouts.app
    :title="$episode->resolved_meta_title"
    :metaDescription="$episode->resolved_meta_description"
    :canonical="route('officetalk.episodes.show', $episode)"
    :ogImage="$episode->still_landscape_url"
    ogType="video.other"
    :schema="$schema"
>
    <article>
        {{-- Kopf --}}
        <header class="bg-bg py-s6">
            <div class="mx-auto max-w-[900px] px-s3 md:px-s5">
                <x-officetalk::eyebrow>
                    {{ $episode->episode_label }} · {{ $episode->published_at?->translatedFormat('j. F Y') }}
                </x-officetalk::eyebrow>

                <h1 class="mt-s3 font-display text-4xl font-medium leading-tight text-ink md:text-5xl lg:text-[64px] lg:leading-[1.05]">
                    {{ $episode->title }}
                </h1>

                <p class="mt-s4 font-sans text-lead text-muted">
                    <span class="text-ink">{{ $episode->guest->full_name }}</span>,
                    {{ $episode->guest->role_line }}
                </p>
            </div>
        </header>

        {{-- Video --}}
        @if ($episode->vimeoEmbedUrl())
            <div class="bg-bg pb-s5">
                <div class="container">
                    <div class="relative aspect-video overflow-hidden rounded bg-surface-strong">
                        <iframe
                            src="{{ $episode->vimeoEmbedUrl() }}"
                            class="absolute inset-0 h-full w-full"
                            frameborder="0"
                            allow="autoplay; fullscreen; picture-in-picture"
                            allowfullscreen
                            title="{{ $episode->title }}"
                        ></iframe>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-bg pb-s5">
                <div class="container">
                    <img
                        src="{{ $episode->still_landscape_url }}"
                        alt="{{ $episode->title }}"
                        class="aspect-video w-full rounded object-cover"
                    />
                </div>
            </div>
        @endif

        {{-- Abstract + Transkript --}}
        <div class="bg-bg py-s5">
            <div class="mx-auto max-w-[760px] px-s3 md:px-s5">

                @if ($episode->lead_quote)
                    <x-officetalk::pullquote :author="$episode->guest->full_name">
                        „{{ $episode->lead_quote }}"
                    </x-officetalk::pullquote>
                @endif

                <div class="prose prose-lg max-w-none font-sans text-body text-ink">
                    <p class="text-lead">{{ $episode->abstract }}</p>
                </div>

                {{-- Topics --}}
                @if ($episode->topics->isNotEmpty())
                    <div class="mt-s5 flex flex-wrap gap-s2">
                        @foreach ($episode->topics as $topic)
                            <a
                                href="{{ route('officetalk.topics.show', $topic) }}"
                                class="inline-block rounded border border-line bg-surface px-s2 py-s1 font-sans text-meta text-muted transition-colors hover:border-ink hover:text-ink"
                            >
                                {{ $topic->name }}
                            </a>
                        @endforeach
                    </div>
                @endif

                {{-- Externe Links --}}
                <div class="mt-s5 flex flex-wrap gap-s3 font-sans text-meta">
                    @if ($episode->linkedin_url)
                        <a href="{{ $episode->linkedin_url }}" class="officetalk-link text-ink" target="_blank" rel="noopener">
                            Auf LinkedIn ansehen ↗
                        </a>
                    @endif
                    @if ($episode->spotify_url)
                        <a href="{{ $episode->spotify_url }}" class="officetalk-link text-ink" target="_blank" rel="noopener">
                            Als Podcast hören ↗
                        </a>
                    @endif
                </div>

                {{-- Transkript --}}
                @if ($episode->transcript_markdown)
                    <details class="mt-s6 border-t border-line pt-s4">
                        <summary class="cursor-pointer font-display text-h3 font-medium text-ink">
                            Transkript
                        </summary>
                        <div class="prose prose-lg mt-s3 max-w-none font-sans text-body text-ink">
                            {!! \Illuminate\Support\Str::markdown($episode->transcript_markdown) !!}
                        </div>
                    </details>
                @endif
            </div>
        </div>

        {{-- Verwandte Folgen --}}
        @if ($related->isNotEmpty())
            <section class="bg-surface py-s6">
                <div class="container">
                    <x-officetalk::eyebrow>Verwandte Folgen</x-officetalk::eyebrow>
                    <h2 class="mt-s2 font-display text-h2 font-medium text-ink">Weiterlesen</h2>

                    <div class="mt-s5 grid gap-s4 md:grid-cols-3">
                        @foreach ($related as $r)
                            <x-officetalk::video-card :episode="$r" layout="grid" />
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </article>
</x-officetalk::layouts.app>
