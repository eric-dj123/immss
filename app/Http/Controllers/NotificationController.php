<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\NationalInvioceMailer;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{
    //
    public $message;
    public $phone;
    public $subject;
    public $attachmentPath;

    public function notify_sms($message,$phone)
    {
        $data = [
            'message' => $message,
            'phone' => $phone,
        ];
        $url = "http://smsc.xwireless.net/API/WebSMS/Http/v1.0a/index.php?username=xxxx&password=xxxx&sender=xxxx&to=$phone&message=$message&reqid=1&format={json|text}&route_id=7";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
    public function nationalMailInvoice($email,$subject,$message,$attachmentPath)
    {
        $data = [
            'subject' => $subject,
            'message' => $message,
            'attachmentPath' => $attachmentPath,
        ];
        Mail::to($email)->send(new NationalInvioceMailer($data));
    }
}
