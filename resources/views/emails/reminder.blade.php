<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title>Reminder</title>
</head>

<body style="margin:0;padding:0;background:#f4f6f8;font-family:Arial,Helvetica,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f8;padding:30px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:8px;padding:30px;">

                    <tr>
                        <td align="center" style="padding-bottom:20px;">
                            <h2 style="margin:0;color:#2d3748;">🔔 Reminder Notification</h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:10px 0;">
                            <strong style="color:#4a5568;">Title:</strong>
                            <p style="margin:5px 0 15px 0;font-size:16px;color:#1a202c;">
                                {{ $title }}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:10px 0;">
                            <strong style="color:#4a5568;">Description:</strong>
                            <p style="margin:5px 0 15px 0;font-size:15px;color:#2d3748;line-height:1.6;">
                                {{ $description }}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:10px 0;">
                            <strong style="color:#4a5568;">Remind At:</strong>
                            <p style="margin:5px 0 15px 0;font-size:15px;color:#2d3748;">
                                {{ \Carbon\Carbon::parse($remind_at)->format('d M Y h:i A') }}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-top:25px;border-top:1px solid #e2e8f0;text-align:center;">
                            <p style="font-size:13px;color:#718096;margin:0;">
                                This is an automated reminder from {{ config('app.name') }}
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>

</html>
