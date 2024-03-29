<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Successful Enrollment to a Package in {{$investmentPlan->investment_title}}</title>
    <style>

        @media only screen and (max-width: 620px) {
            table[class=body] h1 {
                font-size: 28px !important;
                margin-bottom: 10px !important;
            }
            table[class=body] p,
            table[class=body] ul,
            table[class=body] ol,
            table[class=body] td,
            table[class=body] span,
            table[class=body] a {
                font-size: 16px !important;
            }
            table[class=body] .wrapper,
            table[class=body] .article {
                padding: 10px !important;
            }
            table[class=body] .content {
                padding: 0 !important;
            }
            table[class=body] .container {
                padding: 0 !important;
                width: 100% !important;
            }
            table[class=body] .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important;
            }
            table[class=body] .btn table {
                width: 100% !important;
            }
            table[class=body] .btn a {
                width: 100% !important;
            }
            table[class=body] .img-responsive {
                height: auto !important;
                max-width: 100% !important;
                width: auto !important;
            }
        }

        /* -------------------------------------
            PRESERVE THESE STYLES IN THE HEAD
        ------------------------------------- */
        @media all {
            .ExternalClass {
                width: 100%;
            }
            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%;
            }
            .apple-link a {
                color: inherit !important;
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                text-decoration: none !important;
            }
            #MessageViewBody a {
                color: inherit;
                text-decoration: none;
                font-size: inherit;
                font-family: inherit;
                font-weight: inherit;
                line-height: inherit;
            }
            .btn-primary table td:hover {
                background-color: #34495e !important;
            }
            .btn-primary a:hover {
                background-color: #34495e !important;
                border-color: #34495e !important;
            }
        }
    </style>
</head>
<body class="" style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
<!--<span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">This is preheader text. Some clients will show this text as a preview.</span>-->
<table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
    <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
        <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
            <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

                <!-- START CENTERED WHITE CONTAINER -->
                <table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">

                    <!-- START MAIN CONTENT AREA -->
                    <tr>
                        <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
                            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                                <tr>
                                    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">

                                        <div style="width: 160px; margin-left: auto; margin-right: auto;">
                                            <center><img src="{{$siteDetails->logo_url}}" style="width: 100%;"/></center>
                                        </div>
                                        <h3 style="font-family: sans-serif; font-size: 30px; font-weight: normal; margin: 0; margin-bottom: 15px; text-align: center; color:#800080;">{{ucwords($siteDetails->site_name)}}</h3>

                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                                        <h4 style="font-family: sans-serif; font-size: 18px; font-weight: normal; margin: 0; margin-bottom: 15px; text-align: center; color:#800080;">You have successfully enrolled for {{$investmentPlan->name_of_plan}} on {{ucwords($siteDetails->site_name)}}</h4>

                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi {{$userDetails->name}},</p>
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">You have successfully enrolled for {{$siteDetails->site_name.'`s'}} {{$investmentPlan->name_of_plan}}.</p>
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">The duration of this package {{round($investmentPlan->duration_for_referral_reward)}} days</p>
                                        <hr>
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">You are entitled to the following after {{$investmentPlan->no_of_days_before_reward_collection}} days of enrollment</p>

                                        @if(count($investmentPlan->rewardsDetails) > 0)
                                            @foreach($investmentPlan->rewardsDetails as $k => $eachRewardsDetails)
                                                @php
                                                    $reward = $eachRewardsDetails->reward;
                                                @endphp
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;"><span>{{$reward}}</span></p>
                                            @endforeach
                                        @endif

                                        <hr>
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">You will a get cash reward, the cash reward is dependent on the following: </p>

                                        @php $amountForReferralDetails = auth()->user()->getAmountForView($investmentPlan->amount_for_referral) @endphp
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;"><strong>({{$amountForReferralDetails['data']['currency']}}) {{number_format($amountForReferralDetails['data']['amount'])}} </strong><span>after {{round($investmentPlan->duration_for_referral_reward)}} days when you refer {{$investmentPlan->maximum_no_of_referral}} persons</span></p>

                                        <p style="font-family: sans-serif; text-align: center; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;"><strong>-- OR --</strong></p>

                                        @php $amountForNoReferralDetails = auth()->user()->getAmountForView($investmentPlan->amount_for_no_referral) @endphp
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;"><strong>({{$amountForNoReferralDetails['data']['currency']}}) {{number_format($amountForNoReferralDetails['data']['amount'])}} </strong><span>after {{round($investmentPlan->duration_for_referral_reward)}} days when you refer less than {{$investmentPlan->maximum_no_of_referral}} persons</span></p>

                                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                                            <tbody>
                                            <tr>
                                                <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
                                                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                                        <tbody>
                                                        <tr>
                                                            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;"> <a href="{{$siteDetails->site_url}}" target="_blank" style="display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">Visit {{$siteDetails->site_name.'`s'}} Website</a> </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <!--<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Please </p>-->
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Thanks & Regards,</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- END MAIN CONTENT AREA -->
                </table>

                <!-- START FOOTER -->
                <div class="footer" style="clear: both; Margin-top: 10px; background: #800080; text-align: center; width: 100%;">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                        <tr align="center">
                            <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                                <span style="text-align: center; width: 100%;"><span class="apple-link" style="color: #fff; font-size: 12px; text-align: center;">{{$siteDetails->address1}}</span><br>
                                <span class="apple-link" style="color: #fff; font-size: 12px; text-align: center;">{{$siteDetails->address2}}</span></span>
                                <!--<br> Don`t like these emails? <a href="http://i.imgur.com/CScmqnj.gif" style="text-decoration: underline; color: #fff; font-size: 12px; text-align: center;">Unsubscribe</a>.-->
                            </td>
                        </tr>
                        <tr align="center">
                            <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #fff; text-align: center;">
                                <span style="text-align: center; width: 100%;">Powered by <a href="{{$siteDetails->site_url}}" style="color: #fff; font-size: 12px; text-align: center; text-decoration: none;">{{$siteDetails->site_name}}</a>.</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- END FOOTER -->

                <!-- END CENTERED WHITE CONTAINER -->
            </div>
        </td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
    </tr>
</table>
</body>
</html>