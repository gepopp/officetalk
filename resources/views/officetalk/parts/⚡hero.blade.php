<?php

use Livewire\Component;
use Officetalk\Models\Episode;

new class extends Component {
    public ?Episode $featured = null;
};
?>

<section class="bg-bg py-s6 md:py-s7" id="format">
    <div class="container grid gap-s5 md:grid-cols-12 md:gap-s6">

        <livewire:officetalk::parts.hero-video :featured="$featured" />

        <div class="flex flex-col justify-center md:col-span-8 lg:col-span-6">
            <h2 class="font-sans text-eyebrow uppercase text-muted">
                Konzeption · Dreh · Schnitt
            </h2>

            <h1 class="mt-s3 font-display text-4xl font-medium leading-tight text-ink text-balance md:text-5xl lg:text-[56px] lg:leading-[1.08] xl:text-[72px] xl:leading-[1.05]">
                B2B-Videoproduktion in Wien.
            </h1>

            <p class="mt-s4 font-sans text-lead text-muted max-w-measure">
                Interviews, Projektvideos, Teleprompter-Clips und LinkedIn-Reels für Immobilien, Bau, PropTech, Kanzleien, Architekturbüros und Steuerberatungen im DACH-Raum.
            </p>

            <div class="mt-s5 grid gap-s3 sm:grid-cols-2 sm:gap-s4">
                <x-officetalk::button
                    variant="primary"
                    icon="koffer"
                    :arrow="false"
                    href="#kontakt"
                    class="w-full justify-center !text-sm xl:!text-base"
                >
                    Erstgespräch vereinbaren
                </x-officetalk::button>

                <x-officetalk::button
                    variant="secondary"
                    icon="arrow"
                    iconPosition="right"
                    href="#preise"
                    class="w-full justify-center !text-sm xl:!text-base"
                >
                    Leistungen und Preise ansehen
                </x-officetalk::button>
            </div>

        </div>
    </div>
</section>
