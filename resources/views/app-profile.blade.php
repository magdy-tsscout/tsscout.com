
@extends('layouts.master')

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)
@section('meta_author', $page->meta_author)

@section('styles')
    <!-- Custom CSS for this view -->
     <link href="{{asset('css/app-profile.css')}}" rel="stylesheet">
@endsection

@section('content')

<!-- Contact Us Section -->
<div class="contact-us">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="profile-container">
                <div class="avatar-section">
                    <img src="{{asset('images/profile-avatar.png')}}" alt="Avatar" class="avatar-image">
                    <div class="info-section">
                        <div class="name-status">
                            <span class="name">John Doe</span>
                            <img src="{{asset('images/check.png')}}" alt="Verified" class="verified-icon">
                            <span class="status">Active</span>
                        </div>
                        <div class="details">
                            <span>Country: Egypt, </span>
                            <span>Joined: 2 June 2024</span>
                        </div>
                    </div>
                </div>


                <div class="contact-section">
                    <div class="contact-item">
                        <span class="contact-label">Email:</span>
                        <span class="contact-value">john.doe@example.com</span>
                    </div>
                    <div class="contact-item">
                        <span class="contact-label">Mobile:</span>
                        <span class="contact-value">+1 234 567 8901</span>
                    </div>
                </div>

            </div>

            <div class="col-lg-12">

                <div class="contact-form-box col-lg-12 ">




   <!-- tabs -->
<div class="tab-bar">
    <div class="tab active" data-target="#profile">Profile</div>
    <div class="tab" data-target="#account">Account</div>
    <div class="tab" data-target="#security">Security Settings</div>
    <div class="tab" data-target="#support">Support and Resources</div>
</div>


   <!-- end of tabs -->

                    <!-- Contact Form Start -->
                    <div class="contact-form col-lg-5 tab-content active"  id="profile" >
                        <form id="contactForm" action="#" method="POST" data-toggle="validator">
                            <div class="row">

<!-- Full Name -->
<div class="form-group col-md-12 mb-4 position-relative">
    <label>Full Name</label>
    <div class="input-group">
        <div class="icon-wrapper">
            <img src="{{asset('images/name.svg')}}" alt="Name Icon">
        </div>
        <input type="text" name="lname" class="form-control input-with-icon" id="lname" placeholder="Your Name" required>
    </div>
    <div class="help-block with-errors"></div>
</div>
<!-- Email -->
<div class="form-group col-md-12 mb-4 position-relative">
    <label>Email</label>
    <div class="input-group">
        <div class="icon-wrapper">
            <img src="{{asset('images/email.svg')}}" alt="Email Icon">
        </div>
        <input type="email" name="email" class="form-control input-with-icon" id="email" placeholder="Email@example.com" required>
    </div>
    <div class="help-block with-errors"></div>
</div>

<!-- Phone Number-->
<div class="form-group col-md-12 mb-4 position-relative">
    <label>Phone Number <span style="color: darkgrey">(optional)</span></label>
    <div class="input-group">
        <div class="icon-wrapper">
            <img src="{{asset('images/phone-call.png')}}" alt="Name Icon">
        </div>
        <input type="text" name="lname" class="form-control input-with-icon" id="lname" placeholder="+20"  >
    </div>
    <div class="help-block with-errors"></div>
</div>

<!-- Location-->
<div class="form-group col-md-12 mb-4 position-relative">
    <label>Location<span style="color: darkgrey">(optional)</span></label>
    <div class="input-group">
        <div class="icon-wrapper">
            <img src="{{asset('images/location.png')}}" alt="Name Icon">
        </div>
        <input type="text" name="lname" class="form-control input-with-icon" id="lname" placeholder="" >
    </div>
    <div class="help-block with-errors"></div>
</div>


                                <!-- Submit Button -->
                                <div class="col-md-12">
                                    <button type="submit" class="btn-default">Save Changes</button>
                                    <div id="msgSubmit" class="h3 text-left hidden"></div>
                                </div>
                            </div>


                        </form>



                    </div>
                    <!-- Contact Form End -->

                    <div class="row subscription tab-content col-lg-12" id="account">
                        <!-- Subscription and Usage Section -->
                        <div class="subscription-section">
                            <div class="title-row">
                                <h3>Subscription & Usage</h3>
                                <div class="toggle-btn">
                                    <button id="monthly-btn" class="toggle-btn-option active">Monthly</button>
                                    <button id="yearly-btn" class="toggle-btn-option">Yearly</button>
                                </div>
                            </div>

                            <div class="plans">
                                <div class="plan-option">
                                    <div class="left-side">
                                        <input type="radio" name="plan" id="basic-plan">
                                        <div>
                                            <span class="plan-title">Basic Plan</span>
                                            <span class="current-plan">More Features/Monthly</span> <!-- 'Current plan' note -->
                                        </div>
                                    </div>
                                    <div class="pricing-container">
                                        <span class="trial-info">1$ Trial/Monthly</span>
                                        <span class="price">$24.99</span>
                                    </div>
                                </div>


                                <div class="plan-option">
                                    <div class="left-side">
                                        <input type="radio" name="plan" id="basic-plan">
                                        <div>
                                            <span class="plan-title">Standard Plan</span>
                                            <span class="current-plan">More Features/Monthly</span> <!-- 'Current plan' note -->
                                        </div>
                                    </div>
                                    <div class="pricing-container">
                                        <span class="trial-info">1$ Trial/Monthly</span>
                                        <span class="price">$49.99</span>
                                    </div>
                                </div>

                                <div class="plan-option">
                                    <div class="left-side">
                                        <input type="radio" name="plan" id="basic-plan">
                                        <div>
                                            <span class="plan-title">Premium Plan</span>
                                            <span class="current-plan">More Features/Monthly</span> <!-- 'Current plan' note -->
                                        </div>
                                    </div>
                                    <div class="pricing-container">
                                        <span class="trial-info">1$ Trial/Monthly</span>
                                        <span class="price">$74.99</span>
                                    </div>
                                </div>


                                <div class="unsubscribe-container">
                                    <p>To unsubscribe from all plans</p>
                                    <button class="unsubscribe-button">Unsubscribe</button>
                                </div>

                            </div>
                        </div>

                        <!-- Payment Method Section -->
                        <div class="payment-method-section">
                            <div class="title-row">
                                <h3>Payment Method</h3>
                                <div class="toggle-btn">
                                    <button id="credit-btn" class="toggle-btn-option active">Credit Card</button>
                                    <button id="paypal-btn" class="toggle-btn-option">Paypal</button>
                                </div>
                            </div>

                            <div class="payment-options">
                                <div class="payment-option">
                                    <div class="left-side">
                                        <input type="radio" name="payment-method" id="visa-option" checked>
                                        <span class="payment-details"> **** 8793</span>
                                    </div>
                                    <img src="{{asset('images/visa.png')}}" style="width: 50px"/>
                                </div>

                                <div class="payment-option">
                                    <div class="left-side">
                                        <input type="radio" name="payment-method" id="visa-option">
                                        <span class="payment-details"> **** 7783</span>
                                    </div>
                                    <img src="{{asset('images/master-card.png')}}" style="width: 50px" />
                                </div>

                            </div>

                        </div>
                       <!-- "Add New Card" link -->
<div style="text-align: center">
    <a href="javascript:void(0);" id="add-card-link" style="color: #1E3F5B; text-align:center; font-size:15px">Add New Card</a>
</div>

<!-- Hidden Card Form Section -->
<div id="new-card-section" style="display: none; margin-top: 20px;">
    <div class="row">
        <!-- Card Number (Full Width) -->
        <div class="form-group col-md-12 mb-4 position-relative">
            <label>Card Number</label>
            <div class="input-group">
                <input type="number" name="cardnumber" class="form-control new-card-input" id="cardnumber" placeholder="" required>
            </div>
            <div class="help-block with-errors"></div>
        </div>

        <!-- Expire and CVC (Side by Side) -->
        <div class="form-group col-md-6 mb-4 position-relative">
            <label>Expire</label>
            <div class="input-group">
                <input type="text" name="expire" class="form-control new-card-input" id="expire" placeholder="MM/YY" required>
            </div>
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group col-md-6 mb-4 position-relative">
            <label>CVC</label>
            <div class="input-group">
                <input type="number" name="cvc" class="form-control new-card-input" id="cvc" placeholder="" required max="3" >
            </div>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group col-md-12 mb-4 position-relative">
            <label>Cardholder Name</label>
            <div class="input-group">
                <input type="text" name="cardholder" class="form-control new-card-input" id="cardholder" placeholder="" required>
            </div>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group col-md-12 mb-4 position-relative">
            <div class="new-card-button-container">
                <button type="button" class="new-card-delete-btn">Delete Card</button>
                <button type="submit" class="new-card-save-btn">Save Changes</button>
            </div>
        </div>


    </div>
</div>


                    </div>

                <!-- Security Settings -->

                <div class="contact-form col-lg-5 security-settings tab-content" id="security"  >
                    <form id="contactForm" action="#" method="POST" data-toggle="validator">
                        <div class="row">

<!-- Full Name -->
<div class="form-group col-md-12 mb-4 position-relative">
<label>New Password</label>
<div class="input-group">
    <div class="icon-wrapper">
        <img src="{{asset('images/Registration/password.svg')}}" alt="Name Icon">
    </div>
    <input type="text" name="lname" class="form-control input-with-icon" id="lname" placeholder="Password" required>
</div>
<div class="help-block with-errors"></div>
</div>

<div class="form-group col-md-12 mb-4 position-relative">
    <label>Confirm Password</label>
    <div class="input-group">
        <div class="icon-wrapper">
            <img src="{{asset('images/Registration/password.svg')}}" alt="Name Icon">
        </div>
        <input type="text" name="lname" class="form-control input-with-icon" id="lname" placeholder="Password" required>
    </div>
    <div class="help-block with-errors"></div>
    </div>


                            <!-- Submit Button -->
                            <div class="col-md-12">
                                <button type="submit" class="btn-default">Create Password</button>
                                <div id="msgSubmit" class="h3 text-left hidden"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end of security settings-->


                <!-- Support & Resources -->
                <div class="contact-form col-lg-6 support-resources tab-content" id="support"  >
                    <form id="contactForm" action="#" method="POST" data-toggle="validator">
                        <div class="row">
                <!-- Email -->
<div class="form-group col-md-12 mb-4 position-relative">
    <p style="font-size: 12px;
    font-weight: 700;">Please submit your message detailing your issue, and we will respond promptly</p>
    <label>Email</label>
    <div class="input-group">
        <div class="icon-wrapper">
            <img src="{{asset('images/email.svg')}}" alt="Email Icon">
        </div>
        <input type="email" name="email" class="form-control input-with-icon" id="email" placeholder="Email@example.com" required>
    </div>
    <div class="help-block with-errors"></div>
</div>


                                <!-- Message -->
                                <div class="form-group col-md-12 mb-4 position-relative">
                                    <label>Message</label>
                                    <div class="input-group">
                                        <div class="icon-wrapper">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="icon">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 18.364a1.5 1.5 0 11-2.121-2.121 1.5 1.5 0 012.121 2.121zM18.364 5.121a1.5 1.5 0 10-2.121-2.121 1.5 1.5 0 002.121 2.121zM12 15v.01M12 11a3 3 0 000 6M12 3a9 9 0 11-9 9M12 15v.01M12 3a9 9 0 00-9 9M15 12a3 3 0 00-6 0" />
                                            </svg>
                                        </div>
                                        <textarea name="msg" class="form-control pl-5" id="msg" rows="7" placeholder="Write your message here..." required></textarea>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <!-- Submit Button -->
                                <div class="col-md-12">
                                    <button type="submit" class="btn-default">Send a Message</button>
                                    <div id="msgSubmit" class="h3 text-left hidden"></div>
                                </div>
                                <div class="col-md-12 FAQ mt-4" >
                                    <img src="{{asset('images/question-mark.png')}}"  alt="FAQ Icon" style="width:38px" /> You will find all the answers by visiting the
                                    <a href="https://tsscout.com/faqs"> FAQ</a> or watch
                                    <a href="https://tsscout.com/tutorial"> Tutorials</a>
                                </div>
                        </div>
                    </form>
                </div>

                <!-- End of support & resources -->


                </div>
</div>
</div>
</div>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all tab elements
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');

        // Loop through all tabs and attach click event listener
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove the active class from all tabs
                tabs.forEach(t => t.classList.remove('active'));
                // Add active class to the clicked tab
                tab.classList.add('active');

                // Hide all tab contents
                tabContents.forEach(content => content.classList.remove('active'));

                // Show the corresponding tab content
                const target = document.querySelector(tab.getAttribute('data-target'));
                if (target) {
                    target.classList.add('active');
                }
            });
        });
    });
</script>


<script>
    // Toggle between Monthly and Yearly
const monthlyBtn = document.getElementById('monthly-btn');
const yearlyBtn = document.getElementById('yearly-btn');

monthlyBtn.addEventListener('click', function() {
    monthlyBtn.classList.add('active');
    yearlyBtn.classList.remove('active');
});

yearlyBtn.addEventListener('click', function() {
    yearlyBtn.classList.add('active');
    monthlyBtn.classList.remove('active');
});

// Toggle between Credit Card and Paypal
const creditBtn = document.getElementById('credit-btn');
const paypalBtn = document.getElementById('paypal-btn');

creditBtn.addEventListener('click', function() {
    creditBtn.classList.add('active');
    paypalBtn.classList.remove('active');
});

paypalBtn.addEventListener('click', function() {
    paypalBtn.classList.add('active');
    creditBtn.classList.remove('active');
});


</script>

<!-- Script to Toggle the Card Form Section -->
<script>
    document.getElementById('add-card-link').addEventListener('click', function(e) {
        e.preventDefault();  // Prevent the default link behavior
        var cardSection = document.getElementById('new-card-section');
        if (cardSection.style.display === 'none' || cardSection.style.display === '') {
            cardSection.style.display = 'block';  // Show the form
        } else {
            cardSection.style.display = 'none';   // Hide the form
        }
    });
</script>

    <!-- clients testimonials Section End -->
@endsection
