<?php

use Illuminate\Support\Collection;
use Livewire\Component;

new class extends Component {
    public Collection $latest;
};
?>

<div>
    @if ($latest->isNotEmpty())
        <section class="bg-bg py-s6" id="folgen">
            <div class="container">
                <div class="mb-s5 flex items-end justify-between gap-s3">
                    <div>
                        <x-officetalk::eyebrow>Aktuelle Folgen</x-officetalk::eyebrow>
                        <h2 class="mt-s2 font-display text-h2 font-medium text-ink">
                            Stimmen aus der Branche
                        </h2>
                    </div>
                    <a href="{{ route('officetalk.episodes.index') }}" class="officetalk-link hidden font-sans text-body font-medium text-ink md:inline-block">
                        Zum Archiv →
                    </a>
                </div>

                <div class="space-y-s6">
                    @foreach ($latest as $episode)
                        <x-officetalk::video-card :episode="$episode" wire:key="episode-{{ $episode->id }}" />
                    @endforeach
                </div>

                <div class="mt-s6 text-center md:hidden">
                    <x-officetalk::button variant="secondary" :href="route('officetalk.episodes.index')">
                        Zum Archiv
                    </x-officetalk::button>
                </div>
            </div>
        </section>
    @endif
</div>
