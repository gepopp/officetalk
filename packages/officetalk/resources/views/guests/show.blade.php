<x-officetalk::layouts.app
    :title="$guest->full_name.' – OfficeTalk'"
    :metaDescription="$guest->bio_short ?? ($guest->full_name.', '.$guest->role.', '.$guest->company)"
    :canonical="route('officetalk.guests.show', $guest)"
>
    <section class="bg-bg py-s6">
        <div class="container">
            <div class="grid gap-s5 md:grid-cols-12">
                <div class="md:col-span-4">
                    <img
                        src="{{ \Officetalk\Support\CdnUrl::for($guest->portrait) }}"
                        alt="Portrait {{ $guest->full_name }}"
                        class="aspect-square w-full rounded object-cover"
                    />
                </div>
                <div class="md:col-span-8">
                    <x-officetalk::eyebrow>Gast-Profil</x-officetalk::eyebrow>
                    <h1 class="mt-s2 font-display text-h1 font-medium text-ink">{{ $guest->full_name }}</h1>
                    <p class="mt-s3 font-sans text-lead text-muted">
                        {{ $guest->role_line }}
                    </p>
                    @if ($guest->bio_long)
                        <div class="mt-s4 prose max-w-measure font-sans text-body text-ink">
                            {!! nl2br(e($guest->bio_long)) !!}
                        </div>
                    @endif
                    @if ($guest->linkedin_url)
                        <a href="{{ $guest->linkedin_url }}" class="officetalk-link mt-s4 inline-block font-medium text-ink" target="_blank" rel="noopener">
                            LinkedIn-Profil ansehen ↗
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @if ($guest->episodes->isNotEmpty())
        <section class="bg-surface py-s6">
            <div class="container">
                <x-officetalk::eyebrow>Folgen mit {{ $guest->first_name }} {{ $guest->last_name }}</x-officetalk::eyebrow>
                <h2 class="mt-s2 font-display text-h2 font-medium text-ink">Gespräche</h2>

                <div class="mt-s5 space-y-s5">
                    @foreach ($guest->episodes as $episode)
                        <x-officetalk::video-card :episode="$episode" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-officetalk::layouts.app>
