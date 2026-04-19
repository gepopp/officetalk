<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
    <title>@yield('title', 'OfficeTalk')</title>
    {{-- Outlook-Rendering auf 96 DPI zwingen --}}
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
    <style type="text/css">
        /* Reset · auf bekanntermaßen problematische Clients zugeschnitten */
        body, table, td { margin: 0; padding: 0; }
        table { border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { border: 0; display: block; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
        a { text-decoration: none; }
        /* Gmail Mobile: link-Auto-Detection ausschalten */
        u + #body a { color: inherit; text-decoration: none; }
        /* Outlook: schlechte Zeilenabstände überschreiben */
        h1, h2, h3, p, td { mso-line-height-rule: exactly; }

        @media only screen and (max-width: 620px) {
            .container { width: 100% !important; max-width: 100% !important; }
            .p-responsive { padding-left: 24px !important; padding-right: 24px !important; }
            .h1-responsive { font-size: 30px !important; line-height: 36px !important; }
            .button-responsive { width: 100% !important; }
            .button-responsive a { display: block !important; padding: 16px 24px !important; }
        }
    </style>
</head>
<body id="body" style="margin:0; padding:0; background-color:#FAFAF7; -webkit-font-smoothing:antialiased;">
    {{-- Preheader · im Inbox-Preview sichtbar, im Email-Body versteckt --}}
    <div style="display:none; max-height:0; max-width:0; overflow:hidden; mso-hide:all; font-size:1px; line-height:1px; color:#FAFAF7;">
        @yield('preheader')&nbsp;&#847;&zwnj;&nbsp;&#847;&zwnj;&nbsp;&#847;&zwnj;&nbsp;&#847;&zwnj;&nbsp;&#847;&zwnj;&nbsp;&#847;&zwnj;&nbsp;&#847;&zwnj;&nbsp;&#847;&zwnj;&nbsp;&#847;&zwnj;&nbsp;&#847;&zwnj;&nbsp;&#847;&zwnj;&nbsp;&#847;&zwnj;
    </div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#FAFAF7" style="background-color:#FAFAF7;">
        <tr>
            <td align="center" style="padding:32px 12px;">
                <table role="presentation" class="container" width="600" cellpadding="0" cellspacing="0" border="0" bgcolor="#FFFFFF" style="max-width:600px; background-color:#FFFFFF; border-top:4px solid #E3B505;">

                    {{-- Header --}}
                    <tr>
                        <td class="p-responsive" align="left" style="padding:32px 40px 16px 40px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td valign="middle" bgcolor="#E3B505" width="42" height="30" style="width:42px; height:30px; background-color:#E3B505; border-radius:2px; font-size:0; line-height:0;">&nbsp;</td>
                                    <td width="12" style="width:12px;">&nbsp;</td>
                                    <td valign="middle" style="font-family:Georgia,'Times New Roman',serif; font-size:22px; font-weight:600; color:#111111; letter-spacing:-0.01em;">
                                        OfficeTalk
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Content · via @yield eingesetzt --}}
                    @yield('content')

                    {{-- Footer --}}
                    <tr>
                        <td class="p-responsive" style="padding:32px 40px; background-color:#F2F0EA; border-top:1px solid #E4E2DB;">
                            <p style="margin:0 0 12px 0; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:13px; line-height:1.55; color:#5A5A55;">
                                <strong style="color:#111111;">OfficeTalk</strong> · B2B-Videoproduktion in Wien<br>
                                Gerhard Popp · gerhard@weloveinteraction.com
                            </p>
                            <p style="margin:0; font-family:-apple-system, 'Helvetica Neue', Arial, sans-serif; font-size:12px; line-height:1.55; color:#5A5A55;">
                                Sie erhalten diese E-Mail, weil eine Kontaktaufnahme über officetalk.watch angefragt wurde.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
