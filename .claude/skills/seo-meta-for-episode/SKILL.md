---
name: seo-meta-for-episode
description: "Use this skill when the user wants to optimize or generate SEO meta tags, social media previews, or Schema.org markup for an OfficeTalk episode. Triggers include: 'SEO für Folge X', 'Meta-Tags für Episode', 'OG-Image prüfen', 'LinkedIn-Preview optimieren', 'Schema.org für [Episode]', 'warum rankt die Folge nicht', 'Search Console zeigt Probleme'. Also trigger when an episode was just published and needs final SEO pass before announcement, or when meta_title/meta_description overrides are being crafted. Do NOT use for general SEO questions unrelated to OfficeTalk episodes."
---

# Skill: SEO-Metadaten für OfficeTalk-Episode

## Wann diese Skill greift

Der User möchte Meta-Tags, OpenGraph-Daten, Twitter-Card-Parameter oder Schema.org-Markup für eine Episode optimieren, prüfen oder generieren. Das betrifft sowohl die Pre-Publication-Vorbereitung als auch die Nachoptimierung bei SEO-Problemen.

## Ablauf

### 1. Episode laden und Zustand prüfen

```php
$episode = Officetalk\Models\Episode::where('slug', 'ep-047-...')
    ->with(['guest', 'topics'])
    ->first();
```

Prüfen:

- Ist `meta_title` gesetzt oder wird Default genutzt? → `$episode->resolved_meta_title`
- Ist `meta_description` gesetzt oder wird Default genutzt? → `$episode->resolved_meta_description`
- Ist `still_landscape` gesetzt (wird zum OG-Image)?
- Sind `vimeo_id` und `duration_minutes` vorhanden (für Schema.org)?

### 2. Meta-Title prüfen oder neu schreiben

**Regeln:**

- Unter 60 Zeichen inklusive Separator und Marke.
- Aktiv formuliert, Kernaussage zuerst.
- Keine Keyword-Stuffing-Reihungen wie „Immobilien | Wien | Podcast | Interview".

**Muster:**

```
{Kernaussage in 40 Zeichen} – OfficeTalk #{nummer}
```

Beispiele:

- ✅ „Was ESG-Reporting die Bauträger kostet – OfficeTalk #047"
- ❌ „OfficeTalk Episode 047 mit Thomas Müller über ESG im Immobilienbau 2026"

### 3. Meta-Description prüfen oder neu schreiben

**Regeln:**

- Unter 160 Zeichen.
- Ein vollständiger Satz, aktiv.
- Kern-Aussage der Folge, nicht Wiederholung des Titels.
- Keine CTA-Phrasen wie „Jetzt ansehen!".

**Muster:**

```
{Gast-Name} ({Unternehmen}) {Verb aktiv} mit Walter Senk {was konkret}. {Kern-Zahl oder These}.
```

Beispiele:

- ✅ „Thomas Müller (BUWOG) rechnet mit Walter Senk durch, was ESG-Reporting die Bauträger ab 2027 kostet. Zwischen 180.000 und 400.000 Euro pro Unternehmen."
- ❌ „In dieser spannenden Folge unseres OfficeTalk-Formats diskutieren wir mit Thomas Müller über ESG."

### 4. OG-Image prüfen

- Format: WebP oder JPEG, 1200×630 px.
- Unter 200 KB komprimiert.
- Lesbarkeit des Gast-Namens in kleiner Vorschau (LinkedIn-Feed ist winzig).
- Koffer-Signet sichtbar unten rechts.

Test: LinkedIn Post Inspector (`https://www.linkedin.com/post-inspector/`) und Facebook Sharing Debugger (`https://developers.facebook.com/tools/debug/`).

Wenn das Asset fehlt: aus `still_landscape` ableiten, aber ein dediziertes `thumbnail_linkedin` ist vorzuziehen (Portrait-Rahmen + Textoverlay).

### 5. Schema.org `VideoObject` validieren

Template ist bereits in `resources/views/episodes/show.blade.php` implementiert. Bei Änderungen daran:

**Pflichtfelder:**

- `name`
- `description`
- `thumbnailUrl`
- `uploadDate` (ISO 8601)
- `embedUrl`
- `publisher` (Organization)

**Empfohlene Felder:**

- `duration` (ISO 8601-Format: `PT28M` für 28 Minuten)
- `interviewer` (Person)
- `about` (Person mit worksFor Organization)

Test: Google Rich Results Test (`https://search.google.com/test/rich-results`).

### 6. Canonical-URL prüfen

Auf Episoden-Detailseiten muss Canonical auf `route('officetalk.episodes.show', $episode)` zeigen. Bei Duplicate-Content-Problemen (Cross-Post, Archiv-Listings) sind die Non-Canonical-Versionen mit Canonical auf die Hauptseite zu verweisen.

### 7. LinkedIn-spezifische Optimierung

LinkedIn-Algorithmus bewertet anders als Google:

- **Post-Text-Länge:** 150–300 Wörter im Lead-Post.
- **Hashtags:** 3–5 branchenrelevante, niemals generische (`#Business`, `#Networking`).
- **Verlinkung:** Erst im ersten Kommentar (algorithmisch bessergestellt als im Post selbst).
- **Uploadzeit:** Dienstag oder Donnerstag, 07:00–08:30 MEZ.

### 8. Tracking-Pflichten

Vor Publikation:

- Tracking-Event `episode_play` mit `episode_id` und `episode_number` sicherstellen.
- Outbound-Tracking auf LinkedIn- und Spotify-Links.
- Newsletter-Integration: Ist der Episoden-Link bereit für Crossposting?

## Ausgabe-Format

Wenn der User eine Meta-Optimierung für eine Episode anfordert, liefere:

```
### Meta-Title
"Was ESG-Reporting die Bauträger kostet – OfficeTalk #047" (54 Zeichen ✓)

### Meta-Description
"Thomas Müller (BUWOG) rechnet mit Walter Senk durch, was ESG-Reporting die Bauträger ab 2027 kostet. Zwischen 180.000 und 400.000 Euro pro Unternehmen." (158 Zeichen ✓)

### Verbesserung gegenüber Default
- Title: +18 % Conversion-Potenzial durch Lead-First-Struktur
- Description: konkrete Zahl im ersten Satz, statt generischer Themenbeschreibung

### SQL-Update
UPDATE officetalk_episodes
SET meta_title = '...', meta_description = '...'
WHERE slug = 'ep-047-...';
```

Oder als Eloquent:

```php
$episode->update([
    'meta_title' => '...',
    'meta_description' => '...',
]);
```

## Typische Fehler

- Meta-Description als Wiederholung des Titels – verschwendet Snippet-Platz.
- Keywords kommaseparrriert im Title – liest sich unprofessionell und wird von Google abgewertet.
- Absolute vs. relative URLs vermischt im Schema.org.
- OG-Image unter 1200 px Breite – LinkedIn zeigt kleine Thumbnail-Variante.
- Duration im Schema als Minuten-Zahl statt ISO 8601 (`PT28M`).
- Canonical auf HTTP statt HTTPS.
