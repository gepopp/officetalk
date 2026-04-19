<?php

use Livewire\Component;

new class extends Component {
    public array $referenceGuests = [
        'VÖPE',
        'JP Immobilien',
        'Team Gnesda',
        'Forvis Mazars',
        'PlanRadar',
        'Ulreich Bauträger',
        'BUWOG',
        'Schönherr',
    ];
};
?>

<section class="bg-surface py-s5">
    <div class="container">
        <x-officetalk::eyebrow>Bereits porträtiert</x-officetalk::eyebrow>
        <h2 class="mt-s2 font-display text-h3 font-medium text-ink">
            Gäste aus Immobilien, Kanzleien, PropTech.
        </h2>

        <ul class="mt-s5 grid grid-cols-2 gap-s3 md:grid-cols-4 lg:grid-cols-8" role="list" aria-label="Bisherige Gäste">
            @foreach ($referenceGuests as $label)
                <li class="flex h-16 items-center justify-center rounded border border-line bg-bg px-s3 font-display text-h4 font-medium text-ink">
                    {{ $label }}
                </li>
            @endforeach
        </ul>
    </div>
</section>
