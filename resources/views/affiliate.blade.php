@extends('layouts.master')

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)
@section('meta_author', $page->meta_author)

@section('styles')
    <!-- Custom CSS for this view -->
    <link href="{{asset('css/affiliate.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h1 class="title" style="margin-top:0px;">Unlock Unlimited Earning Potential <br> with SCOUT Affiliate Program.</h1>
        <h5 class="title" style="margin-top:20px ; font-size: 20px; color: #1E3F5B; font-weight: 400;">Join the SCOUT Affiliate Program and turn your network into a revenue stream! <br> Partner with us and start making money effortlessly!</h5>
        <br>

       
          <div class="con-left">
            <div class="left-column">
              <h2>Up to 20% Lifetime Recurring Commission!</h2>
              
              <br>
              <p style="color: #1E3F5B;">Become a part of our growth journey and unlock the potential of earning up to 20% lifetime recurring commission. By promoting our powerful analytics platform, you’ll not only generate consistent revenue but also empower online businesses to succeed.</p>

              <p style="color: #1E3F5B;">Let’s grow together and reach new heights of success!</p>
                 <br>
              <button class="btn-default" style="background: var(--primary-500) 0% 0% no-repeat padding-box;
              border: 1px solid var(--primary-500);
              background: #3545D6 0% 0% no-repeat padding-box;
              border: 1px solid #3545D6; border-radius: 8px; opacity: 1;">Earn NOW!</button>
            </div>
            <div class="right-column">
              <img src="{{asset('./images/Group 7747@2x.png')}}" alt="Example Image">
            </div>
          </div>
        
    
          <div class="custom-container">
            <div class="custom-title">
              <h1>How You Can Reap the <span style="color: #3545D6;">Rewards</span></h1>
            </div>
            <div class="custom-row">
              <div class="custom-column">
                <div class="custom-box">
                  <div class="image-wrapper">
                    <img src="{{asset('./images/hand2.jpg')}}" alt="Image 1">
                  </div>
                  <div class="custom-content">
                    <h4 style="padding-bottom: 10px;">Join as an Affiliate</h4>
                    <p style="color: #1E3F5B;">It’s free to get started. Access marketing materials, tools, and more!</p>
                  </div>
                </div>
              </div>
              <div class="custom-column">
                <div class="custom-box">
                  <div class="image-wrapper">
                    <img src="{{asset('./images/ro.jpg')}}" alt="Image 2">
                  </div>
                  <div class="custom-content">
                    <h4 style="padding-bottom: 10px;">Promote Scout</h4>
                    <p style="color: #1E3F5B;">Become a Scout affiliate and benefit from our high-converting offers and dedicated support</p>
                  </div>
                </div>
              </div>
              <div class="custom-column">
                <div class="custom-box">
                  <div class="image-wrapper">
                    <img src="{{asset('./images/money-hand.jpg')}}" alt="Image 3">
                  </div>
                  <div class="custom-content">
                    <h4 style="padding-bottom: 10px;">Earn NOW!</h4>
                    
                    <p style="color: #1E3F5B;">Earn right from the moment your traffic converts. Check out More.</p>
                    
                  </div>
                </div>
              </div>
              
            </div>
            <div class="button-container">
                <a href="https://app.tsscout.com/pricing">
                <button class="btn-default">Start For 1$</button>
                </a>
          </div>
         

          <section class="container my-5">
            <!-- Centered Title and Subtitle -->
            <div class="my-centered-title text-center mb-4">
                <h1 style="color: #1E3F5B; font-size: 52px; font-weight: bold;">Why <span style="color:#3545D6">SCOUT</span> Affiliate Program?</h1>
                <br>
                <h5 class="section-subtitle" style="font-size: 18px;">SCOUT offers high earning potential and a strong partnership for growth</h5>
            </div>
            
            <!-- First Row -->
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="icon">
                            <!-- SVG Icon 1 -->
                            <img src="{{asset('./images/coin$.jpg')}}" alt="">
                        </div>
                        <div>
                            <h3 class="section-title">User-Friendly Affiliate Dashboard</h3>
                            <p class="section-paragraph">Easily track your clicks, conversions, and commissions</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="icon">
                            <!-- SVG Icon 2 -->
                            <img src="{{asset('./images/coin$.jpg')}}" alt="">
                        </div>
                        <div>
                            <h3 class="section-title">Marketing Materials</h3>
                            <p class="section-paragraph">Access a variety of banners, ads, and content to promote effectively
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="icon">
                            <!-- SVG Icon 3 -->
                            <img src="{{asset('./images/coin$.jpg')}}" alt="">
                        </div>
                        <div>
                            <h3 class="section-title">Quick Payouts</h3>
                            <p class="section-paragraph">Receive your commissions promptly, with multiple payout options</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Second Row -->
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="icon">
                            <img src="{{asset('./images/coin$.jpg')}}" alt="">
                        </div>
                        <div>
                            <h3 class="section-title">Global Reach</h3>
                            <p class="section-paragraph">Promote SCOUT’s analytics platform to online entrepreneurs worldwide</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="icon">
                            <!-- SVG Icon 5 -->
                            <img src="{{asset('./images/coin$.jpg')}}" alt="">
                        </div>
                        <div>
                            <h3 class="section-title">Exclusive Promotions</h3>
                            <p class="section-paragraph">Access to special promotions and discounts to boost your referrals</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="icon">
                            <!-- SVG Icon 6 -->
                            <img src="{{asset('./images/coin$.jpg')}}" alt="">
                        </div>
                        <div>
                            <h3 class="section-title">Ongoing Earnings</h3>
                            <p class="section-paragraph">Enjoy consistent income with recurring payments for the lifetime of the customer</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="icon">
                            <!-- SVG Icon 6 -->
                            <img src="{{asset('./images/coin$.jpg')}}" alt="">
                        </div>
                        <div>
                            <h3 class="section-title"> Real-Time Tracking</h3>
                            <p class="section-paragraph">Monitor your performance and earnings with a comprehensive dashboard</p>
                        </div>
                    </div>
                </div>


            </div>
        
        </section>
        

</div>

</div>


        <div class="header" style="font-weight: bold !important; font-size: 52px !important;"> <span style="color:#3545D6">F</span>AQ </div>

       <div class="header2">in virtual space through communication platforms.</div>


<!-- FAQ section start -->

   <!-- FAQs Page Start -->
    <div class="faq-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1  col-md-12 offset-md-0">
                    <div class="faq-accordion" id="accordion">
                        <!-- FAQ Item start -->
                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.25s">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    What is the Difference Between Frontend and Backend Development?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <p>Frontend development focuses on creating the user interface and user experience of a software application, typically using languages such as HTML, CSS, and JavaScript. Backend development involves working on the server-side of the application, managing databases, and handling server logic using languages like Python, Java, PHP, or Node.js.</p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item End -->

                        <!-- FAQ Item Start -->
                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.5s">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    What are APIs and How are They Used in Software Development?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <p>APIs (Application Programming Interfaces) are sets of rules and protocols that allow different software applications to communicate with each other. They are used in software development to enable integration between different systems, access external services, and build modular and scalable applications.</p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item End -->

                        <!-- FAQ Item Start -->
                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.75s">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    How Can I Improve my Software Development Skills?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item End -->

                        <!-- FAQ Item Start -->
                        <div class="accordion-item wow fadeInUp" data-wow-delay="1s">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    What are the Ethical Considerations in AI Development for Software Companies?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <p>Ethical considerations in AI development for software companies include issues related to fairness, transparency, accountability, privacy, and bias. It's essential for companies to prioritize ethical AI practices AI systems.</p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item End -->

                        <!-- FAQ Item Start -->
                        <div class="accordion-item wow fadeInUp" data-wow-delay="1.25s">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    What Are the Different Engagement Models Offered by Software Companies?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <p>Software companies typically offer various engagement models to cater to the diverse needs of their clients. These models may include fixed-price projects, time and material (hourly) billing, dedicated development teams, staff augmentation, and hybrid models combining elements of different approaches</p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item End -->

                        <!-- FAQ Item Start -->
                        <div class="accordion-item wow fadeInUp" data-wow-delay="1.5s">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    What Are Some Emerging Trends and Technologies in the Software Industry?
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <p>Emerging trends and technologies in the software industry include cloud computing, artificial intelligence and machine learning, Internet of Things (IoT), blockchain, edge computing, low-code/no-code development platforms, containerization and microservices architecture, and cybersecurity advancements</p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQs Page Ends -->

    

   @endsection