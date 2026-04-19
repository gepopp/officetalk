# Frontend-Konventionen – Laravel 13, Blade, Tailwind 4, Livewire 4

Diese Datei regelt die technischen Frontend-Entscheidungen. Boosts eigene Laravel-Guidelines gelten zusätzlich; diese Datei hat Vorrang bei Widersprüchen.

## Stack-Entscheidungen

- **Laravel 13**, PHP 8.3 als Mindestanforderung.
- **Blade + Livewire 4**, kein Inertia, kein Vue, kein React.
- **Tailwind CSS 4.1+** mit CSS-First-Konfiguration. Kein `tailwind.config.js` im Regelfall.
- **Vite** als Asset-Bundler mit dem offiziellen Tailwind-Plugin `@tailwindcss/vite`.
- **Alpine.js** nur wo Livewire overkill wäre: reine Client-Toggles, Focus-Management, lokale Animationen.
- **Kein jQuery.**

## Wo was hinkommt

**Ins OfficeTalk-Paket** (`vendor/officetalk/officetalk/`):

- Wiederverwendbare Blade-Komponenten
- Livewire-Komponenten, die OfficeTalk-Domain betreffen
- Domain-Models und -Migrations (Präfix `officetalk_`)
- Routes unter dem `/officetalk`-Prefix
- CSS-Theme-Partial (`resources/css/officetalk-theme.css`) mit den Design-Tokens

**Ins Host-Projekt** (`immobilien-redaktion.com`):

- Integrationen zwischen OfficeTalk und Plattform (etwa Footer-Cross-Link)
- Host-spezifische Overrides unter `resources/views/vendor/officetalk/`
- Projektweite Assets, die beide Subsysteme teilen
- Tailwind-Entry-Point (`resources/css/app.css`) mit Import des OfficeTalk-Themes

## Naming

- **Blade-Komponenten:** kebab-case, semantische Namen. `x-officetalk::video-card`, nicht `x-ui.card-v2`.
- **Livewire-Komponenten:** PascalCase-Klassen, kebab-case-Tags. `Officetalk\Http\Livewire\EpisodeArchive` → `<livewire:officetalk.episode-archive />`.
- **Single-File-Komponenten (Livewire 4):** `.livewire.php`-Endung unter `resources/views/components/`. Optional, nicht verpflichtend.
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

## Tailwind 4 – CSS-First-Konfiguration

Tailwind 4 liest Design-Tokens nicht mehr aus `tailwind.config.js`, sondern direkt aus CSS über die `@theme`-Direktive. Das Paket liefert ein fertiges Theme-Partial unter `resources/css/officetalk-theme.css`. Im Host-Projekt wird es über `resources/css/app.css` eingebunden:

```css
@import "tailwindcss";
@import "../../vendor/officetalk/officetalk/resources/css/officetalk-theme.css";
```

Die Design-Tokens liegen als CSS-Custom-Properties vor und erzeugen automatisch passende Utility-Klassen:

```css
@theme {
    --color-bg: #FAFAF7;
    --color-accent: #E3B505;
    --color-ink: #111111;
    --font-display: "Fraunces", Georgia, serif;
    /* ... */
}
```

Nutzung im Markup bleibt unverändert: `bg-bg`, `text-ink`, `bg-accent`, `text-muted`, `border-line`, `font-display`, `font-sans`.

### Vite-Integration

In `vite.config.js` muss das Tailwind-Plugin registriert sein:

```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({ input: ['resources/css/app.css', 'resources/js/app.js'], refresh: true }),
        tailwindcss(),
    ],
});
```

### Paket-Views für den Scanner sichtbar machen

Tailwind 4 erkennt Content-Files automatisch im Projekt-Root. Paket-Views liegen außerhalb und müssen explizit registriert werden – das geschieht im Theme-Partial des Pakets via `@source`-Direktive:

```css
@source "../../vendor/officetalk/officetalk/resources/views/**/*.blade.php";
```

Der `@source`-Pfad ist relativ zur CSS-Datei, in der er steht. Im Host-Projekt muss nichts zusätzlich konfiguriert werden – das Paket bringt seine Scan-Deklaration mit.

### Verboten

- `bg-blue-500`, `text-gray-700` und andere Default-Farbnamen. Nur semantische Tokens verwenden.
- `tailwind.config.js`-Rückfall, sofern es nicht zwingend für ein Legacy-Plugin nötig ist. Dann explizit über `@config` laden – aber Grund dokumentieren.
- Dark-Mode. OfficeTalk ist Light-Only, redaktionelle Magazin-Logik.

## Responsive

- Mobile-First. Default-Klassen sind Mobile, Breakpoints `sm: md: lg: xl:` additiv.
- Breakpoints entsprechen Tailwind-4-Defaults: `sm 640px`, `md 768px`, `lg 1024px`, `xl 1280px`.
- Container-Width: `max-w-editorial` (= 1280 px) mit `mx-auto`, Seitenpadding `px-s3 md:px-s5`.
- Typografie-Scaling: `clamp()` für H1 über eine eigene Utility oder inline, feste Skala für H2–H4 mit Breakpoint-Overrides.

## Livewire 4

- Komponenten-Klassen unter `Officetalk\Http\Livewire\*`, Views unter `resources/views/livewire/*`.
- Class-Based-Komponenten bleiben der Default im Paket. Die neuen Single-File-Komponenten (`.livewire.php`) sind erlaubt, aber nicht verpflichtend – Konsistenz innerhalb eines Subsystems schlägt hier Moderne.
- `#[Url]`-Attribute für URL-gebundene Filter (Suche, Topic-Filter).
- `#[Validate]`-Attribute oder Form-Objects für Validierung, nicht inline in der Methode.
- Wire-Loading-States müssen UI-Feedback geben. In Livewire 4 stehen dafür zusätzlich die neuen Transition-Direktiven zur Verfügung.
- `wire:model.live.debounce.300ms` für Textsuche, nicht `wire:model.live` ohne Debounce.
- Parallel-Requests sind der neue Default. Mehrere gleichzeitige Interaktionen in einer Komponente blockieren sich nicht mehr gegenseitig – `wire:model.live` in einem Suchfeld plus gleichzeitiger Pagination-Klick laufen parallel.

### Neue Direktiven produktiv nutzen

- **`wire:transition`** für Enter-/Exit-Animationen an Elementen, die via `@if` ein- und ausgeblendet werden. Ersetzt die alten Alpine-Workarounds für Modals, Tooltips, Flash-Messages. Respektiert `prefers-reduced-motion` automatisch.
- **`wire:ref`** in Kombination mit `dispatch()->to(ref: '...')` für zielgerichtete Event-Kommunikation zwischen Parent- und Child-Komponenten ohne globalen Event-Bus.
- **Blade-Slots in Livewire-Komponenten** – Inhalte werden wie bei normalen Blade-Komponenten über `$slot` oder benannte Slots übergeben. Vorher mussten Props oder Event-Bindings aushelfen.

### Islands und Caching

Livewire 4 führt das Konzept der Islands ein: Teilbereiche einer Komponente lassen sich isolieren und getrennt rerendern. Für OfficeTalk relevant dort, wo teure Queries in nur einem Teil der View nötig sind – etwa Reichweiten-Statistiken auf der Episode-Detailseite.

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
- Poster-Image statt Player-Preview bei initial Load – spart LCP.
- Vimeo-URL über `$episode->vimeoEmbedUrl()` abrufen, nicht selbst zusammenbauen.

## Fonts

- Fontsource-Pakete `@fontsource-variable/fraunces` und `@fontsource-variable/inter` im `package.json` des Host-Projekts.
- Selbst-Hosting via `resources/js/app.js` Import, Vite-Build legt die Dateien unter `public/build/assets/`.
- `font-display: swap` in der `@font-face`-Deklaration (bringen die Fontsource-Pakete bereits mit).
- Preload im Layout-Head: Inter 400, Inter 600, Fraunces 500 (die drei kritischen Weights). Mehr Preloads schaden mehr als sie nützen.

## Accessibility (Minimum)

- Semantic HTML: `<main>`, `<article>`, `<nav>`, `<section>`. Keine `<div>`-Salate.
- Heading-Hierarchie strikt: H1 einmal pro Seite, keine Sprünge.
- Focus-Indikatoren: 3 px Outline `#111111`, Offset 2 px. `outline: none` ohne Ersatz ist verboten.
- Tastatur-Navigation: alle Interaktiven über Tab erreichbar, Escape schließt Overlays, Enter/Space aktiviert Buttons.
- ARIA: Nur wenn semantisches HTML nicht reicht. `aria-label` auf Icon-Only-Buttons, `aria-current="page"` in Nav.
- Reduced-Motion: `@media (prefers-reduced-motion)` deaktiviert Loader, Section-Divider, Card-Hover-Lift. Livewire-4-`wire:transition` respektiert das automatisch.

Ausführliche WCAG-Regeln in `50-accessibility.md`.

## Testing

- **Pest 3** für Unit- und Feature-Tests. Keine PHPUnit-Syntax in neuen Tests.
- Jede neue Eloquent-Action hat mindestens einen Feature-Test.
- Livewire-Komponenten via `Livewire::test(...)` testen. Die API ist zwischen v3 und v4 stabil geblieben.
- Browser-Tests via Pest 4 für kritische User-Flows (Kontaktformular, Episoden-Filter).
- Factories unter `database/factories/` nutzen, nicht `Model::create()` im Test.

## Commit- und Code-Style

- **Pint** vor jedem Commit. Pre-Commit-Hook empfohlen.
- **Prettier** oder **Biome** für JS (selten, nur Alpine-Inline-Code).
- Commit-Messages: Conventional Commits. Deutsche Beschreibung nach dem Prefix ist erlaubt und im Kontext dieses Projekts erwünscht (`feat: Episoden-Archiv mit Filter nach Thema`).

## Was vor Code-Output zu tun ist

Immer bevor neuer Code geschrieben wird, folgender Mini-Check:

1. Existiert die Komponente/Route bereits? → Boost-MCP `list-routes` oder `grep` nutzen.
2. Welche Guideline greift? → `10-design-system.md` für UI, `40-officetalk-domain.md` für Domain-Logik, `20-content-voice.md` für jeden Text.
3. Welche Model-Felder sind im Spiel? → Boost-MCP `database-schema` statt raten.
4. Fehlt eine Migration? → Erst Migration-Plan, dann Code.
5. Tailwind-Klasse unsicher, ob im Theme definiert? → Boost-MCP `search-docs` oder direkt in `officetalk-theme.css` nachsehen.
