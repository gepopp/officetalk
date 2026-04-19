<laravel-boost-guidelines>
=== .ai/00-project-context rules ===

# OfficeTalk – Projekt-Kontext

Diese Datei wird bei jeder Session geladen. Sie ist die oberste Referenz des OfficeTalk-Subsystems. Bei Widerspruch zu anderen Guidelines gilt diese Datei.

## Was ist OfficeTalk

OfficeTalk ist ein redaktionell produziertes LinkedIn-Videointerview-Format für Entscheider der Wiener Immobilien-, Bau-, Kanzleien- und PropTech-Branche. Kein Imagefilm-Anbieter, keine Produktionsagentur. Das Format ist als Composer-Paket `officetalk/officetalk` in die Bestandsplattform `immobilien-redaktion.com` eingebunden.

- **Redaktion:** Walter Senk (seit 24+ Jahren Immobilienjournalismus)
- **Produktion:** Gerhard Popp
- **Distribution:** LinkedIn-Profil Walter Senk, `immobilien-redaktion.com`, Spotify-Podcast „Immo Voices", Cross-Post auf Unternehmensseite des Gastes
- **Marken-Element:** gelber Koffer, sichtbar im Video, als Piktogramm in der UI

## Zielgruppen (Personas)

Zwei primäre Ansprechpartner mit diametralen Kommunikationslogiken:

1. **Bauträger-Eigentümer** (45–60, männlich, 10–30 MA). Entscheidet per Kaffee in 48 Stunden. Will Paketpreis, keine Stundensätze. Prototypen: Glorit, Winegg, 3SI, Ulreich.
2. **Marketing-Leiterin** (28–36, weiblich, Head-of-Ebene). Konsolidiert Stakeholder über Wochen. Akzeptiert Stundensätze, rechnet in Reichweitenkennzahlen. Prototypen: BUWOG, EHL, SORAVIA, UBM, CPI Europe.

Beide werden auf derselben Landingpage adressiert, aber mit unterschiedlichen Textbausteinen (siehe `20-content-voice.md`).

## Positionierung

OfficeTalk sitzt zwischen drei Wiener Marktlagern: klassische Filmproduktionen (Mountainmaster, Art-Media), KMU-Videografen (Record17, fraem, Pauser) und Immobilien-Marketingagenturen (enteco, JAMJAM). Keiner davon betreibt ein eigenes redaktionelles Videoformat. Designsprache und Textlogik müssen diese Position auch visuell und sprachlich durchhalten.

## Tech-Stack

- Laravel 13, PHP 8.3
- Blade + Livewire 3, kein Inertia/Vue
- Tailwind CSS 3.4+ mit Custom-Preset aus dem Paket (`tailwind.preset.officetalk.js`)
- MySQL Managed via DigitalOcean
- Ploi für Deployment, Nginx als Webserver
- DigitalOcean Spaces als CDN für Medien
- Laravel Horizon auf dediziertem Worker-Server
- Fonts via Fontsource, selbst gehostet auf Spaces CDN
- Vimeo-Embed für Videos (keine YouTube-Einbettung aus Markengründen)

## Paketstruktur

Dieses Subsystem lebt als eigenes Composer-Paket `officetalk/officetalk`:

- Namespace `Officetalk\*`
- Routes unter Prefix `/officetalk`
- Tabellen-Präfix `officetalk_*`
- Blade-Komponenten unter `<x-officetalk::*>`
- Views unter `officetalk::*` Namespace
- Livewire-Komponenten unter `officetalk.*`

Wenn Domain-Logik für OfficeTalk erweitert wird, gehört sie ins Paket, nicht ins Host-Projekt.

## Domain-Entität Episode

Die zentrale Entität ist `Officetalk\Models\Episode`. Alle inhaltlichen Arbeiten drehen sich um Episoden-Veröffentlichung, -Verwaltung und -Distribution. Vollständige Feldliste in `40-officetalk-domain.md`.

## Unverhandelbare Regeln

- **Keine Marketingsprache.** Keine Superlative („beste", „führend", „einzigartig") außer belegt mit Quelle.
- **Keine Anglizismen wo deutsche Wörter präzise sind.** „Thought Leadership" ist im Persona-2-Content erlaubt, sonst nicht.
- **Keine KI-Floskeln** („es ist wichtig zu beachten", „zusammenfassend lässt sich sagen", „in der heutigen schnelllebigen Welt").
- **Kein Autoplay** im Hero. Still statt Bewegung.
- **Keine Tailwind-Standardfarben.** Ausschließlich die semantischen Keys aus dem Custom-Preset.
- **Keine Stockfotos.** Nur echte Gäste, echte Büros, echte Portraits.
- **Keine YouTube-Embeds.** Vimeo ist verbindlich.

## Boost-MCP-Werkzeuge vor Raten

Boost stellt 15 MCP-Tools bereit. Nutze sie, bevor du rätst:

- `database-schema` bevor du Migration schreibst
- `list-routes` bevor du neuen Controller anlegst
- `application-info` für Laravel- und Paket-Versionen
- `search-docs` für Laravel-/Livewire-/Pint-Fragen
- `tinker` für Hypothesen-Tests an echten Daten

## Was dieses Dokument nicht beantwortet

- Farb-Tokens, Typografie-Skala, Komponenten-Regeln → `10-design-system.md`
- Texttonalität, Do's & Don'ts für Content → `20-content-voice.md`
- Laravel-, Blade-, Tailwind-Konventionen → `30-frontend-conventions.md`
- Episode-Modell, CMS-Logik, Routing → `40-officetalk-domain.md`
- WCAG-Anforderungen, Focus-States → `50-accessibility.md`
- Core Web Vitals, Schema.org, Meta-Tags → `60-performance-seo.md`

=== .ai/10-design-system rules ===

# Design System – verbindliche Vorgaben

Diese Datei ist die technische Referenz für alle UI-Entscheidungen. Jede Abweichung braucht eine explizite Begründung im Commit-Message.

## Farbpalette (exakte HEX)

Die Palette ist geschlossen. Keine Tailwind-Standardfarben, keine Farben außerhalb dieser Tabelle.

| Token | HEX | Einsatz |
|---|---|---|
| `bg` | `#FAFAF7` | Haupt-Hintergrund, warmes Papier-Weiß |
| `surface` | `#F2F0EA` | Karten, leicht abgesetzte Flächen |
| `surface-strong` | `#2B2B28` | Videoplayer-Container, Footer |
| `accent` | `#E3B505` | Signature-Gelb, Koffer-Referenz |
| `accent-hover` | `#9A7A04` | Darker Ocker für Link-Hover |
| `ink` | `#111111` | Primärtext, Off-Black ohne Blaustich |
| `muted` | `#5A5A55` | Sekundärtext, Meta |
| `line` | `#E4E2DB` | Divider, Input-Borders |
| `success` | `#2F6E3F` | Gedämpftes Waldgrün |
| `warning` | `#B8501C` | Gebranntes Orange, nicht Gelb |

### Farbregeln

- `#E3B505` ist **niemals** Textfarbe auf Weiß (Kontrast nur 2,2:1). Gelb ist Fläche, Icon oder Rahmen.
- Gelbe Flächen mit schwarzem Text `#111111` ergeben 8,4:1 (AAA).
- Primärtext `#111111` auf `#FAFAF7` ergibt 18,7:1 (AAA).
- Muted `#5A5A55` auf `#FAFAF7` ergibt 6,9:1 (AA).
- Kein Gradient, kein Glassmorphism, keine Neon-Akzente.

## Tailwind-Nutzung

Das Paket liefert einen Preset mit. Im Host-Projekt in `tailwind.config.js`:

```js
export default {
  presets: [require('./tailwind.preset.officetalk.js')],
  content: [
    './resources/**/*.blade.php',
    './vendor/officetalk/officetalk/resources/views/**/*.blade.php',
    './app/Livewire/**/*.php',
  ],
}
```

Nur semantische Klassen verwenden. Tailwind-Klassen wie `bg-blue-500` oder `text-gray-700` sind **verboten**. Stattdessen `bg-bg`, `text-ink`, `bg-accent`, `text-muted`.

## Typografie

Zwei Schriften, beide variable, beide selbst gehostet via Fontsource auf DigitalOcean Spaces:

- **Fraunces** (Display) – Old-Style-Soft-Serif, Google Fonts frei. Weights 400, 500, 600.
- **Inter** (Sans) – Neo-Grotesk, Google Fonts frei. Weights 400, 500, 600.

Preload nur die Critical Weights: Inter 400, Inter 600, Fraunces 500. Rest via `font-display: swap`.

### Tailwind-Klassen

Der Preset definiert semantische Text-Size-Klassen:

- `text-eyebrow` – ALL CAPS 13 px, tracking 0.08em, Inter 600
- `text-meta` – 14 px, Inter 500
- `text-body` – 17 px, Inter 400
- `text-lead` – 20 px, Inter 400
- `text-h4` – 22 px, Fraunces 500
- `text-h3` – 30 px, Fraunces 500
- `text-h2` – 44 px, Fraunces 500
- `text-h1` – 72 px, Fraunces 500

Mobile-Skala: H1 mit `clamp(48px, 8vw, 72px)`. Andere Headings proportional.

Kombiniere immer mit `font-display` (Fraunces) oder `font-sans` (Inter). Default ist Inter.

## Layout-Grid

- 12-Spalten-Grid als Rückgrat, Max-Content-Width `max-w-editorial` (= 1280 px).
- Asymmetrische Brüche sind erwünscht: Video-Cards in 7/5-Splits, Zitate versetzt außerhalb der Textspalte.
- Weißraum-Regel: `space-y-s6` zwischen Sektionen auf Desktop, `space-y-s4` auf Mobile.
- Keine SaaS-typischen dreispaltigen Feature-Grids im Above-the-Fold-Bereich.

## Spacing

Semantische Skala über Tailwind-Preset: `s1` = 8px, `s2` = 16px, `s3` = 24px, `s4` = 32px, `s5` = 48px, `s6` = 64px, `s7` = 96px. Andere Abstände nur mit expliziter Begründung.

## Radien

`4px` als Default. Niemals über `4px`. Kantig signalisiert Magazin, rund signalisiert Startup – OfficeTalk ist ersteres.

## Komponenten verwenden, nicht neu erfinden

Das Paket liefert Blade-Komponenten. Erst nachsehen, bevor du neu baust:

- `<x-officetalk::button variant="primary|secondary|ghost" />`
- `<x-officetalk::video-card :episode="$episode" layout="split|grid" />`
- `<x-officetalk::pullquote :author="..." />`
- `<x-officetalk::eyebrow />`
- `<x-officetalk::logo-mark :size="32" />`
- `<x-officetalk::patterns.nav />`
- `<x-officetalk::patterns.footer />`
- `<x-officetalk::layouts.app>...</x-officetalk::layouts.app>`

Neue UI-Einheiten, die wiederverwendbar sind, gehören ins Paket unter `resources/views/components/`, nicht ins Host-Projekt.

## Komponenten-Verhalten

### Buttons

Siehe `Officetalk\View\Components\Button`. Drei Varianten: primary (gelb), secondary (outline-ink), ghost (text-link).

### Cards (Video-Episode)

Siehe `components/patterns/video-card.blade.php`. Zwei Layouts: `split` (Landingpage) und `grid` (Archiv).

### Navigation

Sticky, shrink on scroll via `data-officetalk-nav`-Attribut. Items: Format · Folgen · Prozess · Preise · Redaktion.

## Verbotenes

- Autoplay im Hero
- Glassmorphism, Neumorphism, Gradient-Flächen
- Emoji-Icons in der UI
- Radien > 4 px
- Tailwind-Defaultfarben
- Schattenfarben außer `rgba(17,17,17, *)`
- YouTube-Embed (Vimeo-only)
- Font-Family Arial, Roboto, Helvetica außerhalb der Fallback-Kette
- Dark-Mode (Light-Only, Magazin-Logik)

=== .ai/20-content-voice rules ===

# Content-Voice – Walter-Senk-Duktus

Diese Regeln gelten für jede Textausgabe: Blade-Templates, Meta-Descriptions, Error-Messages, E-Mail-Templates, CMS-Placeholder, FAQ, Kontaktformulare, 404-Seiten, Git-Commit-Messages. Keine Ausnahme.

## Grundhaltung

Analytisch-journalistischer B2B-Stil. Referenz-Duktus: Walter Senk, Die unabhängige Immobilien Redaktion. Zielgruppe sind Entscheider in Immobilien, Bau, PropTech, Recht und Politik im DACH-Raum.

- Direkt, unaufgeregt, meinungsstark wo angebracht.
- Datengestützt, nie polemisch.
- Keine Marketingsprache, keine Superlative.
- Branchen-Insider-Perspektive, kein erklärender Laien-Ton.
- Wenn etwas schief läuft, wird es benannt – mit Namen, Zahlen, Kontext.

## Satzbau

- Kurze bis mittellange Sätze, aktiv formuliert.
- Subjekt – Prädikat – Objekt. Verschachtelungen vermeiden.
- Ein Gedanke pro Absatz. Keine Themen-Mischmasch-Blöcke.
- **Lead-first:** der Kern zuerst, keine aufwärmenden Floskeln.

## Zahlen und Belege

- Zahlen vor Adjektiven. Nicht „enorme Reichweite", sondern „3.208 Views in acht Tagen".
- Behauptungen werden belegt oder entfallen.
- Konkrete Akteure beim Namen nennen: Unternehmen, Personen, Gesetzestexte, Institutionen, Plattformen.

## Ansprache

- **Sie** als Default gegenüber Kunden (Landingpage, Kontaktformular, E-Mails).
- **Du** nur im Interview-Kontext oder bei PropTech-Zielgruppe, wenn branchenüblich.
- Neutrale Ansprache wo möglich („Ihre Redaktion", „Die Redaktion").

## Verboten

### KI-Floskeln

- „Es ist wichtig zu beachten, dass …"
- „Zusammenfassend lässt sich sagen …"
- „In der heutigen schnelllebigen Welt …"
- „Im Zeitalter der Digitalisierung …"
- „Lassen Sie uns einen Blick darauf werfen …"
- „Tauchen Sie ein in …"

### Marketingsprache

- „innovativ", „einzigartig", „führend", „zukunftsweisend", „revolutionär"
- „Gamechanger", „Disruption", „Thought Leader" außerhalb Persona-2-Kontext
- „wir sind stolz", „wir freuen uns", „mit Leidenschaft"
- „maßgeschneidert", „authentisch", „emotional"

### Weichspüler

- „möglicherweise könnte eventuell" → entscheide dich
- „in gewisser Weise", „sozusagen", „quasi"
- „wir würden gerne" → „wir möchten" oder „wir"

### Verbotene englische Marketingbegriffe

Wo deutsche Wörter präzise reichen: „Customer Journey", „Content Funnel", „Engagement-Maximierung", „Deep Dive", „Insights" (im Sinn von „Einblicke").

## Erlaubte Anglizismen

Fachbegriffe, die in der Zielgruppe etabliert sind:

- LinkedIn, Impressions, Views, Embed, Thumbnail
- ESG, KPI, ROI
- Thought Leadership **nur** in Ansprache an Persona 2
- Podcast, Newsletter, Briefing

## Persona-spezifische Varianten

### Für Persona 1 (Bauträger-Eigentümer)

Wiener Tonfall erlaubt, aber sachlich. Fachbegriffe der Branche (Spatenstich, Dachgleiche, Schlüsselübergabe, Zinshaus, Vorsorgewohnung). Kurze Sätze. Beispiel:

> Wenn Sie seit zwanzig Jahren Wohnprojekte entwickeln, haben Sie Geschichten, die Ihre Mitbewerber nicht haben. Walter Senk fragt das, was die Branche nicht in der Presseaussendung liest.

### Für Persona 2 (Marketing-Leiterin)

Professionelles B2B-Deutsch. Fachsprache der Kommunikation erlaubt (Reichweite, Impressions, Content-Kalender, Employer Branding). Messbarkeit im Vordergrund. Beispiel:

> Reichweite der letzten zehn Episoden: 2.800–5.400 Impressionen organisch, 12–34 C-Level-Profilansichten pro Clip. MIPIM-Vorberichterstattung acht Wochen vor Cannes.

## Micro-Copy-Regeln

### Buttons

- „Termin vereinbaren" statt „Jetzt Demo buchen"
- „Folge ansehen" statt „Play"
- „Zum Archiv" statt „Mehr anzeigen"
- „Anfrage absenden" statt „Kontakt aufnehmen"

### Formular-Labels

Kurz, konkret, ohne Platzhalter-Ästhetik:

- „Ihr Unternehmen" statt „Bitte Unternehmen eingeben"
- „Anlass" statt „Ihre Nachricht an uns"
- „Wunschtermin (optional)" statt „Wann soll's losgehen?"

### Success-States

- „Danke. Walter Senk meldet sich innerhalb von 48 Stunden." statt „Nachricht erfolgreich gesendet! 🎉"

### Error-Messages

- „Die Datei ist größer als 10 MB. Bitte kleiner liefern." statt „Upload fehlgeschlagen – bitte versuchen Sie es erneut."
- Technische Fehler benennen das Problem, nicht die Entschuldigung.

### 404

- Headline: „Dieses Interview wurde nicht gepackt."
- Subline: „Zurück zur Folgenübersicht."
- Keine Witze, kein Cartoon-Character. Still des leeren gelben Koffers.

## SEO-Texte

- Meta-Title: unter 60 Zeichen, Kernaussage ohne Keyword-Stuffing.
- Meta-Description: unter 160 Zeichen, ein vollständiger Satz, aktiv.
- Alt-Texte: beschreibend, nicht dekorativ. „Walter Senk im Gespräch mit [Name], [Unternehmen], im Büro" statt „Interview".

## Dateinamen und Slugs

- Kebab-case: `walter-senk-ulreich-bautraeger`
- Keine Umlaute: `ae oe ue ss` statt `ä ö ü ß`
- Keine Nummern als Suffix außer Episoden-Nummer
- Episodenslugs: `ep-047-gast-nachname-thema-kurz`

## Git-Commits

- Conventional Commits: `feat:`, `fix:`, `refactor:`, `docs:`, `test:`
- Deutsche Commit-Message nach Prefix erlaubt: `feat: Episoden-Archiv mit Filter nach Thema`
- Keine Floskeln wie „Small fix" oder „Updates"
- Beschreibe, was sich ändert, nicht, dass sich etwas ändert

## Prüfliste vor Output

Vor jeder Textausgabe durchgehen:

1. Keine Superlative?
2. Keine KI-Floskeln?
3. Lead zuerst, nicht Aufwärmung?
4. Zahlen wenn verfügbar?
5. Aktiv formuliert?
6. Branchen-Ton, nicht Erklär-Ton?
7. Konkrete Namen statt Abstraktionen?

=== .ai/30-frontend-conventions rules ===

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

=== .ai/40-officetalk-domain rules ===

# OfficeTalk Domain – Entitäten, CMS, Routing

Diese Datei beschreibt das Datenmodell und die Geschäftslogik. Referenz für Migrations, Models, Controller, Livewire-Komponenten und Routen.

## Drei Modelle

Alle Modelle leben im Namespace `Officetalk\Models\` mit Tabellen-Präfix `officetalk_`.

### Episode

```
id                   bigint primary
number               unsigned int unique     // 1, 2, 3, ...
slug                 string unique           // ep-047-ulreich-bautraegertag
title                string                  // Hauptclaim der Folge
eyebrow              string nullable         // Override Meta-Eyebrow
abstract             text                    // 2–3 Sätze, SEO-relevant
lead_quote           text nullable           // Pullquote für Hero
guest_id             foreign → officetalk_guests
vimeo_id             string nullable
linkedin_url         string nullable
spotify_url          string nullable
transcript_markdown  longtext nullable       // Vollständiges Transkript
still_landscape      string                  // CDN-Pfad 16:9
still_square         string nullable         // CDN-Pfad 1:1
thumbnail_linkedin   string nullable         // LinkedIn-optimiert
duration_minutes     unsigned smallint nullable
published_at         datetime nullable
is_featured          boolean default false   // Hero-Slot
meta_title           string nullable
meta_description     string nullable
```

#### Accessoren

- `$episode->episode_label` → `OfficeTalk #047`
- `$episode->still_landscape_url` → absolute CDN-URL
- `$episode->still_square_url` → absolute CDN-URL oder null
- `$episode->resolved_meta_title` → Override oder Default
- `$episode->resolved_meta_description` → Override oder gekürzter Abstract
- `$episode->vimeoEmbedUrl()` → Vimeo-Player-URL mit Tracking-Opt-out-Parametern

#### Scopes

- `Episode::published()` → `published_at <= now() AND not null`
- `Episode::featured()` → `is_featured = true`

#### Route Key

`slug` (nicht `id`). Route-Model-Binding nutzt `{episode:slug}`.

### Guest

```
id                   bigint primary
slug                 string unique           // mueller-thomas
first_name           string
last_name            string
role                 string                  // CEO, Head of Marketing, etc.
company              string
company_url          string nullable
linkedin_url         string nullable
portrait             string                  // CDN-Pfad 1:1 (1200×1200)
bio_short            text nullable
bio_long             text nullable
```

#### Accessoren

- `$guest->full_name` → `first_name last_name`
- `$guest->role_line` → `CEO, BUWOG`

### Topic

```
id                   bigint primary
slug                 string unique
name                 string                  // "ESG", "Wohnbau", ...
description          text nullable
```

Pivot: `officetalk_episode_topic` mit `episode_id`, `topic_id`.

## Kuratiertes Topic-Vokabular

Keine Free-Tags. Topics werden via Seeder/Admin gepflegt. Startvokabular aus `config('officetalk.topics')`:

```
esg, wohnbau, projektentwicklung, finanzierung, regulierung,
zinshaus, proptech, digitalisierung, nachhaltigkeit, ki,
mietrecht, transaktion, vermarktung, fachkraefte, baupolitik
```

Neue Topics nur via Admin-Oberfläche, nicht via User-Input. Bei Bedarf neue Slugs erst im Vokabular ergänzen, dann per Seeder in die Datenbank.

## Routing

Alle Routes unter dem Prefix aus `config('officetalk.routes.prefix')` (Default: `officetalk`).

| Route-Name | URL-Pattern | Controller |
|---|---|---|
| `officetalk.landing` | `/officetalk` | `LandingController@__invoke` |
| `officetalk.episodes.index` | `/officetalk/folgen` | `EpisodeController@index` |
| `officetalk.episodes.show` | `/officetalk/folgen/{episode:slug}` | `EpisodeController@show` |
| `officetalk.guests.show` | `/officetalk/gaeste/{guest:slug}` | `GuestController@show` |
| `officetalk.topics.show` | `/officetalk/themen/{topic:slug}` | `TopicController@show` |

URL-Sprache deutsch (`folgen`, `gaeste`, `themen`). Zielgruppe ist österreichisch.

## Medien-Pfade

CDN-Struktur auf DigitalOcean Spaces (Config: `officetalk.media.paths`):

- `officetalk/stills/ep-047-landscape.webp`
- `officetalk/stills/ep-047-square.webp`
- `officetalk/portraits/mueller-thomas.webp`
- `officetalk/thumbnails/ep-047-linkedin.webp`

In der DB werden **relative Pfade** gespeichert, nicht absolute URLs. Die Umwandlung macht `CdnUrl::for($path)` bzw. die Accessoren auf den Modellen.

## Publication Workflow

Eine Episode durchläuft drei Zustände:

1. **Draft** – `published_at = null`, nicht öffentlich. Ausschließlich für die Redaktion sichtbar.
2. **Scheduled** – `published_at` in der Zukunft. Route zeigt 404.
3. **Published** – `published_at <= now()`. Öffentlich erreichbar, in Archiven gelistet.

Der `Episode::published()`-Scope filtert auf beide Bedingungen. Controller `show()` muss zusätzlich `abort_unless($episode->published_at?->isPast(), 404)` prüfen, weil Route-Model-Binding den Scope nicht automatisch anwendet.

## Was in neuen Controllers zu beachten ist

- `with(['guest', 'topics'])` eager loaden – N+1 vermeiden.
- Published-Scope bei jeder Episode-Abfrage in öffentlichen Controllern.
- Views immer mit `officetalk::`-Prefix referenzieren.
- Breadcrumbs folgen der Route-Hierarchie: Start → Folgen → Einzelfolge.

## Schema.org-Markup

Auf jeder Episode-Detailseite wird ein `VideoObject`-Schema als JSON-LD ausgeliefert. Template in `resources/views/episodes/show.blade.php`. Pflichtfelder: `name`, `description`, `thumbnailUrl`, `uploadDate`, `embedUrl`, `publisher`, `interviewer`, `about`.

Auf der Landingpage wird ein `WebSite`-Schema plus `Organization`-Schema empfohlen (offen).

## Migrations-Reihenfolge

Bei `php artisan migrate` werden die Tabellen in dieser Reihenfolge angelegt:

1. `officetalk_topics`
2. `officetalk_guests`
3. `officetalk_episodes` (mit FK auf guests)
4. `officetalk_episode_topic` (Pivot)

Die Timestamps in den Dateinamen stellen das sicher. Bei neuen Migrations die Reihenfolge beachten – Fremdschlüssel erfordern existierende Target-Tabellen.

=== .ai/50-accessibility rules ===

# Accessibility – WCAG 2.1 AA als Minimum

OfficeTalk bedient Entscheider in Unternehmen. Viele davon lesen mit Reading-Glasses, Screen-Readern, Tastatur-Only. WCAG-Verletzungen sind nicht nur ethisch problematisch, sondern kosten Zielgruppe.

## Niveau

- **WCAG 2.1 AA** als Minimum für alle Seiten.
- **WCAG 2.1 AAA** für Body-Text (erreicht mit `#111111` auf `#FAFAF7` = 18,7:1).
- Kein Trade-off gegen visuelle Präferenz.

## Kontrast

Automatisch erfüllt durch Farbpalette:

| Kombination | Ratio | Level |
|---|---|---|
| `ink #111111` auf `bg #FAFAF7` | 18,7:1 | AAA |
| `muted #5A5A55` auf `bg #FAFAF7` | 6,9:1 | AA |
| `ink #111111` auf `accent #E3B505` | 8,4:1 | AAA |
| `ink #111111` auf `surface #F2F0EA` | 17,8:1 | AAA |
| `bg #FAFAF7` auf `surface-strong #2B2B28` | 14,1:1 | AAA |

**Verboten:**
- Gelber Text auf Weiß (Kontrast 2,2:1, nicht barrierefrei).
- Muted-Text auf Surface-Strong ohne Aufhellung.

## Semantic HTML

- `<main>`, `<article>`, `<section>`, `<nav>`, `<header>`, `<footer>` statt `<div>`-Salat.
- **Eine H1 pro Seite.** Hierarchie ohne Sprünge.
- `<button>` für Aktionen, `<a>` für Navigation. Niemals umdrehen.
- `<table>` nur für echte Tabellendaten (Preise, Vergleiche). Layout-Tabellen verboten.
- `<details>`/`<summary>` für Accordion (z. B. Transkript), nicht eigene JS-Implementierung.

## Focus-Management

```css
:focus-visible {
    outline: 3px solid var(--color-ink);
    outline-offset: 2px;
    border-radius: 2px;
}
```

- **`outline: none` ist verboten** außer in Verbindung mit alternativer Focus-Darstellung.
- `:focus-visible`, nicht `:focus` (verhindert Maus-Klick-Outlines).
- Focus-Reihenfolge folgt dem visuellen Lesefluss. DOM-Reihenfolge = Tab-Reihenfolge.
- `tabindex` nur für Elemente, die sonst keinen Focus hätten. Niemals positive tabindex-Werte.

## Tastatur-Navigation

- Alle interaktiven Elemente per Tab erreichbar.
- Enter/Space aktivieren Buttons.
- Escape schließt Overlays (Mobile-Menü, Modal – falls je implementiert).
- Arrow-Keys in Listen-Navigationen (Topic-Filter).

## Screen Reader

- **Alt-Texte sind Pflicht** für alle Bilder mit Bedeutung.
- Dekorative Bilder: `alt=""` oder `role="presentation"` oder `aria-hidden="true"`.
- Icon-Only-Buttons: `aria-label="Beschreibung"`.
- Form-Labels sichtbar, nicht als Placeholder getarnt.
- `<label>` mit `for`-Attribut, nicht implizites Wrapping.

## ARIA nur wenn nötig

„No ARIA is better than bad ARIA." Semantisches HTML zuerst, ARIA nur als Ergänzung:

- `aria-current="page"` auf aktivem Nav-Link.
- `aria-label` auf Nav-Landmarks.
- `aria-live="polite"` für Livewire-Success-Messages.
- `aria-expanded` auf Toggle-Buttons.
- **Keine** `role="button"` auf `<a>` oder `<div>`. Statt dessen echtes `<button>` verwenden.

## Video und Medien

- **Untertitel-Track (VTT) als Default aktiviert.** Branchenstandard für LinkedIn-Wiederverwertung und Accessibility.
- Transkript als HTML unter dem Video, nicht nur als iframe. Indexierbar und screenreader-lesbar.
- Kein Autoplay mit Ton.
- Vimeo-Player hat eigene A11y-Features, dort aktiviert lassen.

## Bewegung und Animation

```css
@media (prefers-reduced-motion: reduce) {
    .officetalk-card,
    .officetalk-card__thumb,
    .officetalk-link,
    .officetalk-progress {
        transition: none;
    }
}
```

- Alle Animationen müssen `prefers-reduced-motion` respektieren.
- Auto-Scroll, Parallax, Auto-Carousel sind verboten.
- Hover-Effekte dürfen keine Info-Verstecke sein. Info muss ohne Hover zugänglich sein.

## Forms

- Jedes Input hat ein sichtbares `<label>`.
- Required-Felder als `required` und im Label markiert (z. B. Sternchen mit `aria-hidden` und erklärendem Text).
- Fehlermeldungen per `aria-describedby` mit dem Input verknüpft.
- Success- und Error-States nicht nur farblich, sondern auch mit Icon oder Text.
- Placeholder niemals als Label-Ersatz.

## Language-Tags

- `<html lang="de">` ist Pflicht.
- Anderssprachige Zitate mit `lang="en"` markieren.

## Prüfung vor Merge

Bevor Code Richtung `main` geht:

1. Lighthouse-Accessibility ≥ 95.
2. axe-core Browser-Extension: keine kritischen Violations.
3. Tastatur-Test: komplette Seite ohne Maus durchgehen.
4. Screen-Reader-Stichprobe (VoiceOver auf macOS reicht für Quick-Check).
5. Reduced-Motion-Test im Browser-Dev-Tools aktivieren.

## Was regelmäßig schiefgeht

- Platzhalter als Label („Ihr Name" im Placeholder, Label fehlt).
- Icon-Buttons ohne `aria-label` („Share"-Icon im Footer).
- Nav-Links ohne `aria-current` auf aktiver Seite.
- Autoplay-Video-Hero (zweifach verboten: A11y und Markenstil).
- Focus-Indikator durch CSS-Reset entfernt.
- Heading-Sprünge (H1 direkt auf H3, weil „H2 sieht zu groß aus").

=== .ai/60-performance-seo rules ===

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

=== foundation rules ===

# Laravel Boost Guidelines

The Laravel Boost guidelines are specifically curated by Laravel maintainers for this application. These guidelines should be followed closely to ensure the best experience when building Laravel applications.

## Foundational Context

This application is a Laravel application and its main Laravel ecosystems package & versions are below. You are an expert with them all. Ensure you abide by these specific packages & versions.

- php - 8.3
- laravel/fortify (FORTIFY) - v1
- laravel/framework (LARAVEL) - v13
- laravel/prompts (PROMPTS) - v0
- livewire/flux (FLUXUI_FREE) - v2
- livewire/livewire (LIVEWIRE) - v4
- laravel/boost (BOOST) - v2
- laravel/mcp (MCP) - v0
- laravel/pail (PAIL) - v1
- laravel/pint (PINT) - v1
- laravel/sail (SAIL) - v1
- pestphp/pest (PEST) - v4
- phpunit/phpunit (PHPUNIT) - v12
- tailwindcss (TAILWINDCSS) - v4

## Skills Activation

This project has domain-specific skills available. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.

- `fortify-development` — ACTIVATE when the user works on authentication in Laravel. This includes login, registration, password reset, email verification, two-factor authentication (2FA/TOTP/QR codes/recovery codes), profile updates, password confirmation, or any auth-related routes and controllers. Activate when the user mentions Fortify, auth, authentication, login, register, signup, forgot password, verify email, 2FA, or references app/Actions/Fortify/, CreateNewUser, UpdateUserProfileInformation, FortifyServiceProvider, config/fortify.php, or auth guards. Fortify is the frontend-agnostic authentication backend for Laravel that registers all auth routes and controllers. Also activate when building SPA or headless authentication, customizing login redirects, overriding response contracts like LoginResponse, or configuring login throttling. Do NOT activate for Laravel Passport (OAuth2 API tokens), Socialite (OAuth social login), or non-auth Laravel features.
- `laravel-best-practices` — Apply this skill whenever writing, reviewing, or refactoring Laravel PHP code. This includes creating or modifying controllers, models, migrations, form requests, policies, jobs, scheduled commands, service classes, and Eloquent queries. Triggers for N+1 and query performance issues, caching strategies, authorization and security patterns, validation, error handling, queue and job configuration, route definitions, and architectural decisions. Also use for Laravel code reviews and refactoring existing Laravel code to follow best practices. Covers any task involving Laravel backend PHP code patterns.
- `fluxui-development` — Use this skill for Flux UI development in Livewire applications only. Trigger when working with <flux:*> components, building or customizing Livewire component UIs, creating forms, modals, tables, or other interactive elements. Covers: flux: components (buttons, inputs, modals, forms, tables, date-pickers, kanban, badges, tooltips, etc.), component composition, Tailwind CSS styling, Heroicons/Lucide icon integration, validation patterns, responsive design, and theming. Do not use for non-Livewire frameworks or non-component styling.
- `livewire-development` — Use for any task or question involving Livewire. Activate if user mentions Livewire, wire: directives, or Livewire-specific concepts like wire:model, wire:click, wire:sort, or islands, invoke this skill. Covers building new components, debugging reactivity issues, real-time form validation, drag-and-drop, loading states, migrating from Livewire 3 to 4, converting component formats (SFC/MFC/class-based), and performance optimization. Do not use for non-Livewire reactive UI (React, Vue, Alpine-only, Inertia.js) or standard Laravel forms without Livewire.
- `pest-testing` — Use this skill for Pest PHP testing in Laravel projects only. Trigger whenever any test is being written, edited, fixed, or refactored — including fixing tests that broke after a code change, adding assertions, converting PHPUnit to Pest, adding datasets, and TDD workflows. Always activate when the user asks how to write something in Pest, mentions test files or directories (tests/Feature, tests/Unit, tests/Browser), or needs browser testing, smoke testing multiple pages for JS errors, or architecture tests. Covers: test()/it()/expect() syntax, datasets, mocking, browser testing (visit/click/fill), smoke testing, arch(), Livewire component tests, RefreshDatabase, and all Pest 4 features. Do not use for factories, seeders, migrations, controllers, models, or non-test PHP code.
- `tailwindcss-development` — Always invoke when the user's message includes 'tailwind' in any form. Also invoke for: building responsive grid layouts (multi-column card grids, product grids), flex/grid page structures (dashboards with sidebars, fixed topbars, mobile-toggle navs), styling UI components (cards, tables, navbars, pricing sections, forms, inputs, badges), adding dark mode variants, fixing spacing or typography, and Tailwind v3/v4 work. The core use case: writing or fixing Tailwind utility classes in HTML templates (Blade, JSX, Vue). Skip for backend PHP logic, database queries, API routes, JavaScript with no HTML/CSS component, CSS file audits, build tool configuration, and vanilla CSS.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `npm run build`, `npm run dev`, or `composer run dev`. Ask them.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

## Replies

- Be concise in your explanations - focus on what's important rather than explaining obvious details.

=== boost rules ===

# Laravel Boost

## Tools

- Laravel Boost is an MCP server with tools designed specifically for this application. Prefer Boost tools over manual alternatives like shell commands or file reads.
- Use `database-query` to run read-only queries against the database instead of writing raw SQL in tinker.
- Use `database-schema` to inspect table structure before writing migrations or models.
- Use `get-absolute-url` to resolve the correct scheme, domain, and port for project URLs. Always use this before sharing a URL with the user.
- Use `browser-logs` to read browser logs, errors, and exceptions. Only recent logs are useful, ignore old entries.

## Searching Documentation (IMPORTANT)

- Always use `search-docs` before making code changes. Do not skip this step. It returns version-specific docs based on installed packages automatically.
- Pass a `packages` array to scope results when you know which packages are relevant.
- Use multiple broad, topic-based queries: `['rate limiting', 'routing rate limiting', 'routing']`. Expect the most relevant results first.
- Do not add package names to queries because package info is already shared. Use `test resource table`, not `filament 4 test resource table`.

### Search Syntax

1. Use words for auto-stemmed AND logic: `rate limit` matches both "rate" AND "limit".
2. Use `"quoted phrases"` for exact position matching: `"infinite scroll"` requires adjacent words in order.
3. Combine words and phrases for mixed queries: `middleware "rate limit"`.
4. Use multiple queries for OR logic: `queries=["authentication", "middleware"]`.

## Artisan

- Run Artisan commands directly via the command line (e.g., `php artisan route:list`). Use `php artisan list` to discover available commands and `php artisan [command] --help` to check parameters.
- Inspect routes with `php artisan route:list`. Filter with: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Read configuration values using dot notation: `php artisan config:show app.name`, `php artisan config:show database.default`. Or read config files directly from the `config/` directory.
- To check environment variables, read the `.env` file directly.

## Tinker

- Execute PHP in app context for debugging and testing code. Do not create models without user approval, prefer tests with factories instead. Prefer existing Artisan commands over custom tinker code.
- Always use single quotes to prevent shell expansion: `php artisan tinker --execute 'Your::code();'`
  - Double quotes for PHP strings inside: `php artisan tinker --execute 'User::where("active", true)->count();'`

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.
- Use PHP 8 constructor property promotion: `public function __construct(public GitHub $github) { }`. Do not leave empty zero-parameter `__construct()` methods unless the constructor is private.
- Use explicit return type declarations and type hints for all method parameters: `function isAccessible(User $user, ?string $path = null): bool`
- Use TitleCase for Enum keys: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefer PHPDoc blocks over inline comments. Only add inline comments for exceptionally complex logic.
- Use array shape type definitions in PHPDoc blocks.

=== deployments rules ===

# Deployment

- Laravel can be deployed using [Laravel Cloud](https://cloud.laravel.com/), which is the fastest way to deploy and scale production Laravel applications.

=== tests rules ===

# Test Enforcement

- Every change must be programmatically tested. Write a new test or update an existing test, then run the affected tests to make sure they pass.
- Run the minimum number of tests needed to ensure code quality and speed. Use `php artisan test --compact` with a specific filename or filter.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using `php artisan list` and check their parameters with `php artisan [command] --help`.
- If you're creating a generic PHP class, use `php artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `php artisan make:model --help` to check the available options.

## APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

## Vite Error

- If you receive an "Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest" error, you can run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.

=== livewire/core rules ===

# Livewire

- Livewire allow to build dynamic, reactive interfaces in PHP without writing JavaScript.
- You can use Alpine.js for client-side interactions instead of JavaScript frameworks.
- Keep state server-side so the UI reflects it. Validate and authorize in actions as you would in HTTP requests.

=== pint/core rules ===

# Laravel Pint Code Formatter

- If you have modified any PHP files, you must run `vendor/bin/pint --dirty --format agent` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test --format agent`, simply run `vendor/bin/pint --format agent` to fix any formatting issues.

=== pest/core rules ===

## Pest

- This project uses Pest for testing. Create tests: `php artisan make:test --pest {name}`.
- Run tests: `php artisan test --compact` or filter: `php artisan test --compact --filter=testName`.
- Do NOT delete tests without approval.

</laravel-boost-guidelines>
