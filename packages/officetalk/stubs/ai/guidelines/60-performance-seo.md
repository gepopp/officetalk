# Performance und SEO

Die Landingpage ist Conversion-relevant. Core Web Vitals sind Ranking-Faktor plus Glaubwürdigkeitssignal für B2B-Entscheider.

## Core-Web-Vitals-Ziele

| Metrik | Ziel | Messung |
|---|---|---|
| **LCP** (Largest Contentful Paint) | < 2,5 s | 75. Perzentil Chrome UX Report |
| **INP** (Interaction to Next Paint) | < 200 ms | Feldmessung |
| **CLS** (Cumulative Layout Shift) | < 0,1 | alle Seiten |
| Lighthouse Performance | ≥ 90 | Mobile-Emulation |
| Lighthouse Accessibility | ≥ 95 | |
| Lighthouse Best Practices | ≥ 95 | |
| Lighthouse SEO | 100 | keine Ausnahme |
| First-View-Gewicht | < 800 KB | HTML + CSS + JS + Above-the-Fold-Bilder |

## Assets

### Bilder

- **WebP ist Standard**, JPEG als Fallback nur wenn nötig.
- **Responsive Delivery** via `srcset` und `sizes`. Keine Desktop-Bilder auf Mobile.
- **Lazy Loading** (`loading="lazy"`) ab dem Second Fold.
- **Hero-Bild** immer `fetchpriority="high"` plus `preload`-Link im Head.
- **CDN-Auslieferung** über DigitalOcean Spaces via `Officetalk\Support\CdnUrl::for($path)`.
- **Kompression** bei Upload: WebP Q80, JPEG Q85.
- **Größen-Constraints:** Max 2400 px Breite für Stills, 1200 px für Portraits.

### Fonts

- Fraunces + Inter selbst-gehostet via Fontsource auf Spaces CDN.
- Nur kritische Weights preload: Inter 400, Inter 600, Fraunces 500. Rest `font-display: swap`.
- Latin-Subset nur, keine Cyrillic/Greek-Unicode-Ranges.
- WOFF2-Format, kein WOFF oder TTF.

### CSS

- Vite-Build produziert ein einziges CSS-File, ausgeliefert als `<link rel="stylesheet">` im Head.
- Kein Inline-CSS außer für Custom-Properties.
- Unused-CSS-Purge via Tailwind Content-Scan sicherstellen.

### JavaScript

- Livewire-Script am Body-Ende.
- Eigene JS (`officetalk.js`) defer geladen.
- Kein `document.write`, kein Render-Blocking-JS.
- Alpine nur dort laden, wo es wirklich gebraucht wird.

## Caching

- **Browser-Caching:** Cache-Control für Assets auf 1 Jahr (Content-Hash im Dateinamen via Vite).
- **HTML-Caching:** kurz (5 Minuten), da Content sich bei Veröffentlichungen ändert.
- **CDN-Caching:** Spaces liefert Assets mit Edge-Cache. Invalidierung bei Redeploy via Versions-Hash.
- **Application-Caching:** Queries für Episode-Listen via `Cache::remember()` mit Tag-basierter Invalidierung bei Episode-Save.

## Meta-Tags

Auf jeder Seite:

```html
<title>{{ $title }}</title>
<meta name="description" content="{{ $metaDescription }}">
<link rel="canonical" href="{{ $canonical }}">

<meta property="og:site_name" content="OfficeTalk · Die unabhängige Immobilien Redaktion">
<meta property="og:title" content="{{ $ogTitle }}">
<meta property="og:description" content="{{ $ogDescription }}">
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:image" content="{{ $ogImage }}">

<meta name="twitter:card" content="summary_large_image">
```

### Regeln

- **Title:** unter 60 Zeichen, Kernaussage zuerst, Marke am Ende.
- **Description:** unter 160 Zeichen, ein vollständiger Satz, aktiv, ohne Keyword-Stuffing.
- **Canonical:** absolute URL, Trailing-Slash-Strategie konsistent.
- **OG-Image:** 1200×630 px, WebP, unter 200 KB.
- **OG-Type:** `website` für Landing/Index, `video.other` für Episoden-Detailseiten.

## Schema.org

### Auf Episode-Detailseiten

`VideoObject`-Schema mit Pflichtfeldern:

```json
{
    "@context": "https://schema.org",
    "@type": "VideoObject",
    "name": "...",
    "description": "...",
    "thumbnailUrl": "...",
    "uploadDate": "2026-04-15T00:00:00+02:00",
    "duration": "PT28M",
    "embedUrl": "https://player.vimeo.com/video/...",
    "publisher": { "@type": "Organization", "name": "...", "url": "..." },
    "interviewer": { "@type": "Person", "name": "Walter Senk", "url": "..." },
    "about": { "@type": "Person", "name": "...", "jobTitle": "...", "worksFor": { "@type": "Organization", "name": "..." } }
}
```

Template bereits in `resources/views/episodes/show.blade.php`.

### Auf Landingpage

`WebSite` plus `Organization` plus `BreadcrumbList`.

## Sitemap und Robots

- **sitemap.xml** mit allen Episoden-URLs, Guests-URLs, Topics-URLs.
- Weekly-Update via Laravel Scheduler: `php artisan officetalk:sitemap`.
- **robots.txt** mit `Sitemap:`-Referenz, kein `Disallow` auf Content-Bereiche.
- Admin-Routes explizit ausschließen.

## URL-Struktur

- **Deutsche Pfade:** `/officetalk/folgen/ep-047-mueller-esg`, nicht `/officetalk/episodes/ep-047`.
- **Kebab-case Slugs:** `ep-047-mueller-esg`, keine Umlaute, keine Sonderzeichen.
- **Keine URL-Parameter für kanonische Inhalte.** Filter via Livewire-`#[Url]`-Attribute sind für UX okay, aber Canonical bleibt auf der Basis-URL.

## Indexierbarkeit

- Noindex-Header explizit nur auf Admin- und Form-Success-Seiten.
- Draft-Episoden (`published_at = null`) zeigen 404, nicht noindex.
- Scheduled-Episoden (`published_at > now()`) ebenfalls 404.

## Monitoring

- **Google Search Console** auf der Subdomain einrichten.
- **Plausible** oder **Matomo** cookieless für interne Analytik.
- **Core Web Vitals Report** wöchentlich checken.
- **Rank-Tracking** auf den definierten Keywords aus dem Strategiedossier: `Experteninterview Immobilien Wien`, `Video Immobilienbranche Österreich`, `LinkedIn Video Wien B2B`.

## Analytics und Consent

- GTM/GDPR-Consent-Implementierung der `immobilien-redaktion.com`-Plattform wiederverwenden.
- **Tracking-Events:** CTA-Klick, Episode-Play, Formular-Submit, Scroll-Depth 50/75/100, Outbound auf LinkedIn/Spotify.
- Consent-Mode v2 wenn GA4 im Einsatz ist.

## Vor dem Produktiv-Deployment

Pflicht-Checkliste:

1. Lighthouse Mobile ≥ 90 alle Kategorien (außer A11y ≥ 95, SEO = 100).
2. Meta-Title und -Description für alle Routen gesetzt und eindeutig.
3. Canonical-URLs stimmen auf allen Routen.
4. Schema.org JSON-LD valide (Google Rich Results Test).
5. Sitemap generiert und in Search Console eingereicht.
6. 404-Seite hat sinnvolle Navigation zurück.
7. Open-Graph-Preview in Facebook Debugger und LinkedIn Post Inspector getestet.
