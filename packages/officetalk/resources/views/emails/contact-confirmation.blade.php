@extends('officetalk::emails.layout')

@section('title', 'Bitte bestätigen Sie Ihre OfficeTalk-Anfrage')

@section('preheader', 'Ein Klick genügt: Bestätigen Sie Ihre E-Mail-Adresse, damit wir Ihre Anfrage an die Redaktion weiterleiten.')

@section('content')
    {{-- Hero · H1 + Intro --}}
    <tr>
        <td class="p-responsive" style="padding:24px 40px 8px 40px;">
            <p style="margin:0 0 12px 0; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:12px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#5A5A55;">
                E-Mail-Bestätigung
            </p>
            <h1 class="h1-responsive" style="margin:0 0 16px 0; font-family:Georgia, 'Times New Roman', serif; font-size:38px; line-height:44px; font-weight:500; color:#111111; letter-spacing:-0.01em;">
                Fast geschafft.
            </h1>
            <p style="margin:0 0 20px 0; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:17px; line-height:1.6; color:#111111;">
                Danke für Ihre Anfrage, {{ $contactRequest->contact_name }}. Wir brauchen nur noch eine Bestätigung Ihrer E-Mail-Adresse, dann geht die Anfrage an Gerhard Popp.
            </p>
        </td>
    </tr>

    {{-- Bulletproof Button · VML für Outlook + HTML-Fallback für alle anderen --}}
    <tr>
        <td class="p-responsive" align="left" style="padding:8px 40px 8px 40px;">
            <table role="presentation" class="button-responsive" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td align="center" bgcolor="#E3B505" style="background-color:#E3B505; border-radius:2px;">
                        <!--[if mso]>
                        <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{{ $confirmUrl }}" style="height:52px;v-text-anchor:middle;width:320px;" arcsize="6%" strokecolor="#E3B505" fillcolor="#E3B505">
                            <w:anchorlock/>
                            <center style="color:#111111;font-family:Helvetica, Arial, sans-serif;font-size:16px;font-weight:600;">E-Mail-Adresse bestätigen</center>
                        </v:roundrect>
                        <![endif]-->
                        <!--[if !mso]><!-->
                        <a href="{{ $confirmUrl }}" target="_blank" style="display:inline-block; padding:18px 36px; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:16px; font-weight:600; color:#111111; text-decoration:none; border-radius:2px; mso-hide:all;">
                            E-Mail-Adresse bestätigen&nbsp;→
                        </a>
                        <!--<![endif]-->
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    {{-- Fallback-Link · für Clients die Buttons nicht anzeigen --}}
    <tr>
        <td class="p-responsive" style="padding:24px 40px 8px 40px;">
            <p style="margin:0 0 8px 0; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:13px; line-height:1.55; color:#5A5A55;">
                Falls der Button nicht funktioniert, kopieren Sie diesen Link in Ihren Browser:
            </p>
            <p style="margin:0; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:13px; line-height:1.55; word-break:break-all;">
                <a href="{{ $confirmUrl }}" style="color:#9A7A04; text-decoration:underline;">{{ $confirmUrl }}</a>
            </p>
        </td>
    </tr>

    {{-- Trennlinie --}}
    <tr>
        <td class="p-responsive" style="padding:24px 40px 0 40px;">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td bgcolor="#E4E2DB" height="1" style="height:1px; line-height:1px; font-size:1px; background-color:#E4E2DB;">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>

    {{-- Hinweis · kleiner Grund-Text unten --}}
    <tr>
        <td class="p-responsive" style="padding:24px 40px 40px 40px;">
            <p style="margin:0 0 12px 0; font-family:Georgia, 'Times New Roman', serif; font-size:14px; font-style:italic; color:#5A5A55;">
                Was passiert nach der Bestätigung?
            </p>
            <p style="margin:0; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:14px; line-height:1.6; color:#111111;">
                Sie erhalten eine Zusammenfassung Ihrer Anfrage. Gerhard Popp meldet sich innerhalb von zwei Arbeitstagen bei Ihnen – per Mail oder Telefonat, je nach Anlass.
            </p>
        </td>
    </tr>
@endsection
