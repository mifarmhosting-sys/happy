<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Holiday Booking Request</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 650px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #cbd5e1;
        }
        .header {
            background-color: #dc2626; /* Warning/Action Red */
            color: #ffffff;
            text-align: center;
            padding: 25px 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .content {
            padding: 30px 40px;
            line-height: 1.6;
        }
        .section-title {
            font-size: 15px;
            color: #475569;
            text-transform: uppercase;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 5px;
            margin: 25px 0 15px 0;
            letter-spacing: 0.5px;
            font-weight: bold;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .data-table td {
            padding: 8px 0;
            font-size: 14px;
            vertical-align: top;
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
        .addon-details {
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            padding: 12px;
            border-radius: 6px;
            font-size: 13.5px;
            margin-top: 5px;
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
            <h1>New Holiday Booking Request</h1>
        </div>
        <div class="content">
            <p style="font-size: 15px; margin-top: 0;">A member has submitted a new holiday booking request. Review the details below to assign to a booking agent:</p>
            
            <!-- Section 1: Customer Profile Details -->
            <div class="section-title">Member Profile & Status</div>
            <table class="data-table">
                <tr>
                    <td class="label">Customer Name:</td>
                    <td class="value"><strong>{{ $booking->member->customer_name }}</strong> (Age: {{ $booking->member->age }})</td>
                </tr>
                <tr>
                    <td class="label">Customer ID:</td>
                    <td class="value"><code>{{ $booking->member->customer_id }}</code></td>
                </tr>
                <tr>
                    <td class="label">Email Address:</td>
                    <td class="value"><a href="mailto:{{ $booking->member->email }}">{{ $booking->member->email }}</a></td>
                </tr>
                <tr>
                    <td class="label">Phone Numbers:</td>
                    <td class="value">
                        1. {{ $booking->member->mobile_1 }} <br>
                        @if($booking->member->mobile_2)
                        2. {{ $booking->member->mobile_2 }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="label">Billing Address:</td>
                    <td class="value">{{ $booking->member->address }}</td>
                </tr>
                <tr>
                    <td class="label">Membership Info:</td>
                    <td class="value">
                        Category: <strong>{{ $booking->member->membership_category }}</strong> <br>
                        Issued: {{ $booking->member->membership_issue_date->format('Y-m-d') }} <br>
                        Expiry: {{ $booking->member->membership_expiry_date->format('Y-m-d') }}
                    </td>
                </tr>
                @if($booking->member->co_customer_name)
                <tr>
                    <td class="label">Co-Customer Name:</td>
                    <td class="value">{{ $booking->member->co_customer_name }} (Age: {{ $booking->member->co_customer_age }})</td>
                </tr>
                @endif
                @if($booking->member->kid_1_name || $booking->member->kid_2_name)
                <tr>
                    <td class="label">Children Details:</td>
                    <td class="value">
                        @if($booking->member->kid_1_name)
                        - {{ $booking->member->kid_1_name }} (Age: {{ $booking->member->kid_1_age }}) <br>
                        @endif
                        @if($booking->member->kid_2_name)
                        - {{ $booking->member->kid_2_name }} (Age: {{ $booking->member->kid_2_age }})
                        @endif
                    </td>
                </tr>
                @endif
            </table>

            <!-- Section 2: Holiday Booking Details -->
            <div class="section-title">Holiday Request Details</div>
            <table class="data-table">
                <tr>
                    <td class="label">Destination Type:</td>
                    <td class="value"><strong>{{ $booking->destination_type }}</strong></td>
                </tr>
                <tr>
                    <td class="label">Destination Details:</td>
                    <td class="value">{{ $booking->destination_details }}</td>
                </tr>
                <tr>
                    <td class="label">Journey Dates:</td>
                    <td class="value">
                        Start: {{ $booking->journey_start_date->format('Y-m-d') }} <br>
                        End: {{ $booking->journey_end_date->format('Y-m-d') }}
                    </td>
                </tr>
                <tr>
                    <td class="label">Tenure duration:</td>
                    <td class="value"><strong>{{ $booking->journey_tenure }}</strong></td>
                </tr>
                @if($booking->extra_member_name)
                <tr>
                    <td class="label">Extra Member (charged):</td>
                    <td class="value">{{ $booking->extra_member_name }} (Age: {{ $booking->extra_member_age }})</td>
                </tr>
                @endif
                <tr>
                    <td class="label">Submission Date:</td>
                    <td class="value">{{ $booking->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            </table>

            <!-- Section 3: Optional Add-ons -->
            <div class="section-title">Optional Services & Add-ons</div>
            <table class="data-table">
                <tr>
                    <td class="label">Tickets:</td>
                    <td class="value">
                        @if($booking->opt_ticket)
                            <div class="addon-details">Requested: {{ $booking->opt_ticket }}</div>
                        @else
                            <span style="color: #94a3b8;">Not requested</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="label">Pickup & Drop:</td>
                    <td class="value">
                        @if($booking->opt_pickup_drop)
                            <div class="addon-details">Requested: {{ $booking->opt_pickup_drop }}</div>
                        @else
                            <span style="color: #94a3b8;">Not requested</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="label">Sightseeing:</td>
                    <td class="value">
                        @if($booking->opt_sightseeing)
                            <div class="addon-details">Requested: {{ $booking->opt_sightseeing }}</div>
                        @else
                            <span style="color: #94a3b8;">Not requested</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="label">Food / Dining:</td>
                    <td class="value">
                        @if($booking->opt_food)
                            <div class="addon-details">Requested: {{ $booking->opt_food }}</div>
                        @else
                            <span style="color: #94a3b8;">Not requested</span>
                        @endif
                    </td>
                </tr>
            </table>

        </div>
        <div class="footer">
            This is an automated notification. Manage bookings in the admin panel.
        </div>
    </div>
</body>
</html>
