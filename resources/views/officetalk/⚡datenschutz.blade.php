<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new
#[Layout('officetalk::components.layouts.app')]
#[Title('Datenschutzerklärung · OfficeTalk')]
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
    Datenschutzerklärung nach DSGVO, DSG und TKG 2021 — OfficeTalk, B2B-Videoproduktion, Gerhard Popp in Wien.
</x-slot>

<x-slot:canonical>{{ route('officetalk.legal.datenschutz') }}</x-slot>

<div>
    <section class="relative bg-bg py-s7">
        <div class="container">

            <p class="font-sans text-eyebrow uppercase tracking-[0.12em] text-muted">
                Rechtliches — DSGVO, DSG, TKG 2021
            </p>
            <h1 class="mt-s3 font-display text-h2 font-medium leading-tight text-balance text-ink">
                Datenschutzerklärung.
            </h1>
            <p class="officetalk-legal-prose legal-stand mt-s4">
                Stand: 19.04.2026
            </p>

            <div class="officetalk-legal-prose mt-s6">

                <p>
                    Der Schutz Ihrer personenbezogenen Daten ist uns ein wichtiges Anliegen. In dieser Datenschutzerklärung informieren wir Sie in Übereinstimmung mit Art. 13 und Art. 14 der <strong>Datenschutz-Grundverordnung (DSGVO)</strong>, dem österreichischen <strong>Datenschutzgesetz (DSG)</strong> sowie dem <strong>Telekommunikationsgesetz 2021 (TKG 2021)</strong> darüber, welche personenbezogenen Daten wir beim Besuch unserer Website und bei der Kontaktaufnahme verarbeiten, zu welchem Zweck dies geschieht und welche Rechte Ihnen zustehen.
                </p>

                <h2>1. Verantwortlicher</h2>
                <p>Verantwortlicher im Sinne des Art. 4 Z 7 DSGVO ist:</p>
                <p>
                    <strong>Gerhard Popp – OfficeTalk</strong><br>
                    {{ $contact['address']['street'] }}<br>
                    {{ $contact['address']['postal_code'] }} {{ $contact['address']['city'] }}, {{ $contact['address']['country'] }}<br>
                    @if ($contact['phone'] && $contact['phone'] !== '[Telefonnummer]')
                        Telefon: <a href="tel:{{ preg_replace('/\s+/', '', $contact['phone']) }}">{{ $contact['phone'] }}</a><br>
                    @endif
                    E-Mail: <a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a><br>
                    Gewerbe: Werbeagentur (freies Gewerbe)<br>
                    Mitglied der Wirtschaftskammer Wien, Fachgruppe Werbung und Marktkommunikation.
                </p>
                <p>
                    Eine/n Datenschutzbeauftragte/n haben wir nicht bestellt, weil wir die gesetzlichen Voraussetzungen nach Art. 37 DSGVO nicht erfüllen. Für alle Fragen zum Datenschutz ist direkt der Verantwortliche unter den oben genannten Kontaktdaten erreichbar.
                </p>

                <h2>2. Allgemeine Grundsätze der Verarbeitung</h2>
                <p>
                    Wir verarbeiten personenbezogene Daten grundsätzlich nur, soweit dies zur Bereitstellung einer funktionsfähigen Website, unserer Inhalte und Leistungen erforderlich ist. Die Verarbeitung erfolgt nur, wenn eine Rechtsgrundlage nach Art. 6 DSGVO besteht, insbesondere:
                </p>
                <ul>
                    <li>Ihre <strong>Einwilligung</strong> (Art. 6 Abs. 1 lit. a DSGVO),</li>
                    <li>die <strong>Erfüllung eines Vertrages</strong> oder vorvertragliche Maßnahmen (Art. 6 Abs. 1 lit. b DSGVO),</li>
                    <li>die Erfüllung einer <strong>rechtlichen Verpflichtung</strong> (Art. 6 Abs. 1 lit. c DSGVO),</li>
                    <li>die Wahrung unserer <strong>berechtigten Interessen</strong> (Art. 6 Abs. 1 lit. f DSGVO).</li>
                </ul>

                <h2>3. Bereitstellung der Website und Server-Logfiles</h2>
                <p>
                    Bei jedem Aufruf unserer Website erfasst unser Webhosting-Provider automatisch Daten, die Ihr Browser übermittelt, in sogenannten <strong>Server-Logfiles</strong>. Verarbeitet werden:
                </p>
                <ul>
                    <li>IP-Adresse des anfragenden Geräts,</li>
                    <li>Datum und Uhrzeit des Zugriffs,</li>
                    <li>aufgerufene Seite/Datei und übertragene Datenmenge,</li>
                    <li>Meldung über erfolgreichen Abruf (HTTP-Status),</li>
                    <li>verwendeter Browsertyp und -version, Betriebssystem,</li>
                    <li>Referrer URL.</li>
                </ul>
                <p>
                    <strong>Zwecke:</strong> Sicherstellung eines reibungslosen Betriebs der Website, Gewährleistung der IT-Sicherheit (Abwehr von Angriffen, z. B. DDoS), Fehleranalyse und Leistungsoptimierung.
                </p>
                <p>
                    <strong>Rechtsgrundlage:</strong> Art. 6 Abs. 1 lit. f DSGVO (berechtigtes Interesse am stabilen und sicheren Betrieb der Website).
                </p>
                <p>
                    <strong>Speicherdauer:</strong> 7 Tage; bei Vorliegen eines Sicherheitsvorfalls bis zur abschließenden Aufklärung, längstens 6 Monate.
                </p>
                <p>
                    <strong>Auftragsverarbeiter (Hosting):</strong> <strong>DigitalOcean, LLC</strong>, 101 Avenue of the Americas, 10th Floor, New York, NY 10013, USA. Mit DigitalOcean besteht ein Auftragsverarbeitungsvertrag gemäß Art. 28 DSGVO einschließlich der EU-Standardvertragsklauseln (Art. 46 Abs. 2 lit. c DSGVO). DigitalOcean ist unter dem EU-US Data Privacy Framework zertifiziert. Der Server-Standort befindet sich im EU-Rechenzentrum <em>[Frankfurt (FRA1) oder Amsterdam (AMS3) — konkreten Standort vor Go-Live prüfen]</em>.
                </p>

                <h2>4. Kontaktaufnahme (Formular, E-Mail, Telefon)</h2>
                <p>
                    Wenn Sie uns per Kontaktformular, E-Mail, Telefon oder über einen anderen Kanal kontaktieren, verarbeiten wir die von Ihnen übermittelten Daten (insbesondere Name, Firma, E-Mail-Adresse, Telefonnummer, Betreff und Inhalt Ihrer Anfrage) zur Beantwortung Ihrer Anfrage und für den Fall, dass sich Anschlussfragen ergeben.
                </p>
                <p>
                    Die Daten aus dem <strong>Kontaktformular</strong> werden technisch per E-Mail an unsere Geschäftsadresse weitergeleitet und dort gespeichert. Eine Übermittlung an Dritte erfolgt nicht, außer an unseren E-Mail-Provider (siehe Abschnitt 12) als Auftragsverarbeiter.
                </p>
                <p><strong>Rechtsgrundlage:</strong></p>
                <ul>
                    <li>Bei Anfragen im Zusammenhang mit einer bestehenden oder angebahnten Geschäftsbeziehung: Art. 6 Abs. 1 lit. b DSGVO (Vertragserfüllung/vorvertragliche Maßnahmen).</li>
                    <li>Bei sonstigen Anfragen: Art. 6 Abs. 1 lit. f DSGVO (berechtigtes Interesse an effizienter Kommunikation) bzw. Art. 6 Abs. 1 lit. a DSGVO, soweit Sie hierzu ausdrücklich einwilligen.</li>
                </ul>
                <p>
                    <strong>Speicherdauer:</strong> Anfragedaten werden gelöscht, sobald sie für den Zweck nicht mehr erforderlich sind, spätestens nach 3 Jahren. Gesetzliche Aufbewahrungspflichten (insbesondere § 212 UGB, § 132 BAO: 7 Jahre für geschäftsrelevante Korrespondenz) bleiben unberührt.
                </p>

                <h2>5. Cookies und ähnliche Technologien</h2>
                <p>
                    Unsere Website verwendet <strong>Cookies</strong> sowie vergleichbare Technologien (z. B. Local Storage). Cookies sind kleine Textdateien, die auf Ihrem Endgerät gespeichert werden.
                </p>
                <p>Wir unterscheiden zwischen:</p>
                <p>
                    <strong>a) Technisch notwendigen Cookies</strong>, die für den Betrieb der Website zwingend erforderlich sind (z. B. zur Speicherung Ihrer Consent-Entscheidung). Rechtsgrundlage: § 165 Abs. 3 TKG 2021 in Verbindung mit Art. 6 Abs. 1 lit. f DSGVO.
                </p>
                <p>
                    <strong>b) Nicht notwendigen Cookies und Technologien</strong>, die Reichweitenmessung oder Analyse ermöglichen (insbesondere Google Analytics 4, siehe Abschnitt 6). Diese werden <strong>erst nach Ihrer ausdrücklichen Einwilligung</strong> gemäß § 165 Abs. 3 TKG 2021 und Art. 6 Abs. 1 lit. a DSGVO aktiviert.
                </p>
                <p>
                    Vor der Aktivierung nicht-notwendiger Technologien wird Ihnen ein <strong>Consent-Banner</strong> angezeigt, in dem Sie granular über Annehmen, Ablehnen oder differenzierte Auswahl entscheiden können. Ihre Einwilligung können Sie jederzeit für die Zukunft widerrufen, indem Sie Cookies in Ihrem Browser löschen oder uns unter den in Abschnitt 1 genannten Kontaktdaten eine formlose Mitteilung senden. Die Rechtmäßigkeit der bis zum Widerruf erfolgten Verarbeitung bleibt vom Widerruf unberührt.
                </p>

                <h2>6. Google Analytics 4</h2>
                <p>
                    Wir verwenden auf dieser Website den Webanalysedienst <strong>Google Analytics 4</strong> (nachfolgend „GA4") der <strong>Google Ireland Limited</strong> (Gordon House, Barrow Street, Dublin 4, Irland; zusammen mit der Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043, USA, nachfolgend „Google"). GA4 ermöglicht uns eine anonymisierte, aggregierte Analyse des Nutzungsverhaltens auf unserer Website, um Inhalte und Reichweite zu optimieren.
                </p>
                <p>
                    <strong>Erhobene Daten:</strong> Im Rahmen von GA4 werden insbesondere folgende Daten verarbeitet: IP-Adresse (gekürzt/anonymisiert, siehe unten), technische Informationen zum Gerät und Browser, ungefährer Standort (bis auf Stadtebene), besuchte Seiten und Verweildauer, Klick- und Scroll-Ereignisse, Referrer-URL, zufallsgenerierte Online-Kennungen (Client- und Session-IDs).
                </p>
                <p>
                    <strong>Rechtsgrundlage:</strong> Ausschließlich <strong>Ihre Einwilligung</strong> gemäß Art. 6 Abs. 1 lit. a DSGVO in Verbindung mit § 165 Abs. 3 TKG 2021. <strong>Ohne Ihre Einwilligung wird GA4 nicht geladen und keine Daten werden übertragen.</strong> Ihre Einwilligung können Sie jederzeit mit Wirkung für die Zukunft über unser Consent-Banner widerrufen.
                </p>
                <p>
                    <strong>Datenschutzfreundliche Konfiguration:</strong> Wir haben GA4 gemäß den Empfehlungen der österreichischen Datenschutzbehörde und aktueller fachlicher Standards wie folgt konfiguriert:
                </p>
                <ul>
                    <li><strong>IP-Anonymisierung:</strong> In GA4 werden IP-Adressen standardmäßig nicht gespeichert und nur kurzzeitig zur Geolokalisierung auf Stadtebene verwendet; IP-Adressen aus dem EWR werden auf EU-Servern gekürzt und nicht an US-Server übertragen.</li>
                    <li><strong>Google Signals, Werbefunktionen und User-ID-Funktion:</strong> deaktiviert.</li>
                    <li><strong>Datenaufbewahrung:</strong> Die Speicherdauer der Ereignis-Daten auf Nutzer- und Ereignisebene ist auf das Minimum von <strong>2 Monaten</strong> gesetzt.</li>
                    <li><strong>Google Consent Mode v2:</strong> aktiv. Vor Einwilligung werden keine Cookies gesetzt und keine personenbezogenen Daten an Google übermittelt.</li>
                    <li><strong>Data Sharing Settings</strong> mit Google (z. B. „Produkte verbessern", „Technischer Support"): deaktiviert, soweit optional.</li>
                </ul>
                <p>
                    <strong>Auftragsverarbeitung:</strong> Mit Google besteht ein Vertrag zur Auftragsverarbeitung gemäß Art. 28 DSGVO („Google Ads Data Processing Terms"). Zudem haben wir mit Google die EU-Standardvertragsklauseln gemäß Durchführungsbeschluss (EU) 2021/914 abgeschlossen.
                </p>
                <p>
                    <strong>Datenübermittlung in Drittländer:</strong> Eine Übermittlung personenbezogener Daten in die USA kann trotz der getroffenen Konfiguration nicht vollständig ausgeschlossen werden. Google LLC ist unter dem <strong>EU-US Data Privacy Framework (DPF)</strong> zertifiziert; die Europäische Kommission hat mit <strong>Angemessenheitsbeschluss vom 10. Juli 2023</strong> (C(2023) 4745) festgestellt, dass die USA im Rahmen des DPF ein angemessenes Datenschutzniveau für zertifizierte Organisationen gewährleisten. Hierauf stützt sich die Rechtmäßigkeit der Übermittlung (Art. 45 DSGVO). Ergänzend gelten die Standardvertragsklauseln (Art. 46 Abs. 2 lit. c DSGVO).
                </p>
                <p>
                    <em>Hinweis:</em> Die österreichische Datenschutzbehörde hat mit Bescheid vom 22. April 2022 (DSB-D213.679/0006-DSB/2021) in einem Einzelfall festgestellt, dass der damalige Einsatz von Google Analytics Universal (GA3) gegen Art. 44 DSGVO verstieß. Der vorliegende Einsatz von GA4 unterscheidet sich davon insbesondere durch die verbesserten technischen Maßnahmen, das seit Juli 2023 bestehende Data Privacy Framework und das Erfordernis einer vorherigen Einwilligung. Eine <strong>Restunsicherheit</strong> kann gleichwohl nicht vollständig ausgeschlossen werden. Sie können die Nutzung von GA4 durch Ablehnung im Consent-Banner oder durch Installation eines Browser-Add-ons zur Deaktivierung von Google Analytics (abrufbar unter <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener noreferrer">tools.google.com/dlpage/gaoptout</a>) unterbinden.
                </p>
                <p>
                    <strong>Weitere Informationen</strong> zum Datenschutz bei Google: <a href="https://policies.google.com/privacy" target="_blank" rel="noopener noreferrer">policies.google.com/privacy</a> und <a href="https://business.safety.google/gdpr" target="_blank" rel="noopener noreferrer">business.safety.google/gdpr</a>.
                </p>

                <h2>7. Eingebettete Vimeo-Videos</h2>
                <p>
                    Zur Darstellung unserer Demo-Videos (z. B. in der Sektion „Formate") binden wir Videos des Dienstes <strong>Vimeo</strong> der <strong>Vimeo.com, Inc.</strong>, 555 West 18th Street, New York, NY 10011, USA ein.
                </p>
                <p>
                    Die Einbettung erfolgt im <strong>datenschutzfreundlichen Modus</strong> von Vimeo (Parameter <code>dnt=1</code> – „Do Not Track"). In diesem Modus verzichtet Vimeo nach eigenen Angaben auf das Setzen von Tracking-Cookies und das Verfolgen des Nutzerverhaltens für Analyse- und Werbezwecke. Beim Abspielen eines Videos werden jedoch in jedem Fall technische Verbindungsdaten (insbesondere IP-Adresse, Browser- und Geräteinformationen, Zeitpunkt des Aufrufs, aufgerufene URL) an Vimeo übertragen.
                </p>
                <p>
                    <strong>Rechtsgrundlage:</strong> Einwilligung gemäß Art. 6 Abs. 1 lit. a DSGVO i. V. m. § 165 Abs. 3 TKG 2021. Die Videos werden erst nach aktiver Zustimmung geladen (<strong>Zwei-Klick-Lösung</strong> oder Einwilligung über das Consent-Banner).
                </p>
                <p>
                    <strong>Datenübermittlung in die USA:</strong> Vimeo ist unter dem EU-US Data Privacy Framework selbstzertifiziert; zusätzlich sind EU-Standardvertragsklauseln vereinbart. Eine Restunsicherheit hinsichtlich des Zugriffs durch US-Behörden kann nicht ausgeschlossen werden.
                </p>
                <p>
                    Weitere Informationen: <a href="https://vimeo.com/privacy" target="_blank" rel="noopener noreferrer">vimeo.com/privacy</a>.
                </p>

                <h2>8. LinkedIn-Verlinkung</h2>
                <p>
                    Auf unserer Website finden Sie einen Link zum LinkedIn-Profil von Gerhard Popp. Es handelt sich um eine <strong>reine Verlinkung</strong>, nicht um ein Social-Plugin oder ein LinkedIn Insight-Tag. Eine Datenübertragung an LinkedIn findet erst statt, wenn Sie aktiv auf den Link klicken.
                </p>
                <p>
                    Mit dem Klick auf den Link verlassen Sie unsere Website und gelangen auf die Plattform LinkedIn, die von der <strong>LinkedIn Ireland Unlimited Company</strong>, Wilton Place, Dublin 2, Irland (für EWR-Nutzer), betrieben wird. Auf die dortige Datenverarbeitung haben wir keinen Einfluss. Informationen dazu finden Sie in der LinkedIn-Datenschutzerklärung: <a href="https://www.linkedin.com/legal/privacy-policy" target="_blank" rel="noopener noreferrer">linkedin.com/legal/privacy-policy</a>.
                </p>
                <p>
                    <strong>Rechtsgrundlage</strong> für die Darstellung des Links: Art. 6 Abs. 1 lit. f DSGVO (berechtigtes Interesse an der Selbstdarstellung und dem professionellen Netzwerkauftritt).
                </p>

                <h2>9. Schriftarten (Adobe Fonts)</h2>
                <p>
                    Zur einheitlichen typografischen Darstellung unserer Website verwenden wir den Webfont-Dienst <strong>Adobe Fonts</strong> (vormals Typekit) der <strong>Adobe Systems Software Ireland Limited</strong>, 4-6 Riverwalk, City West Business Campus, Saggart, Dublin 24, Irland (für EWR-Nutzer:innen; zusammen mit der Adobe Inc., 345 Park Avenue, San Jose, CA 95110-2704, USA, nachfolgend „Adobe").
                </p>
                <p>
                    <strong>Erhobene Daten:</strong> Beim Aufruf unserer Website lädt Ihr Browser die benötigten Schriftarten direkt von den Adobe-Servern (<code>use.typekit.net</code> und <code>p.typekit.net</code>). Dabei werden technische Verbindungsdaten an Adobe übertragen, insbesondere: IP-Adresse, Browsertyp und -version, verwendetes Betriebssystem, Referrer-URL und Zeitpunkt des Aufrufs.
                </p>
                <p>
                    <strong>Zweck:</strong> Sicherstellung einer einheitlichen und professionellen Darstellung der Website-Inhalte mit den gestalterisch passenden Schriftarten. Das Schriftbild ist Bestandteil der Gestaltungsidentität unserer Marke.
                </p>
                <p>
                    <strong>Rechtsgrundlage:</strong> <strong>Art. 6 Abs. 1 lit. f DSGVO</strong> (berechtigtes Interesse an einer visuell konsistenten und fachlich seriösen Außendarstellung). Ein gleichwertiges Ergebnis mit lokal gehosteten Schriftarten ist bei variablen Webfonts mit optischer Größenachse derzeit nicht vergleichbar umsetzbar.
                </p>
                <p>
                    <strong>Cookies:</strong> Adobe Fonts setzt nach eigenen Angaben <strong>keine Cookies</strong> für die reine Schriftauslieferung; gespeichert wird lediglich die Schriftdatei selbst im Browser-Cache. Eine profilbasierte Nachverfolgung findet nicht statt.
                </p>
                <p>
                    <strong>Datenübermittlung in die USA:</strong> Da Adobe ein US-Unternehmen mit weltweiten Infrastruktur ist, kann eine Verarbeitung in den USA nicht ausgeschlossen werden. Adobe Inc. ist unter dem <strong>EU-US Data Privacy Framework (DPF)</strong> selbstzertifiziert; die Europäische Kommission hat mit Angemessenheitsbeschluss vom 10. Juli 2023 (C(2023) 4745) festgestellt, dass die USA im Rahmen des DPF ein angemessenes Datenschutzniveau für zertifizierte Organisationen gewährleisten (Art. 45 DSGVO). Ergänzend gelten die <strong>EU-Standardvertragsklauseln</strong> (Art. 46 Abs. 2 lit. c DSGVO).
                </p>
                <p>
                    <strong>Auftragsverarbeitung:</strong> Mit Adobe besteht ein Vertrag zur Auftragsverarbeitung gemäß Art. 28 DSGVO.
                </p>
                <p>
                    <strong>Widerspruch:</strong> Sie können der Verarbeitung jederzeit gemäß Art. 21 DSGVO widersprechen. Im Browser lässt sich das Laden externer Schriftarten zusätzlich durch Inhaltsblocker oder Browser-Erweiterungen unterbinden; in diesem Fall wird die Website mit den systemeigenen Fallback-Schriftarten (Georgia, Arial) dargestellt.
                </p>
                <p>
                    Weitere Informationen zur Datenverarbeitung bei Adobe finden Sie in der <a href="https://www.adobe.com/de/privacy/policy.html" target="_blank" rel="noopener noreferrer">Adobe-Datenschutzerklärung</a> sowie unter <a href="https://www.adobe.com/de/privacy/policies/adobe-fonts.html" target="_blank" rel="noopener noreferrer">Adobe Fonts · Datenschutz</a>.
                </p>
                <p>
                    <em>Hintergrund: Das LG München I hat mit Urteil vom 20. Jänner 2022 (Az. 3 O 17493/20) die dynamische Einbindung von Google Fonts ohne Einwilligung als Datenschutzverstoß beurteilt. Adobe Fonts unterscheidet sich von diesem Szenario wesentlich: Adobe ist DPF-zertifiziert, Standardvertragsklauseln sind abgeschlossen, es wird kein Tracking-Cookie gesetzt, und die Einbindung dient einem eng umrissenen Gestaltungszweck. Eine Restunsicherheit in Bezug auf die Datenübermittlung in die USA kann dennoch nicht ausgeschlossen werden.</em>
                </p>

                <h2>10. Kooperationspartner und Content-Distribution</h2>
                <p>
                    Produzierte Inhalte werden – nach ausdrücklicher Freigabe durch den jeweiligen Auftraggeber – teilweise über redaktionelle Kooperationspartner (insbesondere Walter Senk / immobilien-redaktion.com und Bernd Affenzeller / Bau &amp; Immobilien Report / Report Verlag) sowie über den LinkedIn-Kanal von Gerhard Popp distribuiert. Eine Verarbeitung personenbezogener Daten von Website-Besucher:innen ist damit nicht verbunden.
                </p>
                <p>
                    Soweit Interview-Gäste oder andere Mitwirkende in den Videos erkennbar sind, werden die dafür erforderlichen datenschutzrechtlichen Einwilligungen (Art. 6 Abs. 1 lit. a DSGVO) bzw. Einwilligungen nach § 78 UrhG durch den jeweiligen Auftraggeber eingeholt.
                </p>

                <h2>11. Auftragsverarbeiter und Empfänger</h2>
                <p>
                    Zur Erbringung unserer Leistungen setzen wir sorgfältig ausgewählte Auftragsverarbeiter ein. Mit allen bestehen Verträge gemäß Art. 28 DSGVO:
                </p>
                <ul>
                    <li><strong>Webhosting:</strong> DigitalOcean, LLC, 101 Avenue of the Americas, 10th Floor, New York, NY 10013, USA — mit EU-Rechenzentrum,</li>
                    <li><strong>E-Mail-Dienst:</strong> Resend (Resend Inc., Delaware, USA) für den Versand transaktionaler E-Mails,</li>
                    <li><strong>Schriftarten:</strong> Adobe Systems Software Ireland Limited (Adobe Fonts / Typekit), Dublin, Irland,</li>
                    <li><strong>Dateiübertragung / Lieferung:</strong> WeTransfer B.V., Amsterdam, Niederlande; Vimeo.com, Inc., USA; ggf. eigene Cloud-Lösung <em>[Anbieter, Standort]</em>,</li>
                    <li><strong>Webanalyse:</strong> Google Ireland Limited (GA4),</li>
                    <li><strong>Buchhaltung/Steuerberatung:</strong> <em>[Kanzleiname, Adresse]</em>,</li>
                    <li><strong>Newsletter/CRM</strong> (sofern eingesetzt): <em>[Anbieter]</em>.</li>
                </ul>
                <p>
                    Eine Weitergabe an sonstige Dritte erfolgt nur, wenn dies gesetzlich vorgeschrieben, für die Vertragserfüllung erforderlich oder durch Ihre Einwilligung gedeckt ist.
                </p>

                <h2>12. Ihre Rechte als betroffene Person</h2>
                <p>Sie haben hinsichtlich der Sie betreffenden personenbezogenen Daten folgende Rechte:</p>
                <ul>
                    <li><strong>Auskunftsrecht</strong> (Art. 15 DSGVO),</li>
                    <li><strong>Recht auf Berichtigung</strong> unrichtiger Daten (Art. 16 DSGVO),</li>
                    <li><strong>Recht auf Löschung</strong> (Art. 17 DSGVO),</li>
                    <li><strong>Recht auf Einschränkung der Verarbeitung</strong> (Art. 18 DSGVO),</li>
                    <li><strong>Recht auf Datenübertragbarkeit</strong> (Art. 20 DSGVO),</li>
                    <li><strong>Widerspruchsrecht</strong> gegen die Verarbeitung auf Grundlage berechtigter Interessen (Art. 21 DSGVO),</li>
                    <li><strong>Recht auf Widerruf erteilter Einwilligungen</strong> mit Wirkung für die Zukunft (Art. 7 Abs. 3 DSGVO).</li>
                </ul>
                <p>
                    Zur Geltendmachung Ihrer Rechte genügt eine formlose Mitteilung an die in Abschnitt 1 genannten Kontaktdaten.
                </p>

                <h2>13. Beschwerderecht bei der Aufsichtsbehörde</h2>
                <p>
                    Sie haben unbeschadet anderweitiger Rechtsbehelfe das Recht auf <strong>Beschwerde</strong> bei einer Datenschutz-Aufsichtsbehörde, insbesondere bei der für Sie zuständigen österreichischen:
                </p>
                <p>
                    <strong>Österreichische Datenschutzbehörde (DSB)</strong><br>
                    Barichgasse 40–42, 1030 Wien<br>
                    Telefon: <a href="tel:+43152152-0">+43 1 52 152-0</a><br>
                    E-Mail: <a href="mailto:dsb@dsb.gv.at">dsb@dsb.gv.at</a><br>
                    Web: <a href="https://www.dsb.gv.at" target="_blank" rel="noopener noreferrer">www.dsb.gv.at</a>
                </p>

                <h2>14. Datensicherheit</h2>
                <p>
                    Wir treffen nach dem Stand der Technik angemessene technische und organisatorische Sicherheitsmaßnahmen gemäß Art. 32 DSGVO, um Ihre Daten vor unbefugtem Zugriff, Verlust, Missbrauch oder Manipulation zu schützen. Hierzu zählen insbesondere: SSL/TLS-Verschlüsselung aller über die Website übertragenen Daten (HTTPS), regelmäßige Sicherheitsupdates, restriktives Rollen- und Berechtigungsmanagement, physische Zugangsbeschränkungen, verschlüsselte Backups sowie verpflichtende Vertraulichkeitsvereinbarungen mit allen eingesetzten Dienstleistern.
                </p>

                <h2>15. Keine automatisierte Entscheidungsfindung</h2>
                <p>
                    Eine ausschließlich automatisierte Entscheidungsfindung oder ein Profiling im Sinne des Art. 22 DSGVO findet <strong>nicht</strong> statt.
                </p>

                <h2>16. Stand und Aktualität</h2>
                <p>
                    Diese Datenschutzerklärung wurde zuletzt am 19. April 2026 aktualisiert. Durch die Weiterentwicklung unserer Website oder geänderte gesetzliche bzw. behördliche Vorgaben kann eine Anpassung erforderlich werden.
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
