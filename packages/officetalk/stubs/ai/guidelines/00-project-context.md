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
