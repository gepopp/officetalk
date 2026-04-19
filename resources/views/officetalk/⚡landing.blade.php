<?php

use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Officetalk\Models\Episode;

new
#[Layout('officetalk::components.layouts.app')]
#[Title('B2B-Videoproduktion Wien · Immobilien, Bau, PropTech')]
class extends Component {
    public ?Episode $featured = null;

    public Collection $latest;

    public function mount(): void
    {
        $this->featured = Episode::query()
            ->published()
            ->featured()
            ->with(['guest', 'topics'])
            ->orderByDesc('published_at')
            ->first();

        $this->latest = Episode::query()
            ->published()
            ->with(['guest', 'topics'])
            ->when($this->featured, fn ($q) => $q->whereKeyNot($this->featured->id))
            ->orderByDesc('published_at')
            ->limit(5)
            ->get();
    }
};
?>

<x-slot:metaDescription>
    OfficeTalk produziert Fachinterviews, Event-After-Movies und Projektpräsentationen für Immobilien, Bau und PropTech in Wien und im DACH-Raum. 95 Euro pro Stunde, minutengenau.
</x-slot>

<x-slot:canonical>{{ route('officetalk.landing') }}</x-slot>

{{-- BreadcrumbList-Schema für die Startseite --}}
<x-slot:schema>
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [[
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Start',
            'item' => route('officetalk.landing'),
        ]],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</x-slot>

<div>
    <livewire:officetalk::parts.hero :featured="$featured" />

    <div data-officetalk-divider class="officetalk-divider container"></div>

    <livewire:officetalk::parts.distribution />

    <livewire:officetalk::parts.service />

    {{-- <livewire:officetalk::parts.format /> --}}

    {{-- <div data-officetalk-divider class="officetalk-divider container"></div> --}}

    {{-- <livewire:officetalk::parts.episodes :latest="$latest" /> --}}

    {{-- <livewire:officetalk::parts.benefits /> --}}

    {{-- <div data-officetalk-divider class="officetalk-divider container"></div> --}}

    <livewire:officetalk::parts.formats />

    <livewire:officetalk::parts.pricing />

    <div data-officetalk-divider class="officetalk-divider container"></div>

    {{-- <livewire:officetalk::parts.editors /> --}}

    <livewire:officetalk::parts.faq />

    <livewire:officetalk::parts.contact />
</div>
