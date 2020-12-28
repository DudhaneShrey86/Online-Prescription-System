<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Doctor;
use App\Models\Patient;

class DoctorController extends Controller
{
  public function __construct(){
    $this->middleware('auth:doctor');
  }

  public function index(){
    $consultations = Auth::guard('doctor')->user()->consultations()->where('prescription_given', '=', 0)->get();
    return view('doctors.index', ['consultations' => $consultations]);
  }

  public function showProfile(Doctor $doctor){
    $consultations = $doctor->consultations()->where('prescription_given', 1)->get();
    $canedit = false;
    if(Auth::guard('doctor')->user()->id == $doctor->id){
      $canedit = true;
    }
    return view('doctors.profile', ['doctor' => $doctor, 'canedit' => $canedit, 'consultations' => $consultations]);
  }

  public function updateProfile(Doctor $doctor){
    if($doctor->id != Auth::guard('doctor')->user()->id){
      return redirect()->back()->with('custommsg', 'Some error occured!')->with('classes', 'red darken-1');
    }
    if(request()->has('profile_link')){
      $data = request()->validate([
        'profile_link' => 'required|mimes:jpeg,png'
      ]);
      $data['profile_link'] = request()->profile_link;
      $file1 = request()->file('profile_link');
      $filename1 = $file1->getClientOriginalName();
      $ext1 = pathinfo($filename1, PATHINFO_EXTENSION);

      $filename1 = str_replace(basename($filename1, ".".$ext1), "profile_pic", $filename1);

      $filename1 = $doctor->id."_".$filename1;

      $path = public_path().'/Documents/DoctorProfilePic/';

      $file1->move($path,$filename1);
      $filepath1 = '/Documents/DoctorProfilePic/'.$filename1;
      $data['profile_link'] = $filepath1;
    }
    $doctor->update($data);
    $doctor->save();
    return redirect()->back()->with('custommsg', 'Changes Saved!')->with('classes', 'green darken-1');
  }

  public function seePatientProfile(Patient $patient){
    return view('doctors.seeprofile', ['patient' => $patient]);
  }

}
