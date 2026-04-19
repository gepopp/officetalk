<div class="space-y-s5">

    {{-- Filter-Bar --}}
    <div class="flex flex-col gap-s3 border-b border-line pb-s4 md:flex-row md:items-center md:justify-between">
        <div class="flex flex-wrap gap-s2">
            <button
                wire:click="$set('topicSlug', null)"
                @class([
                    'rounded border px-s3 py-s1 font-sans text-meta transition-colors',
                    'border-ink bg-ink text-bg' => $topicSlug === null,
                    'border-line bg-bg text-muted hover:border-ink hover:text-ink' => $topicSlug !== null,
                ])
            >
                Alle
            </button>
            @foreach ($topics as $topic)
                <button
                    wire:click="$set('topicSlug', '{{ $topic->slug }}')"
                    @class([
                        'rounded border px-s3 py-s1 font-sans text-meta transition-colors',
                        'border-ink bg-ink text-bg' => $topicSlug === $topic->slug,
                        'border-line bg-bg text-muted hover:border-ink hover:text-ink' => $topicSlug !== $topic->slug,
                    ])
                >
                    {{ $topic->name }}
                </button>
            @endforeach
        </div>

        <div class="relative w-full max-w-sm">
            <label for="archive-search" class="sr-only">Suchen</label>
            <input
                id="archive-search"
                type="search"
                wire:model.live.debounce.300ms="search"
                placeholder="Gast, Unternehmen, Stichwort"
                class="w-full rounded border border-line bg-bg px-s3 py-s2 font-sans text-body text-ink placeholder:text-muted focus-visible:border-ink focus-visible:outline focus-visible:outline-3 focus-visible:outline-ink focus-visible:outline-offset-2"
            />
        </div>
    </div>

    {{-- Loading-State --}}
    <div wire:loading.flex wire:target="topicSlug,search" class="items-center gap-s2 font-sans text-meta text-muted">
        <span class="inline-block h-2 w-2 animate-pulse rounded-full bg-accent"></span>
        Laden …
    </div>

    {{-- Ergebnisse --}}
    @if ($episodes->isNotEmpty())
        <div wire:loading.remove wire:target="topicSlug,search" class="grid gap-s4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($episodes as $episode)
                <x-officetalk::video-card :episode="$episode" layout="grid" wire:key="ep-{{ $episode->id }}" />
            @endforeach
        </div>

        <div class="pt-s4">
            {{ $episodes->links() }}
        </div>
    @else
        <div class="py-s5 text-center">
            <p class="font-sans text-body text-muted">
                Keine Folgen zu diesen Kriterien. Filter zurücksetzen?
            </p>
            <button
                wire:click="resetFilters"
                class="officetalk-link mt-s2 inline-block font-sans text-body font-medium text-ink"
            >
                Alle Folgen ansehen
            </button>
        </div>
    @endif
</div>
