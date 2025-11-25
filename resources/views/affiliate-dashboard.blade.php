<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affiliate Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>

@font-face {
    font-family: 'Montserrat-Arabic';
    src: url('{{asset('webfonts/Montserrat-Arabic Regular 400.otf')}}') format('opentype');
    font-weight: normal;
    font-style: normal;
}

@font-face {
    font-family: 'Montserrat-Arabic';
    src: url('{{asset('webfonts/Montserrat-Arabic Medium 500.otf')}}') format('opentype');
    font-weight: 500;
    font-style: normal;
}

@font-face {
    font-family: 'Montserrat-Arabic';
    src: url('{{asset('webfonts/Montserrat-Arabic SemiBold 600.otf')}}') format('opentype');
    font-weight: 600;
    font-style: normal;
}

@font-face {
    font-family: 'Montserrat-Arabic';
    src: url('{{asset('webfonts/Montserrat-Arabic Bold 700.otf')}}') format('opentype');
    font-weight: bold;
    font-style: normal;
}

 body {
    font-family: 'Montserrat-Arabic';
    background-color: #f7f9fc;
    color: #1e3f5b;
}

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        .affiliate-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        .affiliate-header div {
            margin: 10px 0;
        }
        .active-status {
            color: rgb(75, 212, 75);
            font-weight: bold;
        }
        .tabs {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            border-bottom: 2px solid #ddd;
        }
        .tabs div {
            padding: 10px 20px;
            cursor: pointer;
            color: #1e3f5b;
        }
        .tabs div.active {
            font-weight: bold;
            border-bottom: 2px solid #007bff;
        }
        .content {
            margin-top: 20px;
        }
        .cards {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .card {
            background: #FAFBFD;
            padding: 24px 0px;
            width: 23%;
            margin: 10px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            border-radius: 8%;
        }


        /* Responsive Design */
        @media (max-width: 1024px) {
            .cards {
                flex-direction: column;
                align-items: center;
            }
            .card {
                width: 90%;
                margin-bottom: 20px;
            }
        }
        @media (max-width: 768px) {
            .tabs {
                flex-direction: column;
                align-items: center;
            }
            .affiliate-header {
                flex-direction: column;
                text-align: center;
            }
            .affiliate-header img {
                margin-top: 10px;
            }
        }
        @media (max-width: 480px) {
            .container {
                width: 95%;
            }
            .card {
                padding: 20px;
            }
            .tabs div {
                padding: 10px;
                text-align: center;
                width: 100%;
            }
            .tabs div.active {
                border-bottom: none;
                border-right: 2px solid #007bff;
            }
        }

        .traffic-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-icon {
            font-size: 36px;
            margin-bottom: 15px;
            color: #007bff;
        }
        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .card-description {
            font-size: 14px;
            color: #555;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .traffic-cards {
                justify-content: center;
            }
            .card {
                width: 45%;
            }
        }
        @media (max-width: 768px) {
            .card {
                width: 90%;
            }
        }
        h3{
            font-size: medium;
        }

        .section-title{
            font-size: medium;
            font-weight: 500;
            padding-bottom: 10px;
            padding-top: 10px;
        }
        .hidden {
            display: none;
        }
    </style>
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KV3N43LJ');</script>
<!-- End Google Tag Manager -->
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KV3N43LJ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <div class="container">
        <div class="affiliate-header">
            <div>
                <div><strong>Affiliate Status:</strong> <span class="active-status">Active</span></div>
                <div><strong>Affiliate ID:</strong> 4326789272</div>
                <div><strong>Referral Link:</strong> <a href="https://tsscout.com/Registration?referrerid=52605" target="_blank">https://tsscout.com/Registration?referrerid=52605</a></div>
            </div>

        </div>

        <div class="tabs">
            <div class="tab active" onclick="showSection('earnings')">Earnings</div>
            <div class="tab" onclick="showSection('referrals-analytics')">Referrals Analytics</div>
            <div class="tab" onclick="showSection('marketing-materials')">Marketing Materials</div>
        </div>

        <div class="content earnings">
            <div class="section-title">Total earning</div>

            <div class="cards">
                <div class="card">
                    <h3>Cleared balance</h3>
                    <p>$0</p>
                </div>
                <div class="card">
                    <h3>Pending balance</h3>
                    <p>$0</p>
                </div>
                <div class="card">
                    <h3>Referred users</h3>
                    <p>0</p>
                </div>
                <div class="card">
                    <h3>Commission earning</h3>
                    <p>15%</p>
                </div>
            </div>

            <div class="section-title">Monthly commission insights</div>
            <div class="chart-container">
                <canvas id="commissionChart"></canvas>
            </div>
        </div>


        <div class="content referrals-analytics hidden">
            <div class="section-title">Referrals Analytics</div>

            <div class="cards">
                <div class="card">
                    <h3>Successful referrals</h3>
                    <p>100</p>
                </div>
                <div class="card">
                    <h3>Non-paying referrals</h3>
                    <p>20</p>
                </div>
                <div class="card">
                    <h3>Canceled referrals</h3>
                    <p>30</p>
                </div>
                <div class="card">
                    <h3>Total referrals</h3>
                    <p>50%</p>
                </div>
            </div>

        </div>

    <div class="content marketing-materials hidden">
        <div class="section-title">Organic Traffic</div>
        <div class="traffic-cards">
            <div class="card">
                <div class="card-icon"><i class="fab fa-youtube"></i></div>
                <div class="card-title">YouTube</div>
                <div class="card-description">You can create a video tutorial or training and upload your video to YouTube.</div>
            </div>
            <div class="card">
                <div class="card-icon"><i class="fab fa-facebook"></i></div>
                <div class="card-title">Facebook Group</div>
                <div class="card-description">You can create your own Facebook group and share information with your followers.</div>
            </div>
            <div class="card">
                <div class="card-icon"><i class="fas fa-comments"></i></div>
                <div class="card-title">Forums</div>
                <div class="card-description">You can write, post, or comment on questions sharing your affiliate link.</div>
            </div>
            <div class="card">
                <div class="card-icon"><i class="fab fa-instagram"></i></div>
                <div class="card-title">Instagram</div>
                <div class="card-description">You can share dropshippingscout info on your Instagram by sharing sales results or winning products.</div>
            </div>
            <div class="card">
                <div class="card-icon"><i class="fab fa-youtube"></i></div>
                <div class="card-title">YouTube</div>
                <div class="card-description">You can create a video tutorial or training and upload your video to YouTube.</div>
            </div>
            <div class="card">
                <div class="card-icon"><i class="fab fa-facebook"></i></div>
                <div class="card-title">Facebook Group</div>
                <div class="card-description">You can create your own Facebook group and share information with your followers.</div>
            </div>
            <div class="card">
                <div class="card-icon"><i class="fas fa-comments"></i></div>
                <div class="card-title">Forums</div>
                <div class="card-description">You can write, post, or comment on questions sharing your affiliate link.</div>
            </div>
            <div class="card">
                <div class="card-icon"><i class="fab fa-instagram"></i></div>
                <div class="card-title">Instagram</div>
                <div class="card-description">You can share dropshippingscout info on your Instagram by sharing sales results or winning products.</div>
            </div>
        </div>
    </div>
    </div>

    <!-- FontAwesome Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('commissionChart').getContext('2d');
        const commissionChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['02/Oct', '03/Oct', '04/Oct', '05/Oct', '06/Oct', '07/Oct', '08/Oct', '09/Oct', '10/Oct'],
                datasets: [{
                    label: 'Commission for last month',
                    data: [10, 50, 30, 60, 40, 50, 20, 10, 5],
                    borderColor: 'blue',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        display: true
                    },
                    y: {
                        display: true,
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
        function showSection(sectionClass) {
            // Hide all sections
            document.querySelectorAll('.content').forEach(section => {
                section.classList.add('hidden');
            });

            // Show the selected section
            document.querySelector(`.${sectionClass}`).classList.remove('hidden');

            // Remove 'active' class from all tabs
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });

            // Add 'active' class to the selected tab
            document.querySelector(`.tab[onclick="showSection('${sectionClass}')"]`).classList.add('active');
        }
    </script>
</body>
</html>
