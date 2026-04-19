# Frontend-Konventionen – Laravel 13, Blade, Tailwind, Livewire 3

Diese Datei regelt die technischen Frontend-Entscheidungen. Boosts eigene Laravel-Guidelines gelten zusätzlich; diese Datei hat Vorrang bei Widersprüchen.

## Stack-Entscheidungen

- **Blade + Livewire 3**, kein Inertia, kein Vue, kein React.
- **Tailwind CSS 3.4+** über das mitgelieferte Preset `tailwind.preset.officetalk.js`.
- **Alpine.js** nur wo Livewire overkill wäre (Dropdown-Toggles, simple Tabs).
- **Kein jQuery.**
- **Vite** als Asset-Bundler (Laravel-Default).

## Wo was hinkommt

**Ins OfficeTalk-Paket** (`vendor/officetalk/officetalk/`):

- Wiederverwendbare Blade-Komponenten
- Livewire-Komponenten, die OfficeTalk-Domain betreffen
- Domain-Models und -Migrations (Präfix `officetalk_`)
- Routes unter dem `/officetalk`-Prefix

**Ins Host-Projekt** (`immobilien-redaktion.com`):

- Integrationen zwischen OfficeTalk und Plattform (z. B. Footer-Cross-Link)
- Host-spezifische Overrides unter `resources/views/vendor/officetalk/`
- Projektweite Assets, die beide Subsysteme teilen

## Naming

- **Blade-Komponenten:** kebab-case, semantische Namen. `x-officetalk::video-card`, nicht `x-ui.card-v2`.
- **Livewire-Komponenten:** PascalCase-Klassen, kebab-case-Tags. `Officetalk\Http\Livewire\EpisodeArchive` → `<livewire:officetalk.episode-archive />`.
- **Eloquent-Modelle:** Singular, PascalCase. `Episode`, `Guest`, `Topic`. Namespace `Officetalk\Models\`.
- **Migrations:** Snake-case mit Tabellen-Präfix. `create_officetalk_episodes_table`.
- **Routes:** kebab-case-URLs, Named-Routes mit Punkt-Notation. `officetalk.episodes.show`.

## Blade-Komponenten-Regeln

- Jede wiederverwendbare UI-Einheit ist eine Blade-Komponente. Keine inline wiederholten Markup-Blöcke.
- Props werden im Klassen-Konstruktor getypt:

```php
namespace Officetalk\View\Components;

use Illuminate\View\Component;
use Officetalk\Models\Episode;

class VideoCard extends Component
{
    public function __construct(
        public Episode $episode,
        public string $layout = 'split',
    ) {}

    public function render(): View
    {
        return view('officetalk::components.patterns.video-card');
    }
}
```

- **Keine Logik in Blade-Templates** außer reiner Darstellung. Formatierung in Attribute-Accessor des Models oder in einen Presenter.

## Tailwind-Nutzung

- Nur semantische Klassen aus dem Preset: `bg-bg`, `text-ink`, `text-muted`, `bg-surface`, `border-line`, `bg-accent`.
- Typografie-Klassen aus dem Preset: `text-eyebrow`, `text-meta`, `text-body`, `text-lead`, `text-h1` bis `text-h4`.
- Spacing: `s1` bis `s7` als semantische Skala (8px bis 96px).
- Arbitrary Values nur bei begründbaren Einzelfällen (`w-[1280px]`, `top-[88px]`), nie für Farben.
- `@apply` in CSS-Partials wo Blade-Komponenten wiederholt dieselben Klassen brauchen.
- Dark-Mode: **nicht implementieren**. OfficeTalk ist Light-Only.

## Responsive

- Mobile-First. Default-Klassen sind Mobile, Breakpoints `sm: md: lg: xl:` additiv.
- Breakpoints: `sm 640px`, `md 768px`, `lg 1024px`, `xl 1280px`.
- Container-Width: `max-w-editorial` (= 1280 px) mit `mx-auto`, Seitenpadding `px-s3 md:px-s5`.
- Typografie-Scaling: `clamp()` für H1, feste Skala für H2–H4 mit Breakpoint-Overrides.

## Livewire 3

- Komponenten-Klassen unter `Officetalk\Http\Livewire\*`, Views unter `resources/views/livewire/*` (nicht unter `components/`, das ist Blade).
- `#[Url]`-Attribute für URL-gebundene Filter nutzen (Suche, Topic-Filter).
- `#[Validate]`-Attribute oder Form-Objects für Validierung, nicht inline in der Methode.
- Wire-Loading-States müssen UI-Feedback geben (Text oder Pulse-Dot in Accent-Farbe).
- `wire:model.live.debounce.300ms` für Textsuche, nicht `wire:model.live` ohne Debounce.

## Bilder

- **WebP mit JPEG-Fallback**, srcset für responsive Delivery.
- Lazy-Loading (`loading="lazy"`) ab dem Second Fold, Hero-Bilder immer `fetchpriority="high"`.
- Source: DigitalOcean Spaces CDN über `Officetalk\Support\CdnUrl::for($path)`.
- **Alt-Texte sind Pflicht.** Dekorative Icons `aria-hidden="true"` plus leeres alt-Attribut.
- Bildformate: 1920×1080 (16:9) für `still_landscape` und 1200×1200 (1:1) für `still_square`.

## Videos

- **Vimeo-Embed** als Primär-Quelle. LinkedIn-Native-Videos via `oembed` nur als Sekundär-Link.
- Videoplayer-Container: `bg-surface-strong`, Radius 4 px, 16:9 forced via `aspect-ratio: 16/9`.
- **Kein Autoplay** außerhalb stumm geschalteter Previews.
- Untertitel (VTT) als Default aktiviert.
- Poster-Image statt Player-Preview bei initial Load (Performance).
- Vimeo-URL über `$episode->vimeoEmbedUrl()` abrufen, nicht selbst zusammenbauen.

## Fonts

- Fontsource-Pakete `@fontsource-variable/fraunces` und `@fontsource-variable/inter` im `package.json` des Host-Projekts.
- Selbst-Hosting via `resources/js/app.js` Import, über Vite-Build.
- `font-display: swap` in der `@font-face`-Deklaration.
- Preload in der Layout-Head: Inter 400, Inter 600, Fraunces 500 (die drei kritischen Weights).

## Accessibility (Minimum)

- Semantic HTML: `<main>`, `<article>`, `<nav>`, `<section>`. Keine `<div>`-Salate.
- Heading-Hierarchie strikt: H1 einmal pro Seite, keine Sprünge.
- Focus-Indikatoren: 3 px Outline `#111111`, Offset 2 px. `outline: none` ohne Ersatz ist verboten.
- Tastatur-Navigation: alle Interaktiven über Tab erreichbar, Escape schließt Overlays, Enter/Space aktiviert Buttons.
- ARIA: Nur wenn semantisches HTML nicht reicht. `aria-label` auf Icon-Only-Buttons, `aria-current="page"` in Nav.
- Reduced-Motion: `@media (prefers-reduced-motion)` deaktiviert Loader, Section-Divider, Card-Hover-Lift.

Ausführliche WCAG-Regeln in `50-accessibility.md`.

## Testing

- **Pest 3** für Unit- und Feature-Tests. Keine PHPUnit-Syntax in neuen Tests.
- Jede neue Eloquent-Action hat mindestens einen Feature-Test.
- Livewire-Komponenten via `Livewire::test(...)` testen.
- Factories unter `database/factories/` nutzen, nicht `Model::create()` im Test.

## Commit- und Code-Style

- **Pint** vor jedem Commit. Pre-Commit-Hook empfohlen.
- **ESLint/Prettier** für JS (selten, nur Alpine-Inline-Code).
- Commit-Messages: Conventional Commits (siehe `20-content-voice.md`).

## Was vor Code-Output zu tun ist

Immer bevor neuer Code geschrieben wird, folgender Mini-Check:

1. Existiert die Komponente/Route bereits? → Boost-MCP `list-routes` oder `grep` nutzen.
2. Welche Guideline greift? → `10-design-system.md` für UI, `40-officetalk-domain.md` für Domain-Logik, `20-content-voice.md` für jeden Text.
3. Welche Model-Felder sind im Spiel? → Boost-MCP `database-schema` statt raten.
4. Fehlt eine Migration? → Erst Migration-Plan, dann Code.
