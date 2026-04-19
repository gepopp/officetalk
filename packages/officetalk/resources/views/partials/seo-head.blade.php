@php
    $seo = config('officetalk.seo');
    $contact = config('officetalk.contact');

    // Per-Page-Overrides aus x-slots auflösen, mit Fallback auf Defaults.
    $pageTitle = isset($title) ? trim((string) $title) : null;
    $seoTitle = $pageTitle && ! str_contains($pageTitle, $seo['site_name'])
        ? $pageTitle.' · '.$seo['site_name']
        : ($pageTitle ?: $seo['site_name']);

    $seoDescription = isset($metaDescription) ? trim((string) $metaDescription) : '';
    $seoCanonical = isset($canonical) ? (string) $canonical : url()->current();
    $seoRobots = isset($robots) ? (string) $robots : $seo['defaults']['robots'];
    $seoOgType = isset($ogType) ? (string) $ogType : $seo['defaults']['og_type'];

    // OG-Image: entweder string (URL), array (url/width/height/alt) oder Default aus Config
    $rawOgImage = $ogImage ?? $seo['default_image'];
    $seoOgImage = is_array($rawOgImage)
        ? $rawOgImage
        : array_merge($seo['default_image'], ['url' => (string) $rawOgImage]);
@endphp

{{-- ════════════════════════════════════════════════════════════
     Basic Meta-Tags
     ════════════════════════════════════════════════════════════ --}}
<title>{{ $seoTitle }}</title>
<meta name="description" content="{{ $seoDescription }}">
<meta name="robots" content="{{ $seoRobots }}">
<meta name="author" content="{{ $seo['organization']['description'] ? 'Gerhard Popp' : $seo['site_name'] }}">
<link rel="canonical" href="{{ $seoCanonical }}">

{{-- ════════════════════════════════════════════════════════════
     Open Graph · Facebook, LinkedIn, WhatsApp, Slack, Teams
     ════════════════════════════════════════════════════════════ --}}
<meta property="og:type" content="{{ $seoOgType }}">
<meta property="og:title" content="{{ $ogTitle ?? $seoTitle }}">
<meta property="og:description" content="{{ $ogDescription ?? $seoDescription }}">
<meta property="og:url" content="{{ $seoCanonical }}">
<meta property="og:site_name" content="{{ $seo['site_name'] }}">
<meta property="og:locale" content="{{ $seo['locale'] }}">
<meta property="og:image" content="{{ url($seoOgImage['url']) }}">
@isset($seoOgImage['width'])
    <meta property="og:image:width" content="{{ $seoOgImage['width'] }}">
@endisset
@isset($seoOgImage['height'])
    <meta property="og:image:height" content="{{ $seoOgImage['height'] }}">
@endisset
@isset($seoOgImage['alt'])
    <meta property="og:image:alt" content="{{ $seoOgImage['alt'] }}">
@endisset

{{-- ════════════════════════════════════════════════════════════
     Twitter Card
     ════════════════════════════════════════════════════════════ --}}
<meta name="twitter:card" content="{{ $seo['defaults']['twitter_card'] }}">
<meta name="twitter:title" content="{{ $ogTitle ?? $seoTitle }}">
<meta name="twitter:description" content="{{ $ogDescription ?? $seoDescription }}">
<meta name="twitter:image" content="{{ url($seoOgImage['url']) }}">
@if ($seo['twitter_handle'])
    <meta name="twitter:site" content="{{ $seo['twitter_handle'] }}">
@endif

{{-- ════════════════════════════════════════════════════════════
     Schema.org · Organization-Entity auf jeder Seite
     ════════════════════════════════════════════════════════════ --}}
@include('officetalk::partials.seo-organization-schema')

{{-- ════════════════════════════════════════════════════════════
     Schema.org · seiten-spezifisch via x-slot:schema
     ════════════════════════════════════════════════════════════ --}}
@php
    // x-slot-Inhalt kommt als ComponentSlot-Objekt; __toString() rendert es zum JSON-String.
    $schemaPayload = null;
    if (isset($schema)) {
        if (is_string($schema)) {
            $schemaPayload = $schema;
        } elseif (is_array($schema)) {
            $schemaPayload = json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        } else {
            // ComponentSlot / Stringable → toString
            $rendered = trim((string) $schema);
            $schemaPayload = $rendered !== '' ? $rendered : null;
        }
    }
@endphp
@if ($schemaPayload)
    <script type="application/ld+json">{!! $schemaPayload !!}</script>
@endif

{{-- Alternative Sprachen · aktuell keine, Placeholder-Slot für Zukunft --}}
@isset($hreflang)
    @foreach ((array) $hreflang as $lang => $url)
        <link rel="alternate" hreflang="{{ $lang }}" href="{{ $url }}">
    @endforeach
@endisset
