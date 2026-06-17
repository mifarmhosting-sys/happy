<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holiday Booking Request Received</title>
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
        .details-box {
            background-color: #f8fafc;
            border-left: 4px solid #00c8ff;
            padding: 20px;
            margin-bottom: 25px;
            border-radius: 0 8px 8px 0;
        }
        .details-box h2 {
            margin: 0 0 15px 0;
            font-size: 16px;
            color: #0b2240;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .detail-label {
            font-weight: bold;
            color: #475569;
            width: 40%;
        }
        .detail-value {
            color: #0f172a;
            width: 60%;
            text-align: right;
        }
        .addon-list {
            margin: 10px 0 0 0;
            padding-left: 20px;
            font-size: 14px;
        }
        .addon-list li {
            margin-bottom: 5px;
            color: #0f172a;
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
            <p>Dear <strong>{{ $booking->member->customer_name }}</strong>,</p>
            <p>Thank you for submitting your holiday booking request. We have received your booking details and our concierge team has already begun working on your reservation.</p>
            
            <div class="details-box">
                <h2>Booking Details Summary</h2>
                
                <div class="detail-row">
                    <span class="detail-label">Customer ID:</span>
                    <span class="detail-value">{{ $booking->member->customer_id }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Destination Type:</span>
                    <span class="detail-value">{{ $booking->destination_type }} Destination</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Locations:</span>
                    <span class="detail-value">{{ $booking->destination_details }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Start Date:</span>
                    <span class="detail-value">{{ $booking->journey_start_date->format('d M, Y') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">End Date:</span>
                    <span class="detail-value">{{ $booking->journey_end_date->format('d M, Y') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Journey Tenure:</span>
                    <span class="detail-value">{{ $booking->journey_tenure }}</span>
                </div>
                
                @if($booking->extra_member_name)
                <div class="detail-row">
                    <span class="detail-label">Extra Member:</span>
                    <span class="detail-value">{{ $booking->extra_member_name }} (Age: {{ $booking->extra_member_age }})</span>
                </div>
                @endif
            </div>

            @if($booking->opt_ticket || $booking->opt_pickup_drop || $booking->opt_sightseeing || $booking->opt_food)
            <div class="details-box" style="border-left-color: #8b5cf6;">
                <h2>Requested Optional Add-ons</h2>
                <ul class="addon-list">
                    @if($booking->opt_ticket)
                        <li><strong>Tickets:</strong> {{ $booking->opt_ticket }}</li>
                    @endif
                    @if($booking->opt_pickup_drop)
                        <li><strong>Pickup & Drop:</strong> {{ $booking->opt_pickup_drop }}</li>
                    @endif
                    @if($booking->opt_sightseeing)
                        <li><strong>Sightseeing:</strong> {{ $booking->opt_sightseeing }}</li>
                    @endif
                    @if($booking->opt_food)
                        <li><strong>Food & Dining:</strong> {{ $booking->opt_food }}</li>
                    @endif
                </ul>
            </div>
            @endif

            <p>Our dedicated booking team will contact you directly within the next <strong>24 Hours</strong> to coordinate the final arrangements and confirm your holiday schedule.</p>
            <p>If you have any urgent changes or questions in the meantime, please feel free to reply directly to this email.</p>
            <p>Warm regards,<br><strong>Happy Miles Concierge Team</strong></p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Happy Miles. All rights reserved.<br>
            Need immediate help? Contact us at <a href="mailto:support@premiumtravel.club">support@premiumtravel.club</a>
        </div>
    </div>
</body>
</html>
