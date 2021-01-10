<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailMessageBody extends Model
{
    use HasFactory;

    public STATIC $link_to_logo = 'https://lightgates.app/images/lightgates-logo.png';
    private STATIC function call__construct()
    {


    }

    public STATIC function welcomeMessage($name, $code, $site_address, $site_name){

        $mainSettings = MainSettings::where('id', 1)->first();

        $font = 'Century Gothic';
        return '<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Account Registration Success</title>
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
<!--<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi there,</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Sometimes you just want to send a simple HTML email with a simple design and clear call to action. This is it.</p>-->
<div style="width: 100px; margin-left: auto; margin-right: auto;">
<center><img src="'. \App\MailMessageBody::$link_to_logo.'" style="width: 100%;"></center>
</div>
<h3 style="font-family: sans-serif; font-size: 30px; font-weight: normal; margin: 0; margin-bottom: 15px; text-align: center; color:#800080;">Welcome To '.$site_name.'</h3>

</td>
</tr>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi '.$name.',</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Your School have been successfully registered on our platform</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Please click on the button below to Confirm your account:</p>
<table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
<tbody>
<tr>
<td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;"> <a href="'.route("confirmAccount", $code).'" target="_blank" style="display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">Confirm Account</a> </td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Once your email address is confirmed successfully, you can login and go through our initial system setup. Its Easy and simple.</p>
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
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
<tr>
<td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
<span class="apple-link" style="color: #fff; font-size: 12px; text-align: center;">'.$mainSettings->address_1.'</span><br>
<span class="apple-link" style="color: #fff; font-size: 12px; text-align: center;">'.$mainSettings->address_2.'</span>
<!--<br> Don`t like these emails? <a href="http://i.imgur.com/CScmqnj.gif" style="text-decoration: underline; color: #fff; font-size: 12px; text-align: center;">Unsubscribe</a>.-->
                            </td>
                        </tr>
                        <tr>
                            <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #fff; text-align: center;">
                                Powered by <a href="'.$site_address.'" style="color: #fff; font-size: 12px; text-align: center; text-decoration: none;">'.$site_name.'</a>.
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
</html>';

    }

    public STATIC function mailVerificationActivation($name, $login_url, $site_address, $site_name){
        $mainSettings = MainSettings::where('id', 1)->first();
        $font = 'Century Gothic';
        return '<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Email Verification Success</title>
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
<!--<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi there,</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Sometimes you just want to send a simple HTML email with a simple design and clear call to action. This is it.</p>-->
<div style="width: 100px; margin-left: auto; margin-right: auto;">
<center><img src="'.MailMessageBody::$link_to_logo.'" style="width: 100%;"></center>
</div>
<h3 style="font-family: sans-serif; font-size: 30px; font-weight: normal; margin: 0; margin-bottom: 15px; text-align: center; color:#800080;">'.$site_name.'</h3>

</td>
</tr>

<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<h4 style="font-family: sans-serif; font-size: 18px; font-weight: normal; margin: 0; margin-bottom: 15px; text-align: center; color:#800080;">Email Verification Success</h4>

</td>
</tr>

<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi '.$name.',</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">You have successfully connfirmed your email address, please proceed to system set up</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Click below to login and continue</p>
<table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
<tbody>
<tr>
<td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;"> <a href="'.$login_url.'" target="_blank" style="display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">Login</a> </td>
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
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
<tr>
<td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
<span class="apple-link" style="color: #fff; font-size: 12px; text-align: center;">'.$mainSettings->address_1.'</span><br>
<span class="apple-link" style="color: #fff; font-size: 12px; text-align: center;">'.$mainSettings->address_2.'</span>
<!--<br> Don`t like these emails? <a href="http://i.imgur.com/CScmqnj.gif" style="text-decoration: underline; color: #fff; font-size: 12px; text-align: center;">Unsubscribe</a>.-->
                            </td>
                        </tr>
                        <tr>
                            <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #fff; text-align: center;">
                                Powered by <a href="'.$site_address.'" style="color: #fff; font-size: 12px; text-align: center; text-decoration: none;">'.$site_name.'</a>.
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
</html>'
            ;

    }

    public STATIC function passwordResetSuccess($name, $schoolLogoUrl, $site_address, $site_name, $school_name, $subject){
        $mainSettings = MainSettings::where('id', 1)->first();
        $font = 'Century Gothic';

        $schoolLogoUrl = empty($schoolLogoUrl) ? '' : '<img src="'.$schoolLogoUrl.'" style="width:48%; margin-top: 30px; margin-left: 4%; display: inline-block;" />';

        return '<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Password Reset Success</title>
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
<center><img src="'.MailMessageBody::$link_to_logo.'" style="width: 100%;">'.$schoolLogoUrl.'</center>
</div>
<h3 style="font-family: sans-serif; font-size: 30px; font-weight: normal; margin: 0; margin-bottom: 15px; text-align: center; color:#800080;">'.$site_name.'</h3>

</td>
</tr>

<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<h4 style="font-family: sans-serif; font-size: 18px; font-weight: normal; margin: 0; margin-bottom: 15px; text-align: center; color:#800080;">Password Reset Success</h4>

</td>
</tr>

<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi '.$name.',</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">You have successfully completed our password reset process and your account`s password has been reset.</p>
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Please contact our support if you did not initaite this change</p>
                                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                                            <tbody>
                                            <tr>
                                                <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
                                                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                                        <tbody>
                                                        <tr>
                                                            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;"> <a href="'.$site_address.'" target="_blank" style="display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">Visit Website</a> </td>
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
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                        <tr>
                            <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                                <span class="apple-link" style="color: #fff; font-size: 12px; text-align: center;">'.$mainSettings->address_1.'</span><br>
                                <span class="apple-link" style="color: #fff; font-size: 12px; text-align: center;">'.$mainSettings->address_2.'</span>
                                <!--<br> Don`t like these emails? <a href="http://i.imgur.com/CScmqnj.gif" style="text-decoration: underline; color: #fff; font-size: 12px; text-align: center;">Unsubscribe</a>.-->
                            </td>
                        </tr>
                        <tr>
                            <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #fff; text-align: center;">
                                Powered by <a href="'.$site_address.'" style="color: #fff; font-size: 12px; text-align: center; text-decoration: none;">'.$site_name.'</a>.
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
</html>';

    }

    public STATIC function schoolApprovalSuccess($name, $site_address, $site_name){
        $mainSettings = MainSettings::where('id', 1)->first();
        $font = 'Century Gothic';
        return '<!doctype html>
        <html>
        <head>
            <meta name="viewport" content="width=device-width">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>Password Reset Success</title>
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
        
        <div style="width: 80px; margin-left: auto; margin-right: auto;">
        <center><img src="'.MailMessageBody::$link_to_logo.'" style="width: 100%;"></center>
        </div>
        <h3 style="font-family: sans-serif; font-size: 30px; font-weight: normal; margin: 0; margin-bottom: 15px; text-align: center; color:#800080;">'.$site_name.'</h3>
        
        </td>
        </tr>
        
        <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
        <h4 style="font-family: sans-serif; font-size: 18px; font-weight: normal; margin: 0; margin-bottom: 15px; text-align: center; color:#800080;">Successful Approval of '.$name.'</h4>
        
        </td>
        </tr>
        
        <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi '.$name.',</p>
        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Your School`s Account on our platform have been successfully approved and is ready for use</p>
                                                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Follow the link below to login</p>
                                                <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                                                    <tbody>
                                                    <tr>
                                                        <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
                                                            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                                                <tbody>
                                                                <tr>
                                                                    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;"> <a href="'.route("schoolLoginRoute").'" target="_blank" style="display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">Login</a> </td>
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
                            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                                <tr>
                                    <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                                        <span class="apple-link" style="color: #fff; font-size: 12px; text-align: center;">'.$mainSettings->address_1.'</span><br>
                                        <span class="apple-link" style="color: #fff; font-size: 12px; text-align: center;">'.$mainSettings->address_2.'</span>
                                        <!--<br> Don`t like these emails? <a href="http://i.imgur.com/CScmqnj.gif" style="text-decoration: underline; color: #fff; font-size: 12px; text-align: center;">Unsubscribe</a>.-->
        </td>
        </tr>
        <tr>
        <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #fff; text-align: center;">
        Powered by <a href="'.$site_address.'" style="color: #fff; font-size: 12px; text-align: center; text-decoration: none;">'.$site_name.'</a>.
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
        </html>';

    }

    //notification of the parents for the registered student
    public STATIC function studentsRegistrationSuccessMail($parents_name, $subject, $students_details = [], $app_store_link = [], $site_address, $site_name, $backend_base_url){
        $mainSettings = MainSettings::where('id', 1)->first();
        $font = 'Century Gothic';
        return '<!doctype html>
        <html>
        <head>
            <meta name="viewport" content="width=device-width">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>'.$subject.'</title>
            
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
        
        <div style="width: 80px; margin-left: auto; margin-right: auto;">
        <center><img src="'.MailMessageBody::$link_to_logo.'" style="width: 100%;"></center>
        </div>
        <h3 style="font-family: sans-serif; font-size: 30px; font-weight: normal; margin: 0; margin-bottom: 15px; text-align: center; color:#800080;">'.$site_name.'</h3>
        
        </td>
        </tr>
        
        <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
        <h4 style="font-family: sans-serif; font-size: 18px; font-weight: normal; margin: 0; margin-bottom: 15px; text-align: center; color:#800080;">'.$subject.'</h4>
        
        </td>
        </tr>
        
        <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi '.$parents_name.',</p>
        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Listed below are details of your ward by name: '.$students_details['fullname'].'</p>
        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Please visit our school`s portal '.$site_address.' and login in as student using the username & password below to view more </p>
                                               
        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
        <tbody>
        <tr><td><div style=" font-family: '.$font.'"><a style="color:white; text-decoration: none;" href="'.$app_store_link['play_store'].'"><img src="'.$backend_base_url.'/img/app_store.png" style="width:150px" /></a> | <a style="color:white; text-decoration: none;" href="'.$app_store_link['ios_store'].'"> <img src="'.$backend_base_url.'/img/google_play.png" style="width:150px" /> </a> </div></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td><p style=""><strong>Full Name: </strong> <span>'.$students_details['fullname'].'</span></p></td></tr>
        <tr><td><p style=""><strong>Username: </strong> <span>'.$students_details['student_username'].'</span></p></td></tr>
        <tr><td><p style=""><strong>Password: </strong> <span>'.$students_details['student_pasword'].'</span></p></td></tr>
        <!--<tr>
        <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
        <tbody>
        <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;"> <a href="'.route("schoolLoginRoute").'" target="_blank" style="display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">Login</a> </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>-->
        </tbody>
        </table>
        <!--<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Please </p>-->
        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Thanks and Welcome Onboard,</p>
        </td>
        </tr>
        </table>
        </td>
        </tr>
        
        <!-- END MAIN CONTENT AREA -->
        </table>
        
        <!-- START FOOTER -->
        <div class="footer" style="clear: both; Margin-top: 10px; background: #800080; text-align: center; width: 100%;">
        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
        <tr>
        <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
        <span class="apple-link" style="color: #fff; font-size: 12px; text-align: center;">'.$mainSettings->address_1.'</span><br>
        <span class="apple-link" style="color: #fff; font-size: 12px; text-align: center;">'.$mainSettings->address_2.'</span>
        <!--<br> Don`t like these emails? <a href="http://i.imgur.com/CScmqnj.gif" style="text-decoration: underline; color: #fff; font-size: 12px; text-align: center;">Unsubscribe</a>.-->
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #fff; text-align: center;">
                                        Powered by <a href="'.$site_address.'" style="color: #fff; font-size: 12px; text-align: center; text-decoration: none;">'.$site_name.'</a>.
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
        </html>';

    }

    //notification of the registered teacher
    public STATIC function teacherRegistrationSuccessMail($subject, $teacher_details = [], $app_store_link = [], $site_address, $site_name, $backend_base_url){
        $mainSettings = MainSettings::where('id', 1)->first();
        $font = 'Century Gothic';
        return '<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>'.$subject.'</title>
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

<div style="width: 80px; margin-left: auto; margin-right: auto;">
<center><img src="'.MailMessageBody::$link_to_logo.'" style="width: 100%;"></center>
</div>
<h3 style="font-family: sans-serif; font-size: 30px; font-weight: normal; margin: 0; margin-bottom: 15px; text-align: center; color:#800080;">'.$site_name.'</h3>

</td>
</tr>

<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<h4 style="font-family: sans-serif; font-size: 18px; font-weight: normal; margin: 0; margin-bottom: 15px; text-align: center; color:#800080;">'.$subject.'</h4>

</td>
</tr>

<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="font-family: '.$font.'">You are highly welcome to '.$site_name.'</p>
<p style="font-family: '.$font.'">Listed below are details are your details to our School Portal</p>
<p style=" font-family: '.$font.'">Please visit our school`s portal '.$site_address.' and login in as a Teacher using the username & password below to view more </p>

                                <p style="font-family: '.$font.'">You can also download the App from Google Playstore or Apple App store by visiting any of the link below: </p>

                                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                                            <tbody>

                                            <tr><td><div style=" font-family: '.$font.'"><a style="color:white; text-decoration: none;" href="'.$app_store_link['play_store'].'"><img src="'.$backend_base_url.'/img/app_store.png" style="width:150px" /></a> | <a style="color:white; text-decoration: none;" href="'.$app_store_link['ios_store'].'"> <img src="'.$backend_base_url.'/img/google_play.png" style="width:150px" /> </a> </div></td></tr>

                                            <tr><td>&nbsp;</td></tr>
                                            <tr><td><p style=""><strong>Full Name: </strong> <span>'.$teacher_details['fullname'].'</span></p></td></tr>
                                            <tr><td><p style=""><strong>Username: </strong> <span>'.$teacher_details['username'].'</span></p></td></tr>
                                            <tr><td><p style=""><strong>Password: </strong> <span>'.$teacher_details['password'].'</span></p></td></tr>
                                            <tr><td>&nbsp;</td></tr>
                                            <!--<tr>
                                                <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
                                                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                                        <tbody>
                                                        <tr>
                                                            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;"> <a href="'.route("schoolLoginRoute").'" target="_blank" style="display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">Login</a> </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>-->
                                            </tbody>
                                        </table>
                                        <!--<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Please </p>-->
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Thanks and Welcome Onboard,</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- END MAIN CONTENT AREA -->
                </table>

                <!-- START FOOTER -->
                <div class="footer" style="clear: both; Margin-top: 10px; background: #800080; text-align: center; width: 100%;">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                        <tr>
                            <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                                <span class="apple-link" style="color: #fff; font-size: 12px; text-align: center;">'.$mainSettings->address_1.'</span><br>
                                <span class="apple-link" style="color: #fff; font-size: 12px; text-align: center;">'.$mainSettings->address_2.'</span>
                                <!--<br> Don`t like these emails? <a href="http://i.imgur.com/CScmqnj.gif" style="text-decoration: underline; color: #fff; font-size: 12px; text-align: center;">Unsubscribe</a>.-->
</td>
</tr>
<tr>
<td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #fff; text-align: center;">
Powered by <a href="'.$site_address.'" style="color: #fff; font-size: 12px; text-align: center; text-decoration: none;">'.$site_name.'</a>.
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
</html>';

    }

    //forgetPasswordMessage
    public STATIC function forgetPasswordMessage($name, $token, $site_address, $site_name){
        $mainSettings = MainSettings::where('id', 1)->first();
        $font = 'Century Gothic';
        return '<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Password Reset</title>
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

<div style="width: 80px; margin-left: auto; margin-right: auto;">
<center><img src="'.MailMessageBody::$link_to_logo.'" style="width: 100%;"></center>
</div>
<h3 style="font-family: sans-serif; font-size: 30px; font-weight: normal; margin: 0; margin-bottom: 15px; text-align: center; color:#800080;">'.$site_name.'</h3>

</td>
</tr>

<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<h4 style="font-family: sans-serif; font-size: 18px; font-weight: normal; margin: 0; margin-bottom: 15px; text-align: center; color:#800080;">Password Reset Request</h4>

</td>
</tr>

<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
<p style="">A request for password request was initiated from your account with us, Please provide the code below on our platform to continue</p>
<p style="">Please ignore this if you were not the one that initiated the request</p>
<p style=""><strong>Pasword Reset Token</strong> <span>'.$token.'</span></p>

<table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
<tbody>

<!--<tr>
<td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
<tbody>
<tr>
<td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;"> <a href="'.route("schoolLoginRoute").'" target="_blank" style="display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">Login</a> </td>
</tr>
</tbody>
</table>
</td>
</tr>-->
</tbody>
</table>
<!--<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Please </p>-->
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Thanks & Regards</p>
</td>
</tr>
</table>
</td>
</tr>

<!-- END MAIN CONTENT AREA -->
</table>

<!-- START FOOTER -->
<div class="footer" style="clear: both; Margin-top: 10px; background: #800080; text-align: center; width: 100%;">
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
<tr>
<td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
<span class="apple-link" style="color: #fff; font-size: 12px; text-align: center;">'.$mainSettings->address_1.'</span><br>
<span class="apple-link" style="color: #fff; font-size: 12px; text-align: center;">'.$mainSettings->address_2.'</span>
<!--<br> Don`t like these emails? <a href="http://i.imgur.com/CScmqnj.gif" style="text-decoration: underline; color: #fff; font-size: 12px; text-align: center;">Unsubscribe</a>.-->
                            </td>
                        </tr>
                        <tr>
                            <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #fff; text-align: center;">
                                Powered by <a href="'.$site_address.'" style="color: #fff; font-size: 12px; text-align: center; text-decoration: none;">'.$site_name.'</a>.
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
</html>';

    }


    public STATIC function registerTeacherAcknowledgementMail($name, $code, $site_address, $site_name){
        $mainSettings = MainSettings::where('id', 1)->first();
        $font = 'Century Gothic';
        return '
            <html>
                <head>
                    <title>Registration Email</title>
                </head>
                <body style="margin: 0px;">
                <table style="padding: 0px; max-width:700px; min-width:450px;" align="center">
                    <tr>
                        <td>
                            <div style="height: 200px; background-color: #2c003e;">
                                <center><div style="width:100px; "><img src="'.MailMessageBody::$link_to_logo.'" style="width:100%; margin-top: 30px;"></div></center>
                                <h1 style=" color:white; text-align: center; text-transform:uppercase; font-family:'.$font.'">Welcome To '.$site_name.'</h1>
                            </div>
                            <div>
                                <p style="padding-left: 10px; font-family: '.$font.'">Dear '.$name.'</p>
                            </div>
                        </td>
                    </tr>
                    <tr><td><p style="padding-left: 10px; font-family: '.$font.'">Your School have been successfully registered on our platform</p></td></tr>
                    <tr><td><p style="padding-left: 10px; font-family: '.$font.'">Please click on below link to activate your account:</p></td></tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr><td><p style="padding-left: 10px;"><a style="padding:10px 10px; font-family: '.$font.'; background-color: #ffa372; color:#2c003e; text-decoration: none;" href="'.route("confirmAccount", $code).'">Confirm Account</a></p></td></tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td>
                            <div style="height: 150px; background-color: #2c003e;">
                                <p style="line-height: 150px; font-family: '.$font.'; color:white; text-align: center;" ><span>Thanks & Regards,</span>&nbsp;&nbsp;<span><a style="color:white; text-decoration: none;" href="'.$site_address.'">'.$site_name.'</a></span></p>
                            </div>
                        </td>
                    </tr>
                    <tr><td></td></tr>
                    <tr><td></td></tr>
                </table>
                </body>
                </html>
        ';

    }

    //forgetPasswordMessage2
    public STATIC function forgetPasswordMessage2($name, $token, $email){
        $mainSettings = MainSettings::where('id', 1)->first();
        $font = 'Century Gothic';
        return '
            <html>
                <head>
                    <title>Password Reset</title>
                </head>
                <body style="margin: 0px;">
                <table style="padding: 0px; max-width:700px; min-width:450px;" align="center">
                    <tr>
                        <td>
                            <div style="height: 200px; background-color: #2c003e;">
                                <center><div style="width:100px; "><img src="'.MailMessageBody::$link_to_logo.'" style="width:100%; margin-top: 30px;"></div></center>
                                <h1 style=" color:white; text-align: center; font-family:'.$font.'">Password Reset</h1>
                            </div>
                            <div>
                                <p style="padding-left: 10px; font-family: '.$font.'">Dear '.$name.'</p>
                            </div>
                        </td>
                    </tr>
                    
                    <tr><td><p style="padding-left: 10px; font-family: '.$font.'">Please click on the link below to reset your password</p></td></tr>
                    <tr><td>&nbsp;</td></tr>

                    <tr><td><a style="padding-left: 10px; font-family: '.$font.'; background-color: #ffa372; color:#2c003e;" href="'.url("reset_password/".$token."/".$email).'">Reset Password Link</a></td></tr>
                    <tr><td>&nbsp;</td></tr>

                    <tr>
                        <td>
                            <div style="height: 150px; background-color: #2c003e;">
                                <p style="line-height: 150px; font-family: '.$font.'; color:white; text-align: center;" ><span>Thanks & Regards,</span>&nbsp;&nbsp;<span></span></p>
                            </div>
                        </td>
                    </tr>

                    <tr><td></td></tr>
                    <tr><td></td></tr>
                </table>
                </body>
                </html>
        ';

    }

    STATIC function contactUsMail($subject, $name, $email, $message, $site_address, $site_name){
        $mainSettings = MainSettings::where('id', 1)->first();
        $font = 'Century Gothic';
        return '<html><head>
                    <title>Password Reset</title>
                </head>
                <body style="margin: 0px;">
                <table style="padding: 0px; max-width:700px; min-width:450px;" align="center">
                    <tr>
                        <td>
                            <div style="height: 200px; background-color: #2c003e;">
                                <center><div style="width:100px; "><img src="'.MailMessageBody::$link_to_logo.'" style="width:100%; margin-top: 30px;"></div></center>
                                <h1 style=" color:white; text-align: center; font-family:'.$font.'">'.$subject.'</h1>
                            </div>
                            <div>
                                <p style="padding-left: 10px; font-family: '.$font.'"><strong>From </strong> <span>'.$name.'</span></p>
                            </div>
                        </td>
                    </tr>
                
                    <tr><td><p style="padding-left: 10px; font-family: '.$font.'">'.$message.'</p></td></tr>
                    <tr><td>&nbsp;</td></tr>
                
                    <tr><td><p style="padding-left: 10px; font-family: '.$font.'"><strong>Sender`s Email Address </strong><span>'.$email.'</span></p></td></tr>
                    <tr><td>&nbsp;</td></tr>
                
                    <tr>
                        <td>
                            <div style="height: 80px; background-color: #2c003e;">
                                <p style="line-height: 80px; font-family: '.$font.'; color:white; text-align: center;" ><span>Thanks & Regards,</span>&nbsp;&nbsp;<span></span></p>
                            </div>
                        </td>
                    </tr>
                
                    <tr><td></td></tr>
                    <tr><td></td></tr>
                </table>
                </body>
                </html>';

    }

    STATIC function autoReply($subject, $name){
        $mainSettings = MainSettings::where('id', 1)->first();
        $font = 'Century Gothic';
        return '<html>
            <head>
                <title>Regards</title>
            </head>
            <body style="margin: 0px;">
            <table style="padding: 0px; max-width:700px; min-width:450px;" align="center">
                <tr>
                    <td>
                        <div style=" background-color: #2c003e; padding-bottom: 10px">
                            <center><div style="width:100px; "><img src="'.MailMessageBody::$link_to_logo.'" style="width:100%; margin-top: 30px;"></div></center>
                            <h3 style="padding-left: 10px; padding-right: 10px; color:white; text-align: center; font-family:'.$font.'">'.$subject.'</h3>
                        </div>
                        <div>
                            <p style="padding-left: 10px; font-family: '.$font.'"><strong>Dear </strong> <span>'.$name.'</span></p>
                        </div>
                    </td>
                </tr>
            
                <tr><td><p style="padding-left: 10px; font-family: '.$font.'">Your message has been received. Thanks for contacting us. We will get back to you as soon as possible.</p></td></tr>
                <tr><td>&nbsp;</td></tr>
                <tr><td>&nbsp;</td></tr>
            
                <tr>
                    <td>
                        <div style="height: 80px; background-color: #2c003e;">
                            <p style="line-height: 80px; font-family: '.$font.'; color:white; text-align: center;" ><span>Thanks & Regards,</span>&nbsp;&nbsp;<span></span></p>
                        </div>
                    </td>
                </tr>
            
                <tr><td></td></tr>
                <tr><td></td></tr>
            </table>
            </body>
            </html>';

    }


}
