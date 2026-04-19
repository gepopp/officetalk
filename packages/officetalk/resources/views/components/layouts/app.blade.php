<!DOCTYPE html>
<html lang="de" data-officetalk class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- SEO · Title, Meta-Description, Canonical, Open Graph, Twitter Cards, Schema.org Organization.
         Per-Page-Overrides kommen über x-slot:title / metaDescription / canonical / ogImage / schema. --}}
    @include('officetalk::partials.seo-head', [
        'title' => $title ?? null,
        'metaDescription' => $metaDescription ?? null,
        'canonical' => $canonical ?? null,
        'robots' => $robots ?? null,
        'ogType' => $ogType ?? null,
        'ogTitle' => $ogTitle ?? null,
        'ogDescription' => $ogDescription ?? null,
        'ogImage' => $ogImage ?? null,
        'schema' => $schema ?? null,
        'hreflang' => $hreflang ?? null,
    ])

    {{-- Favicons --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <meta name="theme-color" content="#E3B505">

    {{-- Adobe-Fonts-Typekit · DNS-Preconnect beschleunigt das CSS-Fetching --}}
    <link rel="preconnect" href="https://use.typekit.net" crossorigin>
    <link rel="preconnect" href="https://p.typekit.net" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @fluxAppearance

    {{-- Cookie-Consent · lädt GA4 erst nach ausdrücklicher Einwilligung.
         Das Paket rendert Consent-Mode-v2-kompatible gtag-Defaults (alles "denied")
         und schaltet analytics_storage erst bei Consent auf "granted". --}}
    @cookieconsentscripts
</head>
<body class="bg-bg font-sans text-ink antialiased">
    <livewire:officetalk::chrome.nav />

    <main>
        {{ $slot }}
    </main>

    <livewire:officetalk::chrome.footer />

    {{-- Globale Video-Lightbox · reagiert auf Alpine.store('videoLightbox').open(...) --}}
    <livewire:officetalk::chrome.video-lightbox />

    {{-- Cookie-Consent-Banner · zeigt sich nur, wenn noch keine Einwilligung vorliegt --}}
    @cookieconsentview

    @livewireScripts
    @fluxScripts
</body>
</html>
