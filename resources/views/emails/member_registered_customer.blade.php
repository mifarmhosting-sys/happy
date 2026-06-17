<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Activated</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f7f9;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        .header {
            background-color: #0b2240;
            color: #ffffff;
            text-align: center;
            padding: 30px 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            letter-spacing: 1px;
            font-weight: 500;
        }
        .content {
            padding: 30px 40px;
            line-height: 1.6;
        }
        .content p {
            margin: 0 0 20px 0;
            font-size: 15px;
            color: #555555;
        }
        .activation-box {
            background-color: #f0fdf4;
            border-left: 4px solid #16a34a;
            padding: 20px;
            margin: 25px 0;
            border-radius: 0 8px 8px 0;
            text-align: center;
        }
        .activation-text {
            font-size: 16px;
            font-weight: bold;
            color: #16a54a;
            margin-bottom: 15px;
        }
        .credentials-table {
            width: 100%;
            margin: 15px 0 0 0;
            border-collapse: collapse;
        }
        .credentials-table td {
            padding: 8px;
            font-size: 14.5px;
        }
        .credentials-table td.label {
            font-weight: bold;
            color: #475569;
            width: 40%;
            text-align: right;
            padding-right: 15px;
        }
        .credentials-table td.value {
            color: #0f172a;
            width: 60%;
            text-align: left;
            font-family: monospace;
            font-size: 16px;
        }
        .btn-login {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 35px;
            background: linear-gradient(135deg, #00c8ff 0%, #8b5cf6 100%);
            color: #ffffff !important;
            text-decoration: none;
            font-weight: bold;
            border-radius: 30px;
            box-shadow: 0 4px 15px rgba(0, 200, 255, 0.3);
            text-transform: uppercase;
            font-size: 13.5px;
            letter-spacing: 0.5px;
        }
        .footer {
            background-color: #f1f5f9;
            padding: 20px 40px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }
        .footer a {
            color: #00c8ff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Happy Miles</h1>
        </div>
        <div class="content">
            <p>Dear <strong>{{ $member->customer_name }}</strong>,</p>
            <p>Welcome to the Happy Miles family! We are excited to inform you that your membership registration is complete.</p>
            
            <div class="activation-box">
                <div class="activation-text">Your membership has been activated. You can now sign in and explore.</div>
                
                <p style="font-size: 14px; color: #475569; margin-bottom: 5px;">Use the following Customer ID to log in to your dashboard:</p>
                <table class="credentials-table">
                    <tr>
                        <td class="label">LOGIN ID / CUSTOMER ID:</td>
                        <td class="value"><strong><code>{{ $member->customer_id }}</code></strong></td>
                    </tr>
                </table>
                
                <a href="http://happymilesdreamhospitality.com/member/login" class="btn-login">Sign In Now</a>
            </div>

            <p>Through your member dashboard, you can review your membership status, update family profiles, and request priority holiday bookings across our 19+ premium seafront hotels and global destinations.</p>
            <p>If you have any questions or need immediate assistance, please reply to this email.</p>
            <p>Best regards,<br><strong>Happy Miles Registration Team</strong></p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Happy Miles. All rights reserved.<br>
            Need help? Contact us at <a href="mailto:support@premiumtravel.club">support@premiumtravel.club</a>
        </div>
    </div>
</body>
</html>
