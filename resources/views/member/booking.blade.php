@extends('layouts.app')

@section('title', 'Book Your Holiday | ' . $settings->site_name)

@section('styles')
<!-- Flatpickr CSS for premium date pickers -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">

<style>
    .booking-container {
        background: #0f172a;
        color: #e2e8f0;
        min-height: 90vh;
        padding: 60px 20px;
    }
    
    .booking-card {
        background: #1e293b;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.05);
        max-width: 800px;
        margin: 0 auto;
        overflow: hidden;
    }
    
    .booking-header {
        background: linear-gradient(135deg, #0b2240 0%, #1e1b4b 100%);
        padding: 25px 40px;
        display: flex;
        align-items: center;
        gap: 20px;
        border-bottom: 2px solid rgba(255, 255, 255, 0.05);
    }
    
    .booking-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #00c8ff;
    }
    
    .booking-user-summary h2 {
        color: #ffffff;
        font-size: 20px;
        margin: 0 0 4px 0;
        font-weight: 600;
    }
    
    .booking-user-summary span {
        color: #94a3b8;
        font-size: 13.5px;
    }
    
    .booking-body {
        padding: 40px;
    }
    
    .booking-section {
        margin-bottom: 35px;
        background: rgba(15, 23, 42, 0.3);
        padding: 25px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.02);
    }
    
    .section-title {
        font-size: 15px;
        font-weight: 600;
        color: #00c8ff;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .form-row:last-child {
        margin-bottom: 0;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
    }
    
    .form-label {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        color: #cbd5e1;
        margin-bottom: 8px;
        letter-spacing: 0.5px;
    }
    
    .form-control {
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 12px 16px;
        color: #ffffff;
        border-radius: 8px;
        font-size: 14.5px;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #00c8ff;
        box-shadow: 0 0 0 3px rgba(0, 200, 255, 0.15);
        background: rgba(15, 23, 42, 0.8);
    }

    .form-control[readonly] {
        background: rgba(15, 23, 42, 0.3);
        color: #94a3b8;
        border-color: rgba(255, 255, 255, 0.05);
        cursor: not-allowed;
    }
    
    /* Destination Radio styles */
    .radio-group {
        display: flex;
        gap: 20px;
        margin-bottom: 12px;
    }
    
    .radio-label {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        font-size: 14.5px;
        color: #f8fafc;
    }
    
    .radio-input {
        accent-color: #00c8ff;
        width: 18px;
        height: 18px;
    }
    
    /* Addon row styles */
    .addon-card {
        background: rgba(15, 23, 42, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.05);
        padding: 16px;
        border-radius: 10px;
        margin-bottom: 15px;
        transition: border-color 0.3s ease;
    }
    
    .addon-card:hover {
        border-color: rgba(0, 200, 255, 0.25);
    }
    
    .addon-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
    }
    
    .addon-info {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 15px;
        font-weight: 600;
    }
    
    .addon-checkbox {
        accent-color: #8b5cf6;
        width: 18px;
        height: 18px;
    }
    
    .addon-details-container {
        display: none;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .addon-details-container textarea {
        width: 100%;
        min-height: 80px;
        resize: vertical;
        box-sizing: border-box;
    }
    
    .btn-submit {
        display: block;
        width: 100%;
        max-width: 300px;
        margin: 20px auto 0 auto;
        padding: 16px;
        background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);
        border: none;
        color: #ffffff;
        font-size: 16px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-radius: 50px;
        cursor: pointer;
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.3);
        transition: all 0.3s ease;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.45);
        background: linear-gradient(135deg, #f87171 0%, #dc2626 100%);
    }

    .btn-submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    /* Floating glowing popup modal styling (Screen 4) */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(15, 23, 42, 0.85);
        backdrop-filter: blur(5px);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    
    .success-modal {
        background: rgba(11, 34, 64, 0.95);
        border: 2px solid transparent;
        background-image: linear-gradient(rgba(11, 34, 64, 0.95), rgba(11, 34, 64, 0.95)), linear-gradient(135deg, #00c8ff, #8b5cf6);
        background-origin: border-box;
        background-clip: padding-box, border-box;
        box-shadow: 0 0 30px 2px rgba(0, 200, 255, 0.6);
        width: 100%;
        max-width: 450px;
        border-radius: 16px;
        padding: 35px;
        text-align: center;
        color: #ffffff;
        animation: scaleUp 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    @keyframes scaleUp {
        from { transform: scale(0.9); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    
    .success-icon {
        font-size: 55px;
        color: #00c8ff;
        margin-bottom: 20px;
        filter: drop-shadow(0 0 10px rgba(0, 200, 255, 0.5));
    }
    
    .success-title {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 12px;
    }
    
    .success-text {
        font-size: 14.5px;
        color: #cbd5e1;
        line-height: 1.6;
        margin-bottom: 25px;
    }
    
    .btn-modal-ok {
        padding: 12px 36px;
        background: linear-gradient(135deg, #00c8ff 0%, #8b5cf6 100%);
        border: none;
        color: #ffffff;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        border-radius: 30px;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(0, 200, 255, 0.3);
        transition: all 0.3s ease;
    }
    
    .btn-modal-ok:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.55);
    }
</style>
@endsection

@section('content')
<div class="booking-container">
    <div class="booking-card">
        <!-- Header: Avatar & Summarized Info -->
        <div class="booking-header">
            <img src="{{ $member->profile_image_path ? asset($member->profile_image_path) : asset('images/profile.jpg') }}" alt="{{ $member->customer_name }}" class="booking-avatar">
            <div class="booking-user-summary">
                <h2>New Holiday Booking</h2>
                <span>Booking for: <strong>{{ $member->customer_name }}</strong> (ID: <code>{{ $member->customer_id }}</code>)</span>
            </div>
        </div>

        <div class="booking-body">
            
            <form id="bookingForm" action="{{ route('member.booking.submit') }}" method="POST">
                @csrf
                
                <!-- Section 1: Extra Member -->
                <div class="booking-section">
                    <div class="section-title"><i class="fa fa-user-plus"></i>Extra Member (Extra Charge)</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="extra_member_name" class="form-label">Extra Member Name</label>
                            <input type="text" name="extra_member_name" id="extra_member_name" class="form-control" placeholder="e.g. John Doe">
                        </div>
                        <div class="form-group">
                            <label for="extra_member_age" class="form-label">Extra Member Age</label>
                            <input type="number" name="extra_member_age" id="extra_member_age" class="form-control" placeholder="e.g. 25" min="0" max="120">
                        </div>
                    </div>
                </div>
                
                <!-- Section 2: Dates & calculated Tenure -->
                <div class="booking-section">
                    <div class="section-title"><i class="fa fa-calendar-alt"></i>Journey Dates & Tenure</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="journey_start_date" class="form-label">Journey Start Date</label>
                            <input type="text" name="journey_start_date" id="journey_start_date" class="form-control" placeholder="Select Start Date" required>
                        </div>
                        <div class="form-group">
                            <label for="journey_end_date" class="form-label">Journey End Date</label>
                            <input type="text" name="journey_end_date" id="journey_end_date" class="form-control" placeholder="Select End Date" required>
                        </div>
                    </div>
                    <div class="form-row" style="margin-top: 20px;">
                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label for="journey_tenure" class="form-label">Calculated Tenure</label>
                            <input type="text" id="journey_tenure" class="form-control" value="0 Days / 0 Nights" readonly>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Destination details -->
                <div class="booking-section">
                    <div class="section-title"><i class="fa fa-map-marked-alt"></i>Destination details</div>
                    
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label class="form-label">Destination Type</label>
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" name="destination_type" value="Single" class="radio-input" checked>
                                Single Destination
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="destination_type" value="Multi" class="radio-input">
                                Multi-Destination
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="destination_details" class="form-label">Destination Location(s)</label>
                        <textarea name="destination_details" id="destination_details" class="form-control" rows="3" placeholder="Enter target destinations (e.g. Kashmir or Spain, Tenerife)" required></textarea>
                    </div>
                </div>

                <!-- Section 4: Optional Add-ons -->
                <div class="booking-section">
                    <div class="section-title"><i class="fa fa-concierge-bell"></i>Optional Add-ons</div>
                    
                    <!-- Addon 1: Ticket -->
                    <div class="addon-card">
                        <div class="addon-header" onclick="toggleAddon('opt_ticket')">
                            <div class="addon-info">
                                <input type="checkbox" name="opt_ticket_chk" id="opt_ticket_chk" class="addon-checkbox" onclick="event.stopPropagation(); updateAddonVisibility('opt_ticket')">
                                <i class="fa fa-ticket-alt" style="color: #8b5cf6;"></i> Flight / Train Tickets
                            </div>
                            <i class="fa fa-chevron-down" id="opt_ticket_chevron" style="opacity: 0.5;"></i>
                        </div>
                        <div class="addon-details-container" id="opt_ticket_details_box">
                            <label for="opt_ticket_details" class="form-label">Ticket Details / Preferences</label>
                            <textarea name="opt_ticket_details" id="opt_ticket_details" class="form-control" placeholder="Specify dates, flight classes, or preferences..."></textarea>
                        </div>
                    </div>
                    
                    <!-- Addon 2: Pickup Drop -->
                    <div class="addon-card">
                        <div class="addon-header" onclick="toggleAddon('opt_pickup_drop')">
                            <div class="addon-info">
                                <input type="checkbox" name="opt_pickup_drop_chk" id="opt_pickup_drop_chk" class="addon-checkbox" onclick="event.stopPropagation(); updateAddonVisibility('opt_pickup_drop')">
                                <i class="fa fa-car" style="color: #8b5cf6;"></i> Pickup & Drop Transfers
                            </div>
                            <i class="fa fa-chevron-down" id="opt_pickup_drop_chevron" style="opacity: 0.5;"></i>
                        </div>
                        <div class="addon-details-container" id="opt_pickup_drop_details_box">
                            <label for="opt_pickup_drop_details" class="form-label">Pickup/Drop details</label>
                            <textarea name="opt_pickup_drop_details" id="opt_pickup_drop_details" class="form-control" placeholder="Enter flight timings, arrival stations, or pickup addresses..."></textarea>
                        </div>
                    </div>
                    
                    <!-- Addon 3: Sightseeing -->
                    <div class="addon-card">
                        <div class="addon-header" onclick="toggleAddon('opt_sightseeing')">
                            <div class="addon-info">
                                <input type="checkbox" name="opt_sightseeing_chk" id="opt_sightseeing_chk" class="addon-checkbox" onclick="event.stopPropagation(); updateAddonVisibility('opt_sightseeing')">
                                <i class="fa fa-binoculars" style="color: #8b5cf6;"></i> Sightseeing & Local Tours
                            </div>
                            <i class="fa fa-chevron-down" id="opt_sightseeing_chevron" style="opacity: 0.5;"></i>
                        </div>
                        <div class="addon-details-container" id="opt_sightseeing_details_box">
                            <label for="opt_sightseeing_details" class="form-label">Sightseeing Preferences</label>
                            <textarea name="opt_sightseeing_details" id="opt_sightseeing_details" class="form-control" placeholder="Detail any historical sights, national parks, or tours you want to include..."></textarea>
                        </div>
                    </div>
                    
                    <!-- Addon 4: Food -->
                    <div class="addon-card">
                        <div class="addon-header" onclick="toggleAddon('opt_food')">
                            <div class="addon-info">
                                <input type="checkbox" name="opt_food_chk" id="opt_food_chk" class="addon-checkbox" onclick="event.stopPropagation(); updateAddonVisibility('opt_food')">
                                <i class="fa fa-utensils" style="color: #8b5cf6;"></i> Food & Meal Plans
                            </div>
                            <i class="fa fa-chevron-down" id="opt_food_chevron" style="opacity: 0.5;"></i>
                        </div>
                        <div class="addon-details-container" id="opt_food_details_box">
                            <label for="opt_food_details" class="form-label">Meal/Dietary Requirements</label>
                            <textarea name="opt_food_details" id="opt_food_details" class="form-control" placeholder="Specify breakfast only, half-board, full-board, or dietary preferences (e.g. Vegetarian, Halal)..."></textarea>
                        </div>
                    </div>

                </div>

                <button type="submit" id="submitBtn" class="btn-submit">Submit Request</button>
            </form>

        </div>
    </div>
</div>

<!-- Screen 4: Success Popup Modal Overlay -->
<div class="modal-overlay" id="successModal">
    <div class="success-modal">
        <i class="fa fa-check-circle success-icon"></i>
        <div class="success-title">Request Submitted!</div>
        <div class="success-text" id="modalText">
            Your request has been submitted successfully. Our team will contact you within 24 Hours. Thank you for connecting with us.
        </div>
        <button class="btn-modal-ok" onclick="closeSuccessModal()">OK</button>
    </div>
</div>
@endsection

@section('scripts')
<!-- Flatpickr Script -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    let flatpickrStart, flatpickrEnd;

    document.addEventListener('DOMContentLoaded', function () {
        // Initialize datepickers with Flatpickr
        flatpickrStart = flatpickr("#journey_start_date", {
            minDate: "today",
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                flatpickrEnd.set("minDate", dateStr || "today");
                calculateTenure();
            }
        });

        flatpickrEnd = flatpickr("#journey_end_date", {
            minDate: "today",
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                calculateTenure();
            }
        });

        // AJAX Form Submission
        const form = document.getElementById('bookingForm');
        const submitBtn = document.getElementById('submitBtn');

        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                
                // Form validation checks
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                submitBtn.disabled = true;
                submitBtn.textContent = 'Submitting...';

                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Display success modal (Screen 4)
                        document.getElementById('modalText').innerText = data.message;
                        document.getElementById('successModal').style.display = 'flex';
                        // Store the redirect URL for when OK is clicked
                        document.getElementById('successModal').dataset.redirectUrl = data.redirect_url;
                    } else {
                        alert('Something went wrong. Please check your input fields.');
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Submit Request';
                    }
                })
                .catch(error => {
                    console.error('Error submitting form:', error);
                    alert('Submission error. Please try again.');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Submit Request';
                });
            });
        }
    });

    // Toggle expand/collapse optional add-ons card
    function toggleAddon(addonId) {
        const checkbox = document.getElementById(`${addonId}_chk`);
        checkbox.checked = !checkbox.checked;
        updateAddonVisibility(addonId);
    }

    function updateAddonVisibility(addonId) {
        const checkbox = document.getElementById(`${addonId}_chk`);
        const detailsBox = document.getElementById(`${addonId}_details_box`);
        const chevron = document.getElementById(`${addonId}_chevron`);

        if (checkbox.checked) {
            detailsBox.style.display = 'block';
            chevron.classList.replace('fa-chevron-down', 'fa-chevron-up');
        } else {
            detailsBox.style.display = 'none';
            chevron.classList.replace('fa-chevron-up', 'fa-chevron-down');
        }
    }

    // Auto-calculate tenure in days/nights
    function calculateTenure() {
        const startDateVal = document.getElementById('journey_start_date').value;
        const endDateVal = document.getElementById('journey_end_date').value;
        const tenureInput = document.getElementById('journey_tenure');

        if (startDateVal && endDateVal) {
            const start = new Date(startDateVal);
            const end = new Date(endDateVal);
            
            const diffTime = Math.abs(end - start);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            if (!isNaN(diffDays)) {
                const days = diffDays + 1;
                const nights = diffDays;
                tenureInput.value = `${days} Days / ${nights} ` + (nights === 1 ? 'Night' : 'Nights');
            } else {
                tenureInput.value = '0 Days / 0 Nights';
            }
        } else {
            tenureInput.value = '0 Days / 0 Nights';
        }
    }

    // Close success modal & redirect
    function closeSuccessModal() {
        const modal = document.getElementById('successModal');
        modal.style.display = 'none';
        
        const redirectUrl = modal.dataset.redirectUrl;
        if (redirectUrl) {
            window.location.href = redirectUrl;
        }
    }
</script>
@endsection
