<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class LoginRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest")->except(['logout', 'dashboard']);
    }
    public function register()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:250',
            'email'=>'required|email|max:250|unique:users',
            'password'=>'required|min:8|confirmed',
            'photo' => 'image|nullable|max:199']);

        $name = 'innaiya azkiya H';
        $email = 'innaiyazkiya@gmail.com';
        $password = 'naiyaxxx21';


        User::create([
            'name'=>$request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password)]);
        
        $credentials = $request->only('email','password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashboard')
        >with('successfully registered & logged');
        }


    public function login()
    {    
        return view('auth.login');
    }
    public function authenticate (Request $request) 
    {
        $credentials = $request->validate([ 
            'email' => 'required|email', 
            'password' => 'required']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); 
            return redirect()->route('dashboard')
                ->withSuccess('You have successfully logged in!');
        }
            return back()->withErrors([
                'email' => 'Your provided credentials do not match in our records.',])
            ->onlyInput('email');
        }
    public function dashboard()
    {
        if (Auth::check()) {
            return view('auth.dashboard');
        }
            return redirect()->route('login')
            ->withErrors([
                'email' => 'Please login to access the dashboard.',
                 ])->onlyInput('email');
    }
    public function logout (Request $request)
    {
        Auth::Logout();
        $request->session ()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
        ->withSuccess('You have logged out successfully!');;
    }

    public function updatePhoto(Request $request)
{
    $request->validate([
        'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        $user = Auth::user();
        $photo = $request->file('photo');
        $fileName = time().'.'.$photo->getClientOriginalExtension();
        $photo->storeAs('photos', $fileName, 'public');
        
        // Simpan nama file di database
        $user->photo = $fileName;
        $user->save();

        // Buat dan simpan thumbnail
        $thumbnail = Image::make($photo->getRealPath());
        $thumbnail->fit(100); // Sesuaikan ukuran sesuai kebutuhan
        $thumbnail->save(storage_path('app/public/uploads/thumbnail_'.$fileName));
    }

    return redirect()->back()->with('success', 'Photo berhasil diubah');
}
}