<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;

class DoctorLoginController extends Controller
{
  public function __construct(){
    $this->middleware('guest:doctor', ['except' => ['logout']]);
  }
  public function showLoginForm(){
    return view('auth.doctors-login');
  }
  public function login(){
    $data = request()->validate([
      'email' => 'required|email',
      'password' => 'required'
    ]);
    if(Auth::guard('doctor')->attempt(['email' => request()->email, 'password' => request()->password], request()->remember)){
      return redirect()->route('doctors.index');
    }
    else{
      return redirect()->back()->withErrors(['Incorrect Email Or Password']);
    }
  }
  public function logout(){
    Auth::logout();
    request()->session()->flush();
    request()->session()->regenerate();
    return redirect()->route('doctors.index');
  }

  public function showRegistrationForm(){
    $specialities = Doctor::distinct('speciality')->pluck('speciality');
    return view('auth.doctors-register', ['specialities' => $specialities]);
  }

  public function register(){
    $data = request()->validate([
      'name' => 'required',
      'speciality' => 'required',
      'email' => 'required|regex:/(.*)@(.*)\.(.{2,})/i',
      'password' => 'required|confirmed|min:8',
      'contact' => 'digits:10',
      'yrs_of_exp' => 'required|min:0',
    ]);
    $data['password'] = Hash::make($data['password']);
    $doctor = Doctor::create($data);

    return redirect()->route('doctors.login')->with('custommsg', 'Registration Successful')->with('classes', 'green darken-1');
  }

}
