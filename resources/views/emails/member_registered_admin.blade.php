<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Member Registration</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
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
            border: 1px solid #cbd5e1;
        }
        .header {
            background-color: #1e293b;
            color: #ffffff;
            text-align: center;
            padding: 25px 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
        }
        .content {
            padding: 30px 40px;
            line-height: 1.6;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .data-table td {
            padding: 10px 0;
            font-size: 14.5px;
            border-bottom: 1px solid #f1f5f9;
        }
        .data-table td.label {
            font-weight: bold;
            color: #64748b;
            width: 35%;
        }
        .data-table td.value {
            color: #0f172a;
            width: 65%;
        }
        .footer {
            background-color: #f8fafc;
            padding: 20px 40px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Member Registration Alert</h1>
        </div>
        <div class="content">
            <p style="font-size: 15px; margin-top: 0;">A new member has signed up on the Premium Travel Club portal. Here are the registration details:</p>
            
            <table class="data-table">
                <tr>
                    <td class="label">Customer Name:</td>
                    <td class="value"><strong>{{ $member->customer_name }}</strong></td>
                </tr>
                <tr>
                    <td class="label">Assigned Customer ID:</td>
                    <td class="value"><code>{{ $member->customer_id }}</code></td>
                </tr>
                <tr>
                    <td class="label">Email Address:</td>
                    <td class="value"><a href="mailto:{{ $member->email }}">{{ $member->email }}</a></td>
                </tr>
                <tr>
                    <td class="label">Mobile Number:</td>
                    <td class="value">{{ $member->mobile_1 }}</td>
                </tr>
                <tr>
                    <td class="label">Registration Date:</td>
                    <td class="value">{{ $member->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            </table>

            <p style="font-size: 14px; color: #475569; margin-top: 25px;">Please log into the admin panel to update their membership category, dates, and contract terms as necessary.</p>
        </div>
        <div class="footer">
            This is an automated notification from Premium Travel Club.
        </div>
    </div>
</body>
</html>
