<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new
#[Layout('officetalk::components.layouts.app')]
#[Title('Allgemeine Geschäftsbedingungen · OfficeTalk')]
class extends Component {
    public function with(): array
    {
        return [
            'contact' => config('officetalk.contact'),
        ];
    }
};
?>

<x-slot:metaDescription>
    Allgemeine Geschäftsbedingungen für B2B-Videoproduktion — OfficeTalk, Gerhard Popp, Wien. Branchenüblich nach WKÖ-Empfehlung und OGH 4 Ob 174/12k.
</x-slot>

<x-slot:canonical>{{ route('officetalk.legal.agb') }}</x-slot>
<x-slot:robots>noindex, follow</x-slot>

<div>
    <section class="relative bg-bg py-s7">
        <div class="container">

            <p class="font-sans text-eyebrow uppercase tracking-[0.12em] text-muted">
                Rechtliches — B2B-Videoproduktion
            </p>
            <h1 class="mt-s3 font-display text-h2 font-medium leading-tight text-balance text-ink">
                Allgemeine Geschäftsbedingungen.
            </h1>
            <p class="officetalk-legal-prose legal-stand mt-s4">
                Stand: 19.04.2026
            </p>

            <div class="officetalk-legal-prose mt-s6">

                <p>
                    Diese Allgemeinen Geschäftsbedingungen orientieren sich inhaltlich an den vom Fachverband Werbung und Marktkommunikation der Wirtschaftskammer Österreich empfohlenen Geschäftsbedingungen, die der Oberste Gerichtshof als branchenüblich beurteilt hat (OGH 4 Ob 174/12k), und berücksichtigen die Besonderheiten der audiovisuellen Auftragsproduktion.
                </p>

                <h2>§ 1 Geltungsbereich und Vertragsabschluss</h2>
                <p>
                    <strong>(1)</strong> Diese Allgemeinen Geschäftsbedingungen (im Folgenden „AGB") gelten für sämtliche Geschäftsbeziehungen zwischen
                </p>
                <p>
                    <strong>Gerhard Popp</strong>, handelnd unter der Geschäftsbezeichnung „OfficeTalk" (im Folgenden „Auftragnehmer"),<br>
                    {{ $contact['address']['street'] }}, {{ $contact['address']['postal_code'] }} {{ $contact['address']['city'] }},<br>
                    UID-Nummer: <em>[ATU-Nummer]</em>,<br>
                    Gewerbeberechtigung: Werbeagentur (freies Gewerbe), Gewerbebehörde: Magistrat der Stadt Wien, MBA <em>[Bezirk]</em>,<br>
                    Mitglied der Wirtschaftskammer Wien, Fachgruppe Werbung und Marktkommunikation,
                </p>
                <p>
                    und dem jeweiligen Auftraggeber (im Folgenden „Auftraggeber"). Anwendbare Gewerbevorschriften: Gewerbeordnung 1994, abrufbar unter <a href="https://www.ris.bka.gv.at" target="_blank" rel="noopener noreferrer">www.ris.bka.gv.at</a>.
                </p>
                <p>
                    <strong>(2)</strong> Die Leistungen des Auftragnehmers richten sich ausschließlich an Unternehmer im Sinne des § 1 Abs 1 Z 1 UGB. Verbrauchergeschäfte im Sinne des Konsumentenschutzgesetzes (KSchG) sind <strong>ausgeschlossen</strong>.
                </p>
                <p>
                    <strong>(3)</strong> Die AGB gelten in ihrer jeweils bei Vertragsabschluss gültigen Fassung als Rahmenvereinbarung auch für alle weiteren Aufträge, Folge- und Zusatzaufträge des Auftraggebers, ohne dass es eines neuerlichen Hinweises bedarf.
                </p>
                <p>
                    <strong>(4)</strong> Abweichende, entgegenstehende oder ergänzende Geschäftsbedingungen des Auftraggebers werden <strong>nicht Vertragsbestandteil</strong>, es sei denn, der Auftragnehmer stimmt ihrer Geltung ausdrücklich und schriftlich zu. Dies gilt auch, wenn der Auftragnehmer in Kenntnis entgegenstehender Bedingungen des Auftraggebers die Leistung vorbehaltlos erbringt.
                </p>
                <p>
                    <strong>(5)</strong> Der Vertrag kommt durch schriftliche Auftragsbestätigung des Auftragnehmers, durch Gegenzeichnung eines Angebots durch den Auftraggeber oder durch Beginn der Leistungserbringung nach schriftlicher Beauftragung (auch per E-Mail) zustande. Angebote des Auftragnehmers sind freibleibend und bis zu 14 Kalendertage ab Ausstellungsdatum gültig, sofern nichts anderes vereinbart ist.
                </p>
                <p>
                    <strong>(6)</strong> Änderungen oder Ergänzungen des Vertrages sowie Nebenabreden bedürfen zur Rechtswirksamkeit der Schriftform; die Schriftform wird durch E-Mail gewahrt. Gleiches gilt für ein Abgehen vom Schriftformerfordernis selbst.
                </p>

                <h2>§ 2 Leistungsbeschreibung</h2>
                <p>
                    <strong>(1)</strong> Der Auftragnehmer erbringt professionelle Dienstleistungen im Bereich der audiovisuellen Produktion, insbesondere:
                </p>
                <ul>
                    <li>Produktion von Fachinterviews, Projektpräsentationen, Teleprompter-Clips, LinkedIn-Reels und vergleichbaren B2B-Videoformaten,</li>
                    <li>Produktion von Event-After-Movies,</li>
                    <li>Durchführung und technische Umsetzung von Livestreams,</li>
                    <li>Beratung zu Konzeption, Drehplanung und Distribution audiovisueller Inhalte.</li>
                </ul>
                <p>
                    <strong>(2)</strong> Dreharbeiten finden ausschließlich <strong>on-location</strong> beim Auftraggeber oder an von diesem benannten Veranstaltungsorten statt. Ein eigenes Produktionsstudio wird nicht betrieben.
                </p>
                <p>
                    <strong>(3)</strong> Der konkrete Leistungsumfang ergibt sich aus dem jeweiligen Angebot, der Auftragsbestätigung oder einem individuellen Produktionsbriefing. Für die Auslegung gilt im Zweifel das Angebot des Auftragnehmers als maßgeblich.
                </p>
                <p>
                    <strong>(4)</strong> Der Auftragnehmer ist berechtigt, zur Erbringung seiner Leistungen auf eigene Kosten geeignete <strong>Subunternehmer</strong> (z. B. Kameraleute, Cutter:innen, Tonmeister:innen) einzusetzen, ohne dass es dazu einer gesonderten Zustimmung des Auftraggebers bedarf. Der Auftragnehmer haftet für seine Subunternehmer wie für eigenes Verhalten.
                </p>
                <p>
                    <strong>(5)</strong> Die <strong>redaktionelle Zweitverwertung</strong> produzierter Inhalte über die Kooperationspartner Walter Senk / immobilien-redaktion.com und Bernd Affenzeller / Bau &amp; Immobilien Report / Report Verlag sowie über den LinkedIn-Kanal des Geschäftsführers Gerhard Popp ist ausdrücklich <strong>nicht</strong> Bestandteil des geschuldeten Leistungsumfangs, sondern kann gesondert angeboten werden. Eine solche Distribution erfolgt nur nach ausdrücklicher Freigabe durch den Auftraggeber.
                </p>
                <p>
                    <strong>(6)</strong> Eine bestimmte <strong>Zielwirkung</strong>, ein kommerzieller Erfolg oder eine Reichweite (z. B. Abrufzahlen, Engagement-Raten) werden nicht geschuldet. Der Auftragnehmer schuldet ausschließlich die sorgfältige, fach- und branchengerechte Herstellung der vereinbarten Leistung.
                </p>

                <h2>§ 3 Mitwirkungspflichten des Auftraggebers</h2>
                <p>
                    <strong>(1)</strong> Der Auftraggeber verpflichtet sich, sämtliche für die Leistungserbringung erforderlichen Informationen, Unterlagen, Freigaben und Zugänge <strong>rechtzeitig, vollständig und in verwertbarer Form</strong> beizustellen. Dazu zählen insbesondere: Briefing, Drehorte samt Zutritt, Ansprechpersonen, Interviewpartner:innen, Texte, Logos, Corporate-Design-Vorgaben, Markenvorschriften und Musikrechte.
                </p>
                <p>
                    <strong>(2)</strong> Der Auftraggeber garantiert, dass er über sämtliche Rechte (einschließlich Urheber-, Marken- und Persönlichkeitsrechte) an den beigestellten Materialien verfügt oder zu deren Verwendung für die Auftragsproduktion berechtigt ist. Er stellt den Auftragnehmer von allen Ansprüchen Dritter, die aus einer Verletzung solcher Rechte resultieren, <strong>vollständig frei</strong>, einschließlich angemessener Kosten der Rechtsverteidigung.
                </p>
                <p>
                    <strong>(3)</strong> <strong>Persönlichkeitsrechte</strong> der im Video gezeigten oder zu Wort kommenden Personen (§ 78 UrhG, Art. 6 DSGVO) sind vom Auftraggeber eigenverantwortlich abzusichern. Der Auftraggeber ist verpflichtet, von allen Mitwirkenden vor dem Dreh eine schriftliche Einwilligung zur Aufnahme und Verwertung (im erforderlichen Umfang, inklusive Referenznutzung durch den Auftragnehmer nach § 7 dieser AGB) einzuholen. Auf Verlangen sind diese Einwilligungen dem Auftragnehmer vorzulegen.
                </p>
                <p>
                    <strong>(4)</strong> Der Auftraggeber sorgt dafür, dass am Drehort geeignete organisatorische, räumliche und energietechnische Bedingungen (Stromversorgung, Verdunkelung, Ruhe, Zutritt zu Nebenräumen für Aufbau etc.) vorhanden sind. Genehmigungen für Drehorte, Überfahrten, Drohnenflüge etc. hat der Auftraggeber beizubringen, sofern nicht ausdrücklich etwas anderes vereinbart ist.
                </p>
                <p>
                    <strong>(5)</strong> Kommt der Auftraggeber seinen Mitwirkungspflichten nicht, nicht rechtzeitig oder nicht vollständig nach, ruht die Leistungspflicht des Auftragnehmers für die Dauer der Verzögerung. Hieraus resultierende <strong>Mehraufwände, Leerzeiten und Verschiebungskosten</strong> (einschließlich bereits gebuchter Subunternehmer und Mietequipment) trägt der Auftraggeber.
                </p>

                <h2>§ 4 Preise und Zahlungsbedingungen</h2>
                <p>
                    <strong>(1)</strong> Alle Preise verstehen sich in Euro, netto, zuzüglich der zum Zeitpunkt der Leistungserbringung gesetzlich geltenden Umsatzsteuer (derzeit 20 %).
                </p>
                <p>
                    <strong>(2)</strong> Sofern im Angebot nichts anderes vereinbart ist, gilt ein <strong>Stundensatz von EUR 95,00 netto</strong> zuzüglich 20 % USt. Die Abrechnung erfolgt <strong>minutengenau</strong> und deckt sämtliche Leistungsphasen ab (Briefing, Drehvorbereitung, Dreh, Postproduktion, Korrekturen, Kundenabstimmung, Freigabe, Upload). Tagespauschalen und Paketpreise werden nicht gewährt.
                </p>
                <p>
                    <strong>(3)</strong> <strong>Fahrt- und Reisezeiten</strong> werden wie folgt berücksichtigt:<br>
                    a) Drehs innerhalb der Wiener Stadtgrenze: ohne Anfahrtspauschale.<br>
                    b) Drehs außerhalb Wiens: An- und Abreisezeit zum Stundensatz gemäß Abs. 2 sowie Kilometergeld nach dem amtlichen Kilometersatz des Bundesministeriums für Finanzen in der jeweils geltenden Höhe (derzeit EUR 0,50/km für Pkw). Bei Flug- oder Bahnreisen werden die tatsächlichen Kosten gegen Nachweis weiterverrechnet.
                </p>
                <p>
                    <strong>(4)</strong> <strong>Sonderequipment</strong> (insbesondere Dolly, Kran, Drohne inkl. Pilot, große Lichtanlagen, Funkstrecken, Livestream-Technik) wird als gesonderte Equipmentpauschale nach vorheriger Abstimmung mit dem Auftraggeber verrechnet. Dritttechnik wird zum Einkaufspreis zuzüglich Handlingaufschlag weitergegeben.
                </p>
                <p>
                    <strong>(5)</strong> Die <strong>Zahlung erfolgt in zwei Teilen</strong>:<br>
                    a) <strong>50 % Anzahlung</strong> auf den voraussichtlichen Gesamtauftragswert laut Angebot, fällig binnen 14 Kalendertagen ab Auftragsbestätigung, jedenfalls vor Drehbeginn. Die Anzahlung sichert Kapazitäten, Terminreservierungen und Subunternehmerbuchungen ab.<br>
                    b) <strong>50 % Schlusszahlung</strong> nach Lieferung der freigegebenen Endversionen, fällig binnen 14 Kalendertagen ab Rechnungsdatum ohne Abzug.
                </p>
                <p>
                    <strong>(6)</strong> Bei <strong>Zahlungsverzug</strong> ist der Auftragnehmer berechtigt, Verzugszinsen in Höhe von 9,2 Prozentpunkten über dem Basiszinssatz gemäß § 456 UGB sowie eine Pauschale von EUR 40,00 für Betreibungskosten gemäß § 458 UGB zu verrechnen. Weitergehende tatsächlich aufgewendete und zweckentsprechende Betreibungs- und Rechtsverfolgungskosten (Mahnspesen, Inkasso- und Anwaltskosten) bleiben vorbehalten.
                </p>
                <p>
                    <strong>(7)</strong> Der Auftragnehmer ist berechtigt, die Auslieferung der Endprodukte (Download-Link, Dateien, Sendematerial) <strong>bis zum vollständigen Ausgleich aller offenen Forderungen zurückzubehalten</strong>. Eine Nutzungsrechtseinräumung erfolgt erst mit vollständiger Zahlung (§ 7).
                </p>
                <p>
                    <strong>(8)</strong> <strong>Aufrechnungs- und Zurückbehaltungsrechte</strong> stehen dem Auftraggeber nur insoweit zu, als seine Gegenforderungen unbestritten, rechtskräftig festgestellt oder vom Auftragnehmer ausdrücklich anerkannt sind.
                </p>
                <p>
                    <strong>(9)</strong> Einwendungen gegen die Rechnung sind binnen 14 Tagen ab Zugang schriftlich zu erheben; andernfalls gilt die Rechnung als anerkannt.
                </p>

                <h2>§ 5 Lieferzeiten und Termine</h2>
                <p>
                    <strong>(1)</strong> Liefer- und Drehtermine sind nur dann verbindlich, wenn sie schriftlich als „Fixtermin" vereinbart werden. Im Übrigen handelt es sich um <strong>voraussichtliche Termine</strong>, die der Auftragnehmer nach bestem Bemühen einhält.
                </p>
                <p>
                    <strong>(2)</strong> Soweit keine individuelle Vereinbarung getroffen wurde, gelten folgende Richtfristen ab vollständigem Vorliegen sämtlicher für die Postproduktion notwendiger Materialien und Freigaben:
                </p>
                <ul>
                    <li><strong>Rohschnitt</strong> binnen <strong>10 Arbeitstagen</strong>,</li>
                    <li><strong>Rohschnitt bei Event-After-Movies</strong> binnen <strong>5 Arbeitstagen</strong>.</li>
                </ul>
                <p>
                    <strong>(3)</strong> Die Lieferung erfolgt digital per Download-Link (WeTransfer, Vimeo oder eigene Cloud des Auftragnehmers). Es werden standardmäßig die Formate <strong>16:9, 9:16 und 1:1</strong> als finaler Export bereitgestellt. Weitere Formate oder Versionen sind gesondert zu beauftragen.
                </p>
                <p>
                    <strong>(4)</strong> Verzögerungen, die auf fehlende oder verspätete Mitwirkung des Auftraggebers (§ 3), höhere Gewalt, Streik, behördliche Einschränkungen, Krankheit, technische Ausfälle beim Drittdienstleister oder vergleichbare, vom Auftragnehmer nicht zu vertretende Umstände zurückgehen, verlängern die Lieferfrist angemessen. Der Auftragnehmer informiert den Auftraggeber unverzüglich.
                </p>
                <p>
                    <strong>(5)</strong> <strong>Event-Drehtermine sind naturgemäß Fixtermine</strong>. Kann der Auftragnehmer aus von ihm zu vertretenden Gründen den Fixtermin nicht wahrnehmen, stellt er auf eigene Kosten eine gleichwertige Ersatzbesetzung sicher oder erstattet geleistete Anzahlungen anteilig zurück. Weitergehende Schadenersatzansprüche richten sich nach § 9.
                </p>

                <h2>§ 6 Abnahme und Korrekturschleifen</h2>
                <p>
                    <strong>(1)</strong> Nach Lieferung einer Schnittversion prüft der Auftraggeber diese <strong>unverzüglich, spätestens binnen 10 Arbeitstagen</strong> ab Zugang, und teilt Änderungswünsche oder die Freigabe schriftlich mit. Erfolgt innerhalb dieser Frist weder Rückmeldung noch Freigabe, gilt die Schnittversion als <strong>abgenommen</strong>.
                </p>
                <p>
                    <strong>(2)</strong> Im Leistungsumfang enthalten ist <strong>eine (1) Korrekturschleife</strong>, in der der Auftraggeber zusammengefasste, in sich widerspruchsfreie Änderungswünsche übermittelt. Die Korrekturwünsche sind möglichst präzise mit Zeitmarken zu versehen.
                </p>
                <p>
                    <strong>(3)</strong> <strong>Weitere Korrekturschleifen, grundlegende Konzeptänderungen, Nachdrehs oder substanzielle Umschnitte</strong> nach bereits erfolgter Freigabe eines Zwischenstands werden zum Stundensatz gemäß § 4 Abs. 2 zuzüglich allfälliger Drittkosten verrechnet. Der Auftragnehmer weist vor Beginn auf die Mehrkostenpflicht hin.
                </p>
                <p>
                    <strong>(4)</strong> Die <strong>Abnahme</strong> erfolgt durch ausdrückliche schriftliche Freigabe, durch Nutzung des Films in der Öffentlichkeit, oder durch Ablauf der Rügefrist gemäß Abs. 1. Mit Abnahme gilt die Leistung als vertragskonform erbracht.
                </p>
                <p>
                    <strong>(5)</strong> <strong>Offensichtliche Mängel</strong> sind binnen 14 Tagen ab Abnahme schriftlich zu rügen, versteckte Mängel unverzüglich nach deren Entdeckung, längstens innerhalb der gesetzlichen Gewährleistungsfrist (§ 9).
                </p>

                <h2>§ 7 Urheberrecht und Nutzungsrechte</h2>
                <p>
                    <strong>(1)</strong> Der Auftragnehmer ist <strong>Urheber</strong> der im Rahmen des Auftrags hergestellten Filmwerke im Sinne des österreichischen Urheberrechtsgesetzes (UrhG). Die Urheberpersönlichkeitsrechte verbleiben unabdingbar beim Auftragnehmer.
                </p>
                <p>
                    <strong>(2)</strong> Mit <strong>vollständiger Bezahlung der Schlussrechnung</strong> räumt der Auftragnehmer dem Auftraggeber an der vom Auftraggeber <strong>freigegebenen Endversion</strong> ein <strong>räumlich, zeitlich und inhaltlich unbeschränktes, nicht-exklusives, übertragbares und unterlizenzierbares Werknutzungsrecht</strong> (§ 24 UrhG) ein. Das Nutzungsrecht umfasst insbesondere:
                </p>
                <ul>
                    <li>die öffentliche Zurverfügungstellung (Website, Social Media, LinkedIn, YouTube, Vimeo, interne und externe Kommunikationskanäle),</li>
                    <li>die Vorführung bei Veranstaltungen, Messen und Präsentationen,</li>
                    <li>die Vervielfältigung und Verbreitung auf beliebigen Datenträgern,</li>
                    <li>die Einbindung in eigene oder fremde Werbemittel,</li>
                    <li>die redaktionelle und werbliche Verwendung durch mit dem Auftraggeber verbundene Unternehmen.</li>
                </ul>
                <p>
                    <strong>(3)</strong> <strong>Bis zur vollständigen Bezahlung</strong> verbleiben sämtliche Nutzungs- und Verwertungsrechte beim Auftragnehmer. Eine Nutzung vor vollständiger Zahlung ist <strong>unzulässig</strong> und berechtigt den Auftragnehmer zu Unterlassungs- und Lizenzschadenersatzansprüchen.
                </p>
                <p>
                    <strong>(4)</strong> <strong>Rohmaterial</strong> (Originalaufnahmen, Projektdateien, Rohschnitte, Audiospuren, Mastersequenzen, Grafikdateien) ist nicht Gegenstand der Nutzungsrechtseinräumung. Das Rohmaterial bleibt <strong>im alleinigen Eigentum des Auftragnehmers</strong> und wird von diesem für einen Zeitraum von bis zu <strong>24 Monaten</strong> ab Abnahme archiviert. Der Auftraggeber hat keinen Anspruch auf Herausgabe des Rohmaterials.
                </p>
                <p>
                    <strong>(5)</strong> <strong>Zweitverwertungen aus dem Rohmaterial</strong> (z. B. Schnittvarianten, Zusatzclips, Best-of-Montagen) sind nach Abnahme jederzeit <strong>gegen Aufwand</strong> gemäß § 4 möglich. Der Auftragnehmer sichert zu, das Rohmaterial während der Archivierungszeit für Zweitverwertungen zur Verfügung zu halten.
                </p>
                <p>
                    <strong>(6)</strong> <strong>Referenznutzung:</strong> Der Auftragnehmer ist berechtigt, die für den Auftraggeber produzierten Videos einschließlich Namen, Firmenlogo und Projekttitel zu eigenen <strong>Referenz- und Eigenwerbezwecken</strong> (insbesondere auf der eigenen Website, in Social-Media-Kanälen einschließlich LinkedIn, in Pitches, Angeboten, Showreels und Case-Studies) unentgeltlich und zeitlich unbefristet zu nutzen. Der Auftraggeber kann dieser Referenznutzung <strong>schriftlich widersprechen</strong>; in diesem Fall unterbleibt die Referenznutzung ab Zugang des Widerspruchs. Der Widerspruch wirkt nicht rückwirkend auf bereits veröffentlichte Referenzen, die der Auftragnehmer jedoch auf Anforderung des Auftraggebers innerhalb einer angemessenen Frist von seinen aktiv gepflegten Kanälen entfernt.
                </p>
                <p>
                    <strong>(7)</strong> <strong>Persönlichkeitsrechte</strong> der abgebildeten Personen (§ 78 UrhG, DSGVO) obliegen zur Gänze dem Auftraggeber (§ 3 Abs. 3). Der Auftragnehmer ist berechtigt, die Vorlage entsprechender Einwilligungen zur Voraussetzung für Dreh bzw. Veröffentlichung zu machen.
                </p>
                <p>
                    <strong>(8)</strong> <strong>Credits/Nennung:</strong> Der Auftragnehmer ist berechtigt, bei Veröffentlichung des Werks durch den Auftraggeber in angemessener Form als Produzent genannt zu werden (z. B. im Abspann, in der Videobeschreibung). Ein Unterlassen der Nennung ist nur nach vorheriger schriftlicher Zustimmung des Auftragnehmers zulässig.
                </p>
                <p>
                    <strong>(9)</strong> Beigestellte oder verwendete <strong>Drittinhalte</strong> (z. B. lizenzpflichtige Musik, Stock-Footage, Schriften) werden durch den Auftragnehmer im Namen und auf Rechnung des Auftraggebers lizenziert. Der Auftraggeber trägt die Lizenzkosten. Die Nutzungsrechte richten sich nach den jeweiligen Lizenzbedingungen des Drittanbieters.
                </p>

                <h2>§ 8 Stornierung und Rücktritt</h2>
                <p>
                    <strong>(1)</strong> Der Auftraggeber kann den Auftrag bis zum Leistungsbeginn <strong>schriftlich stornieren</strong>. In diesem Fall wird bereits erbrachter Aufwand nach Stunden gemäß § 4 Abs. 2 abgerechnet. Zusätzlich ist der <strong>Ausfall</strong> wie folgt zu vergüten:
                </p>
                <ul>
                    <li>Stornierung bis <strong>21 Kalendertage</strong> vor Drehtermin: <strong>25 %</strong> des netto Auftragsvolumens des betroffenen Drehs;</li>
                    <li>Stornierung <strong>20 bis 8 Kalendertage</strong> vor Drehtermin: <strong>50 %</strong>;</li>
                    <li>Stornierung <strong>7 bis 2 Kalendertage</strong> vor Drehtermin: <strong>75 %</strong>;</li>
                    <li>Stornierung <strong>weniger als 48 Stunden</strong> vor Drehtermin oder am Drehtag: <strong>100 %</strong>.</li>
                </ul>
                <p>
                    <strong>(2)</strong> Bei Stornierung eines <strong>Event-After-Movie-Auftrags</strong> am Event-Termin selbst (z. B. wegen Verschiebung oder Absage des Events durch den Auftraggeber) ist das volle vereinbarte Honorar zu leisten, soweit der Dreh nicht aus vom Auftragnehmer zu vertretenden Gründen unterbleibt.
                </p>
                <p>
                    <strong>(3)</strong> Geleistete <strong>Anzahlungen</strong> werden mit allfälligen Stornokosten verrechnet. Ein den Anzahlungsbetrag übersteigender Betrag ist binnen 14 Tagen nach Stornierung zu begleichen.
                </p>
                <p>
                    <strong>(4)</strong> Der Auftragnehmer ist berechtigt, vom Vertrag ganz oder teilweise <strong>zurückzutreten</strong>, wenn<br>
                    a) der Auftraggeber mit der Anzahlung mehr als 14 Tage in Verzug ist,<br>
                    b) der Auftraggeber wesentliche Mitwirkungspflichten trotz schriftlicher Nachfristsetzung von 7 Tagen nicht erfüllt,<br>
                    c) über das Vermögen des Auftraggebers ein Insolvenzverfahren eröffnet oder die Eröffnung mangels kostendeckenden Vermögens abgewiesen wird,<br>
                    d) begründete Anhaltspunkte bestehen, dass das Projekt gegen zwingende rechtliche Vorschriften (insbesondere UWG, Medienrecht, Jugendschutz) verstößt und der Auftraggeber einen vom Auftragnehmer schriftlich geforderten Nachweis der Rechtmäßigkeit nicht binnen angemessener Frist erbringt.
                </p>
                <p>
                    <strong>(5)</strong> Im Falle eines gerechtfertigten Rücktritts durch den Auftragnehmer behält dieser den Anspruch auf Vergütung aller bis zum Rücktritt erbrachten Leistungen sowie auf Ersatz der ihm tatsächlich entstandenen Kosten.
                </p>

                <h2>§ 9 Gewährleistung und Haftung</h2>
                <p>
                    <strong>(1)</strong> Der Auftragnehmer gewährleistet die <strong>fach- und branchengerechte Ausführung</strong> der Leistung entsprechend dem Stand der Technik. Geringfügige, technisch nicht vermeidbare Abweichungen (insbesondere Licht-, Ton- und Farbnuancen, Bildrauschen bei schwachen Lichtverhältnissen) stellen keinen Mangel dar.
                </p>
                <p>
                    <strong>(2)</strong> Im Falle eines Mangels hat der Auftragnehmer zunächst das Recht auf <strong>Verbesserung oder Austausch</strong> innerhalb einer angemessenen Frist. Schlägt die Verbesserung zweimal fehl oder verweigert der Auftragnehmer sie endgültig, stehen dem Auftraggeber die weiteren Gewährleistungsbehelfe (Preisminderung, Wandlung) nach Maßgabe der gesetzlichen Bestimmungen zu.
                </p>
                <p>
                    <strong>(3)</strong> Die <strong>Gewährleistungsfrist</strong> beträgt im unternehmerischen Geschäftsverkehr <strong>12 Monate</strong> ab Abnahme und verkürzt damit die Frist nach § 933 ABGB. Mängel sind innerhalb der in § 377 UGB normierten Fristen zu rügen; andernfalls gelten sie als genehmigt.
                </p>
                <p>
                    <strong>(4)</strong> Die Haftung des Auftragnehmers für <strong>Schäden</strong> ist ausgeschlossen, soweit sie nicht auf <strong>Vorsatz oder grober Fahrlässigkeit</strong> beruhen. Die Haftung für leichte Fahrlässigkeit, den Ersatz von Folgeschäden, entgangenem Gewinn, ausbleibenden Werbeerfolg, nicht erzielte Reichweiten, Zins- oder Datenverlusten, Schäden aus Ansprüchen Dritter sowie mittelbaren Schäden ist ausgeschlossen.
                </p>
                <p>
                    <strong>(5)</strong> Die Haftung des Auftragnehmers ist der Höhe nach <strong>mit dem Netto-Auftragswert des jeweiligen Einzelauftrags, höchstens jedoch mit EUR 25.000,00 je Schadensfall und EUR 50.000,00 im Jahr</strong> begrenzt.
                </p>
                <p>
                    <strong>(6)</strong> Die Haftungsbeschränkungen gemäß Abs. 4 und 5 gelten <strong>nicht</strong> für Personenschäden, für Schäden nach dem Produkthaftungsgesetz sowie für Schäden, die durch Vorsatz des Auftragnehmers verursacht wurden.
                </p>
                <p>
                    <strong>(7)</strong> Der Auftragnehmer haftet <strong>nicht</strong> für die rechtliche (insbesondere wettbewerbs-, marken-, urheber-, persönlichkeits-, lebensmittel-, werbe- und medienrechtliche) <strong>Zulässigkeit</strong> der Inhalte, soweit diese vom Auftraggeber vorgegeben oder zur Freigabe vorgelegt wurden. Eine rechtliche Prüfung der Inhalte durch den Auftragnehmer findet <strong>nicht</strong> statt; der Auftraggeber ist für die kennzeichen- und wettbewerbsrechtliche Überprüfung und die rechtliche Absicherung der Werbemaßnahme selbst verantwortlich (vgl. OGH 4 Ob 174/12k).
                </p>
                <p>
                    <strong>(8)</strong> Der Auftraggeber hält den Auftragnehmer hinsichtlich aller aus der Auftragsdurchführung resultierenden Ansprüche Dritter (insbesondere wegen Persönlichkeits-, Urheber-, Marken- und Wettbewerbsrechtsverletzungen) schad- und klaglos, sofern und soweit diese auf Umstände im Verantwortungsbereich des Auftraggebers zurückgehen.
                </p>
                <p>
                    <strong>(9)</strong> Schadenersatzansprüche des Auftraggebers verjähren in <strong>12 Monaten</strong> ab Kenntnis des Schadens und des Schädigers, spätestens jedoch nach <strong>drei Jahren</strong> ab der schädigenden Handlung.
                </p>

                <h2>§ 10 Datenschutz</h2>
                <p>
                    <strong>(1)</strong> Der Auftragnehmer verarbeitet personenbezogene Daten des Auftraggebers und seiner Mitarbeiter:innen ausschließlich zur Vertragsabwicklung und im Einklang mit der DSGVO und dem österreichischen DSG. Details ergeben sich aus der unter <a href="{{ route('officetalk.legal.datenschutz') }}">Datenschutzerklärung</a> abrufbaren Datenschutzerklärung.
                </p>
                <p>
                    <strong>(2)</strong> Soweit der Auftragnehmer im Zuge der Leistungserbringung personenbezogene Daten Dritter (z. B. von Interviewpartner:innen, Event-Teilnehmer:innen) im Auftrag des Auftraggebers verarbeitet, schließen die Parteien auf Verlangen einen <strong>Auftragsverarbeitungsvertrag</strong> gemäß Art. 28 DSGVO ab.
                </p>
                <p>
                    <strong>(3)</strong> Beide Parteien verpflichten sich zur <strong>vertraulichen Behandlung</strong> aller im Rahmen der Vertragsdurchführung bekannt werdenden Geschäfts- und Betriebsgeheimnisse, auch über das Vertragsende hinaus.
                </p>

                <h2>§ 11 Gerichtsstand und anwendbares Recht</h2>
                <p>
                    <strong>(1)</strong> Es gilt ausschließlich <strong>österreichisches Recht</strong> unter Ausschluss der Verweisungsnormen des Internationalen Privatrechts und des UN-Kaufrechts (CISG).
                </p>
                <p>
                    <strong>(2)</strong> Erfüllungsort ist der Geschäftssitz des Auftragnehmers in Wien.
                </p>
                <p>
                    <strong>(3)</strong> Als <strong>ausschließlicher Gerichtsstand</strong> für alle Streitigkeiten aus oder im Zusammenhang mit diesem Vertrag wird das für 1010 Wien sachlich zuständige Gericht (in Handelssachen: <strong>Handelsgericht Wien</strong>, im Übrigen: <strong>Bezirksgericht für Handelssachen Wien</strong>) vereinbart. Der Auftragnehmer ist berechtigt, den Auftraggeber auch an dessen allgemeinem Gerichtsstand zu belangen.
                </p>
                <p>
                    <strong>(4)</strong> Für Auftraggeber mit Sitz in Deutschland oder der Schweiz gilt die Rechtswahl gemäß Abs. 1 und die Gerichtsstandsvereinbarung gemäß Abs. 3 auch dann, wenn zwingende Bestimmungen des Heimatstaates dem nicht entgegenstehen. Die Rom-I-Verordnung bleibt unberührt.
                </p>

                <h2>§ 12 Schlussbestimmungen</h2>
                <p>
                    <strong>(1)</strong> <strong>Schriftform:</strong> Änderungen und Ergänzungen dieses Vertrages bedürfen der Schriftform; die elektronische Form (E-Mail) wird als Schriftform anerkannt. Mündliche Nebenabreden bestehen nicht.
                </p>
                <p>
                    <strong>(2)</strong> <strong>Salvatorische Klausel:</strong> Sollten einzelne Bestimmungen dieses Vertrages ganz oder teilweise unwirksam oder undurchführbar sein oder werden, so wird hierdurch die Wirksamkeit der übrigen Bestimmungen nicht berührt. Die Parteien werden die unwirksame oder undurchführbare Bestimmung durch eine solche ersetzen, die dem wirtschaftlichen Zweck der weggefallenen Bestimmung möglichst nahekommt. Gleiches gilt im Falle einer Regelungslücke.
                </p>
                <p>
                    <strong>(3)</strong> <strong>Abtretung:</strong> Der Auftraggeber darf Ansprüche aus diesem Vertrag nur mit vorheriger schriftlicher Zustimmung des Auftragnehmers an Dritte abtreten. Der Auftragnehmer ist berechtigt, Forderungen aus diesem Vertrag an Dritte abzutreten.
                </p>
                <p>
                    <strong>(4)</strong> <strong>Änderung der AGB:</strong> Der Auftragnehmer ist berechtigt, diese AGB mit einer Ankündigungsfrist von 6 Wochen zu ändern. Widerspricht der Auftraggeber der Änderung nicht innerhalb von 4 Wochen ab Zugang der Änderungsmitteilung schriftlich, gilt die Änderung als genehmigt. Auf diese Rechtsfolge wird in der Änderungsmitteilung gesondert hingewiesen.
                </p>
                <p>
                    <strong>(5)</strong> Vertragssprache ist Deutsch.
                </p>
            </div>

            <div class="mt-s7">
                <a
                    href="{{ route('officetalk.landing') }}"
                    class="inline-flex items-center gap-s2 bg-accent px-s4 py-s3 font-sans text-body font-semibold text-[#111] transition-colors duration-200 hover:bg-[#111] hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent"
                >
                    Zurück zur Startseite
                    <svg width="18" height="12" viewBox="0 0 18 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M 1 6 L 16 6" />
                        <path d="M 11 1 L 16 6 L 11 11" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
</div>
