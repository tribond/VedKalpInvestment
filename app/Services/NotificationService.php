<?php

namespace App\Services;

use App\Models\GeneralSettings;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotificationService
{

    // ============================================
    // EMAIL TEMPLATE (Header + Footer)
    // ============================================
    private static function emailTemplate($name, $content)
    {
        $generalSettings = GeneralSettings::first();
        $logo = asset('assets/img/logo.webp');
        $contactNumber = "+91-" . $generalSettings->clinic_contact;
        $contactEmail = $generalSettings->clinic_email;
        $privacyLink = route('policy');
        $termsLink = route('terms');

        return "
        <div style='font-family: 'Arial', sans-serif; margin: 0; padding: 0; background-color: #f4f7fa;'>

            <!-- Header -->
            <div style='background-color: #f8f9fa; text-align: center; padding: 30px 20px;'>
                <img src='{$logo}' alt='Vaccine Buddy' style='max-width: 300px; margin: 0 auto;'>
            </div>

            <!-- Body -->
            <div style='background-color: #f8f9fa; margin: 30px auto; padding: 30px; max-width: 700px; 
                        border-radius: 12px; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);'>
                
                <p style='font-size: 18px; color: #333333; margin-bottom: 15px;'>Dear <strong>{$name}</strong>,</p>

                <!-- Content Section -->
                <div style='font-size: 16px; color: #555555; line-height: 1.6;'>
                    {$content}
                </div>

                <!-- Thank You Section -->
                <div style='margin-top: 30px; text-align: center;'>
                    <p style='font-size: 18px; font-weight: bold; color: #5bc0de;'>Thank you for choosing Vaccine Buddy!</p>
                    <p style='font-size: 14px; color: #777777;'>We appreciate your trust in us. Stay safe, and we are here to assist you in your vaccination journey every step of the way.</p>
                </div>

            </div>

            <!-- Footer -->
            <div style='background-color: #f8f9fa; text-align: center; padding: 20px 15px;'>
                <p style='font-size: 14px; color: #777777; margin-bottom: 5px;'>
                    📞 {$contactNumber} &nbsp; | &nbsp; 📧 {$contactEmail}
                </p>
                <p style='font-size: 12px; color: #999999; margin: 0;'>
                    © " . date('Y') . " Vaccine Buddy — All Rights Reserved.
                </p>
                <p style='font-size: 12px; color: #999999;'>
                    <a href='{$privacyLink}' style='color: #5bc0de; text-decoration: none;'>Privacy Policy</a> | 
                    <a href='{$termsLink}' style='color: #5bc0de; text-decoration: none;'>Terms & Conditions</a>
                </p>
            </div>

        </div>

        ";
    }

    // ============================================
    // SEND EMAIL
    // ============================================
    public static function sendEmail($to, $subject, $body)
    {
        if (!$to)
            return false;
        try {
            Mail::send([], [], function ($message) use ($to, $subject, $body) {
                $message->to($to)
                    ->subject($subject)
                    ->html($body);
            });

            return true;
        } catch (\Exception $e) {
            // Log the error
            Log::error('Mail sending failed: ' . $e->getMessage());

            return false;
        }
    }

    // ============================================
    // CONTACT US LEAD
    // ============================================
    public static function contactUsEnquiry($adminEmail, $name, $email, $phone, $subject, $message, $sendEmail = true)
    {

        if ($sendEmail) {
            $subject = "New Contact Enquiry from " . $name;

            $content = "
                <h2>New Contact Enquiry</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Phone:</strong> $phone</p>
                <p><strong>Subject:</strong> $subject</p>
            ";
            if ($message) {
                $content .= "<p><strong>Message:</strong><br>$message</p>";
            }

            $body = self::emailTemplate('Admin', $content);
            self::sendEmail($adminEmail, $subject, $body);
        }
    }

}
