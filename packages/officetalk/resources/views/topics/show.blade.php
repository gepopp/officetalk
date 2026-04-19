<x-officetalk::layouts.app
    :title="'Thema: '.$topic->name.' – OfficeTalk'"
    :metaDescription="$topic->description ?? 'Alle OfficeTalk-Folgen zum Thema '.$topic->name.'.'"
    :canonical="route('officetalk.topics.show', $topic)"
>
    <section class="bg-bg py-s6">
        <div class="container">
            <x-officetalk::eyebrow>Thema</x-officetalk::eyebrow>
            <h1 class="mt-s2 font-display text-h1 font-medium text-ink">{{ $topic->name }}</h1>
            @if ($topic->description)
                <p class="mt-s3 font-sans text-lead text-muted max-w-measure">
                    {{ $topic->description }}
                </p>
            @endif
        </div>
    </section>

    @if ($topic->episodes->isNotEmpty())
        <section class="bg-bg pb-s7">
            <div class="container">
                <div class="grid gap-s4 md:grid-cols-3">
                    @foreach ($topic->episodes as $episode)
                        <x-officetalk::video-card :episode="$episode" layout="grid" />
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <section class="bg-bg pb-s7">
            <div class="container">
                <p class="font-sans text-body text-muted">
                    Noch keine veröffentlichten Folgen zu diesem Thema.
                </p>
            </div>
        </section>
    @endif
</x-officetalk::layouts.app>
