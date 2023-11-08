<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail($email, $subject, $body)
    {
        $data = [
            'subject' => $subject,
            'body' => $body,
        ];

        Mail::to($email)->send(new SendEmail($data));

        return "Email berhasil dikirim.";
    }
}
