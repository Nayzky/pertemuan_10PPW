<?php
namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use Illuminate\Http\Request;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
//  public function index()
//  {
//  $content = [
//     'subject' => 'This is the mail subject',
//     'body' => 'This is the email body of how
//                to send email from laravel 10 with mailtrap.'
//  ];

// Mail::to('innaiyaazkiyah@mail.ugm.ac.id')->send(new
// SendEmail($content));
//  return "Email berhasil dikirim.";
//  }

public function index()
{
    return view('kirim-email');
}

public function store(Request $request)
{
    $data = $request->all();
    dispatch(new SendMailJob($data));

    // Mengambil alamat email dari input pengguna
    $userEmail = $data['email'];

    // Persiapkan konten email
    $emailContent = [
        'subject' => 'Pendaftaran Berhasil',
        'body' => 'Terimakasih telah mendaftarkan akun anda di aplikasi kami..'
    ];

    // Kirim email ke alamat email pengguna
    Mail::to($userEmail)->send(new SendEmail($emailContent));

    return redirect()->route('kirim-email')
        ->with('success', 'Email berhasil dikirim dan pengguna berhasil login');
    }
}
