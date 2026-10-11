<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
    <style>
        @media only screen and (max-width: 640px) {
            .email-body {
                padding: 12px !important;
            }
            .email-container {
                border-radius: 10px !important;
            }
            .email-header,
            .email-content,
            .email-footer {
                padding-left: 16px !important;
                padding-right: 16px !important;
            }
            .email-title {
                font-size: 20px !important;
            }
            .email-intro {
                font-size: 13px !important;
            }
            .email-logo {
                width: 122px !important;
                height: auto !important;
            }
            .field-row,
            .field-label,
            .field-value {
                display: block !important;
                width: 100% !important;
                box-sizing: border-box !important;
            }
            .field-label {
                margin-bottom: 6px !important;
            }
            .message-box {
                margin-top: 12px !important;
                padding: 14px !important;
            }
        }
    </style>
</head>
<body class="email-body" style="margin:0;padding:24px;background-color:#f3f6ff;font-family:Arial,Helvetica,sans-serif;color:#1d3f5b;">
    <table class="email-container" role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="max-width:680px;margin:0 auto;background:#ffffff;border-radius:14px;overflow:hidden;border:1px solid #e3e9ff;">
        <tr>
            <td class="email-header" style="padding:24px 24px 18px;background:linear-gradient(135deg,#eef2ff,#f8ffeb);text-align:center;border-bottom:1px solid #e3e9ff;">
                <svg class="email-logo" id="logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="146.829" height="49" viewBox="0 0 146.829 49" role="img" aria-label="TSScout logo">
                    <defs>
                        <linearGradient id="linear-gradient" x1="0.194" y1="1.04" x2="0.808" y2="0.307" gradientUnits="objectBoundingBox">
                            <stop offset="0" stop-color="#3546d6"/>
                            <stop offset="1" stop-color="#c2f74f"/>
                        </linearGradient>
                    </defs>
                    <g id="Group_736" data-name="Group 736" transform="translate(0 16.684)">
                        <path id="Path_18681" data-name="Path 18681" d="M7.78,74.2c0,1.089.5,1.881,4.31,3.3,5.061,1.84,10.166,4.851,10.166,10.582a9.862,9.862,0,0,1-10.25,9.664c-5.145,0-8.91-2.216-12.006-7.07l4.977-3.849c1.424,2.091,4.184,4.226,7.029,4.1,1.84-.084,3.054-1.256,3.012-2.509-.042-1.382-2.509-3.137-6.066-4.477C4.268,82.15.879,79.557.879,74.2c0-4.1,3.556-8.7,9.58-8.7,3.347,0,7.029.209,11.336,5.186l-5.354,3.975a7.625,7.625,0,0,0-5.982-2.509c-1.424,0-2.677,1.047-2.677,2.049Z" transform="translate(0 -65.5)" fill="#1d3f5b"/>
                        <path id="Path_18682" data-name="Path 18682" d="M378.859,66.63h6.9V86.666c0,7.947-6.736,11.88-12.55,11.88s-12.592-3.933-12.592-11.88V66.63h6.9V85.455a5.444,5.444,0,0,0,5.689,5.773,5.526,5.526,0,0,0,5.647-5.773Z" transform="translate(-267.308 -66.334)" fill="#1d3f5b"/>
                        <path id="Path_18683" data-name="Path 18683" d="M482.973,98V73.449H474.44V66.63h24.053v6.819h-8.617V98Z" transform="translate(-351.664 -66.334)" fill="#1d3f5b"/>
                    </g>
                    <path id="Path_18684" data-name="Path 18684" d="M161.121,21.677c-5.032-4.978-15.01-7.6-23.441.311-.466.428-.924.894-1.374,1.392-.479-.443-.973-.876-1.481-1.294-3.171-2.621-6.835-4.662-11.04-4.939a16.089,16.089,0,0,0-11.935,4.169,15.862,15.862,0,0,0-1.3,22.019,15.539,15.539,0,0,0,9.978,5.476c6.4.9,11.556-1.454,15.653-6.181,8.968,7.965,18.461,8.392,25.291,1.309a16.061,16.061,0,0,0-.353-22.263Zm-3.983,18.076a10.049,10.049,0,0,1-9.669,3.049c-3.318-.78-5.315-3.269-7.568-5.585-2.447-2.515-4.755-2.549-7.188-.039-.937.964-1.837,1.968-2.8,2.906a9.959,9.959,0,0,1-14.447-.329,10.356,10.356,0,0,1-2.549-7.679,9.679,9.679,0,0,1,12.571-8.662c2.981,1.053,5.2,3.529,7.429,5.631,2.35,2.217,4.569,2.144,6.866-.109,3.449-3.386,6.66-6.917,12.034-5.8a10.122,10.122,0,0,1,5.317,16.614Zm-31-6.806A3.742,3.742,0,1,1,122.4,29.24,3.724,3.724,0,0,1,126.143,32.947Zm27.219,0a3.742,3.742,0,1,1-3.742-3.707A3.724,3.724,0,0,1,153.362,32.947ZM139.611,3.565a3.532,3.532,0,0,1-1.745,3.052V16.689l-.136.124c-.45.417-.905.879-1.345,1.366l-.29.321-.319-.293c-.481-.446-.976-.876-1.465-1.278l-.154-.127V6.616a3.535,3.535,0,0,1-1.743-3.052,3.6,3.6,0,0,1,7.2,0Z" transform="translate(-79.226 0)" fill="url(#linear-gradient)"/>
                </svg>
                <h2 class="email-title" style="margin:16px 0 6px;font-size:24px;line-height:1.3;color:#1d3f5b;">New Contact Form Submission</h2>
                <p class="email-intro" style="margin:0;font-size:14px;color:#4d6480;">You have received a new message from the website contact form.</p>
            </td>
        </tr>
        <tr>
            <td class="email-content" style="padding:24px;">
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="border-collapse:separate;border-spacing:0 10px;">
                    <tr class="field-row">
                        <td class="field-label" style="width:160px;padding:12px 14px;background:#f8faff;border:1px solid #e3e9ff;border-radius:10px;font-size:13px;font-weight:700;color:#33557a;">First Name</td>
                        <td class="field-value" style="padding:12px 14px;background:#ffffff;border:1px solid #e3e9ff;border-radius:10px;font-size:14px;color:#1d3f5b;">{{ $fname }}</td>
                    </tr>
                    <tr class="field-row">
                        <td class="field-label" style="width:160px;padding:12px 14px;background:#f8faff;border:1px solid #e3e9ff;border-radius:10px;font-size:13px;font-weight:700;color:#33557a;">Last Name</td>
                        <td class="field-value" style="padding:12px 14px;background:#ffffff;border:1px solid #e3e9ff;border-radius:10px;font-size:14px;color:#1d3f5b;">{{ $lname }}</td>
                    </tr>
                    <tr class="field-row">
                        <td class="field-label" style="width:160px;padding:12px 14px;background:#f8faff;border:1px solid #e3e9ff;border-radius:10px;font-size:13px;font-weight:700;color:#33557a;">Email</td>
                        <td class="field-value" style="padding:12px 14px;background:#ffffff;border:1px solid #e3e9ff;border-radius:10px;font-size:14px;color:#1d3f5b;">{{ $email }}</td>
                    </tr>
                </table>
                <div class="message-box" style="margin-top:16px;padding:16px;background:#f8faff;border:1px solid #e3e9ff;border-radius:12px;">
                    <p style="margin:0 0 8px;font-size:13px;font-weight:700;color:#33557a;">Message</p>
                    <p style="margin:0;font-size:14px;line-height:1.65;color:#1d3f5b;">{!! nl2br(e($msg)) !!}</p>
                </div>
            </td>
        </tr>
        <tr>
            <td class="email-footer" style="padding:16px 24px;background:#f8faff;border-top:1px solid #e3e9ff;text-align:center;">
                <p style="margin:0;font-size:12px;color:#6b7f98;">This email was generated automatically from the TSScout contact form.</p>
            </td>
        </tr>
    </table>
</body>
</html>
