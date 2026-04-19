# OfficeTalk – Logo-Vorlagen · K1 final

SVG-Ausgangsdateien in der finalen Geometrie. Koffer mit integriertem Kamera-Objektiv. Direkt einsetzbar und als Ausgangspunkt für weitere Bearbeitung in Adobe Illustrator, Affinity Designer oder Figma.

## Was unterscheidet diese Version von der vorherigen

Drei Änderungen gegenüber der ersten Logo-Vorlage, die den Koffer als reines Gepäckstück zeigte:

Erstens die Linse. Ein schwarz gefüllter Kreis mit Radius 11 Einheiten, zentriert auf dem Koffer-Gehäuse. Darüber ein Lichtreflex als weißes Oval bei 70 Prozent Deckkraft, um −30 Grad rotiert, oben links in der Linse positioniert. Das transformiert den Koffer in einen Reportage-Koffer mit sichtbarem Kamera-Objektiv.

Zweitens die verkürzten Rillen. Statt durchgehender Linien von x=24 bis x=116 laufen die Rillen jetzt von x=42 bis x=98. Länge 56 statt 92 Einheiten. Das erzeugt den Kamera-Gehäuse-Eindruck: Sucherleiste oben, Grifffläche unten, Objektiv in der Mitte.

Drittens die Doppellesbarkeit. Der Koffer ist noch erkennbar – Rimowa-Hommage, Tragegriff, 2:1-Proportion – aber der Videobezug ist jetzt eindeutig. Wer die Videos kennt, sieht den gelben Koffer. Wer das Logo zuerst trifft, sieht eine Kamera.

## Warum SVG statt .ai

Adobe Illustrator speichert im proprietären `.ai`-Format, das ausschließlich Illustrator selbst schreiben kann. Der belastbare Austauschweg ist SVG: Jede aktuelle Designsoftware öffnet SVG direkt und kann die Datei nach dem Öffnen als `.ai`, `.afdesign` oder Figma-Dokument speichern. Die Struktur mit benannten Gruppen (`id`, `inkscape:label`) wird als Layer übernommen.

## Dateien

| Datei | Verwendung |
|---|---|
| `officetalk-logo-master.svg` | Übersichtsbogen mit allen Varianten, Konstruktionsraster, Farbpalette |
| `officetalk-logo-full-color.svg` | Primärvariante: Koffer Ocker, Linse Schwarz, Wortmarke Ink |
| `officetalk-logo-full-black.svg` | Monochrom Schwarz für Fax, Stempel, einfarbigen Druck |
| `officetalk-logo-full-invert.svg` | Invers auf dunklem Grund (Footer, Video-Credits, Keynote) |
| `officetalk-logo-full-invert-mono.svg` | Monochrom invers für dunkle Flächen ohne Zweifarbigkeit |
| `officetalk-mark-color.svg` | Bildmarke solo, quadratisch, für Social-Avatar |
| `officetalk-mark-black.svg` | Bildmarke Outline-Schwarz |
| `officetalk-favicon.svg` | Reduzierte Variante für Favicon-Größen 16–32 px |

## Geometrie der Bildmarke

Die Werte beziehen sich auf die viewBox `140 × 84`. Alles ist proportional skalierbar.

| Element | Werte |
|---|---|
| Gehäuse | `x=12 y=16 width=116 height=60`, Radius 2 px |
| Griff | Pfad `M 54 14 L 54 6 L 86 6 L 86 14`, Stroke 4 px |
| Obere Rille | `x=42 bis x=98`, `y=28`, Stroke 4 px |
| Untere Rille | `x=42 bis x=98`, `y=64`, Stroke 4 px |
| Objektiv | Kreis `cx=70 cy=46 r=11`, gefüllt Ink |
| Reflex | Oval `cx=66.5 cy=43 rx=3.6 ry=1.8`, rotiert −30°, Paper bei 70 % Deckkraft |

## Nach dem Import in Illustrator

Drei Handgriffe vor dem Weitergestalten:

Erstens **Schrift in Pfade umwandeln** (`Schrift > In Pfade umwandeln` oder `Cmd+Shift+O`). Solange die Wortmarke als Live-Text gespeichert ist, braucht jeder Empfänger Fraunces installiert. Für das finale Deliverable immer outlinen.

Zweitens **Artboards einrichten**, falls mehrere Formate in einer Datei liegen sollen. Das Master-Sheet ist auf 1200 × 1500 px ausgelegt, die Einzeldateien auf die jeweilige Marke zugeschnitten.

Drittens **Farben als globale Farbfelder** anlegen: Accent `#E3B505`, Ink `#111111`, Paper `#FAFAF7`, Strong `#2B2B28`. Spart Korrektur-Arbeit, wenn der Auftraggeber Ton-Anpassungen wünscht.

## Typografie

Die Wortmarke ist in **Fraunces Medium** gesetzt (Google Fonts, frei verfügbar). Fallback-Kette in den SVGs: Fraunces → Tiempos Headline → Source Serif Pro → Georgia → generic serif. Wer mit Tiempos Headline (Klim Type Foundry, ca. 600 USD) arbeiten will: sauberer Austausch beim finalen Outline-Schritt, die Geometrie ist vergleichbar.

## Schutzraum und Mindestgrößen

Mindestabstand zu anderen Elementen: eine Rillen-Höhe rund um die Bildmarke. Bei einer 140 × 84 Bildmarke entspricht das 20 Einheiten Padding auf allen Seiten. Im Master-Sheet ist der Schutzraum als gelbe Strichlinie eingezeichnet.

**Mindestgröße digital:** 24 px Bildmarken-Höhe. Darunter die Favicon-Variante verwenden, dort sind Rillen und Reflex bereits für kleine Darstellung vereinfacht.

**Mindestgröße Print:** 8 mm Bildmarken-Höhe bei 300 dpi. Darunter verliert das Reflex-Detail Kontur.

## Was nicht verhandelbar ist

- Gelb niemals als Textfarbe auf weißem Grund (Kontrast 2,2:1, WCAG-untauglich)
- Kein Soft-Shadow, kein Gradient, keine 3D-Effekte, keine runden Rahmen über 4 px
- Die Wortmarke bleibt **OfficeTalk** (Kamelhöcker), niemals `office talk` oder `OFFICETALK` in Versalien
- Bildmarke und Wortmarke dürfen getrennt auftreten, aber niemals beide gleichzeitig in unterschiedlichen Farbkonzepten auf derselben Fläche
- Reflex-Deckkraft bleibt bei 70 Prozent. Höhere Deckkraft macht die Linse zu hell, niedrigere lässt den Reflex verschwinden
- Rillen-Länge bleibt `x=42 bis x=98`. Volle Rillen kippen zurück zum Koffer-Look, stärkere Kürzung überzeichnet den Kamera-Bezug

## Nächste Schritte

Wenn das Design final ausgearbeitet ist: alle Varianten als finale `.ai` oder `.afdesign` speichern, Pfade ausrichten auf Pixel-Grid bei kleinen Größen, dann Export in PNG (1×, 2×, 3×), WebP und ICO (Favicon). Für den Druck zusätzlich CMYK-Variante mit entsprechender Farbumrechnung – `#E3B505` entspricht ungefähr C0 M27 Y99 K11 (uncoated) oder dem Pantone 124 C.
