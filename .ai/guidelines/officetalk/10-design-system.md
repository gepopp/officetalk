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
