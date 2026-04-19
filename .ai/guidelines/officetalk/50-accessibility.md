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
