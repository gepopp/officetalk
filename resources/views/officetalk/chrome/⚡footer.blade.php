<?php

use Livewire\Component;

new class extends Component {};
?>

@php
    $contact = config('officetalk.contact');
    $landing = route('officetalk.landing');
@endphp

<footer class="bg-surface-strong py-s7 text-bg">
    <div class="container">

        {{-- Hauptlayout · 4 Spalten auf lg, 2 auf md, 1 auf mobile --}}
        <div class="grid grid-cols-1 gap-s5 md:grid-cols-2 lg:grid-cols-4 lg:gap-s6">

            {{-- Spalte 1 · Identifikation --}}
            <div>
                <h2 class="sr-only">Unternehmen</h2>
                <div class="flex items-center gap-s2">
                    <span class="text-accent">
                        <x-officetalk::logo-mark :size="32" color="currentColor" />
                    </span>
                    <span class="font-display text-h4 font-medium text-bg">{{ $contact['brand_name'] }}</span>
                </div>
                <address class="mt-s3 font-sans text-body not-italic leading-relaxed text-bg/85">
                    {{ $contact['legal_name'] }}<br>
                    {{ $contact['tagline'] }}<br>
                    {{ $contact['address']['street'] }}<br>
                    {{ $contact['address']['postal_code'] }} {{ $contact['address']['city'] }},
                    {{ $contact['address']['country'] }}
                </address>
            </div>

            {{-- Spalte 2 · Navigation --}}
            <nav aria-label="Footer-Navigation">
                <h2 class="font-sans text-eyebrow uppercase tracking-[0.08em] text-bg/60">
                    Navigation
                </h2>
                <ul class="mt-s3 space-y-s2 font-sans text-body">
                    <li><a href="{{ $landing }}#distribution" wire:navigatepa  class="officetalk-link text-bg transition-colors duration-200 hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent">Distribution</a></li>
                    <li><a href="{{ $landing }}#service" wire:navigatepa  class="officetalk-link text-bg transition-colors duration-200 hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent">Prozess</a></li>
                    <li><a href="{{ $landing }}#formats" wire:navigatepa  class="officetalk-link text-bg transition-colors duration-200 hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent">Formate</a></li>
                    <li><a href="{{ $landing }}#preise" wire:navigatepa  class="officetalk-link text-bg transition-colors duration-200 hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent">Preise</a></li>
                    <li><a href="{{ $landing }}#faq" wire:navigatepa  class="officetalk-link text-bg transition-colors duration-200 hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent">FAQ</a></li>
                    <li><a href="{{ $landing }}#kontakt" wire:navigatepa  class="officetalk-link text-bg transition-colors duration-200 hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent">Kontakt</a></li>
                </ul>
            </nav>

            {{-- Spalte 3 · Kontakt --}}
            <div>
                <h2 class="font-sans text-eyebrow uppercase tracking-[0.08em] text-bg/60">
                    Kontakt
                </h2>
                <ul class="mt-s3 space-y-s2 font-sans text-body">
                    @if ($contact['phone'] && $contact['phone'] !== '[Telefonnummer]')
                        <li><a href="tel:{{ preg_replace('/\s+/', '', $contact['phone']) }}" class="officetalk-link text-bg transition-colors duration-200 hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent">{{ $contact['phone'] }}</a></li>
                    @endif
                    <li><a href="mailto:{{ $contact['email'] }}" class="officetalk-link text-bg transition-colors duration-200 hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent">{{ $contact['email'] }}</a></li>
                    @if ($contact['calendar_url'] && $contact['calendar_url'] !== '#')
                        <li><a href="{{ $contact['calendar_url'] }}" target="_blank" rel="noopener noreferrer" class="officetalk-link text-bg transition-colors duration-200 hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent">Termin buchen</a></li>
                    @endif
                    @if ($contact['linkedin_url'])
                        <li><a href="{{ $contact['linkedin_url'] }}" target="_blank" rel="noopener noreferrer" class="officetalk-link text-bg transition-colors duration-200 hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent">LinkedIn-Profil</a></li>
                    @endif
                </ul>
            </div>

            {{-- Spalte 4 · Kooperationspartner --}}
            <div>
                <h2 class="font-sans text-eyebrow uppercase tracking-[0.08em] text-bg/60">
                    Redaktionelle Distribution
                </h2>
                <ul class="mt-s3 space-y-s2 font-sans text-body">
                    @foreach ($contact['partners'] as $partner)
                        <li>
                            <a
                                href="{{ $partner['url'] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="officetalk-link text-bg transition-colors duration-200 hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent"
                            >
                                {{ $partner['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Trennlinie --}}
        <hr class="my-s5 border-t border-bg/20" />

        {{-- Rechtsbalken · Copyright links, Legal-Links rechts --}}
        <div class="flex flex-col items-start justify-between gap-s3 font-sans text-meta text-bg/60 md:flex-row md:items-center">
            <p>
                © {{ date('Y') }} {{ $contact['brand_name'] }} · {{ $contact['legal_name'] }} · Alle Rechte vorbehalten.
            </p>
            <nav aria-label="Rechtliche Links">
                <ul class="flex flex-wrap items-center gap-x-s2 gap-y-s1">
                    <li><a href="{{ route('officetalk.legal.impressum') }}" class="transition-colors duration-200 hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent">Impressum</a></li>
                    <li aria-hidden="true" class="text-bg/30">·</li>
                    <li><a href="{{ route('officetalk.legal.datenschutz') }}" class="transition-colors duration-200 hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent">Datenschutz</a></li>
                    <li aria-hidden="true" class="text-bg/30">·</li>
                    <li><a href="{{ route('officetalk.legal.agb') }}" class="transition-colors duration-200 hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent">AGB</a></li>
                </ul>
            </nav>
        </div>

        {{-- Microcopy-Block · Geo-Einordnung + Team-Kontext, sehr dezent --}}
        <div class="mt-s4 border-t border-bg/10 pt-s4 font-sans text-meta text-bg/55 leading-relaxed">
            <p>Videoproduktion in Wien, Drehs im gesamten DACH-Raum.</p>
            <p class="mt-s1">
                Produktion: Gerhard Popp · Redaktionelle Kooperationspartner: Walter Senk und Bernd Affenzeller.
            </p>
        </div>
    </div>
</footer>
