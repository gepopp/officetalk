@extends('officetalk::emails.layout')

@section('title', 'Ihre OfficeTalk-Anfrage – Zusammenfassung')

@section('preheader', 'Zusammenfassung Ihrer OfficeTalk-Anfrage. Gerhard Popp meldet sich innerhalb von zwei Arbeitstagen.')

@section('content')
    {{-- Hero · H1 + Intro --}}
    <tr>
        <td class="p-responsive" style="padding:24px 40px 8px 40px;">
            <p style="margin:0 0 12px 0; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:12px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#5A5A55;">
                Anfrage-Zusammenfassung
            </p>
            <h1 class="h1-responsive" style="margin:0 0 16px 0; font-family:Georgia, 'Times New Roman', serif; font-size:38px; line-height:44px; font-weight:500; color:#111111; letter-spacing:-0.01em;">
                Danke. Angekommen.
            </h1>
            <p style="margin:0 0 8px 0; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:17px; line-height:1.6; color:#111111;">
                Ihre Anfrage ist bestätigt und liegt Gerhard Popp vor. Er meldet sich innerhalb von zwei Arbeitstagen bei Ihnen – per Mail oder Telefonat, je nach Anlass.
            </p>
        </td>
    </tr>

    {{-- Zusammenfassung · tabellarische Auflistung der übermittelten Angaben --}}
    <tr>
        <td class="p-responsive" style="padding:24px 40px 8px 40px;">
            <p style="margin:0 0 16px 0; font-family:Georgia, 'Times New Roman', serif; font-size:20px; font-style:italic; color:#5A5A55;">
                Ihre Angaben
            </p>

            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-top:2px solid #111111;">
                <tr>
                    <td width="40%" valign="top" style="width:40%; padding:12px 16px 12px 0; border-bottom:1px solid #E4E2DB; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:11px; font-weight:700; letter-spacing:0.08em; text-transform:uppercase; color:#5A5A55;">
                        Unternehmen
                    </td>
                    <td valign="top" style="padding:12px 0; border-bottom:1px solid #E4E2DB; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:15px; line-height:1.5; color:#111111;">
                        {{ $contactRequest->company }}
                    </td>
                </tr>
                <tr>
                    <td width="40%" valign="top" style="width:40%; padding:12px 16px 12px 0; border-bottom:1px solid #E4E2DB; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:11px; font-weight:700; letter-spacing:0.08em; text-transform:uppercase; color:#5A5A55;">
                        Ansprechperson
                    </td>
                    <td valign="top" style="padding:12px 0; border-bottom:1px solid #E4E2DB; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:15px; line-height:1.5; color:#111111;">
                        {{ $contactRequest->contact_name }}
                    </td>
                </tr>
                <tr>
                    <td width="40%" valign="top" style="width:40%; padding:12px 16px 12px 0; border-bottom:1px solid #E4E2DB; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:11px; font-weight:700; letter-spacing:0.08em; text-transform:uppercase; color:#5A5A55;">
                        E-Mail
                    </td>
                    <td valign="top" style="padding:12px 0; border-bottom:1px solid #E4E2DB; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:15px; line-height:1.5; color:#111111;">
                        <a href="mailto:{{ $contactRequest->email }}" style="color:#111111; text-decoration:none;">{{ $contactRequest->email }}</a>
                    </td>
                </tr>
                <tr>
                    <td width="40%" valign="top" style="width:40%; padding:12px 16px 12px 0; border-bottom:1px solid #E4E2DB; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:11px; font-weight:700; letter-spacing:0.08em; text-transform:uppercase; color:#5A5A55;">
                        Branche
                    </td>
                    <td valign="top" style="padding:12px 0; border-bottom:1px solid #E4E2DB; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:15px; line-height:1.5; color:#111111;">
                        {{ $contactRequest->roleLabel() }}
                    </td>
                </tr>
                <tr>
                    <td width="40%" valign="top" style="width:40%; padding:12px 16px 12px 0; border-bottom:1px solid #E4E2DB; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:11px; font-weight:700; letter-spacing:0.08em; text-transform:uppercase; color:#5A5A55;">
                        Anlass
                    </td>
                    <td valign="top" style="padding:12px 0; border-bottom:1px solid #E4E2DB; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:15px; line-height:1.6; color:#111111; white-space:pre-wrap;">{{ $contactRequest->occasion }}</td>
                </tr>
                @if ($contactRequest->preferred_timing)
                    <tr>
                        <td width="40%" valign="top" style="width:40%; padding:12px 16px 12px 0; border-bottom:1px solid #E4E2DB; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:11px; font-weight:700; letter-spacing:0.08em; text-transform:uppercase; color:#5A5A55;">
                            Wunschtermin
                        </td>
                        <td valign="top" style="padding:12px 0; border-bottom:1px solid #E4E2DB; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:15px; line-height:1.5; color:#111111;">
                            {{ $contactRequest->preferred_timing }}
                        </td>
                    </tr>
                @endif
                <tr>
                    <td width="40%" valign="top" style="width:40%; padding:12px 16px 12px 0; border-bottom:2px solid #111111; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:11px; font-weight:700; letter-spacing:0.08em; text-transform:uppercase; color:#5A5A55;">
                        Eingegangen
                    </td>
                    <td valign="top" style="padding:12px 0; border-bottom:2px solid #111111; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:15px; line-height:1.5; color:#111111;">
                        {{ $contactRequest->created_at?->timezone('Europe/Vienna')->format('d.m.Y · H:i') }} Uhr
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    {{-- Nächster Schritt · separater Block, atmet --}}
    <tr>
        <td class="p-responsive" style="padding:32px 40px 40px 40px;">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#F2F0EA" style="background-color:#F2F0EA; border-left:3px solid #E3B505;">
                <tr>
                    <td style="padding:20px 24px;">
                        <p style="margin:0 0 8px 0; font-family:Georgia, 'Times New Roman', serif; font-size:18px; font-style:italic; color:#111111;">
                            Nächster Schritt
                        </p>
                        <p style="margin:0; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:14px; line-height:1.6; color:#111111;">
                            Gerhard Popp meldet sich zu Ihrem Anlass. Wenn das Thema Eilcharakter hat oder Sie Rückfragen haben, erreichen Sie ihn direkt unter <a href="mailto:gerhard@weloveinteraction.com" style="color:#9A7A04; text-decoration:underline;">gerhard@weloveinteraction.com</a>.
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection
