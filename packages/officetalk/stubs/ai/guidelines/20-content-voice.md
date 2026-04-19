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
