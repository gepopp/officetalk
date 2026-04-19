{{-- Shared Error-Layout · nutzt den OfficeTalk-App-Layout mit Nav + Footer,
     damit Error-Pages konsistent zur Seite wirken statt als isolierte Laravel-Defaults. --}}
<x-officetalk::layouts.app>
    <x-slot:title>
        @yield('title') · OfficeTalk
    </x-slot>

    <section class="relative bg-bg py-s7">
        <div class="container">

            <div class="grid items-center gap-s5 md:grid-cols-12 md:gap-s6">

                {{-- Giant Error-Code als Plakatelement · italic Fraunces --}}
                <div class="md:col-span-5">
                    <p class="font-sans text-eyebrow uppercase tracking-[0.12em] text-muted">
                        @yield('eyebrow', 'Fehler')
                    </p>
                    <p
                        aria-hidden="true"
                        class="mt-s3 font-display text-[140px] font-medium italic leading-[0.85] tracking-tight text-accent md:text-[200px] lg:text-[260px]"
                    >
                        @yield('code')
                    </p>
                </div>

                {{-- Headline + Subline + CTAs --}}
                <div class="md:col-span-7">
                    <h1 class="font-display text-h2 font-medium leading-tight text-balance text-ink md:text-[40px] lg:text-h2" lang="de">
                        @yield('headline')
                    </h1>

                    <p class="mt-s4 max-w-measure font-sans text-lead text-ink">
                        @yield('subline')
                    </p>

                    @hasSection('hint')
                        <p class="mt-s3 max-w-measure font-sans text-meta text-muted">
                            @yield('hint')
                        </p>
                    @endif

                    <div class="mt-s6 flex flex-wrap items-center gap-s3">
                        <a
                            href="{{ route('officetalk.landing') }}"
                            class="inline-flex items-center gap-s2 bg-accent px-s4 py-s3 font-sans text-body font-semibold text-[#111] transition-colors duration-200 hover:bg-[#111] hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent"
                        >
                            Zurück zur Startseite
                            <svg width="18" height="12" viewBox="0 0 18 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M 1 6 L 16 6" />
                                <path d="M 11 1 L 16 6 L 11 11" />
                            </svg>
                        </a>

                        @yield('secondary-cta')
                    </div>
                </div>
            </div>

            {{-- Dezenter Sub-Hinweis unten · Editorial-Signatur --}}
            <div class="mt-s7 border-t border-line pt-s4 font-sans text-meta text-muted">
                <p>
                    Kein Eingang? Schreiben Sie an
                    <a href="mailto:{{ config('officetalk.contact.email') }}" class="officetalk-link font-medium text-ink">
                        {{ config('officetalk.contact.email') }}
                    </a>
                    — wir schauen nach.
                </p>
            </div>
        </div>
    </section>
</x-officetalk::layouts.app>
